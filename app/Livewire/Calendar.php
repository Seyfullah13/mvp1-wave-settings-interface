<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\BookingGuest;
use App\Models\BookingStatus;
use App\Models\Partenaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];
    public $resources = [];

    protected $listeners = [
        'refreshEvents' => 'loadEvents',
    ];

    public function mount()
    {
        $this->loadEvents();
        $this->loadResources();
    }

    public function loadEvents()
    {
        // Clear the events array
        $this->events = [];
        $confirmed = BookingStatus::where('name', 'Confirmé')->first();

        // Récupérer les données de réservation avec les relations nécessaires
        $bookings = Booking::with(['guest', 'partenaire', 'property.attribute'])
            ->where('booking_status_id', $confirmed->id)
            ->get();

        // Formater les données de réservation pour les rendre compatibles avec FullCalendar
        foreach ($bookings as $booking) {
            $guestFirst_name = $booking->guest->first_name ?? null;
            $guestLast_name = $booking->guest->last_name ?? null;

            $guestName = trim(($guestFirst_name ?? '') . ' ' . ($guestLast_name ?? '')) ?: 'N/A';

            $partenaire = $booking->partenaire;

            // Créer un tableau associatif représentant un événement dans FullCalendar
            $event = [
                'id' => $booking->id,
                'title' => $guestName,
                'start' => $booking->check_in,
                'end' => $booking->check_out,
                'allDay' => false,
                'resourceId' => $booking->property_id,
                'slotEventOverlap' => false,
                'borderColor' => $partenaire->border_color ?? null,
                'backgroundColor' => $partenaire->background_color ?? null,
                'extendedProps' => [
                    'guestId' => $booking->guest->id ?? null,
                    'guest' => $guestName,
                    'partnerId' => $partenaire->id ?? null,
                    'partnerName' => $partenaire->name ?? null,
                    'partnerIcon' => $partenaire->icon ?? null,
                    'number_of_nights' => $booking->number_of_nights,
                    'number_of_guests' => $booking->number_of_guests,
                    'number_of_adults' => $booking->number_of_adults,
                    'number_of_children' => $booking->number_of_children,
                    'number_of_animals' => $booking->number_of_animals,
                    'property' => $booking->property->attribute->name,
                    'total_payout' => $booking->total_payout,
                    'currency' => $booking->currency,
                    'email' => $booking->guest->email ?? null,
                    'phone' => $booking->guest->phone ?? null,
                    'picture' => $booking->guest->picture ?? null,
                    'external' => $booking->external_reservation_id,
                ],
            ];

            // Ajouter l'événement formaté à la liste des événements
            $this->events[] = $event;
        }

        // Fetch available properties (non-booked dates) and assign prices
        $properties = Auth::user()->ownedProperties()->where('is_enabled', true)->get();
        foreach ($properties as $property) {
            $availableDates = $this->getAvailableDatesForProperty($property);
            $minStay = $property->min_stay; // Récupérer la valeur de min_stay

            foreach ($availableDates as $date) {
                $price = $this->calculatePriceForDate($property, $date);

                // Place the € symbol before the price
                $this->events[] = [
                    'title' => '€' . number_format($price, 2), // Format price with € before it
                    'start' => $date,
                    'allDay' => true,
                    'resourceId' => $property->id,
                    'backgroundColor' => 'transparent',
                    'borderColor' => 'transparent',
                    'textColor' => '#000000',
                    'extendedProps' => [
                        'price' => $price,
                        'property' => $property->attribute->name,
                        'min_stay' => $minStay, // Ajouter min_stay aux extendedProps
                    ],
                ];
            }
        }
    }

    private function getAvailableDatesForProperty($property)
    {
        // Retrieve all non-canceled bookings by checking the 'external_status' field
        // Adjusting to filter out 'Annulé' status bookings
        $activeBookings = Booking::where('property_id', $property->id)
            ->where('check_out', '>', now())
            ->where('external_status', '!=', 'Annulée') // Exclude bookings with 'Annulé' external_status
            ->get();

        // Retrieve all canceled bookings where 'external_status' is 'Annulé'
        $canceledBookings = Booking::where('property_id', $property->id)
            ->where('check_out', '>', now())
            ->where('external_status', 'Annulée') // Only include bookings marked as 'Annulé'
            ->get();

        $bookedDates = [];

        // Mark all dates between check_in and check_out as booked for active bookings
        foreach ($activeBookings as $booking) {
            $start = Carbon::parse($booking->check_in);
            $end = Carbon::parse($booking->check_out);

            while ($start->lte($end)) {
                $bookedDates[$start->toDateString()] = true;
                $start->addDay();
            }
        }

        // Define the date range to check for availability
        $start = now()->startOfMonth(); // Beginning of the current month
        $end = now()->addMonths(6); // 6 months from now
        $availableDates = [];

        // Add dates that are not booked by active bookings to availableDates
        for ($date = $start; $date->lte($end); $date->addDay()) {
            if (!isset($bookedDates[$date->toDateString()])) {
                $availableDates[] = $date->toDateString();
            }
        }

        // Handle 'Annulé' bookings: mark canceled booking dates as available
        foreach ($canceledBookings as $booking) {
            $start = Carbon::parse($booking->check_in);
            $end = Carbon::parse($booking->check_out);

            while ($start->lte($end)) {
                $availableDates[] = $start->toDateString(); // Add 'Annulé' booking dates as available
                $start->addDay();
            }
        }

        // Remove duplicates in case any dates overlap between canceled and available dates
        $availableDates = array_unique($availableDates);

        return $availableDates;
    }

    private function calculatePriceForDate($property, $date)
    {
        return 100; // Fixed price for simplicity; adjust as needed
    }

    public function loadResources()
    {
        // Clear the resources array
        $this->resources = [];

        // Récupérer les propriétés de l'utilisateur connecté
        $user = Auth::user();
        // Récupérer les propriétés activées où l'utilisateur est "Owner"
        $properties = $user->ownedProperties()->where('is_enabled', true)->get();

        foreach ($properties as $property) {
            // Assurez-vous de récupérer correctement la photo avec photo_id 1
            $photo = $property->first_photo_url;

            // Si la photo existe, utilisez son chemin, sinon utilisez un chemin par défaut
            $imagePath = './storage/' . ($photo ?? 'avatars/defaultHome.jpg');

            $resource = [
                'id' => $property->id,
                'title' => $property->attribute->name,
                'building' => $property->attribute->nickname,
                'image' => $imagePath,
            ];

            $this->resources[] = $resource;
        }
    }

    public function getEvents()
    {
        $this->loadEvents();
        return response()->json($this->events);
    }

    public function render()
    {
        return view('livewire.calendar', [
            'hasProperties' => !empty($this->resources),
        ]);
    }

    public function updatePhone(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:booking_guests,id',
            'phone' => 'required|string|max:15',
        ]);

        try {
            $guest = BookingGuest::findOrFail($validatedData['id']);
            $guest->phone = $validatedData['phone'];
            $guest->save();

            $this->emit('refreshEvents');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateEmail(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:booking_guests,id',
            'email' => 'required|string|email|max:255',
        ]);

        try {
            $guest = BookingGuest::findOrFail($validatedData['id']);
            $guest->email = $validatedData['email'];
            $guest->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateArrivalTime(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:bookings,id',
            'arrivalTime' => 'required|string|regex:/^\d{2}:\d{2}$/',
        ]);

        $newArrivalTime = $validatedData['arrivalTime']; // Format: 'HH:MM'
        $bookingId = $validatedData['id'];

        try {
            $booking = Booking::findOrFail($bookingId);
            $booking->arrival_time = $newArrivalTime;
            $booking->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

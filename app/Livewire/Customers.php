<?php

namespace App\Livewire;

use Filament\Forms\Components\CheckboxList;
use Illuminate\Support\Facades\Log;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

use Filament\Support\Enums\IconPosition;
use App\Models\Country;
use App\Models\Address;

use App\Models\BookingGuest;
use App\Models\Contact;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Filters\SelectFilter;

use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Tables;

class Customers extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Contact $contact;

    public BookingGuest $guest;


    /**
     * @return View
     */

    public function mount(BookingGuest $guest)
    {
         $this->guest = $guest;
    }

    public function render(): View
    {
        return view('livewire.customers');
    }

    public function table(Table $table): Table
    {

        return $table
            ->query(BookingGuest::query()->with(static::getRelations()))
            
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('NAME')
                    ->formatStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('MAIL')
                    ->searchable(),
                
                PhoneColumn::make('phone')
                    ->countryColumn('phone_country')
                    ->label('PHONE')
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL)
                    ->searchable(),

                Tables\Columns\TextColumn::make('address.country.name')
                    ->label('COUNTRY')
                    ->searchable(),
                // Tables\Columns\ImageColumn::make('picture')
                //     ->label('Picture')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->model(BookingGuest::class)
                    ->form([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('First Name'),
                                TextInput::make('last_name')
                                    ->label('Last Name'),
                            ]),
                        
                        Select::make('country_id')
                            ->label('Country')
                            ->relationship('address.country', 'name')
                            ->required()
                            ,
                        
                        TextInput::make('email')->email()->required(),
                        PhoneInput::make('phone')->required()
                        ->ipLookup(function () {
                            return rescue(fn () => Http::get('https://ipinfo.io/json')->json('country'), app()->getLocale(), report: false);
                        }),
                        //FileUpload::make('picture')->image()
                    ])
                    ->after(function (BookingGuest $record, array $data) {
                        // Créer l'objet Address
                        $address = new Address();

                        // Mettre à jour le country_id
                        $address->country_id = $data['country_id'];

                        // Sauvegarder l'adresse associée à l'enregistrement
                        $record->address()->save($address);

                        // Rafraîchir le record pour s'assurer que toutes les relations sont bien rechargées
                        $record->refresh();
                        
                    })
                    ->slideOver()
                    ->icon('heroicon-s-plus')        
                    ->label('Client')
            ])
            ->actions([
                Tables\Actions\EditAction::make('Edit')
                    ->label('Edit')
                    ->icon(false)
                    ->slideOver()
                    ->color('danger')
                    ->button()
                    ->model(BookingGuest::class)
                    ->form([
                        Grid::make(2)
                        ->schema([
                            TextInput::make('first_name')
                                ->label('First Name'),
                            TextInput::make('last_name')
                                ->label('Last Name'),
                        ]),
                        Select::make('address.country_id')
                            ->label('Country')
                            ->relationship('address.country', 'name')
                            ->required()
                            ->afterStateUpdated(function ($state, $set, $get, $record) {
                                // Charger ou créer l'objet Address
                                $address = $record->address ?: new \App\Models\Address;

                                // Mettre à jour le country_id
                                $address->country_id = $state;

                                // Sauvegarder l'adresse associée à l'enregistrement
                                $record->address()->save($address);

                                // Rafraîchir le record pour s'assurer que toutes les relations sont bien rechargées
                                $record->refresh();
                            }),

                        TextInput::make('email')->email()->required(),
                        PhoneInput::make('phone')->required()
                        ->ipLookup(function () {
                            return rescue(fn () => Http::get('https://ipinfo.io/json')->json('country'), app()->getLocale(), report: false);
                        }),
                        // FileUpload::make('picture')->image()
                    ]),

                Tables\Actions\DeleteAction::make()
                    ->label(false)
                        ->requiresConfirmation()
                        ->modalHeading('Confirmation')
                        ->modalDescription('Are you sure you want to delete this Customer?')
                        ->button()
                        ->icon('heroicon-c-trash'),
            ])
            ->bulkActions([
                BulkAction::make('merge')
                    ->label('Merge')
                    ->icon('tabler-git-merge')
                    ->iconPosition(IconPosition::After)
                    ->action(fn (Collection $records, array $data) => $this->mergeGuests($records, $data))
                    ->requiresConfirmation()
                    ->modalHeading('Merge Guests')
                    ->modalSubheading('Vous êtes sur le point de fusionner ces invités en un seul. Confirmez-vous ?')
                    ->form(fn (Collection $records) => [
                        Select::make('name')
                            ->label('Name')
                            ->options($records->mapWithKeys(fn($record) => [
                                $record->id => $record->first_name . ' ' . $record->last_name
                            ])->filter()->unique()->toArray())
                            ->required(),
            
                        Select::make('email')
                            ->label('Email')
                            ->options($records->pluck('email', 'email')->filter()->unique()->toArray()) // Filtrer les valeurs nulles
                            ->required(),
            
                        Select::make('phone')
                            ->label('Phone')
                            ->options($records->pluck('phone', 'phone')->filter()->unique()->toArray()) // Filtrer les valeurs nulles
                            ->required(),
                    ]),
                BulkAction::make('delete')
                    ->label('Delete')
                    ->action(fn (Collection $records) => $records->each->delete())
                    ->color('danger')
                    ->icon('heroicon-c-trash')
                    ->iconPosition(IconPosition::After),
            ])            
            ->filters([
                SelectFilter::make('country')->relationship('address.country', 'name'),
                // Filter::make('email_verified')
                //     ->query(fn (Builder $query): Builder => $query->whereNotNull('email'))
                //     ->label('Email Verified')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'address',
        ];
    }
    public function mergeGuests(Collection $records, array $data)
    {
        $guestIds = $records->pluck('id')->toArray();

        Log::info('Guest IDs for merging:', $guestIds);
        Log::info('Data for merging:', $data);

        try {
            // Explode the name into first_name and last_name
            $fullName = $data['name'] ?? null;
            $firstName = null;
            $lastName = null;
            
            $guest = BookingGuest::find($data['name']);  // $data['name'] contient l'ID
            $firstName = $guest->first_name;
            $lastName = $guest->last_name;

            // Prepare fields to merge
            $fieldsToMerge = [
                'first_name' => $firstName,  // Set first_name
                'last_name' => $lastName,    // Set last_name
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'picture' => $data['picture'] ?? null,
            ];

            Log::info('Fields to merge:', $fieldsToMerge);

            // Merge the guests using BookingGuest::mergeGuests
            $mainGuest = BookingGuest::mergeGuests($guestIds, $fieldsToMerge);

            Log::info('Main guest after merging:', $mainGuest->toArray());

            // Refresh the table after merging
            $this->dispatch('refreshTable');
            session()->flash('message', 'Les invités ont été fusionnés avec succès.');
        } catch (\Exception $e) {
            Log::error('Error merging guests:', ['error' => $e->getMessage()]);
            session()->flash('error', $e->getMessage());
        }
    }

}

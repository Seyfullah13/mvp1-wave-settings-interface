<?php

namespace App\Livewire;

use Livewire\Component;

class BusinessContactForm extends Component
{
    public $reservation_email; // Propriété pour l'email de réservation
    public $billing_email; // Propriété pour l'email de facturation

    public function saveChanges()
    {
        // Logique pour sauvegarder les emails
        // Par exemple, tu peux les enregistrer dans la base de données

        session()->flash('message', 'Changes saved successfully!'); // Message de succès
    }

    public function render()
    {
        return view('livewire.business-contact-form');
    }
}

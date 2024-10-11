<?php

namespace App\Livewire;

use Livewire\Component;

class BusinessCardForm extends Component
{
    public array $data = [
        'company' => '',
        'value_added_tax' => '',
        'vat_number' => '',
        'means_of_payment' => '',
    ];

    public function render()
    {
        return view('livewire.business-card-form');
    }

    public function create()
    {
        // Logique pour gérer la soumission du formulaire
        dd($this->data);
    }
}

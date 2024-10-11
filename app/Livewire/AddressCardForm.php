<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddressCardForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_address')
                    ->label('Adresse complète')
                    ->required(),
                TextInput::make('postal_code')
                    ->label('Code postal')
                    ->required(),
                TextInput::make('city')
                    ->label('Ville')
                    ->required(),
                TextInput::make('country')
                    ->label('Pays')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render(): View
    {
        return view('livewire.address-card-form');
    }
}
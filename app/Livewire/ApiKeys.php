<?php

namespace App\Livewire;

use App\Models\ApiKey;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApiKeys extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $apiKeys;
    public $editKeyName, $editKeyId;
    public $deleteKeyId, $deleteKeyName;
    public $viewKey;

    public ?array $data = [];
    public ?string $key_name = null;

    protected $rules = [
        'key_name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->apiKeys = Auth::user()->apiKeys;
    }

    public function table(Table $table): Table
    {
        $query = Auth::user();

        return $table
            ->relationship(fn() => $query->apiKeys())
            ->emptyStateHeading('No API keys yet')
            ->emptyStateDescription('Once you create your first API key, it will appear here.')
            ->columns([
                TextColumn::make('name')
                    ->label('NAME')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('CREATED AT')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('last_used_at')
                    ->label('LAST USED AT')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return $state ? date('M d, Y g:i A', strtotime($state)) : 'Never used';
                    }),
                TextColumn::make('actions_label') // Placeholder for actions
                    ->label('ACTION') // Label for the action column
                    ->extraAttributes(['class' => 'text-center']) // Center-align the text
                    ->disableClick() // Ensure this column is not clickable
                    ->formatStateUsing(fn() => ''), // Keeps this column empty below the label
            ])
            ->filters([])
            ->actions([
                ViewAction::make()
                    ->button(),
                EditAction::make()
                    ->button()
                    ->after(function () {
                        $this->dispatch('pop-toast', [
                            'type' => 'success',
                            'message' => 'API key name updated successfully.',
                        ]);
                    }),
                DeleteAction::make()
                    ->button()
                    ->after(function () {
                        $this->dispatch('pop-toast', [
                            'type' => 'success',
                            'message' => 'API key deleted successfully.',
                        ]);
                    }),
            ])
            ->bulkActions([
                BulkAction::make('delete')
                    ->requiresConfirmation()
                    ->action(fn(Collection $records) => $records->each->delete())
                    ->deselectRecordsAfterCompletion(),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('')
                    ->required()
                    ->autofocus(),
            ]);
    }

    public function createApiKey()
    {
        $this->validate();

        $newKey = Auth::user()->apiKeys()->create([
            'name' => $this->key_name,
            'key' => bin2hex(random_bytes(16)),
            'last_used_at' => null,
        ]);

        $this->apiKeys = Auth::user()->apiKeys;
        $this->reset('key_name');

        $this->dispatch('pop-toast', [
            'type' => 'success',
            'message' => 'API key created successfully.',
        ]);
    }

    public function editApiKey($id)
    {
        $apiKey = ApiKey::findOrFail($id);
        $this->editKeyId = $apiKey->id;
        $this->editKeyName = $apiKey->name;
    }

    public function updateApiKey()
    {
        $apiKey = ApiKey::findOrFail($this->editKeyId);
        $apiKey->update(['name' => $this->editKeyName]);

        $this->apiKeys = Auth::user()->apiKeys;
        $this->reset('editKeyId', 'editKeyName');
    }

    public function confirmDeleteApiKey($id)
    {
        $apiKey = ApiKey::findOrFail($id);
        $this->deleteKeyId = $apiKey->id;
        $this->deleteKeyName = $apiKey->name;
    }

    public function deleteApiKey()
    {
        ApiKey::destroy($this->deleteKeyId);
        $this->apiKeys = Auth::user()->apiKeys;
        $this->reset('deleteKeyId', 'deleteKeyName');
    }

    public function viewApiKey($id)
    {
        $apiKey = ApiKey::findOrFail($id);
        $this->viewKey = $apiKey->key;
    }

    public function render()
    {
        return view('livewire.api-keys');
    }
}
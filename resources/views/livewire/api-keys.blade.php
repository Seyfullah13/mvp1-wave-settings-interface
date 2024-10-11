<head>
    <link rel="stylesheet" href="/style.css">
</head>

<div class="container mx-auto mt-4">
    <!-- Panel Builder Section for creating new API Key -->
    <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200 mt-4">
        <h2 class="text-xl font-bold">Your API Key</h2>
        <h2 class="text-sm font-medium mt-4 mb-4">Create a New API Key</h2>
        <form wire:submit.prevent="createApiKey" class="mt-4">
            <div class="flex items-center gap-4">
                <input type="text" wire:model="key_name" placeholder="API Key "
                    class="w-full rounded-md border border-gray-300 bg-gray-50 py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm mb-4">
            </div>
            <button type="submit" class="btn btn-sm rounded-lg btn-api h-full text-right" wire:loading.attr="disabled"
                wire:loading.class="btn-disabled" wire:target="createApiKey">
                Create New Key
            </button>
        </form>
    </div>

    <hr class="bg-gray-200">

    <h2 class="text-xl font-bold mt-8 mb-4">Current API Keys</h2>

    <!-- Panel Builder Section -->
    <div class="grid grid-cols-1 gap-4">
        {{ $this->table }}
        @script
        <script>
        $wire.on('pop-toast', (e) => {
            popToast(e[0].type, e[0].message);
        });
        </script>
        @endscript
    </div>
</div>
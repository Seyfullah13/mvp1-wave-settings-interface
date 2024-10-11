<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form Example</title>

    <!-- Include Tailwind CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Filament CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/@filament/forms@2.x/dist/filament.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <form wire:submit.prevent="create" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <!-- First Address -->
            <div>
                <label for="first_address" class="block text-sm font-medium text-gray-700">First adresses</label>
                <input type="text" id="first_address" wire:model.defer="data.first_address" placeholder="First adresses"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Postal Code -->
            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" id="postal_code" wire:model.defer="data.postal_code"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="93200">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- City -->
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" id="city" wire:model.defer="data.city"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="City Name">
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" id="country" wire:model.defer="data.country"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Country Name">
            </div>
        </div>

        <!-- Save Button -->
        <div class="text-right w-full">
            <button type="submit" class=" mt-36 bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-gray-800">
                Save changes
            </button>
        </div>
    </form>

    <!-- Include Filament JS (optional, if you need interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/@filament/forms@2.x/dist/filament.min.js"></script>
</body>

</html>
<form wire:submit.prevent="create" class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <!-- Company -->
        <div>
            <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
            <input type="text" id="company" wire:model.defer="data.company"
                class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                placeholder="First Address">
        </div>

        <!-- Value Added Tax -->
        <div>
            <label for="value_added_tax" class="block text-sm font-medium text-gray-700">Value Added Tax</label>
            <select id="value_added_tax" wire:model.defer="data.value_added_tax"
                class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <!-- VAT Number -->
        <div>
            <label for="vat_number" class="block text-sm font-medium text-gray-700">VAT Number</label>
            <input type="text" id="vat_number" wire:model.defer="data.vat_number"
                class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                placeholder="VAT number">
        </div>

        <!-- Means of Payment -->
        <div>
            <label for="means_of_payment" class="block text-sm font-medium text-gray-700">Means of Payment</label>
            <input type="text" id="means_of_payment" wire:model.defer="data.means_of_payment"
                class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-3 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                placeholder="Means of payment">
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-right w-full">
        <button type="submit" class="mt-4 bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-gray-800">
            Save changes
        </button>
    </div>
</form>
</div>
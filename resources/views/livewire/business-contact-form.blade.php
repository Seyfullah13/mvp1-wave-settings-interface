<form wire:submit.prevent="saveChanges" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Contact Email for Reservations -->
        <div>
            <label for="reservation_email" class="block text-sm font-medium text-gray-700">Contact email for
                Reservations</label>
            <div class="relative mt-1 flex items-center">
                <span class="absolute left-3 top-2 text-gray-400">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.8 3.7002L12.8001 3.7002C13.0808 3.70014 13.351 3.80743 13.5552 4.00007C13.6823 4.12002 13.7779 4.26742 13.8359 4.42923L8.00002 7.34679L2.16416 4.42923C2.22213 4.26742 2.31773 4.12002 2.44487 4.00007C2.64907 3.80743 2.9192 3.70014 3.19993 3.7002H3.20002L12.8 3.7002Z"
                            fill="#6B7280" stroke="#6B7280" />
                        <path
                            d="M14.4 6.49414L7.99998 9.69414L1.59998 6.49414V11.1997C1.59998 11.6241 1.76855 12.0311 2.0686 12.3311C2.36866 12.6312 2.77563 12.7997 3.19998 12.7997H12.8C13.2243 12.7997 13.6313 12.6312 13.9313 12.3311C14.2314 12.0311 14.4 11.6241 14.4 11.1997V6.49414Z"
                            fill="#111928" />
                    </svg>
                </span>
                <input type="email" id="reservation_email" wire:model.defer="data.reservation_email"
                    placeholder="Your@adresse.mail"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Contact Email for Billing -->
        <div>
            <label for="billing_email" class="block text-sm font-medium text-gray-700">Contact email for Billing</label>
            <div class="relative mt-1 flex items-center">
                <span class="absolute left-3 top-2 text-gray-400">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.8 3.7002L12.8001 3.7002C13.0808 3.70014 13.351 3.80743 13.5552 4.00007C13.6823 4.12002 13.7779 4.26742 13.8359 4.42923L8.00002 7.34679L2.16416 4.42923C2.22213 4.26742 2.31773 4.12002 2.44487 4.00007C2.64907 3.80743 2.9192 3.70014 3.19993 3.7002H3.20002L12.8 3.7002Z"
                            fill="#6B7280" stroke="#6B7280" />
                        <path
                            d="M14.4 6.49414L7.99998 9.69414L1.59998 6.49414V11.1997C1.59998 11.6241 1.76855 12.0311 2.0686 12.3311C2.36866 12.6312 2.77563 12.7997 3.19998 12.7997H12.8C13.2243 12.7997 13.6313 12.6312 13.9313 12.3311C14.2314 12.0311 14.4 11.6241 14.4 11.1997V6.49414Z"
                            fill="#111928" />
                    </svg>
                </span>
                <input type="email" id="billing_email" wire:model.defer="data.billing_email"
                    placeholder="Your@adresse.mail"
                    class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>
    </div>

    <!-- Save Changes Button -->
    <div class="text-right w-full">
        <button type="submit" class="mt-24 bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-gray-800">
            Save Changes
        </button>
    </div>
</form>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Input with Dial Code Example</title>

    <!-- Include intl-tel-input CSS styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <!-- Include Tailwind CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Filament CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/@filament/forms@2.x/dist/filament.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <form wire:submit.prevent="create" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <div class="relative mt-1 flex items-center">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.65385 3.78947C9.65385 5.56399 8.06216 7.07895 6 7.07895C3.93784 7.07895 2.34615 5.56399 2.34615 3.78947C2.34615 2.01496 3.93784 0.5 6 0.5C8.06216 0.5 9.65385 2.01496 9.65385 3.78947ZM1.69041 10.0251C2.45925 9.32375 3.51068 8.92226 4.61593 8.92105H7.38407C8.48932 8.92226 9.54075 9.32375 10.3096 10.0251C11.0769 10.7252 11.4987 11.6639 11.5 12.6322V15.1579C11.5 15.233 11.4677 15.3155 11.3927 15.384C11.3161 15.4538 11.2032 15.5 11.0769 15.5H0.923077C0.796811 15.5 0.683908 15.4538 0.607344 15.384C0.532311 15.3155 0.5 15.233 0.5 15.1579V12.6319C0.50136 11.6637 0.923181 10.7251 1.69041 10.0251Z"
                                fill="#6B7280" stroke="#6B7280" />
                        </svg>
                    </span>
                    <input type="text" id="first_name" wire:model.defer="data.first_name" placeholder="Your Name"
                        class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <div class="relative mt-1 flex items-center">
                    <span class="absolute left-3 top-2 text-gray-400">
                        <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.65385 3.78947C9.65385 5.56399 8.06216 7.07895 6 7.07895C3.93784 7.07895 2.34615 5.56399 2.34615 3.78947C2.34615 2.01496 3.93784 0.5 6 0.5C8.06216 0.5 9.65385 2.01496 9.65385 3.78947ZM1.69041 10.0251C2.45925 9.32375 3.51068 8.92226 4.61593 8.92105H7.38407C8.48932 8.92226 9.54075 9.32375 10.3096 10.0251C11.0769 10.7252 11.4987 11.6639 11.5 12.6322V15.1579C11.5 15.233 11.4677 15.3155 11.3927 15.384C11.3161 15.4538 11.2032 15.5 11.0769 15.5H0.923077C0.796811 15.5 0.683908 15.4538 0.607344 15.384C0.532311 15.3155 0.5 15.233 0.5 15.1579V12.6319C0.50136 11.6637 0.923181 10.7251 1.69041 10.0251Z"
                                fill="#6B7280" stroke="#6B7280" />
                        </svg>
                    </span>
                    <input type="text" id="last_name" wire:model.defer="data.last_name" placeholder="Your Name"
                        class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <div class="relative mt-1">
                    <input type="tel" id="phone" wire:model.defer="data.phone"
                        class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        placeholder="123 4567 890">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
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
                    <input type="email" id="email" wire:model.defer="data.email" placeholder="Your@adresse.mail"
                        class="block w-full rounded-md border border-gray-300 bg-gray-50 py-2 pl-10 pr-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="text-right w-full">
            <button type="submit" class="mt-4 bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-gray-800">
                Save changes
            </button>
        </div>
    </form>

    <!-- Include intl-tel-input JS scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
    // Initialize intl-tel-input on the phone_number element
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "US", // Default country
        preferredCountries: ['US', 'FR', 'TR'], // List of preferred countries
        separateDialCode: true, // Show dial code next to flag
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Example to handle the dial code on the backend if needed
    input.addEventListener('countrychange', function() {
        var dialCode = iti.getSelectedCountryData().dialCode;
        console.log('Selected country dial code: +' + dialCode);
    });
    </script>
</body>

</html>

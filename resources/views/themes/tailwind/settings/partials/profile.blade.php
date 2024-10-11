<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <!-- Titre et Contenu sous la navbar -->
    <div class="mt-20">
        <!-- Réduction du padding latéral -->
        <h1 class="text-left text-2xl font-bold mb-4">Profile Settings</h1>

        <!-- Section des Cartes avec grid Tailwind -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Carte des Informations Personnelles -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Personal Informations</h2>
                <div class="flex items-center mb-4">
                    <img class="w-24 h-24 rounded-lg" src="https://via.placeholder.com/150" alt="Profile">
                    <div class="ml-4 mt-4">
                        <!-- Groupement des boutons en flexbox -->
                        <div class="flex gap-2 mt-8">
                            <!-- Added mt-6 to add margin-top -->
                            <button
                                class="bg-black text-white font-bold py-2 px-4 w-18 rounded-md hover:bg-gray-800 flex items-center">
                                <svg class="mr-2" width="16" height="17" viewBox="0 0 16 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.7656 4.02297L8.5656 0.741047C8.49129 0.664638 8.40301 0.604017 8.30581 0.562654C8.20862 0.521291 8.10443 0.5 7.9992 0.5C7.89397 0.5 7.78978 0.521291 7.69259 0.562654C7.59539 0.604017 7.50711 0.664638 7.4328 0.741047L4.2328 4.02297C4.08279 4.17703 3.99861 4.3859 3.99876 4.60362C3.99891 4.82135 4.08338 5.0301 4.2336 5.18394C4.38382 5.33779 4.58747 5.42413 4.79977 5.42398C5.01206 5.42383 5.21559 5.33719 5.3656 5.18312L7.2 3.30176V10.3464C7.2 10.564 7.28429 10.7727 7.43431 10.9266C7.58434 11.0804 7.78783 11.1669 8 11.1669C8.21217 11.1669 8.41566 11.0804 8.56569 10.9266C8.71571 10.7727 8.8 10.564 8.8 10.3464V3.30176L10.6344 5.18312C10.7853 5.33258 10.9874 5.41528 11.1971 5.41341C11.4069 5.41154 11.6075 5.32525 11.7559 5.17313C11.9042 5.02101 11.9883 4.81522 11.9901 4.60009C11.992 4.38496 11.9113 4.17771 11.7656 4.02297Z"
                                        fill="white" />
                                    <path
                                        d="M14.4 9.93616H10.4V10.3464C10.4 10.9992 10.1471 11.6253 9.69706 12.0869C9.24697 12.5485 8.63652 12.8078 8 12.8078C7.36348 12.8078 6.75303 12.5485 6.30294 12.0869C5.85286 11.6253 5.6 10.9992 5.6 10.3464V9.93616H1.6C1.17565 9.93616 0.768687 10.109 0.468629 10.4168C0.168571 10.7245 0 11.1419 0 11.5771V14.859C0 15.2943 0.168571 15.7116 0.468629 16.0194C0.768687 16.3271 1.17565 16.5 1.6 16.5H14.4C14.8243 16.5 15.2313 16.3271 15.5314 16.0194C15.8314 15.7116 16 15.2943 16 14.859V11.5771C16 11.1419 15.8314 10.7245 15.5314 10.4168C15.2313 10.109 14.8243 9.93616 14.4 9.93616ZM12.4 14.859C12.1627 14.859 11.9307 14.7869 11.7333 14.6516C11.536 14.5164 11.3822 14.3242 11.2913 14.0993C11.2005 13.8744 11.1768 13.627 11.2231 13.3882C11.2694 13.1495 11.3836 12.9302 11.5515 12.7581C11.7193 12.586 11.9331 12.4687 12.1659 12.4212C12.3987 12.3738 12.6399 12.3981 12.8592 12.4913C13.0785 12.5844 13.2659 12.7422 13.3978 12.9446C13.5296 13.147 13.6 13.3849 13.6 13.6283C13.6 13.9547 13.4736 14.2678 13.2485 14.4986C13.0235 14.7294 12.7183 14.859 12.4 14.859Z"
                                        fill="white" />
                                </svg>
                                Upload
                            </button>

                            <button
                                class="border border-red-500 font-bold text-red-500 px-4 py-2 rounded-md hover:bg-red-100">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Filament Form for Personal Information -->
                @livewire('profileforms')
            </div>

            <!-- Carte des Adresses placée à droite -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Addresses</h2>
                <!-- Contenu de la carte Addresses -->
                @livewire('address-card-form')
            </div>

            <!-- Carte des Informations Business -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Business</h2>
                <!-- Contenu de la carte Business -->
                @livewire('business-card-form')
                <!-- Carte du Business Contact placée juste après la carte Business -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Business Contact</h2>
                    <!-- Contenu de la carte Business Contact -->
                    @livewire('business-contact-form')
                </div>
            </div>

        </div>
    </div>
</body>

</html>
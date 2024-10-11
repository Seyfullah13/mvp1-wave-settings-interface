@extends('theme::layouts.base2')

@section('content')

@php
    $generalFields = [
        $property->address->city,
        $property->attribute->property_type_id,
        $property->attribute->maximum_capacity,
        $property->attribute->name,
        $property->address->street_number,
        $property->address->street,
        $property->address->state,
        $property->address->zip_code,
        $property->address->country_id,
    ];

    $generalFilledFields = array_filter($generalFields);

    $attributeFields = [
        $property->attribute->bedrooms,
        $property->attribute->beds,
        $property->attribute->bathrooms,
        $property->attribute->description,
        $property->attribute->summary,
        $property->attribute->currency_id,
    ];

    $attributeFilledFields = array_filter($attributeFields); 
@endphp

<main class="wrapper w-full mx-auto py-5 px-3 flex flex-col">
    <header class="flex justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-950 dark:text-white">Edit Property {{ $property->attribute->name }}</h1>
        </div>
    </header>

    <style>

        .status-completed {
                color: green;
                font-weight: bold;
        }
        .status-partially-completed {
                color: #FFD700;
                font-weight: bold;
        }
        .status-pending {
                color: red;
                font-weight: bold;
        }

        .tab-link {
            color: black;
            padding: 0.25rem 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 0.5rem;
        }

        .tab-link:hover {
            background-color: lightblue;
            color: white;
        }

        .tab-link.active {
            color: white;
            background-color: #004f5c;
            position: relative;
        }

        .tab-link.active::after {
            content: '';
            width: 24px;
            height: 24px;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="white" d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/></svg>') center center no-repeat;
        }

        .description {
            background-color: inherit;
            font-size: 12px;
            color: ;
            margin-top: 0.25rem;
        }

        .tab-item {
            padding: 0.25rem 0.5rem; /* Réduit encore la hauteur de chaque li */

        }

        .sidebar {
            height: 100%;
            padding-top: 1rem;
        }

        .hidden {
            display: none;
        }

        .custom-input-style {
            position: relative;
            top: 100%; 
            height: 122%;
            text-align: center;
        }
        .back-link {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: black;
            text-decoration: none;
        }

        .back-link svg {
            margin-right: 0.5rem;
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        /* Définir la couleur personnalisée */
        :root {
            --custom-color: #004F5C;
        }

        /* Lorsqu'un élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom {
            background-color: var(--custom-color) !important; /* Couleur de fond lorsque sélectionné */
            border-color: var(--custom-color) !important; /* Couleur de bordure lorsque sélectionné */
        }

        /* Bordure de l'icône en blanc lorsque l'élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom svg {
            stroke: white !important; /* Bordure blanche pour l'icône lorsque sélectionné */
        }

        /* Texte blanc pour le <span> lorsque l'élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom .place-items-start .font-medium {
            color: white !important; /* Couleur du texte blanche lorsque sélectionné */
        }

        /* Couleur de la bordure lorsque l'élément radio n'est pas sélectionné */
        label.flex.cursor-pointer.gap-x-3 {
            border-color: var(--custom-color) !important; /* Bordure de couleur personnalisée */
        }

        /* Couleur de l'icône lorsque l'élément n'est pas sélectionné */
        .fi-color-custom svg {
            stroke: var(--custom-color) !important; /* Bordure personnalisée pour l'icône lorsque non sélectionné */
        }

        /* Couleur du texte lorsque l'élément radio n'est pas sélectionné */
        .fi-color-custom .place-items-start .font-medium {
            color: var(--custom-color) !important; /* Couleur du texte personnalisée lorsque non sélectionné */
        }


    </style>


    <div class="flex-grow flex overflow-hidden">
        <div class="w-1/4 flex-shrink-0 sidebar">
            <a href="/properties" class="back-link text-medium">
                <svg width="24" height="12" viewBox="0 0 24 12" xmlns="http://www.w3.org/2000/svg">
                    <path fill="black" d="M10.975 1l2.847 2.828-6.176 6.176h16.354v-3.992H10.2l6.197 6.197-2.999 -2.828L-2 10z"/>
                </svg>

                Back to Properties
            </a>
            <ul class="flex flex-col space-y-2 text-lg font-medium text-gray-500 dark:text-gray-400">
                <li class="tab-item">
                    <a href="#details" onclick="showSection('details', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full active">
                        Property Dashboard
                        <p class="description">Onboarding Steps</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#general" onclick="showSection('general', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property general
                        <p class="description">Property type and general</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#attribute" onclick="showSection('attribute', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Attributes
                        <p class="description">Room, currency and other details</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#picture" onclick="showSection('picture', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Pictures and description
                        <p class="description">Add photos and description.</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#rule" onclick="showSection('rule', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Rules
                        <p class="description">Rules for the property</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#platform" onclick="showSection('platform', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Platforms
                        <p class="description">Platforms the property is listed on.</p>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow px-4 top-0 overflow-y-auto">
            <div id="details" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: block;">
            <h1 class="text-3xl font-bold text-gray-950 dark:text-white mb-4">{{ $property->attribute->display_name }}</h1>
                <div class="mb-8">
                    <h4 class="font-bold mb-3">Indicate the type of your property and its address</h4>
                    <p class="mb-4">Indicating the type and address of a property is essential for accurately matching guest expectations and ensuring proper legal compliance.</p>
                    <div class="attribute-status mb-4">
                    @if(count($generalFilledFields) === count($generalFields))
                        <span class="status-completed">✔ Complet</span>
                    @elseif(count($generalFilledFields) > 0)
                        <span class="status-partially-completed">⚠️ Partiellement complété</span>
                    @else
                        <span class="status-pending">❗ Non complété</span>
                    @endif

                    </div>
                    <hr/>
                </div>

                <div class="mb-8">
                    <h4 class="font-bold mb-3">Specify the property amenities (bedrooms, bathrooms, beds) and select the currency along with additional property details</h4>
                    <p class="mb-4">Specify these details to give potential guests a clear understanding of the property's features and ensure it meets their needs.</p>
                    <div class="attribute-status mb-4">
                        @if(count($attributeFilledFields) === count($attributeFields))
                        <span class="status-completed">✔ Complet</span>
                    @elseif(count($attributeFilledFields) > 0)
                        <span class="status-partially-completed">⚠️ Partiellement complété</span>
                    @else
                        <span class="status-pending">❗ Non complété</span>
                    @endif
                    </div>
                    <hr/>
                </div>
                <div class="mb-8">
                    <h4 class="font-bold mb-3">Add photos, descripion and a summary that describe your property</h4>
                    <p class="mb-4">Adding photos, a description, and a summary is crucial to attract potential guests by showcasing the property and providing key details about its features.
                    </p>
                    <div class="attribute-status mb-4">
                        <span class="status-completed">✔ Complet</span>
                        <span class="status-pending">❗ Non complété</span>
                    </div>
                    <hr/>
                </div>
                <div class="mb-8">
                    <h4 class="font-bold mb-3">Select Important Property Rules</h4>
                    <p class="mb-4"> Clearly stating rules like whether pets are allowed, smoking is permitted, or parties are allowed helps set guest expectations and ensures compliance with the host's policies.
                    </p>
                    <div class="attribute-status mb-4">
                        <span class="status-completed">✔ Complet</span>
                        <span class="status-pending">❗ Non complété</span>
                    </div>
                    <hr/>
                </div>

            </div>
            

            <div id="general" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">General</h3>
    
                @livewire('properties.edit.general', ['propertyId' => $property->id])

            </div>

            <div id="attribute" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Attribute Tab</h3>
    
                @livewire('properties.edit.attribute', ['propertyId' => $property->id])

            </div>

            <div id="picture" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Picture</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                @livewire('properties.edit.edit-photo', ['propertyId' => $property->id])


            </div>

            <div id="rule" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">House rules</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                @livewire('properties.edit.rule', ['propertyId' => $property->id])

            </div>

            <div id="platform" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Platforms</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                <hr class="my-4">

                @livewire('properties.edit.platform', ['propertyId' => $property->id])

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash.substring(1);
            if (hash) {
                showSection(hash, document.querySelector(`a[href="#${hash}"]`));
            } else {
                showSection('details', document.querySelector('a[href="#details"]'));
            }
            updateButtonsVisibility();
        });

        function showSection(sectionId, element) {
            document.querySelectorAll('.section').forEach(function(section) {
                section.style.display = 'none';
            });

            document.getElementById(sectionId).style.display = 'block';

            document.querySelectorAll('.tab-link').forEach(function(link) {
                link.classList.remove('active');
            });

            if (element) {
                element.classList.add('active');
            }

            updateButtonsVisibility();
        }

        function navigateSection(direction) {
            const sections = ['details', 'general', 'attribute', 'picture', 'rule', 'platform'];
            let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

            if (direction === 'next' && currentIndex < sections.length - 1) {
                showSection(sections[currentIndex + 1], document.querySelector(`a[href="#${sections[currentIndex + 1]}"]`));
            } else if (direction === 'previous' && currentIndex > 0) {
                showSection(sections[currentIndex - 1], document.querySelector(`a[href="#${sections[currentIndex - 1]}"]`));
            }
        }

        function updateButtonsVisibility() {
            const sections = ['details', 'general', 'attribute', 'picture', 'rule', 'platform'];
            let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

            document.getElementById('previousButton').classList.toggle('hidden', currentIndex === 0);
            document.getElementById('nextButton').classList.toggle('hidden', currentIndex === sections.length - 1);
        }

        document.addEventListener('livewire:load', function () {
            window.addEventListener('sectionUpdated', function (event) {
                const sectionId = event.detail.sectionId;
                showSection(sectionId, document.querySelector(`a[href="#${sectionId}"]`));
                updateButtonsVisibility();
            });
        });
</script>

</main>

@endsection

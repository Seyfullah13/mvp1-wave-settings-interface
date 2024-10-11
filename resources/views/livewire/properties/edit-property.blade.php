<main class="wrapper w-full md:max-w-5xl mx-auto py-5 px-3 flex flex-col">
    <header class="flex justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-950 dark:text-white">Edit Property {{ $this->getProperty() }}</h1>
        </div>
    </header>

    <style>
        .tab-link {
            color: gray;
            padding: 0.25rem 0.5rem;
            margin-bottom: 0.25rem;
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
            color: gray;
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
            top: 100%; /* Ajustez cette valeur selon vos besoins */
            height: 122%; /* Ajustez cette valeur selon vos besoins */
            text-align: center;
        }

        .back-link {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: gray;
            text-decoration: none;
        }

        .back-link svg {
            margin-right: 0.5rem;
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        /* Conteneur de notification */
        .notification-container {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 9999;
        }

        /* Style de la notification */
        .notification {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Message de la notification */
        .notification-message {
            font-size: 16px;
        }

        /* Bouton de fermeture de la notification */
        .notification-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #155724;
        }

        
    </style>

    <div class="flex-grow flex overflow-hidden">

        <div class="w-1/4 flex-shrink-0 sidebar">
            <a href="/properties" class="back-link">
                <svg width="24" height="12" viewBox="0 0 24 12" xmlns="http://www.w3.org/2000/svg">
                    <path fill="black" d="M10.975 1l2.847 2.828-6.176 6.176h16.354v-3.992H10.2l6.197 6.197-2.999 -2.828L-2 10z"/>
                </svg>

                Back to Properties
            </a>
            <ul class="flex flex-col space-y-4 text-lg font-medium text-gray-500 dark:text-gray-400">
                <li class="tab-item">
                    <a href="#details" onclick="showSection('details', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full active">
                        Property Details
                        <p class="description">Details about the property.</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#attribute" onclick="showSection('attribute', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Attributes
                        <p class="description">Attributes of the property.</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#picture" onclick="showSection('picture', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Pictures
                        <p class="description">Pictures of the property.</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#rule" onclick="showSection('rule', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Rules
                        <p class="description">Rules for the property.</p>
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
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">General</h3>
                <form wire:submit.prevent="generalCreate" class="space-y-4">
                    {{ $this->generalForm }}

                    <div class="flex justify-end space-x-2 mr-6">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 hidden" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="attribute" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Attribute Tab</h3>
    
                <form wire:submit.prevent="attributeCreate">
                    {{ $this->attributeForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="picture" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Picture</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                
                <form wire:submit.prevent="photoCreate">
                    {{ $this->photoForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="rule" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">House rules</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                <form wire:submit.prevent="ruleCreate">
                    {{ $this->ruleForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="platform" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Platforms</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                <hr class="my-4">

                <form wire:submit.prevent="platformCreate">
                    {{ $this->platformForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
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
        const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
        let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

        if (direction === 'next' && currentIndex < sections.length - 1) {
            showSection(sections[currentIndex + 1], document.querySelector(`a[href="#${sections[currentIndex + 1]}"]`));
        } else if (direction === 'previous' && currentIndex > 0) {
            showSection(sections[currentIndex - 1], document.querySelector(`a[href="#${sections[currentIndex - 1]}"]`));
        }
    }

    function updateButtonsVisibility() {
        const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
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

    //     document.addEventListener('DOMContentLoaded', function() {
    //     const hash = window.location.hash.substring(1);
    //     if (hash) {
    //         showSection(hash, document.querySelector(`a[href="#${hash}"]`));
    //     } else {
    //         showSection('details', document.querySelector('a[href="#details"]'));
    //     }
    //     updateButtonsVisibility();
    // });

    // function showSection(sectionId, element) {
    //     document.querySelectorAll('.section').forEach(function(section) {
    //         section.style.display = 'none';
    //     });

    //     document.getElementById(sectionId).style.display = 'block';

    //     document.querySelectorAll('.tab-link').forEach(function(link) {
    //         link.classList.remove('active');
    //     });

    //     if (element) {
    //         element.classList.add('active');
    //     }

    //     updateButtonsVisibility();
    //     history.pushState(null, '', `#${sectionId}`);
    // }

    // function navigateSection(direction) {
    //     const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
    //     let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

    //     if (direction === 'next' && currentIndex < sections.length - 1) {
    //         showSection(sections[currentIndex + 1], document.querySelector(`a[href="#${sections[currentIndex + 1]}"]`));
    //     } else if (direction === 'previous' && currentIndex > 0) {
    //         showSection(sections[currentIndex - 1], document.querySelector(`a[href="#${sections[currentIndex - 1]}"]`));
    //     }
    // }

    // function updateButtonsVisibility() {
    //     const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
    //     let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

    //     document.getElementById('previousButton').classList.toggle('hidden', currentIndex === 0);
    //     document.getElementById('nextButton').classList.toggle('hidden', currentIndex === sections.length - 1);
    // }

    // document.addEventListener('livewire:load', function () {
    //     window.addEventListener('sectionUpdated', function (event) {
    //         const sectionId = event.detail.sectionId;
    //         showSection(sectionId, document.querySelector(`a[href="#${sectionId}"]`));
    //         updateButtonsVisibility();
    //     });
    // });

</script>

</main>

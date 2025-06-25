<!DOCTYPE html>
<html lang="en" x-data="{ mobileMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable LGU Homepage</title>
    
    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js for mobile menu interactivity -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Google Fonts from original design -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Merriweather:wght@400;700&family=Noto+Sans:400&family=Roboto:400&family=Source+Sans+Pro:400&display=swap" rel="stylesheet">
    
    <style>
        /* Original animations and styling */
        .animate-bg-overlay { opacity: 0; animation: fadeIn 1.5s ease-in-out forwards; }
        .animate-logo-slide { transform: translateX(-20px); opacity: 0; animation: slideIn 0.5s ease-in-out forwards; }
        .animate-nav-item { opacity: 0; transform: translateX(20px); animation: slideIn 0.5s ease-in-out forwards; animation-delay: calc(var(--index, 0) * 0.1s); }
        .animate-nav-subitem { opacity: 0; transform: translateX(10px); animation: slideIn 0.4s ease-in-out forwards; animation-delay: calc(var(--index, 0) * 0.1s); }
        .animate-hero-text { opacity: 0; transform: translateY(20px); }
        .animate-stat-item { opacity: 0; transform: scale(0.8); }
        .animate-footer-text { opacity: 0; transform: translateY(10px); }
        @keyframes fadeIn { to { opacity: 1; } }
        @keyframes slideIn { to { opacity: 1; transform: translateX(0); } }

        /* Styles for the editing functionality */
        .editable-container { position: relative; }
        
        /* Overlay for editable containers */
        .editable-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent black */
            opacity: 0; /* Hidden by default */
            transition: opacity 0.3s ease-in-out;
            z-index: 5; /* Below the edit button but above the content */
            pointer-events: none; /* Allows clicks to pass through */
            border-radius: inherit; /* Inherit border-radius if any */
        }

        .editable-container:hover::before {
            opacity: 1; /* Show on hover */
        }

        .editable-container .edit-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            opacity: 0;
            z-index: 10; /* Above the overlay */
            pointer-events: none; /* Allows hover to pass through to elements underneath */
        }
        .editable-container:hover .edit-button {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            pointer-events: auto; /* Make button clickable on hover */
        }
        
        /* MODERN MODAL STYLES */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7); /* Darker backdrop */
            backdrop-filter: blur(8px); /* More pronounced blur */
        }
        #modal-content {
            background-color: #ffffff; /* White background */
            border-radius: 1.5rem; /* Larger border-radius */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); /* Stronger shadow */
            padding: 2.5rem; /* More padding */
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
        }
        #modal-title {
            color: #1a202c; /* Darker text for formality */
            font-weight: 700; /* Bold font */
            font-size: 2rem; /* Larger font size */
        }
        .modal-body label {
            font-weight: 600; /* Semi-bold labels */
            color: #2d3748; /* Darker gray for labels */
        }
        .modal-body input[type="text"],
        .modal-body textarea,
        .modal-body input[type="file"] {
            border: 1px solid #cbd5e0; /* Subtle border */
            border-radius: 0.5rem; /* Rounded corners for inputs */
            padding: 0.75rem 1rem; /* More padding */
            transition: all 0.2s ease-in-out;
        }
        .modal-body input[type="text"]:focus,
        .modal-body textarea:focus {
            border-color: #3b82f6; /* Blue focus border */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); /* Blue focus ring */
        }

        /* Ensure edit button is visible on dark backgrounds */
        .edit-button {
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 8px 16px;
            border-radius: 9999px;
            font-weight: bold;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Main container with background -->
    <div id="main-container" class="relative min-h-screen bg-cover bg-center pt-24" style="background-image: url('https://images.unsplash.com/photo-1598993169346-638c53a73c1d?q=80&w=2070&auto=format&fit=crop');"> 	
        <!-- Background Overlay --> 	
        <div class="absolute inset-0 bg-gray-700/50 animate-bg-overlay"></div> 	
        
        <!-- Button to Change Background Image -->
        <div class="absolute top-5 right-5 z-19">
            <button data-edit-type="image" data-target-id="main-container" class="edit-trigger bg-white/20 hover:bg-white/40 text-white font-semibold py-2 px-4 rounded-lg shadow-md backdrop-blur-sm transition-all duration-300">
                Change Background
            </button>
        </div>

        <!-- Mobile Menu (Hidden by default, shown with Alpine.js) --> 	
        <div class="lg:hidden fixed inset-0 z-50 bg-black bg-opacity-75" x-cloak x-show="mobileMenuOpen" 	
            x-transition:enter="transition ease-in-out duration-300 transform" 	
            x-transition:enter-start="translate-x-full" 	
            x-transition:enter-end="translate-x-0" 	
            x-transition:leave="transition ease-in-out duration-300 transform" 	
            x-transition:leave-start="translate-x-0" 	
            x-transition:leave-end="translate-x-full"> 	
            <div class="fixed inset-y-0 right-0 w-3/4 max-w-sm bg-gray-900 p-6 shadow-lg"> 	
                <div class="flex justify-between items-center mb-6"> 	
                    <div class="flex items-center gap-2 editable-container"> 	
                        <img id="logo-image" src="https://placehold.co/100x100/ffffff/333333?text=Logo" alt="COREDEV Logo" class="h-10 w-auto animate-logo-slide">
                        <button class="edit-button edit-trigger" data-edit-type="image" data-target-id="logo-image">Edit</button> 	
                    </div> 	
                    <button type="button" class="text-gray-400 hover:text-white" @click="mobileMenuOpen = false"> 	
                        <span class="sr-only">Close menu</span> 	
                        <svg class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"> 	
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /> 	
                        </svg> 	
                    </button> 	
                </div> 	
                <nav class="flex flex-col gap-4">
                    <!-- Editable Nav links would require more complex JS, focusing on main content per request -->
                    <a href="#" class="block text-white text-lg font-normal font-['Questrial'] hover:text-amber-400 py-2 animate-nav-item">Home</a> 	
                    <!-- More nav items here -->
                    <div class="editable-container">
                        <a id="signin-button" href="#" class="block bg-amber-400 text-white text-lg font-normal font-['Segoe_UI'] py-2 px-8 rounded-[30px] text-center hover:bg-amber-500 transition-colors mt-4 animate-nav-item">Sign In</a>
                        <button class="edit-button edit-trigger" data-edit-type="button" data-target-id="signin-button">Edit</button>
                    </div>
                </nav> 	
            </div> 	
        </div> 	

        <!-- Hero Content --> 	
        <div class="relative z-10 flex flex-col items-end justify-center h-[calc(100vh-theme(spacing.24))] text-left px-4"> 	
            <div class="w-full max-w-4xl space-y-6 md:space-y-8 lg:space-y-10 pr-2 md:pr-8 lg:pr-16">
                <div class="editable-container">
                    <p id="hero-subtitle-1" class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Noto_Sans'] animate-hero-text" style="--delay: 0.2s">“DRIVEN BY INNOVATION</p>
                    <button class="edit-button edit-trigger" data-edit-type="text" data-target-id="hero-subtitle-1">Edit</button>
                </div>
                <div class="editable-container">
                    <h1 id="hero-main-title" class="text-white text-6xl md:text-7xl lg:text-7xl font-bold font-['Merriweather'] leading-tight animate-hero-text" style="--delay: 0.4s">Local Government Unit</h1>
                    <button class="edit-button edit-trigger" data-edit-type="text" data-target-id="hero-main-title">Edit</button>
                </div>
                <div class="editable-container">
                    <p id="hero-paragraph" class="text-white text-2xl md:text-3xl lg:text-4xl font-normal font-['Roboto'] animate-hero-text" style="--delay: 0.6s">Serving the community with <span class="text-amber-400">transparency</span>, <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.</p>
                    <button class="edit-button edit-trigger" data-edit-type="text" data-target-id="hero-paragraph">Edit</button>
                </div>
                <div class="editable-container">
                    <p id="hero-subtitle-2" class="text-white text-lg md:text-xl lg:text-2xl font-normal font-['Source_Sans_Pro'] animate-hero-text" style="--delay: 0.8s"><span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES</p>
                    <button class="edit-button edit-trigger" data-edit-type="text" data-target-id="hero-subtitle-2">Edit</button>
                </div>
            </div> 	
        </div> 	

        <!-- Bottom Bar with Statistics --> 	
        <div id="bottom-stats-bar" class="relative z-10 w-full bg-zinc-500/20 shadow-md py-4 md:py-6 lg:py-8 px-4 sm:px-8 lg:px-16 mt-auto editable-container"> 	
            <div class="flex flex-col sm:flex-row justify-around items-center gap-6 md:gap-12 lg:gap-24"> 	
                <!-- Stat Item 1 -->
                <div id="stat-item-1" class="text-center animate-stat-item" style="--delay: 0.2s"> 	
                    <div id="stat-1-number" class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">24</div> 	
                    <div id="stat-1-label" class="text-white text-sm md:text-lg font-light font-['Merriweather']">Barangay</div>
                </div> 	
                <!-- Stat Item 2 -->
                <div id="stat-item-2" class="text-center animate-stat-item" style="--delay: 0.4s"> 	
                    <div id="stat-2-number" class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">1500+</div> 	
                    <div id="stat-2-label" class="text-white text-sm md:text-lg font-light font-['Merriweather']">Residents</div>
                </div> 	
                <!-- Stat Item 3 -->
                <div id="stat-item-3" class="text-center animate-stat-item" style="--delay: 0.6s"> 	
                    <div id="stat-3-number" class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">120+</div> 	
                    <div id="stat-3-label" class="text-white text-sm md:text-lg font-light font-['Merriweather']">Public Projects</div> 	
                </div> 	
                <!-- Stat Item 4 -->
                <div id="stat-item-4" class="text-center animate-stat-item" style="--delay: 0.8s"> 	
                    <div id="stat-4-number" class="text-white text-3xl md:text-4xl font-bold font-['Merriweather']">75</div> 	
                    <div id="stat-4-label" class="text-white text-sm md:text-lg font-light font-['Merriweather']">Years of Service</div>
                </div> 	
            </div> 	
            <button class="edit-button edit-trigger" data-edit-type="all-stats" data-target-id="bottom-stats-bar">Edit All Statistics</button>
            <div class="w-full h-px bg-white/50 my-6"></div> 	
            <div class="editable-container">
                <p id="footer-paragraph" class="relative z-10 w-full text-center text-white text-xs md:text-sm lg:text-base font-normal font-['Questrial'] px-4 md:px-8 lg:px-16 animate-footer-text">Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.</p>
                <button class="edit-button edit-trigger" data-edit-type="text" data-target-id="footer-paragraph">Edit</button>
            </div>
        </div> 	
    </div>
    
    <!-- Editing Modal -->
    <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop hidden">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modal-title" class="text-2xl font-bold text-gray-800">Edit Content</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div id="modal-body" class="space-y-4">
                    <!-- Form content will be injected here by JavaScript -->
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button id="cancel-button" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition-all">Cancel</button>
                    <button id="save-button" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition-all">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Original animation script
        document.addEventListener('DOMContentLoaded', () => { 	
            const heroItems = document.querySelectorAll('.animate-hero-text'); 	
            const statItems = document.querySelectorAll('.animate-stat-item'); 	
            const footerText = document.querySelector('.animate-footer-text'); 	
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        if(entry.target.classList.contains('animate-stat-item')) {
                            entry.target.style.transform = 'scale(1)';
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            heroItems.forEach((item, index) => {
                item.style.transitionDelay = `${index * 200}ms`;
                observer.observe(item);
            });

            statItems.forEach((item, index) => {
                item.style.transitionDelay = `${index * 200}ms`;
                observer.observe(item);
            });

            if (footerText) {
                footerText.style.transitionDelay = '400ms';
                observer.observe(footerText);
            }
        });

        // Editing functionality script
        document.addEventListener('DOMContentLoaded', () => {
            // Modal elements
            const modal = document.getElementById('edit-modal');
            const modalContent = document.getElementById('modal-content');
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');
            const closeModalButton = document.getElementById('close-modal');
            const saveButton = document.getElementById('save-button');
            const cancelButton = document.getElementById('cancel-button');
            const editTriggers = document.querySelectorAll('.edit-trigger');

            let currentTargetElement = null;
            
            const loadContent = () => {
                editTriggers.forEach(trigger => {
                    const targetId = trigger.dataset.targetId;
                    const element = document.getElementById(targetId);
                    const savedValue = localStorage.getItem(targetId);

                    if (savedValue && element) {
                        const editType = trigger.dataset.editType;
                        switch(editType) {
                            case 'text':
                            case 'button':
                                element.innerHTML = savedValue; // Use innerHTML to preserve spans
                                break;
                            case 'image':
                                if (targetId === 'main-container') {
                                    element.style.backgroundImage = `url('${savedValue}')`;
                                } else {
                                    element.src = savedValue;
                                }
                                break;
                            // The stat-item and all-stats cases don't directly load from a single localStorage item in this way,
                            // but their children elements (number and label) will handle their own loading.
                            // We explicitly fetch and set them in openModal and saveChanges.
                        }
                    }
                });
                // Load saved values for individual number and label elements for stats
                for (let i = 1; i <= 4; i++) {
                    const numberId = `stat-${i}-number`;
                    const labelId = `stat-${i}-label`;
                    const numberElement = document.getElementById(numberId);
                    const labelElement = document.getElementById(labelId);

                    const savedNumber = localStorage.getItem(numberId);
                    const savedLabel = localStorage.getItem(labelId);

                    if (savedNumber && numberElement) {
                        numberElement.textContent = savedNumber;
                    }
                    if (savedLabel && labelElement) {
                        labelElement.textContent = savedLabel;
                    }
                }
            };

            const openModal = (e) => {
                e.stopPropagation(); // Prevent event bubbling
                const triggerButton = e.currentTarget;
                const editType = triggerButton.dataset.editType;
                const targetId = triggerButton.dataset.targetId;
                currentTargetElement = document.getElementById(targetId);

                if (!currentTargetElement) return;
                
                modalBody.innerHTML = '';
                
                switch(editType) {
                    case 'text':
                    case 'button':
                        modalTitle.textContent = 'Edit Text';
                        // Use innerHTML to correctly handle text with HTML tags like <span>
                        modalBody.innerHTML = `<label for="text-input" class="block text-sm font-medium text-gray-700">Content</label><textarea id="text-input" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">${currentTargetElement.innerHTML}</textarea>`;
                        break;
                    case 'image':
                        modalTitle.textContent = 'Change Image';
                        const imgSrc = currentTargetElement.id === 'main-container' ? '' : currentTargetElement.src;
                        modalBody.innerHTML = `<label for="image-input" class="block text-sm font-medium text-gray-700">Upload new image</label><input type="file" id="image-input" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/><img id="image-preview" src="${imgSrc}" class="mt-4 rounded-lg max-h-48 w-auto ${!imgSrc || currentTargetElement.id === 'main-container' ? 'hidden' : ''}" />`;
                        document.getElementById('image-input').addEventListener('change', (event) => {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const preview = document.getElementById('image-preview');
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        });
                        break;
                    case 'all-stats':
                        modalTitle.textContent = 'Edit All Statistics';
                        let statInputsHtml = '';
                        for (let i = 1; i <= 4; i++) {
                            const numberElement = document.getElementById(`stat-${i}-number`);
                            const labelElement = document.getElementById(`stat-${i}-label`);
                            statInputsHtml += `
                                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-2 sm:space-y-0 sm:space-x-4 mb-4 p-3 bg-gray-50 rounded-lg">
                                    <h4 class="text-lg font-semibold text-gray-800 sm:w-1/4">Stat ${i}</h4>
                                    <div class="flex-grow flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                                        <div class="w-full sm:w-1/2">
                                            <label for="stat-${i}-number-input" class="block text-sm font-medium text-gray-700">Number</label>
                                            <input type="text" id="stat-${i}-number-input" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="${numberElement ? numberElement.textContent : ''}">
                                        </div>
                                        <div class="w-full sm:w-1/2">
                                            <label for="stat-${i}-label-input" class="block text-sm font-medium text-gray-700">Label</label>
                                            <input type="text" id="stat-${i}-label-input" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="${labelElement ? labelElement.textContent : ''}">
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        modalBody.innerHTML = statInputsHtml;
                        break;
                }
                modal.classList.remove('hidden');
                setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
            };
            
            const closeModal = () => {
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => modal.classList.add('hidden'), 300);
            };

            const saveChanges = () => {
                if (!currentTargetElement) return;

                const editType = document.querySelector(`[data-target-id="${currentTargetElement.id}"]`).dataset.editType;
                
                switch(editType) {
                    case 'text':
                    case 'button':
                        const newValue = document.getElementById('text-input').value;
                        currentTargetElement.innerHTML = newValue; // Use innerHTML
                        localStorage.setItem(currentTargetElement.id, newValue);
                        break;
                    case 'image':
                        const fileInput = document.getElementById('image-input');
                        if (fileInput.files && fileInput.files[0]) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const newImageSrc = e.target.result;
                                if (currentTargetElement.id === 'main-container') {
                                    currentTargetElement.style.backgroundImage = `url('${newImageSrc}')`;
                                } else {
                                    currentTargetElement.src = newImageSrc;
                                }
                                localStorage.setItem(currentTargetElement.id, newImageSrc);
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        }
                        break;
                    case 'all-stats':
                        for (let i = 1; i <= 4; i++) {
                            const newNumber = document.getElementById(`stat-${i}-number-input`).value;
                            const newLabel = document.getElementById(`stat-${i}-label-input`).value;

                            const targetNumberElement = document.getElementById(`stat-${i}-number`);
                            const targetLabelElement = document.getElementById(`stat-${i}-label`);

                            if (targetNumberElement) {
                                targetNumberElement.textContent = newNumber;
                                localStorage.setItem(targetNumberElement.id, newNumber);
                            }
                            if (targetLabelElement) {
                                targetLabelElement.textContent = newLabel;
                                localStorage.setItem(targetLabelElement.id, newLabel);
                            }
                        }
                        break;
                }
                closeModal();
            };

            // --- EVENT LISTENERS ---
            loadContent();
            editTriggers.forEach(button => button.addEventListener('click', openModal));
            closeModalButton.addEventListener('click', closeModal);
            cancelButton.addEventListener('click', closeModal);
            saveButton.addEventListener('click', saveChanges);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        });
    </script>
</body>
</html>

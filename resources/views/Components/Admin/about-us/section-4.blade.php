<div class="gradient-background">
    <div class="absolute inset-0 bg-gradient-to-l from-zinc-800/0 via-black to-black animate-gradient-shift z-0"></div>
    <div class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-b from-neutral-50/75 via-neutral-400 to-neutral-500 z-0"></div>
    <div class="absolute bottom-[132px] left-0 w-full h-36 bg-gradient-to-b from-neutral-50/75 via-neutral-400/50 to-neutral-500/50 z-0"></div>
    <div class="absolute bottom-[264px] left-0 w-full h-36 bg-gradient-to-b from-white/0 via-zinc-300/50 to-zinc-300 z-0"></div>
    <div class="gradient-overlay"></div>
    <div class="gradient-bottom"></div>

    <div id="particle-container"></div>

    <div class="content-wrapper">
        <div class="header-container relative">
            <div class="header-shapes">
                <div class="shape-left"></div>
                <div class="header-text">
                    {{-- Removed contenteditable="true" from the title --}}
                    <h1 class="header-title animate-header" id="mainTitle">
                        <span>Meet</span>
                        <span>The Developers Behind CoreDev</span>
                    </h1>
                    {{-- Removed contenteditable="true" from the paragraph --}}
                    <p class="mb-[50px] text-white" id="mainParagraph">
                        Our dedicated team built this platform with care, innovation, and community in mind.
                        Each member brings unique expertise to create an exceptional experience.
                    </p>
                </div>
                <div class="shape-right"></div>
            </div>
        </div>

        <div class="developers-grid" id="developersGrid">
            @foreach($developers as $developer)
                <div class="developer-card" data-id="{{ $developer->id }}">
                    <div class="card-actions absolute top-2 right-2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                        <button class="edit-developer-btn w-8 h-8 flex items-center justify-center bg-transparent-600 text-white rounded-full shadow-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition-all duration-200" title="Edit Developer">
                            <i class="fas fa-edit text-sm"></i>
                        </button>
                        <button class="delete-developer-btn w-8 h-8 flex items-center justify-center bg-transparent-600 text-white rounded-full shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-200" title="Delete Developer">
                            <i class="fas fa-trash-alt text-sm"></i>
                        </button>
                    </div>
                    <img src="{{ $developer->image_url ? asset('storage/' . $developer->image_url) : 'https://via.placeholder.com/700x700/cccccc/000000?text=No+Image' }}" alt="{{ $developer->role }}" class="card-image developer-image">
                    <div class="card-overlay">
                        <div class="card-role developer-role">{{ $developer->role }}</div>
                        <div class="card-name developer-name">{{ $developer->name }}</div>
                        <p class="card-desc developer-desc">{{ $developer->description }}</p>
                        <div class="social-links developer-social-links">
                            @if($developer->social_links)
                                @foreach($developer->social_links as $link)
                                    <a href="{{ $link['url'] }}" class="social-link" data-icon="{{ $link['icon'] }}" data-url="{{ $link['url'] }}" target="_blank"><i class="{{ $link['icon'] }}"></i></a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="developer-card add-developer-card flex items-center justify-center cursor-pointer hover:bg-transparent-800 transition-colors duration-300" id="addDeveloperCard">
                <div class="text-center text-white">
                    <i class="fas fa-plus-circle text-5xl mb-2"></i>
                    <p class="text-lg font-semibold">Add New Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="developerModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 opacity-0" id="developerModalContent">
        <h2 class="text-3xl font-extrabold mb-6 text-white text-center" id="developerModalTitle">Add New Developer</h2>
        <input type="hidden" id="currentDeveloperId">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4 md:mb-0">
                <label for="devName" class="block text-gray-300 text-sm font-semibold mb-2">Developer Name:</label>
                <input type="text" id="devName" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="e.g., Jane Doe">
            </div>
            <div class="mb-4 md:mb-0">
                <label for="devRole" class="block text-gray-300 text-sm font-semibold mb-2">Role:</label>
                <input type="text" id="devRole" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 placeholder-gray-400" placeholder="e.g., Lead Developer">
            </div>
        </div>

        <div class="mt-6 mb-4">
            <label for="devDesc" class="block text-gray-300 text-sm font-semibold mb-2">Description:</label>
            <textarea id="devDesc" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 placeholder-gray-400 h-32 resize-y" placeholder="A brief description of the developer..."></textarea>
        </div>

        <div class="mb-6">
            <label for="devImage" class="block text-gray-300 text-sm font-semibold mb-2">Image Upload:</label>
            <input type="file" id="devImage" accept="image/*" class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-600 file:text-white hover:file:bg-orange-700">
            <p class="text-gray-400 text-xs italic mt-2">Upload a new image. Leave blank to keep current image for existing developer.</p>
        </div>

        <div class="mb-6">
            <label class="block text-gray-300 text-sm font-semibold mb-2">Social Links:</label>
            <div id="socialLinksContainer" class="space-y-3">
                </div>
            <button id="addSocialLinkBtn" class="mt-4 bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition-colors duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Social Link
            </button>
        </div>

        <div class="flex justify-end space-x-3">
            <button id="cancelDeveloperBtn" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors duration-200">Cancel</button>
            <button id="saveDeveloperBtn" class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-opacity-50 transition-colors duration-200">Save Developer</button>
        </div>
    </div>
</div>

<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-sm text-center transform transition-all duration-300 scale-95 opacity-0" id="confirmationModalContent">
        <h3 class="text-2xl font-bold mb-4 text-white">Confirm Deletion</h3>
        <p class="text-gray-300 mb-8">Are you sure you want to delete this developer profile? This action cannot be undone.</p>
        <div class="flex justify-center space-x-4">
            <button id="cancelDeleteBtn" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors duration-200">Cancel</button>
            <button id="confirmDeleteBtn" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors duration-200">Delete</button>
        </div>
    </div>
</div>

<div id="customAlertModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-[9999] hidden p-4">
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-sm text-center transform transition-all duration-300 scale-95 opacity-0" id="customAlertModalContent">
        <h3 class="text-2xl font-bold mb-4 text-white">Message</h3>
        <p class="text-gray-300 mb-8" id="customAlertMessage"></p>
        <button id="customAlertOkBtn" class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition-colors duration-200">OK</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CSRF Token for Laravel AJAX requests
        // Ensure this meta tag exists in your main layout file (e.g., layouts/admin.blade.php or app.blade.php)
        // <meta name="csrf-token" content="{{ csrf_token() }}">
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

        // Create particles (existing code, no changes needed for dynamic data)
        const particleContainer = document.getElementById('particle-container');
        const particleCount = 80;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.borderRadius = '50%';
            particle.style.backgroundColor = '#f97316';
            particle.style.opacity = Math.random() * 0.3 + 0.1;
            particle.style.width = Math.random() * 5 + 1 + 'px';
            particle.style.height = particle.style.width;
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.zIndex = '1';
            particle.style.pointerEvents = 'none';

            const duration = Math.random() * 10 + 10;
            particle.style.animation = `particleFloat ${duration}s infinite ease-in-out`;
            particle.style.animationDelay = Math.random() * 5 + 's';

            particleContainer.appendChild(particle);
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes particleFloat {
                0% { transform: translate(0, 0); }
                25% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                50% { transform: translate(${Math.random()*15 - 7.5}px, ${Math.random()*15 - 7.5}px); }
                75% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                100% { transform: translate(0, 0); }
            }
            .developer-card .card-actions {
                transition: opacity 0.3s ease-in-out;
            }
            .developer-card:hover .card-actions {
                opacity: 1;
            }
        `;
        document.head.appendChild(style);

        // Card animation on scroll (existing code, will apply to dynamically loaded cards)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe initially loaded cards
        document.querySelectorAll('.developer-card').forEach(card => {
            observer.observe(card);
        });

        // --- Header Title and Paragraph Editing ---
        // The contenteditable attributes have been removed from the HTML.
        // Therefore, the following JavaScript lines are no longer necessary
        // as the elements are static.
        // const mainTitle = document.getElementById('mainTitle');
        // const mainParagraph = document.getElementById('mainParagraph');


        // --- Developer Add/Edit/Delete Functionality ---

        const addDeveloperCard = document.getElementById('addDeveloperCard');
        const developerModal = document.getElementById('developerModal');
        const developerModalContent = document.getElementById('developerModalContent');
        const developerModalTitle = document.getElementById('developerModalTitle');
        const currentDeveloperIdInput = document.getElementById('currentDeveloperId');
        const saveDeveloperBtn = document.getElementById('saveDeveloperBtn');
        const cancelDeveloperBtn = document.getElementById('cancelDeveloperBtn');
        const devNameInput = document.getElementById('devName');
        const devRoleInput = document.getElementById('devRole');
        const devDescInput = document.getElementById('devDesc');
        const devImageInput = document.getElementById('devImage');
        const socialLinksContainer = document.getElementById('socialLinksContainer');
        const addSocialLinkBtn = document.getElementById('addSocialLinkBtn');
        const developersGrid = document.getElementById('developersGrid');

        const confirmationModal = document.getElementById('confirmationModal');
        const confirmationModalContent = document.getElementById('confirmationModalContent');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        let developerToDeleteId = null; // To store the ID of the developer to be deleted

        // Function to create a social link input group
        function createSocialLinkInput(iconValue = '', urlValue = '') {
            const socialLinkDiv = document.createElement('div');
            socialLinkDiv.className = 'flex items-center space-x-3 social-link-group'; // Adjusted spacing
            socialLinkDiv.innerHTML = `
                <select class="w-1/3 px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 social-icon-select">
                    <option value="fab fa-linkedin" ${iconValue === 'fab fa-linkedin' ? 'selected' : ''}>LinkedIn</option>
                    <option value="fas fa-globe" ${iconValue === 'fas fa-globe' ? 'selected' : ''}>Website</option>
                    <option value="fab fa-github" ${iconValue === 'fab fa-github' ? 'selected' : ''}>GitHub</option>
                    <option value="fab fa-medium" ${iconValue === 'fab fa-medium' ? 'selected' : ''}>Medium</option>
                    <option value="fab fa-twitter" ${iconValue === 'fab fa-twitter' ? 'selected' : ''}>Twitter</option>
                    <option value="fab fa-dribbble" ${iconValue === 'fab fa-dribbble' ? 'selected' : ''}>Dribbble</option>
                    <option value="fab fa-behance" ${iconValue === 'fab fa-behance' ? 'selected' : ''}>Behance</option>
                    <option value="fab fa-instagram" ${iconValue === 'fab fa-instagram' ? 'selected' : ''}>Instagram</option>
                </select>
                <input type="url" placeholder="Social Link URL" value="${urlValue}" class="w-2/3 px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:outline-none transition duration-200 social-link-input placeholder-gray-400">
                <button type="button" class="remove-social-link-btn w-8 h-8 flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white rounded-full shadow-md text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors duration-200 flex-shrink-0">
                    <i class="fas fa-times"></i>
                </button>
            `;
            socialLinksContainer.appendChild(socialLinkDiv);

            socialLinkDiv.querySelector('.remove-social-link-btn').addEventListener('click', () => {
                socialLinkDiv.remove();
            });
        }

        // Function to render/update a developer card in the DOM
        function renderDeveloperCard(developerData, isNew = false) {
            let cardElement;
            if (isNew) {
                cardElement = document.createElement('div');
                cardElement.className = 'developer-card group relative overflow-hidden rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105'; // Added group for hover effect
                developersGrid.insertBefore(cardElement, addDeveloperCard);
                observer.observe(cardElement); // Observe new card for animation
            } else {
                cardElement = document.querySelector(`.developer-card[data-id="${developerData.id}"]`);
                if (!cardElement) return; // Should not happen if updating existing
            }

            cardElement.dataset.id = developerData.id;

            let socialLinksHtml = '';
            if (developerData.social_links) {
                socialLinksHtml = developerData.social_links.map(link => `
                    <a href="${link.url}" class="social-link text-white hover:text-orange-400 transition-colors duration-200" data-icon="${link.icon}" data-url="${link.url}" target="_blank"><i class="${link.icon} text-lg"></i></a>
                `).join('');
            }

            // Ensure the image URL is correctly formed for existing images
            const imageUrl = developerData.image_url ? `{{ asset('storage') }}/${developerData.image_url}` : 'https://via.placeholder.com/700x700/cccccc/000000?text=No+Image';

            cardElement.innerHTML = `
                <div class="card-actions absolute top-2 right-2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <button class="edit-developer-btn w-8 h-8 flex items-center justify-center bg-orange-600 text-white rounded-full shadow-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition-all duration-200" title="Edit Developer">
                        <i class="fas fa-edit text-sm"></i>
                    </button>
                    <button class="delete-developer-btn w-8 h-8 flex items-center justify-center bg-gray-600 text-white rounded-full shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-200" title="Delete Developer">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </div>
                <img src="${imageUrl}" alt="${developerData.role}" class="card-image developer-image w-full h-full object-cover">
                <div class="card-overlay absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent p-6 flex flex-col justify-end text-white transition-opacity duration-300 opacity-0 hover:opacity-100">
                    <div class="card-role developer-role text-sm font-light text-orange-400 mb-1">${developerData.role}</div>
                    <div class="card-name developer-name text-2xl font-bold mb-2">${developerData.name}</div>
                    <p class="card-desc developer-desc text-gray-300 text-sm mb-4 line-clamp-3">${developerData.description}</p>
                    <div class="social-links developer-social-links flex space-x-4">
                        ${socialLinksHtml}
                    </div>
                </div>
            `;
        }

        // --- Modal show/hide animations ---
        function showModal(modalElement, contentElement) {
            modalElement.classList.remove('hidden');
            setTimeout(() => {
                contentElement.classList.remove('scale-95', 'opacity-0');
                contentElement.classList.add('scale-100', 'opacity-100');
            }, 50); // Small delay for transition to apply
        }

        function hideModal(modalElement, contentElement) {
            contentElement.classList.remove('scale-100', 'opacity-100');
            contentElement.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modalElement.classList.add('hidden');
            }, 300); // Wait for transition to finish
        }

        // Add New Developer card click handler
        addDeveloperCard.addEventListener('click', () => {
            developerModalTitle.innerText = 'Add New Developer';
            currentDeveloperIdInput.value = ''; // Indicate adding new
            devNameInput.value = '';
            devRoleInput.value = '';
            devDescInput.value = '';
            devImageInput.value = ''; // Clear file input
            socialLinksContainer.innerHTML = ''; // Clear social links
            showModal(developerModal, developerModalContent);
        });

        // Edit Developer button click handler (delegated)
        developersGrid.addEventListener('click', (event) => {
            const editButton = event.target.closest('.edit-developer-btn');
            if (editButton) {
                const card = editButton.closest('.developer-card');
                const developerId = card.dataset.id;

                developerModalTitle.innerText = 'Edit Developer';
                currentDeveloperIdInput.value = developerId;

                devNameInput.value = card.querySelector('.developer-name').innerText.trim();
                devRoleInput.value = card.querySelector('.developer-role').innerText.trim();
                devDescInput.value = card.querySelector('.developer-desc').innerText.trim();
                devImageInput.value = ''; // Clear file input for security/re-upload
                socialLinksContainer.innerHTML = ''; // Clear and re-populate social links

                card.querySelectorAll('.developer-social-links .social-link').forEach(link => {
                    const icon = link.dataset.icon;
                    const url = link.dataset.url;
                    createSocialLinkInput(icon, url);
                });

                showModal(developerModal, developerModalContent);
            }

            // Delete Developer button click handler (delegated)
            const deleteButton = event.target.closest('.delete-developer-btn');
            if (deleteButton) {
                const card = deleteButton.closest('.developer-card');
                developerToDeleteId = card.dataset.id;
                showModal(confirmationModal, confirmationModalContent);
            }
        });

        addSocialLinkBtn.addEventListener('click', () => createSocialLinkInput());

        saveDeveloperBtn.addEventListener('click', async () => {
            const devId = currentDeveloperIdInput.value;
            const devName = devNameInput.value.trim();
            const devRole = devRoleInput.value.trim();
            const devDesc = devDescInput.value.trim();
            const devImageFile = devImageInput.files[0];
            const socialLinks = [];

            socialLinksContainer.querySelectorAll('.social-link-group').forEach(group => {
                const iconSelect = group.querySelector('.social-icon-select');
                const urlInput = group.querySelector('.social-link-input');
                if (urlInput.value.trim() !== '') {
                    socialLinks.push({
                        icon: iconSelect.value,
                        url: urlInput.value.trim()
                    });
                }
            });

            if (!devName || !devRole || !devDesc) {
                showCustomAlert('Please fill in all required developer details (Name, Role, Description).');
                return;
            }

            const formData = new FormData();
            formData.append('name', devName);
            formData.append('role', devRole);
            formData.append('description', devDesc);
            formData.append('social_links', JSON.stringify(socialLinks)); // Send as JSON string

            if (devImageFile) {
                formData.append('image', devImageFile);
            }

            // *** IMPORTANT CHANGE HERE: Add '/admin' prefix to the URL ***
            let url = '/admin/developers';
            let method = 'POST';

            if (devId) {
                // *** IMPORTANT CHANGE HERE: Add '/admin' prefix to the URL ***
                url = `/admin/developers/${devId}`;
                method = 'POST'; // Laravel uses POST for PUT/PATCH with _method field
                formData.append('_method', 'PUT'); // Spoof PUT request
            }

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                });

                const result = await response.json();

                if (response.ok) {
                    if (devId) {
                        // Update existing card in DOM
                        renderDeveloperCard(result.developer, false);
                        showCustomAlert(result.message);
                    } else {
                        // Add new card to DOM
                        renderDeveloperCard(result.developer, true);
                        showCustomAlert(result.message);
                    }
                    hideModal(developerModal, developerModalContent);
                } else {
                    console.error('Error:', result.errors || result.message);
                    let errorMessage = 'An error occurred. Please try again.';
                    if (result.errors) {
                        errorMessage = Object.values(result.errors).flat().join('\n');
                    } else if (result.message) {
                        errorMessage = result.message;
                    }
                    showCustomAlert('Error saving developer:\n' + errorMessage);
                }
            } catch (error) {
                console.error('Network error:', error);
                showCustomAlert('A network error occurred. Please check your connection.');
            }
        });

        cancelDeveloperBtn.addEventListener('click', () => {
            hideModal(developerModal, developerModalContent);
        });

        // Confirmation modal handlers
        confirmDeleteBtn.addEventListener('click', async () => {
            if (developerToDeleteId) {
                try {
                    // *** IMPORTANT CHANGE HERE: Add '/admin' prefix to the URL ***
                    const response = await fetch(`/admin/developers/${developerToDeleteId}`, {
                        method: 'POST', // Laravel uses POST for DELETE with _method field
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            '_method': 'DELETE' // Spoof DELETE request
                        },
                    });

                    const result = await response.json();

                    if (response.ok) {
                        document.querySelector(`.developer-card[data-id="${developerToDeleteId}"]`).remove();
                        showCustomAlert(result.message);
                    } else {
                        console.error('Error:', result.message);
                        showCustomAlert('Error deleting developer: ' + result.message);
                    }
                } catch (error) {
                    console.error('Network error:', error);
                    showCustomAlert('A network error occurred during deletion.');
                } finally {
                    hideModal(confirmationModal, confirmationModalContent);
                    developerToDeleteId = null;
                }
            }
        });

        cancelDeleteBtn.addEventListener('click', () => {
            hideModal(confirmationModal, confirmationModalContent);
            developerToDeleteId = null;
        });

        // Custom Alert/Message Box (replaces alert())
        const customAlertModal = document.getElementById('customAlertModal');
        const customAlertModalContent = document.getElementById('customAlertModalContent');
        const customAlertMessage = document.getElementById('customAlertMessage');
        const customAlertOkBtn = document.getElementById('customAlertOkBtn');

        function showCustomAlert(message) {
            customAlertMessage.innerText = message;
            showModal(customAlertModal, customAlertModalContent);
        }

        customAlertOkBtn.addEventListener('click', () => {
            hideModal(customAlertModal, customAlertModalContent);
        });
    });
</script>
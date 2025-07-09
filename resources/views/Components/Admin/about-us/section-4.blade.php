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
                    <h1 class="header-title animate-header" id="mainTitle" contenteditable="true">
                        <span>Meet</span>
                        <span>The Developers Behind CoreDev</span>
                    </h1>
                    <p class="mb-[50px]" id="mainParagraph" contenteditable="true">
                        Our dedicated team built this platform with care, innovation, and community in mind.
                        Each member brings unique expertise to create an exceptional experience.
                    </p>
                </div>
                <div class="shape-right"></div>
            </div>
        </div>

        <div class="developers-grid" id="developersGrid">
            <div class="developer-card" data-id="1">
                <button class="edit-developer-btn absolute top-2 right-2 z-10 p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                    <i class="fas fa-edit"></i>
                </button>
                <img src="{{ asset('storage/jasper.jpg') }}" alt="Front-end Developer" class="card-image developer-image">
                <div class="card-overlay">
                    <div class="card-role developer-role">Front-end Developer</div>
                    <div class="card-name developer-name">Jaspher Lawrence Siloy</div>
                    <p class="card-desc developer-desc">
                        Creates UI designs and transforms ideas into clean, responsive, and engaging user interfaces.
                    </p>
                    <div class="social-links developer-social-links">
                        <a href="#" class="social-link" data-icon="fab fa-linkedin" data-url="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link" data-icon="fas fa-globe" data-url="#"><i class="fas fa-globe"></i></a>
                        <a href="#" class="social-link" data-icon="fab fa-github" data-url="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <div class="developer-card" data-id="2">
                <button class="edit-developer-btn absolute top-2 right-2 z-10 p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                    <i class="fas fa-edit"></i>
                </button>
                <img src="{{ asset('storage/janpaul.jpg') }}" alt="Lead Developer" class="card-image developer-image">
                <div class="card-overlay">
                    <div class="card-role developer-role">Lead Developer</div>
                    <div class="card-name developer-name">Jan Paul Bustillo</div>
                    <p class="card-desc developer-desc">
                        Responsible for system architecture, backend integration, and performance optimization.
                    </p>
                    <div class="social-links developer-social-links">
                        <a href="#" class="social-link" data-icon="fab fa-github" data-url="#"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link" data-icon="fab fa-medium" data-url="#"><i class="fab fa-medium"></i></a>
                        <a href="#" class="social-link" data-icon="fab fa-twitter" data-url="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="developer-card" data-id="3">
                <button class="edit-developer-btn absolute top-2 right-2 z-10 p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                    <i class="fas fa-edit"></i>
                </button>
                <img src="{{ asset('storage/kerstan.jpg') }}" alt="Front-end Developer" class="card-image developer-image">
                <div class="card-overlay">
                    <div class="card-role developer-role">Front-end Developer</div>
                    <div class="card-name developer-name">Kerstan Davide</div>
                    <p class="card-desc developer-desc">
                        Transforms complex requirements into intuitive, accessible, and visually appealing interfaces.
                    </p>
                    <div class="social-links developer-social-links">
                        <a href="#" class="social-link" data-icon="fab fa-dribbble" data-url="#"><i class="fab fa-dribbble"></i></a>
                        <a href="#" class="social-link" data-icon="fab fa-behance" data-url="#"><i class="fab fa-behance"></i></a>
                        <a href="#" class="social-link" data-icon="fab fa-instagram" data-url="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="developer-card add-developer-card flex items-center justify-center cursor-pointer hover:bg-gray-800 transition-colors duration-300" id="addDeveloperCard">
                <div class="text-center text-white">
                    <i class="fas fa-plus-circle text-5xl mb-2"></i>
                    <p class="text-lg font-semibold">Add New Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="developerModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-900 p-8 rounded-lg shadow-xl w-11/12 md:w-2/3 lg:w-1/2">
        <h2 class="text-2xl font-bold mb-4 text-white" id="developerModalTitle">Add New Developer</h2>
        <input type="hidden" id="currentDeveloperId">
        <div class="mb-4">
            <label for="devName" class="block text-gray-300 text-sm font-bold mb-2">Developer Name:</label>
            <input type="text" id="devName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 text-white">
        </div>
        <div class="mb-4">
            <label for="devRole" class="block text-gray-300 text-sm font-bold mb-2">Role:</label>
            <input type="text" id="devRole" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 text-white">
        </div>
        <div class="mb-4">
            <label for="devDesc" class="block text-gray-300 text-sm font-bold mb-2">Description:</label>
            <textarea id="devDesc" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 text-white h-24"></textarea>
        </div>
        <div class="mb-4">
            <label for="devImage" class="block text-gray-300 text-sm font-bold mb-2">Image URL:</label>
            <input type="file" id="devImage" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 leading-tight focus:outline-none focus:shadow-outline bg-gray-700">
            <p class="text-gray-400 text-xs italic mt-1">Leave blank to keep current image or for new developer.</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2">Social Links:</label>
            <div id="socialLinksContainer">
            </div>
            <button id="addSocialLinkBtn" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded text-sm focus:outline-none focus:shadow-outline">Add Social Link</button>
        </div>
        <div class="flex justify-end">
            <button id="saveDeveloperBtn" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Save Developer</button>
            <button id="cancelDeveloperBtn" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create particles
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

            // Animation
            const duration = Math.random() * 10 + 10;
            particle.style.animation = `particleFloat ${duration}s infinite ease-in-out`;
            particle.style.animationDelay = Math.random() * 5 + 's';

            particleContainer.appendChild(particle);
        }

        // Add CSS for particle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes particleFloat {
                0% { transform: translate(0, 0); }
                25% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                50% { transform: translate(${Math.random()*15 - 7.5}px, ${Math.random()*15 - 7.5}px); }
                75% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                100% { transform: translate(0, 0); }
            }
        `;
        document.head.appendChild(style);

        // Card animation on scroll
        const cards = document.querySelectorAll('.developer-card');

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

        // Initial observation for existing cards
        cards.forEach(card => {
            observer.observe(card);
        });

        // --- Header Title and Paragraph Editing ---
        const mainTitle = document.getElementById('mainTitle');
        const mainParagraph = document.getElementById('mainParagraph');

        // Restore saved content if available (for persistence across sessions)
        const savedTitle = localStorage.getItem('mainTitleContent');
        if (savedTitle) {
            mainTitle.innerHTML = savedTitle;
        }

        const savedParagraph = localStorage.getItem('mainParagraphContent');
        if (savedParagraph) {
            mainParagraph.innerHTML = savedParagraph;
        }

        // Save content when focus is lost (user finishes editing)
        mainTitle.addEventListener('blur', () => {
            localStorage.setItem('mainTitleContent', mainTitle.innerHTML);
        });

        mainParagraph.addEventListener('blur', () => {
            localStorage.setItem('mainParagraphContent', mainParagraph.innerHTML);
        });


        // --- Developer Add/Edit Functionality ---

        const addDeveloperCard = document.getElementById('addDeveloperCard');
        const developerModal = document.getElementById('developerModal');
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

        let nextDeveloperId = 4; // Starting ID for new developers (assuming 3 existing)

        // Function to create a social link input group
        function createSocialLinkInput(iconValue = '', urlValue = '') {
            const socialLinkDiv = document.createElement('div');
            socialLinkDiv.className = 'flex items-center space-x-2 mb-2 social-link-group';
            socialLinkDiv.innerHTML = `
                <select class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 text-white social-icon-select">
                    <option value="fab fa-linkedin" ${iconValue === 'fab fa-linkedin' ? 'selected' : ''}>LinkedIn</option>
                    <option value="fas fa-globe" ${iconValue === 'fas fa-globe' ? 'selected' : ''}>Website</option>
                    <option value="fab fa-github" ${iconValue === 'fab fa-github' ? 'selected' : ''}>GitHub</option>
                    <option value="fab fa-medium" ${iconValue === 'fab fa-medium' ? 'selected' : ''}>Medium</option>
                    <option value="fab fa-twitter" ${iconValue === 'fab fa-twitter' ? 'selected' : ''}>Twitter</option>
                    <option value="fab fa-dribbble" ${iconValue === 'fab fa-dribbble' ? 'selected' : ''}>Dribbble</option>
                    <option value="fab fa-behance" ${iconValue === 'fab fa-behance' ? 'selected' : ''}>Behance</option>
                    <option value="fab fa-instagram" ${iconValue === 'fab fa-instagram' ? 'selected' : ''}>Instagram</option>
                </select>
                <input type="url" placeholder="Social Link URL" value="${urlValue}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 text-white social-link-input">
                <button type="button" class="remove-social-link-btn bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded text-sm focus:outline-none focus:shadow-outline">
                    <i class="fas fa-times"></i>
                </button>
            `;
            socialLinksContainer.appendChild(socialLinkDiv);

            socialLinkDiv.querySelector('.remove-social-link-btn').addEventListener('click', () => {
                socialLinkDiv.remove();
            });
        }

        // Add New Developer card click handler
        addDeveloperCard.addEventListener('click', () => {
            developerModalTitle.innerText = 'Add New Developer';
            currentDeveloperIdInput.value = ''; // Indicate adding new
            devNameInput.value = '';
            devRoleInput.value = '';
            devDescInput.value = '';
            devImageInput.value = '';
            socialLinksContainer.innerHTML = '';
            developerModal.classList.remove('hidden');
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

                developerModal.classList.remove('hidden');
            }
        });

        addSocialLinkBtn.addEventListener('click', () => createSocialLinkInput());

        saveDeveloperBtn.addEventListener('click', () => {
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

            if (devName && devRole && devDesc) {
                if (devId) {
                    // Update existing developer
                    const cardToUpdate = document.querySelector(`.developer-card[data-id="${devId}"]`);
                    if (cardToUpdate) {
                        cardToUpdate.querySelector('.developer-name').innerText = devName;
                        cardToUpdate.querySelector('.developer-role').innerText = devRole;
                        cardToUpdate.querySelector('.developer-desc').innerText = devDesc;

                        // Update image if a new one is selected
                        if (devImageFile) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                cardToUpdate.querySelector('.developer-image').src = e.target.result;
                            };
                            reader.readAsDataURL(devImageFile);
                        }

                        // Update social links
                        const socialLinksDiv = cardToUpdate.querySelector('.developer-social-links');
                        socialLinksDiv.innerHTML = socialLinks.map(link => `
                            <a href="${link.url}" class="social-link" data-icon="${link.icon}" data-url="${link.url}"><i class="${link.icon}"></i></a>
                        `).join('');
                    }
                } else {
                    // Add new developer
                    const newDeveloperCard = document.createElement('div');
                    newDeveloperCard.className = 'developer-card';
                    newDeveloperCard.dataset.id = nextDeveloperId++; // Assign new ID

                    let imageUrl = 'https://via.placeholder.com/150'; // Default placeholder
                    if (devImageFile) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            imageUrl = e.target.result;
                            renderDeveloperCard(newDeveloperCard, devName, devRole, devDesc, imageUrl, socialLinks);
                        };
                        reader.readAsDataURL(devImageFile);
                    } else {
                        renderDeveloperCard(newDeveloperCard, devName, devRole, devDesc, imageUrl, socialLinks);
                    }

                    developersGrid.insertBefore(newDeveloperCard, addDeveloperCard);
                    observer.observe(newDeveloperCard); // Observe the new card for animation
                }

                developerModal.classList.add('hidden');
            } else {
                alert('Please fill in all required developer details (Name, Role, Description).');
            }
        });

        function renderDeveloperCard(cardElement, name, role, description, imageUrl, socialLinks) {
            let socialLinksHtml = socialLinks.map(link => `
                <a href="${link.url}" class="social-link" data-icon="${link.icon}" data-url="${link.url}" target="_blank"><i class="${link.icon}"></i></a>
            `).join('');

            cardElement.innerHTML = `
                <button class="edit-developer-btn absolute top-2 right-2 z-10 p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                    <i class="fas fa-edit"></i>
                </button>
                <img src="${imageUrl}" alt="${role}" class="card-image developer-image">
                <div class="card-overlay">
                    <div class="card-role developer-role">${role}</div>
                    <div class="card-name developer-name">${name}</div>
                    <p class="card-desc developer-desc">${description}</p>
                    <div class="social-links developer-social-links">
                        ${socialLinksHtml}
                    </div>
                </div>
            `;
        }

        cancelDeveloperBtn.addEventListener('click', () => {
            developerModal.classList.add('hidden');
        });
    });
</script>
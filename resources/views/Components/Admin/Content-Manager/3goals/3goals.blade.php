<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision, Mission, Goal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom fonts */
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Source+Sans+Pro:wght@300;400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Copperplate+Gothic+Bold&display=swap'); /* Using a similar font as Copperplate Gothic Bold */

        /* Custom styles for edit button and modal */
        .vmg-edit-button {
            transition: opacity 0.3s ease-in-out;
            opacity: 0; /* Initially hidden */
            cursor: pointer;
            z-index: 20; /* Ensure button is above content and animations */
            white-space: nowrap; /* Prevent button text from wrapping */
        }

        .vmg-group:hover .vmg-edit-button {
            opacity: 1; /* Visible on hover of the parent group */
        }

        .vmg-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .vmg-modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .vmg-modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px);
            transition: transform 0.3s ease-in-out;
        }

        .vmg-modal-overlay.show .vmg-modal-content {
            transform: translateY(0);
        }

        .vmg-modal-content textarea,
        .vmg-modal-content input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.5rem; /* Adjusted margin for labels */
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1rem;
            resize: vertical;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .vmg-modal-content input[type="file"] {
            width: 100%;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1rem;
        }

        .vmg-modal-content label {
            font-weight: bold;
            margin-bottom: 0.25rem; /* Adjusted margin for labels */
            display: block;
        }

        /* Ensure padding is always present to prevent layout shift */
        .vmg-editable-content-wrapper {
            padding: 1rem; /* Consistent padding */
            border-radius: 0.5rem; /* Consistent rounded corners */
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, ring-color 0.3s ease-in-out;
        }

        .vmg-editable-content-wrapper:hover {
            background-color: rgba(219, 234, 254, 0.5); /* blue-100 with 50% opacity */
            border: 2px dashed #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 2px #3B82F6; /* ring-2 ring-blue-500 */
        }
    </style>
</head>
@props(['contentMlogos'])
<body class="font-['Source_Sans_Pro']">
    <div class="relative w-full overflow-hidden min-h-screen" id="vmgVisionMissionGoalSection">
        {{-- Background Image (Philippine Flag) with fade-in animation --}}
            @foreach($contentMlogos as $logo)
                @if($logo->id == 1)
                    <img src="{{ asset($logo->image_path) }}" class="absolute inset-0 w-full h-full object-cover opacity-90 transition-opacity duration-1500 ease-in-out lazy-animate" data-animation-class="opacity-90">
                @endif
            @endforeach

            {{-- Sun Emblem with scale-in animation --}}
            @foreach($contentMlogos as $logo)
                @if($logo->id == 2)
                    <img src="{{ asset($logo->image_path) }}" class="absolute top-[-30px] right-[50px] w-[300px] h-auto transition-all duration-1000 ease-in-out lazy-animate" style="z-index: 0;" data-animation-class="opacity-80 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-10 scale-80" data-delay="300">
                @endif
            @endforeach

        {{-- Content Container (Vision, Mission, Goal) --}}
        <div class="relative z-10 px-[100px] py-20">
            {{-- Vision Section --}}
            <div class="flex items-center mb-20 relative">
                <div class="flex-shrink-0 w-14 h-14 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                    data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="500">
                    <img id="vmgVisionIcon" src="" alt="Vision Icon" class="w-full h-full object-contain" />
                </div>
                <div class="w-[15px] h-[100px] bg-white mr-[30px] shadow-[5px_3px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="600"></div>
                <div class="vmg-editable-content-wrapper relative group flex-grow">
                    <h2 id="vmgVisionTitle" class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="700"></h2>
                    <p id="vmgVisionParagraph" class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="800" style="font-size: 15px !important;"></p>
                    <button class="vmg-edit-button absolute inset-0 w-full h-full flex items-center justify-center bg-blue-500 bg-opacity-50 text-white rounded-lg text-base shadow-md" data-vmg-edit-type="vision">Edit</button>
                </div>
            </div>

            {{-- Mission Section --}}
            <div class="flex items-center mb-20 relative">
                <div class="flex-shrink-0 w-14 h-14 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                    data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="800">
                    <img id="vmgMissionIcon" src="" alt="Mission Icon" class="w-full h-full object-contain" />
                </div>
                <div class="w-[15px] h-[100px] bg-[#37474F] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="900"></div>
                <div class="vmg-editable-content-wrapper relative group flex-grow">
                    <h2 id="vmgMissionTitle" class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1000"></h2>
                    <p id="vmgMissionParagraph" class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1100" style="font-size: 15px !important;"></p>
                    <button class="vmg-edit-button absolute inset-0 w-full h-full flex items-center justify-center bg-blue-500 bg-opacity-50 text-white rounded-lg text-base shadow-md" data-vmg-edit-type="mission">Edit</button>
                </div>
            </div>

            {{-- Goal Section --}}
            <div class="flex items-center relative">
                <div class="flex-shrink-0 w-14 h-14 mr-6 shadow-md transition-all duration-800 ease-in-out lazy-animate"
                    data-animation-class="opacity-100 translate-x-0 scale-100" data-initial-class="opacity-0 translate-x-5 scale-0" data-delay="1100">
                    <img id="vmgGoalIcon" src="" alt="Goal Icon" class="w-full h-full object-contain" />
                </div>
                <div class="w-[15px] h-[100px] bg-[#D4AF37] mr-[30px] shadow-[5px_5px_5px_-2px_rgba(0,0,0,0.3)] transition-transform duration-800 ease-in-out lazy-animate" data-animation-class="scale-y-100" data-initial-class="scale-y-0 origin-bottom" data-delay="1200"></div>
                <div class="vmg-editable-content-wrapper relative group flex-grow">
                    <h2 id="vmgGoalTitle" class="text-white text-3xl md:text-4xl font-bold font-serif transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1300"></h2>
                    <p id="vmgGoalParagraph" class="text-white text-sm md:text-base font-light leading-relaxed transition-all duration-800 ease-in-out lazy-animate text-center" data-animation-class="opacity-100 translate-x-0" data-initial-class="opacity-0 translate-x-5" data-delay="1400" style="font-size: 15px !important;"></p>
                    <button class="vmg-edit-button absolute inset-0 w-full h-full flex items-center justify-center bg-blue-500 bg-opacity-50 text-white rounded-lg text-base shadow-md" data-vmg-edit-type="goal">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal Structure -->
    <div id="vmgEditModal" class="vmg-modal-overlay hidden">
        <div class="vmg-modal-content">
            <h2 id="vmgModalTitle" class="text-2xl font-bold mb-6 text-gray-800">Edit Content</h2>
            <div id="vmgModalInputs" class="grid grid-cols-1 gap-4 mb-6">
                <!-- Input fields will be dynamically inserted here -->
            </div>
            <div class="flex justify-end gap-4">
                <button id="vmgSaveButton" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md transition-colors duration-200">Save</button>
                <button id="vmgCancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg shadow-md transition-colors duration-200">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Unique variables for page content and modal interaction
        const vmgEditableContentData = {
            vision: {
                icon: '{{ asset($visionIconPath ?? "storage/Vision.svg") }}',
                title: 'Vision',
                paragraph: 'A digitally connected and responsive local government that ensures inclusive participation, promotes transparency, and delivers high-quality public services for a better, sustainable community.'
            },
            mission: {
                icon: '{{ asset($missionIconPath ?? "storage/Mission.svg") }}',
                title: 'Mission',
                paragraph: 'To provide transparent, accessible, and efficient digital services that empower citizens, support local development, and strengthen public trust through innovative governance and community engagement.'
            },
            goal: {
                icon: '{{ asset($goalIconPath ?? "storage/goal.svg") }}',
                title: 'Goal',
                paragraph: 'To create a centralized digital platform that enhances public service delivery, promotes transparency, and fosters active citizen participation in local governance.'
            }
        };

        // Global variable to store the Data URL of the newly selected icon
        let vmgSelectedIconDataUrl = null;

        // Get references to modal elements
        const vmgEditModal = document.getElementById('vmgEditModal');
        const vmgModalTitle = document.getElementById('vmgModalTitle');
        const vmgModalInputs = document.getElementById('vmgModalInputs');
        const vmgSaveButton = document.getElementById('vmgSaveButton');
        const vmgCancelButton = document.getElementById('vmgCancelButton');

        let vmgCurrentEditType = ''; // To store which section is being edited (vision, mission, goal)

        /**
         * Renders the page content based on the vmgEditableContentData object.
         * This function is called on page load and after content is saved.
         */
        function vmgRenderPageContent() {
            // Render Vision section
            document.getElementById('vmgVisionIcon').src = vmgEditableContentData.vision.icon;
            document.getElementById('vmgVisionTitle').textContent = vmgEditableContentData.vision.title;
            document.getElementById('vmgVisionParagraph').textContent = vmgEditableContentData.vision.paragraph;

            // Render Mission section
            document.getElementById('vmgMissionIcon').src = vmgEditableContentData.mission.icon;
            document.getElementById('vmgMissionTitle').textContent = vmgEditableContentData.mission.title;
            document.getElementById('vmgMissionParagraph').textContent = vmgEditableContentData.mission.paragraph;

            // Render Goal section
            document.getElementById('vmgGoalIcon').src = vmgEditableContentData.goal.icon;
            document.getElementById('vmgGoalTitle').textContent = vmgEditableContentData.goal.title;
            document.getElementById('vmgGoalParagraph').textContent = vmgEditableContentData.goal.paragraph;

            // Re-attach event listeners for newly rendered edit buttons
            vmgAttachEditButtonListeners();
        }

        /**
         * Handles the change event for the icon file input, showing a preview.
         * @param {Event} event - The change event.
         */
        function vmgHandleIconFileChange(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('vmgIconPreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    vmgSelectedIconDataUrl = e.target.result; // Store Data URL for saving
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewImage.style.display = 'none';
                vmgSelectedIconDataUrl = null; // Clear stored Data URL
            }
        }

        /**
         * Attaches click event listeners to all edit buttons.
         */
        function vmgAttachEditButtonListeners() {
            document.querySelectorAll('.vmg-edit-button').forEach(button => {
                button.onclick = (event) => {
                    const editType = event.target.dataset.vmgEditType;
                    vmgOpenEditModal(editType);
                };
            });
        }

        /**
         * Opens the edit modal and populates it with content based on the edit type.
         * @param {string} type - 'vision', 'mission', or 'goal'.
         */
        function vmgOpenEditModal(type) {
            vmgCurrentEditType = type;
            vmgModalInputs.innerHTML = ''; // Clear previous inputs
            vmgSelectedIconDataUrl = null; // Reset for new modal open

            const sectionData = vmgEditableContentData[type];
            if (sectionData) {
                vmgModalTitle.textContent = `Edit ${type.charAt(0).toUpperCase() + type.slice(1)} Details`;
                vmgModalInputs.innerHTML = `
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                        <label for="vmgEditIcon" class="text-gray-700 text-lg font-semibold mb-2">Select New Icon</label>
                        <input type="file" id="vmgEditIcon" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        <div class="mt-4 flex justify-center items-center w-24 h-24 bg-gray-100 rounded-full overflow-hidden border border-gray-300 mx-auto">
                            <img id="vmgIconPreview" class="w-full h-full object-cover rounded-full" style="${sectionData.icon ? 'display: block;' : 'display: none;'}" alt="Icon Preview">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                        <label for="vmgEditTitle" class="text-gray-700 text-lg font-semibold mb-2">Title</label>
                        <input type="text" id="vmgEditTitle" value="${sectionData.title}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
                        <label for="vmgEditParagraph" class="text-gray-700 text-lg font-semibold mb-2">Paragraph</label>
                        <textarea id="vmgEditParagraph" rows="5" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">${sectionData.paragraph}</textarea>
                    </div>
                `;
                // Set initial preview if an icon already exists
                if (sectionData.icon) {
                    document.getElementById('vmgIconPreview').src = sectionData.icon;
                }
                // Attach event listener to the newly created file input
                document.getElementById('vmgEditIcon').addEventListener('change', vmgHandleIconFileChange);
            }
            vmgEditModal.classList.add('show');
        }

        /**
         * Closes the edit modal.
         */
        function vmgCloseEditModal() {
            vmgEditModal.classList.remove('show');
            vmgModalInputs.innerHTML = ''; // Clear inputs after closing
            vmgSelectedIconDataUrl = null; // Clear global variable
        }

        /**
         * Saves the edited content from the modal back to the vmgEditableContentData object
         * and re-renders the page.
         */
        function vmgSaveEditedContent() {
            const sectionData = vmgEditableContentData[vmgCurrentEditType];
            if (sectionData) {
                // Use the Data URL if a new file was selected, otherwise keep the existing one
                sectionData.icon = vmgSelectedIconDataUrl || sectionData.icon;
                sectionData.title = document.getElementById('vmgEditTitle').value;
                sectionData.paragraph = document.getElementById('vmgEditParagraph').value;
            }
            vmgRenderPageContent(); // Re-render the page with updated content
            vmgCloseEditModal();
        }

        // Event Listeners for modal buttons
        vmgSaveButton.addEventListener('click', vmgSaveEditedContent);
        vmgCancelButton.addEventListener('click', vmgCloseEditModal);
        vmgEditModal.addEventListener('click', (event) => {
            // Close modal if clicking outside the content area
            if (event.target === vmgEditModal) {
                vmgCloseEditModal();
            }
        });

        // Lazy animation script from original code
        document.addEventListener('DOMContentLoaded', () => {
            const section = document.getElementById('vmgVisionMissionGoalSection');
            const animatedElements = section.querySelectorAll('.lazy-animate');

            // Apply initial styles using data attributes
            animatedElements.forEach(el => {
                const initialClasses = el.dataset.initialClass;
                if (initialClasses) {
                    el.classList.add(...initialClasses.split(' '));
                }
            });

            const observerOptions = {
                root: null, // Use the viewport as the root
                rootMargin: '0px',
                threshold: 0.1 // Trigger when 10% of the section is visible
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animatedElements.forEach(el => {
                            const animationClasses = el.dataset.animationClass;
                            const initialClasses = el.dataset.initialClass;
                            const delay = parseInt(el.dataset.delay) || 0; // Get delay from data attribute

                            setTimeout(() => {
                                if (initialClasses) {
                                    el.classList.remove(...initialClasses.split(' '));
                                }
                                if (animationClasses) {
                                    el.classList.add(...animationClasses.split(' '));
                                }
                            }, delay);
                        });
                        observer.unobserve(entry.target); // Stop observing once animated
                    }
                });
            }, observerOptions);

            observer.observe(section);

            // Initialize page content after animations are set up
            vmgRenderPageContent();
        });
    </script>
</body>
</html>

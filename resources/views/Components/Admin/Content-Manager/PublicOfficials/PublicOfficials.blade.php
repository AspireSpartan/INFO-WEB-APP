<style>
    /* Custom styles for edit button and modal */
    .edit-button {
        transition: opacity 0.3s ease-in-out;
        opacity: 0; /* Initially hidden */
        cursor: pointer;
        z-index: 10; /* Ensure button is above content */
    }

    .group:hover .edit-button {
        opacity: 1; /* Visible on hover of the parent group */
    }

    /* Style for official cards' edit/delete buttons */
    .official-card-buttons {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 20; /* Ensure buttons are above card content */
    }

    .official-card:hover .official-card-buttons {
        opacity: 1;
    }

    .modal-overlay {
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

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: white;
        padding: 2rem;
        border-radius: 15px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        transform: translateY(-20px);
        transition: transform 0.3s ease-in-out;
    }

    .modal-overlay.show .modal-content {
        transform: translateY(0);
    }

    textarea {
        width: 100%;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 1rem;
        resize: vertical;
    }

    .modal-content label {
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Style for the floating add button */
    #addOfficialButtonContainer {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 50; /* Ensure it's above other content */
    }

    /* Styles for image previews in modal */
    .image-preview {
        max-width: 100px;
        max-height: 100px;
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        object-fit: contain;
    }

    /* Toast Notification Styles */
    #toast-container {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }

    .toast-notification {
        background-color: #333;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        transform: translateY(20px);
        min-width: 250px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .toast-notification.show {
        opacity: 1;
        transform: translateY(0);
    }

    .toast-notification.success {
        background-color: #4CAF50; /* Green for success */
    }

    .toast-notification.error {
        background-color: #f44336; /* Red for error */
    }
</style>

@props(['logos', 'publicOfficialCaption', 'officials'])

<div class="w-full min-h-screen relative overflow-hidden" style="background-color: #e2e8f0;">

    <div id="header-section" class="max-w-[1531px] mx-auto pt-20 px-4 flex flex-col lg:flex-row justify-between items-start lg:items-center relative group">
        <div class="mb-10 lg:mb-0 p-4 rounded-lg transition-all duration-300 group-hover:bg-blue-100 group-hover:bg-opacity-50 group-hover:ring-2 group-hover:ring-blue-500 group-hover:border-dashed group-hover:border-2 group-hover:border-blue-500">
            <h1 id="mainTitle" class="text-black text-5xl font-bold font-['Merriweather'] leading-tight">
                {!! nl2br(e(
                    is_array($publicOfficialCaption) && array_key_exists('title', $publicOfficialCaption)
                        ? $publicOfficialCaption['title']
                        : (isset($publicOfficialCaption->title) ? $publicOfficialCaption->title : '')
                )) !!}
            </h1>
        </div>
        <div class="max-w-[673.50px] text-center lg:text-left text-black text-xl font-light leading-relaxed p-4 rounded-lg transition-all duration-300 group-hover:bg-blue-100 group-hover:bg-opacity-50 group-hover:ring-2 group-hover:ring-blue-500 group-hover:border-dashed group-hover:border-2 group-hover:border-blue-500">
            <p id="mainParagraph">
                {!! nl2br(e(
                    is_array($publicOfficialCaption) && array_key_exists('caption', $publicOfficialCaption)
                        ? $publicOfficialCaption['caption']
                        : (isset($publicOfficialCaption->caption) ? $publicOfficialCaption->caption : '')
                )) !!}
            </p>
        </div>
        <button class="edit-button absolute top-4 right-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-base shadow-md" data-edit-type="header">Edit Content</button>
    </div>

    <div class="flex flex-wrap gap-6 justify-center w-full p-4 md:p-8">
        <div id="officialsContainer" class="flex flex-wrap gap-6 justify-center w-full">
            {{-- Officials will be rendered here by JavaScript --}}
        </div>
    </div>

    {{-- Floating Add Official Button --}}
    <div id="addOfficialButtonContainer">
        <button id="addOfficialButton" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full text-lg shadow-lg">
            Add New Official
        </button>
    </div>

    @foreach($logos as $logo)
        @if($logo->id == 6) {{-- Assuming id 6 is miniFlag based on the original code --}}
            <img class="absolute bottom-[-50px] right-0 w-[736px] h-64 object-contain mb-10 mt-15" src="{{ asset($logo->image_path) }}" alt="Philippine Flag Colors Decoration" />
            @break
        @endif
    @endforeach

</div>

<div id="editModal" class="modal-overlay hidden">
    <div class="modal-content">
        <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-black">Edit Content</h2>
        <div id="modalInputs" class="mb-6 text-black">
            {{-- Dynamic inputs will be placed here --}}
        </div>
        <div class="flex justify-end gap-4">
            <button id="saveButton" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md">Save</button>
            <button id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg shadow-md">Cancel</button>
        </div>
    </div>
</div>

{{-- Toast Notification Container --}}
<div id="toast-container"></div>

<script>
    // Unique variables for page content and modal interaction
    const editablePageData = {
        pageMainTitle: {!! json_encode(
            is_array($publicOfficialCaption)
                ? ($publicOfficialCaption['title'] ?? '')
                : ($publicOfficialCaption->title ?? '')
        ) !!},
        pageMainParagraph: {!! json_encode(
            is_array($publicOfficialCaption)
                ? ($publicOfficialCaption['caption'] ?? '')
                : ($publicOfficialCaption->caption ?? '')
        ) !!},
        pageTitleColor: {!! json_encode(
            is_array($publicOfficialCaption)
                ? ($publicOfficialCaption['titleColor'] ?? '#000000')
                : ($publicOfficialCaption->titleColor ?? '#000000')
        ) !!}
    };

    // Officials data for client-side rendering and manipulation
    let officialsData = {!! json_encode($officials) !!};

    // Get references to DOM elements
    const pageTitleElement = document.getElementById('mainTitle');
    const pageParagraphElement = document.getElementById('mainParagraph');
    const headerEditButton = document.querySelector('#header-section .edit-button');
    const officialsContainer = document.getElementById('officialsContainer');
    const addOfficialButton = document.getElementById('addOfficialButton');

    const pageEditModal = document.getElementById('editModal');
    const pageModalTitle = document.getElementById('modalTitle');
    const pageModalInputs = document.getElementById('modalInputs');
    const pageSaveButton = document.getElementById('saveButton');
    const pageCancelButton = document.getElementById('cancelButton');

    const toastContainer = document.getElementById('toast-container'); // Get toast container

    let currentEditMode = null; // 'header' or 'official' or 'addOfficial'
    let currentOfficialId = null; // Stores the ID of the official being edited

    // List of common government positions in the Philippines
    const governmentPositions = [
        "President", "Vice President", "Senator", "House Representative", "Governor",
        "Vice Governor", "Provincial Board Member", "Mayor", "Vice Mayor",
        "City/Municipal Councilor", "Barangay Captain", "Barangay Kagawad",
        "Secretary of Department", "Undersecretary", "Assistant Secretary",
        "Director General", "Bureau Director", "Ambassador", "Consul",
        "Chief Justice", "Associate Justice", "Judge", "Prosecutor",
        "Police General", "Military General", "Commissioner", "Chairperson",
        "Administrator", "Executive Director", "President (State University)", "Superintendent (Schools)",
        "Head of Agency", "Councilor", "Member of Parliament", "Minister", "Prime Minister", "Chief Minister", "Director", "Assistant Director",
        "Other" // Added "Other" option for manual input
    ];

    /**
     * Helper function to get the correct URL for an image path from the server.
     * Handles external URLs, new '/developers/' paths, and old '/public/officials/' paths.
     * @param {string} path - The image path as stored in the database.
     * @returns {string} The full URL for the image.
     */
    function getImageUrl(path) {
        if (!path) return '';
        // If it's already a full URL (external image), return as is
        if (path.startsWith('http://') || path.startsWith('https://')) {
            return path;
        }
        // If it's an old path starting with 'public/' (e.g., 'public/officials/pictures/...')
        if (path.startsWith('public/')) {
            return '/storage/' + path.substring('public/'.length);
        }
        // If it's a new path (e.g., 'developers/...') or old 'officials/pictures/...'
        // It's relative to storage/app/public, so prepend '/storage/'
        return '/storage/' + path;
    }

    /**
     * Displays a toast notification.
     * @param {string} message - The message to display.
     * @param {string} type - 'success' or 'error' to determine styling.
     * @param {number} duration - How long the toast should stay visible in milliseconds. Default is 3000ms.
     */
    function showToast(message, type = 'info', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        toast.textContent = message;
        toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.add('show');
        }, 10); // Small delay to allow CSS transition

        // Animate out and remove
        setTimeout(() => {
            toast.classList.remove('show');
            toast.addEventListener('transitionend', () => {
                toast.remove();
            }, { once: true });
        }, duration);
    }

    /**
     * Renders the main page header content from the editablePageData object.
     */
    function renderMainPageContent() {
        pageTitleElement.innerHTML = editablePageData.pageMainTitle.replace(/\n/g, '<br>');
        pageTitleElement.style.color = editablePageData.pageTitleColor || '#000000';
        pageParagraphElement.innerHTML = editablePageData.pageMainParagraph;
    }

    /**
     * Opens the edit modal and populates inputs with current data for the header.
     */
    function openMainEditModal() {
        currentEditMode = 'header';
        pageModalTitle.textContent = 'Edit Header Content';

        pageModalInputs.innerHTML = `
            <label for="editPageTitle">Main Title (HTML allowed for span):</label>
            <textarea id="editPageTitle" rows="3">${editablePageData.pageMainTitle}</textarea>
            <label for="titleColorPicker">Title Color:</label>
            <input type="color" id="titleColorPicker" value="${editablePageData.pageTitleColor || '#000000'}" />
            <label for="editPageParagraph">Main Paragraph:</label>
            <textarea id="editPageParagraph" rows="5">${editablePageData.pageMainParagraph}</textarea>
        `;

        pageEditModal.classList.add('show');
    }

    /**
     * Saves the edited content from the modal to the database via AJAX (for header).
     */
    async function saveMainEditedContent() {
        const updatedTitle = document.getElementById('editPageTitle').value;
        const updatedParagraph = document.getElementById('editPageParagraph').value;
        const updatedTitleColor = document.getElementById('titleColorPicker').value;

        try {
            const response = await fetch("{{ route('teamdev.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    title: updatedTitle,
                    caption: updatedParagraph,
                    titleColor: updatedTitleColor
                })
            });

            if (!response.ok) {
                const errorData = await response.json(); // Assuming server sends JSON errors
                throw new Error(errorData.message || 'Network response was not ok');
            }

            const result = await response.json();

            editablePageData.pageMainTitle = result.data.title;
            editablePageData.pageMainParagraph = result.data.caption;
            editablePageData.pageTitleColor = result.data.titleColor || '#000000';

            renderMainPageContent();
            closeEditModal();
            showToast(result.message, 'success'); // Show success toast
        } catch (error) {
            showToast('Failed to update content: ' + error.message, 'error'); // Show error toast
        }
    }

    /**
     * Renders all official cards based on the officialsData array.
     */
    function renderOfficials() {
        officialsContainer.innerHTML = ''; // Clear existing officials
        officialsData.forEach(official => {
            const pictureUrl = getImageUrl(official.picture);
            const iconUrl = getImageUrl(official.icon);

            const officialCard = document.createElement('div');
            officialCard.className = `relative official-card grid h-[24rem] w-full sm:w-[calc(50%-12px)] md:w-[calc(33.333%-16px)] lg:w-[calc(25%-18px)] xl:w-[calc(16.666%-20px)] flex-col items-end justify-center overflow-hidden rounded-xl bg-white bg-clip-border text-center text-gray-700 group mx-2 mb-4`;

            officialCard.innerHTML = `
                <div class="absolute inset-0 m-0 h-full w-full overflow-hidden" style="background-image: url('${pictureUrl}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-t from-black/80 via-black/50"></div>
                </div>
                <div class="relative p-4 py-8 px-4 md:px-6">
                    <h2 class="mb-4 block font-sans text-xl font-medium leading-[1.5] tracking-normal text-white antialiased">
                        ${official.position}
                    </h2>
                    <h5 class="block mb-2 font-sans text-lg antialiased font-semibold leading-snug tracking-normal text-gray-400">
                        ${official.name}
                    </h5>
                    ${iconUrl ? `<img src="${iconUrl}" alt="${official.name}" class="relative inline-block h-[50px] w-[50px] rounded-full border-2 border-white object-cover object-center" />` : ''}
                </div>
                <div class="official-card-buttons">
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md text-sm shadow-md" onclick="openOfficialEditModal(${official.id})">Edit</button>
                    <button class="bg-transparent-500 hover:bg-transparent-600 text-white px-3 py-1 rounded-md text-sm shadow-md" onclick="deleteOfficial(${official.id})">Delete</button>
                </div>
            `;
            officialsContainer.appendChild(officialCard);
        });
    }

    /**
     * Function to preview an image when a file input changes.
     * @param {Event} event - The change event from the file input.
     * @param {string} previewId - The ID of the <img> element to display the preview.
     */
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById(previewId);
            output.src = reader.result;
            output.style.display = 'block'; // Make sure the image is visible
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            document.getElementById(previewId).src = ''; // Clear preview if no file selected
            document.getElementById(previewId).style.display = 'none'; // Hide if no file
        }
    }

    /**
     * Toggles the visibility of the custom position textbox based on dropdown selection.
     * @param {string} dropdownId - The ID of the position dropdown.
     * @param {string} textboxId - The ID of the custom position textbox.
     */
    function toggleCustomPositionTextbox(dropdownId, textboxId) {
        const dropdown = document.getElementById(dropdownId);
        const textbox = document.getElementById(textboxId);
        if (dropdown.value === 'Other') {
            textbox.style.display = 'block';
            textbox.setAttribute('required', 'true');
        } else {
            textbox.style.display = 'none';
            textbox.removeAttribute('required');
            textbox.value = ''; // Clear value when hidden
        }
    }

    /**
     * Opens the modal for editing an existing official.
     * @param {number} officialId - The ID of the official to edit.
     */
    function openOfficialEditModal(officialId) {
        currentEditMode = 'official';
        currentOfficialId = officialId;
        const official = officialsData.find(o => o.id === officialId);

        if (!official) {
            showToast('Official not found!', 'error'); // Use toast here
            return;
        }

        const currentPictureUrl = getImageUrl(official.picture);
        const currentIconUrl = getImageUrl(official.icon);

        pageModalTitle.textContent = `Edit Official: ${official.name}`;

        let positionOptions = governmentPositions.map(pos =>
            `<option value="${pos}" ${official.position === pos ? 'selected' : ''}>${pos}</option>`
        ).join('');

        const isCustomPosition = !governmentPositions.includes(official.position);
        if (isCustomPosition) {
            positionOptions = `<option value="Other" selected>Other</option>` + positionOptions;
        }

        pageModalInputs.innerHTML = `
            <label for="editOfficialName">Name:</label>
            <input type="text" id="editOfficialName" class="w-full p-2 mb-4 border rounded" value="${official.name}" />

            <label for="editOfficialPositionDropdown">Position:</label>
            <select id="editOfficialPositionDropdown" class="w-full p-2 mb-4 border rounded">
                ${positionOptions}
            </select>
            <input type="text" id="editOfficialPositionManual" class="w-full p-2 mb-4 border rounded" placeholder="Enter custom position" style="${isCustomPosition ? 'display: block;' : 'display: none;'}" value="${isCustomPosition ? official.position : ''}" />

            <label for="editOfficialPicture">Picture:</label>
            <input type="file" id="editOfficialPicture" class="w-full p-2 mb-2 border rounded" accept="image/*" />
            ${official.picture ? `<p class="text-sm text-gray-600 mb-4">Current: <a href="${currentPictureUrl}" target="_blank" class="text-blue-500 hover:underline">View Image</a></p>` : ''}
            <img id="previewOfficialPicture" class="image-preview" src="${currentPictureUrl || ''}" style="${official.picture ? 'display: block;' : 'display: none;'}"/>

            <label for="editOfficialIcon">Icon:</label>
            <input type="file" id="editOfficialIcon" class="w-full p-2 mb-2 border rounded" accept="image/*" />
            ${official.icon ? `<p class="text-sm text-gray-600 mb-4">Current: <a href="${currentIconUrl}" target="_blank" class="text-blue-500 hover:underline">View Icon</a> <button type="button" class="text-red-500 text-xs ml-2" onclick="document.getElementById('editOfficialIcon').value = ''; document.getElementById('iconCleared').value = '1'; document.getElementById('previewOfficialIcon').src=''; document.getElementById('previewOfficialIcon').style.display='none'; this.style.display='none';">Clear</button></p>` : ''}
            <img id="previewOfficialIcon" class="image-preview" src="${currentIconUrl || ''}" style="${official.icon ? 'display: block;' : 'display: none;'}"/>
            <input type="hidden" id="iconCleared" value="0">
        `;
        pageEditModal.classList.add('show');

        // Add event listeners for preview and position dropdown after elements are added to DOM
        document.getElementById('editOfficialPicture').addEventListener('change', (event) => previewImage(event, 'previewOfficialPicture'));
        document.getElementById('editOfficialIcon').addEventListener('change', (event) => previewImage(event, 'previewOfficialIcon'));
        document.getElementById('editOfficialPositionDropdown').addEventListener('change', () => toggleCustomPositionTextbox('editOfficialPositionDropdown', 'editOfficialPositionManual'));
    }

    /**
     * Saves the edited official content via AJAX.
     */
    async function saveOfficialEditedContent() {
        const updatedName = document.getElementById('editOfficialName').value;
        const selectedPosition = document.getElementById('editOfficialPositionDropdown').value;
        const manualPosition = document.getElementById('editOfficialPositionManual').value;
        const updatedPosition = (selectedPosition === 'Other') ? manualPosition : selectedPosition;

        const updatedPictureFile = document.getElementById('editOfficialPicture').files[0];
        const updatedIconFile = document.getElementById('editOfficialIcon').files[0];
        const iconCleared = document.getElementById('iconCleared').value;

        if (selectedPosition === 'Other' && !manualPosition) {
            showToast('Please enter a custom position or select one from the list.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('name', updatedName);
        formData.append('position', updatedPosition);

        if (updatedPictureFile) {
            formData.append('picture', updatedPictureFile);
        }

        if (updatedIconFile) {
            formData.append('icon', updatedIconFile);
        } else if (iconCleared === '1') {
            formData.append('icon_cleared', '1');
            formData.append('icon', '');
        }

        formData.append('_method', 'PUT');

        try {
            const response = await fetch("{{ route('public-officials.update', ['public_official' => ':officialId']) }}".replace(':officialId', currentOfficialId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            if (!response.ok) {
                const responseText = await response.text();
                try {
                    const errorData = JSON.parse(responseText);
                    if (errorData.errors && typeof errorData.errors === 'object') {
                        const errorMessages = Object.values(errorData.errors).flat().join('\n');
                        throw new Error(errorMessages || 'Server error occurred.');
                    } else {
                        throw new Error(errorData.message || 'Server error occurred.');
                    }
                } catch (parseError) {
                    console.error('Failed to parse error response as JSON:', parseError, responseText);
                    throw new Error('Failed to update official: ' + response.statusText + '. Server returned non-JSON response.');
                }
            }

            const result = await response.json();

            const index = officialsData.findIndex(o => o.id === currentOfficialId);
            if (index !== -1) {
                officialsData[index] = { ...officialsData[index], ...result.data };
            }
            renderOfficials();

            closeEditModal();
            showToast(result.message, 'success'); // Show success toast
        } catch (error) {
            showToast('Failed to update official: ' + error.message, 'error'); // Show error toast
        }
    }

    /**
     * Opens the modal for adding a new official.
     */
    function openAddOfficialModal() {
        currentEditMode = 'addOfficial';
        pageModalTitle.textContent = 'Add New Official';

        let positionOptions = governmentPositions.map(pos =>
            `<option value="${pos}">${pos}</option>`
        ).join('');

        pageModalInputs.innerHTML = `
            <label for="newOfficialName">Name:</label>
            <input type="text" id="newOfficialName" class="w-full p-2 mb-4 border rounded" value="" />

            <label for="newOfficialPositionDropdown">Position:</label>
            <select id="newOfficialPositionDropdown" class="w-full p-2 mb-4 border rounded">
                ${positionOptions}
            </select>
            <input type="text" id="newOfficialPositionManual" class="w-full p-2 mb-4 border rounded" placeholder="Enter custom position" style="display: none;" />

            <label for="newOfficialPicture">Picture:</label>
            <input type="file" id="newOfficialPicture" class="w-full p-2 mb-4 border rounded" accept="image/*" required />
            <img id="previewNewOfficialPicture" class="image-preview" src="" style="display: none;"/>

            <label for="newOfficialIcon">Icon (Optional):</label>
            <input type="file" id="newOfficialIcon" class="w-full p-2 mb-4 border rounded" accept="image/*" />
            <img id="previewNewOfficialIcon" class="image-preview" src="" style="display: none;"/>
        `;
        pageEditModal.classList.add('show');

        document.getElementById('newOfficialPicture').addEventListener('change', (event) => previewImage(event, 'previewNewOfficialPicture'));
        document.getElementById('newOfficialIcon').addEventListener('change', (event) => previewImage(event, 'previewNewOfficialIcon'));
        document.getElementById('newOfficialPositionDropdown').addEventListener('change', () => toggleCustomPositionTextbox('newOfficialPositionDropdown', 'newOfficialPositionManual'));
    }

    /**
     * Adds a new official via AJAX.
     */
    async function addNewOfficial() {
        const newName = document.getElementById('newOfficialName').value;
        const selectedPosition = document.getElementById('newOfficialPositionDropdown').value;
        const manualPosition = document.getElementById('newOfficialPositionManual').value;
        const newPosition = (selectedPosition === 'Other') ? manualPosition : selectedPosition;

        const newPictureFile = document.getElementById('newOfficialPicture').files[0];
        const newIconFile = document.getElementById('newOfficialIcon').files[0];

        if (!newName || !newPosition || !newPictureFile) {
            showToast('Please fill in Name, Position, and select a Picture for the new official.', 'error'); // Use toast here
            return;
        }

        if (selectedPosition === 'Other' && !manualPosition) {
            showToast('Please enter a custom position or select one from the list.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('name', newName);
        formData.append('position', newPosition);
        formData.append('picture', newPictureFile);

        if (newIconFile) {
            formData.append('icon', newIconFile);
        }

        try {
            const response = await fetch("{{ route('public-officials.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            if (!response.ok) {
                const responseText = await response.text();
                try {
                    const errorData = JSON.parse(responseText);
                    if (errorData.errors && typeof errorData.errors === 'object') {
                        const errorMessages = Object.values(errorData.errors).flat().join('\n');
                        throw new Error(errorMessages || 'Server error occurred.');
                    } else {
                        throw new Error(errorData.message || 'Server error occurred.');
                    }
                } catch (parseError) {
                    console.error('Failed to parse error response as JSON:', parseError, responseText);
                    throw new Error('Failed to add official: ' + response.statusText + '. Server returned non-JSON response.');
                }
            }

            const result = await response.json();

            officialsData.push(result.data);
            renderOfficials();

            closeEditModal();
            showToast(result.message, 'success'); // Show success toast
        } catch (error) {
            showToast('Failed to add official: ' + error.message, 'error'); // Show error toast
        }
    }

    /**
     * Deletes an official via AJAX.
     * @param {number} officialId - The ID of the official to delete.
     */
    async function deleteOfficial(officialId) {
        if (!confirm('Are you sure you want to delete this official? This action cannot be undone.')) {
            return;
        }

        try {
            const response = await fetch("{{ route('public-officials.destroy', ['public_official' => ':officialId']) }}".replace(':officialId', officialId), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (!response.ok) {
                const responseText = await response.text();
                try {
                    const errorData = JSON.parse(responseText);
                    throw new Error(errorData.message || 'Server error occurred.');
                } catch (parseError) {
                    console.error('Failed to parse error response as JSON:', parseError, responseText);
                    throw new Error('Failed to delete official: ' + response.statusText + '. Server returned non-JSON response.');
                }
            }

            const result = await response.json();

            officialsData = officialsData.filter(o => o.id !== officialId);
            renderOfficials();

            showToast(result.message, 'success'); // Show success toast
        } catch (error) {
            showToast('Failed to delete official: ' + error.message, 'error'); // Show error toast
        }
    }

    /**
     * General function to close the edit modal and reset mode.
     */
    function closeEditModal() {
        pageEditModal.classList.remove('show');
        pageModalInputs.innerHTML = '';
        currentEditMode = null;
        currentOfficialId = null;
    }

    // Event Listeners
    headerEditButton.addEventListener('click', openMainEditModal);
    addOfficialButton.addEventListener('click', openAddOfficialModal);

    pageSaveButton.addEventListener('click', () => {
        if (currentEditMode === 'header') {
            saveMainEditedContent();
        } else if (currentEditMode === 'official') {
            saveOfficialEditedContent();
        } else if (currentEditMode === 'addOfficial') {
            addNewOfficial();
        }
    });

    pageCancelButton.addEventListener('click', closeEditModal);
    pageEditModal.addEventListener('click', (event) => {
        if (event.target === pageEditModal) {
            closeEditModal();
        }
    });

    // Initialize page content and officials on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', () => {
        renderMainPageContent();
        renderOfficials();
    });
</script>
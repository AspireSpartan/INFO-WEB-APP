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
    </style>
@props(['logos', 'publicOfficialCaption', 'officials'])
    <div class="w-full min-h-screen relative overflow-hidden" style="background-color: #e2e8f0;">

        <div id="header-section" class="max-w-[1531px] mx-auto pt-20 px-4 flex flex-col lg:flex-row justify-between items-start lg:items-center relative group">
            <!-- Padding 'p-4' is now always applied to prevent layout shift on hover -->
            <div class="mb-10 lg:mb-0 p-4 rounded-lg transition-all duration-300 group-hover:bg-blue-100 group-hover:bg-opacity-50 group-hover:ring-2 group-hover:ring-blue-500 group-hover:border-dashed group-hover:border-2 group-hover:border-blue-500">
                        <h1 id="mainTitle" class="text-black text-5xl font-bold font-['Merriweather'] leading-tight">{!! nl2br(e($publicOfficialCaption->title)) !!}</h1>
            </div>
            <!-- Padding 'p-4' is now always applied to prevent layout shift on hover -->
            <div class="max-w-[673.50px] text-center lg:text-left text-black text-xl font-light leading-relaxed p-4 rounded-lg transition-all duration-300 group-hover:bg-blue-100 group-hover:bg-opacity-50 group-hover:ring-2 group-hover:ring-blue-500 group-hover:border-dashed group-hover:border-2 group-hover:border-blue-500">
                <p id="mainParagraph">{{ $publicOfficialCaption->caption }}</p>
            </div>
            <button class="edit-button absolute top-4 right-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-base shadow-md" data-edit-type="header">Edit Content</button>
        </div>

        
        <div class="flex flex-col md:flex-row gap-8 justify-center items-center w-full min-h-screen p-4 md:p-8">
            @foreach ($officials as $official)
                <div class="relative grid h-[40rem] w-full max-w-[28rem] flex-col items-end justify-center overflow-hidden rounded-xl bg-white bg-clip-border text-center text-gray-700">
                    <div class="absolute inset-0 m-0 h-full w-full overflow-hidden" style="background-image: url('{{ $official->picture }}'); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 w-full h-full to-bg-black-10 bg-gradient-to-t from-black/80 via-black/50"></div>
                    </div>
                    <div class="relative p-6 py-14 px-6 md:px-12">
                        <h2 class="mb-6 block font-sans text-4xl font-medium leading-[1.5] tracking-normal text-white antialiased">
                            {{ $official->position }}
                        </h2>
                        <h5 class="block mb-4 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-gray-400">
                            {{ $official->name }}
                        </h5>
                        @if ($official->icon)
                            <img src="{{ $official->icon }}" alt="{{ $official->name }}" class="relative inline-block h-[74px] w-[74px] rounded-full border-2 border-white object-cover object-center" />
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @foreach($contentMlogos as $logo)
            @if($logo->id == 6) {{-- Assuming id 2 is miniFlag --}}
                <img class="absolute bottom-[-50px] right-0 w-[736px] h-64 object-contain mb-10 mt-15" src="{{ asset($logo->image_path) }}" alt="Philippine Flag Colors Decoration" />
                @break
            @endif
        @endforeach

    </div>

    <div id="editModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-black">Edit Content</h2>
            <div id="modalInputs" class="mb-6 text-black">
                </div>
            <div class="flex justify-end gap-4">
                <button id="saveButton" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md">Save</button>
                <button id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg shadow-md">Cancel</button>
            </div>
        </div>
    </div>

<script>
    // Unique variables for page content and modal interaction
    const editablePageData = {
        pageMainTitle: {!! json_encode($publicOfficialCaption->title) !!},
        pageMainParagraph: {!! json_encode($publicOfficialCaption->caption) !!},
        pageTitleColor: {!! json_encode($publicOfficialCaption->titleColor ?? '#000000') !!}
    };

    // Get references to DOM elements
    const pageTitleElement = document.getElementById('mainTitle');
    const pageParagraphElement = document.getElementById('mainParagraph');
    const headerEditButton = document.querySelector('#header-section .edit-button');

    const pageEditModal = document.getElementById('editModal');
    const pageModalTitle = document.getElementById('modalTitle');
    const pageModalInputs = document.getElementById('modalInputs');
    const pageSaveButton = document.getElementById('saveButton');
    const pageCancelButton = document.getElementById('cancelButton');

    /**
     * Renders the main page content from the editablePageData object.
     */
    function renderMainPageContent() {
        pageTitleElement.innerHTML = editablePageData.pageMainTitle.replace(/\n/g, '<br>');
        pageTitleElement.style.color = editablePageData.pageTitleColor || '#000000';
        pageParagraphElement.innerHTML = editablePageData.pageMainParagraph;
    }

    /**
     * Opens the edit modal and populates inputs with current data.
     */
    function openMainEditModal() {
        pageModalTitle.textContent = 'Edit Header Content';

        // Build the modal input HTML content
        pageModalInputs.innerHTML = `
            <label for="editPageTitle">Main Title (HTML allowed for span):</label>
            <textarea id="editPageTitle" rows="3">${editablePageData.pageMainTitle}</textarea>
            <label for="titleColorPicker">Title Color:</label>
            <input type="color" id="titleColorPicker" value="${editablePageData.pageTitleColor || '#000000'}" />
            <label for="editPageParagraph">Main Paragraph:</label>
            <textarea id="editPageParagraph" rows="5">${editablePageData.pageMainParagraph}</textarea>
        `;

        // Show the modal by adding the 'show' class
        pageEditModal.classList.add('show');
    }

    /**
     * Closes the edit modal and clears inputs.
     */
    function closeMainEditModal() {
        pageEditModal.classList.remove('show');
        pageModalInputs.innerHTML = ''; // Clear inputs after closing
    }

    /**
     * Saves the edited content from the modal to the database via AJAX,
     * updates the UI, and closes the modal.
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
                throw new Error('Network response was not ok');
            }

            const result = await response.json();

            // Update local editablePageData and UI
            editablePageData.pageMainTitle = result.data.title;
            editablePageData.pageMainParagraph = result.data.caption;
            editablePageData.pageTitleColor = result.data.titleColor || '#000000';

            renderMainPageContent();
            closeMainEditModal();

            alert(result.message);
        } catch (error) {
            alert('Failed to update content: ' + error.message);
        }
    }

    // Event Listeners
    headerEditButton.addEventListener('click', openMainEditModal);
    pageSaveButton.addEventListener('click', saveMainEditedContent);
    pageCancelButton.addEventListener('click', closeMainEditModal);
    pageEditModal.addEventListener('click', (event) => {
        if (event.target === pageEditModal) {
            closeMainEditModal();
        }
    });

    // Initialize page content on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', renderMainPageContent);
</script>

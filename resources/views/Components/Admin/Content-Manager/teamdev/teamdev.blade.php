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
@props(['logos', 'publicOfficialCaption'])
    <div class="w-full min-h-screen bg-zinc-100 relative overflow-hidden">

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

        <div class="flex flex-col lg:flex-row justify-center items-center lg:items-stretch gap-12 mt-20 px-4 mb-[270px]">

            <div class="w-80 bg-white rounded-[20px] pb-8 shadow-[8px_16px_26.799999237060547px_0px_rgba(0,0,0,0.25)] flex flex-col items-center border-b-[10px] border-black">
                <img class="w-full h-80 rounded-t-[20px] object-cover border-b-[3px] border-black mb-6" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/432407394_1645695422631958_4371129882617179964_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGZfkfQnY1M1Fgs01fgbasTG1J3clYceBIbUndyVhx4EgqI4qUwzsmAjH33ssUXAUgc6a4UOxAyME4pYGoPhRit&_nc_ohc=v-Jyx3YEmwIQ7kNvwHRDsMg&_nc_oc=Adl3f-4o1dvmI784dqTsOU1iFSCgyWY3bGlh2VS23_ea_ZNdQNgDDPmZ4rrjLxaniAE&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=xCxPrqpwZ81lfw3EPP1KrQ&oh=00_AfOyaQ960zBtbaXKcQ5hwvge4Gh7utpTO2UYuZczc5v7A&oe=684F86CA" alt="Jaspher Lawrence Siloy" />
                <div class="flex flex-col items-center px-4">
                    <p class="text-black text-2xl font-normal font-['Copperplate_Gothic_Bold'] text-center uppercase mb-1">Jaspher Lawrence Siloy</p>
                    <p class="text-neutral-500 text-lg font-normal text-center mb-6">Governor</p>
                    <div class="flex justify-center items-center gap-8">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-facebook.svg" alt="Facebook" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-github.svg" alt="Instagram" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-linkedin.svg" alt="LinkedIn" class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-80 bg-white rounded-[20px] pb-8 shadow-[8px_16px_26.799999237060547px_0px_rgba(0,0,0,0.25)] flex flex-col items-center border-b-[10px] border-black">
                <img class="w-full h-80 rounded-t-[20px] object-cover border-b-[3px] border-black mb-6" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/495261489_2871703749669777_6522045126610493016_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH_g-w0RLHevJk6nfqaTj4pEnxHZJBTAqYSfEdkkFMCppz2lmIJQ3s0EMvtQhooCb6O1IQT2q_rZbXHGSIHM9Wm&_nc_ohc=p_9f1C7pABgQ7kNvwHAGCoJ&_nc_oc=AdkNXpRzHT4ff8Ecxngu5DlYHUOAyKW8UdxsJ58d36UENJWSMonGEuwHjULzicqXsUE&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=y0z4xL8-TWnmCDR31LsGtQ&oh=00_AfPvAcTl5HyCjXZxx12i02DvWrCYH3MiP3KzvebEozyNRg&oe=684F84C0" alt="Janpaul Bustillo" />
                <div class="flex flex-col items-center px-4">
                    <p class="text-black text-2xl font-normal font-['Copperplate_Gothic_Bold'] text-center uppercase mb-1">Janpaul Bustillo</p>
                    <p class="text-neutral-500 text-lg font-normal text-center mb-6">Governor</p>
                    <div class="flex justify-center items-center gap-8">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-facebook.svg" alt="Facebook" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-github.svg" alt="Instagram" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-linkedin.svg" alt="LinkedIn" class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-80 bg-white rounded-[20px] pb-8 shadow-[8px_16px_26.799999237060547px_0px_rgba(0,0,0,0.25)] flex flex-col items-center border-b-[10px] border-black">
                <img class="w-full h-80 rounded-t-[20px] object-cover border-b-[3px] border-black mb-6" src="https://scontent.fceb3-1.fna.fbcdn.net/v/t39.30808-6/439979555_8425004204192885_23963868889279716_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeH0U-Pj3hxQAzBvEnJgxIruFNYu4MGlHV4UeN7T4iLdxMiU0_Zh9qgjKDCgCiQmkRE8jFOZ0t4oj&_nc_ohc=6EXteTWDuSEQ7kNvwHWgqKu&_nc_oc=AdntO__O4arTz9hUqsp1eS6GCVic1kfDRb1IaMx38Pe5NzFytyQA0hki1pStGeuEWAg&_nc_zt=23&_nc_ht=scontent.fceb3-1.fna&_nc_gid=MBQLRoCgmkO55HWuUgvyOw&oh=00_AfNWc0gSytwsthN4T0Rr-jPVG_Yp5T2OlwInedXVMvZldg&oe=684F5C4E" alt="Kerstan Zam Davide" />
                <div class="flex flex-col items-center px-4">
                    <p class="text-black text-2xl font-normal font-['Copperplate_Gothic_Bold'] text-center uppercase mb-1">Kerstan Zam Davide</p>
                    <p class="text-neutral-500 text-lg font-normal text-center mb-6">Governor</p>
                    <div class="flex justify-center items-center gap-8">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-facebook.svg" alt="Facebook" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-github.svg" alt="Instagram" class="w-full h-full object-contain" />
                        </div>
                        <div class="w-10 h-10 flex items-center justify-center rounded-full">
                            <img src="storage/icons8-linkedin.svg" alt="LinkedIn" class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @foreach($contentMlogos as $logo)
            @if($logo->id == 6) {{-- Assuming id 2 is miniFlag --}}
                <img class="absolute bottom-[-50px] right-0 w-[736px] h-64 object-contain mb-10" src="{{ asset($logo->image_path) }}" alt="Philippine Flag Colors Decoration" />
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
        pageParagraphElement.innerHTML = editablePageData.pageMainParagraph;
    }

    /**
     * Opens the edit modal and populates it with the current title and paragraph.
     */
    function openMainEditModal() {
        pageModalTitle.textContent = 'Edit Header Content';
        pageModalInputs.innerHTML = `
            <label for="editPageTitle">Main Title (HTML allowed for span):</label>
            <textarea id="editPageTitle" rows="3">${editablePageData.pageMainTitle}</textarea>
            <label for="editPageParagraph">Main Paragraph:</label>
            <textarea id="editPageParagraph" rows="5">${editablePageData.pageMainParagraph}</textarea>
        `;
        pageEditModal.classList.add('show');
    }

    /**
     * Closes the edit modal.
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

        try {
            const response = await fetch("{{ route('teamdev.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    title: updatedTitle,
                    caption: updatedParagraph
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();

            // Update local editablePageData and UI
            editablePageData.pageMainTitle = result.data.title;
            editablePageData.pageMainParagraph = result.data.caption;
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

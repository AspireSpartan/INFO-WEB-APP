<div class="font-roboto bg-[#fdfdff] py-16 text-[#333] overflow-hidden">
  <div class="text-center px-8 mb-12 relative">
    <div class="max-w-4xl mx-auto">
      <div class="flex items-center justify-center gap-4 mb-4">
        <div
          class="w-[50px] h-[50px] flex items-center justify-center bg-gradient-to-br from-[#ff7f50] to-[#ff6347] rounded-full shadow-lg shadow-[#ff7f50]/30"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="w-[30px] h-[30px] text-white"
          >
            <path
              fill-rule="evenodd"
              d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0 .75.75 0 0 1-.416.67c-.941.256-1.809.56-2.652.94a1.5 1.5 0 0 0-.878 1.23l-.02.101a.75.75 0 0 1-.47.658L12 23.25l-1.426-.363a.75.75 0 0 1-.47-.658l-.02-.101a1.5 1.5 0 0 0-.877-1.23c-.844-.38-1.712-.684-2.653-.94a.75.75 0 0 1-.416-.671ZM12 7.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"
              clip-rule="evenodd"
            />
          </svg>
        </div>
        <h1
          class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-open-sans text-[#222] editable-title"
          contenteditable="false"
        >
          <span class="text-[#ff6347]">Community</span> at Work
        </h1>
      </div>
      <p
        class="text-base sm:text-lg text-[#555] leading-relaxed max-w-2xl mx-auto editable-paragraph"
        contenteditable="false"
      >
        We work hand-in-hand with barangay officials and municipal departments
        to ensure streamlined digital services and community development.
      </p>
    </div>
    <button
      id="editButton"
      class="absolute top-0 right-8 bg-orange-600 text-white p-2 rounded-full shadow-lg hover:bg-orange-700 transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50"
      style="width: 40px; height: 40px;"
      title="Toggle Edit Mode"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-5 h-5"
      >
        <path
          d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.09l-.334 1.679a.75.75 0 0 0 .983.983l1.679-.334a5.25 5.25 0 0 0 2.09-1.32l8.4-8.4Z"
        />
        <path
          d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z"
        />
      </svg>
    </button>
  </div>

    <div class="relative mb-12 py-4">
        <div class="overflow-hidden cursor-grab select-none community-carousel-container">
          <div id="carouselTrack" class="flex will-change-transform community-carousel-track">
            <!-- Images will be injected here -->
          </div>
        </div>

        <button
          id="openAddImageModal"
          class="absolute bottom-0 left-1/2 -translate-x-1/2 mb-4 px-6 py-3 bg-orange-600 text-white rounded-lg shadow-lg hover:bg-orange-700 transition-colors hidden items-center justify-center gap-2 font-semibold focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50"
          title="Add New Image"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M1.5 8.25a..." clip-rule="evenodd" />
          </svg>
          Add New Image
        </button>
    </div>
  <div
    class="w-11/12 max-w-md mx-auto mt-10 h-1.5 bg-[#e9e9e9] rounded-full overflow-hidden"
  >
    <div
      class="h-full bg-gradient-to-r from-[#ff7f50] to-[#ff6347] w-0 rounded-full transition-all duration-200 ease-out community-progress-bar"
    ></div>
  </div>

  <div
    class="mt-12 text-center text-[#777] text-sm px-8 pt-4 border-t border-[#eee] max-w-4xl mx-auto editable-footer"
    contenteditable="false"
  >
    <p>
      Building stronger communities through
      <span class="text-[#ff6347] font-semibold">collaboration</span> and
      <span class="text-[#ff6347] font-semibold">innovation</span> since 2023
    </p>
  </div>
</div>

<div
  id="addImageModal"
  class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-4 z-50 hidden"
>
  <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-auto relative">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Carousel Image</h2>
    <button
      id="closeModal"
      class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 focus:outline-none"
      title="Close"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M6 18 18 6M6 6l12 12"
        />
      </svg>
    </button>

    <div class="mb-4">
      <label for="modalImageTitle" class="block text-gray-700 text-sm font-semibold mb-2"
        >Image Title:</label
      >
      <input
        type="text"
        id="modalImageTitle"
        class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
        placeholder="Enter image title"
      />
    </div>

    <div class="mb-6">
      <label for="modalImageUpload" class="block text-gray-700 text-sm font-semibold mb-2"
        >Select Image:</label
      >
      <input
        type="file"
        id="modalImageUpload"
        accept="image/*"
        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition duration-200"
      />
      <p class="mt-2 text-sm text-gray-500" id="imagePreviewText">No image selected</p>
      <img id="imagePreview" src="#" alt="Image Preview" class="mt-4 max-w-full h-auto rounded-md hidden" />
    </div>

    <div class="flex justify-end gap-3">
      <button
        id="cancelAddImage"
        class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition duration-200"
      >
        Cancel
      </button>
      <button
        id="confirmAddImage"
        class="px-5 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition duration-200"
      >
        Add Image
      </button>
    </div>
  </div>
</div>

<style>
  /* Styles for the grid view when in edit mode */
  .grid-view .community-carousel-track {
    display: grid;
    grid-template-columns: repeat(
      auto-fit,
      minmax(min(calc(40vw), 380px), 1fr)
    );
    gap: 24px; /* Matches mx-6 (1.5rem * 2 = 3rem, so 24px per side makes 48px gap, but we're going for 24px between items) */
    justify-items: center;
    transform: none !important; /* Override carousel's transform */
    transition: all 0.5s ease-in-out;
    padding-bottom: 70px; /* Space for the add image button */
  }

  .grid-view .community-carousel-container {
    overflow: visible !important; /* Allow all images to be visible */
    cursor: default !important; /* Change cursor back to default */
  }

  .grid-view .carousel-item {
    width: 100% !important;
    height: 240px !important; /* Fix height for consistent grid */
    margin: 0 !important; /* Remove individual item margins */
    opacity: 1 !important; /* Ensure full opacity in grid view */
    transform: none !important; /* Remove individual item transforms */
  }

  .grid-view .carousel-item .carousel-item-title {
    opacity: 1 !important; /* Make labels always visible in edit mode */
    transform: translateY(0) !important;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0)); /* Darker gradient for better text readability */
    padding-top: 2rem; /* Give more space for title */
  }

  .grid-view .remove-image-button {
    opacity: 1; /* Always show remove button in edit mode */
    visibility: visible; /* Ensure it's visible */
  }

  /* Modern edit mode focus styles */
  [contenteditable="true"]:focus {
    outline: 2px dashed #4299e1; /* Blue dashed outline for focus */
    outline-offset: 4px;
    border-radius: 0.375rem; /* Rounded corners for consistency */
    transition: outline-color 0.2s ease-in-out;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".community-carousel-container");
    const track = document.getElementById("carouselTrack");
    const progressBar = document.querySelector(".community-progress-bar");
    const editButton = document.getElementById("editButton");
    const openAddImageModalButton = document.getElementById("openAddImageModal");
    const editableTitles = document.querySelectorAll(".editable-title");
    const editableParagraphs = document.querySelectorAll(".editable-paragraph");
    const editableFooters = document.querySelectorAll(".editable-footer p"); // Select the <p> tag inside the footer

    const addImageModal = document.getElementById("addImageModal");
    const closeModalButton = document.getElementById("closeModal");
    const cancelAddImageButton = document.getElementById("cancelAddImage");
    const confirmAddImageButton = document.getElementById("confirmAddImage");
    const modalImageTitleInput = document.getElementById("modalImageTitle");
    const modalImageUploadInput = document.getElementById("modalImageUpload");
    const imagePreview = document.getElementById("imagePreview");
    const imagePreviewText = document.getElementById("imagePreviewText");

    let originalItems = [...track.children];

    let isEditMode = false;

    // Carousel functionality variables
    const SPEED = 300,
      DELAY = 2000;
    let CLONES = Math.max(originalItems.length, 5);
    let index = CLONES,
      translate = 0,
      prev = 0,
      drag = false,
      startX = 0,
      frame,
      autoplay;

    const clone = () => {
      // Clear existing clones before re-cloning
      const currentClones = track.querySelectorAll(".cloned-item");
      currentClones.forEach((clone) => clone.remove());

      const end = originalItems.map((i) => {
        const clonedItem = i.cloneNode(true);
        clonedItem.classList.add("cloned-item"); // Add a class to identify clones
        return clonedItem;
      });
      const start = [...end].reverse().map((i) => {
        const clonedItem = i.cloneNode(true);
        clonedItem.classList.add("cloned-item"); // Add a class to identify clones
        return clonedItem;
      });
      track.append(...end);
      track.prepend(...start);
    };

    const setTransform = (x) => (track.style.transform = `translateX(${x}px)`);

    const update = (trans = true) => {
      if (isEditMode) {
        // In edit mode, we don't want carousel transforms or progress bar updates
        track.style.transition = "none";
        setTransform(0); // Reset transform in grid view
        progressBar.style.width = "0%";
        return;
      }

      const item = originalItems[0];
      if (!item) {
        progressBar.style.width = "0%";
        return;
      }

      const gap =
        item.offsetWidth + parseFloat(getComputedStyle(item).marginRight) * 2;
      const offset = container.clientWidth / 2 - gap / 2;
      translate = -index * gap + offset;
      prev = translate;
      track.style.transition = trans ? `transform ${SPEED}ms ease` : "none";
      setTransform(translate);

      const items = [...track.children];
      items.forEach((el, i) => {
        const label = el.querySelector(".carousel-item-title");
        const dist = Math.abs(i - index);
        el.className = el.className.replace(
          /scale-\d+|opacity-\d+|z-\d+/g,
          ""
        ); // Remove existing scale/opacity/z-index classes
        el.classList.add("group"); // Ensure group class is present for hover effects

        if (dist < 1) {
          el.classList.add("scale-105", "opacity-100", "z-10");
          if (label) {
            label.classList.replace("opacity-0", "opacity-100");
            label.classList.replace("translate-y-5", "translate-y-0");
          }
        } else if (dist < 2) {
          el.classList.add("scale-95", "opacity-80", "z-5");
          if (label) {
            label.classList.replace("opacity-100", "opacity-0");
            label.classList.replace("translate-y-0", "translate-y-5");
          }
        } else {
          el.classList.add("scale-90", "opacity-60", "z-1");
          if (label) {
            label.classList.replace("opacity-100", "opacity-0");
            label.classList.replace("translate-y-0", "translate-y-5");
          }
        }
      });

      const real =
        (index - CLONES + originalItems.length) % originalItems.length;
      progressBar.style.width = `${
        ((real + 1) / originalItems.length) * 100
      }%`;
    };

    const dragStart = (e) => {
      if (isEditMode) return; // Disable dragging in edit mode
      drag = true;
      startX = e.touches ? e.touches[0].clientX : e.clientX;
      prev = translate;
      track.style.transition = "none";
      container.classList.add("is-dragging");
      cancelAutoplay();
      frame = requestAnimationFrame(animate);
    };

    const animate = () => {
      if (drag) {
        setTransform(translate);
        requestAnimationFrame(animate);
      }
    };

    const dragging = (e) => {
      if (!drag) return;
      const currX = e.touches ? e.touches[0].clientX : e.clientX;
      translate = prev + currX - startX;
    };

    const dragEnd = () => {
      if (!drag) return;
      drag = false;
      cancelAnimationFrame(frame);
      container.classList.remove("is-dragging");
      const moved = translate - prev;
      if (moved < -50) index++;
      else if (moved > 50) index--;
      update(true);
      startAutoplay();
    };

    const onEnd = () => {
      if (index < CLONES) {
        index += originalItems.length;
        update(false);
      } else if (index >= CLONES + originalItems.length) {
        index -= originalItems.length;
        update(false);
      }
    };

    const startAutoplay = () => {
      if (isEditMode) return; // No autoplay in edit mode
      cancelAutoplay();
      autoplay = setInterval(() => {
        index++;
        update(true);
      }, DELAY);
    };

    const cancelAutoplay = () => clearInterval(autoplay);

    const toggleEditMode = () => {
      isEditMode = !isEditMode;

      // Toggle contenteditable for text elements
      editableTitles.forEach((el) => {
        el.contentEditable = isEditMode;
        el.classList.toggle("focus:outline-dashed", isEditMode);
        el.classList.toggle("focus:outline-2", isEditMode);
        el.classList.toggle("focus:outline-offset-4", isEditMode);
        el.classList.toggle("focus:outline-[#4299e1]", isEditMode); // Modern blue
      });
      editableParagraphs.forEach((el) => {
        el.contentEditable = isEditMode;
        el.classList.toggle("focus:outline-dashed", isEditMode);
        el.classList.toggle("focus:outline-2", isEditMode);
        el.classList.toggle("focus:outline-offset-4", isEditMode);
        el.classList.toggle("focus:outline-[#4299e1]", isEditMode);
      });
      editableFooters.forEach((el) => {
        el.contentEditable = isEditMode;
        el.classList.toggle("focus:outline-dashed", isEditMode);
        el.classList.toggle("focus:outline-2", isEditMode);
        el.classList.toggle("focus:outline-offset-4", isEditMode);
        el.classList.toggle("focus:outline-[#4299e1]", isEditMode);
      });

      // Toggle contenteditable for carousel item titles
      document.querySelectorAll(".carousel-item-title").forEach((el) => {
        el.contentEditable = isEditMode;
        el.classList.toggle("focus:outline-dashed", isEditMode);
        el.classList.toggle("focus:outline-2", isEditMode);
        el.classList.toggle("focus:outline-offset-4", isEditMode);
        el.classList.toggle("focus:outline-white", isEditMode); // White outline for titles on images
      });

      // Toggle grid view for carousel
      container.classList.toggle("grid-view", isEditMode);

      // Show/hide add image button
      if (isEditMode) {
        openAddImageModalButton.style.display = "flex"; // Use flex to maintain alignment
      } else {
        openAddImageModalButton.style.display = "none";
      }

      // Show/hide remove buttons on carousel items
      document.querySelectorAll(".remove-image-button").forEach((button) => {
        button.classList.toggle("hidden", !isEditMode);
      });

      if (isEditMode) {
        cancelAutoplay();
        // Recalculate originalItems when entering edit mode, ensuring no clones are present
        originalItems = Array.from(track.children).filter(
          (item) => !item.classList.contains("cloned-item")
        );
        track.innerHTML = ""; // Clear the track to re-add only original items
        track.append(...originalItems); // Add original items back
        container.style.overflow = "visible"; // Allow all images to be visible
        container.style.cursor = "default";
        track.style.transition = "none"; // Disable transition for grid
        track.style.transform = "none"; // Reset transform
      } else {
        container.style.overflow = "hidden"; // Revert to hidden overflow for carousel
        container.style.cursor = "grab";
        clone(); // Re-clone for carousel
        originalItems = Array.from(track.children).filter(
          (item) => !item.classList.contains("cloned-item")
        ); // Update originalItems after cloning
        CLONES = Math.max(originalItems.length, 5); // Recalculate CLONES
        index = CLONES; // Reset index for proper carousel behavior
        update(false); // Initial update for carousel
        startAutoplay(); // Resume autoplay
      }
      update(false); // Update carousel or grid view
    };

    const addImage = (file, title) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        const newItem = document.createElement("div");
        newItem.className =
          "flex-shrink-0 w-[min(calc(40vw),380px)] h-[min(calc(25vw),240px)] mx-6 rounded-xl shadow-xl relative transform transition-transform duration-300 ease-in-out opacity-80 hover:opacity-100 carousel-item group"; // Keep carousel-item class for styling consistency

        newItem.innerHTML = `
          <img
            src="${e.target.result}"
            alt="${title || 'Uploaded image'}"
            class="w-full h-full object-cover block rounded-xl pointer-events-none"
          />
          <div
            class="absolute bottom-0 left-0 right-0 p-6 text-center text-white font-semibold text-lg bg-gradient-to-t from-black/80 to-black/0 opacity-0 translate-y-5 transition-all duration-300 ease-in-out z-10 carousel-item-title"
            contenteditable="${isEditMode}"
          >
            ${title || "New Image Title"}
          </div>
          <button
            class="remove-image-button absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 text-xs ${
              isEditMode ? "" : "hidden"
            } group-hover:opacity-100 transition-opacity flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 z-20"
            style="width: 24px; height: 24px;"
            title="Remove Image"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M16.5 4.478c.02.092.032.185.032.278v.75A2.25 2.25 0 0 1 14.25 8.25h-2.25v2.25a.75.75 0 0 1-1.5 0V8.25H8.25A2.25 2.25 0 0 1 6 6V5.25a.75.75 0 0 1 .032-.278c.01-.044.02-.087.033-.13l.354-1.294a3 3 0 0 1 2.656-2.102h3.5c1.233 0 2.258.857 2.656 2.102l.353 1.294ZM16.5 5.25V6A.75.75 0 0 0 17.25 6.75h-.75a.75.75 0 0 0-.75.75v6a.75.75 0 0 0 .75.75h.75v3.75c0 .414-.336.75-.75.75H7.5c-.414 0-.75-.336-.75-.75v-3.75h.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-.75-.75H6.75A.75.75 0 0 0 6 6v-.75ZM4.5 15.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h15c.414 0 .75-.336.75-.75v-3a.75.75 0 0 0-.75-.75H4.5Z" clip-rule="evenodd" /></svg>
          </button>
        `;

        track.appendChild(newItem);
        originalItems.push(newItem); // Add to originalItems
        CLONES = Math.max(originalItems.length, 5); // Recalculate CLONES

        // Ensure new item's title is editable and remove button is visible if in edit mode
        if (isEditMode) {
          const newTitleElement = newItem.querySelector(".carousel-item-title");
          if (newTitleElement) {
            newTitleElement.contentEditable = true;
            newTitleElement.classList.add(
              "focus:outline-dashed",
              "focus:outline-2",
              "focus:outline-offset-4",
              "focus:outline-white"
            );
          }
          const newRemoveButton = newItem.querySelector(".remove-image-button");
          if (newRemoveButton) {
            newRemoveButton.classList.remove("hidden");
          }
        } else {
          clone(); // Re-clone if not in edit mode to ensure carousel functions correctly
          update(false);
        }
        addRemoveButtonListener(newItem.querySelector(".remove-image-button"));
      };
      reader.readAsDataURL(file);
    };

    const addRemoveButtonListener = (button) => {
      button.addEventListener("click", (e) => {
        if (!isEditMode) return; // Only allow removal in edit mode
        const itemToRemove = e.target.closest(".carousel-item");
        if (itemToRemove) {
          itemToRemove.remove();
          // Update originalItems by filtering out the removed item
          originalItems = originalItems.filter((item) => item !== itemToRemove);
          CLONES = Math.max(originalItems.length, 5); // Recalculate CLONES
          // If in edit mode, the grid will naturally adjust. If not, re-init carousel.
          if (!isEditMode) {
            clone(); // Re-clone for correct carousel function
            update(false); // Update carousel positions
          }
        }
      });
    };

    // Attach listeners for existing remove buttons
    document
      .querySelectorAll(".remove-image-button")
      .forEach(addRemoveButtonListener);

    // Modal Logic
    const openModal = () => {
      addImageModal.classList.remove("hidden");
      // Reset modal fields
      modalImageTitleInput.value = "";
      modalImageUploadInput.value = "";
      imagePreview.classList.add("hidden");
      imagePreview.src = "#";
      imagePreviewText.textContent = "No image selected";
    };

    const closeModal = () => {
      addImageModal.classList.add("hidden");
    };

    modalImageUploadInput.addEventListener("change", (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          imagePreview.src = e.target.result;
          imagePreview.classList.remove("hidden");
          imagePreviewText.textContent = file.name;
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.classList.add("hidden");
        imagePreview.src = "#";
        imagePreviewText.textContent = "No image selected";
      }
    });

    confirmAddImageButton.addEventListener("click", () => {
      const file = modalImageUploadInput.files[0];
      const title = modalImageTitleInput.value.trim();

      if (file) {
        addImage(file, title);
        closeModal();
      } else {
        alert("Please select an image to add.");
      }
    });

    openAddImageModalButton.addEventListener("click", openModal);
    closeModalButton.addEventListener("click", closeModal);
    cancelAddImageButton.addEventListener("click", closeModal);

    // Event Listeners for carousel
    editButton.addEventListener("click", toggleEditMode);

    const listeners = () => {
      track.addEventListener("transitionend", onEnd);
      container.addEventListener("mouseenter", cancelAutoplay);
      container.addEventListener("mouseleave", startAutoplay);
      ["mousedown", "touchstart"].forEach((e) =>
        container.addEventListener(e, dragStart, { passive: true })
      );
      ["mouseup", "mouseleave", "touchend"].forEach((e) =>
        container.addEventListener(e, dragEnd)
      );
      ["mousemove", "touchmove"].forEach((e) =>
        container.addEventListener(e, dragging, { passive: true })
      );
      window.addEventListener("resize", () => update(false));
    };

    // Initial setup
    clone();
    listeners();
    update(false);
    startAutoplay();
  });
  
  const images = [
    { src: "https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80", title: "MATAZAC" },
    { src: "https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80", title: "NANGLATIYON" },
    { src: "https://images.unsplash.com/photo-1568992687947-868a62a9f521?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80", title: "JULIANA" },
    { src: "https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80", title: "SALVIN" }
  ];

  const carouselTrack = document.getElementById("carouselTrack");

  carouselTrack.innerHTML = images.map(({ src, title }) => `
    <div class="flex-shrink-0 w-[min(calc(40vw),380px)] h-[min(calc(25vw),240px)] mx-6 rounded-xl shadow-xl relative transform transition-transform duration-300 ease-in-out opacity-80 hover:opacity-100 carousel-item group">
      <img src="${src}" alt="${title}" class="w-full h-full object-cover block rounded-xl pointer-events-none" />
      <div class="absolute bottom-0 left-0 right-0 p-6 text-center text-white font-semibold text-lg bg-gradient-to-t from-black/80 to-black/0 opacity-0 translate-y-5 transition-all duration-300 ease-in-out z-10 carousel-item-title">${title}</div>
      <button class="remove-image-button absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 z-20" style="width: 24px; height: 24px;" title="Remove Image">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
          <path fill-rule="evenodd" d="M16.5 4.478c..." clip-rule="evenodd" />
        </svg>
      </button>
    </div>
  `).join('');
</script>

<style>
/* Existing styles for news-card hover */
.news-card {
    transition: box-shadow 0.3s;
}
.news-card:hover {
    box-shadow: 0 8px 24px rgba(60,72,88,0.15);
}

/* Add styles for animation on scroll if not already present */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.start-animation {
    opacity: 1;
    transform: translateY(0);
}

/* Hide scrollbar */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Initial states for other entrance animations (if they exist) */
.animate-logo-slide {
    opacity: 0;
    transform: translateY(20px);
}

.animate-title-slide {
    opacity: 0;
    transform: translateX(-20px);
}

.animate-text-fade {
    opacity: 0;
    transform: translateY(20px);
}

.animate-button-pop {
    opacity: 0;
    transform: scale(0.8);
}

/* New styles for editable-container hover effect (for title/paragraph combined) */
.editable-container {
    position: relative; /* Ensure this is set for absolute positioning of the overlay */
    transition: all 0.3s ease-in-out; /* Smooth transition for the hover effect */
}

.editable-container::before {
    content: '';
    position: absolute;
    top: -5px; /* Adjust to extend beyond the element */
    left: -5px; /* Adjust to extend beyond the element */
    right: -5px; /* Adjust to extend beyond the element */
    bottom: -5px; /* Adjust to extend beyond the element */
    background-color: rgba(115, 122, 211, 0.3); /* Light blue background */
    border: 2px dashed #6A5ACD; /* Dashed purple border, you might need to adjust color */
    border-radius: 1rem; /* Rounded edges */
    pointer-events: none; /* Allow clicks to pass through to the content */
    opacity: 0; /* Hidden by default */
    transition: opacity 0.3s ease-in-out; /* Smooth transition for opacity */
    z-index: 5; /* Ensure it's above the content but below the edit button */
}

.editable-container:hover::before {
    opacity: 1; /* Show on hover */
}

/* Ensure the edit button is on top of the overlay */
.editable-container .edit-button {
    z-index: 10;
}

/* NEW: Styles for the logos container hover effect */
.editable-container-logos {
    position: relative;
    /* This makes sure the pseudo-element's position is relative to this div */
    transition: all 0.3s ease-in-out;
}

.editable-container-logos::before {
    content: '';
    position: absolute;
    /* Covers the entire parent div */
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background-color: rgba(115, 122, 211, 0.3);
    /* Light blue background */
    border: 2px dashed #6A5ACD;
    /* Dashed purple border */
    border-radius: 1rem;
    /* Rounded edges */
    pointer-events: none;
    /* Allow clicks to pass through */
    opacity: 0;
    /* Hidden by default */
    transition: opacity 0.3s ease-in-out;
    z-index: 5;
    /* Below the edit button */
}

.editable-container-logos:hover::before {
    opacity: 1;
    /* Show on hover */
}
</style>
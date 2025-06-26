{{-- /resources/views/Components/Admin/Content-Manager/banner/banner-styles.blade.php --}}
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

        /* Loading indicator styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0s linear 0.3s;
        }
        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease-in-out, visibility 0s linear 0s;
        }
        .spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3b82f6;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
</style>
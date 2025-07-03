 <style>
        
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
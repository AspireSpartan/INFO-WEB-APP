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

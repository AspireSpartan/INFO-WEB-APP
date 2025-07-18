<style>
    /* Add this to your existing CSS or a new style block */
    .edit-button {
        transition: transform 0.2s ease-in-out;
    }
    .edit-button:hover {
        transform: scale(1.1);
    }
    .add-developer-card {
        background-color: rgba(249, 115, 22, 0.2); /* A subtle orange tint for the add card */
        border: 2px dashed rgba(249, 115, 22, 0.5); /* Dashed border */
        min-height: 300px; /* Ensure consistent height with other cards */
    }
    .add-developer-card:hover {
        background-color: rgba(249, 115, 22, 0.3);
    }
    /* Existing styles remain unchanged */

    /*section 4*/
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #0a0a0a;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Background gradients */
        .gradient-background {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
        }

        .gradient-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.8), rgba(13, 13, 13, 0.9));
            z-index: 1;
        }

        .gradient-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: linear-gradient(to top, rgba(245, 245, 245, 0.9), transparent);
            z-index: 2;
            opacity: 0.15;
        }

        /* Particle container */
        #particle-container {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 3;
        }

        /* Main content */
        .content-wrapper {
            position: relative;
            z-index: 10;
            max-width: 1400px;
            margin: 0 auto;
            padding: 6rem 2rem;
        }

        /* Header section */
        .header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 2.5rem;
            margin-bottom: 3rem;
        }

        .header-shapes {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 900px;
        }

        .shape-left, .shape-right {
            flex-shrink: 0;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .shape-left {
            width: 5.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
        }

        .shape-right {
            width: 6rem;
            height: 6rem;
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-radius: 50%;
            box-shadow: 0 10px 25px -5px rgba(249, 115, 22, 0.4);
        }

        .header-text {
            max-width: 800px;
        }

        .header-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            font-family: 'Roboto', sans-serif;
        }

        .header-title span:first-child {
            color: #f97316;
            display: block;
        }

        .header-title span:last-child {
            color: #fff;
            display: block;
        }

        .header-subtitle {
            font-size: 1.25rem;
            color: #d1d5db;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.7;
            opacity: 0.9;
        }

        /* Developer cards grid */
        .developers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 7rem;
            width: 100%;
            justify-content: center;
        }

        /* Developer card */
        .developer-card {
            position: relative;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            transform: translateY(0);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            transform: translateY(50px);
        }

        .developer-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .developer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(249, 115, 22, 0.4);
        }

        .card-image {
            width: 100%;
            height: 700px;
            object-fit: cover;
            filter: grayscale(100%);
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .developer-card:hover .card-image {
            filter: grayscale(0%);
            transform: scale(1.03);
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            border-radius: 0 0 1.25rem 1.25rem;
        }

        .card-role {
            color: #f97316;
            font-size: 1.75rem;
            font-family: 'Parisienne', cursive;
            margin-bottom: 0.75rem;
            text-shadow: 0 0 8px rgba(241, 128, 24, 0.8);
            transition: color 0.3s ease;
        }

        .developer-card:hover .card-role {
            color: #ffb76b;
        }

        .card-name {
            color: #f3f4f6;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            transition: color 0.3s ease;
        }

        .developer-card:hover .card-name {
            color: #fff;
        }

        .card-desc {
            color: #d1d5db;
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .developer-card:hover .card-desc {
            opacity: 1;
        }

        .social-links {
            margin-top: 1.25rem;
            display: flex;
            gap: 1.25rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .developer-card:hover .social-links {
            opacity: 1;
            transform: translateY(0);
        }

        .social-link {
            color: #fff;
            font-size: 1.5rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-3px);
        }

        .social-link:nth-child(1):hover {
            color: #3b82f6;
        }

        .social-link:nth-child(2):hover {
            color: #8b5cf6;
        }

        .social-link:nth-child(3):hover {
            color: #10b981;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-header {
            animation: fadeInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .animate-header:nth-child(1) {
            animation-delay: 0.2s;
        }

        .animate-header:nth-child(2) {
            animation-delay: 0.4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .shape-left {
            animation: float 4s ease-in-out infinite;
        }

        .shape-right {
            animation: float 5s ease-in-out infinite;
            animation-delay: 0.5s;
        }

        @keyframes particleFloat {
            0% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(5px, 8px);
            }
            100% {
                transform: translate(0, 0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .header-title {
                font-size: 3rem;
            }

            .shape-left, .shape-right {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }

            .header-subtitle {
                font-size: 1.1rem;
            }

            .developers-grid {
                grid-template-columns: 3fr;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 2rem;
            }

            .content-wrapper {
                padding: 2rem 1rem;
            }

            .card-image {
                height: 400px;
            }
        }
    </style>

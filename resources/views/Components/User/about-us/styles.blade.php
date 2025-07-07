<style>
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
            color: #f5f5f5;
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

        /*section 3*/
         /* Main Section Styling */
        .community-section {
            font-family: 'Roboto', sans-serif;
            background: #fdfdff;
            padding: 4rem 0;
            color: #333;
            overflow: hidden;
        }

        /* Header */
        .community-header-container {
            text-align: center;
            padding: 0 2rem;
            margin-bottom: 3rem;
        }
        
        .community-header-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .community-icon-and-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .community-icon-container {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff7f50, #ff6347);
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(255, 127, 80, 0.3);
        }
        
        .community-icon-container svg {
            width: 30px;
            height: 30px;
            color: white;
        }
        
        .community-title {
            font-size: clamp(2rem, 5vw, 2.8rem);
            font-weight: 700;
            font-family: 'Open Sans', sans-serif;
            color: #222;
        }
        
        .community-title .community-orange {
            color: #ff6347;
        }
        
        .community-description {
            font-size: clamp(1rem, 2.5vw, 1.1rem);
            font-weight: 400;
            color: #555;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Carousel Styling */
        .community-carousel-section {
            position: relative;
            margin-bottom: 3rem;
            padding: 1rem 0;
        }
        
        .community-carousel-container {
            overflow: hidden;
            cursor: grab;
            user-select: none; /* Prevent text selection while dragging */
        }
        
        .community-carousel-container.is-dragging {
            cursor: grabbing;
        }

        .community-carousel-track {
            display: flex;
            will-change: transform;
        }
        
        .community-carousel-item {
            flex-shrink: 0;
            width: clamp(280px, 40vw, 380px); /* Increased size */
            height: clamp(180px, 25vw, 240px); /* Fixed height */
            margin: 0 1.5rem; /* Increased spacing */
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), 
                        opacity 0.3s ease-in-out; /* Faster transitions */
            transform-origin: center center;
        }

        .community-carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 15px;
            pointer-events: none; /* Prevent image ghost dragging */
        }
        
        .community-image-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 1rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
            text-align: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem; /* Slightly larger text */
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease; /* Faster transition */
            z-index: 2;
        }
        
        .community-carousel-item:hover .community-image-label {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Progress Bar */
        .community-progress-container {
            width: 90%;
            max-width: 400px;
            margin: 2.5rem auto 0;
            height: 6px;
            background: #e9e9e9;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .community-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ff7f50, #ff6347);
            width: 0%;
            border-radius: 3px;
            transition: width 0.2s ease-out; /* Faster transition */
        }
        
        /* Footer */
        .community-footer {
            margin-top: 3rem;
            text-align: center;
            color: #777;
            font-size: 0.9rem;
            padding: 1rem 2rem;
            border-top: 1px solid #eee;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .community-highlight {
            color: #ff6347;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .community-icon-and-title {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .community-carousel-item {
                margin: 0 1rem;
                height: clamp(160px, 35vw, 200px);
            }
        }

    </style>
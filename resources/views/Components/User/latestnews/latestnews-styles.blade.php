<style>
    /* Logo carousel styles */
    .logos-container {
        overflow: hidden;
        position: relative;
    }
    
    .logos-track {
        display: flex;
        position: absolute;
        animation: scrollLogos 30s linear infinite;
        will-change: transform;
    }
    
    @keyframes scrollLogos {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    .logos-track:hover {
        animation-play-state: paused;
    }
    
    /* Existing styles */
    .news-card {
        transition: box-shadow 0.3s;
    }
    .news-card:hover {
        box-shadow: 0 8px 24px rgba(60,72,88,0.15);
    }
    
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    
    .start-animation {
        opacity: 1;
        transform: translateY(0);
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
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
</style>
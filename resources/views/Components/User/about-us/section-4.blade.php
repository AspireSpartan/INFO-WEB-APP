<div class="gradient-background">
    <div class="absolute inset-0 bg-gradient-to-l from-zinc-800/0 via-black to-black animate-gradient-shift z-0"></div>
    <div class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-b from-neutral-50/75 via-neutral-400 to-neutral-500 z-0"></div>
    <div class="absolute bottom-[132px] left-0 w-full h-36 bg-gradient-to-b from-neutral-50/75 via-neutral-400/50 to-neutral-500/50 z-0"></div>
    <div class="absolute bottom-[264px] left-0 w-full h-36 bg-gradient-to-b from-white/0 via-zinc-300/50 to-zinc-300 z-0"></div>
        <div class="gradient-overlay"></div>
        <div class="gradient-bottom"></div>

        <div id="particle-container"></div>

        <div class="content-wrapper">
            <div class="header-container">
                <div class="header-shapes">
                    <div class="shape-left"></div>
                    <div class="header-text">
                        <h1 class="header-title animate-header">
                            <span>Meet</span>
                            <span>The Developers Behind CoreDev</span>
                        </h1>
                        <p class="mb-[50px]">
                            Our dedicated team built this platform with care, innovation, and community in mind. Each member brings unique expertise to create an exceptional experience.
                        </p>

                    </div>
                    <div class="shape-right"></div>
                </div>
            </div>

            <div class="developers-grid">
                @props(['developers', 'section4Content'])
                @foreach($developers as $developer)
                <div class="developer-card">
                    <img src="{{ asset('storage/' . $developer->image_url) }}"
                            alt="{{ $developer->role }}" class="card-image">
                    <div class="card-overlay">
                        <div class="card-role">{{ $developer->role }}</div>
                        <div class="card-name">{{ $developer->name }}</div>
                        <p class="card-desc">
                            {{ $developer->description }}
                        </p>
                        <div class="social-links">
                            @foreach($developer->social_links as $link)
                            <a href="{{ $link['url'] }}" class="social-link"><i class="{{ $link['icon'] }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create particles
            const particleContainer = document.getElementById('particle-container');
            const particleCount = 80;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.borderRadius = '50%';
                particle.style.backgroundColor = '#f97316';
                particle.style.opacity = Math.random() * 0.3 + 0.1;
                particle.style.width = Math.random() * 5 + 1 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.zIndex = '1';
                particle.style.pointerEvents = 'none';

                // Animation
                const duration = Math.random() * 10 + 10;
                particle.style.animation = `particleFloat ${duration}s infinite ease-in-out`;
                particle.style.animationDelay = Math.random() * 5 + 's';

                particleContainer.appendChild(particle);
            }

            // Add CSS for particle animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes particleFloat {
                    0% { transform: translate(0, 0); }
                    25% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                    50% { transform: translate(${Math.random()*15 - 7.5}px, ${Math.random()*15 - 7.5}px); }
                    75% { transform: translate(${Math.random()*10 - 5}px, ${Math.random()*10 - 5}px); }
                    100% { transform: translate(0, 0); }
                }
            `;
            document.head.appendChild(style);

            // Card animation on scroll
            const cards = document.querySelectorAll('.developer-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            cards.forEach(card => {
                observer.observe(card);
            });

            // Shape hover effect
            const shapes = document.querySelectorAll('.shape-left, .shape-right');
            shapes.forEach(shape => {
                shape.addEventListener('mouseenter', () => {
                    shape.style.transform = 'scale(1.1)';
                    shape.style.boxShadow = '0 15px 30px -5px rgba(249, 115, 22, 0.6)';
                });

                shape.addEventListener('mouseleave', () => {
                    shape.style.transform = 'scale(1)';
                    shape.style.boxShadow = '0 10px 25px -5px rgba(249, 115, 22, 0.4)';
                });
            });
        });
    </script>
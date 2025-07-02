<div class="w-full min-h-screen bg-gray-700 relative overflow-hidden flex flex-col items-center">
    <div class="absolute w-[1312px] h-[1287px] left-[21px] top-0 hidden lg:block">
        <img src='{{ asset('storage/Vector.svg') }}' alt="Background Image" class="w-full h-full object-cover" />
    </div>
    <div class="absolute w-[500px] h-[500px] left-[-200px] top-[100px] bg-amber-400 rounded-full opacity-5 hidden lg:block"></div>
    <div class="absolute w-[800px] h-[800px] right-[-400px] bottom-[-200px] bg-indigo-900 rounded-full opacity-5 hidden lg:block"></div>

    <div class="relative w-full max-w-[1379px] mx-auto mt-14 px-4 text-center z-10">
        <h1 class="text-white text-5xl font-bold font-['Merriweather'] mb-8">
            Our <span class="text-amber-400">Complete Projects</span>
        </h1>
        <p class="text-white text-xl font-light font-['Source_Sans_Pro'] leading-relaxed">
            {{ $description->description ?? '' }}
        </p>
    </div>
    
    <div class="w-full max-w-[1428px] mx-auto mt-24 px-4 flex flex-col items-center gap-14 pb-20 z-10">

        <!-- Card 1 -->
        <div id="card1" class="relative w-full bg-white rounded-[20px] shadow-lg flex flex-col lg:flex-row items-center p-8 lg:p-0 min-h-[320px] project-card-transition">
            <div class="lg:w-2/3 p-6 order-2 lg:order-1">
                <h2 id="card1-title" class="text-black text-3xl font-bold font-['Merriweather'] mb-4"></h2>
                <p id="card1-text" class="text-neutral-600 text-xl font-['Source_Sans_Pro'] leading-relaxed"></p>
            </div>
            <div class="lg:w-1/3 flex justify-center items-center p-6 order-1 lg:order-2">
                <img id="card1-img" class="max-w-full h-auto max-h-96 rounded-[20px] object-contain shadow-[-17px_8px_18px_-1px_rgba(0,0,0,0.25)]" src="" alt="" />
            </div>
        </div>

        <!-- Card 2 -->
        <div id="card2" class="relative w-full bg-white rounded-[20px] shadow-lg flex flex-col lg:flex-row items-center p-8 lg:p-0 min-h-[320px] mt-14 project-card-transition">
            <div class="lg:w-1/3 flex justify-center items-center p-6 order-1 lg:order-1">
                <img id="card2-img" class="max-w-full h-auto max-h-96 rounded-[20px] object-contain shadow-[18px_8px_18px_-1px_rgba(0,0,0,0.25)]" src="" alt="" />
            </div>
            <div class="lg:w-2/3 p-6 order-2 lg:order-2">
                <h2 id="card2-title" class="text-black text-3xl font-bold font-['Merriweather'] mb-4"></h2>
                <p id="card2-text" class="text-neutral-600 text-xl font-['Source_Sans_Pro'] leading-relaxed"></p>
            </div>
        </div>

    </div>

    <a href="/showallproject" class="relative w-80 h-12 mb-20 rounded-[50px] border-2 border-amber-400 flex justify-center items-center cursor-pointer hover:bg-amber-50 transition z-10">
        <div class="text-amber-400 text-lg font-normal font-['Sans_Serif_Collection']">SHOW ALL PROJECTS</div>
    </a>

    <script>
        // transition or animation parameters are here
        // Pass projects data from PHP to JS
        const projects = @json($projects);

        let currentIndex = 0;

        function updateCards() {
            const card1 = document.getElementById('card1');
            const card2 = document.getElementById('card2');

            card1.classList.add('project-card-hidden-right'); 
            card2.classList.add('project-card-hidden-left');  

            setTimeout(() => {
                const firstIndex = currentIndex % projects.length;
                const secondIndex = (currentIndex + 1) % projects.length;

                const firstProject = projects[firstIndex];
                const secondProject = projects[secondIndex];

                document.getElementById('card1-title').textContent = firstProject.title;
                document.getElementById('card1-text').innerHTML = `
                    <span class="text-amber-400 font-bold">Site:</span> ${firstProject.site}<br/>
                    <span class="text-amber-400 font-bold">Scope:</span> ${firstProject.scope}<br/>
                    <span class="text-amber-400 font-bold">Outcome:</span> ${firstProject.outcome}
                `;
                document.getElementById('card1-img').src = firstProject.image_url;
                document.getElementById('card1-img').alt = firstProject.title;

                document.getElementById('card2-title').textContent = secondProject.title;
                document.getElementById('card2-text').innerHTML = `
                    <span class="text-amber-400 font-bold">Site:</span> ${secondProject.site}<br/>
                    <span class="text-amber-400 font-bold">Scope:</span> ${secondProject.scope}<br/>
                    <span class="text-amber-400 font-bold">Outcome:</span> ${secondProject.outcome}
                `;
                document.getElementById('card2-img').src = secondProject.image_url;
                document.getElementById('card2-img').alt = secondProject.title;

                card1.classList.remove('project-card-hidden-right');
                card2.classList.remove('project-card-hidden-left');

                currentIndex = (currentIndex + 2) % projects.length;
            }, 700); 
        }

        updateCards();

        setInterval(updateCards, 9000);
    </script>
    <style>
        .project-card-transition {
            transition: opacity 0.7s ease-in-out, transform 0.7s ease-in-out;
        }

        .project-card-hidden-right {
            opacity: 0;
            transform: translateX(20px); 
        }

        .project-card-hidden-left {
            opacity: 0;
            transform: translateX(-20px); 
        }
    </style>
</div>

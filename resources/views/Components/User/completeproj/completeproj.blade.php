<div class="w-full min-h-screen bg-gray-700 relative overflow-hidden flex flex-col items-center">
    <div class="absolute w-[1312px] h-[1287px] left-[21px] top-0 hidden lg:block">
        <img src='storage/Vector.svg' alt="Background Image" class="w-full h-full object-cover" />
    </div>
    <div class="absolute w-[500px] h-[500px] left-[-200px] top-[100px] bg-amber-400 rounded-full opacity-5 hidden lg:block"></div>
    <div class="absolute w-[800px] h-[800px] right-[-400px] bottom-[-200px] bg-indigo-900 rounded-full opacity-5 hidden lg:block"></div>

    <div class="relative w-full max-w-[1379px] mx-auto mt-14 px-4 text-center">
        <h1 class="text-white text-5xl font-bold font-['Merriweather'] mb-8">
            Our <span class="text-amber-400">Complete Projects</span>
        </h1>
        <p class="text-white text-xl font-light font-['Source_Sans_Pro'] leading-relaxed">
            The government proudly presents a collection of completed projects that embody progress, resilience, and service to the Filipino people. From modern infrastructure and safer roads to revitalized heritage sites and sustainable community spaces, these accomplishments reflect our unwavering commitment to national development and inclusive growth. Explore how each project contributes to a stronger, more connected, and culturally enriched Philippines.
        </p>
    </div>
    <!--present the first data here-->
    <div class="w-full max-w-[1428px] mx-auto mt-24 px-4 flex flex-col items-center gap-14 pb-20">

        <!-- Card 1 -->
        <div id="card1" class="relative w-full bg-white rounded-[20px] shadow-lg flex flex-col lg:flex-row items-center p-8 lg:p-0 min-h-[320px]">
            <div class="lg:w-2/3 p-6 order-2 lg:order-1">
                <h2 id="card1-title" class="text-black text-3xl font-bold font-['Merriweather'] mb-4"></h2>
                <p id="card1-text" class="text-neutral-600 text-xl font-['Source_Sans_Pro'] leading-relaxed"></p>
            </div>
            <div class="lg:w-1/3 flex justify-center items-center p-6 order-1 lg:order-2">
                <img id="card1-img" class="w-[571px] h-80 rounded-[20px] object-cover shadow-[-17px_8px_18px_-1px_rgba(0,0,0,0.25)]" src="" alt="" />
            </div>
        </div>

        <!-- Card 2 -->
        <div id="card2" class="relative w-full bg-white rounded-[20px] shadow-lg flex flex-col lg:flex-row items-center p-8 lg:p-0 min-h-[320px] mt-14">
            <div class="lg:w-1/3 flex justify-center items-center p-6 order-1 lg:order-1">
                <img id="card2-img" class="w-[571px] h-80 rounded-[20px] object-cover shadow-[18px_8px_18px_-1px_rgba(0,0,0,0.25)]" src="" alt="" />
            </div>
            <div class="lg:w-2/3 p-6 order-2 lg:order-2">
                <h2 id="card2-title" class="text-black text-3xl font-bold font-['Merriweather'] mb-4"></h2>
                <p id="card2-text" class="text-neutral-600 text-xl font-['Source_Sans_Pro'] leading-relaxed"></p>
            </div>
        </div>

    </div>

    <a href="/showallproject" class="relative w-80 h-12 mb-20 rounded-[50px] border-2 border-amber-400 flex justify-center items-center cursor-pointer hover:bg-amber-50 transition">
        <div class="text-amber-400 text-lg font-normal font-['Sans_Serif_Collection']">SHOW ALL PROJECTS</div>
    </a>

    <script>
        // Pass projects data from PHP to JS
        const projects = @json($projects);

        let currentIndex = 0;

        function updateCards() {
            // Calculate indices for two projects to show
            const firstIndex = currentIndex % projects.length;
            const secondIndex = (currentIndex + 1) % projects.length;

            const firstProject = projects[firstIndex];
            const secondProject = projects[secondIndex];

            // Update Card 1
            document.getElementById('card1-title').textContent = firstProject.title;
            document.getElementById('card1-text').innerHTML = `
                <span class="text-amber-400 font-bold">Site:</span> ${firstProject.site}<br/>
                <span class="text-amber-400 font-bold">Scope:</span> ${firstProject.scope}<br/>
                <span class="text-amber-400 font-bold">Outcome:</span> ${firstProject.outcome}
            `;
            const card1Img = document.getElementById('card1-img');
            card1Img.src = firstProject.image_url;
            card1Img.alt = firstProject.title;

            // Update Card 2
            document.getElementById('card2-title').textContent = secondProject.title;
            document.getElementById('card2-text').innerHTML = `
                <span class="text-amber-400 font-bold">Site:</span> ${secondProject.site}<br/>
                <span class="text-amber-400 font-bold">Scope:</span> ${secondProject.scope}<br/>
                <span class="text-amber-400 font-bold">Outcome:</span> ${secondProject.outcome}
            `;
            const card2Img = document.getElementById('card2-img');
            card2Img.src = secondProject.image_url;
            card2Img.alt = secondProject.title;

            currentIndex = (currentIndex + 2) % projects.length;
        }

        // Initial load
        updateCards();

        // Update every 9 seconds (adjust as needed)
        setInterval(updateCards, 9000);
    </script>
</div>
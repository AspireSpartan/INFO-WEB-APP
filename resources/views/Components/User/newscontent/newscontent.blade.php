<div class="w-full min-h-screen font-['Source_Sans_Pro'] overflow-hidden" style="background-image: url('storage/LGU_bg.png'); background-size: cover; background-position: center;">
    <div class="navAndContent_feed mx-auto max-w-7xl" style="background-color: rgb(247 247 247 /1); padding-left: 20px; padding-right: 20px; border-radius: 12px; box-shadow: rgb(0 0 0 / 40%) 0px 0px 50px 8px; --nav-height:50px; --sticky-height:78px; --search-sticky-extra-height:0px; position: relative; margin-top: 200px; margin-bottom: 200px;">
        <div class="g_nav_container">
            <div id="g_nav" class="nav navStickyOneColumn">
                <div class="navSized contentSizedOneColumn">
                    <super-nav config-instance-src="default" instance-id="SuperNav" data-t="{&quot;n&quot;:&quot;SuperNav&quot;,&quot;t&quot;:8}"></super-nav>
                </div>
            </div>
        </div>
        <div class="contentBelowNav contentSized contentSizedOneColumn contentPlaceHolder">
            <super-breaking-news config-instance-src="default" instance-id="SuperBreakingNews" style="display: grid; justify-items: center;" data-t="{&quot;n&quot;:&quot;SuperBreakingNews&quot;,&quot;t&quot;:8}"></super-breaking-news>
            <waterfall-view-feed config-instance-src="default" instance-id="WaterfallViewFeed"></waterfall-view-feed>

            <div class="w-full min-h-screen bg-white font-['Source_Sans_Pro'] overflow-hidden">
                <div class="max-w-[1500px] mx-auto pt-10 px-4 flex flex-col lg:flex-row justify-between items-start lg:items-end relative">
                    <div class="relative mb-10 lg:mb-0">
                        <h1 class="text-indigo-900 text-5xl font-bold font-['Merriweather'] leading-tight relative z-10">Latest News</h1>
                        <div class="absolute -left-20 top-0 w-24 h-32 bg-black/10 transform -rotate-12 -translate-y-1/2 -translate-x-1/2 z-0 hidden md:block"></div>
                    </div>
                    <div class="max-w-[500px] text-black text-base font-light leading-relaxed lg:text-right">
                        <p>This page is made to show the latest local news happening here in the Philippines. It provides updates on important events, community stories, government announcements, and other news that matters to Filipinos. Stay informed and connected with what's going on around the country through this page.</p>
                    </div>
                </div>

                <div class="max-w-[1600px] mx-auto mt-20 px-4 pb-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-12 bg-white">
                    @foreach($newsItems as $news)
                        <a href="{{ $news->url }}" target="_blank" class="block bg-white rounded-lg shadow-md overflow-hidden relative news-item transition-transform transform hover:scale-105 hover:shadow-lg"
                        data-id="{{ $news->id }}"
                        data-url="{{ $news->url }}"
                        onclick="incrementViewsAndRedirect(event, this)">
                            <img class="w-full h-48 object-cover" src="{{ Str::startsWith($news->picture, ['http://', 'https://']) ? $news->picture : asset('storage/' . $news->picture) }}" alt="{{ $news->title }}">
                            <div class="p-4 text-black">
                                <div class="flex items-center mb-2">
                                    <span class="text-xs font-light mr-2">{{ $news->author }}</span>
                                    @if($news->sponsored)
                                        <span class="text-xs italic">Sponsored</span>
                                    @endif
                                </div>
                                <h2 class="text-base font-bold mb-2">{{ $news->title }}</h2>
                                <div class="flex items-center text-sm text-gray-500">
                                    <span class="mr-4">{{ $news->date->format('M d, Y') }}</span>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                        <span class="views-count">{{ $news->views }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Define a JavaScript function to handle the click and AJAX request
    function incrementViewsAndRedirect(event, element) {
        event.preventDefault(); // Prevent the default navigation of the <a> tag

        const newsId = element.getAttribute('data-id');
        const newsUrl = element.getAttribute('data-url');
        const viewsSpan = element.querySelector('.views-count');

        fetch(`/news/${newsId}/increment-views`, { // Use the defined route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel's CSRF token for security
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (viewsSpan) {
                    viewsSpan.textContent = data.views; // Update the displayed count
                }
                // Now that the view is counted, navigate to the news URL
                window.open(newsUrl, '_blank');
            } else {
                console.error('Failed to increment view count:', data.message);
                // Even if view count fails, you might still want to navigate
                window.open(newsUrl, '_blank');
            }
        })
        .catch(error => {
            console.error('Error incrementing view count:', error);
            // Handle network errors, etc. Still navigate to ensure user experience
            window.open(newsUrl, '_blank');
        });
    }
</script>
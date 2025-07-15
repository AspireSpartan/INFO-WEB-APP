<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Parisienne&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Montserrat:wght@400;500;700&family=Verdana:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/newscontent.js') }}" defer></script>
    <!-- Add other global stylesheets and scripts here -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @include('Components.User.about-us.styles')
    @include('Components.User.latestnews.latestnews-styles')
</head>
<body>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <x-User.header.header></x-User.header.header>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollLinks = document.querySelectorAll('.scroll-link');

            scrollLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const scrollPercentage = parseFloat(this.dataset.scrollPercent);
                    const targetUrl = new URL(this.href);

                    if (window.location.pathname === targetUrl.pathname) {
                        // If already on the target page, just scroll
                        if (!isNaN(scrollPercentage)) {
                            const totalHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                            const targetScrollPosition = (totalHeight * (scrollPercentage / 100));

                            window.scrollTo({
                                top: targetScrollPosition,
                                behavior: 'smooth'
                            });
                        }
                    } else {
                        // Redirect to the target page
                        window.location.href = targetUrl.href + '?scrollPercent=' + scrollPercentage;
                    }
                });
            });

            // Check if there's a scroll percentage in the URL query
            const urlParams = new URLSearchParams(window.location.search);
            const scrollPercent = urlParams.get('scrollPercent');
            if (scrollPercent) {
                const totalHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const targetScrollPosition = (totalHeight * (parseFloat(scrollPercent) / 100));

                window.scrollTo({
                    top: targetScrollPosition,
                    behavior: 'smooth'
                });
            }
        });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.news-item').forEach(item => {
                item.addEventListener('click', () => {
                    const newsId = item.getAttribute('data-id');
                    fetch('/news/view/' + newsId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            const viewsSpan = item.querySelector('.views-count');
                            if(viewsSpan) {
                                viewsSpan.textContent = data.views;
                            }
                        }
                    });
                });
            });
        });
    </script>

    <main>
        @yield('content')
    </main>
    
</body>
</html>
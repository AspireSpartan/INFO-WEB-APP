<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Add to your <head> -->
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Add other global stylesheets and scripts here -->
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

    <main>
        @yield('content')
    </main>

    <footer>
        <x-User.footer.footer></x-User.footer.footer>
    </footer>
</body>
</html>
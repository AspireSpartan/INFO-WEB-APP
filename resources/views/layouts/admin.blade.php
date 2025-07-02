<!DOCTYPE html>
<html lang="en"> {{-- Removed x-data="screenTransition()" x-init="init()" from here --}}
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Questrial&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js (Load ONLY ONCE, and preferably the CDN version) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/screentransition.js') }}" defer></script>

    <!-- Add other global stylesheets and scripts here -->

    @include('Components.Admin.Content-Manager.banner.banner-styles')
    
</head>
<body class="bg-neutral-200 min-h-screen flex flex-col">

    <div class="w-full h-px bg-neutral-400"></div>

    <!-- Main Screen Transitions -->
    <main>
        @yield('content')
    </main>

</body>
</html>

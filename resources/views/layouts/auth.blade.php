<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title> 

        <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Questrial&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Add other global stylesheets and scripts here -->
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom styles for checkbox appearance if needed beyond Tailwind's default form styling */
        input[type="checkbox"]:checked {
            background-color: #3b82f6; /* Blue-500 for checked state, matching the SVG color */
            border-color: #3b82f6;
        }
        input[type="checkbox"]:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.5); /* Blue-200 with transparency */
        }
    </style>
    
</head>
<body>

    <!-- Main Screen Transitions -->
    <main>
        @yield('content')
    </main>

</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Facilities Reservation System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/styles.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="/css/custom.css" rel="stylesheet">
</head>

<body class="bg-[#E5EFE8]">
    <nav class="w-full">
        <div class="flex items-center ml-10 py-4 px-6">
            <a class="flex items-center" href="/">
                <img src="/images/lsu-logo 2.png" alt="Logo" class="h-8 mr-2" >
                <span class="text-green-900 lg:block hidden text-2xl" style="font-family: 'Cardo', serif;">La Salle University</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <h1>Reservation Confirmation</h1>
        <p>Your reservation with ID: {{ $reservation->reservedetailsID }} has been successfully saved.</p>
        <!-- Display other reservation details here -->
    </div>
    
</div>


</body>



</html>
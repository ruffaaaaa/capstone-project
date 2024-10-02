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

<body class="bg-[#076334]">
    <div class="flex min-h-screen items-center justify-center">
      <div class="rounded-lg bg-white p-8 text-center shadow-md">
        <h1 class="mb-4 text-2xl font-bold">Endorsement Confirmation</h1>
        <p class="mb-6 text-lg">{{ $message }}</p>
        <a href="/" class="border font-bold border-green-800 rounded px-4 py-2 bg-green-600 text-white hover:bg-green-700">HOME</a>
      </div>
    </div>
</body>


</html>
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
    <link href="/css/custom.css" rel="stylesheet">
</head>

<body class="bg-[#076334]">
  <div class="flex min-h-screen items-center justify-center">
      <div class="rounded bg-white p-8 text-center justify-center shadow-md">
        <div class="flex items-center justify-between lg:justify-center py-4 px-6">
            <a class="flex items-center mx-auto lg:mx-0" href="/">
                <img src="/images/corporate-logo-new.png" alt="Logo" class="h-10">
            </a>
        </div>

        <p class="text-xs font-bold uppercase text-[#087830]">Endorsement Confirmation</p>
        <p class="text-lg font-bold my-6">{{ $message }}</p>
        <div class="mt-9">
          <a href="/" class="border font-bold border-green-800 rounded  px-5 py-2 bg-green-800 text-white hover:bg-green-700">HOME</a>
        </div>
      </div>
    </div>
</body>


</html>
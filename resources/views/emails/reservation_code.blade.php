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
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="/css/custom.css" rel="stylesheet">

</head>

<body class="m-0 p-0 font-sans">
    <table width="100%" class="bg-gray-100">
        <tr>
            <td class="py-5">
                <table align="center" class="max-w-2xl w-full bg-white rounded-lg shadow-md">
                    <tr>
                        <td class="p-5 text-center bg-indigo-700 text-white text-2xl font-bold">
                            <img src="/images/lsu-header.png">
                        </td>
                    </tr>
                    <tr>
                        <td class="p-5 text-gray-700 text-lg leading-6">
                            <p class="m-0">Hello,</p>
                            <p class="my-4">Thank you for making a reservation with us. Your reservation code is provided below. Please keep this code safe as you will need it to track and confirm your reservation.</p>
                            <table align="center" class="my-5">
                                <tr>
                                    <td class="bg-green-900 rounded">
                                        <span class="inline-block px-6 py-3 text-white font-bold">{{ $reservationCode }}</span>
                                    </td>
                                </tr>
                            </table>
                            <p class="m-0">If you have any questions or need to make changes to your reservation, feel free to <a href="https://example.com/contact" class="text-indigo-700 no-underline">contact us</a>.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-5 text-center text-sm text-gray-500">
                            &copy; 2024 Our Company. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



    <h1>Your Reservation Code</h1>
    <p>Your reservation code is: </p>
</body>
</html>

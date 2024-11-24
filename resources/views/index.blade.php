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

    <link href="/css/custom.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     
</head>

<body class="bg-[#E5EFE8]"">
    <nav class="w-full">
        <div class="flex items-center justify-between lg:justify-center py-4 px-6">
            <a class="flex items-center mx-auto lg:mx-0" href="/">
                <img src="/images/corporate-logo-new.png" alt="Logo" class="h-10">
            </a>
        </div>
    </nav>

    <section class="">
        <div class="flex relative flex-col items-start px-20 py-16 min-h-[440px] rounded mx-12 max-md:px-5 max-md:ml-4 max-md:mr-4 ">
            <img
                loading="lazy"
                srcset="https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a"
                class="object-cover absolute inset-0 size-full rounded  shadow-md"/>
                <div class="relative pt-8 mt-10 text-6xl font-bold tracking-wider text-white max-md:text-5xl max-md:mt-3 ">
                    RESERVE
                    <span class="font-thin max-md:-mt-2">YOUR</span> SPACE
                    <span class="font-thin"><br/>WITH</span> EASE
                </div>

            <div class="flex relative gap-1.5 justify-center items-center py-3 mt-2 ">
                <button type="button" class="flex flex-col justify-center self-stretch text-base font-medium text-black rounded-md border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105" id="openMakeReservation">
                    <div class="p-3 bg-white rounded max-md:px-5">RESERVE NOW</div>
                </button> 
                <button type="button" class="group flex flex-col justify-center self-stretch my-auto rounded border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105 relative text-decoration-line: none;" id="openCheckStatus">
                    <div class="flex flex-col justify-center items-center px-3 rounded bg-white bg-opacity-90 h-[43px] w-[43px]">
                        <img
                            loading="lazy"
                            src="https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b"
                            class="object-contain w-full aspect-[0.94]" />
                    </div>
                    <div class="text-xs absolute inset-0 flex items-center justify-center text-white hidden group-hover:flex bg-black bg-opacity-50 rounded">
                        Status
                    </div>
                </button>
                <a href="calendar" class="group flex flex-col justify-center self-stretch my-auto rounded border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105 relative">
                    <div class="flex justify-center items-center px-3 rounded bg-white bg-opacity-90 h-[43px] w-[43px]">
                        <img
                            loading="lazy"
                            src="https://cdn.builder.io/api/v1/image/assets/TEMP/7b09d27cab37db47103086580c25867c01cbce72eb51be0b55484a7437aae598?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a"
                            class="border-2 aspect-square w-[18px]"/>
                    </div>
                    <div class=" text-[10px] absolute inset-0 flex items-center justify-center text-white hidden group-hover:flex bg-black bg-opacity-50 rounded">
                        Calendar
                    </div>
                </a>
            </div>
           
        </div>
    </section>

    <section class="">
        <div class="flex flex-wrap gap-10 pr-16 pl-14 justify-center pt-16 bg-black bg-opacity-0 max-md:px-5 max-md:flex-col">
            <div class="flex z-0 flex-col justify-center text-center text-black min-w-[240px] w-[320px] max-md:w-full max-md:order-1">
                <div class="text-4xl font-bold leading-10 px-0">
                    <span>Featured</span>
                    <span>Facilities</span>
                </div>
                <div class="mt-2 text-base leading-6">
                    Check out our popular facilities for your events.
                </div>
            </div>
            <div class="flex z-0 gap-6 justify-center items-center self-stretch min-h-[373px] min-w-[240px] w-[485px] max-md:w-full max-md:order-2 max-md:flex-col max-md:items-center">
    
                @if ($facilities->count() > 0)
                    @foreach ($facilities->random(min(2, $facilities->count())) as $facility)
                        <div class="flex overflow-hidden flex-col rounded-md border border-solid border-black border-opacity-10 min-h-[305px] min-w-[240px] w-[242px] max-md:w-full ">
                            
                            <div class="flex overflow-hidden w-full min-h-[240px] max-md:mr-5">
                                <img src="{{ asset('uploads/facilities/' . $facility->image) }}" alt="Facility Image" class="h-[250px] w-full object-cover object-center inset-0" />
                            </div>
                            
                            <div class="flex flex-col p-3 w-full text-black">
                                <div class="text-base font-bold">{{ $facility->facilityName }}</div>
                                <div class="mt-1 text-sm leading-none">{{ $facility->facilityStatus }}</div>
                            </div>
                            
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500">No facilities available at the moment.</p>
                @endif
            </div>
            <div class="flex overflow-hidden relative flex-col grow shrink self-stretch text-base font-extralight text-black min-w-[240px] w-[301px] max-md:w-full max-md:mr-1 max-md:py-4 max-md:-mt-0 max-md:ml-0 max-md:min-h-auto max-md:order-3">
                <div>
                    <div class="flex z-0 flex-col items-start max-w-full text-xl font-bold w-[345px] max-md:w-full max-md:text-lg">
                        <div class="flex flex-col items-start max-w-full w-[285px] max-md:pr-0">
                            <div class="text-[18px] max-md:text-lg">UPCOMING RESERVATIONS</div>
                            <div class="flex shrink-0 mt-1 h-0.5 bg-green-800 w-[200px]"></div>
                        </div>
                    </div>

                    @php
                        $filteredReservations = $reservations->filter(function ($reservation) {
                            return \Carbon\Carbon::parse($reservation->event_end_date)->isAfter(\Carbon\Carbon::now()) &&
                                $reservation->reservee &&
                                $reservation->reservee->reservationApproval &&
                                $reservation->reservee->reservationApproval->final_status === 'Approved';
                        })->sortBy('event_start_date')->take(3);
                    @endphp


                    @foreach($filteredReservations as $reservation)
                        @php
                            // Dynamic background color based on index
                            $bgColor = ($loop->index % 3 == 0) ? 'bg-green-700' : (($loop->index % 2 == 0) ? 'bg-green-500' : 'bg-green-600');
                        @endphp

                        <div class="flex z-0 flex-col mt-1 max-w-full max-md:w-full text-sm text-white {{ $bgColor }} p-2 rounded">
                            <div class="flex flex-col justify-center w-full rounded-3xl max-md:py-4">
                                <div class="font-semibold max-md:text-base">Event Name: {{ $reservation->event_name }}</div>
                                <div class="max-md:text-sm">Facility: 
                                    @if ($reservation->facilities->isNotEmpty())
                                        {{ $reservation->facilities->pluck('facilityName')->implode(', ') }}
                                    @else
                                        Not Found
                                    @endif
                                </div>
                                <div class="max-md:text-sm">Date: 
                                    {{ \Carbon\Carbon::parse($reservation->event_start_date)->format('M d, Y') }} - 
                                    {{ \Carbon\Carbon::parse($reservation->event_end_date)->format('M d, Y') }}
                                </div>
                                <div class="max-md:text-sm">Time: 
                                    {{ \Carbon\Carbon::parse($reservation->event_start_date)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($reservation->event_end_date)->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="mt-2 italic">
                    <a href="calendar">Click to view more.</a>
                </div>            
            </div>
    </section>
    <section class="">
        <span class="justify-center items-center self-stretch z-[1] flex mt-0 w-full flex-col px-14 py-5 max-md:max-w-full max-md:px-5">
            <div class="text-black text-center text-4xl font-bold leading-10 mt-2.5 max-md:max-w-full">
                How to Reserve a Facility
            </div>
            <div class="text-black text-center text-base leading-6 mt-6 max-md:max-w-full">
                Follow these steps to reserve a facility
            </div>
            <div class="items-stretch self-stretch bg-white flex flex-col justify-center mt-5 w-full rounded max-md:max-w-full max-md:mr-2.5 max-md:mt-10 shadow-md">
                <div class="justify-between items-stretch border flex gap-4 p-4 rounded-md border-opacity-10 max-md:max-w-full max-md:flex-wrap">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/d2224dc124401e149cabec63f6b04e92b1bad80155c218ed8c0cbac38570eadb?" class="aspect-square object-contain object-center w-[100px] items-center overflow-hidden shrink-0 max-w-full"/>
                    <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                        <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                            Step 1
                        </div>
                        <div class="text-black text-base leading-6 mt-2 max-md:max-w-full max-md:text-xs">
                            Click the 'Reserve Now' button to access the form. Make sure to comply with the necessary requirements before reserving a facility.
                        </div>
                    </span>
                </div>
            </div>
            <div class="justify-between items-stretch border bg-white self-stretch flex gap-4 mt-5 w-full p-4 rounded border-solid border-black border-opacity-10 max-md:max-w-full max-md:flex-wrap max-md:mr-2.5  shadow-md">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/64ba174e863e80ba60a65627d893ca993dc44729302f25afc076db8105a5088b?" class="aspect-square object-contain object-center w-[100px] justify-center items-center overflow-hidden shrink-0 max-w-full"/>
                <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                    <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                    Step 2
                    </div>
                    <div class="text-black text-base leading-6 mt-2 max-md:max-w-full max-md:text-xs">
                        Fill up the form by providing necessary information for your reservation.
                    </div>
                </span>
            </div>
            <div class="justify-between items-stretch border bg-white self-stretch flex gap-4 mt-5 w-full p-4 rounded border-solid border-black border-opacity-10 max-md:max-w-full max-md:flex-wrap max-md:mr-2.5  shadow-md">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6056405e608fe5b9691386695203a927553b55443dd46905f5ae7d1f7147450a?" class="aspect-square object-contain object-center w-[100px] justify-center items-center overflow-hidden shrink-0 max-w-full"/>
                <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                    <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                        Step 3
                    </div>
                    <div class="text-black text-base leading-6 mt-2 max-md:max-w-full max-md:text-xs">
                        Check your email for the reservation code to use when checking the status of your reservation.
                    </div>
                </span>
            </div>
        </span>
        
    </section>
    
    <footer class="">
        <div class="mx-12 py-10 text-center md:text-left">
            <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="">
                    <h6 class="mt-12"></h6>
                    <div class="text-center align-center">
                        <img src="/images/corporate-logo-new.png" class="-mt-12 h-9" style="justify-content: start; align-items: center;">
                    </div>
                    <p class="justify-content:start mt-2">
                        Plan your events at La Salle University with ease. Book your facilities in just a few clicks!                    
                    </p>
                </div>
                <div class="">
                    <h6 class="mb-4 flex font-semibold uppercase justify-start">
                        Quick Link
                    </h6>
                    <p class="mb-4 justify-start">
                        <a href="https://lsu.edu.ph/" class="text-neutral-600 dark:text-black">University Page</a>
                    </p>
                    <p class="mb-4 justify-start">
                        <a href="https://lsu.edu.ph/mylsu" class="text-neutral-600 dark:text-black">Student Portal</a>
                    </p>
                    <p class="mb-4 justify-start">
                        <a href="https://lsu.edu.ph/university-registrar" class="text-neutral-600 dark:text-black">Registrar</a>
                    </p>
                    <p class="mb-4 justify-start">
                        <a href="https://lsu.edu.ph/library" class="text-neutral-600 dark:text-black">Library</a>
                    </p>
                </div>
                <div>
                    <h6 class="mb-4 flex justify-start font-semibold uppercase">
                        Contact
                    </h6>
                    <p class="mb-4 flex items-center justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                        1F LS Bldg, La Salle St. Barangay Aguada Ozamiz City, Misamis Occidental, Philippines
                    </p>
                    <p class="mb-4 flex items-center justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                            <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                            <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                        </svg>
                        info@example.com
                    </p>
                    <p class="mb-4 flex items-center justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5">
                            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                        </svg>
                        + 63 912 7883 811
                    </p>
                </div>
            </div>
        </div>
        
        <div>
            <div class="bg-green-800 flex min-h-[70px] flex-col text-center text-white">
                <span class="mt-6">© 2024 Copyright. <span class="font-bold">La Salle University - Ozamiz</span></span>
            </div>
        </div>

    </footer>
    <div id="reservationModal" class="fixed inset-0 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/3 max-md:w-full max-lg:w-full max-lg:mx-4 max-md:mx-4">
            <div class="flex gap-2 justify-between items-center font-bold">
                <div class="pt-2 pb-1 text-2xl font-bold tracking-tighter leading-4 text-green-700 max-w-[282px]">
                    <span class="text-4xl tracking-tighter">REQUIREMENTS</span>
                    <span class="text-base tracking-tight">BEFORE RESERVING A FACILITY</span>
                
                </div>
                <button id="closeReservationModal" class="text-lg tracking-tighter text-white">
                    <div class="px-4 py-2 bg-green-700 rounded-md max-md:px-5">x</div>
                </button>
            </div>

            <div class="my-8">
                </p>
                <p class="mb-2">1. Prepare the following documents for reserving the <strong> Art Center </strong> and attached it to the form:</p>
                <ul class="list-disc ml-10">
                    <li>Floor Plan or Venue Layout</li>
                    <li>
                        <p class="flex">Letter of Request - 
                        <a href="/images/signatories.png" class="font-bold underline underline-offset-4 text-green-900 ml-1" target="_blank">Signatories.</a>
                        <img src="images/vector.png" class="mt-2 w-3 h-4"alt="">
                        </p>
                    </li>
                </ul>
                <div class="mt-4 border-2 p-2">
                    <p class="text-red-700 text-center text-lg font-bold">REMINDER</p>
                    <p>Facility reservations must be made at least 3 days before the activity date.</p>
                    </p>
                </div>
                
            </div>

            <a href="make-reservation" class="block  px-5 text-base font-medium text-center text-black bg-green-700 rounded-md  transition-transform duration-300 hover:scale-105">
                <div class="p-3 text-white rounded max-md:px-5">CLICK HERE TO PROCEED</div>
            </a>
        </div>
    </div>
    <div id="checkStatusModal" class="fixed inset-0 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/3 max-md:w-full max-md:mx-4">
            <div class="flex gap-2 justify-between items-center font-bold">
                <div class="pt-2 pb-1 text-2xl font-bold tracking-tighter leading-4 text-green-700 max-w-[282px]">
                    <span class="text-2xl tracking-tighter">RESERVATION TRACKING</span>
                </div>
                <button id="closeCheckStatusModal" class="text-lg tracking-tighter text-white">
                    <div class="px-4 py-2 bg-green-700 rounded-md max-md:px-5">x</div>
                </button>
            </div>
            <div class="py-4">
                <input type="text" id="reserveeID" class="mt-2 p-2 border border-gray-300 rounded w-full" placeholder="Enter Reservation Code" />

                <div class="flex justify-center text-center">
                    <button id="fetchStatusButton" class="mt-4 px-4 py-2 bg-green-700 text-white rounded">
                        Search
                    </button>
                </div>
                <div class=" p-2">
                    <div id="event-details" class="mt-3 hidden">
                        <div class="text-center font-bold "><p class="font-sm">EVENT DETAILS</p></div>
                        <p>Event Name: <span id="event-name" class="font-semibold"></span></p>
                        <p>Event Dates: <span id="event-start-date" class="font-semibold"></span></p>
                        <p>Event Time: <span id="event-start-time" class="font-semibold"></span></p>
                    </div>

                    <div id="chosen-facilities-header" class="hidden flex">
                        <h6>Facility:</h6>
                        <p id="chosen-facilities" class="font-semibold ml-2"></p>
                    </div>

                    <div id="admin-approvals-header" class="mt-3 hidden">
                        <div class="text-center font-md font-bold">APPROVALS</div>
                        <ul id="admin-approvals-list" class="list-disc list-inside hidden">
                        </ul>
                    </div>

                    <div id="reservation-status-header" class="mt-3 hidden">
                        <h6>RESERVATION STATUS:
                            <span id="reservation-status" class="font-semibold"> </span>
                        </h6>
                    </div>
                </div>
            </div>
            <div id="error-message" class="text-red-500 hidden text-center flex justify-center font-bold"></div>

        </div>
    </div>

</body>

<script src="/js/home.js"></script>

</html>

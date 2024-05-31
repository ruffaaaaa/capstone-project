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

<body class="bg-[#E5EFE8] ">
    <nav class="w-full">
        <div class="flex items-center ml-10 py-4 px-6">
            <a class="flex items-center" href="#">
                <img src="/images/lsu-logo 2.png" alt="Logo" class="h-8 mr-2" >
                <span class="text-green-900 lg:block hidden text-2xl" style="font-family: 'Cardo', serif;">La Salle University</span>
            </a>
        </div>
    </nav>
    
    <section class="overflow-x">
        <div class="hidden md:block bg-center h-96 rounded-2xl relative bg-no-repeat bg-cover relative md:ml-12 md:mr-12" style="background-image: url('/images/bg-default.png');">
            <div>
                <div class="md:absolute md:inset-0 flex flex-col items-center mt-12">
                    <img src="images/lsu-logotype-white.png" style="height: 80px;">
                    <span class="text-4xl md:text-7xl text-white mt-5" style="font-family: 'Cardo', serif;">La Salle University</span>
                    <span class="text-xl md:text-2xl mt-3 text-white" style="font-family: 'Cardo', serif;">Facilities Reservation System</span>
                </div>
            </div>

        </div>

        <div class=" lg:hidden md:hidden bg-center h-96 rounded-2xl relative bg-no-repeat bg-cover relative fixed" style="background-image: url('/images/bg-default.png');margin-left: 20px;margin-right:20px;">
            <div class="md:absolute md:inset-0 flex flex-col items-center ">
                    <img src="images/lsu-logotype-white.png" class="mt-4 " style="height: 80px;">
                    <span class="text-4xl md:text-7xl text-white mt-5" style="font-family: 'Cardo', serif;">La Salle University</span>
                    <span class="text-xl md:text-2xl mt-3 text-white" style="font-family: 'Cardo', serif;">Facilities Reservation System</span>
                <div>
                    <div class=" bottom-0 left-0 right-0 p-4 flex flex-col items-center">
                    <a href="make-reservation" class="bg-white text-green font-semibold py-2 px-4 rounded-full hover:bg-green-600 hover:text-white transition duration-300 ease-in-out w-full mb-2 sm:block">RESERVE NOW</a>
                    <button class="bg-white text-green font-semibold py-2 px-4 rounded-full hover:bg-green-600 hover:text-white transition duration-300 ease-in-out w-full openBtn mb-2">CHECK STATUS</button>
                    <button id="" class= "bg-white text-green font-semibold py-2 px-4 rounded-full hover:bg-green-600 hover:text-white transition duration-300 ease-in-out w-full uppercase">Calendar</button>
                    </div>
                </div>
            </div>   
        </div>

        <div class="fixed top-0 left-20 md:ml-80 md:mr-10 md:relative md:mt-3 hidden md:block">
            <div class="md:absolute md:inset-0 flex flex-col justify-end items-center ">
                <div class="bg-white rounded-full md:m-auto md:mt-4 shadow-lg">
                    <div class="flex flex-col md:flex-row md:space-x-4 justify-center">
                        <button id="calendarButton" class="bg-white-500 hover:bg-green-600 text-black hover:text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-full transition duration-300 ease-in-out mt-2 md:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </button>     
                    </div>
                </div>
            </div>
        </div>
    
        <div class="hidden md:block container mx-auto h-full md:relative md:mt-10">
            <div class="md:absolute md:inset-0 flex flex-col justify-end">
                <div class="bg-white p-3 md:p-6 rounded-full md:w-96 md:m-auto md:mt-4 shadow-lg">
                    <div class="flex flex-col md:flex-row justify-center items-center">
                        <a href="make-reservation" class="bg-white-500 hover:bg-green-600 text-black hover:text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-full transition duration-300 ease-in-out mt-2 md:mt-0">
                            RESERVE NOW
                        </a>
                        <span class="hidden md:inline-block border-l border-gray-300 h-6 mx-4"></span>
                        <button id="checkStatusBtn" class="bg-white-500 hover:bg-green-600 text-black hover:text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-full transition duration-300 ease-in-out mt-2 md:mt-0">
                            CHECK STATUS
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="mt-2">
    <span class="justify-center items-center self-stretch z-[1] flex mt-0 w-full flex-col px-20 py-12 max-md:max-w-full max-md:px-5">

        <div class="w-full">
            <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0 ">
                <div class="flex flex-col items-stretch w-[27%] max-md:w-full max-md:ml-0">
                <span class="items-stretch flex flex-col my-auto  pl-2 max-md:mt-10">
                    <div class="text-black text-4xl font-bold leading-10 whitespace-nowrap">
                    Featured Facilities
                    </div>
                    <div class="text-black text-base leading-6 whitespace-nowrap mt-6">
                    Check out our popular facilities for your events
                    </div>
                    <div>
                        <button class=" mt-6 text-white text-base font-medium leading-6 whitespace-nowrap bg-green-900 px-3 py-2 rounded-lg">
                            View All Facilities
                        </button>
                    </div>
                </span>
            </div>

         <div class="hidden md:flex flex-col items-stretch w-full ml-10 max-md:w-full max-md:ml-0">
            <div class="justify-center grow  py-11 max-md:max-w-full ">
                <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                    @foreach ($facilities->random(3) as $facility)
                    <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                        <span class="items-stretch border flex grow flex-col w-full pb-3 rounded-md border-solid border-black border-opacity-10 max-md:mt-10">
                            <div class="bg-zinc-300 bg-opacity-50 flex flex-col justify-center items-center aspect-square">
                                <div class="flex-col overflow-hidden relative flex aspect-[1.0083333333333333] w-full items-stretch pb-12">
                                    <img src="{{ asset('uploads/facilities/' . $facility->image) }}" alt="Facility Image" class="absolute h-full w-full object-cover object-center inset-0" />
                                </div>
                            </div>
                            <div class="text-black text-base leading-6 whitespace-nowrap mt-3">{{ $facility->facilityName }}</div>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
</span>
        </div>

        <div class="md:hidden flex flex-col items-stretch w-full ml-5 max-md:w-full max-md:ml-0">
            <div class="justify-center grow px-16 py-11 max-md:max-w-full max-md:px-5">
                <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                    @foreach ($facilities->random(1) as $facility)
                    <div class="flex flex-col items-stretch w-full max-md:w-full max-md:ml-0">
                        <span class="items-stretch border flex grow flex-col w-full pb-3 rounded-md border-solid border-black border-opacity-10 max-md:mt-10">
                            <div class="bg-zinc-300 bg-opacity-50 flex flex-col justify-center items-center aspect-square">
                                <div class="flex-col overflow-hidden relative flex aspect-[1.0083333333333333] w-full items-stretch pb-12">
                                    <img src="{{ asset('uploads/facilities/' . $facility->image) }}" alt="Facility Image" class="absolute h-full w-full object-cover object-center inset-0" />
                                </div>
                            </div>
                            <div class="text-black text-base leading-6 whitespace-nowrap mt-3">{{ $facility->facilityName }}</div>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    
    <section class="-mt-10">
        <span class="justify-center items-center self-stretch z-[1] flex mt-0 w-full flex-col px-20 py-12 max-md:max-w-full max-md:px-5">
            <div class="text-black text-center text-4xl font-bold leading-10 mt-2.5 max-md:max-w-full">
                How to Reserve a Facility
            </div>
            <div class="text-black text-center text-base leading-6 mt-6 max-md:max-w-full">
                Follow these steps to reserve a facility
            </div>
            <div class="items-stretch self-stretch bg-white flex flex-col justify-center mt-5 w-full rounded-3xl max-md:max-w-full max-md:mr-2.5 max-md:mt-10">
                <div class="justify-between items-stretch border flex gap-4 p-4 rounded-md border-solid border-black border-opacity-10 max-md:max-w-full max-md:flex-wrap">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/d2224dc124401e149cabec63f6b04e92b1bad80155c218ed8c0cbac38570eadb?" class="aspect-square object-contain object-center w-[100px] items-center overflow-hidden shrink-0 max-w-full"/>
                    <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                        <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                            Step 1
                        </div>
                        <div class="text-black text-base leading-6 mt-2 max-md:max-w-full">
                            Click the &quot;Reserve Now&quot; button to be redirected to the
                            form.
                        </div>
                    </span>
                </div>
            </div>
        <div class="justify-between items-stretch border bg-white self-stretch flex gap-4 mt-5 w-full p-4 rounded-3xl border-solid border-black border-opacity-10 max-md:max-w-full max-md:flex-wrap max-md:mr-2.5">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/64ba174e863e80ba60a65627d893ca993dc44729302f25afc076db8105a5088b?" class="aspect-square object-contain object-center w-[100px] justify-center items-center overflow-hidden shrink-0 max-w-full"/>
            <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                Step 2
                </div>
                <div class="text-black text-base leading-6 mt-2 max-md:max-w-full">
                    Fill up the form by providing necessary information for your reservation.
                </div>
            </span>
        </div>
        <div class="justify-between items-stretch border bg-white self-stretch flex gap-4 mt-5 w-full p-4 rounded-3xl border-solid border-black border-opacity-10 max-md:max-w-full max-md:flex-wrap max-md:mr-2.5">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6056405e608fe5b9691386695203a927553b55443dd46905f5ae7d1f7147450a?" class="aspect-square object-contain object-center w-[100px] justify-center items-center overflow-hidden shrink-0 max-w-full"/>
            <span class="items-stretch flex grow basis-[0%] flex-col self-start max-md:max-w-full">
                <div class="text-black text-xl font-medium leading-7 max-md:max-w-full">
                    Step 3
                </div>
                <div class="text-black text-base leading-6 mt-2 max-md:max-w-full">
                    Check your email for the reservation code to use when checking the status of your reservation.
                </div>
            </span>
        </div>
        </span>
    </section>
    
    <footer class = "mt-10">
        <div class="mx-12 py-10 text-center md:text-left">
            <div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="">
                    <h6 class ="mt-12">
                    <div class="text-center align-center">
                        <img src="/images/lsu-logotype-colored.png" class="-mt-12 h-9"  style="justify-content: center; align-items: center;">  
                    </div>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>
                <div class="">
                    <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                        Title
                    </h6>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 dark:text-black">Link</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 dark:text-black">Link</a>
                    </p>
                    <p class="mb-4">
                        <a href="#!" class="text-neutral-600 dark:text-black">Link</a>
                    </p>
                    <p>
                        <a href="#!" class="text-neutral-600 dark:text-black">Link</a>
                    </p>
                </div>
                <div>
                    <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                        Contact
                    </h6>
                    <p class="mb-4 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5"> 
                            <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                    New York, NY 10012, US
                    </p>
                    <p class="mb-4 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5"> 
                            <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" /><path
                            d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                        </svg>
                    info@example.com
                    </p>
                    <p class="mb-4 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5"> 
                            <path fill-rule="evenodd"d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"clip-rule="evenodd" />
                        </svg>
                        + 01 234 567 88
                    </p>
                    <p class="flex items-center justify-center md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-5 w-5"> <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                    </svg>
                    + 01 234 567 89
                    </p>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-green-800 flex min-h-[70px] flex-col text-center text-white"><span class="mt-5">© 2023 Copyright. <span class="font-bold">La Salle University - Ozamiz</span></span></div> 
            </span>
        </div>
        
        
    </footer>

</body>


</html>

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

<body class="bg-[#E5EFE8]"">
    <nav class="w-full">
        <div class="flex items-center justify-between lg:justify-center py-4 px-6">
            <a class="flex items-center mx-auto lg:mx-0" href="/">
                <img src="/images/lsu-logo 2.png" alt="Logo" class="h-12">
            </a>
        </div>
    </nav>

    <section class="">
        <div class="flex relative flex-col items-start px-20 py-16 min-h-[440px] rounded-[100px] max-md:px-5 max-md:mx-4 md:ml-12 md:mr-12">
            <img
                loading="lazy"
                srcset="https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/0081b274fa8106289a577e3b7d8573936e07f1e7a391948a826ae4e447f2a302?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a"
                class="object-cover absolute inset-0 size-full rounded-3xl"/>
                <div class="relative pt-8 mt-12 text-6xl font-bold tracking-wider text-white leading-[50px] max-md:max-w-full max-md:text-4xl max-md:leading-10 ">
                    RESERVE
                    <span class="font-thin">YOUR</span> SPACE
                    <span class="font-thin"><br/>WITH</span> EASE
                </div>

            <div class="flex relative gap-1.5 justify-center items-center py-3 mt-2 ">
                <a href="make-reservation" class="flex flex-col justify-center self-stretch text-base font-medium text-black rounded-md border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105">
                    <div class="p-3 bg-white rounded-lg max-md:px-5">RESERVE NOW</div>
                </a>

                <div class="group flex flex-col justify-center self-stretch my-auto rounded-md border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105 relative">
                    <div class="flex flex-col justify-center items-center px-3 rounded-md bg-white bg-opacity-90 h-[43px] w-[43px]">
                        <img
                            loading="lazy"
                            srcset="https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/20c8d1dd4b05e66ab5c119b29549edc34e46b6690438dce9a1964504b5a4489b?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a"
                            class="object-contain w-full aspect-[0.94]"
                        />
                    </div>
                    <div class="text-xs absolute inset-0 flex items-center justify-center text-white hidden group-hover:flex bg-black bg-opacity-50 rounded-md">
                        Status
                    </div>
                </div>

                <a href="" class="group flex flex-col justify-center self-stretch my-auto rounded-md border border-solid border-black border-opacity-10 transition-transform duration-300 hover:scale-105 relative">
                    <div class="flex justify-center items-center px-3 rounded-md bg-white bg-opacity-90 h-[43px] w-[43px]">
                        <img
                            loading="lazy"
                            src="https://cdn.builder.io/api/v1/image/assets/TEMP/7b09d27cab37db47103086580c25867c01cbce72eb51be0b55484a7437aae598?apiKey=a25d9352c0e24748b58ba2c7e0217b4a&&apiKey=a25d9352c0e24748b58ba2c7e0217b4a"
                            class="border-2 aspect-square w-[18px]"/>
                    </div>
                    <div class=" text-[10px] absolute inset-0 flex items-center justify-center text-white hidden group-hover:flex bg-black bg-opacity-50 rounded-md">
                        Calendar
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="-mt-2">
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
                            <div class="ml-1 text-black text-base leading-6 whitespace-nowrap mt-3 font-bold">{{ $facility->facilityName }}</div>
                            <div class="ml-1 text-xs text-black text-base leading-6 whitespace-nowrap">{{ $facility->facilityStatus }}</div>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
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

    
    <section class="-mt-20">
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
    
    <footer class = "-mt-4">
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

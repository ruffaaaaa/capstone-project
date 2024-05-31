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

    <div class="flex flex-col justify-center px-16 py-9  w-full text-center text-white bg-green-800 max-md:px-5 max-md:max-w-full">
      <div class="flex justify-center items-center px-16 max-md:px-5 max-md:max-w-full">
        <div class="flex flex-col max-md:max-w-full">
          <div class="text-4xl font-bold leading-10 max-md:max-w-full">
            MAKE A RESERVATION
          </div>
          <div class="mt-6 text-base leading-6 max-md:max-w-full">
            Select the facility and time slot for your reservation.
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center items-center px-16 pt-8 pb-12 w-full bg-green-800 max-md:px-5 max-md:max-w-full">
    <div class="flex flex-col items-center px-12 py-12 mb-10 w-full bg-white max-w-[850px] rounded-[30px] max-md:px-5 max-md:mb-10 max-md:max-w-full background">
        <form id="storeReservationForm" action="{{ route('reservation.store') }}" method="POST">
            
            <div id="facilitiesForm" class="mx-auto flex flex-col items-center justify-center">
                <div class="mb-6 flex justify-center items-center"> 
                    <span class="text-2xl font-bold">FACILITIES</span>
                </div>
                <div class="mb-6 flex justify-center items-center relative"> 
                    <hr class="w-12 border-green-900 border-2 absolute animate-line">
                </div>
            
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-5">
                    @foreach ($facilities as $facility)
                        <div class="mb-2 sm:col-span-1 md:col-span-1">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="facility_checkbox[{{ $facility->facilityID }}]" class="form-checkbox equipment-checkbox">
                                <span class="text-l font-bold">{{ $facility->facilityName }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <div class="items-center mb-5 mt-5 ml-4 mr-4">
                <label class="w-32 text-gray-700 text-sm font-bold">Name of Event:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nameofevent" name="nameofevent" type="text" required>
            </div>
            <div class="items-center mb-5 mt-5 ml-4 mr-4">
                <label class=" w-32 text-gray-700 text-sm font-bold mb-2" for="start-date">Maximum Expected Number of Attendees:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="max-attendees" name="max-attendees" type="text" required>
            </div>
            
            <div class="items-center mb-5 mt-5 ml-4 mr-4">
                <label class="w-32 text-gray-700 text-sm font-bold">Requested By:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="reserveeName" name="reserveeName" type="text" required>
                                
            </div>
            <div class="items-center mb-5 mt-5 ml-4 mr-4">
                <label class="w-32 text-gray-700 text-sm font-bold">Person-in-Charge of Event:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="person_in_charge_event" name="person_in_charge_event" type="text" required>
            </div>

            <div id="myModal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="modal-container bg-green-700 w-100px mt-48 md:max-w-md mx-auto rounded shadow-xxl z-50 overflow-y-auto">
                    <div class="mt-5 mb-5 flex flex-col items-center justify-center">
                        <a href="/" class="m-4">
                            <img src="/images/lsu-logo 2.png" class="mx-auto w-16 h-30" />
                        </a>
                        <span class="font-bold text-2xl text-white text-center">YOUR RESERVATION REQUEST IS SUBMITTED.</span>
                        <span id="reservation-code" class="text-center text-white mt-2">Reservation Code: </span> 
                        <a href="/" class="border border-white px-4 py-2 mt-5 text-white rounded-xl mb-5">Home</a>
                    </div>

                </div>
            </div>


            <div class="flex justify-center w-full mb-4 max-md:mb-0" id="buttonContainer">
            
                <button id="submitButton" class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded-lg bg-green-950 max-md:px-5">
                    Submit
                </button>
            </div>
        </form>
    </div>
    
</div>


</body>



</html>
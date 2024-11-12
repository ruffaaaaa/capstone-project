<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>Facilities Reservation System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/calendarcustom.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-[#E5EFE8]">
    <nav class="w-full -mt-2 -mb-2">
        <div class="flex items-center justify-between lg:justify-center py-4 px-6">
            <a class="flex items-center mx-auto lg:mx-0" href="/">
                <img src="/images/corporate-logo-new.png" alt="Logo" class="h-10">
            </a>
        </div>
    </nav>
    <div class="flex flex-col lg:flex-row h-full bg-green-900 px-16 py-9 max-md:px-5 max-md:py-5 max-lg:w-full">
        <div class="min-h-full bg-white p-3 w-1/5 rounded drop-shadow-md mr-2 mb-2 max-md:w-full max-md:px-2 max-lg:w-full max-lg:px-5 max-lg:w-full ">
            <div class="flex items-center justify-center">
                <span class="font-bold text-center">FILTER</span>
            </div>
            <div >
                <div class="relative inline-block mt-2 mb-2 w-full">
                    <div class="relative inline-block text-left mt-2 mb-2">
                        <div>
                            <span class="bg-[#f51161] rounded-full h-3 w-3 inline-block"></span>
                            <span>Event</span>
                        </div>
                        <div>
                            <span class="bg-[#38baa2] rounded-full h-3 w-3 inline-block"></span>
                            <span>Preparation</span>
                        </div>
                        <div>
                            <span class="bg-[#2792b0] rounded-full h-3 w-3 inline-block"></span>
                            <span>Clean-up</span>
                        </div>
                    </div>
                    <label for="scheduleFilter" class="block text-sm font-medium text-gray-700 mb-1">Schedule:</label>
                    <div class="relative">
                        <select id="scheduleFilter" class="text-xs block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-3 py-2 rounded leading-tight focus:outline-none focus:shadow-outline" onchange="filterEvents(this.value)">
                            <option value="all" class="text-xs">Select</option>
                            <option value="eventProper" class="text-xs">Event Proper</option>
                            <option value="preparation" class="text-xs">Preparation</option>
                            <option value="cleanup" class="text-xs">Cleanup</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-0 text-gray-700">
                            <svg class="fill-current h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M7 7l3-3 3 3m0 6l-3 3-3-3"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative inline-block text-left mt-2 mb-2 w-full">
                    <label for="facilityFilter" class="block text-sm font-medium text-gray-700 mb-1">Facility:</label>
                    <select id="facilityFilter" class="block text-xs appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-3 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" onchange="filterByFacility(this.value)">
                            <option value="text-xs">Select</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4 mt-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 7l3-3 3 3m0 6l-3 3-3-3"></path></svg>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="w-full lg:w-3/3 lg:mb-0 mb-2 mx-0">
            <div class="h-full bg-white p-4 rounded drop-shadow-md">
                <div id="calendar-controls" class="flex flex-wrap">
                    <button id="today-btn" class="flex min-h-[38px] w-[100px] items-center justify-center gap-2.5 overflow-hidden rounded bg-green-800 font-bold text-white max-md:hidden">Today</button>
                    <button id="prev-btn" class="mx-1 flex min-h-[35px] w-[40px] items-center justify-center overflow-hidden rounded bg-green-800 px-2 text-white max-md:w-[25px] max-md:text-[10px]">&lt;</button>
                    <button id="next-btn" class="flex min-h-[35px] w-[40px] items-center justify-center overflow-hidden rounded bg-green-800 px-2 text-white  max-md:w-[25px] max-md:text-[10px]">&gt;</button>
                    <span id="calendar-title" class="text-2xl h-[38px] mt-1 overflow-hidden px-2.5 font-semibold text-black uppercase "></span>
        
                    <div class="flex ml-auto">
                        <select id="view-selector" class="block w-full  text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 uppercase text-sm max-md:text-xs font-bold">
                            <option value="month">Month</option>
                            <option value="agendaWeek">Week</option>
                            <option value="agendaDay">Day</option>
                        </select>
                    </div>
                </div>
                <div id="calendar" class="-mt-5"></div>
            </div>
        </div>

        <div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full max-md:mx-4">
                <div class="flex gap-2 justify-between items-center font-bold mb-4 ">
                    <div class=" pb-1 text-2xl font-bold tracking-tighter leading-4 text-green-700 max-w-[282px]">
                        <span id="eventTitle" class="text-2xl uppercase max-md:text-2xl"></span>
                    </div>
                    <button id="closeModal"class="text-lg tracking-tighter text-white ">
                        <div class="px-4 py-2 bg-green-700 rounded ">x</div>
                    </button>
                </div>
                <p><strong>Facilities:</strong> <span id="eventFacilities"></span></p>
                <p><strong>Start Time:</strong> <span id="eventStart"></span></p>
                <p><strong>End Time:</strong> <span id="eventEnd"></span></p>
            </div>
        </div>
    </div>
</div>  

    

   
</body>
    <script src="/js/calendar.js"></script>
</html>


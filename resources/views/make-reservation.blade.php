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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>

<body class="bg-[#E5EFE8]">
    <nav class="w-full">
        <div class="flex items-center justify-between lg:justify-center py-4 px-6">
            <a class="flex items-center mx-auto lg:mx-0" href="/">
                <img src="/images/corporate-logo-new.png" alt="Logo" class="h-10">
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
    <div class="flex justify-center items-center px-16 pb-12 w-full bg-green-800 max-md:px-5 max-md:max-w-full">
        <div class="flex flex-col items-center px-12 py-12 mb-10 w-full bg-white max-w-[850px] rounded max-md:px-5 max-md:mb-10 max-md:max-w-full background">
            <form id="storeReservationForm" action="{{ route('reservation.store') }}" method="POST" class="w-full">
                @csrf
                <div id="facilitiesForm" class="mx-auto flex flex-col items-center justify-center">
                    <div class="mb-6 flex justify-center items-center"> 
                        <span class="text-2xl font-bold">FACILITIES</span>
                    </div>
                    <div class="mb-6 flex justify-center items-center relative"> 
                        <hr class="w-12 border-green-900 border-2 absolute animate-line">
                    </div>

                    <div class="mb-6 flex items-center justify-center">
                        <input type="text" id="facilitySearch" placeholder="Search facilities..." 
                            class="max-md:w-full w-72 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-5" id="facilityList">
                        @foreach ($facilities as $facility)
                            <div class="facility-item mb-2 sm:col-span-1 md:col-span-1 p-3">
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" name="facility_checkbox[{{ $facility->facilityID }}]" id="facility-{{ $facility->facilityID }}" value="{{ $facility->facilityID }}" class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label class="text-l font-bold text-gray-700">{{ $facility->facilityName }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="noFacilitiesAlert" class="text-center text-red-500 mb-4 hidden">No facilities found.</div>

                    <div id="facilitiesAlert" class="text-center hidden text-red-500 mb-4">Please select at least one facility.</div>
                </div>

                <div id="reservationDetailsForm" class="hidden mx-full flex flex-col items-center justify-center">
                    <div class="mb-6 flex justify-center items-center"> 
                        <span class="text-2xl font-bold">RESERVATION DETAILS</span>
                    </div>
                    <div class="mb-6 flex justify-center items-center relative"> 
                        <hr class="w-14 border-green-900 border-2 absolute animate-line">
                    </div>
                    <div class = "w-full">
                        <div class="bg-[#076334] p-2 ">
                            <span class="text-l font-bold text-white pl-4">EVENT DETAILS</span>
                        </div>

                        <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Name of Event:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nameofevent" autocomplete="new-nameofevent" name="nameofevent" type="text" required>

                        </div>
                        <div class="items-center mb-5 mt-5 ml-4 mr-4">
                            <label class=" w-32 text-gray-700 text-sm font-bold mb-2" for="start-date">Maximum Expected Number of Attendees:</label>
                            <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="max-attendees" name="max-attendees" autocomplete="new-max-attendees"type="number" required>
                        </div>
                        
                        <label class="text-gray-700 text-sm font-bold mb-2 ml-4 mr-4 hidden md:block" for="event-start-date">Start and End Date-Time of the Event Proper </label>
                        <div class="flex flex-col md:flex-row items-center mb-5 mt-5 ml-4 mr-4">
                            <div class="mb-2 md:mb-0 md:mr-2 w-full">
                                <label class="text-gray-700 text-sm font-bold mb-10 md:hidden" id="event-start-date-label" for="event-start-date">Start Date and Time of Event:</label>
                                <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="event-start-date" name="event-start-date" type="datetime-local" required>
                            </div>
                            <div class="hidden md:block mr-4 ml-4">
                                <h1>-</h1>
                            </div>
                            <div class="mb-2 md:mb-0 md:ml-2 w-full">
                                <label class="text-gray-700 text-sm font-bold mb-10 md:hidden" id="event-end-date-label" for="event-end-date">End Date and Time of Event:</label>
                                <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="event-end-date" name="event-end-date" type="datetime-local" required>
                            </div>
                        </div>

                        <div id="preparation-section">
                            <div class="flex items-center mb-2 mt-2 ml-4 mr-4">
                                <input type="checkbox" id="preparation-required" class="form-checkbox">
                                <label for="preparation-required" class="ml-2 text-gray-700 text-sm font-bold">Check if Preparation is Required</label>
                            </div>
                            <div id="preparation-fields" class="hidden">
                                <label class="text-gray-700 text-sm font-bold mb-2 ml-4 mr-4 hidden md:block" for="preparation-start-date">Start and End Date-Time for Event Preparation</label>
                                <div class="flex flex-col md:flex-row items-center mb-5 mt-5 ml-4 mr-4">
                                    <div class="mb-2 md:mb-0 md:mr-2 w-full">
                                        <label class="text-gray-700 text-sm font-bold mb-4 md:hidden" for="preparation-start-date">Start Date-Time for Event Preparation:</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="preparation-start-date" name="preparation-start-date" type="datetime-local">
                                    </div>
                                    <div class="hidden md:block mr-4 ml-4">
                                        <h1>-</h1>
                                    </div>
                                    <div class="mb-2 md:mb-0 md:ml-2 w-full">
                                        <label class="text-gray-700 text-sm font-bold mb-2 md:hidden" for="preparation-end-date">End Date-Time for Event Preparation:</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="preparation-end-date" name="preparation-end-date" type="datetime-local">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="cleanup-section">
                            <div class="flex items-center mb-2 mt-2 ml-4 mr-4">
                                <input type="checkbox" id="cleanup-required" class="form-checkbox">
                                <label for="cleanup-required" class="ml-2 text-gray-700 text-sm font-bold">Check is Cleanup is Required</label>
                            </div>
                            <div id="cleanup-fields" class="hidden">
                                <label class="text-gray-700 text-sm font-bold mb-2 ml-4 mr-4 hidden md:block" for="cleanup-start-date">Start and End Date-Time for Cleanup</label>
                                <div class="flex flex-col md:flex-row items-center mb-5 mt-5 ml-4 mr-4">
                                    <div class="mb-2 md:mb-0 md:mr-2 w-full">
                                        <label class="text-gray-700 text-sm font-bold mb-4 md:hidden" for="cleanup-start-date">Start Date-Time of Cleanup:</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cleanup-start-date" name="cleanup-start-date" type="datetime-local">
                                    </div>
                                    <div class="hidden md:block mr-4 ml-4">
                                        <h1>-</h1>
                                    </div>
                                    <div class="mb-2 md:mb-0 md:ml-2 w-full">
                                        <label class="text-gray-700 text-sm font-bold mb-2 md:hidden" for="cleanup-end-date">End Date-Time of Cleanup:</label>
                                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cleanup-end-date" name="cleanup-end-date" type="datetime-local">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-1/2 pt-2 pl-2 pr-2 ">
                            <div class="bg-[#076334] p-2">
                                <span class="text-l font-bold text-white pl-4">EQUIPMENT</span>
                            </div>
                            <div>
                                <div class="mb-2 mt-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Chair" name="equipment[Chair]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Chair</span>
                                        <input type="number" class="px-2 py-1 border rounded equipment-input input-size" name="equipment_no[Chair]" autocomplete="new-equipment_no[Chair]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Table" name="equipment[Table]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Table</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Table]" autocomplete="new-equipment_no[Table]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>

                                <div class="mb-2 mt-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Sound System" name="equipment[Sound System]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Sound System</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Sound System]" autocomplete="new-equipment_no[Sound System]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Microphone" name="equipment[Microphone]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Microphone</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Microphone]" autcomplete="new-equipment_no[Microphone]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Plants" name="equipment[Plants]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Plants</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Plants]" autocomplete="new-equipment_no[Plants]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Comfort Rooms" name="equipment[Comfort Rooms]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Comfort Rooms</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Comfort Rooms]" autocomplete="new-equipment_no[Comfort Rooms]" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox equipment-checkbox" value="Internet Access" name="equipment[Internet Access]">
                                    <div class="flex justify-between w-full items-center">
                                        <span>Internet Access</span>
                                        <input type="number" class="px-2 py-1  border rounded equipment-input input-size" name="equipment_no[Internet Access]" autocomplete="new-equipment_no[Internet Access]"  placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-2 items-center">
                                    <input type="checkbox" id="other-equipment" class="form-checkbox">
                                    <span>Other, please specify</span>
                                    <input type="text" id="other-equipment-name" class="mt-2 w-full px-2 py-2 border rounded name-size" name="other_equipment_name" autocomplete="new-other_equipment_name" placeholder="Name" style="display: none;">
                                    <input type="number" id="other-equipment-number" class="mt-2 w-full px-3 py-2 border rounded name-size" name="other_equipment_no" autocomplete="new-other_equipment_no" placeholder="No. Required" style="display: none;">
                                </div>
                            </div>
                            </div>
                            <div class="w-full lg:w-1/2 pt-2 pl-2 pr-2 ">
                                <div class="bg-[#076334] p-2">
                                    <span class="text-l font-bold text-white pl-4">SUPPORT PERSONNEL</span>
                                </div>
                                <div>
                                    <div class="mb-2 mt-2 flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox personnel-checkbox" value="Maintenance Crew (Regular)" name="personnel[Maintenance Crew (Regular)]" autocomplete="new-personnel[Maintenance Crew (Regular)]">
                                        <div class="flex justify-between w-full items-center">
                                            <span>Maintenance Crew (Regular)</span>
                                            <input type="number" class="px-2 py-1  border rounded personnel-input input-size" name="personnel_no[Maintenance Crew (Regular)]" autocomplete="new-personnel[Maintenance Crew (Regular)]"  placeholder="No. Required" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="mb-2 flex items-center space-x-2" value="Maintenance Crew (Overtime)" name="personnel[Maintenance Crew (Overtime)]" autocomplete="new-personnel[Maintenance Crew (Overtime)]">
                                        <input type="checkbox" class="form-checkbox personnel-checkbox">
                                        <div class="flex justify-between w-full items-center">
                                            <span>Maintenance Crew (Overtime)</span>
                                            <input type="number" class="px-2 py-1  border rounded personnel-input input-size" name="personnel_no[Maintenance Crew (Overtime)]" autocomplete="new-personnel[Maintenance Crew (Overtime)]" placeholder="No. Required" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="mb-2 flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox personnel-checkbox" value="Sound/Light Technician" name="personnel[Sound/Light Technician]" autocomplete="new-personnel[Sound/Light Technician]">
                                        <div class="flex justify-between w-full items-center">
                                            <span>Sound/Light Technician</span>
                                            <input type="number" class="px-2 py-1  border rounded personnel-input input-size" name="personnel_no[Sound/Light Technician]" autocomplete="new-personnel[Sound/Light Technician]" placeholder="No. Required" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="mb-2 flex items-center space-x-2">
                                        <input type="checkbox" class="form-checkbox personnel-checkbox" value="Nurse/First Aider" name="personnel[Nurse/First Aider]" autocomplete="new-personnel[Nurse/First Aider]" >
                                        <div class="flex justify-between w-full items-center">
                                            <span>Nurse/First Aider</span>
                                            <input type="number" class="px-2 py-1  border rounded personnel-input input-size" name="personnel_no[Nurse/First Aider]" autocomplete="new-personnel[Nurse/First Aider]" placeholder="No. Required" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="mb-2 items-center">
                                        <input type="checkbox" id="other-personnel" class="form-checkbox">
                                        <span>Other, please specify</span>
                                        <input type="text" id="other-personnel-name" class="mt-2 w-full px-2 py-2 border rounded name-size" name="other_personnel_name" autocomplete="new-other_personnel_name" placeholder="Name" style="display: none;">
                                        <input type="number" id="other-personnel-number" class="mt-2 w-full px-3 py-2 border rounded name-size" name="other_personnel_no" autocomplete="new-other_personnel_no" placeholder="No. Required" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="bg-[#076334] p-2">
                                <span class="text-l font-bold text-white pl-4">B5. ATTACHMENTS <p class="text-xs font-normal ml-4 max-md:text-[9px]">(Venue Layout, Letter of Request, Signed Activity Proposal for Art Center)</p></span>
                            </div>
                            <div class="flex pt-5">
                            <input type="file" id="attachments" name="attachments[]" accept=".png, application/pdf" multiple class="hidden" onchange="displayFiles()">
                            <label for="attachments" class="inline-block bg-green-100 text-green-700 rounded-full w-10 h-10 text-center cursor-pointer m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                </svg>
                            </label>
                            <div id="fileList" class="text-black" style="margin: 15px;"></div>
                        </div>

                        </div>
                    </div>
                    <div id="equipmentAlert" class="text-center hidden text-red-500 mb-4">Please fill all required fields.</div>

                </div>

                <div id="customerDetailsForm" class="hidden">
                    <div class="mb-6 flex justify-center items-center"> 
                        <span class="text-2xl font-bold">RESERVEE DETAILS</span>
                    </div>
                    <div class="mb-6 flex justify-center items-center relative">
                        <hr class="w-12 border-green-900 border-2 absolute animate-line">
                    </div>

                    <div class="bg-[#5CC273] p-2 hidden">
                        <span class="text-l font-bold text-white pl-4">EVENT DETAILS</span>
                    </div>

                    

                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Requested By:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="reserveeName" name="reserveeName" autocomplete="new-reserveeName" type="text" required>
                    </div>

                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Role:</label>
                        <span id="radioErrorText" class="text-red-600 text-sm hidden">(Please select a role)</span>

                        <div class="flex space-x-10 mt-4">
                            <label class="text-sm text-gray-700">
                                <input type="radio" name="userType" value="student" id="studentRadio" required> STUDENT
                            </label>
                            <label class="text-sm text-gray-700">
                                <input type="radio" name="userType" value="faculty" id="facultyRadio" required> FACULTY
                            </label>
                            <label class="text-sm text-gray-700">
                                <input type="radio" name="userType" value="staff" id="staffRadio" required> STAFF
                            </label>
                        </div>
                    </div>
                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Email:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="email" name="email" autocomplete="new-email" type="email" required>
                        <span id="emailErrorText" class="email-error text-red-600 text-sm hidden">Please use your LSU email address.</span>
                    </div>
                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Contact Number:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>

                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="contact_details" name="contact_details" autocomplete="new-contact_details" type="number" required>
                    </div>
                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Person-in-Charge of Event:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="person_in_charge_event" name="person_in_charge_event" autocomplete="new-person_in_charge_event" type="text" required>
                    </div>
                    
                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Unit/Department/Company:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>

                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="unit_department_company" name="unit_department_company" autocomplete="new-unit_department_company" type="text" required>
                    </div>
                    <div class="items-center mb-5 mt-5 ml-4 mr-4">
                        <label class="w-32 text-gray-700 text-sm font-bold">Date of Filing:</label>
                        <span class="required-text text-red-600 text-sm hidden">(Required)</span>

                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required-field" id="date_of_filing" name="date_of_filing" autocomplete="new-date_of_filing" type="date" required>
                    </div>

                    
                    <div id="endorserFields" class="items-center mb-5 mt-5 ml-4 mr-4 hidden">
                        <label class="w-32 text-gray-700 text-sm font-bold">Endorsed by:</label>
                        <span id="endorserError" class="text-red-600 text-sm hidden">(Required).</span> <!-- Error message -->
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="endorsed_by" name="endorsed_by" autocomplete="new-endorsed_by" type="text" disabled>
                    </div>
                    <div class="items-center mb-5 mt-5 ml-4 mr-4 hidden" id="endorserEmailField">
                        <label class="w-32 text-gray-700 text-sm font-bold">Endorser Email:</label>
                        <span id="endorserEmailError" class="text-red-600 text-sm hidden">(Required).</span> 
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="endorser_email" name="endorser_email" autocomplete="new-endorser_email" type="email" disabled required>
                        <span id="endorserEmailErrorText" class="email-error text-red-600 text-sm hidden">Please use your LSU email address.</span>
                    </div>



                    <div id="captchaSection" class="items-center mb-5 mt-5 ml-4 mr-4 hidden">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        <span id="captchaErrorText" class="text-red-600 text-sm hidden">Please complete the CAPTCHA.</span>

                    </div>

                    <div id="customerDetailsAlert" class="text-center hidden text-red-500 mb-4">Please fill all required fields.</div>
                </div>

                <div class="flex justify-center  w-full mb-4 max-md:mb-0" id="progressCircles">
                    <div class="w-3 h-3 m-2 bg-green-950 rounded-full"></div>
                    <div class="w-3 h-3 m-2 bg-gray-300 rounded-full"></div>
                    <div class="w-3 h-3 m-2 bg-gray-300 rounded-full"></div>
                </div>

                <div id="loadingSpinner" class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-50 bg-black hidden">
                    <div class="loader"></div>
                </div>

                <div class="flex justify-center w-full mb-4 max-md:mb-0" id="buttonContainer">
                    <button class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded bg-green-950 hover:bg-green-900 max-md:px-5 hover:border-white" id="prevButton">
                        Previous
                    </button>
                    <button class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded bg-green-950 hover:bg-green-900 max-md:px-5 hover:border-white" id="nextButton">
                        Next
                    </button>
                    <button id="submitButton" class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded bg-green-950 hover:bg-green-900 hover:border-white max-md:px-5 hidden">
                        Submit
                    </button>
                </div>

            </form>

            <div id="myModal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center  bg-gray-800 bg-opacity-50 pointer-events-none">
                <div class="modal-container  w-full h-screen max-md:mx-10 md:max-w-md mx-auto rounded shadow-3xl z-50 overflow-y-auto flex flex-col justify-center pointer-events-auto">
                    <div class="p-10 mb-5 flex flex-col items-center justify-center bg-green-700">
                        <a href="/" class="m-4">
                            <img src="/images/lsu-logo-star-white.png" class="mx-auto w-24 h-30" />
                        </a>
                        <span class="font-bold text-2xl text-white text-center">YOUR RESERVATION REQUEST IS SUBMITTED.</span>
                        <span id="modal-message" class="text-center text-white mt-2 text-xs">Please check your email for the reservation code and have your endorser confirm the endorsement.</span>
                        <a href="/" class="border border-white px-4 py-2 mt-5 text-white mb-5">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/js/reservationmodal.js"></script>
<script src="/js/date.js"></script>
<script src="/js/search.js"></script>



</html>
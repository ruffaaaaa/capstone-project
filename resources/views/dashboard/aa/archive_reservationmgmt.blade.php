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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class=" no-transition relative bg-[#E5EFE8] overflow-hidden max-h-screen">
    <div class="p-8 max-h-screen overflow-auto">
        <div class="max-h-screen shadow-md w-full">
            <div class=" mx-auto">
                <div class="bg-white rounded  p-8 mb-5">
                    <div class="row">
                        <div class="col-md-12">  
                    </div>
                <div>
                <div class="mb-3">
                    <div class="relative flex justify-between items-center mt-2 mb-2 w-full">
                        <div class="flex gap-1.5 ">
                        <a href="{{ route('admin.reservation', ['role_id' => $user->role_id, 'isArchived' => false]) }}" class="mt-1.5">
                                <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">

                                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                                    <g id="SVGRepo_iconCarrier"> <title>arrow-left-square</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-414.000000, -985.000000)" fill="#087830"> <path d="M436,1002 L425.414,1002 L429.535,1006.12 C429.926,1006.51 429.926,1007.15 429.535,1007.54 C429.145,1007.93 428.512,1007.93 428.121,1007.54 L422.465,1001.879 C422.225,1001.639 422.15,1001.311 422.205,1001 C422.15,1000.689 422.225,1000.361 422.465,1000.121 L428.121,994.465 C428.512,994.074 429.145,994.074 429.535,994.465 C429.926,994.855 429.926,995.488 429.535,995.879 L425.414,1000 L436,1000 C436.553,1000 437,1000.448 437,1001 C437,1001.553 436.553,1002 436,1002 L436,1002 Z M442,985 L418,985 C415.791,985 414,986.791 414,989 L414,1013 C414,1015.21 415.791,1017 418,1017 L442,1017 C444.209,1017 446,1015.21 446,1013 L446,989 C446,986.791 444.209,985 442,985 L442,985 Z" id="arrow-left-square" sketch:type="MSShapeGroup"> </path> </g> </g> </g>

                                </svg>
                            </a>
                            <h1 class="font-bold text-2xl">ARCHIVE</h1>
                        </div>
                        <div class="relative inline-block flex justify-end">
                            <div class="mr-2 relative">
                                <input type="search" id="searchInput" onkeyup="searchTable()" class="w-[300px] text-xs px-3 py-2 text-gray-700 bg-white border-2 border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" placeholder="Search..." />
                                <div class="absolute inset-y-0 right-2 flex items-center pl-3 pointer-events-none">
                                    <svg width="12" height="12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="..." fill="black"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="profileModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-600 bg-opacity-50">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full mr-3">
                                        <a href="/" class="-mt-8">
                                            <img src="/images/profile-icon.png" class="mx-auto w-10 h-30" />
                                        </a>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Account Profile</h3>
                                        

                                        <form id="editprofileForm" onsubmit="submitProfileForm(event)" method="POST" action="{{ route('profile.update', ['role_id' => $user->role_id, 'id' => $user->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                            @method('PUT')

                                            <div class="mt-2">
                                                <label for="username" class="block text-sm font-medium text-gray-700 text-left">Username</label>
                                                <input type="text" name="username" id="username" value="{{ $user->username }}" required 
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>

                                            <div class="mt-2">
                                                <label for="email" class="block text-sm font-medium text-gray-700 text-left">Email</label>
                                                <input type="email" name="email" id="email" value="{{ $user->email }}" required
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>

                                            <div class="mt-2">
                                                <label for="password" class="block text-sm font-medium text-gray-700 text-left">Password (leave empty if you don't want to change it)</label>
                                                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>

                                            <div class="mt-2">
                                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 text-left">Confirm Password</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div class="mt-2 modal-message border boder-green-600 bg-green-50 px-4" style="display: none;">

                                            </div>
            
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" form="editprofileForm" class="inline-flex justify-center w-full border rounded-md border-transparent px-4 py-2 bg-green-600 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                                    <button id="closeProfile" class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <table id="reservationTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Facility</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Final Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y divide-gray-200 w-full">
                            @if ($reservationDetails->count())
                                @foreach($reservationDetails as $detailsGroup) {{-- Each item is a collection for a specific reserveeID --}}
                                    @php
                                        // Sort the detailsGroup collection by the custom order for role names
                                        $customOrder = ['AA', 'CISSO', 'GSO'];
                                        $sortedDetailsGroup = $detailsGroup->sortBy(function ($detail) use ($customOrder) {
                                            return array_search($detail->role_name, $customOrder);
                                        })->unique('role_name');

                                        $east = $sortedDetailsGroup->where('role_name', 'AA')->first();
                                        $cisso = $sortedDetailsGroup->where('role_name', 'CISSO')->first();
                                        $gso = $sortedDetailsGroup->where('role_name', 'GSO')->first();
                                    @endphp

                                    @if($east && $east->approval_status === 'Denied' || $detailsGroup->first()->final_status === 'Cancelled')

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->reserveeID }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->event_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                            {{ $detailsGroup->pluck('facilityName')->unique()->implode(', ') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->final_status }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                                        <button class="border-solid border-1 border-gray-500 text-blue-500 px-3 py-1 rounded hover:bg-blue-500 hover:text-white ml-2 viewButton"
                                        onclick="openModal(
                                            '{{ $detailsGroup->first()->reserveeID }}', 
                                            '{{ addslashes($detailsGroup->first()->reserveeName) }}', 
                                            '{{ addslashes($detailsGroup->first()->person_in_charge_event) }}', 
                                            '{{ addslashes($detailsGroup->first()->contact_details) }}', 
                                            '{{ addslashes($detailsGroup->first()->unit_department_company) }}', 
                                            '{{ $detailsGroup->first()->date_of_filing }}', 
                                            '{{ $detailsGroup->first()->confirmation ? '1' : '0' }}', 
                                            '{{ addslashes($detailsGroup->first()->endorser_name) }}', 
                                            '{{ addslashes($detailsGroup->first()->final_status) }}', 
                                            '{{ implode(', ', $detailsGroup->pluck('facilityName')->unique()->toArray()) }}', 
                                            '{{ $detailsGroup->first()->event_start_date }}', 
                                            '{{ $detailsGroup->first()->event_end_date }}', 
                                            '{{ $detailsGroup->first()->preparation_start_date }}', 
                                            '{{ $detailsGroup->first()->preparation_end_date_time }}', 
                                            '{{ $detailsGroup->first()->cleanup_start_date_time }}', 
                                            '{{ $detailsGroup->first()->cleanup_end_date_time }}',
                                            '{{ addslashes($detailsGroup->first()->event_name) }}', 
                                            '{{ $detailsGroup->first()->max_attendees }}', 
                                            '{{ implode(', ', $detailsGroup->pluck('pname')->unique()->toArray()) }}', 
                                            '{{ implode(', ', $detailsGroup->pluck('ptotal_no')->unique()->toArray()) }}', 
                                            '{{ implode(', ', $detailsGroup->pluck('ename')->unique()->toArray()) }}', 
                                            '{{ implode(', ', $detailsGroup->pluck('etotal_no')->unique()->toArray()) }}', 
                                            '{{ $east->approval_status ?? '' }}', 
                                            '{{ $cisso->approval_status ?? '' }}', 
                                            '{{ $gso->approval_status ?? '' }}', 
                                            '{{ json_encode($detailsGroup->map(function($item) { return ['url' => $item->attachment_path, 'name' => basename($item->attachment_path)]; })->toArray()) }}'
                                        )">
                                        View
                                    </button>

   


                                            <button class="border-solid border-1 border-gray-500 text-green-500 px-3 py-1 font-semibold rounded hover:bg-green-500 hover:text-white ml-2 editButton"
                                                    data-approval-id="{{ $detailsGroup->first()->approvalID }}" data-reservee-id="{{ $detailsGroup->first()->reserveeID }}"
                                                    onclick="openStatus(this)">
                                                Update
                                            </button>

                                            <form method="POST" action="{{ route('reservation.destroy', ['role_id' => $user->role_id, 'reservedetailsID' => $detailsGroup->first()->reservedetailsID]) }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-solid border-1 border-gray-500 text-red-500 px-3 py-1 font-semibold rounded hover:bg-red-500 hover:text-white ml-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif

                                @endforeach
                            @endif
                        </tbody>
                    </table>

                     <div class="mt-4 flex justify-center space-x-2">
                        {{-- Previous Button --}}
                        @if ($reservationDetails->onFirstPage())
                            <button class="px-2 py-1 text-sm text-gray-500 bg-gray-200 cursor-not-allowed rounded"><</button>
                        @else
                            <a href="{{ $reservationDetails->previousPageUrl() }}">
                                <button class="px-2 py-1 bg-gray-200 hover:text-white text-sm hover:bg-green-600 rounded"><</button>
                            </a>
                        @endif

                        {{-- Page Number Buttons --}}
                        @if ($reservationDetails->lastPage() > 1)
                            {{-- Show first page --}}
                            <a href="{{ $reservationDetails->url(1) }}">
                                <button class="px-2 py-1 text-sm {{ $reservationDetails->currentPage() == 1 ? 'text-white bg-green-700' : 'text-black bg-gray-200 hover:bg-green-200' }} rounded">1</button>
                            </a>

                            {{-- Show ellipsis if needed --}}
                            @if ($reservationDetails->currentPage() > 4)
                                <span class="px-2 py-1 text-sm text-gray-500">...</span>
                            @endif

                            {{-- Show pages around the current page --}}
                            @for ($page = max(2, $reservationDetails->currentPage() - 2); $page <= min($reservationDetails->lastPage() - 1, $reservationDetails->currentPage() + 2); $page++)
                                @if ($page == $reservationDetails->currentPage())
                                    <button class="px-2 py-1 text-sm text-white bg-green-700 rounded">{{ $page }}</button>
                                @else
                                    <a href="{{ $reservationDetails->url($page) }}">
                                        <button class="px-2 py-1 text-sm text-black bg-gray-200 hover:bg-green-200 rounded">{{ $page }}</button>
                                    </a>
                                @endif
                            @endfor

                            {{-- Show ellipsis if needed --}}
                            @if ($reservationDetails->currentPage() < $reservationDetails->lastPage() - 3)
                                <span class="px-2 py-1 text-sm text-gray-500">...</span>
                            @endif

                            {{-- Show last page --}}
                            <a href="{{ $reservationDetails->url($reservationDetails->lastPage()) }}">
                                <button class="px-2 py-1 text-sm {{ $reservationDetails->currentPage() == $reservationDetails->lastPage() ? 'text-white bg-green-700' : 'text-black bg-gray-200 hover:bg-green-200' }} rounded">{{ $reservationDetails->lastPage() }}</button>
                            </a>
                        @endif

                        {{-- Next Button --}}
                        @if ($reservationDetails->hasMorePages())
                            <a href="{{ $reservationDetails->nextPageUrl() }}">
                                <button class="px-2 py-1 text-sm bg-gray-200 hover:text-white hover:bg-green-600 rounded">></button>
                            </a>
                        @else
                            <button class="px-2 py-1 text-sm text-gray-500 bg-gray-200 cursor-not-allowed rounded">></button>
                        @endif
                    </div>

                    
                    <div id="viewModal" class="modal overflow-auto  items-center bg-gray-900 bg-opacity-50 hidden">
                        
                        <div class="modal-content my-6  w-a4-width  max-w-4xl rounded bg-white p-6 shadow max-lg: w-full ">
                            <div class=" ">
                                <table class="w-full border border-black mb-1">
                                    <thead>
                                        <tr class="border border-black bg-gray-100">
                                        <th rowspan="5" colspan="2" style="width:5%"><img src="/images/corporate-logo-new.png" class="mx-auto h-10" /></th>
                                        <td class="border border-black bg-white text-center">
                                            <span class="text-xs font-bold">La Salle University - Ozamiz City</span><br />
                                            <span class="">ADMINISTRATIVE SERVICES</span>
                                        </td>
                                        </tr>

                                        <tr class="border border-black">
                                        <th rowspan="2" style="width:20%" class="border border-black text-center font-normal">FACILITIES RESERVATION</th>
                                        </tr>
                                    </thead>
                                </table>


                                <table class=" w-full">
                                    <thbody>
                                        <tr class="">
                                            <th class="border border-black px-2 font-bold bg-gray-100" style = "width:25%">RESERVATION ID</th>
                                            <td class="border border-black px-2 " style = "width:25%"><span id="reserveeID"></span></td>
                                            <th class="border border-black px-2 font-bold bg-gray-100" style = "width:25%">Status</th>
                                            <td class="border border-black px-2" style = "width:25%"><span id="status1"></span></td> 
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="border border-black px-2 font-bold bg-gray-300" style>A. FACILITIES</th>
                                        </tr>
                                        <tr class="">
                                            <td colspan="4" class="border border-black  px-2 py-2 text-sm"><span id="facilityNames"></span>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="border border-black px-2 font-bold bg-gray-300" style>B. RESERVATION DETAILS</th>
                                        </tr>
                                        <tr class="">
                                            <th colspan="1" class="border border-black px-2 font-bold bg-gray-100 text-sm">B.1 Name of Event</th>
                                            <td colspan="3" class="border border-black  px-2 py-2 " style><span id="name"></span></td >
                                            
                                            
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="border border-black px-2 font-bold bg-gray-100 text-sm" style>B.2 EVENTS DETAILS</th>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class=" border border-black bg-gray-100 px-3 py-1 font-bold text-sm">Number of Attendees</td>
                                            <td colspan="3" class="large-col border border-black  px-2 py-2  text-sm "><span id="max"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class=" border border-black bg-gray-100 px-3 py-1 font-bold text-sm">Event Date and Time</td>
                                            <td colspan="3" class="large-col border border-black  px-2 py-2  text-sm "><span id="eventDate"></span>, <span id="eventTime"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class=" border border-black bg-gray-100 px-3 py-1 font-bold text-sm">Preparation Date and Time</td>
                                            <td colspan="3" class="large-col border border-black  px-2 py-2 text-sm "><span id="preparationDate"></span>, <span id="preparationTime"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class=" border border-black bg-gray-100 px-3 py-1 font-bold text-sm">Cleanup Date and Time</td>
                                            <td colspan="3" class="large-col border border-black px-2 py-2 text-sm "><span id="cleanupDate"></span>, <span id="cleanupTime"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="large-col border border-black bg-gray-100 px-3 py-1 font-bold text-sm ">B.3 Equipment</td>

                                            <td colspan="2" class=" border border-black bg-gray-100 px-3 py-1 font-bold text-sm">B.4 Support Personnel</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="large-col border border-black  px-2 py-2 text-sm ">
                                                <div>
                                                    <span id="ename"></span> 
                                                </div>
                                            </td>
                                            <td colspan="2" class=" border border-black  px-2 py-2 text-sm">
                                                <div>
                                                    <span id="pname"><br></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th colspan="4" class="border border-black px-2 font-bold bg-gray-100 text-sm" style>B.5 Attachments</th>
                                        </tr>
                                            <tr class="">
                                                <th colspan="4" class="border border-black px-2 text-sm text-sm">
                                                 
                                                    <div id="attachmentContainer" class="my-3"></div>
                                                </th>
                                            </tr>
                                            <tr class="">
                                            <th colspan="4" class="border border-black px-2 font-bold bg-gray-300" style>C. ENDORSEMENT & APPROVALS</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="min-w-full table-auto border border-black text-left text-sm">
                                    <thead>
                                    <tr>
                                        <td colspan="2" class="w-[20%] small-col border border-black bg-gray-100 px-2 py-1 font-bold">Requested by</td>
                                        <td colspan="2" class="w-[30%] border border-black px-2 py-2"><span class="uppercase" id="reserveeName"></span></td>
                                        <td colspan="2" class="w-[15%] small-col border border-black bg-gray-100 px-2 py-1 font-bold">AA</td>
                                        <td colspan="2" class=" w-[35%] border border-black px-2 py-2">
                                            <div class="text-center">
                                                <span class="text-xs font-bold" id=eastSignatureStatus></span>
                                                <p>Ms. JAMAICA QUEZON</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Person-in-Charge of Event</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span class="uppercase" id="person"></span></td>
                                        <td colspan="2" class="w-[15%] small-col border border-black bg-gray-100 px-2 py-1 font-bold">CISSO</td>
                                        <td colspan="2" class="w-[35%] border border-black px-2 py-2">
                                            <div class="text-center">
                                                <span class="text-xs font-bold" id=cissoSignatureStatus></span>
                                                <p>Engr. ESMAEL LARUBIS</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Contact Details</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span id="contact"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">GSO Director</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <div class="text-center">
                                                <span class="text-xs font-bold" id=gsoSignatureStatus></span>
                                                <p>Ms. LEONILA DOLOR</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Unit/Department/Company</td>
                                        <td colspan="2" class=" border border-black px-2 py-2 "><span id="unit"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Date of Filing</td>
                                        <td colspan="2" class=" border border-black px-2 py-2 "><span id="date"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Endorsed by</td>
                                        <td colspan="2" class=" border border-black px-2 py-2 ">
                                            <div class="text-center">
                                                <span class="text-xs font-bold" id="confirmation"></span><br>
                                                <span class="uppercase" id="endorser_name"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                                

                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button id="printButton" class="ml-2 inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Print
                                    </button>
                                    <button id="closeButton" class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="updateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white p-6 rounded shadow-md w-1/3 text-center">
                            <div class="flex gap-2 justify-between items-center font-bold">
                                <div class="pt-2 pb-1 text-2xl font-bold tracking-tighter leading-4 text-green-700 max-w-[282px]">
                                    <span class="text-3xl tracking-tighter">UPDATE STATUS</span>
                                </div>
                                <button class="text-lg tracking-tighter text-white" onclick="closeStatus()">
                                    <div class="px-4 py-2 bg-green-700 rounded-md max-md:px-5">x</div>
                                </button>
                            </div>
                            
                            <form id="updateApprovalForm" action="{{ route('admin.approvals.store', ['role_id' => $user->role_id]) }}" method="POST" onsubmit="return handleFormSubmit(event)">
                                @csrf
                                <input type="hidden" name="approval_id" id="approval_id">
                                <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}">

                                <label class="block text-gray-700 font-bold text-left mt-3">Reservee ID</label>
                                <h1 class="reservee-id-display text-left py-2 px-3 border border-gray-300 rounded bg-gray-100 font-bold" id="reserveeIDDisplay">
                                    {{ $reservee->reserveeID ?? '' }}
                                </h1> 

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold text-left">Status</label>
                                    <select name="approval_status" id="approval_status" class="block w-full border border-gray-300 rounded p-2" onchange="toggleNoteField()">
                                        <option value="Pending">Pending</option>
                                        <option value="Denied">Denied</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div>

                                <div id="noteField" class="mb-4 hidden">
                                    <label class="block text-gray-700 font-bold text-left">Note</label>
                                    <textarea name="note" id="note" class="block w-full border border-gray-300 rounded p-2"></textarea>
                                </div>

                                <div class="flex justify-center text-center">
                                    <button type="submit" class="inline-flex justify-center w-full border rounded-md border-transparent px-4 py-2 bg-[#087830] text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>      
        </div>
    </div>
    
    
    <script src="/js/reservationmgmt.js"></script>
    <script src="/js/profile.js"></script>
    <script src="/js/search.js"></script>

    <script>
        function toggleNoteField() {
        const status = document.getElementById('approval_status').value;
        const noteField = document.getElementById('noteField');
        if (status === 'Denied') {
            noteField.classList.remove('hidden');
        } else {
            noteField.classList.add('hidden');
        }
    }

    async function handleFormSubmit(event) {
        event.preventDefault(); 

        const form = event.target;
        const status = document.getElementById('approval_status').value;
        const note = document.getElementById('note').value;
        const reserveeID = document.getElementById('reserveeIDDisplay').textContent;

        if (status === 'Denied' && note) {
            await sendEmailToReservee(note, reserveeID);
        }


        form.submit();
    }

    async function sendEmailToReservee(note, reserveeID) {
        try {
            await fetch('{{ route("admin.sendReserveeEmail") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ note, reserveeID })
            });
            alert('Email sent to reservee.');
        } catch (error) {
            console.error('Error sending email:', error);
            alert('Failed to send email.');
        }
    }
    </script>



</body>
</html>


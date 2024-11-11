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
<body class=" no-transition relative bg-[#E5EFE8] overflow-hidden max-h-screen ">
    
    <div class="p-8 max-h-screen overflow-auto ">
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
                            <a href="admin-reservation" class="mt-1.5">
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
                                <input type="search" id="searchInput" class="w-[300px] text-xs px-3 py-2 text-gray-700 bg-white border-2 border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" placeholder="Search..." />
                                <div class="absolute inset-y-0 right-2 flex items-center pl-3 pointer-events-none">
                                    <svg width="12" height="12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.8029 11.7612L9.53693 9.31367C10.268 8.30465 10.6647 7.05865 10.6632 5.77592C10.6632 4.63355 10.3505 3.51684 9.76469 2.56699C9.17885 1.61715 8.34616 0.876833 7.37194 0.439668C6.39771 0.0025026 5.3257 -0.11188 4.29147 0.110985C3.25724 0.33385 2.30724 0.883953 1.5616 1.69173C0.815957 2.49951 0.308169 3.52868 0.102448 4.64909C-0.103274 5.76951 0.00231009 6.93086 0.405847 7.98627C0.809385 9.04168 1.49275 9.94375 2.36953 10.5784C3.24631 11.2131 4.27712 11.5518 5.33162 11.5518C6.51567 11.5534 7.66583 11.1237 8.59723 10.3317L10.8565 12.7864C10.9185 12.8541 10.9922 12.9078 11.0734 12.9445C11.1546 12.9811 11.2417 13 11.3297 13C11.4177 13 11.5048 12.9811 11.586 12.9445C11.6672 12.9078 11.7409 12.8541 11.8029 12.7864C11.8653 12.7193 11.9149 12.6395 11.9487 12.5515C11.9826 12.4635 12 12.3691 12 12.2738C12 12.1785 11.9826 12.0841 11.9487 11.9962C11.9149 11.9082 11.8653 11.8283 11.8029 11.7612ZM1.33291 5.77592C1.33291 4.91914 1.56743 4.08161 2.00681 3.36922C2.44619 2.65684 3.07071 2.1016 3.80138 1.77373C4.53205 1.44586 5.33605 1.36007 6.11173 1.52722C6.8874 1.69437 7.5999 2.10694 8.15913 2.71278C8.71836 3.31861 9.0992 4.09049 9.25349 4.9308C9.40779 5.77111 9.3286 6.64212 9.02594 7.43368C8.72329 8.22524 8.21077 8.90179 7.55318 9.37779C6.8956 9.85379 6.12249 10.1079 5.33162 10.1079C4.27109 10.1079 3.25401 9.65146 2.5041 8.83906C1.7542 8.02666 1.33291 6.92482 1.33291 5.77592Z" fill="black"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Facility</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 w-full">
                        @if ($reservationDetails)
                            @foreach($reservationDetails->groupBy('reserveeID') as $reserveeID => $detailsGroup)
                                @php
                                    $customOrder = ['AA', 'CISSO', 'GSO'];

                                    // Sort the detailsGroup collection
                                    $sortedDetailsGroup = $detailsGroup->sortBy(function ($detail) use ($customOrder) {
                                        return array_search($detail->role_name, $customOrder);
                                    })->unique('role_name');

                                    $east = $sortedDetailsGroup->where('role_name', 'AA')->first();
                                    $cisso = $sortedDetailsGroup->where('role_name', 'CISSO')->first();
                                    $gso = $sortedDetailsGroup->where('role_name', 'GSO')->first();
                                @endphp

                                {{-- Only show records where AA status is Denied, and exclude "Confirmed" or "Pending" statuses --}}
                                @if(($east && $east->approval_status === 'Denied') || $detailsGroup->contains('final_status', 'Cancelled'))
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $reserveeID }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->event_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                            {{ $detailsGroup->pluck('facilityName')->unique()->implode(', ') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->final_status }}</td>


                                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                                            <button class="border-solid border-1 border-gray-500  text-blue-500 px-3 py-1 rounded hover:bg-blue-500 hover:text-white ml-2 viewButton" onclick="openModal('{{ $reserveeID }}', '{{ $detailsGroup->first()->reserveeName }}', 
                                                '{{ $detailsGroup->first()->person_in_charge_event }}', '{{ $detailsGroup->first()->contact_details }}', '{{ $detailsGroup->first()->unit_department_company }}', '{{ $detailsGroup->first()->date_of_filing }}', '{{ $detailsGroup->first()->endorser_name}}',
                                                '{{ $detailsGroup->first()->final_status }}','{{ implode(', ', $detailsGroup->pluck('facilityName')->unique()->toArray()) }}', '{{$detailsGroup->first()->event_start_date}}', 
                                                '{{$detailsGroup->first()->event_end_date}}', '{{$detailsGroup->first()->preparation_start_date}}', '{{$detailsGroup->first()->preparation_end_date_time}}', '{{$detailsGroup->first()->cleanup_start_date_time}}', 
                                                '{{$detailsGroup->first()->cleanup_end_date_time}}','{{$detailsGroup->first()->event_name}}', '{{$detailsGroup->first()->max_attendees}}', '{{ implode(', ', $detailsGroup->pluck('pname')->unique()->toArray()) }}', 
                                                '{{ implode(', ', $detailsGroup->pluck('ptotal_no')->unique()->toArray()) }}', '{{ implode(', ', $detailsGroup->pluck('ename')->unique()->toArray()) }}', 
                                                '{{ implode(', ', $detailsGroup->pluck('etotal_no')->unique()->toArray()) }}',  
                                                '{{ $east && $east->signature_file ? Storage::url($east->signature_file) : '' }}',
                                                '{{ $cisso && $cisso->signature_file ? Storage::url($cisso->signature_file) : '' }}',
                                                '{{ $gso && $gso->signature_file ? Storage::url($gso->signature_file) : '' }}',
                                                '{{ $east->approval_status ?? '' }}',
                                                '{{ $cisso->approval_status ?? '' }}',
                                                '{{ $gso->approval_status ?? '' }}',
                                                '{{ json_encode($detailsGroup->map(function($item) { return ['url' => $item->attachment_path, 'name' => basename($item->attachment_path)]; })->toArray()) }}',
                                                )">
                                                View
                                            </button>

                                            <button class="border-solid border-1 border-gray-500  text-green-500 px-3 py-1 font-semibold rounded hover:bg-green-500 hover:text-white ml-2 editButton"
                                                    data-approval-id="{{ $detailsGroup->first()->approvalID }}" data-reservee-id="{{ $reserveeID }}"

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

                    
                    <div id="viewModal" class="modal overflow-auto  items-center bg-gray-900 bg-opacity-50 hidden">
                        
                        <div class="modal-content my-6  w-a4-width  max-w-4xl rounded bg-white p-6 shadow ">
                            <div class=" ">
                                <table class=" w-full border border-black">
                                    <thead>
                                        <tr class="border border-black bg-gray-100 ">
                                            <th rowspan="5"  style="width:5%"><img src="/images/corporate-logo-new.png" class="mx-auto h-10" /></th>
                                        </tr>
                                        <tr class="border border-black">
                                            <th rowspan="2"  style="width:20%" class="text-center border border-black">
                                                <span class="text-xs">La Salle University - Ozamiz City</span><br>
                                                <span>ADMINISTRATIVE SERVICES</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width:10%" class="border border-black">
                                                <div class="text-xs ">Document No: </div>
                                                <div class="text-center font-semi"><span>ROF-VPAS-GSO-EAST-001</span></div>
                                            </th>
                                        </tr>
                                        
                                        <tr class="border border-black">
                                            <th rowspan="2"  class="text-center border border-black">FACILITIES RESERVATION</th>
                                            <th colspan="2">dhehehoy</th>
                                        </tr>
                                        <tr class="border border-black">
                                            <th colspan="2" class="border border-black">hehehoy</th>
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
                                                   
                                                <div id="attachmentContainer"></div>
                                                <a id="endorsedLink" href="" target="_blank" class="font-normal	 hover:underline"></a>
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
                                    
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Requested by</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span class="uppercase" id="reserveeName"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">EAST</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <img id="eastSignatureImage" src="" class="w-16" alt="Cisso Signature" style="display: none;">
                                            <p>Ms. JAMAICA QUEZON</p>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Person-in-Charge of Event</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span class="uppercase" id="person"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">CISSO</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <img id="cissoSignatureImage" src="" class="w-16" alt="Cisso Signature" style="display: none;">
                                            <p>Mr. ESMAEL LARUBIS</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Contact Details</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span id="contact"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">GSO Director</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <img id="gsoSignatureImage" src="" class="w-16" alt="GSO Signature" style="display: none;">
                                            <p>Ms. LEONILA DOLOR</p>
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
                                            <span class="uppercase" id="endorser_name"></span>
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
                        <div class="bg-white p-6  rounded shadow-md w-1/3 text-center">
                            <div class="flex gap-2 justify-between items-center font-bold">
                                <div class="pt-2 pb-1 text-2xl font-bold tracking-tighter leading-4 text-green-700 max-w-[282px]">
                                    <span class="text-3xl tracking-tighter">UPDATE STATUS</span>
                                </div>
                                <button class="text-lg tracking-tighter text-white" onclick="closeStatus()">
                                    <div class="px-4 py-2 bg-green-700 rounded-md max-md:px-5">x</div>
                                </button>
                            </div>
                            <form id="updateApprovalForm" action="{{ route('admin.approvals.store', ['role_id' => $user->role_id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="approval_id" id="approval_id">
                                <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}">


                                <label class="block text-gray-700 font-bold  text-left mt-3 ">Reservee ID</label>

                                <h1 class="reservee-id-display text-left py-2 px-3 border border-gray-300 rounded bg-gray-100 font-bold" id="reserveeIDDisplay"></h1> 

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold  text-left ">Status</label>
                                    <select name="approval_status" id="approval_status" class="block w-full border border-gray-300 rounded p-2">
                                        <option value="Pending">Pending</option>
                                        <option value="Denied">Denied</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex justify-center w-full  border rounded-md border-transparent px-4 py-2 bg-green-600 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
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
    <script src="/js/reservationmodal.js"></script>



</body>
</html>


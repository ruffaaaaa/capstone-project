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
<body class="relative bg-[#E5EFE8] overflow-hidden max-h-screen">
    <aside class="fixed inset-y-0 left-0 bg-white shadow-md max-h-screen w-60 " id="sidebar">
        <div class="flex flex-col justify-between h-full">
            <div class="flex-grow">
                <div class="flex justify-center text-center py-8 border-b">
                    <img src="/images/corporate-logo-new.png" alt="Logo" class="h-8 mb-1">
                </div>
                
                <div class="p-4">
                    <ul class="space-y-1">
                        <li>
                        <a href="{{ route('dashboard', ['role_id' => $user->role_id]) }}" title="Dashboard" class="flex  hover:bg-green-300  rounded-xl font-bold text-sm text-gray-900 py-2 px-6">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M2 4.25A2.25 2.25 0 014.25 2h2.5A2.25 2.25 0 019 4.25v2.5A2.25 2.25 0 016.75 9h-2.5A2.25 2.25 0 012 6.75v-2.5zM2 13.25A2.25 2.25 0 014.25 11h2.5A2.25 2.25 0 019 13.25v2.5A2.25 2.25 0 016.75 18h-2.5A2.25 2.25 0 012 15.75v-2.5zM11 4.25A2.25 2.25 0 0113.25 2h2.5A2.25 2.25 0 0118 4.25v2.5A2.25 2.25 0 0115.75 9h-2.5A2.25 2.25 0 0111 6.75v-2.5zM15.25 11.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                                </svg>      
                            <span class="text ml-3 hidden">Dashboard</span>
                        </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reservation', ['role_id' => $user->role_id]) }}" title="Reservation" class="flex items-center hover:bg-green-300 rounded-xl font-bold text-sm py-2 px-4" >

                                <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" fill="currentColor" class="w-5 h-5">
                                    <path d="M18.563 3.04056V0.987196C18.563 0.447529 18.104 0 17.5505 0C16.997 0 16.538 0.447529 16.538 0.987196V2.96159H7.76291V0.987196C7.76291 0.447529 7.3039 0 6.75039 0C6.19689 0 5.73788 0.447529 5.73788 0.987196V3.04056C2.09283 3.36963 0.324313 5.48881 0.0543094 8.63468C0.0273091 9.01639 0.351313 9.3323 0.729318 9.3323H23.5716C23.9631 9.3323 24.2871 9.00323 24.2466 8.63468C23.9766 5.48881 22.208 3.36963 18.563 3.04056Z"  fill="#292D32"/>
                                    <path d="M21.5998 18.0984C18.6162 18.0984 16.1997 20.4545 16.1997 23.3634C16.1997 24.3506 16.4832 25.2852 16.9827 26.0749C17.9142 27.6018 19.6288 28.6285 21.5998 28.6285C23.5708 28.6285 25.2853 27.6018 26.2168 26.0749C26.7163 25.2852 26.9998 24.3506 26.9998 23.3634C26.9998 20.4545 24.5833 18.0984 21.5998 18.0984ZM24.3943 22.7974L21.5188 25.3905C21.3298 25.5616 21.0733 25.6537 20.8303 25.6537C20.5738 25.6537 20.3173 25.5616 20.1148 25.3642L18.7782 24.0611C18.3867 23.6793 18.3867 23.0475 18.7782 22.6658C19.1697 22.2841 19.8178 22.2841 20.2093 22.6658L20.8573 23.2976L23.0173 21.3496C23.4223 20.981 24.0703 21.0073 24.4483 21.4022C24.8263 21.7971 24.7993 22.4157 24.3943 22.7974Z" fill="#292D32"/>
                                    <path d="M22.9503 11.3064H1.35002C0.607508 11.3064 0 11.8987 0 12.6226V20.7308C0 24.6796 2.02503 27.3121 6.75008 27.3121H13.4057C14.3372 27.3121 14.9852 26.4302 14.6882 25.5746C14.4182 24.8112 14.1887 23.9688 14.1887 23.3633C14.1887 19.375 17.5232 16.1239 21.6138 16.1239C22.0053 16.1239 22.3968 16.1502 22.7748 16.216C23.5848 16.3345 24.3138 15.7158 24.3138 14.9261V12.6358C24.3003 11.8987 23.6928 11.3064 22.9503 11.3064ZM8.38361 22.3235C8.1271 22.5604 7.7761 22.7052 7.42509 22.7052C7.07409 22.7052 6.72308 22.5604 6.46658 22.3235C6.22358 22.0734 6.07508 21.7311 6.07508 21.3889C6.07508 21.0467 6.22358 20.7045 6.46658 20.4544C6.60158 20.3359 6.73658 20.2438 6.91209 20.1779C7.41159 19.9673 8.0056 20.0858 8.38361 20.4544C8.62661 20.7045 8.77511 21.0467 8.77511 21.3889C8.77511 21.7311 8.62661 22.0734 8.38361 22.3235ZM8.38361 17.7165C8.3161 17.7692 8.2486 17.8218 8.1811 17.8745C8.1001 17.9271 8.0191 17.9666 7.9381 17.993C7.8571 18.0324 7.7761 18.0588 7.6951 18.0719C7.6006 18.0851 7.50609 18.0983 7.42509 18.0983C7.07409 18.0983 6.72308 17.9535 6.46658 17.7165C6.22358 17.4664 6.07508 17.1242 6.07508 16.782C6.07508 16.4398 6.22358 16.0975 6.46658 15.8474C6.77709 15.5447 7.24959 15.3999 7.6951 15.4921C7.7761 15.5052 7.8571 15.5315 7.9381 15.571C8.0191 15.5974 8.1001 15.6368 8.1811 15.6895L8.38361 15.8474C8.62661 16.0975 8.77511 16.4398 8.77511 16.782C8.77511 17.1242 8.62661 17.4664 8.38361 17.7165ZM13.1087 17.7165C12.8522 17.9535 12.5012 18.0983 12.1502 18.0983C11.7991 18.0983 11.4481 17.9535 11.1916 17.7165C10.9486 17.4664 10.8001 17.1242 10.8001 16.782C10.8001 16.4398 10.9486 16.0975 11.1916 15.8474C11.7046 15.3604 12.6092 15.3604 13.1087 15.8474C13.3517 16.0975 13.5002 16.4398 13.5002 16.782C13.5002 17.1242 13.3517 17.4664 13.1087 17.7165Z" fill="#292D32"/>
                                </svg>
                                </span>
                                <span class="text ml-3 hidden">Reservation</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.calendar', ['role_id' => $user->role_id]) }}" title="Calendar" class="flex  bg-[#087830]  rounded-xl font-bold text-sm text-white py-2 px-4">
                                <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" fill="currentColor" class="w-5 h-5">
                                <path id="Vector" d="M18.2948 3.18727V1.03483C18.2948 0.469123 17.8425 0 17.297 0C16.7515 0 16.2991 0.469123 16.2991 1.03483V3.10449H7.65092V1.03483C7.65092 0.469123 7.19855 0 6.65305 0C6.10755 0 5.65518 0.469123 5.65518 1.03483V3.18727C2.06284 3.53222 0.319897 5.75365 0.0537984 9.05131C0.0271885 9.45144 0.346507 9.78259 0.719046 9.78259H23.231C23.6168 9.78259 23.9361 9.43764 23.8962 9.05131C23.6301 5.75365 21.8872 3.53222 18.2948 3.18727Z" fill="#ffffff"/>
                                    <path id="Vector_2" d="M22.6184 11.8521H1.33049C0.598723 11.8521 0 12.4729 0 13.2318V21.7312C0 25.8705 1.99574 28.63 6.65247 28.63H17.2964C21.9532 28.63 23.9489 25.8705 23.9489 21.7312V13.2318C23.9489 12.4729 23.3502 11.8521 22.6184 11.8521ZM8.26237 23.4007C8.19585 23.4559 8.12932 23.5249 8.0628 23.5663C7.98297 23.6215 7.90314 23.6628 7.82331 23.6904C7.74348 23.7318 7.66365 23.7594 7.58382 23.7732C7.49069 23.787 7.41086 23.8008 7.31772 23.8008C7.14476 23.8008 6.97179 23.7594 6.81213 23.6904C6.63917 23.6215 6.50612 23.5249 6.37307 23.4007C6.13358 23.1385 5.98723 22.7798 5.98723 22.4211C5.98723 22.0623 6.13358 21.7036 6.37307 21.4414C6.50612 21.3172 6.63917 21.2206 6.81213 21.1517C7.05162 21.0413 7.31772 21.0137 7.58382 21.0689C7.66365 21.0827 7.74348 21.1103 7.82331 21.1517C7.90314 21.1793 7.98297 21.2207 8.0628 21.2758C8.12932 21.331 8.19585 21.3862 8.26237 21.4414C8.50186 21.7036 8.64822 22.0623 8.64822 22.4211C8.64822 22.7798 8.50186 23.1385 8.26237 23.4007ZM8.26237 18.5715C8.00958 18.8198 7.66365 18.9716 7.31772 18.9716C6.97179 18.9716 6.62586 18.8198 6.37307 18.5715C6.13358 18.3093 5.98723 17.9506 5.98723 17.5918C5.98723 17.2331 6.13358 16.8744 6.37307 16.6122C6.74561 16.2259 7.33103 16.1017 7.82331 16.3225C7.99627 16.3914 8.14263 16.488 8.26237 16.6122C8.50186 16.8744 8.64822 17.2331 8.64822 17.5918C8.64822 17.9506 8.50186 18.3093 8.26237 18.5715ZM12.9191 23.4007C12.6663 23.6491 12.3204 23.8008 11.9745 23.8008C11.6285 23.8008 11.2826 23.6491 11.0298 23.4007C10.7903 23.1385 10.644 22.7798 10.644 22.4211C10.644 22.0623 10.7903 21.7036 11.0298 21.4414C11.5221 20.9309 12.4268 20.9309 12.9191 21.4414C13.1586 21.7036 13.3049 22.0623 13.3049 22.4211C13.3049 22.7798 13.1586 23.1385 12.9191 23.4007ZM12.9191 18.5715C12.8526 18.6267 12.7861 18.6819 12.7195 18.7371C12.6397 18.7923 12.5599 18.8336 12.48 18.8612C12.4002 18.9026 12.3204 18.9302 12.2406 18.944C12.1474 18.9578 12.0676 18.9716 11.9745 18.9716C11.6285 18.9716 11.2826 18.8198 11.0298 18.5715C10.7903 18.3093 10.644 17.9506 10.644 17.5918C10.644 17.2331 10.7903 16.8744 11.0298 16.6122C11.1495 16.488 11.2959 16.3914 11.4689 16.3225C11.9611 16.1017 12.5466 16.2259 12.9191 16.6122C13.1586 16.8744 13.3049 17.2331 13.3049 17.5918C13.3049 17.9506 13.1586 18.3093 12.9191 18.5715ZM17.5758 23.4007C17.323 23.6491 16.9771 23.8008 16.6312 23.8008C16.2853 23.8008 15.9393 23.6491 15.6865 23.4007C15.447 23.1385 15.3007 22.7798 15.3007 22.4211C15.3007 22.0623 15.447 21.7036 15.6865 21.4414C16.1788 20.9309 17.0836 20.9309 17.5758 21.4414C17.8153 21.7036 17.9617 22.0623 17.9617 22.4211C17.9617 22.7798 17.8153 23.1385 17.5758 23.4007ZM17.5758 18.5715C17.5093 18.6267 17.4428 18.6819 17.3763 18.7371C17.2964 18.7923 17.2166 18.8336 17.1368 18.8612C17.0569 18.9026 16.9771 18.9302 16.8973 18.944C16.8041 18.9578 16.711 18.9716 16.6312 18.9716C16.2853 18.9716 15.9393 18.8198 15.6865 18.5715C15.447 18.3093 15.3007 17.9506 15.3007 17.5918C15.3007 17.2331 15.447 16.8744 15.6865 16.6122C15.8196 16.488 15.9526 16.3914 16.1256 16.3225C16.3651 16.2121 16.6312 16.1845 16.8973 16.2397C16.9771 16.2535 17.0569 16.2811 17.1368 16.3225C17.2166 16.3501 17.2964 16.3914 17.3763 16.4466L17.5758 16.6122C17.8153 16.8744 17.9617 17.2331 17.9617 17.5918C17.9617 17.9506 17.8153 18.3093 17.5758 18.5715Z" fill="#ffffff"/>
                                </svg>

                                </span>
                                <span class="text ml-3 hidden">Calendar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-4">
                <div>
                    <a href="javascript:void(0)" title="Profile" class="flex font-bold text-sm text-gray-900 py-2 px-4 mr-2" id="profileIcon">
                        <span class="icon">
                            <svg width="25px" height="25px" viewBox="2 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 14.9 3.25 17.51 5.23 19.34C5.23 19.35 5.23 19.35 5.22 19.36C5.32 19.46 5.44 19.54 5.54 19.63C5.6 19.68 5.65 19.73 5.71 19.77C5.89 19.92 6.09 20.06 6.28 20.2C6.35 20.25 6.41 20.29 6.48 20.34C6.67 20.47 6.87 20.59 7.08 20.7C7.15 20.74 7.23 20.79 7.3 20.83C7.5 20.94 7.71 21.04 7.93 21.13C8.01 21.17 8.09 21.21 8.17 21.24C8.39 21.33 8.61 21.41 8.83 21.48C8.91 21.51 8.99 21.54 9.07 21.56C9.31 21.63 9.55 21.69 9.79 21.75C9.86 21.77 9.93 21.79 10.01 21.8C10.29 21.86 10.57 21.9 10.86 21.93C10.9 21.93 10.94 21.94 10.98 21.95C11.32 21.98 11.66 22 12 22C12.34 22 12.68 21.98 13.01 21.95C13.05 21.95 13.09 21.94 13.13 21.93C13.42 21.9 13.7 21.86 13.98 21.8C14.05 21.79 14.12 21.76 14.2 21.75C14.44 21.69 14.69 21.64 14.92 21.56C15 21.53 15.08 21.5 15.16 21.48C15.38 21.4 15.61 21.33 15.82 21.24C15.9 21.21 15.98 21.17 16.06 21.13C16.27 21.04 16.48 20.94 16.69 20.83C16.77 20.79 16.84 20.74 16.91 20.7C17.11 20.58 17.31 20.47 17.51 20.34C17.58 20.3 17.64 20.25 17.71 20.2C17.91 20.06 18.1 19.92 18.28 19.77C18.34 19.72 18.39 19.67 18.45 19.63C18.56 19.54 18.67 19.45 18.77 19.36C18.77 19.35 18.77 19.35 18.76 19.34C20.75 17.51 22 14.9 22 12ZM16.94 16.97C14.23 15.15 9.79 15.15 7.06 16.97C6.62 17.26 6.26 17.6 5.96 17.97C4.44 16.43 3.5 14.32 3.5 12C3.5 7.31 7.31 3.5 12 3.5C16.69 3.5 20.5 7.31 20.5 12C20.5 14.32 19.56 16.43 18.04 17.97C17.75 17.6 17.38 17.26 16.94 16.97Z" fill="#292D32"/>
                                <path d="M12 6.92969C9.93 6.92969 8.25 8.60969 8.25 10.6797C8.25 12.7097 9.84 14.3597 11.95 14.4197C11.98 14.4197 12.02 14.4197 12.04 14.4197C12.06 14.4197 12.09 14.4197 12.11 14.4197C12.12 14.4197 12.13 14.4197 12.13 14.4197C14.15 14.3497 15.74 12.7097 15.75 10.6797C15.75 8.60969 14.07 6.92969 12 6.92969Z" fill="#292D32"/>
                            </svg>
                        </span>
                    </a>  
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="sumbit" title="Logout" class="inline-flex items-center justify-center h-9 py-2 px-3 ml-[2px]  rounded-xl bg-[#087830] text-white text-sm font-semibold transition">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="ml-2" viewBox="0 0 16 18">
                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button> <span class="text font-bold text-sm ml-2 hidden">Logout</span>
                </form>
            </div> 
        </div>
    </aside>
    <main class="p-8 max-h-screen overflow-auto">
        
        <div class="flex flex-col lg:flex-row h-full">
            <div class="min-h-full bg-white p-3 w-40 rounded drop-shadow-md mr-2 mb-2 max-md:w-full">
                <div class="flex items-center justify-center">
                    <span class="font-bold text-center">FILTER</span>
                </div>
                <div >
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
                    <div class="relative inline-block mt-2 mb-2 w-full">
                        <label for="scheduleFilter" class="block text-sm font-medium text-gray-700 mb-1">Schedule:</label>
                        <div class="relative">
                            <select id="scheduleFilter" class="text-xs block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-3 py-2 rounded leading-tight focus:outline-none focus:shadow-outline" onchange="filterEvents(this.value)">
                                <option value="all" class="text-xs">All</option>
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
                                <option value="text-xs">All</option>
                                <!-- Facilities will be populated here -->
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4 mt-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 7l3-3 3 3m0 6l-3 3-3-3"></path></svg>
                        </div>
                    </div>

                    <div class="relative inline-block mt-2 mb-2 w-full">
                        <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
                        <select id="statusFilter" class="block text-xs appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-3 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" onchange="filterByStatus(this.value)">
                            <option value="all" class="text-xs">All</option>
                            <option value="Pending" class="text-xs">Pending</option>
                            <option value="Approved" class="text-xs">Approved</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4 mt-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 7l3-3 3 3m0 6l-3 3-3-3"></path></svg>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="w-full lg:w-3/3 lg:mb-0 mb-2">
                <div class="h-full bg-white p-4 rounded drop-shadow-md">
                    <div id="calendar-controls" class="flex flex-wrap ">
                        <button id="today-btn" class="flex min-h-[38px] w-[100px] items-center justify-center gap-2.5 overflow-hidden rounded bg-green-800 font-bold text-white max-md:hidden">Today</button>
                        <button id="prev-btn" class="mx-1 flex min-h-[38px] w-[40px] items-center justify-center overflow-hidden rounded bg-green-800 px-2 text-white">&lt;</button>
                        <button id="next-btn" class="flex min-h-[38px] w-[40px] items-center justify-center overflow-hidden rounded bg-green-800 px-2 text-white">&gt;</button>
                        <span id="calendar-title" class="h-[38px] overflow-hidden px-2.5 text-3xl font-semibold tracking-tighter text-black uppercase "></span>
                        
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
                        <span id="eventTitle" class="text-3xl uppercase max-md:text-2xl"></span>
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
        
    </main>
    <script src="/js/profile.js"></script>
    <script src="/js/calendar.js"></script>

   
</body>
</html>


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
<body class=" no-transition relative bg-green-50 overflow-hidden max-h-screen "  onload="initializeSidebar()">
    <aside class="fixed inset-y-0 left-0 bg-white shadow-md max-h-screen w-60 " id="sidebar">
        <div class="flex flex-col justify-between h-full">
            <div class="flex-grow">
                <div class="px-4 py-6 text-center border-b">
                    <img src="/images/lsu-logo 2.png" alt="Logo" class="mx-auto h-10 mb-1">
                    <h1 class=" text-l font-bold leading-none text-[#087830] text">
                        <!-- Display this text when not collapsed -->
                        <span class="hidden">FACILITIES RESERVATION SYSTEM</span>
                    </h1>
                </div>
                
                <div class="p-4">
                    <ul class="space-y-1">
                        <li>
                        <a href="admin-dashboard" title="Dashboard" class="flex items-center hover:bg-green-300 rounded-xl font-bold text-sm text-gray-900 py-2 px-4">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M2 4.25A2.25 2.25 0 014.25 2h2.5A2.25 2.25 0 019 4.25v2.5A2.25 2.25 0 016.75 9h-2.5A2.25 2.25 0 012 6.75v-2.5zM2 13.25A2.25 2.25 0 014.25 11h2.5A2.25 2.25 0 019 13.25v2.5A2.25 2.25 0 016.75 18h-2.5A2.25 2.25 0 012 15.75v-2.5zM11 4.25A2.25 2.25 0 0113.25 2h2.5A2.25 2.25 0 0118 4.25v2.5A2.25 2.25 0 0115.75 9h-2.5A2.25 2.25 0 0111 6.75v-2.5zM15.25 11.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                                </svg>      
                            <span class="text ml-3 hidden">Dashboard</span>
                        </a>
                        </li>
                        <li>
                            <a href="admin-reservation" title="Reservation" class="flex  bg-[#087830]   rounded-xl font-bold text-sm text-white py-2 px-4">
                                <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" fill="currentColor" class="w-5 h-5">
                                    <path d="M18.563 3.04056V0.987196C18.563 0.447529 18.104 0 17.5505 0C16.997 0 16.538 0.447529 16.538 0.987196V2.96159H7.76291V0.987196C7.76291 0.447529 7.3039 0 6.75039 0C6.19689 0 5.73788 0.447529 5.73788 0.987196V3.04056C2.09283 3.36963 0.324313 5.48881 0.0543094 8.63468C0.0273091 9.01639 0.351313 9.3323 0.729318 9.3323H23.5716C23.9631 9.3323 24.2871 9.00323 24.2466 8.63468C23.9766 5.48881 22.208 3.36963 18.563 3.04056Z" fill="#ffffff"/>
                                    <path d="M21.5998 18.0984C18.6162 18.0984 16.1997 20.4545 16.1997 23.3634C16.1997 24.3506 16.4832 25.2852 16.9827 26.0749C17.9142 27.6018 19.6288 28.6285 21.5998 28.6285C23.5708 28.6285 25.2853 27.6018 26.2168 26.0749C26.7163 25.2852 26.9998 24.3506 26.9998 23.3634C26.9998 20.4545 24.5833 18.0984 21.5998 18.0984ZM24.3943 22.7974L21.5188 25.3905C21.3298 25.5616 21.0733 25.6537 20.8303 25.6537C20.5738 25.6537 20.3173 25.5616 20.1148 25.3642L18.7782 24.0611C18.3867 23.6793 18.3867 23.0475 18.7782 22.6658C19.1697 22.2841 19.8178 22.2841 20.2093 22.6658L20.8573 23.2976L23.0173 21.3496C23.4223 20.981 24.0703 21.0073 24.4483 21.4022C24.8263 21.7971 24.7993 22.4157 24.3943 22.7974Z" fill="#ffffff"/>
                                    <path d="M22.9503 11.3064H1.35002C0.607508 11.3064 0 11.8987 0 12.6226V20.7308C0 24.6796 2.02503 27.3121 6.75008 27.3121H13.4057C14.3372 27.3121 14.9852 26.4302 14.6882 25.5746C14.4182 24.8112 14.1887 23.9688 14.1887 23.3633C14.1887 19.375 17.5232 16.1239 21.6138 16.1239C22.0053 16.1239 22.3968 16.1502 22.7748 16.216C23.5848 16.3345 24.3138 15.7158 24.3138 14.9261V12.6358C24.3003 11.8987 23.6928 11.3064 22.9503 11.3064ZM8.38361 22.3235C8.1271 22.5604 7.7761 22.7052 7.42509 22.7052C7.07409 22.7052 6.72308 22.5604 6.46658 22.3235C6.22358 22.0734 6.07508 21.7311 6.07508 21.3889C6.07508 21.0467 6.22358 20.7045 6.46658 20.4544C6.60158 20.3359 6.73658 20.2438 6.91209 20.1779C7.41159 19.9673 8.0056 20.0858 8.38361 20.4544C8.62661 20.7045 8.77511 21.0467 8.77511 21.3889C8.77511 21.7311 8.62661 22.0734 8.38361 22.3235ZM8.38361 17.7165C8.3161 17.7692 8.2486 17.8218 8.1811 17.8745C8.1001 17.9271 8.0191 17.9666 7.9381 17.993C7.8571 18.0324 7.7761 18.0588 7.6951 18.0719C7.6006 18.0851 7.50609 18.0983 7.42509 18.0983C7.07409 18.0983 6.72308 17.9535 6.46658 17.7165C6.22358 17.4664 6.07508 17.1242 6.07508 16.782C6.07508 16.4398 6.22358 16.0975 6.46658 15.8474C6.77709 15.5447 7.24959 15.3999 7.6951 15.4921C7.7761 15.5052 7.8571 15.5315 7.9381 15.571C8.0191 15.5974 8.1001 15.6368 8.1811 15.6895L8.38361 15.8474C8.62661 16.0975 8.77511 16.4398 8.77511 16.782C8.77511 17.1242 8.62661 17.4664 8.38361 17.7165ZM13.1087 17.7165C12.8522 17.9535 12.5012 18.0983 12.1502 18.0983C11.7991 18.0983 11.4481 17.9535 11.1916 17.7165C10.9486 17.4664 10.8001 17.1242 10.8001 16.782C10.8001 16.4398 10.9486 16.0975 11.1916 15.8474C11.7046 15.3604 12.6092 15.3604 13.1087 15.8474C13.3517 16.0975 13.5002 16.4398 13.5002 16.782C13.5002 17.1242 13.3517 17.4664 13.1087 17.7165Z" fill="#ffffff"/>
                                </svg>
                                </span>
                                <span class="text ml-3 hidden">Reservation</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin-calendar" title="Calendar" class="flex  hover:bg-green-300  rounded-xl font-bold text-sm text-gray-900 py-2 px-4">
                                <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" fill="currentColor" class="w-5 h-5">
                                    <path id="Vector" d="M18.2948 3.18727V1.03483C18.2948 0.469123 17.8425 0 17.297 0C16.7515 0 16.2991 0.469123 16.2991 1.03483V3.10449H7.65092V1.03483C7.65092 0.469123 7.19855 0 6.65305 0C6.10755 0 5.65518 0.469123 5.65518 1.03483V3.18727C2.06284 3.53222 0.319897 5.75365 0.0537984 9.05131C0.0271885 9.45144 0.346507 9.78259 0.719046 9.78259H23.231C23.6168 9.78259 23.9361 9.43764 23.8962 9.05131C23.6301 5.75365 21.8872 3.53222 18.2948 3.18727Z" fill="#292D32"/>
                                    <path id="Vector_2" d="M22.6184 11.8521H1.33049C0.598723 11.8521 0 12.4729 0 13.2318V21.7312C0 25.8705 1.99574 28.63 6.65247 28.63H17.2964C21.9532 28.63 23.9489 25.8705 23.9489 21.7312V13.2318C23.9489 12.4729 23.3502 11.8521 22.6184 11.8521ZM8.26237 23.4007C8.19585 23.4559 8.12932 23.5249 8.0628 23.5663C7.98297 23.6215 7.90314 23.6628 7.82331 23.6904C7.74348 23.7318 7.66365 23.7594 7.58382 23.7732C7.49069 23.787 7.41086 23.8008 7.31772 23.8008C7.14476 23.8008 6.97179 23.7594 6.81213 23.6904C6.63917 23.6215 6.50612 23.5249 6.37307 23.4007C6.13358 23.1385 5.98723 22.7798 5.98723 22.4211C5.98723 22.0623 6.13358 21.7036 6.37307 21.4414C6.50612 21.3172 6.63917 21.2206 6.81213 21.1517C7.05162 21.0413 7.31772 21.0137 7.58382 21.0689C7.66365 21.0827 7.74348 21.1103 7.82331 21.1517C7.90314 21.1793 7.98297 21.2207 8.0628 21.2758C8.12932 21.331 8.19585 21.3862 8.26237 21.4414C8.50186 21.7036 8.64822 22.0623 8.64822 22.4211C8.64822 22.7798 8.50186 23.1385 8.26237 23.4007ZM8.26237 18.5715C8.00958 18.8198 7.66365 18.9716 7.31772 18.9716C6.97179 18.9716 6.62586 18.8198 6.37307 18.5715C6.13358 18.3093 5.98723 17.9506 5.98723 17.5918C5.98723 17.2331 6.13358 16.8744 6.37307 16.6122C6.74561 16.2259 7.33103 16.1017 7.82331 16.3225C7.99627 16.3914 8.14263 16.488 8.26237 16.6122C8.50186 16.8744 8.64822 17.2331 8.64822 17.5918C8.64822 17.9506 8.50186 18.3093 8.26237 18.5715ZM12.9191 23.4007C12.6663 23.6491 12.3204 23.8008 11.9745 23.8008C11.6285 23.8008 11.2826 23.6491 11.0298 23.4007C10.7903 23.1385 10.644 22.7798 10.644 22.4211C10.644 22.0623 10.7903 21.7036 11.0298 21.4414C11.5221 20.9309 12.4268 20.9309 12.9191 21.4414C13.1586 21.7036 13.3049 22.0623 13.3049 22.4211C13.3049 22.7798 13.1586 23.1385 12.9191 23.4007ZM12.9191 18.5715C12.8526 18.6267 12.7861 18.6819 12.7195 18.7371C12.6397 18.7923 12.5599 18.8336 12.48 18.8612C12.4002 18.9026 12.3204 18.9302 12.2406 18.944C12.1474 18.9578 12.0676 18.9716 11.9745 18.9716C11.6285 18.9716 11.2826 18.8198 11.0298 18.5715C10.7903 18.3093 10.644 17.9506 10.644 17.5918C10.644 17.2331 10.7903 16.8744 11.0298 16.6122C11.1495 16.488 11.2959 16.3914 11.4689 16.3225C11.9611 16.1017 12.5466 16.2259 12.9191 16.6122C13.1586 16.8744 13.3049 17.2331 13.3049 17.5918C13.3049 17.9506 13.1586 18.3093 12.9191 18.5715ZM17.5758 23.4007C17.323 23.6491 16.9771 23.8008 16.6312 23.8008C16.2853 23.8008 15.9393 23.6491 15.6865 23.4007C15.447 23.1385 15.3007 22.7798 15.3007 22.4211C15.3007 22.0623 15.447 21.7036 15.6865 21.4414C16.1788 20.9309 17.0836 20.9309 17.5758 21.4414C17.8153 21.7036 17.9617 22.0623 17.9617 22.4211C17.9617 22.7798 17.8153 23.1385 17.5758 23.4007ZM17.5758 18.5715C17.5093 18.6267 17.4428 18.6819 17.3763 18.7371C17.2964 18.7923 17.2166 18.8336 17.1368 18.8612C17.0569 18.9026 16.9771 18.9302 16.8973 18.944C16.8041 18.9578 16.711 18.9716 16.6312 18.9716C16.2853 18.9716 15.9393 18.8198 15.6865 18.5715C15.447 18.3093 15.3007 17.9506 15.3007 17.5918C15.3007 17.2331 15.447 16.8744 15.6865 16.6122C15.8196 16.488 15.9526 16.3914 16.1256 16.3225C16.3651 16.2121 16.6312 16.1845 16.8973 16.2397C16.9771 16.2535 17.0569 16.2811 17.1368 16.3225C17.2166 16.3501 17.2964 16.3914 17.3763 16.4466L17.5758 16.6122C17.8153 16.8744 17.9617 17.2331 17.9617 17.5918C17.9617 17.9506 17.8153 18.3093 17.5758 18.5715Z" fill="#292D32"/>
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
                    <button type="sumbit" title="Logout" class="inline-flex items-center justify-center h-9 py-2 px-3 ml-[2px] rounded-xl bg-[#087830] text-white text-sm font-semibold transition">
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
        <div class="max-h-screen overflow-y-auto w-full">
            <div class=" mx-auto">
                <div class="bg-white rounded-3xl p-8 mb-5">
                    <div class="row">
                        <div class="col-md-12">  
                    </div>
                <div>
                <div class="mb-3">
                    <div class="relative inline-block mt-2 mb-2 w-full  flex justify-end">
                        <div class="mr-2 relative">
                            <input  type="search"  id="searchInput"  class=" w-[300px] text-xs px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring"  placeholder="Search..."  /> 
                            <div class="absolute inset-y-0 right-2 flex items-center pl-3 pointer-events-none">
                                <svg width="12" height="12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8029 11.7612L9.53693 9.31367C10.268 8.30465 10.6647 7.05865 10.6632 5.77592C10.6632 4.63355 10.3505 3.51684 9.76469 2.56699C9.17885 1.61715 8.34616 0.876833 7.37194 0.439668C6.39771 0.0025026 5.3257 -0.11188 4.29147 0.110985C3.25724 0.33385 2.30724 0.883953 1.5616 1.69173C0.815957 2.49951 0.308169 3.52868 0.102448 4.64909C-0.103274 5.76951 0.00231009 6.93086 0.405847 7.98627C0.809385 9.04168 1.49275 9.94375 2.36953 10.5784C3.24631 11.2131 4.27712 11.5518 5.33162 11.5518C6.51567 11.5534 7.66583 11.1237 8.59723 10.3317L10.8565 12.7864C10.9185 12.8541 10.9922 12.9078 11.0734 12.9445C11.1546 12.9811 11.2417 13 11.3297 13C11.4177 13 11.5048 12.9811 11.586 12.9445C11.6672 12.9078 11.7409 12.8541 11.8029 12.7864C11.8653 12.7193 11.9149 12.6395 11.9487 12.5515C11.9826 12.4635 12 12.3691 12 12.2738C12 12.1785 11.9826 12.0841 11.9487 11.9962C11.9149 11.9082 11.8653 11.8283 11.8029 11.7612ZM1.33291 5.77592C1.33291 4.91914 1.56743 4.08161 2.00681 3.36922C2.44619 2.65684 3.07071 2.1016 3.80138 1.77373C4.53205 1.44586 5.33605 1.36007 6.11173 1.52722C6.8874 1.69437 7.5999 2.10694 8.15913 2.71278C8.71836 3.31861 9.0992 4.09049 9.25349 4.9308C9.40779 5.77111 9.3286 6.64212 9.02594 7.43368C8.72329 8.22524 8.21077 8.90179 7.55318 9.37779C6.8956 9.85379 6.12249 10.1079 5.33162 10.1079C4.27109 10.1079 3.25401 9.65146 2.5041 8.83906C1.7542 8.02666 1.33291 6.92482 1.33291 5.77592Z" fill="black"/>
                                </svg>
                            </div>
                        </div>  
                    </div>

                    

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Facility</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>

                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Final Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-sm  font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 w-full">
                        @if ($reservationDetails)
                            @foreach($reservationDetails->groupBy('reserveeID') as $reserveeID => $detailsGroup)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $reserveeID }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->event_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    {{ $detailsGroup->pluck('facilityName')->unique()->implode(', '), }}
                                </td>

                                @php
                                    $customOrder = ['EAST', 'CISSO', 'GSO'];

                                    // Sort the detailsGroup collection
                                    $sortedDetailsGroup = $detailsGroup->sortBy(function ($detail) use ($customOrder) {
                                        return array_search($detail->role_name, $customOrder);
                                    })->unique('role_name'); // Use unique to ensure only one instance per role

                                    $east = $sortedDetailsGroup->where('role_name', 'EAST')->first();
                                    $cisso = $sortedDetailsGroup->where('role_name', 'CISSO')->first();
                                    $gso = $sortedDetailsGroup->where('role_name', 'GSO')->first();
                                @endphp

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                    @foreach($sortedDetailsGroup as $detail)
                                        {{ $detail->role_name }} - {{ $detail->approval_status }}<br>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $detailsGroup->first()->final_status }}</td>


                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button class="border border-red-500 text-blue-500 px-3 py-1 rounded hover:border-red-600 hover:bg-blue-500 hover:text-white ml-2 viewButton" onclick="openModal('{{ $reserveeID }}', '{{ $detailsGroup->first()->reserveeName }}', 
                                    '{{ $detailsGroup->first()->person_in_charge_event }}', '{{ $detailsGroup->first()->contact_details }}', '{{ $detailsGroup->first()->unit_department_company }}', '{{ $detailsGroup->first()->date_of_filing }}', 
                                    '{{ $detailsGroup->first()->endorsed_by }}', '{{ $detailsGroup->first()->final_status }}','{{ implode(', ', $detailsGroup->pluck('facilityName')->unique()->toArray()) }}', '{{$detailsGroup->first()->event_start_date}}', 
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

                                    '{{ json_encode($detailsGroup->map(function($item) { return ['url' => $item->attachment_path, 'name' => basename($item->attachment_path)]; })->toArray()) }}',  // Create an array of objects with URL and file name
                                    '{{ $detailsGroup->first()->endorsedPath }}',  // Main attachment

                                    )">
                                    View
    
                                </button>

                                <button class="border border-red-500 text-green-500 px-3 py-1 rounded hover:border-red-600 hover:bg-green-500 hover:text-white ml-2 editButton"
                                        data-approval-id="{{ $detailsGroup->first()->approvalID }}" data-reservee-id="{{ $reserveeID }}"

                                        onclick="openStatus(this)">
                                    Update
                                </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    
                    <div id="viewModal" class="modal overflow-auto  items-center ">
                        <div class="modal-content my-6  w-a4-width  max-w-4xl rounded-lg bg-white p-6 shadow ">
                            <div class=" ">
                                <table class=" w-full border border-black">
                                    <thead>
                                        <tr class="border border-black bg-gray-100 ">
                                            <th rowspan="5"  style="width:5%"><img src="/images/lsu-logo 2.png" class="mx-auto w-15 h-20" /></th>
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
                                                   
                                                    <div id="attachmentContainer" class="font-normal"></div>
                                                    <a id="endorsedLink" href="" target="_blank" class="font-normal	hover:underline"></a>
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
                                        <td colspan="2" class="border border-black px-2 py-2"><span class="contents" id="reserveeName"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">EAST</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <img id="eastSignatureImage" src="" class="w-16" alt="East Signature" style="display: none;">
                                            <p>Ms. JAIMACA QUEZON</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">Person-in-Charge of Event</td>
                                        <td colspan="2" class="border border-black px-2 py-2"><span id="person"></span></td>
                                        <td colspan="2" class="small-col border border-black bg-gray-100 px-2 py-1 font-bold">CISSO</td>
                                        <td colspan="2" class="border border-black px-2 py-2">
                                            <img id="cissoSignatureImage" src="" class="w-16" alt="Cisso Signature" style="display: none;">
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
                                        <td colspan="2" class=" border border-black px-2 py-2 "><span id="endorsed">
                                        
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
                            <div class="mt-3">
                                <a href="" class="">
                                    <img src="/images/lsu-logo 2.png"  class=" mx-auto w-10 h-30" />
                                </a>

                                
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2"> Approval Status</h3>
                            </div>
                            <form id="updateApprovalForm" action="{{route('admin.approvals.adminStore') }}" method="POST">
                                @csrf
                                <input type="hidden" name="approval_id" id="approval_id">
                                <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}">


                                <label class="block text-gray-700 font-bold  text-left mt-3 ">Reservee ID</label>

                                <h1 class="reservee-id-display text-left py-2 px-3 border border-gray-300 rounded bg-gray-100 font-bold" id="reserveeIDDisplay"></h1> 

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold  text-left ">Status</label>
                                    <select name="approval_status" id="approval_status" class="block w-full border border-gray-300 rounded py-2 px-3">
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div>

                                <div class="flex justify-end">
                                    <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeStatus()">Cancel</button>
                                    <button type="submit" class="inline-flex justify-center w-full  border rounded-md border-transparent px-4 py-2 bg-green-600 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                            

                            <form id="editprofileForm" onsubmit="submitProfileForm(event)" method="POST" action="{{ route('gso-cisso.profile.update', $user->id) }}" enctype="multipart/form-data">
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

                                <div>

                                    @if($signature && Storage::disk('public')->exists($signature->signature_file))
                                    <div class="mt-2 align-center justify-center text-center">
                                        <label class="block text-sm font-medium text-gray-700 text-left">Current Signature</label>
                                        <img src="{{ Storage::url($signature->signature_file) }}" alt="Signature" class="mt-2 w-32 h-auto border rounded-md">
                                    </div>

                                    @endif
                                </div>

                                <div class="mt-2">
                                    <label for="signature_file" class="block text-sm font-medium text-gray-700 text-left">Upload Signature (PNG only)</label>
                                    <input type="file" name="signature_file" id="signature_file" accept="image/png" class="mt-1  rounded-md border border-gray-300 px-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-3 file:m-2 file:rounded-xs file:border-0 file:text-sm file:bg-green-50 file:text-green-700">
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
    <script src="/js/index.js"></script>
    <script src="/js/reservationmgmt.js"></script>
    <script src="/js/reservationmodal.js"></script>


    <script src="/js/profile.js"></script>
    

</body>
</html>

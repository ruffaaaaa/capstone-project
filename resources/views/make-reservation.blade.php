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
    <div class="flex flex-col items-center px-14 py-12 mb-10 w-full bg-white max-w-[1018px] rounded-[30px] max-md:px-5 max-md:mb-10 max-md:max-w-full">
        <form id="facilitiesForm" class="max-w-md mx-auto flex flex-col items-center justify-center"> <!-- Added flex, items-center, and justify-center classes -->
            <div class="mb-6 flex justify-center items-center"> <!-- Added flex, justify-center, and items-center classes -->
                <span class="text-2xl font-bold">FACILITIES</span>
            </div>
            <div class="mb-6 flex justify-center items-center relative"> <!-- Added relative class for positioning -->
                <hr class="w-12 border-green-900 border-2 absolute animate-line"><!-- Added absolute positioning for the line and animation class -->
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 justify-center"> <!-- Added justify-center class to center the grid items -->
                <input type="hidden" name="reservedetailsID" id="reservationcode">
                @foreach ($facilities as $facility)
                    <div class="mb-2 flex justify-center"> <!-- Added flex and justify-center to center the label -->
                        <label class="items-center space-x-2">
                            <input type="checkbox" name="facility_checkbox[{{ $facility->facilityID }}]" class="form-checkbox equipment-checkbox">
                            <span class="text-l font-bold">{{ $facility->facilityName }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </form>
        <form id="reservationDetailsForm" class="hidden">
            <div class="mb-6 flex justify-center items-center"> <!-- Added flex, justify-center, and items-center classes -->
                <span class="text-2xl font-bold">RESERVATION</span>
            </div>
            <div class="mb-6 flex justify-center items-center relative"> <!-- Added relative class for positioning -->
                <hr class="w-12 border-green-900 border-2 absolute animate-line"><!-- Added absolute positioning for the line and animation class -->
            </div>

                       
            <input type="date" id="reservationDate" name="reservationDate">
        </form>
        <form id="customerDetailsForm" class="hidden">
            <div class="mb-6 flex justify-center items-center"> <!-- Added flex, justify-center, and items-center classes -->
                <span class="text-2xl font-bold">RESERVEE DETAILS</span>
            </div>
            <div class="mb-6 flex justify-center items-center relative"> <!-- Added relative class for positioning -->
                <hr class="w-12 border-green-900 border-2 absolute animate-line"><!-- Added absolute positioning for the line and animation class -->
            </div>
            <input type="text" id="customerName" name="customerName">
        </form>
        <div id="completionMessage" class="hidden">
        </div>
        <div class="flex justify-center  w-full mb-4 max-md:mb-0" id="progressCircles">
            <div class="w-3 h-3 m-2 bg-green-950 rounded-full"></div>
            <div class="w-3 h-3 m-2 bg-gray-300 rounded-full"></div>
            <div class="w-3 h-3 m-2 bg-gray-300 rounded-full"></div>
        </div>
        <div class="flex justify-center w-full mb-4 max-md:mb-0" id="buttonContainer">
            <button class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded-lg bg-green-950 max-md:px-5" id="prevButton">
                Previous
            </button>
            <button class="flex justify-center m-2 items-center px-12 py-3 w-40 max-w-full text-base font-bold leading-6 text-white whitespace-nowrap rounded-lg bg-green-950 max-md:px-5" id="nextButton">
                Next
            </button>
        </div>
    </div>
</div>


</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const progressCircles = document.getElementById('progressCircles').children;
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const facilitiesForm = document.getElementById('facilitiesForm');
        const reservationDetailsForm = document.getElementById('reservationDetailsForm');
        const customerDetailsForm = document.getElementById('customerDetailsForm');
        const buttonContainer = document.getElementById('buttonContainer');
        let currentStep = 1;

        // Display facilities form initially
        facilitiesForm.style.display = 'block';

        nextButton.addEventListener('click', function() {
            navigateNext();
        });

        prevButton.addEventListener('click', function() {
            navigatePrevious();
        });

        function navigateNext() {
            // Go to next step
            currentStep++;

            // Update progress circles
            updateProgressCircles();

            // Show previous button
            togglePreviousButton();

            // Perform actions for each step
            switch (currentStep) {
                case 2:
                    facilitiesForm.style.display = 'none';
                    reservationDetailsForm.style.display = 'block';
                    break;
                case 3:
                    reservationDetailsForm.style.display = 'none';
                    customerDetailsForm.style.display = 'block';
                    break;
                default:
                    // Hide all forms, show completion message
                    customerDetailsForm.style.display = 'none';
                    document.getElementById('completionMessage').style.display = 'block';
                    nextButton.style.display = 'none'; // Hide the "Next" button
                    break;
            }
        }

        function navigatePrevious() {
            if (currentStep === 1) {
                // Navigate to homepage
                window.location.href = 'index';
            } else {
                // Go to previous step
                currentStep--;

                // Update progress circles
                updateProgressCircles();

                // Show previous button
                togglePreviousButton();

                // Perform actions for each step
                switch (currentStep) {
                    case 1:
                        // Show facilities form, hide other forms
                        facilitiesForm.style.display = 'block';
                        reservationDetailsForm.style.display = 'none';
                        customerDetailsForm.style.display = 'none';
                        break;
                    case 2:
                        // Show reservation details form, hide other forms
                        facilitiesForm.style.display = 'none';
                        reservationDetailsForm.style.display = 'block';
                        customerDetailsForm.style.display = 'none';
                        break;
                    default:
                        break;
                }
            }
        }

        function updateProgressCircles() {
            // Update progress circles
            for (let i = 0; i < progressCircles.length; i++) {
                if (i < currentStep - 1) {
                    progressCircles[i].classList.remove('bg-gray-300');
                    progressCircles[i].classList.add('bg-green-950');
                } else {
                    progressCircles[i].classList.remove('bg-green-950');
                    progressCircles[i].classList.add('bg-gray-300');
                }
            }
        }

        // Function to toggle previous button visibility
        function togglePreviousButton() {
            if (currentStep === 1) {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
            }
        }

        // Initially hide previous button
        togglePreviousButton();
    });
</script>

</html>
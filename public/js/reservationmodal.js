document.addEventListener("DOMContentLoaded", function() {
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');
    const facilitiesForm = document.getElementById('facilitiesForm');
    const reservationDetailsForm = document.getElementById('reservationDetailsForm');
    // const customerDetailsForm = document.getElementById('customerDetailsForm'); // Commented out or deleted
    const progressCircles = document.querySelectorAll('#progressCircles div');
    const storeReservationForm = document.getElementById('storeReservationForm');
    const submitButton = document.getElementById('submitButton'); // Select the submit button

    let currentStep = 1;

    facilitiesForm.style.display = 'block';

    updateButtonText();
    updateProgressCircles();


    nextButton.addEventListener('click', function() {
        navigateNext();
    });

    prevButton.addEventListener('click', function() {
        navigatePrevious();
    });

    submitButton.addEventListener('click', function() {
        showModal();
    });

    function navigateNext() {
        currentStep++;

        switch (currentStep) {
            case 2:
                facilitiesForm.style.display = 'none';
                reservationDetailsForm.style.display = 'block';
                break;
            // case 3: // Skip the customerDetailsForm
            //     reservationDetailsForm.style.display = 'none';
            //     customerDetailsForm.style.display = 'block';
            //     break;
            default:
                showModal();
                break;
        }

        updateButtonText();
        updateProgressCircles();
    }

    function navigatePrevious() {
        if (currentStep === 1) {
            window.location.href = '/';
        } else {
            currentStep--;

            switch (currentStep) {
                case 1:
                    facilitiesForm.style.display = 'block';
                    reservationDetailsForm.style.display = 'none';
                    // customerDetailsForm.style.display = 'none'; // Skip the customerDetailsForm
                    break;
                // case 2: // Skip the customerDetailsForm
                //     facilitiesForm.style.display = 'none';
                //     reservationDetailsForm.style.display = 'block';
                //     customerDetailsForm.style.display = 'none';
                //     break;
                default:
                    break;
            }

            updateButtonText();
            updateProgressCircles();
        }
    }

    function updateButtonText() {
        if (currentStep === 1) {
            prevButton.textContent = 'Back';
            nextButton.textContent = 'Next';
        } else if (currentStep === 2) {
            nextButton.style.display = 'none'; // Hide next button
            submitButton.style.display = 'inline-block'; // Show submit button
        } else {
            prevButton.textContent = 'Previous';
            nextButton.textContent = 'Next';
            nextButton.style.display = 'inline-block'; // Show next button
            submitButton.style.display = 'none'; // Hide submit button
        }
    }

    function updateProgressCircles() {
        progressCircles.forEach((circle, index) => {
            if (index < currentStep - 0) {
                circle.classList.remove('bg-gray-300');
                circle.classList.add('bg-green-950');
            } else {
                circle.classList.remove('bg-green-950');
                circle.classList.add('bg-gray-300');
            }
        });
    }

    function showModal(reservationCode) {
        var modal = document.getElementById('myModal');
        var reservationCodeSpan = document.getElementById('reservation-code');
        reservationCodeSpan.textContent = reservationCode; // Set the reservation code in the modal content
        modal.style.display = 'block';
    }
    

    var closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', function() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    });

    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

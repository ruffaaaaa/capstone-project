    // Get the elements
    const profileIcon = document.getElementById('profileIcon');
    const profileModal = document.getElementById('profileModal');
    const closeProfile = document.getElementById('closeProfile');
    
    // Show modal when the icon is clicked
    profileIcon.addEventListener('click', function() {
        profileModal.classList.remove('hidden');
    });
    
    // Hide modal when the "Close" button is clicked
    closeProfile.addEventListener('click', function() {
        profileModal.classList.add('hidden');
    });
    
    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target == profileModal) {
            profileModal.classList.add('hidden');
        }
    });

    
$(document).ready(function () {
        $('#editprofileForm').on('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), // The form action URL
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Show success message in the modal
                    $('#profileModal .modal-message').html('<p class="text-green-600">' + response.message + '</p>');
                    $('#profileModal .modal-message').show(); // Show the message
                },
                error: function (xhr) {
                    // Handle error response
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '<ul class="text-red-600">';
                    $.each(errors, function (key, value) {
                        errorMessage += '<li>' + value[0] + '</li>';
                    });
                    errorMessage += '</ul>';
                    $('#profileModal .modal-message').html(errorMessage);
                    $('#profileModal .modal-message').show(); // Show the error message
                }
            });
        });

        // Refresh the page when Cancel button is clicked
        $('#closeProfile').on('click', function () {
            location.reload(); // Refresh the page
        });
    });
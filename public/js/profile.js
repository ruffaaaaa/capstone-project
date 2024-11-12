    const profileIcon = document.getElementById('profileIcon');
    const profileModal = document.getElementById('profileModal');
    const closeProfile = document.getElementById('closeProfile');
    
    profileIcon.addEventListener('click', function() {
        profileModal.classList.remove('hidden');
    });
    
    closeProfile.addEventListener('click', function() {
        profileModal.classList.add('hidden');
    });
    
    window.addEventListener('click', function(event) {
        if (event.target == profileModal) {
            profileModal.classList.add('hidden');
        }
    });

    
$(document).ready(function () {
        $('#editprofileForm').on('submit', function (event) {
            event.preventDefault(); 

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), 
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#profileModal .modal-message').html('<p class="text-green-600">' + response.message + '</p>');
                    $('#profileModal .modal-message').show(); 
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
                    $('#profileModal .modal-message').show(); 
                }
            });
        });

        $('#closeProfile').on('click', function () {
            location.reload(); 
        });
    });
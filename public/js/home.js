document.getElementById('openMakeReservation').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.remove('hidden'); 
});

document.getElementById('closeReservationModal').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.add('hidden'); 
});

$(document).ready(function() {
    $('#openCheckStatus').click(function() {
        $('#checkStatusModal').removeClass('hidden').addClass('flex');
        $('#reservation-status').addClass('hidden'); // Hide the status initially when the modal opens
        $('#admin-approvals-list').addClass('hidden'); // Hide the admin approvals list initially
        $('#admin-approvals-header').addClass('hidden'); // Hide the admin approvals header initially
        $('#reservation-status-header').addClass('hidden'); // Hide the reservation status header initially
    });

    // Fetch status when the "Search" button is clicked
    $('#fetchStatusButton').click(function() {
        const reserveeID = $('#reserveeID').val(); // Get the Reservee ID from the input

        // Ensure Reservee ID is entered
        if (!reserveeID) {
            alert('Please enter a Reservee ID');
            return;
        }

        // Make AJAX request to fetch the reservation status
        $.ajax({
            url: `/reservations/${reserveeID}/status`, // Assuming the URL is set correctly
            method: 'GET',
            success: function(data) {
                console.log(data); // Debug: Check what data is returned

                // Update the reservation status
                $('#reservation-status').text(data.reservationStatus || 'No reservation status available').removeClass('hidden'); // Show the status now
                $('#reservation-status-header').removeClass('hidden'); // Show the reservation status header

                let adminList = $('#admin-approvals-list');
                adminList.empty(); // Clear previous data

                // Loop through the admin statuses and display role name and status
                data.adminStatuses.forEach(function(admin) {
                    const role = admin.admin; // Role name (from AdminRole->name)
                    const status = admin.status ? admin.status : 'No status available'; // Handle null status
                    adminList.append(`<li>${role} - ${status}</li>`); // Display role and status
                });

                // Show the admin approvals list and header
                adminList.removeClass('hidden');
                $('#admin-approvals-header').removeClass('hidden');
            },
            error: function(err) {
                console.error(err); // Log any errors
                alert('Failed to fetch status');
            }
        });
    });

    // Close the modal when the "X" button is clicked
    $('#closeCheckStatusModal').click(function() {
        $('#checkStatusModal').removeClass('flex').addClass('hidden');
        location.reload(); // Reload the page to reset form
    });
});



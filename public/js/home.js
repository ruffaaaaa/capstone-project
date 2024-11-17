document.getElementById('openMakeReservation').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.remove('hidden'); 
});

document.getElementById('closeReservationModal').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.add('hidden'); 
});

$(document).ready(function () {
    // Open the modal for checking reservation status
    $('#openCheckStatus').click(function () {
        $('#checkStatusModal').removeClass('hidden').addClass('flex');
        $('#error-message').addClass('hidden').text('');
        $('#admin-approvals-list').addClass('hidden');
        $('#admin-approvals-header').addClass('hidden');
        $('#event-details').addClass('hidden');
        $('#chosen-facilities-header').addClass('hidden');
    });

    // Fetch reservation status when the user clicks on the "Search" button
    $('#fetchStatusButton').click(function () {
        const reserveeID = $('#reserveeID').val();
    
        // Clear all displayed results before making the new request
        $('#event-name').text('');
        $('#event-start-date').text('');
        $('#event-start-time').text('');
        $('#chosen-facilities').text('');
        $('#reservation-status').text('');
        $('#admin-approvals-list').empty();
        $('#event-details').addClass('hidden');
        $('#chosen-facilities-header').addClass('hidden');
        $('#admin-approvals-header').addClass('hidden');
        $('#reservation-status-header').addClass('hidden');
        $('#error-message').addClass('hidden').text('');
    
        if (!reserveeID) {
            $('#error-message')
                .text('Please enter a Reservation Code.')
                .removeClass('hidden');
            return;
        }
    
        $.ajax({
            url: `/reservations/${reserveeID}/status`,
            method: 'GET',
            success: function (data) {
                if (!data || !data.reservationStatus) {
                    $('#error-message')
                        .text('Reservation not found. Please check the Reservation Code and try again.')
                        .removeClass('hidden');
                    $('#reservation-status').text('Reservation not found').removeClass('hidden');
                    $('#reservation-status-header').removeClass('hidden');
                    return; // Stop further execution if no reservation found
                }
    
                // Hide the error message if the reservation is found
                $('#error-message').addClass('hidden').text('');
    
                const formatDate = (dateStr) => {
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric',
                    });
                };
    
                const formatTime = (dateStr) => {
                    const date = new Date(dateStr);
                    return date.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    });
                };
    
                const eventStartDate = data.eventStartDate ? formatDate(data.eventStartDate) : 'No start date available';
                const eventEndDate = data.eventEndDate ? formatDate(data.eventEndDate) : 'No end date available';
    
                const eventStartTime = data.eventStartDate ? formatTime(data.eventStartDate) : 'No start time available';
                const eventEndTime = data.eventEndDate ? formatTime(data.eventEndDate) : 'No end time available';
    
                // Display Event Details
                $('#event-name').text(data.eventName || 'No event name available');
                $('#event-start-date').text(`${eventStartDate} - ${eventEndDate}`);
                $('#event-start-time').text(`${eventStartTime} - ${eventEndTime}`);
                $('#event-details').removeClass('hidden');
    
                // Display Reservation Status
                $('#reservation-status').text(data.reservationStatus || 'No reservation status available').removeClass('hidden');
                $('#reservation-status-header').removeClass('hidden');
    
                // Display Chosen Facilities
                if (data.chosenFacilities && data.chosenFacilities.length > 0) {
                    const facilities = data.chosenFacilities.join(', ');
                    $('#chosen-facilities').text(facilities);
                    $('#chosen-facilities-header').removeClass('hidden');
                } else {
                    $('#chosen-facilities').text('No facilities chosen');
                    $('#chosen-facilities-header').removeClass('hidden');
                }
    
                // Display Admin Approvals
                if (data.adminStatuses && data.adminStatuses.length > 0) {
                    data.adminStatuses.forEach(function (admin) {
                        const role = admin.admin || 'Unknown Role';
                        const status = admin.status || 'No status available';
                        $('#admin-approvals-list').append(`<li>${role} - ${status}</li>`);
                    });
                    $('#admin-approvals-list').removeClass('hidden');
                    $('#admin-approvals-header').removeClass('hidden');
                } else {
                    $('#admin-approvals-list').append('<li>No approvals available</li>');
                    $('#admin-approvals-header').removeClass('hidden');
                }
            },
            error: function (err) {
                console.error(err);
                $('#error-message')
                    .text('Reservation Code not Found.')
                    .removeClass('hidden');
            }
        });
    });
    

    // Close the modal and reset everything when the close button is clicked
    $('#closeCheckStatusModal').click(function () {
        $('#checkStatusModal').removeClass('flex').addClass('hidden');
        location.reload(); // Reload the page to reset form and modal
    });
});




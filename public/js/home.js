document.getElementById('openMakeReservation').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.remove('hidden'); 
});

document.getElementById('closeReservationModal').addEventListener('click', function () {
    document.getElementById('reservationModal').classList.add('hidden'); 
});

$(document).ready(function() {
    $('#openCheckStatus').click(function() {
        $('#checkStatusModal').removeClass('hidden').addClass('flex');
        $('#reservation-status').addClass('hidden'); 
        $('#admin-approvals-list').addClass('hidden'); 
        $('#admin-approvals-header').addClass('hidden'); 
        $('#reservation-status-header').addClass('hidden'); y
    });

    $('#fetchStatusButton').click(function() {
        const reserveeID = $('#reserveeID').val(); 

        if (!reserveeID) {
            alert('Please enter a Reservee ID');
            return;
        }

        $.ajax({
            url: `/reservations/${reserveeID}/status`, 
            method: 'GET',
            success: function(data) {
                console.log(data);

                $('#reservation-status').text(data.reservationStatus || 'No reservation status available').removeClass('hidden'); 
                $('#reservation-status-header').removeClass('hidden'); 

                let adminList = $('#admin-approvals-list');
                adminList.empty(); 

                data.adminStatuses.forEach(function(admin) {
                    const role = admin.admin; 
                    const status = admin.status ? admin.status : 'No status available'; 
                    adminList.append(`<li style="margin-left:15px;">${role} - ${status}</li>`);
                });

                adminList.removeClass('hidden');
                $('#admin-approvals-header').removeClass('hidden');
            },
            error: function(err) {
                console.error(err); 
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



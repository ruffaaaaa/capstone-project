document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('editModal');
    var editButtons = document.querySelectorAll('.editButton');
    var editForm = document.getElementById('editForm'); // Get the edit form

    var editReserveeIDField = document.getElementById('editReserveeID');
    var editStatusField = document.getElementById('editStatus');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var row = button.closest('tr');
            var reserveeID = row.querySelector('td:nth-child(1)').textContent.trim();
            var status = row.querySelector('td:nth-child(4)').textContent.trim();

            editReserveeIDField.value = reserveeID;
            editReserveeIDField.disabled = true; 


            editForm.setAttribute('action', '/admin-reservation/' + reserveeID);
            
            var options = editStatusField.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === status) {
                    options[i].selected = true;
                } else {
                    options[i].selected = false;
                }
            }

            modal.classList.remove('hidden');
        });
    });

    editForm.addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(editForm);
        var url = editForm.getAttribute('action');

        fetch(url, {
            method: 'POST', 
            body: formData
        })
        .then(response => { 
            modal.classList.add('hidden'); 
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    var closeModalButton = document.getElementById('closeModal');
    closeModalButton.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
});
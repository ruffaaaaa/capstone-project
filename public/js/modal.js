document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('editModal');
    var editButtons = document.querySelectorAll('.editButton');
    var editForm = document.getElementById('editForm'); 

    var editFacilityIDField = document.getElementById('editFacilityID');
    var editFacilityNameField = document.getElementById('editFacilityName');
    var editStatusField = document.getElementById('editStatus')

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var row = button.closest('tr');
            var facilityID = row.querySelector('td:nth-child(1)').textContent;
            var facilityName = row.querySelector('td:nth-child(2)').textContent;
            var status = row.querySelector('td:nth-child(4)').textContent;

            editFacilityIDField.value = facilityID;
            editFacilityNameField.value = facilityName;

            editForm.action = '/facilities/' + facilityID; 

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
    var closeModalButton = document.getElementById('closeModal');
    closeModalButton.addEventListener('click', function() {
    modal.classList.add('hidden');
    });

});


document.getElementById('openModalBtn').addEventListener('click', function () {
    document.getElementById('addModal').classList.remove('hidden'); 
});

document.getElementById('closeModalBtn').addEventListener('click', function () {
    document.getElementById('addModal').classList.add('hidden'); 
});


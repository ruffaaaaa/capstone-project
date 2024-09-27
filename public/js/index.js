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

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('openModalBtn').addEventListener('click', function () {
        document.getElementById('openModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function () {
        document.getElementById('openModal').classList.add('hidden');
    });
});


const dropdown = document.querySelector('.relative');

        dropdown.addEventListener('click', function () {
            const dropdownMenu = this.querySelector('.absolute');
            dropdownMenu.classList.toggle('hidden');
        });
        function toggleSettings() {
        var dropdown = document.getElementById('settingsDropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
            localStorage.setItem('settingsDropdownState', 'open');
        } else {
            dropdown.style.display = 'none';
            localStorage.setItem('settingsDropdownState', 'closed');
        }
    }

    window.onload = function() {
        var dropdownState = localStorage.getItem('settingsDropdownState');
        var dropdown = document.getElementById('settingsDropdown');
        if (dropdownState === 'open') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    };


    //dashboard

   
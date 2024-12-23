document.getElementById('openModalBtn').addEventListener('click', function () {
    document.getElementById('addModal').classList.remove('hidden'); 
});

document.getElementById('closeModalBtn').addEventListener('click', function () {
    document.getElementById('addModal').classList.add('hidden'); 
});

document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('editModal');
    var editButtons = document.querySelectorAll('.editButton');
    var editForm = document.getElementById('editForm');

    var editAdminIDField = document.getElementById('editAdminID');
    var editUsernameField = document.getElementById('editUsername');
    var editEmailField = document.getElementById('editEmail');
    var editRoleField = document.getElementById('editRole');
    var editStatusField = document.getElementById('editStatus');


    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var row = button.closest('tr');
            var adminID = row.querySelector('td:nth-child(1)').textContent; // Assuming ID is in the first column
            var username = row.querySelector('td:nth-child(2)').textContent; // Assuming username is in the second column
            var email = row.querySelector('td:nth-child(3)').textContent; // Assuming email is in the third column
            var role = row.querySelector('td:nth-child(4)').textContent; // Assuming role is in the fourth column
            var status = row.querySelector('td:nth-child(5) span').textContent.trim(); // Assuming status is in the fifth column
    
            // Set values in the form fields
            editAdminIDField.value = adminID;
            editUsernameField.value = username;
            editEmailField.value = email;
    
            // Set selected role
            var options = editRoleField.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].text === role) {
                    options[i].selected = true;
                }
            }
    
            // Set checkbox and status text
            editStatusField.checked = (status === "Active");
            statusText.textContent = status;
    
            // Set the form action to update this admin's data
            editForm.action = '/admin/' + adminID; // Use adminID instead of id
    
            // Show the modal
            modal.classList.remove('hidden');
        });
    });
    

    // Close modal
    var closeModalButton = document.getElementById('closeModal');
    closeModalButton.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
});

document.getElementById('password').addEventListener('input', function (e) {
    const errorSpan = document.getElementById('passwordError');
    if (e.target.value.length < 5) {
        errorSpan.classList.remove('hidden');
    } else {
        errorSpan.classList.add('hidden');
    }
});

const form = document.getElementById('addForm');
const roleSelect = document.getElementById('role_id');
const roleError = document.getElementById('roleError');

form.addEventListener('submit', function (e) {
    if (roleSelect.value === "") {
        e.preventDefault(); 
        roleError.classList.remove('hidden');
    } else {
        roleError.classList.add('hidden');
    }
});

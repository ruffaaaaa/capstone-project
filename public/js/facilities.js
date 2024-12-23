document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('editModal');
    var editButtons = document.querySelectorAll('.editButton');
    var editForm = document.getElementById('editForm'); 

    var editFacilityIDField = document.getElementById('editFacilityID');
    var editFacilityNameField = document.getElementById('editFacilityName');
    var editStatusField = document.getElementById('editStatus');
    var editImageField = document.getElementById('editImage'); // Add this for handling image input

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var row = button.closest('tr');
            var facilityID = row.querySelector('td:nth-child(1)').textContent;
            var facilityName = row.querySelector('td:nth-child(2)').textContent;
            var status = row.querySelector('td:nth-child(4) span').textContent.trim(); // Assuming status is in the fifth column
            var imageSrc = row.querySelector('td:nth-child(3) img').src;

            editFacilityIDField.value = facilityID;
            editFacilityNameField.value = facilityName;

            // Prepopulate the image input (optional, display current image)
            editImageField.value = '';  // Clear the current image field if a new one is selected
            document.getElementById('currentImage').src = imageSrc; // Optionally show the current image in the modal

            editForm.action = '/facilities/' + facilityID; 


            editStatusField.checked = (status === "Active");
            statusText.textContent = status;

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

// document.getElementById('searchInput').addEventListener('keyup', function() {
//     const searchQuery = this.value.toLowerCase();
//     const tableRows = document.querySelectorAll('tbody tr');

//     tableRows.forEach(row => {
//         const facilityName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
//         const facilityStatus = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

//         if (facilityName.includes(searchQuery) || facilityStatus.includes(searchQuery)) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     });
// });
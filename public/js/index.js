   
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const mainContent = document.querySelector('main');
    const iconPath = toggleButton.querySelector('path');

    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');

        const isCollapsed = sidebar.classList.contains('collapsed');
        sessionStorage.setItem('sidebarCollapsed', isCollapsed);

        if (isCollapsed) {
            iconPath.setAttribute('d', 'M3.25 10a.75.75 0 01.75-.75H14.388l-4.158-3.96a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08L14.388 10H4.75A.75.75 0 013.25 10z');
        } else {
            iconPath.setAttribute('d', 'M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z');
        }
    }

    toggleButton.addEventListener('click', toggleSidebar);

    const storedSidebarState = sessionStorage.getItem('sidebarCollapsed');

    if (storedSidebarState === 'true') {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('collapsed');
        iconPath.setAttribute('d', 'M3.25 10a.75.75 0 01.75-.75H14.388l-4.158-3.96a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08L14.388 10H4.75A.75.75 0 013.25 10z');
    } else {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('collapsed');
        iconPath.setAttribute('d', 'M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z');
    }

    const sidebarContent = document.getElementById("sidebar-content");

    const windowHeight = window.innerHeight;
    const headerHeight = 100; 
    const minHeight = 300; 
    const maxHeight = windowHeight - headerHeight;

    sidebarContent.style.height = Math.max(minHeight, maxHeight) + "px";
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

   
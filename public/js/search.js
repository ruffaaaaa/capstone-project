document.getElementById('facilitySearch').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const facilities = document.querySelectorAll('.facility-item');
    let hasVisibleFacilities = false;

    facilities.forEach(facility => {
        const facilityName = facility.querySelector('label').textContent.toLowerCase();
        if (facilityName.includes(searchValue)) {
            facility.style.display = 'block';
            hasVisibleFacilities = true;
        } else {
            facility.style.display = 'none';
        }
    });

    document.getElementById('noFacilitiesAlert').style.display = hasVisibleFacilities ? 'none' : 'block';
});

function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#reservationTable tbody tr");

    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
        row.style.display = rowText.includes(input) ? "" : "none";
    });
}
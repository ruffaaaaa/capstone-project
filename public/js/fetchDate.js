let unavailableDates = [];

function updateDatePicker() {
    flatpickr("#date-input", {
        enable: [], // Allow all dates initially
        disable: unavailableDates.map(date => new Date(date)), // Disable unavailable dates
    });
}

function fetchUnavailableDates() {
    console.log("fetchUnavailableDates called");

    const selectedFacilities = Array.from(document.querySelectorAll('.facility-checkbox:checked'))
        .map(checkbox => checkbox.value)
        .join(',');

    const eventStartDate = document.getElementById('event-start-date').value; // Capture the selected date
    console.log("Selected Facilities:", selectedFacilities);
    console.log("Event Start Date:", eventStartDate);

    if (selectedFacilities && eventStartDate) {
        fetch(`/api/unavailable-dates?facilityIds=${selectedFacilities}&eventStartDate=${eventStartDate}`)
            .then(response => response.json())
            .then(data => {
                console.log("API Response:", data);
                unavailableDates = data.unavailableDates; // Store unavailable dates
                console.log("Unavailable Dates:", unavailableDates); // Log the unavailable dates

                // Update the date picker with the new unavailable dates
                updateDatePicker();

                // Convert the selected date to a Date object
                const selectedDateObj = new Date(eventStartDate + "Z"); // Treat as UTC by appending 'Z'

                // Convert unavailable dates to Date objects
                const unavailableDateObjects = unavailableDates.map(date => new Date(date));

                // Check if the selected date matches any unavailable date
                const isDateUnavailable = unavailableDateObjects.some(unavailableDate =>
                    unavailableDate.getTime() === selectedDateObj.getTime()
                );

                if (isDateUnavailable) {
                    alert('Sorry, this date is unavailable for the selected facility. Please select another date.');
                    document.getElementById('event-start-date').value = ''; // Clear the date input
                } else {
                    console.log('Date is available.');
                }
            })
            .catch(error => console.error('Error fetching unavailable dates:', error));
    }
}

document.querySelectorAll('.facility-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', fetchUnavailableDates);
});

document.getElementById('event-start-date').addEventListener('change', function() {
    const eventStartDate = this.value; // Capture the selected date
    console.log("Event Start Date Selected:", eventStartDate); // Log it for debugging
    fetchUnavailableDates(); // Fetch unavailable dates when the date changes
});


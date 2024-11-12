let unavailableDates = [];

function updateDatePicker() {
    flatpickr("#date-input", {
        enable: [],
        disable: unavailableDates.map(date => new Date(date)), 
    });
}

function fetchUnavailableDates() {
    console.log("fetchUnavailableDates called");

    const selectedFacilities = Array.from(document.querySelectorAll('.facility-checkbox:checked'))
        .map(checkbox => checkbox.value)
        .join(',');

    const eventStartDate = document.getElementById('event-start-date').value; 
    console.log("Selected Facilities:", selectedFacilities);
    console.log("Event Start Date:", eventStartDate);

    if (selectedFacilities && eventStartDate) {
        fetch(`/api/unavailable-dates?facilityIds=${selectedFacilities}&eventStartDate=${eventStartDate}`)
            .then(response => response.json())
            .then(data => {
                console.log("API Response:", data);
                
                if (data.unavailableDates) {
                    console.log("Received unavailable dates (Approved only):", data.unavailableDates);
                } else {
                    console.log("No unavailable dates found or API response format unexpected.");
                }

                unavailableDates = data.unavailableDates || []; 
                updateDatePicker();

                const selectedDateObj = new Date(eventStartDate + "Z"); 

                const unavailableDateObjects = unavailableDates.map(date => new Date(date));

                const isDateUnavailable = unavailableDateObjects.some(unavailableDate =>
                    unavailableDate.getTime() === selectedDateObj.getTime()
                );

                console.log("Is selected date unavailable?", isDateUnavailable);

                if (isDateUnavailable) {
                    alert('Sorry, this date is unavailable for the selected facility. Please select another date.');
                    document.getElementById('event-start-date').value = '';
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
    const eventStartDate = this.value; 
    console.log("Event Start Date Selected:", eventStartDate);
    fetchUnavailableDates(); 
});


function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}

function setMinEventDate() {
    const today = new Date();
    today.setDate(today.getDate() + 3); 
    document.getElementById('event-start-date').setAttribute('min', formatDate(today));
}

function updateEventEndDateMin(eventStartDateTime) {
    const startDate = new Date(eventStartDateTime);
    const endDateInput = document.getElementById('event-end-date');
    const endDate = new Date(endDateInput.value);

    if (endDateInput.value && startDate.toDateString() === endDate.toDateString()) {
        endDateInput.setAttribute('min', eventStartDateTime);
        
        if (endDate < startDate) {
            endDateInput.value = eventStartDateTime;
        }
    } else {
        endDateInput.setAttribute('min', formatDate(startDate));
    }
}

function updatePreparationConstraints(eventStartDateTime) {
    const eventStart = new Date(eventStartDateTime);
    eventStart.setSeconds(eventStart.getSeconds() - 1);
    const maxPreparationDateTime = formatDate(eventStart);
    document.getElementById('preparation-start-date').setAttribute('max', maxPreparationDateTime);
    document.getElementById('preparation-end-date').setAttribute('max', maxPreparationDateTime);
}


function updatePreparationEndMin(preparationStartDateTime) {
    const preparationStart = new Date(preparationStartDateTime);
    document.getElementById('preparation-end-date').setAttribute('min', formatDate(preparationStart));
}

// Event listeners for changes to preparation dates
document.getElementById('preparation-start-date').addEventListener('change', function() {
    const preparationStartDateTime = this.value;
    updatePreparationEndMin(preparationStartDateTime); 
    validatePreparationDates();
});


function updateCleanupConstraints(eventEndDateTime) {
    const eventEnd = new Date(eventEndDateTime);

    document.getElementById('cleanup-start-date').setAttribute('min', formatDate(eventEnd));
    document.getElementById('cleanup-end-date').setAttribute('min', formatDate(eventEnd));

    const maxCleanupEndDate = new Date(eventEnd);
    maxCleanupEndDate.setDate(maxCleanupEndDate.getDate() + 3); 

    document.getElementById('cleanup-end-date').setAttribute('max', formatDate(maxCleanupEndDate));

    document.getElementById('cleanup-start-date').setAttribute('max', formatDate(maxCleanupEndDate));

    document.getElementById('cleanup-start-date').value = '';
    document.getElementById('cleanup-end-date').value = '';

    validateCleanupDates();
}


function validateEventEndDate() {
    const startDateInput = document.getElementById('event-start-date');
    const endDateInput = document.getElementById('event-end-date');
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);

    if (endDate < startDate) {
        alert("The event end time cannot be set before the start time. Please choose a valid end time.");
        endDateInput.value = startDateInput.value;
    }
}


function validatePreparationDates() {
    const startDateInput = document.getElementById('event-start-date');
    const preparationStartInput = document.getElementById('preparation-start-date');
    const preparationEndInput = document.getElementById('preparation-end-date');

    const eventStartDate = new Date(startDateInput.value);
    const preparationStartDate = new Date(preparationStartInput.value);
    const preparationEndDate = new Date(preparationEndInput.value);

    if (preparationStartDate >= eventStartDate) {
        alert("The preparation start time must occur before the event start time. Please choose a valid preparation start time.");
        preparationStartInput.value = ''; 
        updatePreparationEndMin(''); 
    }

    if (preparationEndDate < preparationStartDate) {
        alert("The preparation end time cannot be set before the preparation start time. Please choose a valid preparation end time.");
        preparationEndInput.value = ''; 
        updatePreparationEndMin(preparationStartInput.value); 
    }

    if (preparationEndDate >= eventStartDate) {
        alert("The preparation end time must occur before the event start time. Please choose a valid preparation end time.");
        preparationEndInput.value = ''; 
        updatePreparationEndMin(preparationStartInput.value);
    }
}


function validateCleanupDates() {
    const endDateInput = document.getElementById('event-end-date');
    const cleanupStartInput = document.getElementById('cleanup-start-date');
    const cleanupEndInput = document.getElementById('cleanup-end-date');

    const eventEndDate = new Date(endDateInput.value);
    const cleanupStartDate = new Date(cleanupStartInput.value);
    const cleanupEndDate = new Date(cleanupEndInput.value);

    if (cleanupStartInput.value && cleanupStartDate < eventEndDate) {
        alert("The cleanup start time cannot be set before the event end time. Please choose a valid cleanup start time.");
        cleanupStartInput.value = '';
    }

    if (cleanupEndDate < cleanupStartDate) {
        alert("The cleanup end time cannot be set before the cleanup start time. Please choose a valid cleanup end time.");
        cleanupEndInput.value = cleanupStartInput.value; 
    }

    const maxCleanupEndDate = new Date(eventEndDate);
    maxCleanupEndDate.setDate(maxCleanupEndDate.getDate() + 3); 
    if (cleanupEndDate > maxCleanupEndDate) {
        alert("The cleanup end time must be within 2 days after the event end time. Please choose a valid cleanup end time.");
        cleanupEndInput.value = formatDate(maxCleanupEndDate);
    }
}


document.getElementById('event-start-date').addEventListener('change', function() {
    const eventStartDateTime = this.value;
    updateEventEndDateMin(eventStartDateTime);
    updatePreparationConstraints(eventStartDateTime);
    updateCleanupConstraints(document.getElementById('event-end-date').value);
});

document.getElementById('event-end-date').addEventListener('change', function() {
    const eventEndDateTime = this.value;
    validateEventEndDate();
    updateCleanupConstraints(eventEndDateTime);
});

document.getElementById('preparation-start-date').addEventListener('change', validatePreparationDates);
document.getElementById('preparation-end-date').addEventListener('change', validatePreparationDates);
document.getElementById('cleanup-start-date').addEventListener('change', validateCleanupDates);
document.getElementById('cleanup-end-date').addEventListener('change', validateCleanupDates);

window.onload = setMinEventDate;


document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, '0'); 
    const day = today.getDate().toString().padStart(2, '0'); 
    const formattedDate = `${year}-${month}-${day}`;
    document.getElementById('date_of_filing').value = formattedDate;
});

function checkEventFields() {
    const eventStartDate = document.getElementById('event-start-date').value;
    const eventEndDate = document.getElementById('event-end-date').value;

    if (eventStartDate && eventEndDate) {
        document.getElementById('preparation-fields').classList.remove('hidden');
        document.getElementById('cleanup-fields').classList.remove('hidden');
    } else {
        document.getElementById('preparation-fields').classList.add('hidden');
        document.getElementById('cleanup-fields').classList.add('hidden');
    }
}

document.getElementById('event-start-date').addEventListener('input', checkEventFields);
document.getElementById('event-end-date').addEventListener('input', checkEventFields);

checkEventFields();

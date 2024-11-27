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
    const eventStartDateInput = document.getElementById('event-start-date');
    eventStartDateInput.setAttribute('min', formatDate(today));

    eventStartDateInput.addEventListener('keydown', function(e) {
        e.preventDefault(); 
    });
    document.getElementById('event-end-date').addEventListener('keydown', function(e) {
        e.preventDefault();
    });
    document.getElementById('preparation-start-date').addEventListener('keydown', function(e) {
        e.preventDefault(); 
    });
    document.getElementById('preparation-end-date').addEventListener('keydown', function(e) {
        e.preventDefault();
    });
    document.getElementById('cleanup-start-date').addEventListener('keydown', function(e) {
        e.preventDefault();
    });
    document.getElementById('cleanup-end-date').addEventListener('keydown', function(e) {
        e.preventDefault();
    });
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
        alert("The cleanup end time must be within 3 days after the event end time. Please choose a valid cleanup end time.");
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

window.onload = function() {
    setMinEventDate();
};

document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, '0'); 
    const day = today.getDate().toString().padStart(2, '0'); 
    const formattedDate = `${year}-${month}-${day}`;
    document.getElementById('date_of_filing').value = formattedDate;
});

document.getElementById('preparation-required').addEventListener('change', function () {
    const preparationFields = document.getElementById('preparation-fields');
    if (this.checked) {
        preparationFields.classList.remove('hidden');
    } else {
        preparationFields.classList.add('hidden');
    }
});

document.getElementById('cleanup-required').addEventListener('change', function () {
    const cleanupFields = document.getElementById('cleanup-fields');
    if (this.checked) {
        cleanupFields.classList.remove('hidden');
    } else {
        cleanupFields.classList.add('hidden');
    }
});

function areSameDateTime(dateTime1, dateTime2) {
    return new Date(dateTime1).getTime() === new Date(dateTime2).getTime();
}

function validateUniqueDateTimes() {
    const eventStartDate = document.getElementById('event-start-date').value;
    const eventEndDate = document.getElementById('event-end-date').value;
    const preparationStartDate = document.getElementById('preparation-start-date').value;
    const preparationEndDate = document.getElementById('preparation-end-date').value;
    const cleanupStartDate = document.getElementById('cleanup-start-date').value;
    const cleanupEndDate = document.getElementById('cleanup-end-date').value;

    const fields = [
        { id: 'event-start-date', value: eventStartDate, label: 'Event Start Date' },
        { id: 'event-end-date', value: eventEndDate, label: 'Event End Date' },
        { id: 'preparation-start-date', value: preparationStartDate, label: 'Preparation Start Date' },
        { id: 'preparation-end-date', value: preparationEndDate, label: 'Preparation End Date' },
        { id: 'cleanup-start-date', value: cleanupStartDate, label: 'Cleanup Start Date' },
        { id: 'cleanup-end-date', value: cleanupEndDate, label: 'Cleanup End Date' }
    ];

    for (let i = 0; i < fields.length; i++) {
        for (let j = i + 1; j < fields.length; j++) {
            if (fields[i].value && fields[j].value && areSameDateTime(fields[i].value, fields[j].value)) {
                alert(`${fields[i].label} cannot have the same date and time as ${fields[j].label}. Please update the values.`);
                document.getElementById(fields[j].id).value = '';
                return false;
            }
        }
    }
    return true;
}

document.getElementById('event-start-date').addEventListener('change', validateUniqueDateTimes);
document.getElementById('event-end-date').addEventListener('change', validateUniqueDateTimes);
document.getElementById('preparation-start-date').addEventListener('change', validateUniqueDateTimes);
document.getElementById('preparation-end-date').addEventListener('change', validateUniqueDateTimes);
document.getElementById('cleanup-start-date').addEventListener('change', validateUniqueDateTimes);
document.getElementById('cleanup-end-date').addEventListener('change', validateUniqueDateTimes);

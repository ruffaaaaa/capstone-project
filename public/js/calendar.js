var currentFilter = 'all';  // Default to 'all'
var selectedFacility = '';

function filterEvents(filter) {
    currentFilter = filter;
    $('#calendar').fullCalendar('rerenderEvents');
}

function filterByFacility(facility) {
    selectedFacility = facility;
    $('#calendar').fullCalendar('rerenderEvents');
}

$(document).ready(function() {
    // Fetch facilities on page load
    $.ajax({
        url: '/facilities',
        method: 'GET',
        success: function(data) {
            var dropdownMenu = $('#facilityFilter');
            dropdownMenu.empty();  // Clear existing items
            dropdownMenu.append('<option value="">Select</option>');  // Add default option

            // Ensure data is an array
            if (Array.isArray(data)) {
                data.forEach(function(facility) {
                    // Use facility.facilityName instead of facility.name
                    dropdownMenu.append(
                        `<option value="${facility.facilityName}">${facility.facilityName}</option>`
                    );
                });
            } else {
                console.error('Unexpected data format:', data);
            }
        },
        error: function() {
            alert('There was an error while fetching facilities.');
        }
    });

    // Initialize the calendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev, today, next',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },
        defaultView: 'month',
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: '/reservations',
                method: 'GET',
                success: function(data) {
                    var events = [];
                    $(data).each(function() {
                        var facilities = this.facilities.map(function(facility) {
                            return facility.facilityName;  
                        }).join(', ');

                        events.push({
                            id: this.id,
                            title: this.title,
                            start: this.estart,
                            end: this.eend,
                            max_attendees: this.max_attendees,
                            facilities: facilities,
                            color: '#3a87ad',
                            type: 'eventProper'
                        });

                        if (this.pstart && this.pend) {
                            events.push({
                                id: this.id + '_prep',
                                title: this.title + ' (Preparation)',
                                start: this.pstart,
                                end: this.pend,
                                facilities: facilities,
                                color: '#f0ad4e',
                                type: 'preparation'
                            });
                        }

                        if (this.cstart && this.cend) {
                            events.push({
                                id: this.id + '_cleanup',
                                title: this.title + ' (Cleanup)',
                                start: this.cstart,
                                end: this.cend,
                                facilities: facilities,
                                color: '#d9534f',
                                type: 'cleanup'
                            });
                        }
                    });
                    callback(events);
                },
                error: function() {
                    alert('There was an error while fetching events.');
                }
            });
        },
        eventRender: function(event, element) {
            // Show all events if 'all' is selected
            if (currentFilter === 'all' || event.type === currentFilter) {
                if (selectedFacility === '' || event.facilities.includes(selectedFacility)) {
                    element.find('.fc-time').remove();

                    var startTime = moment(event.start).format('hh:mm A');
                    var endTime = moment(event.end).format('hh:mm A');

                    element.find('.fc-title').html(
                        "<strong>" + event.title.toUpperCase() + "</strong><br/>" +
                        "<span class='facilities'>" + event.facilities + "<br/>" +
                        startTime + " - " + endTime + "</span>"
                    );

                    element.find('.facilities').css('font-size', '13px');
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    });
});

var currentFilter = 'all';
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
    $.ajax({
        url: '/facilitiesQuery',
        method: 'GET',
        success: function(data) {
            var dropdownMenu = $('#facilityFilter');
            dropdownMenu.empty();
            dropdownMenu.append('<option value="">Select</option>');
            if (Array.isArray(data)) {
                data.forEach(function(facility) {
                    dropdownMenu.append(`<option value="${facility.facilityName}">${facility.facilityName}</option>`);
                });
            } else {
                console.error('Unexpected data format:', data);
            }
        },
        error: function() {
            alert('Error fetching facilities.');
        }
    });

    $('#calendar').fullCalendar({
        header: { left: '', center: '', right: '' },
        defaultView: 'month',
        height: 'auto',

        events: function(start, end, timezone, callback) {
            $.ajax({
                url: '/reservationsQuery',
                method: 'GET',
                success: function(data) {
                    console.log("Event data:", data); // Debugging statement
                    var events = [];
                    $(data).each(function() {
                        var facilities = this.facilities ? this.facilities.map(f => f.facilityName).join(', ') : '';
                        events.push({
                            id: this.id,
                            title: this.title,
                            start: this.estart,
                            end: this.eend,
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
                    alert('Error fetching events.');
                }
            });
        },
        eventRender: function(event, element) {
            if (currentFilter === 'all' || event.type === currentFilter) {
                if (selectedFacility === '' || event.facilities.includes(selectedFacility)) {
                    element.find('.fc-time').remove();
                    var startTime = moment(event.start).format('hh:mm A');
                    var endTime = moment(event.end).format('hh:mm A');
                    if (event.title) {
                        element.find('.fc-title').html(
                            `<strong>${event.title.toUpperCase()}</strong><br/>
                            <span class='facilities'>${event.facilities || ''}<br/>
                            ${startTime} - ${endTime}</span>`
                        );
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        },
        eventClick: function(event) {
            $('#eventTitle').text(event.title);
            $('#eventFacilities').text(event.facilities || 'No facilities specified.');
            $('#eventStart').text(moment(event.start).format('MMMM Do YYYY, h:mm:ss a'));
            $('#eventEnd').text(moment(event.end).format('MMMM Do YYYY, h:mm:ss a'));
            $('#eventModal').removeClass('hidden');
        },
        viewRender: function(view) {
            $('#calendar-title').text(view.title);
        }
    });

    $('#closeModal').click(function() {
        $('#eventModal').addClass('hidden');
    });

    $('#view-selector').change(function() {
        var selectedView = $(this).val();
        $('#calendar').fullCalendar('changeView', selectedView);
        $('#calendar-title').text($('#calendar').fullCalendar('getView').title);
    });
});
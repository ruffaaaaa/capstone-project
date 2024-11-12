var currentFilter = 'all';
var selectedFacility = '';
var currentStatus = 'Approved';


function filterEvents(filter) {
    currentFilter = filter;
    $('#calendar').fullCalendar('rerenderEvents');
}

function filterByFacility(facility) {
    selectedFacility = facility;
    $('#calendar').fullCalendar('rerenderEvents');
}

function filterByStatus(status) {
    currentStatus = status;
    $('#calendar').fullCalendar('rerenderEvents');
}

$(document).ready(function() {
    $.ajax({
        url: '/facilitiesQuery',
        method: 'GET',
        success: function(data) {
            var dropdownMenu = $('#facilityFilter');
            dropdownMenu.empty();
            dropdownMenu.append('<option value="">All</option>');
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
                    console.log("Event data:", data); 
                    var events = [];
                    $(data).each(function() {
                        var facilities = this.facilities ? this.facilities.map(f => f.facilityName).join(', ') : '';
                        var eventStatus = this.status; // Assuming status is provided in the API response
                        events.push({
                            id: this.id,
                            title: this.title,
                            start: this.estart,
                            end: this.eend,
                            facilities: facilities,
                            color: '#f51161',
                            type: 'eventProper',
                            status: eventStatus
                        });
                        if (this.pstart && this.pend) {
                            events.push({
                                id: this.id + '_prep',
                                title: this.title,
                                start: this.pstart,
                                end: this.pend,
                                facilities: facilities,
                                color: '#38baa2',
                                type: 'preparation',
                                status: eventStatus
                            });
                        }
                        if (this.cstart && this.cend) {
                            events.push({
                                id: this.id + '_cleanup',
                                title: this.title,
                                start: this.cstart,
                                end: this.cend,
                                facilities: facilities,
                                color: '#2792b0',
                                type: 'cleanup',
                                status: eventStatus
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
            if ((currentFilter === 'all' || event.type === currentFilter) &&
                (selectedFacility === '' || event.facilities.includes(selectedFacility)) &&
                (currentStatus === 'all' || (event.status && event.status.trim().toLowerCase() === currentStatus.trim().toLowerCase()))) {
                
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
        },
        
        eventClick: function(event, jsEvent, view) {
            $('#eventTitle').text(event.title);
            $('#eventFacilities').text(event.facilities);
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
    $('#today-btn').click(function() {
        $('#calendar').fullCalendar('today');
        $('#calendar-title').text($('#calendar').fullCalendar('getView').title);
    });

    $('#prev-btn').click(function() {
        $('#calendar').fullCalendar('prev');
        $('#calendar-title').text($('#calendar').fullCalendar('getView').title);
    });

    $('#next-btn').click(function() {
        $('#calendar').fullCalendar('next');
        $('#calendar-title').text($('#calendar').fullCalendar('getView').title);
    });
});
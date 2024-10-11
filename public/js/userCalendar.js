var currentFilter = 'eventProper';  // Default to show only main events
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
        url: '/facilitiesQuery',
        method: 'GET',
        success: function(data) {
            var dropdownMenu = $('#facilityFilter');
            dropdownMenu.empty();  // Clear existing items
            dropdownMenu.append('<option value="">Select</option>');  // Add default option
    
            if (Array.isArray(data)) {
                data.forEach(function(facility) {
                    dropdownMenu.append(`<option value="${facility.facilityName}">${facility.facilityName}</option>`);
                });
            } else {
                console.error('Unexpected data format:', data);
            }
        },
        error: function() {
            alert('There was an error while fetching facilities.');
        }
    });
    $('#calendar-title').text($('#calendar').fullCalendar('getView').title);

    $('#calendar').fullCalendar({
        header: {
            left: '',
            center: '',
            right: ''
        },
        defaultView: 'month',
        height: 'auto',

        events: function(start, end, timezone, callback) {
            $.ajax({
                url: '/reservationsQuery',
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
                            color: '#7AE7B7',
                            type: 'eventProper',
                            description: this.description 
                        });

                        if (this.pstart && this.pend) {
                            events.push({
                                id: this.id + '_prep',
                                title: this.title + ' (Preparation)',
                                start: this.pstart,
                                end: this.pend,
                                facilities: facilities,
                                color: '#f0ad4e',
                                type: 'preparation',
                                description: this.description
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
                                type: 'cleanup',
                                description: this.description
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
            if (currentFilter === 'all' || event.type === currentFilter) {
                if (selectedFacility === '' || event.facilities.includes(selectedFacility)) {
                    element.find('.fc-time').remove();  
        
                    var startTime = moment(event.start).format('hh:mm A');
                    var endTime = moment(event.end).format('hh:mm A');
        
                    element.find('.fc-title').html(
                        `<strong style="color: black;">${event.title.toUpperCase()}</strong><br/>` +  
                        `<span class='facilities' style="color: black;">${event.facilities}</span><br/>` +  
                        `<span class='time' style="color: black;">${startTime} - ${endTime}</span>`  
                    );
        
                    element.find('.facilities').css('font-size', '13px');
                    element.find('.time').css('font-size', '13px');
                } else {
                    return false; 
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


$(document).ready(function() {
    function updateViewSelector() {
        if (window.matchMedia("(max-width: 768px)").matches) {
            $('#view-selector option[value="agendaWeek"]').hide();
        } else {
            $('#view-selector option[value="agendaWeek"]').show();
        }
    }

    updateViewSelector();

    $(window).resize(function() {
        updateViewSelector();
    });
});


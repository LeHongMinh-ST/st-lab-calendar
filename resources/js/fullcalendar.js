/* ------------------------------------------------------------------------------
 *
 *  # Fullcalendar basic options
 *
 *  Demo JS code for extra_fullcalendar_views.html and extra_fullcalendar_styling.html pages
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

const FullCalendarBasic = function() {


    //
    // Setup module components
    //

    // Basic calendar
    const _componentFullCalendarBasic = function() {
        if (typeof FullCalendar == 'undefined') {
            console.warn('Warning - Fullcalendar files are not loaded.');
            return;
        }

        // Add demo events
        // ------------------------------

        // Default events
        const events = [
            {
                title: 'All Day Event',
                start: '2020-09-01'
            },
            {
                title: 'Long Event',
                start: '2020-09-07',
                end: '2020-09-10'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2020-09-09T16:00:00'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2020-09-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2020-09-11',
                end: '2020-09-13'
            },
            {
                title: 'Meeting',
                start: '2020-09-12T10:30:00',
                end: '2020-09-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2020-09-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2020-09-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2020-09-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2020-09-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2020-09-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2020-09-28'
            }
        ];


        // Initialization
        // ------------------------------

        //
        // Basic view
        //

        // Define element
        const calendarBasicViewElement = document.querySelector('.fullcalendar-basic');

        // Initialize
        if(calendarBasicViewElement) {
            const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                locale: 'vi',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                },
                initialView: 'timeGridWeek',
                initialDate: '2020-09-12',
                navLinks: true, // can click day/week names to navigate views
                nowIndicator: true,
                weekNumberCalculation: 'ISO',
                editable: true,
                // timelineDay: {
                //     slotLabelFormat: ['H:mm'],
                // },
                // slotMinTime:"21:00:00",
                // slotMaxTime:"06:00:00",
                selectable: true,
                // direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                dayMaxEvents: true, // allow "more" link when too many events
                events: events
            });

            // Init
            calendarBasicViewInit.render();

            // Resize calendar when sidebar toggler is clicked
            document.querySelectorAll('.sidebar-control').forEach(function(sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    calendarBasicViewInit.updateSize();
                });
            });
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentFullCalendarBasic();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FullCalendarBasic.init();
});
1

import './bootstrap';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/interaction/main.css';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        events: '/api/attendance-events', // Endpoint for fetching attendance data
        dateClick: function(info) {
            alert('Clicked on: ' + info.dateStr);
        },
        eventClick: function(info) {
            alert('Event: ' + info.event.title);
        }
    });

    calendar.render();
});


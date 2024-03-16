<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialDate: @json($today),
			initialView: 'dayGridMonth',
			nowIndicator: true,
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			dayMaxEvents: true, // allow "more" link when too many events
			events: @json($events)
		});

		calendar.render();
	});
</script>

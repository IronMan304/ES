<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeCourseModal', () => {
		$('#courseModal').modal('hide');
	});

	window.livewire.on('openCourseModal', () => {
		$('#courseModal').modal('show');
	});
</script>

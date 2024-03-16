<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeDoctorModal', () => {
		$('#doctorModal').modal('hide');
	});

	window.livewire.on('openDoctorModal', () => {
		$('#doctorModal').modal('show');
	});
</script>

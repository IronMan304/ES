<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closePatientModal', () => {
		$('#patientModal').modal('hide');
	});

	window.livewire.on('openPatientModal', () => {
		$('#patientModal').modal('show');
	});

	window.livewire.on('closePatientAccountModal', () => {
		$('#patientAccountModal').modal('hide');
	});

	window.livewire.on('openPatientAccountModal', () => {
		$('#patientAccountModal').modal('show');
	});
	window.livewire.on('hidePatientAccountButton', () => {
		$('#patientAccountButton').modal('hide');
	});

	window.livewire.on('showPatientAccountButton', () => {
		$('#patientAccountButton').modal('show');
	});

	window.livewire.on('closePatientResultViewModal', () => {
		$('#patientResultViewModal').modal('hide');
	});

	window.livewire.on('openPatientResultViewModal', () => {
		$('#patientResultViewModal').modal('show');
	});
</script>

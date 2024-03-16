<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeAppointmentModal', () => {
		$('#appointmentModal').modal('hide');
	});
	window.livewire.on('openAppointmentModal', () => {
		$('#appointmentModal').modal('show');
	});

	window.livewire.on('closeDocumentModal', () => {
		$('#documentModal').modal('hide');
	});
	window.livewire.on('openDocumentModal', () => {
		$('#documentModal').modal('show');
	});

	window.livewire.on('closePrescriptionModal', () => {
		$('#prescriptionModal').modal('hide');
	});
	window.livewire.on('openPrescriptionModal', () => {
		$('#prescriptionModal').modal('show');
	});

	window.livewire.on('closeCertificateModal', () => {
		$('#certificateModal').modal('hide');
	});
	window.livewire.on('openCertificateModal', () => {
		$('#certificateModal').modal('show');
	});
</script>
<script>
	function copyFn() {
		// Get the text field
		var copyText = document.getElementById("room");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);
	}
</script>

<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeCpeModal', () => {
		$('#cpeModal').modal('hide');
	});

	window.livewire.on('openCpeModal', () => {
		$('#cpeModal').modal('show');
	});
</script>

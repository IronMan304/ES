<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeActiveMedModal', () => {
		$('#activeMedModal').modal('hide');
	});

	window.livewire.on('openActiveMedModal', () => {
		$('#activeMedModal').modal('show');
	});

	window.livewire.on('closeActiveRadModal', () => {
		$('#activeRadModal').modal('hide');
	});

	window.livewire.on('openActiveRadModal', () => {
		$('#activeRadModal').modal('show');
	});
</script>

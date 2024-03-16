<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeCompanyModal', () => {
		$('#companyModal').modal('hide');
	});

	window.livewire.on('openCompanyModal', () => {
		$('#companyModal').modal('show');
	});
</script>

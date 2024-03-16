<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeUnitModal', () => {
        $('#unitModal').modal('hide');
    });

    window.livewire.on('openUnitModal', () => {
        $('#unitModal').modal('show');
    });
</script>
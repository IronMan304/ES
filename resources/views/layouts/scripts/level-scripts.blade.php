<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeLevelModal', () => {
        $('#levelModal').modal('hide');
    });

    window.livewire.on('openLevelModal', () => {
        $('#levelModal').modal('show');
    });
</script>
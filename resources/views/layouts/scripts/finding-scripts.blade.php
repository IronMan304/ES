<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeFindingModal', () => {
        $('#findingModal').modal('hide');
    });

    window.livewire.on('openFindingModal', () => {
        $('#findingModal').modal('show');
    });
</script>

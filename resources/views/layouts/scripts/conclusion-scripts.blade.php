<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeConclusionModal', () => {
        $('#conclusionModal').modal('hide');
    });

    window.livewire.on('openConclusionModal', () => {
        $('#conclusionModal').modal('show');
    });
</script>

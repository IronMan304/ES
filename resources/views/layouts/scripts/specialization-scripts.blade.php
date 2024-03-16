<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeSpecializationModal', () => {
        $('#specializationModal').modal('hide');
    });

    window.livewire.on('openSpecializationModal', () => {
        $('#specializationModal').modal('show');
    });
</script>
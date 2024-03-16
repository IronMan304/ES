<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeEnrollmentModal', () => {
        $('#enrollmentModal').modal('hide');
    });

    window.livewire.on('openEnrollmentModal', () => {
        $('#enrollmentModal').modal('show');
    });
</script>
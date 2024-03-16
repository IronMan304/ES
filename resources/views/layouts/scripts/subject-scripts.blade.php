<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeSubjectModal', () => {
        $('#subjectModal').modal('hide');
    });

    window.livewire.on('openSubjectModal', () => {
        $('#subjectModal').modal('show');
    });
</script>
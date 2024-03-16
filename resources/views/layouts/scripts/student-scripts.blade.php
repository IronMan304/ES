<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeStudentModal', () => {
        $('#studentModal').modal('hide');
    });

    window.livewire.on('openStudentModal', () => {
        $('#studentModal').modal('show');
    });
    window.livewire.on('closeStudentAccountModal', () => {
        $('#studentAccountModal').modal('hide');
    });

    window.livewire.on('openStudentAccountModal', () => {
        $('#studentAccountModal').modal('show');
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeTeacherModal', () => {
        $('#teacherModal').modal('hide');
    });

    window.livewire.on('openTeacherModal', () => {
        $('#teacherModal').modal('show');
    });

    window.livewire.on('closeTeacherAccountModal', () => {
        $('#teacherAccountModal').modal('hide');
    });

    window.livewire.on('openTeacherAccountModal', () => {
        $('#teacherAccountModal').modal('show');
    });
</script>
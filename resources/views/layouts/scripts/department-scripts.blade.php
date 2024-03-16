<script>
  document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.processed', (component) => {
      setTimeout(function() {
        $('#alert').fadeOut('fast');
      }, 5000);
    });
  });

  window.livewire.on('closeDepartmentModal', () => {
    $('#departmentModal').modal('hide');
  });

  window.livewire.on('openDepartmentModal', () => {
    $('#departmentModal').modal('show');
  });
</script>
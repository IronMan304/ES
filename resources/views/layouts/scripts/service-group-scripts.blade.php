<script>
  document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.processed', (component) => {
      setTimeout(function() {
        $('#alert').fadeOut('fast');
      }, 5000);
    });
  });

  window.livewire.on('closeServiceGroupModal', () => {
    $('#serviceGroupModal').modal('hide');
  });

  window.livewire.on('openServiceGroupModal', () => {
    $('#serviceGroupModal').modal('show');
  });
</script>
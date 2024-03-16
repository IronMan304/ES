<script>
  document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.processed', (component) => {
      setTimeout(function() {
        $('#alert').fadeOut('fast');
      }, 5000);
    });
  });

  window.livewire.on('closeEkonsultaModal', () => {
    $('#ekonsultaModal').modal('hide');
  });

  window.livewire.on('openEkonsultaModal', () => {
    $('#ekonsultaModal').modal('show');
  });

  window.livewire.on('openEkonsultaViewModal', () => {
    $('#ekonsultaviewModal').modal('show');
  });

</script>
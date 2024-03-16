<script>
    document.addEventListener("DOMContentLoaded", () => {
      Livewire.hook('message.processed', (component) => {
        setTimeout(function() {
          $('#alert').fadeOut('fast');
        }, 5000);
      });
    });

    window.livewire.on('closeDiscountModal', () => {
      $('#discountModal').modal('hide');
    });

    window.livewire.on('openDiscountModal', () => {
      $('#discountModal').modal('show');
    });
  </script>

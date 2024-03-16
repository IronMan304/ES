<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeBookingModal', () => {
        $('#bookingModal').modal('hide');
    });

    window.livewire.on('openBookingModal', () => {
        $('#bookingModal').modal('show');
    });

    window.livewire.on('closeBookingViewModal', () => {
        $('#bookingViewModal').modal('hide');
    });

    window.livewire.on('openBookingViewModal', () => {
        $('#bookingViewModal').modal('show');
    });

    window.livewire.on('closeBookingLogsModal', () => {
        $('#bookingLogsModal').modal('hide');
    });

    window.livewire.on('openBookingLogsModal', () => {
        $('#bookingLogsModal').modal('show');
    });

    window.livewire.on('closeExaminationModal', () => {
        $('#examinationModal').modal('hide');
    });

    window.livewire.on('openExaminationModal', () => {
        $('#examinationModal').modal('show');
    });

    window.livewire.on('closeBookingReportModal', () => {
        $('#bookingReportModal').modal('hide');
    });

    window.livewire.on('openBookingReportModal', () => {
        $('#bookingReportModal').modal('show');
    });

    window.livewire.on('closePatientSignatureModal', () => {
        $('#patientSignatureModal').modal('hide');
    });

    window.livewire.on('openPatientSignatureModal', () => {
        $('#patientSignatureModal').modal('show');
    });

    // cancellation confirm modal
    window.livewire.on('closeCancelConfirmationModal', () => {
        $('#cancelConfirmationModal').modal('hide');
    });

    window.livewire.on('openCancelConfirmationModal', () => {
        $('#cancelConfirmationModal').modal('show');
    });
</script>

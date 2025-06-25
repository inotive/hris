<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize modal
    const payslipModal = document.getElementById('payslipModal');
    const modal = new bootstrap.Modal(payslipModal);
    
    // View payslip handler
    document.querySelectorAll('.view-payslip').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            
            // Show loading state
            const payslipContent = document.getElementById('payslipContent');
            payslipContent.innerHTML = `
                <div class="text-center py-5 modal-payslip-loading">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`;
            
            // Show modal
            modal.show();
            
            // Create and append iframe
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.frameBorder = "0";
            iframe.style.width = "100%";
            iframe.style.height = (window.innerHeight * 0.7) + 'px';
            iframe.style.border = 'none';
            iframe.style.visibility = 'hidden';
            
            // Clear previous content and append iframe
       
            payslipContent.appendChild(iframe);
            
            // Wait for iframe to load
            iframe.onload = function() {
                iframe.style.visibility = 'visible';

                // Remove loading state
                const loading = document.querySelector('.modal-payslip-loading');
                if (loading) {
                    loading.remove();
                }
            };
        });
    });
    
    // Print payslip handler
    document.querySelectorAll('.print-payslip').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            
            if (url) {
                const printWindow = window.open(url, '_blank');
                if (!printWindow) {
                    alert('Popup was blocked. Please allow popups for this site.');
                }
            }
        });
    });
    
    // Clear modal content when hidden
    payslipModal.addEventListener('hidden.bs.modal', function () {
        document.getElementById('payslipContent').innerHTML = '';
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="payslipModalLabel">Payslip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="payslipContent">
                <div class="text-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
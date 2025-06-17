<script>


document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('payslipModal'));
    
    document.querySelectorAll('.view-payslip').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            
            // Show loading state
            document.getElementById('payslipContent').innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`;
            
            // Show modal
            modal.show();
            
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.frameBorder = "0";
            iframe.width = "100%";
            iframe.height = window.innerHeight * 0.8;
            document.getElementById('payslipContent').innerHTML = '';
            document.getElementById('payslipContent').appendChild(iframe);
        });
    });
    
    // Clear modal content when hidden
    document.getElementById('payslipModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('payslipContent').innerHTML = '';
    });
});

</script>


<!-- Modal -->
<div class="modal fade" id="payslipModal" tabindex="-1" role="dialog" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payslipModalLabel">Payslip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="payslipContent">
                <!-- Payslip content will be loaded here -->
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
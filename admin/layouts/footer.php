  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="../index.php" target="_blank">Sarkari Result</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0 | Built with <i class="fas fa-heart text-danger"></i> for job seekers
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Customize Admin Panel</h5>
      <hr class="mb-2">
      <div class="mb-4">
        <input type="checkbox" value="1" checked="checked" class="mr-1">
        <span>Dark Mode</span>
      </div>
      <div class="mb-1">
        <input type="checkbox" value="1" checked="checked" class="mr-1">
        <span>Fixed Layout</span>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Summernote -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<!-- Custom Admin Scripts -->
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('.data-table').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 25,
        "language": {
            "search": "Search:",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        }
    });

    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Initialize Summernote
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    // Confirm delete actions
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const title = $(this).data('title') || 'this item';
        
        if (confirm(`Are you sure you want to delete ${title}? This action cannot be undone.`)) {
            window.location.href = url;
        }
    });

    // Auto-submit status change forms
    $('.status-select').change(function() {
        $(this).closest('form').submit();
    });

    // Toast notifications
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Form validation
    $('.needs-validation').submit(function(e) {
        const form = this;
        if (form.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
        }
        $(form).addClass('was-validated');
    });

    // Sidebar search
    $('[data-widget="sidebar-search"]').SidebarSearch();

    // Update notification counts every 30 seconds
    setInterval(function() {
        updateNotificationCounts();
    }, 30000);

    // Character counter for textareas
    $('.char-counter').each(function() {
        const maxLength = $(this).attr('maxlength');
        const currentLength = $(this).val().length;
        $(this).after(`<small class="text-muted float-right char-count">${currentLength}/${maxLength}</small>`);
    });

    $('.char-counter').on('input', function() {
        const maxLength = $(this).attr('maxlength');
        const currentLength = $(this).val().length;
        $(this).next('.char-count').text(`${currentLength}/${maxLength}`);
    });
});

// Function to update notification counts
function updateNotificationCounts() {
    $.get('api/notification-counts.php', function(data) {
        if (data.messages) {
            $('#message-count, #sidebar-message-count').text(data.messages);
        }
        if (data.notifications) {
            $('#notification-count').text(data.notifications);
        }
    }).fail(function() {
        console.log('Failed to update notification counts');
    });
}

// Show loading overlay
function showLoading() {
    $('body').append('<div class="loading-overlay"><div class="loading-spinner"><i class="fas fa-spinner fa-spin fa-3x"></i></div></div>');
}

// Hide loading overlay
function hideLoading() {
    $('.loading-overlay').remove();
}

// Bulk actions
function handleBulkAction(action, selectedIds) {
    if (selectedIds.length === 0) {
        alert('Please select at least one item.');
        return false;
    }
    
    const confirmMsg = action === 'delete' ? 
        'Are you sure you want to delete the selected items?' : 
        `Are you sure you want to ${action} the selected items?`;
    
    if (confirm(confirmMsg)) {
        showLoading();
        return true;
    }
    
    return false;
}

// Initialize tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<?php if (isset($additional_js)) echo $additional_js; ?>

<style>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loading-spinner {
    color: #fff;
}

.char-count {
    display: block;
    margin-top: 5px;
}

.sidebar-search-results .list-group-item {
    border: none;
    border-bottom: 1px solid #dee2e6;
}
</style>

</body>
</html>

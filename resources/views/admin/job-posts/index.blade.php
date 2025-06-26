@extends('adminlte::page')

@section('title', 'Job Posts - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Job Posts</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.job-posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Job Post
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Job Posts</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <select class="form-control" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="jobPostsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Organization</th>
                        <th>Posts</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Views</th>
                        <th>Last Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobPosts as $jobPost)
                    <tr>
                        <td>{{ $jobPost->id }}</td>
                        <td>
                            <strong>{{ Str::limit($jobPost->title, 50) }}</strong>
                            <br><small class="text-muted">{{ $jobPost->slug }}</small>
                        </td>
                        <td>{{ $jobPost->category->name }}</td>
                        <td>{{ $jobPost->organization }}</td>
                        <td>{{ $jobPost->total_posts ? number_format($jobPost->total_posts) : '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $jobPost->status === 'active' ? 'success' : ($jobPost->status === 'inactive' ? 'warning' : 'danger') }}">
                                {{ ucfirst($jobPost->status) }}
                            </span>
                        </td>
                        <td>
                            @if($jobPost->is_featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>{{ number_format($jobPost->views) }}</td>
                        <td>
                            @if($jobPost->end_date)
                                <span class="text-{{ $jobPost->end_date->isPast() ? 'danger' : 'success' }}">
                                    {{ $jobPost->end_date->format('M d, Y') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.job-posts.show', $jobPost) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.job-posts.edit', $jobPost) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm delete-job-post" 
                                        data-id="{{ $jobPost->id }}" data-title="{{ $jobPost->title }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{ route('jobs.show', $jobPost->slug) }}" target="_blank" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the job post "<span id="jobPostTitle"></span>"?</p>
                    <p><strong>Note:</strong> This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Configure toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            // Initialize DataTable
            let table = $('#jobPostsTable').DataTable({
                responsive: true,
                order: [[ 0, "desc" ]], // Sort by ID descending
                columnDefs: [
                    { orderable: false, targets: [9] } // Disable sorting on Actions column
                ]
            });

            // Category filter
            $('#categoryFilter').on('change', function() {
                let categoryId = $(this).val();
                if (categoryId) {
                    table.column(2).search('^' + $('#categoryFilter option:selected').text() + '$', true, false).draw();
                } else {
                    table.column(2).search('').draw();
                }
            });

            let currentJobPostId = null;

            // Delete job post
            $('.delete-job-post').on('click', function() {
                currentJobPostId = $(this).data('id');
                let jobPostTitle = $(this).data('title');
                $('#jobPostTitle').text(jobPostTitle);
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (!currentJobPostId) return;
                
                let btn = $(this);
                let originalText = btn.html();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                
                $.ajax({
                    url: '{{ route("admin.job-posts.index") }}/' + currentJobPostId,
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        toastr.success('Job post deleted successfully!');
                        
                        // Remove the row from DataTable
                        let row = $('[data-id="' + currentJobPostId + '"]').closest('tr');
                        table.row(row).remove().draw();
                        
                        currentJobPostId = null;
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        toastr.error('An error occurred while deleting the job post.');
                        currentJobPostId = null;
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Show success message if redirected from create/edit
            @if(session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@stop

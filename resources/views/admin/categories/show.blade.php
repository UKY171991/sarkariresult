@extends('adminlte::page')

@section('title', 'View Category - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Category Details</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Category
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $category->name }}</h3>
                    <div class="card-tools">
                        <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9">{{ $category->name }}</dd>
                        
                        <dt class="col-sm-3">Slug:</dt>
                        <dd class="col-sm-9">{{ $category->slug }}</dd>
                        
                        <dt class="col-sm-3">Description:</dt>
                        <dd class="col-sm-9">{{ $category->description ?: 'No description provided' }}</dd>
                        
                        <dt class="col-sm-3">Icon:</dt>
                        <dd class="col-sm-9">
                            @if($category->icon)
                                <i class="{{ $category->icon }}"></i> {{ $category->icon }}
                            @else
                                No icon set
                            @endif
                        </dd>
                        
                        <dt class="col-sm-3">Sort Order:</dt>
                        <dd class="col-sm-9">{{ $category->sort_order }}</dd>
                        
                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                        
                        <dt class="col-sm-3">Job Posts:</dt>
                        <dd class="col-sm-9">{{ $category->jobPosts->count() }} jobs</dd>
                        
                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $category->created_at->format('M d, Y at h:i A') }}</dd>
                        
                        <dt class="col-sm-3">Updated:</dt>
                        <dd class="col-sm-9">{{ $category->updated_at->format('M d, Y at h:i A') }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger" id="deleteCategoryBtn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    <a href="{{ route('jobs.category', $category->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt"></i> View on Frontend
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Related Job Posts</h3>
                </div>
                <div class="card-body">
                    @if($category->jobPosts->count() > 0)
                        <div class="list-group">
                            @foreach($category->jobPosts->take(5) as $job)
                            <a href="{{ route('admin.job-posts.show', $job) }}" class="list-group-item list-group-item-action">
                                <h6 class="mb-1">{{ Str::limit($job->title, 50) }}</h6>
                                <small class="text-muted">{{ $job->organization }}</small>
                            </a>
                            @endforeach
                        </div>
                        @if($category->jobPosts->count() > 5)
                        <div class="mt-3">
                            <a href="{{ route('admin.job-posts.index') }}?category={{ $category->id }}" class="btn btn-sm btn-outline-primary">
                                View All ({{ $category->jobPosts->count() }} jobs)
                            </a>
                        </div>
                        @endif
                    @else
                        <p class="text-muted">No job posts in this category yet.</p>
                        <a href="{{ route('admin.job-posts.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create Job Post
                        </a>
                    @endif
                </div>
            </div>
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
                    <p>Are you sure you want to delete this category?</p>
                    <p><strong>Note:</strong> This will also delete all associated job posts.</p>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
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

            // Delete category
            $('#deleteCategoryBtn').on('click', function() {
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                let btn = $(this);
                let originalText = btn.html();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                
                $.ajax({
                    url: '{{ route("admin.categories.destroy", $category) }}',
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('Category deleted successfully!');
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.categories.index") }}';
                        }, 1500);
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while deleting the category.');
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@stop

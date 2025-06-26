@extends('adminlte::page')

@section('title', 'View Job Post - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Job Post Details</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.job-posts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Job Posts
            </a>
            <a href="{{ route('admin.job-posts.edit', $jobPost) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('jobs.show', $jobPost->slug) }}" target="_blank" class="btn btn-info">
                <i class="fas fa-external-link-alt"></i> View Frontend
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $jobPost->title }}</h3>
                    <div class="card-tools">
                        <span class="badge badge-{{ $jobPost->status === 'active' ? 'success' : ($jobPost->status === 'inactive' ? 'warning' : 'danger') }}">
                            {{ ucfirst($jobPost->status) }}
                        </span>
                        @if($jobPost->is_featured)
                            <span class="badge badge-warning">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Category:</strong></div>
                        <div class="col-sm-9">{{ $jobPost->category->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Organization:</strong></div>
                        <div class="col-sm-9">{{ $jobPost->organization }}</div>
                    </div>

                    @if($jobPost->short_description)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Short Description:</strong></div>
                        <div class="col-sm-9">{{ $jobPost->short_description }}</div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Description:</strong></div>
                        <div class="col-sm-9">
                            <div class="content-description">
                                {!! nl2br(e($jobPost->description)) !!}
                            </div>
                        </div>
                    </div>

                    @if($jobPost->total_posts)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Total Posts:</strong></div>
                        <div class="col-sm-9">{{ number_format($jobPost->total_posts) }}</div>
                    </div>
                    @endif

                    @if($jobPost->location)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Location:</strong></div>
                        <div class="col-sm-9">{{ $jobPost->location }}</div>
                    </div>
                    @endif

                    @if($jobPost->application_fee)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Application Fee:</strong></div>
                        <div class="col-sm-9">₹{{ number_format($jobPost->application_fee, 2) }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Important Dates -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Important Dates</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($jobPost->start_date)
                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-calendar-plus"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Start Date</span>
                                    <span class="info-box-number">{{ $jobPost->start_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($jobPost->end_date)
                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-{{ $jobPost->end_date->isPast() ? 'danger' : 'success' }}">
                                    <i class="fas fa-calendar-times"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">End Date</span>
                                    <span class="info-box-number">{{ $jobPost->end_date->format('M d, Y') }}</span>
                                    @if($jobPost->end_date->isPast())
                                        <span class="badge badge-danger">Expired</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($jobPost->exam_date)
                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-calendar-check"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Exam Date</span>
                                    <span class="info-box-number">{{ $jobPost->exam_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Links -->
            @if($jobPost->official_website || $jobPost->notification_pdf || $jobPost->application_link)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Important Links</h3>
                </div>
                <div class="card-body">
                    @if($jobPost->official_website)
                    <div class="mb-2">
                        <strong>Official Website:</strong>
                        <a href="{{ $jobPost->official_website }}" target="_blank" class="ml-2">
                            {{ $jobPost->official_website }} <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    @endif

                    @if($jobPost->notification_pdf)
                    <div class="mb-2">
                        <strong>Notification PDF:</strong>
                        <a href="{{ $jobPost->notification_pdf }}" target="_blank" class="ml-2">
                            View PDF <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    @endif

                    @if($jobPost->application_link)
                    <div class="mb-2">
                        <strong>Application Link:</strong>
                        <a href="{{ $jobPost->application_link }}" target="_blank" class="ml-2">
                            Apply Online <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <!-- Statistics -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistics</h3>
                </div>
                <div class="card-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary">
                            <i class="fas fa-eye"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Views</span>
                            <span class="info-box-number">{{ number_format($jobPost->views) }}</span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-secondary">
                            <i class="fas fa-calendar-plus"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Created</span>
                            <span class="info-box-number">{{ $jobPost->created_at->format('M d, Y') }}</span>
                            <small class="text-muted">{{ $jobPost->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-calendar-edit"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Updated</span>
                            <span class="info-box-number">{{ $jobPost->updated_at->format('M d, Y') }}</span>
                            <small class="text-muted">{{ $jobPost->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Details -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Details</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Slug:</dt>
                        <dd class="col-sm-8"><code>{{ $jobPost->slug }}</code></dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-{{ $jobPost->status === 'active' ? 'success' : ($jobPost->status === 'inactive' ? 'warning' : 'danger') }}">
                                {{ ucfirst($jobPost->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Featured:</dt>
                        <dd class="col-sm-8">
                            @if($jobPost->is_featured)
                                <i class="fas fa-star text-warning"></i> Yes
                            @else
                                <i class="far fa-star text-muted"></i> No
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                </div>
                <div class="card-body">
                    <div class="btn-group-vertical w-100">
                        <a href="{{ route('admin.job-posts.edit', $jobPost) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Job Post
                        </a>
                        <a href="{{ route('jobs.show', $jobPost->slug) }}" target="_blank" class="btn btn-info">
                            <i class="fas fa-external-link-alt"></i> View on Frontend
                        </a>
                        <button type="button" class="btn btn-danger delete-job-post" 
                                data-id="{{ $jobPost->id }}" data-title="{{ $jobPost->title }}">
                            <i class="fas fa-trash"></i> Delete Job Post
                        </button>
                    </div>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .content-description {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
    </style>
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
                        
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.job-posts.index") }}';
                        }, 1500);
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
        });
    </script>
@stop

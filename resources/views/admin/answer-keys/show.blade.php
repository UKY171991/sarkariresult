@extends('adminlte::page')

@section('title', 'View Answer Key - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Answer Key Details</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.answer-keys.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Answer Keys
            </a>
            <a href="{{ route('admin.answer-keys.edit', $answerKey) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-info">
                <i class="fas fa-download"></i> Download
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $answerKey->title }}</h3>
                    <div class="card-tools">
                        <span class="badge badge-{{ $answerKey->status === 'active' ? 'success' : 'warning' }}">
                            {{ ucfirst($answerKey->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Job Post:</strong></div>
                        <div class="col-sm-9">
                            <a href="{{ route('admin.job-posts.show', $answerKey->jobPost) }}">
                                {{ $answerKey->jobPost->title }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Organization:</strong></div>
                        <div class="col-sm-9">{{ $answerKey->organization }}</div>
                    </div>

                    @if($answerKey->description)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Description:</strong></div>
                        <div class="col-sm-9">
                            <div class="content-description">
                                {!! nl2br(e($answerKey->description)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($answerKey->exam_date)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Exam Date:</strong></div>
                        <div class="col-sm-9">{{ $answerKey->exam_date->format('M d, Y') }}</div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Download Link:</strong></div>
                        <div class="col-sm-9">
                            <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-download"></i> Download Answer Key
                            </a>
                        </div>
                    </div>

                    @if($answerKey->official_website)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Official Website:</strong></div>
                        <div class="col-sm-9">
                            <a href="{{ $answerKey->official_website }}" target="_blank">
                                {{ $answerKey->official_website }} <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($answerKey->instructions)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Instructions:</strong></div>
                        <div class="col-sm-9">
                            <div class="content-description">
                                {!! nl2br(e($answerKey->instructions)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
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
                            <i class="fas fa-download"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Downloads</span>
                            <span class="info-box-number">{{ number_format($answerKey->downloads) }}</span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-secondary">
                            <i class="fas fa-calendar-plus"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Created</span>
                            <span class="info-box-number">{{ $answerKey->created_at->format('M d, Y') }}</span>
                            <small class="text-muted">{{ $answerKey->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-calendar-edit"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Updated</span>
                            <span class="info-box-number">{{ $answerKey->updated_at->format('M d, Y') }}</span>
                            <small class="text-muted">{{ $answerKey->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answer Key Details -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Answer Key Details</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Slug:</dt>
                        <dd class="col-sm-8"><code>{{ $answerKey->slug }}</code></dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-{{ $answerKey->status === 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($answerKey->status) }}
                            </span>
                        </dd>

                        @if($answerKey->exam_date)
                        <dt class="col-sm-4">Exam Date:</dt>
                        <dd class="col-sm-8">{{ $answerKey->exam_date->format('M d, Y') }}</dd>
                        @endif
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
                        <a href="{{ route('admin.answer-keys.edit', $answerKey) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Answer Key
                        </a>
                        <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-info">
                            <i class="fas fa-download"></i> Download Answer Key
                        </a>
                        @if($answerKey->official_website)
                        <a href="{{ $answerKey->official_website }}" target="_blank" class="btn btn-secondary">
                            <i class="fas fa-external-link-alt"></i> Official Website
                        </a>
                        @endif
                        <button type="button" class="btn btn-danger delete-answer-key" 
                                data-id="{{ $answerKey->id }}" data-title="{{ $answerKey->title }}">
                            <i class="fas fa-trash"></i> Delete Answer Key
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
                    <p>Are you sure you want to delete the answer key "<span id="answerKeyTitle"></span>"?</p>
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

            let currentAnswerKeyId = null;

            // Delete answer key
            $('.delete-answer-key').on('click', function() {
                currentAnswerKeyId = $(this).data('id');
                let answerKeyTitle = $(this).data('title');
                $('#answerKeyTitle').text(answerKeyTitle);
                $('#deleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (!currentAnswerKeyId) return;
                
                let btn = $(this);
                let originalText = btn.html();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                
                $.ajax({
                    url: '{{ route("admin.answer-keys.index") }}/' + currentAnswerKeyId,
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        toastr.success('Answer key deleted successfully!');
                        
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.answer-keys.index") }}';
                        }, 1500);
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        toastr.error('An error occurred while deleting the answer key.');
                        currentAnswerKeyId = null;
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@stop

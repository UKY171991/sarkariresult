@extends('adminlte::page')

@section('title', 'Edit Answer Key - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Edit Answer Key</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.answer-keys.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Answer Keys
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Answer Key Information</h3>
        </div>
        
        <form id="editAnswerKeyForm" action="{{ route('admin.answer-keys.update', $answerKey) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="job_post_id">Job Post <span class="text-danger">*</span></label>
                            <select class="form-control @error('job_post_id') is-invalid @enderror" id="job_post_id" name="job_post_id" required>
                                <option value="">Select Job Post</option>
                                @foreach($jobPosts as $jobPost)
                                    <option value="{{ $jobPost->id }}" {{ old('job_post_id', $answerKey->job_post_id) == $jobPost->id ? 'selected' : '' }}>
                                        {{ $jobPost->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_post_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', $answerKey->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $answerKey->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Answer Key Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
                           value="{{ old('title', $answerKey->title) }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="organization">Organization <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('organization') is-invalid @enderror" id="organization" name="organization" 
                           value="{{ old('organization', $answerKey->organization) }}" required>
                    @error('organization')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" 
                              rows="4">{{ old('description', $answerKey->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exam_date">Exam Date</label>
                            <input type="date" class="form-control @error('exam_date') is-invalid @enderror" id="exam_date" name="exam_date" 
                                   value="{{ old('exam_date', $answerKey->exam_date?->format('Y-m-d')) }}">
                            @error('exam_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="download_link">Download Link <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('download_link') is-invalid @enderror" id="download_link" name="download_link" 
                                   value="{{ old('download_link', $answerKey->download_link) }}" required>
                            @error('download_link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="official_website">Official Website</label>
                    <input type="url" class="form-control @error('official_website') is-invalid @enderror" id="official_website" name="official_website" 
                           value="{{ old('official_website', $answerKey->official_website) }}">
                    @error('official_website')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instructions">Instructions</label>
                    <textarea class="form-control @error('instructions') is-invalid @enderror" id="instructions" name="instructions" 
                              rows="4">{{ old('instructions', $answerKey->instructions) }}</textarea>
                    <small class="form-text text-muted">Important instructions for candidates downloading the answer key.</small>
                    @error('instructions')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Update Answer Key
                </button>
                <a href="{{ route('admin.answer-keys.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            // Configure toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            // Initialize TinyMCE for description and instructions
            tinymce.init({
                selector: '#description, #instructions',
                height: 200,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                branding: false,
                promotion: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });

            // AJAX form submission
            $('#editAnswerKeyForm').on('submit', function(e) {
                e.preventDefault();
                
                let form = $(this);
                let btn = $('#submitBtn');
                let originalText = btn.html();
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').hide();
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
                
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success('Answer key updated successfully!');
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.answer-keys.index") }}';
                        }, 1500);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback').remove();
                                input.after('<span class="invalid-feedback">' + messages[0] + '</span>');
                            });
                            toastr.error('Please fix the validation errors.');
                        } else {
                            toastr.error('An error occurred while updating the answer key.');
                        }
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@stop

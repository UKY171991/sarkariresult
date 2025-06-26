@extends('adminlte::page')

@section('title', 'Create Job Post - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Create New Job Post</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.job-posts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Job Posts
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job Post Information</h3>
        </div>
        
        <form id="createJobPostForm" action="{{ route('admin.job-posts.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="expired" {{ old('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Job Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="organization">Organization <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('organization') is-invalid @enderror" 
                           id="organization" name="organization" value="{{ old('organization') }}" required>
                    @error('organization')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" 
                              id="short_description" name="short_description" rows="2" maxlength="500">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Maximum 500 characters</small>
                </div>

                <div class="form-group">
                    <label for="description">Job Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="8" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_posts">Total Posts</label>
                            <input type="number" class="form-control @error('total_posts') is-invalid @enderror" 
                                   id="total_posts" name="total_posts" value="{{ old('total_posts') }}" min="1">
                            @error('total_posts')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location') }}">
                            @error('location')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="application_fee">Application Fee (₹)</label>
                            <input type="number" step="0.01" class="form-control @error('application_fee') is-invalid @enderror" 
                                   id="application_fee" name="application_fee" value="{{ old('application_fee') }}" min="0">
                            @error('application_fee')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Application Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" value="{{ old('start_date') }}">
                            @error('start_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">Application End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" value="{{ old('end_date') }}">
                            @error('end_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exam_date">Exam Date</label>
                            <input type="date" class="form-control @error('exam_date') is-invalid @enderror" 
                                   id="exam_date" name="exam_date" value="{{ old('exam_date') }}">
                            @error('exam_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="official_website">Official Website</label>
                            <input type="url" class="form-control @error('official_website') is-invalid @enderror" 
                                   id="official_website" name="official_website" value="{{ old('official_website') }}">
                            @error('official_website')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="application_link">Application Link</label>
                            <input type="url" class="form-control @error('application_link') is-invalid @enderror" 
                                   id="application_link" name="application_link" value="{{ old('application_link') }}">
                            @error('application_link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notification_pdf">Notification PDF Link</label>
                    <input type="url" class="form-control @error('notification_pdf') is-invalid @enderror" 
                           id="notification_pdf" name="notification_pdf" value="{{ old('notification_pdf') }}">
                    @error('notification_pdf')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" 
                               {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured Job Post
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="createJobPostBtn">
                    <i class="fas fa-save"></i> Create Job Post
                </button>
                <a href="{{ route('admin.job-posts.index') }}" class="btn btn-secondary">
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

            // Initialize TinyMCE
            tinymce.init({
                selector: '#description',
                height: 300,
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
                placeholder: 'Enter job description here...',
                branding: false,
                promotion: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });

            // AJAX form submission
            $('#createJobPostForm').on('submit', function(e) {
                e.preventDefault();
                
                let form = $(this);
                let submitBtn = $('#createJobPostBtn');
                let originalText = submitBtn.html();
                
                // Disable submit button and show loading
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('Job post created successfully!');
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.job-posts.index") }}';
                        }, 1500);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.after('<span class="invalid-feedback">' + messages[0] + '</span>');
                            });
                            toastr.error('Please fix the validation errors.');
                        } else {
                            toastr.error('An error occurred while creating the job post.');
                        }
                    },
                    complete: function() {
                        // Re-enable submit button
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@stop

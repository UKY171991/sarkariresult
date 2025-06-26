@extends('adminlte::page')

@section('title', 'Create Category - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Create New Category</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Information</h3>
        </div>
        
        <form id="createCategoryForm" action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="icon">Icon (Font Awesome class)</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" name="icon" value="{{ old('icon') }}" 
                                   placeholder="e.g., fas fa-briefcase">
                            @error('icon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">
                                Use Font Awesome icon classes. Example: fas fa-briefcase
                            </small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="createCategoryBtn">
                    <i class="fas fa-save"></i> Create Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
    <script>
        $(document).ready(function() {
            // Configure toastr
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            // AJAX form submission
            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();
                
                let form = $(this);
                let submitBtn = $('#createCategoryBtn');
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
                        toastr.success('Category created successfully!');
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.categories.index") }}';
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
                            toastr.error('An error occurred while creating the category.');
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

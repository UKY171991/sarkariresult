@extends('adminlte::page')

@section('title', 'Edit Profile - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Edit Profile</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Profile Information</h3>
        </div>
        
        <form id="editProfileForm" action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" 
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Account Information</h5>
                        <p>Your account was created on <strong>{{ $user->created_at->format('F d, Y') }}</strong> and last updated <strong>{{ $user->updated_at->diffForHumans() }}</strong>.</p>
                        @if($user->email_verified_at)
                            <p>Your email address was verified on <strong>{{ $user->email_verified_at->format('F d, Y') }}</strong>.</p>
                        @else
                            <p class="text-warning">Your email address is not yet verified.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Update Profile
                </button>
                <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <a href="{{ route('admin.profile.password') }}" class="btn btn-warning">
                    <i class="fas fa-key"></i> Change Password
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
            $('#editProfileForm').on('submit', function(e) {
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
                        toastr.success('Profile updated successfully!');
                        setTimeout(function() {
                            window.location.href = '{{ route("admin.profile.show") }}';
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
                            toastr.error('An error occurred while updating your profile.');
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

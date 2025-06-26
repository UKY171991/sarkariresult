@extends('adminlte::page')

@section('title', 'Change Password - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Change Password</h1>
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
            <h3 class="card-title">Change Your Password</h3>
        </div>
        
        <form id="changePasswordForm" action="{{ route('admin.profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="current_password">Current Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                           id="current_password" name="current_password" required>
                    @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    <small class="form-text text-muted">
                        Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.
                    </small>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="callout callout-warning">
                    <h5><i class="fas fa-exclamation-triangle"></i> Security Notice</h5>
                    <p>Changing your password will:</p>
                    <ul>
                        <li>Log you out of all other devices</li>
                        <li>Require you to log in again with your new password</li>
                        <li>Invalidate any remember me tokens</li>
                    </ul>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-warning" id="submitBtn">
                    <i class="fas fa-key"></i> Change Password
                </button>
                <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">
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
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();
                
                let form = $(this);
                let btn = $('#submitBtn');
                let originalText = btn.html();
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').hide();
                
                // Check if passwords match
                let password = $('#password').val();
                let passwordConfirmation = $('#password_confirmation').val();
                
                if (password !== passwordConfirmation) {
                    $('#password_confirmation').addClass('is-invalid');
                    $('#password_confirmation').after('<span class="invalid-feedback">The password confirmation does not match.</span>');
                    toastr.error('Password confirmation does not match.');
                    return;
                }
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Changing Password...');
                
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success('Password changed successfully! You will be redirected to login.');
                        setTimeout(function() {
                            window.location.href = '{{ route("login") }}';
                        }, 2000);
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
                            toastr.error('An error occurred while changing your password.');
                        }
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Password strength indicator
            $('#password').on('input', function() {
                let password = $(this).val();
                let strength = 0;
                
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/)) strength++;
                if (password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;
                
                let strengthText = '';
                let strengthClass = '';
                
                switch(strength) {
                    case 0:
                    case 1:
                        strengthText = 'Very Weak';
                        strengthClass = 'text-danger';
                        break;
                    case 2:
                        strengthText = 'Weak';
                        strengthClass = 'text-warning';
                        break;
                    case 3:
                        strengthText = 'Medium';
                        strengthClass = 'text-info';
                        break;
                    case 4:
                        strengthText = 'Strong';
                        strengthClass = 'text-success';
                        break;
                    case 5:
                        strengthText = 'Very Strong';
                        strengthClass = 'text-success';
                        break;
                }
                
                // Remove existing strength indicator
                $('.password-strength').remove();
                
                if (password.length > 0) {
                    $('#password').after('<small class="form-text password-strength ' + strengthClass + '">Password Strength: ' + strengthText + '</small>');
                }
            });
        });
    </script>
@stop

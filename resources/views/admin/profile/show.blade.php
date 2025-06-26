@extends('adminlte::page')

@section('title', 'My Profile - Sarkari Result Admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>My Profile</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="{{ route('admin.profile.password') }}" class="btn btn-warning">
                <i class="fas fa-key"></i> Change Password
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

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <div class="profile-user-img-wrapper">
                            <div class="profile-user-img bg-primary d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; font-size: 2.5rem; color: white;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">Administrator</p>

                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ $user->email }}</p>
                    <hr>

                    <strong><i class="fas fa-calendar-plus mr-1"></i> Member Since</strong>
                    <p class="text-muted">{{ $user->created_at->format('F d, Y') }}</p>
                    <hr>

                    <strong><i class="fas fa-clock mr-1"></i> Last Updated</strong>
                    <p class="text-muted">{{ $user->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Full Name:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->name }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Email Address:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->email }}
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Email Verified:</strong>
                        </div>
                        <div class="col-sm-9">
                            @if($user->email_verified_at)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i> Verified on {{ $user->email_verified_at->format('M d, Y') }}
                                </span>
                            @else
                                <span class="badge badge-warning">
                                    <i class="fas fa-exclamation-triangle"></i> Not Verified
                                </span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Account Created:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->created_at->format('F d, Y \a\t g:i A') }}
                            <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->updated_at->format('F d, Y \a\t g:i A') }}
                            <small class="text-muted">({{ $user->updated_at->diffForHumans() }})</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="{{ route('admin.profile.password') }}" class="btn btn-warning">
                        <i class="fas fa-key"></i> Change Password
                    </a>
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

            // Show success message if available
            @if(session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@stop

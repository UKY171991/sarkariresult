@extends('adminlte::page')

@section('title', 'Dashboard - Sarkari Result Admin')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_categories'] }}</h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['total_jobs'] }}</h3>
                    <p>Total Job Posts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{ route('admin.job-posts.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['active_jobs'] }}</h3>
                    <p>Active Jobs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <a href="{{ route('admin.job-posts.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['total_admit_cards'] }}</h3>
                    <p>Admit Cards</p>
                </div>
                <div class="icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <a href="{{ route('admin.admit-cards.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{ $stats['total_answer_keys'] }}</h3>
                    <p>Answer Keys</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="{{ route('admin.answer-keys.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Stats</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <div class="knob-label">Total Content</div>
                            <h4>{{ $stats['total_jobs'] + $stats['total_admit_cards'] + $stats['total_answer_keys'] }}</h4>
                        </div>
                        <div class="col-6 text-center">
                            <div class="knob-label">Categories</div>
                            <h4>{{ $stats['total_categories'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <a href="{{ route('admin.job-posts.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Latest Job Posts</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestJobs as $job)
                            <tr>
                                <td>{{ Str::limit($job->title, 30) }}</td>
                                <td>{{ $job->category->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $job->status === 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td>{{ $job->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.job-posts.index') }}">View All Job Posts</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Stats</h3>
                </div>
                <div class="card-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-id-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Admit Cards</span>
                            <span class="info-box-number">{{ $stats['total_admit_cards'] }}</span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Answer Keys</span>
                            <span class="info-box-number">{{ $stats['total_answer_keys'] }}</span>
                        </div>
                    </div>

                    <div class="progress-group">
                        <div class="progress-text">Active vs Inactive Jobs</div>
                        <div class="float-right"><b>{{ $stats['active_jobs'] }}</b>/{{ $stats['total_jobs'] }}</div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ $stats['total_jobs'] > 0 ? ($stats['active_jobs'] / $stats['total_jobs']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

            console.log('Admin Dashboard loaded!');
            
            // Show welcome message
            toastr.info('Welcome to Sarkari Result Admin Panel!');
        });
    </script>
@stop

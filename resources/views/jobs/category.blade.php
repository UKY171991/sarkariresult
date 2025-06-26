@extends('layouts.frontend')

@section('title', $category->name . ' Jobs - Sarkari Result')
@section('description', $category->description)

@section('content')
<div class="container py-5">
    <!-- Category Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center p-5 bg-light rounded">
                @if($category->icon)
                <i class="{{ $category->icon }} fa-4x text-primary mb-3"></i>
                @endif
                <h1>{{ $category->name }}</h1>
                <p class="lead text-muted">{{ $category->description }}</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Jobs</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Job Listings -->
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Available Positions</h2>
                <div>
                    <span class="text-muted">{{ $jobs->total() }} jobs found</span>
                </div>
            </div>
            
            <div class="row">
                @forelse($jobs as $job)
                <div class="col-lg-6 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">{{ $job->category->name }}</span>
                                @if($job->is_featured)
                                    <span class="badge badge-new text-white">FEATURED</span>
                                @endif
                                @if($job->end_date && $job->end_date->isAfter(now()))
                                    <span class="badge bg-success">Active</span>
                                @elseif($job->end_date && $job->end_date->isPast())
                                    <span class="badge bg-danger">Expired</span>
                                @endif
                            </div>
                            
                            <h5 class="card-title">
                                <a href="{{ route('jobs.show', $job->slug) }}" class="text-decoration-none text-dark">
                                    {{ $job->title }}
                                </a>
                            </h5>
                            
                            <div class="mb-3">
                                <p class="text-muted mb-1">
                                    <i class="fas fa-building me-1"></i>{{ $job->organization }}
                                </p>
                                @if($job->location)
                                <p class="text-muted mb-1">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                                </p>
                                @endif
                                @if($job->total_posts)
                                <p class="text-muted mb-1">
                                    <i class="fas fa-users me-1"></i>{{ number_format($job->total_posts) }} Posts
                                </p>
                                @endif
                            </div>

                            @if($job->short_description)
                            <p class="text-muted mb-3">{{ Str::limit($job->short_description, 120) }}</p>
                            @endif

                            <!-- Important Dates -->
                            <div class="row mb-3">
                                @if($job->end_date)
                                <div class="col-6">
                                    <small class="text-muted d-block">Last Date</small>
                                    <strong class="text-{{ $job->end_date->isPast() ? 'danger' : 'success' }}">
                                        {{ $job->end_date->format('d M Y') }}
                                    </strong>
                                </div>
                                @endif
                                @if($job->exam_date)
                                <div class="col-6">
                                    <small class="text-muted d-block">Exam Date</small>
                                    <strong class="text-primary">{{ $job->exam_date->format('d M Y') }}</strong>
                                </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>{{ number_format($job->views) }} views
                                </small>
                                <div>
                                    @if($job->application_link && $job->end_date && $job->end_date->isFuture())
                                    <a href="{{ $job->application_link }}" target="_blank" class="btn btn-success btn-sm me-2">
                                        <i class="fas fa-external-link-alt me-1"></i>Apply
                                    </a>
                                    @endif
                                    <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-outline-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No jobs found in this category</h4>
                        <p class="text-muted">Check back later for new opportunities or browse other categories.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

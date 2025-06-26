@extends('layouts.frontend')

@section('title', 'Search Jobs - Sarkari Result')

@section('content')
<div class="container py-5">
    <!-- Search Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-search me-2"></i>Search Government Jobs
                    </h5>
                    
                    <form method="GET" action="{{ route('jobs.search') }}">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       name="q" 
                                       placeholder="Search by job title, organization, location..."
                                       value="{{ request('q') }}"
                                       required>
                            </div>
                            
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search me-2"></i>Search Jobs
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(request('q'))
    <!-- Search Results -->
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">
                    Search Results for "{{ request('q') }}"
                </h2>
                @if($jobs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <span class="text-muted">{{ $jobs->total() }} jobs found</span>
                @endif
            </div>
            
            @if($jobs instanceof \Illuminate\Pagination\LengthAwarePaginator && $jobs->count() > 0)
            <div class="row g-4">
                @foreach($jobs as $job)
                <div class="col-12">
                    <div class="card job-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary">{{ $job->category->name }}</span>
                                        @if($job->is_featured)
                                        <span class="badge badge-new text-white">FEATURED</span>
                                        @endif
                                    </div>
                                    
                                    <h5 class="card-title mb-2">
                                        <a href="{{ route('jobs.show', $job->slug) }}" class="text-decoration-none text-dark">
                                            {{ $job->title }}
                                        </a>
                                    </h5>
                                    
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-building me-1"></i>{{ $job->organization }}
                                    </p>
                                    
                                    @if($job->total_posts)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-users me-1"></i>{{ number_format($job->total_posts) }} Posts
                                    </p>
                                    @endif
                                    
                                    @if($job->location)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                                    </p>
                                    @endif
                                </div>
                                
                                <div class="col-md-4 text-md-end">
                                    @if($job->end_date)
                                    <p class="text-danger mb-2">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Last Date: {{ $job->end_date->format('d M Y') }}
                                    </p>
                                    @endif
                                    
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                        
                                        @if($job->application_link)
                                        <a href="{{ $job->application_link }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="fas fa-external-link-alt me-1"></i>Apply Now
                                        </a>
                                        @endif
                                    </div>
                                    
                                    <p class="text-muted small mt-2 mb-0">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($job->views) }} views
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $jobs->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No jobs found</h4>
                <p class="text-muted">Try searching with different keywords or check back later for new opportunities.</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Popular Categories</h5>
                </div>
                <div class="card-body">
                    @foreach($categories as $category)
                    <a href="{{ route('jobs.category', $category->slug) }}" 
                       class="d-block text-decoration-none mb-2 p-2 rounded border-start border-3 border-primary">
                        <i class="{{ $category->icon }} me-2"></i>{{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- No search query -->
    <div class="row">
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-4"></i>
                <h3 class="text-muted mb-3">Search Government Jobs</h3>
                <p class="text-muted mb-4">Enter keywords to find the perfect government job opportunity</p>
                
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Popular Search Categories</h5>
                                <div class="row g-2">
                                    @foreach($categories as $category)
                                    <div class="col-md-6">
                                        <a href="{{ route('jobs.category', $category->slug) }}" 
                                           class="btn btn-outline-primary w-100 mb-2">
                                            <i class="{{ $category->icon }} me-2"></i>{{ $category->name }}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

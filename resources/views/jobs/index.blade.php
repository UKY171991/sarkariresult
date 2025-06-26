@extends('layouts.frontend')

@section('title', 'Latest Government Jobs - Sarkari Result')

@section('content')
<div class="container py-5">
    <!-- Search and Filter Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-search me-2"></i>Search & Filter Jobs
                    </h5>
                    
                    <form method="GET" action="{{ route('jobs.index') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" 
                                       class="form-control" 
                                       name="search" 
                                       placeholder="Search by job title, organization, location..."
                                       value="{{ request('search') }}">
                            </div>
                            
                            <div class="col-md-2">
                                <select name="category_id" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <input type="text" 
                                       class="form-control" 
                                       name="location" 
                                       placeholder="Location"
                                       value="{{ request('location') }}">
                            </div>
                            
                            <div class="col-md-2">
                                <select name="posted_within" class="form-select">
                                    <option value="all">All Time</option>
                                    <option value="7" {{ request('posted_within') == '7' ? 'selected' : '' }}>Last 7 Days</option>
                                    <option value="30" {{ request('posted_within') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                                    <option value="90" {{ request('posted_within') == '90' ? 'selected' : '' }}>Last 3 Months</option>
                                </select>
                            </div>
                            
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                            <div class="col-md-1">
                                <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <select name="sort_by" class="form-select">
                                    <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                    <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                    <option value="end_date" {{ request('sort_by') == 'end_date' ? 'selected' : '' }}>End Date</option>
                                    <option value="views" {{ request('sort_by') == 'views' ? 'selected' : '' }}>Most Popular</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="section-title mb-0">Latest Government Jobs</h1>
                <span class="text-muted">{{ $jobs->total() }} jobs found</span>
            </div>
            
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
                                        <i class="fas fa-calendar me-1"></i>
                                        <strong>Last Date: {{ $job->end_date->format('d M Y') }}</strong>
                                    </p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-primary btn-sm">
                                            View Details
                                        </a>
                                        @if($job->application_link)
                                        <a href="{{ $job->application_link }}" class="btn btn-success btn-sm" target="_blank">
                                            Apply Now
                                        </a>
                                        @endif
                                    </div>
                                    
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($job->views) }} views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-5">
                {{ $jobs->links() }}
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Job Categories</h5>
                </div>
                <div class="card-body">
                    @foreach($categories as $category)
                    <a href="{{ route('jobs.category', $category->slug) }}" class="d-block text-decoration-none py-2 border-bottom">
                        <i class="{{ $category->icon ?? 'fas fa-briefcase' }} me-2"></i>
                        {{ $category->name }}
                        <span class="badge bg-light text-dark float-end">{{ $category->jobPosts->count() }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admit-cards') }}" class="d-block text-decoration-none py-2 border-bottom">
                        <i class="fas fa-id-card me-2"></i>Admit Cards
                    </a>
                    <a href="{{ route('answer-keys') }}" class="d-block text-decoration-none py-2 border-bottom">
                        <i class="fas fa-file-alt me-2"></i>Answer Keys
                    </a>
                    <a href="{{ route('results') }}" class="d-block text-decoration-none py-2">
                        <i class="fas fa-trophy me-2"></i>Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

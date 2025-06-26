@extends('layouts.frontend')

@section('title', 'Latest Government Jobs - Sarkari Result')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar with categories -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Job Categories</h5>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($categories as $category)
                    <a href="{{ route('jobs.category', $category->slug) }}" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span>
                            @if($category->icon)
                                <i class="{{ $category->icon }} me-2"></i>
                            @endif
                            {{ $category->name }}
                        </span>
                        <span class="badge bg-primary rounded-pill">{{ $category->jobPosts->count() }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Latest Government Jobs</h2>
                <div>
                    <span class="text-muted">{{ $jobs->total() }} jobs found</span>
                </div>
            </div>
            
            <div class="row">
                @forelse($jobs as $job)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">{{ $job->category->name }}</span>
                                @if($job->is_featured)
                                    <span class="badge badge-new text-white">FEATURED</span>
                                @endif
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route('jobs.show', $job->slug) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($job->title, 60) }}
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
                            @if($job->end_date)
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar me-1"></i>Last Date: {{ $job->end_date->format('d M Y') }}
                            </p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>{{ number_format($job->views) }} views
                                </small>
                                <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-outline-primary btn-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No jobs found</h4>
                        <p class="text-muted">Try checking back later or browse other categories.</p>
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

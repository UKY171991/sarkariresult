@extends('layouts.frontend')

@section('title', 'All Categories - Sarkari Result')
@section('description', 'Browse all job categories including government jobs, bank jobs, railway jobs, and more.')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center p-5 bg-light rounded">
                <i class="fas fa-th fa-4x text-primary mb-3"></i>
                <h1>Job Categories</h1>
                <p class="lead text-muted">Explore all available job categories</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="row">
        @forelse($categories as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 hover-shadow">
                <div class="card-body text-center p-4">
                    @if($category->icon)
                    <div class="mb-3">
                        <i class="{{ $category->icon }} fa-3x text-primary"></i>
                    </div>
                    @endif
                    <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                    <p class="card-text text-muted">{{ $category->description }}</p>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $category->job_posts_count }} Jobs Available</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center pb-4">
                    <a href="{{ route('jobs.category', $category->slug) }}" class="btn btn-primary">
                        <i class="fas fa-briefcase me-2"></i>View Jobs
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No Categories Available</h3>
                <p class="text-muted">Categories will appear here once they are added.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($categories->count() > 0)
    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="text-center p-5 bg-primary text-white rounded">
                <h3 class="mb-3">Can't Find What You're Looking For?</h3>
                <p class="mb-4">Browse all jobs or use our search functionality to find specific opportunities.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('jobs.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-list me-2"></i>Browse All Jobs
                    </a>
                    <a href="{{ route('jobs.search') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-search me-2"></i>Search Jobs
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.hover-shadow {
    transition: box-shadow 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-2px);
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>
@endsection

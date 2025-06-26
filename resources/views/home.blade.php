@extends('layouts.frontend')

@section('title', 'Sarkari Result - Latest Government Jobs, Admit Cards, Results & Updates 2025')
@section('description', 'Get latest government job notifications, admit cards, results, and answer keys. Find Sarkari Naukri updates for Railway, Banking, SSC, UPSC, State PSC jobs and more.')

@push('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .category-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .job-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .badge-hot {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        animation: pulse 2s infinite;
        font-size: 0.7rem;
        padding: 0.3rem 0.6rem;
    }
    
    .badge-new {
        background: linear-gradient(45deg, #2ecc71, #27ae60);
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { box-shadow: 0 0 5px #2ecc71; }
        to { box-shadow: 0 0 20px #2ecc71, 0 0 30px #2ecc71; }
    }
    
    .quick-access-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        text-align: center;
        transition: transform 0.3s ease;
    }
    
    .quick-access-card:hover {
        transform: scale(1.05);
    }
    
    .stats-counter {
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
    }
    
    .timeline-item {
        border-left: 3px solid #007bff;
        padding-left: 1rem;
        margin-bottom: 1rem;
        position: relative;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #007bff;
    }
    
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8">
                <div class="position-relative" style="z-index: 2;">
                    <h1 class="display-4 fw-bold mb-4">
                        <i class="fas fa-graduation-cap me-3"></i>
                        Latest Sarkari Result Updates 2025
                    </h1>
                    <p class="lead mb-4 fs-5">
                        Your most trusted source for government job notifications, admit cards, results, and answer keys. 
                        Get real-time updates for Railway, Banking, SSC, UPSC, State PSC and all central government jobs.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="{{ route('latest-jobs') }}" class="btn btn-light btn-lg px-4 py-2">
                            <i class="fas fa-briefcase me-2"></i>Latest Jobs
                            <span class="badge bg-danger ms-2">{{ $latestJobs->count() }}</span>
                        </a>
                        <a href="{{ route('admit-cards') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                            <i class="fas fa-id-card me-2"></i>Admit Cards
                            <span class="badge bg-warning text-dark ms-2">{{ $latestAdmitCards->count() }}</span>
                        </a>
                        <a href="{{ route('results') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                            <i class="fas fa-trophy me-2"></i>Results
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-users text-warning me-2"></i>
                            <span>10M+ Users Trust Us</span>
                        </div>
                        <div>
                            <i class="fas fa-clock text-info me-2"></i>
                            <span>Updated Every Hour</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="floating-animation">
                    <i class="fas fa-medal display-1" style="opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Access Cards -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="quick-access-card text-center">
                    <i class="fas fa-bolt fa-2x mb-2"></i>
                    <h6 class="mb-0">Breaking News</h6>
                    <small>Latest Updates</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-access-card text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-calendar-check fa-2x mb-2"></i>
                    <h6 class="mb-0">Exam Calendar</h6>
                    <small>Important Dates</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-access-card text-center" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-book-open fa-2x mb-2"></i>
                    <h6 class="mb-0">Study Material</h6>
                    <small>Free Resources</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-access-card text-center" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <i class="fas fa-bell fa-2x mb-2"></i>
                    <h6 class="mb-0">Job Alerts</h6>
                    <small>Never Miss an Opportunity</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Job Categories -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">
                <i class="fas fa-th-large text-primary me-2"></i>
                Popular Job Categories
            </h2>
            <p class="text-muted">Explore opportunities in various government sectors</p>
        </div>
        <div class="row g-4">
            @foreach($categories->take(8) as $category)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="category-card h-100 text-center p-4 position-relative">
                    @if($loop->first)
                        <div class="notification-badge">🔥</div>
                    @endif
                    <div class="mb-3">
                        <i class="{{ $category->icon ?? 'fas fa-briefcase' }} fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title mb-2">{{ $category->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($category->description ?? 'Government job opportunities', 60) }}</p>
                    <div class="mb-3">
                        <span class="badge bg-light text-dark">{{ $category->jobPosts->count() ?? 0 }} Active Jobs</span>
                    </div>
                    <a href="{{ route('jobs.category', $category->slug) }}" class="btn btn-primary btn-sm">
                        Explore Jobs <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-th me-2"></i>View All Categories
            </a>
        </div>
    </div>
</section>

<!-- Featured Jobs -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">
                <i class="fas fa-star text-warning me-2"></i>
                Featured Job Opportunities
            </h2>
            <p class="text-muted">Don't miss these high-priority job notifications</p>
        </div>
        <div class="row g-4">
            @foreach($featuredJobs->take(6) as $job)
            <div class="col-lg-4 col-md-6">
                <div class="job-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary">{{ $job->category->name }}</span>
                            <div class="d-flex gap-1">
                                @if($job->is_featured)
                                    <span class="badge badge-hot text-white">HOT</span>
                                @endif
                                @if($job->created_at->diffInDays() <= 3)
                                    <span class="badge badge-new text-white">NEW</span>
                                @endif
                            </div>
                        </div>
                        <h5 class="card-title mb-3">
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($job->title, 60) }}
                            </a>
                        </h5>
                        
                        <div class="mb-3">
                            <p class="text-muted mb-1">
                                <i class="fas fa-building me-2 text-primary"></i>{{ $job->organization }}
                            </p>
                            @if($job->total_posts)
                            <p class="text-muted mb-1">
                                <i class="fas fa-users me-2 text-success"></i>{{ number_format($job->total_posts) }} Vacancies
                            </p>
                            @endif
                            @if($job->end_date)
                            <p class="text-muted mb-1">
                                <i class="fas fa-calendar-times me-2 text-danger"></i>Last Date: {{ $job->end_date->format('d M Y') }}
                            </p>
                            @endif
                            @if($job->age_limit)
                            <p class="text-muted mb-1">
                                <i class="fas fa-user-clock me-2 text-info"></i>Age Limit: {{ $job->age_limit }}
                            </p>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <i class="fas fa-eye me-1"></i>{{ number_format($job->views ?? 0) }} views
                                <span class="ms-2">
                                    <i class="fas fa-clock me-1"></i>{{ $job->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-3 d-grid">
                            <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('latest-jobs') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-briefcase me-2"></i>View All Jobs
            </a>
        </div>
    </div>
</section>

<!-- Latest Updates Dashboard -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">
                <i class="fas fa-newspaper text-info me-2"></i>
                Latest Updates Dashboard
            </h2>
            <p class="text-muted">Stay informed with real-time notifications and updates</p>
        </div>
        
        <div class="row g-4">
            <!-- Latest Jobs Timeline -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-briefcase me-2"></i>Latest Jobs
                            <span class="badge bg-light text-primary ms-2">{{ $latestJobs->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($latestJobs->take(5) as $job)
                        <div class="timeline-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-1">
                                    <a href="{{ route('jobs.show', $job->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($job->title, 45) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-muted small">{{ $job->organization }}</p>
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-light text-primary">{{ $job->category->name }}</span>
                                @if($job->end_date && $job->end_date->diffInDays() <= 7)
                                <span class="badge bg-danger">Urgent</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('latest-jobs') }}" class="btn btn-outline-primary btn-sm">View All Jobs</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Admit Cards -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-id-card me-2"></i>Admit Cards
                            <span class="badge bg-light text-warning ms-2">{{ $latestAdmitCards->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($latestAdmitCards->take(5) as $admitCard)
                        <div class="timeline-item" style="border-left-color: #ffc107;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-1">
                                    <a href="#" class="text-decoration-none">
                                        {{ Str::limit($admitCard->title, 45) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $admitCard->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-muted small">{{ $admitCard->organization }}</p>
                            <div class="d-flex justify-content-between">
                                @if($admitCard->exam_date)
                                <span class="badge bg-light text-warning">{{ $admitCard->exam_date->format('d M Y') }}</span>
                                @endif
                                <span class="badge bg-warning text-dark">Download</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('admit-cards') }}" class="btn btn-outline-warning btn-sm">View All Admit Cards</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Answer Keys -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-key me-2"></i>Answer Keys
                            <span class="badge bg-light text-success ms-2">{{ $latestAnswerKeys->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($latestAnswerKeys->take(5) as $answerKey)
                        <div class="timeline-item" style="border-left-color: #28a745;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-1">
                                    <a href="#" class="text-decoration-none">
                                        {{ Str::limit($answerKey->title, 45) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $answerKey->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-muted small">{{ $answerKey->organization }}</p>
                            <div class="d-flex justify-content-between">
                                @if($answerKey->exam_date)
                                <span class="badge bg-light text-success">{{ $answerKey->exam_date->format('d M Y') }}</span>
                                @endif
                                <span class="badge bg-success">Available</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('answer-keys') }}" class="btn btn-outline-success btn-sm">View All Answer Keys</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="fas fa-briefcase fa-3x mb-3 opacity-75"></i>
                    <div class="stats-counter">{{ number_format($latestJobs->count() * 50) }}+</div>
                    <p class="mb-0">Total Job Notifications</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="fas fa-graduation-cap fa-3x mb-3 opacity-75"></i>
                    <div class="stats-counter">{{ number_format($categories->count()) }}+</div>
                    <p class="mb-0">Job Categories</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="fas fa-id-card fa-3x mb-3 opacity-75"></i>
                    <div class="stats-counter">{{ number_format($latestAdmitCards->count() * 20) }}+</div>
                    <p class="mb-0">Admit Cards Released</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="d-flex flex-column align-items-center">
                    <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
                    <div class="stats-counter">10M+</div>
                    <p class="mb-0">Active Users</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-3">Never Miss an Opportunity!</h3>
                <p class="text-muted mb-4">Subscribe to get instant notifications about latest job openings, admit cards, and results directly in your inbox.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <input type="email" class="form-control form-control-lg" placeholder="Enter your email address" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-bell me-2"></i>Subscribe
                        </button>
                    </div>
                </form>
                <small class="text-muted mt-2 d-block">
                    <i class="fas fa-shield-alt me-1"></i>We respect your privacy. Unsubscribe anytime.
                </small>
            </div>
        </div>
    </div>
</section>
@endsection

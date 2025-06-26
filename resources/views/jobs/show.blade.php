@extends('layouts.frontend')

@section('title', $jobPost->title . ' - Sarkari Result')
@section('description', $jobPost->short_description ?: Str::limit(strip_tags($jobPost->description), 160))

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Job Details Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="h3 mb-2">{{ $jobPost->title }}</h1>
                            <div class="d-flex gap-2 mb-2">
                                <span class="badge bg-primary">{{ $jobPost->category->name }}</span>
                                @if($jobPost->is_featured)
                                    <span class="badge bg-warning">Featured</span>
                                @endif
                                <span class="badge bg-success">{{ ucfirst($jobPost->status) }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ number_format($jobPost->views) }} views
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Organization Info -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-building me-2"></i>Organization:</strong>
                                {{ $jobPost->organization }}
                            </div>
                            @if($jobPost->total_posts)
                            <div class="col-md-6">
                                <strong><i class="fas fa-users me-2"></i>Total Posts:</strong>
                                {{ number_format($jobPost->total_posts) }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Important Dates -->
                    @if($jobPost->start_date || $jobPost->end_date || $jobPost->exam_date)
                    <div class="row mb-4">
                        @if($jobPost->start_date)
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-play-circle text-success fa-2x mb-2"></i>
                                <h6>Application Start</h6>
                                <strong>{{ $jobPost->start_date->format('d M Y') }}</strong>
                            </div>
                        </div>
                        @endif
                        @if($jobPost->end_date)
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-stop-circle text-danger fa-2x mb-2"></i>
                                <h6>Last Date</h6>
                                <strong>{{ $jobPost->end_date->format('d M Y') }}</strong>
                            </div>
                        </div>
                        @endif
                        @if($jobPost->exam_date)
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-calendar-alt text-primary fa-2x mb-2"></i>
                                <h6>Exam Date</h6>
                                <strong>{{ $jobPost->exam_date->format('d M Y') }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Job Description -->
                    <div class="mb-4">
                        <h4>Job Details</h4>
                        <div class="content">
                            {!! $jobPost->description !!}
                        </div>
                    </div>

                    <!-- Additional Information -->
                    @if($jobPost->location || $jobPost->application_fee)
                    <div class="row mb-4">
                        @if($jobPost->location)
                        <div class="col-md-6">
                            <h6><i class="fas fa-map-marker-alt me-2"></i>Location</h6>
                            <p>{{ $jobPost->location }}</p>
                        </div>
                        @endif
                        @if($jobPost->application_fee)
                        <div class="col-md-6">
                            <h6><i class="fas fa-money-bill-wave me-2"></i>Application Fee</h6>
                            <p>₹{{ number_format($jobPost->application_fee, 2) }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 mb-4">
                        @if($jobPost->application_link)
                        <a href="{{ $jobPost->application_link }}" target="_blank" class="btn btn-primary btn-lg">
                            <i class="fas fa-external-link-alt me-2"></i>Apply Online
                        </a>
                        @endif
                        @if($jobPost->notification_pdf)
                        <a href="{{ $jobPost->notification_pdf }}" target="_blank" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-file-pdf me-2"></i>Download Notification
                        </a>
                        @endif
                        @if($jobPost->official_website)
                        <a href="{{ $jobPost->official_website }}" target="_blank" class="btn btn-outline-secondary">
                            <i class="fas fa-globe me-2"></i>Official Website
                        </a>
                        @endif
                    </div>

                    <!-- Share Buttons -->
                    <div class="border-top pt-3">
                        <h6>Share this job:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($jobPost->title) }}" 
                               target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($jobPost->title . ' - ' . request()->fullUrl()) }}" 
                               target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Admit Cards -->
            @if($jobPost->admitCards->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-id-card me-2"></i>Admit Cards</h5>
                </div>
                <div class="card-body">
                    @foreach($jobPost->admitCards as $admitCard)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $admitCard->title }}</h6>
                        @if($admitCard->exam_date)
                        <small class="text-muted">Exam: {{ $admitCard->exam_date->format('d M Y') }}</small>
                        @endif
                        @if($admitCard->download_link)
                        <div class="mt-2">
                            <a href="{{ $admitCard->download_link }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Related Answer Keys -->
            @if($jobPost->answerKeys->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-file-alt me-2"></i>Answer Keys</h5>
                </div>
                <div class="card-body">
                    @foreach($jobPost->answerKeys as $answerKey)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $answerKey->title }}</h6>
                        @if($answerKey->exam_date)
                        <small class="text-muted">Exam: {{ $answerKey->exam_date->format('d M Y') }}</small>
                        @endif
                        @if($answerKey->download_link)
                        <div class="mt-2">
                            <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Related Jobs -->
            @if($relatedJobs->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-briefcase me-2"></i>Related Jobs</h5>
                </div>
                <div class="card-body">
                    @foreach($relatedJobs as $relatedJob)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>
                            <a href="{{ route('jobs.show', $relatedJob->slug) }}" class="text-decoration-none">
                                {{ Str::limit($relatedJob->title, 50) }}
                            </a>
                        </h6>
                        <small class="text-muted">{{ $relatedJob->organization }}</small>
                        @if($relatedJob->end_date)
                        <br><small class="text-warning">Last Date: {{ $relatedJob->end_date->format('d M Y') }}</small>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

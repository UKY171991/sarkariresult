@extends('layouts.frontend')

@section('title', 'Answer Keys - Sarkari Result')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Answer Keys</h2>
                <div>
                    <span class="text-muted">{{ $answerKeys->total() }} answer keys found</span>
                </div>
            </div>
            
            <div class="row">
                @forelse($answerKeys as $answerKey)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card answer-key-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-success">Answer Key</span>
                                @if($answerKey->status === 'active')
                                    <span class="badge bg-primary">Available</span>
                                @endif
                            </div>
                            <h5 class="card-title">
                                <a href="{{ $answerKey->download_link }}" target="_blank" class="text-decoration-none text-dark">
                                    {{ Str::limit($answerKey->title, 60) }}
                                </a>
                            </h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-building me-1"></i>{{ $answerKey->organization }}
                            </p>
                            @if($answerKey->jobPost)
                            <p class="text-muted mb-2">
                                <i class="fas fa-briefcase me-1"></i>{{ $answerKey->jobPost->title }}
                            </p>
                            @endif
                            @if($answerKey->exam_date)
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar me-1"></i>Exam Date: {{ $answerKey->exam_date->format('d M Y') }}
                            </p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>{{ number_format($answerKey->downloads) }} downloads
                                </small>
                                <a href="{{ $answerKey->download_link }}" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h4>No answer keys found</h4>
                        <p class="text-muted">Answer keys will be published here when available.</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $answerKeys->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

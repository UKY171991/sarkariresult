@extends('layouts.frontend')

@section('title', 'Admit Cards - Sarkari Result')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Admit Cards</h2>
                <div>
                    <span class="text-muted">{{ $admitCards->total() }} admit cards found</span>
                </div>
            </div>
            
            <div class="row">
                @forelse($admitCards as $admitCard)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card admit-card-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-warning text-dark">Admit Card</span>
                                @if($admitCard->status === 'active')
                                    <span class="badge bg-primary">Available</span>
                                @endif
                            </div>
                            <h5 class="card-title">
                                <a href="{{ $admitCard->download_link }}" target="_blank" class="text-decoration-none text-dark">
                                    {{ Str::limit($admitCard->title, 60) }}
                                </a>
                            </h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-building me-1"></i>{{ $admitCard->organization }}
                            </p>
                            @if($admitCard->jobPost)
                            <p class="text-muted mb-2">
                                <i class="fas fa-briefcase me-1"></i>{{ $admitCard->jobPost->title }}
                            </p>
                            @endif
                            @if($admitCard->exam_date)
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar me-1"></i>Exam Date: {{ $admitCard->exam_date->format('d M Y') }}
                            </p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>{{ number_format($admitCard->downloads) }} downloads
                                </small>
                                <a href="{{ $admitCard->download_link }}" target="_blank" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-id-card fa-3x text-muted mb-3"></i>
                        <h4>No admit cards found</h4>
                        <p class="text-muted">Admit cards will be published here when available.</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $admitCards->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

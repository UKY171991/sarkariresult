<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sarkari Result - Latest Government Jobs, Admit Cards, Results')</title>
    <meta name="description" content="@yield('description', 'Get latest government job notifications, admit cards, results, and answer keys. Find Sarkari Naukri updates for Railway, Banking, SSC, UPSC jobs.')">
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#007bff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Sarkari Result">
    <meta name="msapplication-TileColor" content="#007bff">
    <meta name="msapplication-config" content="/browserconfig.xml">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="apple-touch-icon" href="/images/icon-192x192.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Mobile Responsive CSS -->
    <link href="{{ asset('css/mobile-responsive.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
        }
        
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .job-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .job-card:hover {
            transform: translateY(-3px);
        }
        
        .badge-new {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }
        
        .quick-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .quick-links a:hover {
            color: white;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 2rem;
            font-weight: bold;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .breaking-news {
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            color: white;
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }
        
        .breaking-news .marquee {
            animation: scroll-left 30s linear infinite;
        }
        
        @keyframes scroll-left {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Breaking News Bar -->
    <div class="breaking-news">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <span class="badge bg-warning text-dark me-2">BREAKING</span>
                <div class="marquee">
                    Latest Updates: Railway Group D Recruitment 2025 | SBI PO Notification Released | SSC CGL 2025 Apply Online
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand text-primary" href="{{ route('home') }}">
                <i class="fas fa-graduation-cap me-2"></i>Sarkari Result
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('latest-jobs') }}">Latest Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admit-cards') }}">Admit Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('answer-keys') }}">Answer Keys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results') }}">Results</a>
                    </li>
                </ul>
                
                <!-- Search Form -->
                <form class="d-flex me-3" method="GET" action="{{ route('jobs.search') }}">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control" 
                               name="q" 
                               placeholder="Search jobs..."
                               value="{{ request('q') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Sarkari Result</h5>
                    <p class="text-muted">Your trusted source for latest government job notifications, admit cards, results, and career opportunities in India.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Quick Links</h6>
                    <div class="quick-links">
                        <a href="{{ route('latest-jobs') }}" class="d-block mb-2">Latest Jobs</a>
                        <a href="{{ route('admit-cards') }}" class="d-block mb-2">Admit Cards</a>
                        <a href="{{ route('answer-keys') }}" class="d-block mb-2">Answer Keys</a>
                        <a href="{{ route('results') }}" class="d-block mb-2">Results</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Popular Categories</h6>
                    <div class="quick-links">
                        <a href="#" class="d-block mb-2">Railway Jobs</a>
                        <a href="#" class="d-block mb-2">Banking Jobs</a>
                        <a href="#" class="d-block mb-2">SSC Jobs</a>
                        <a href="#" class="d-block mb-2">UPSC Jobs</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>Contact Info</h6>
                    <div class="text-muted">
                        <p><i class="fas fa-envelope me-2"></i> info@sarkariresult.com</p>
                        <p><i class="fas fa-phone me-2"></i> +91 98765 43210</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i> New Delhi, India</p>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} Sarkari Result. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted me-3">Terms of Service</a>
                    <a href="#" class="text-muted">Disclaimer</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Mobile Enhancement JS -->
    <script src="{{ asset('js/mobile-enhancements.js') }}"></script>
    
    @stack('scripts')
</body>
</html>

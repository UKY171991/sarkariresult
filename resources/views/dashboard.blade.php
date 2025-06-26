@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i>
                        Welcome, {{ Auth::user()->name }}!
                    </h3>
                </div>
                <div class="card-body">
                    <p class="mb-0">You're successfully logged in. Explore the latest job opportunities and manage your profile.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Jobs</h3>
                    <p>Browse latest opportunities</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{ route('jobs.index') }}" class="small-box-footer">
                    Browse Jobs <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Admit Cards</h3>
                    <p>Download admit cards</p>
                </div>
                <div class="icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <a href="{{ route('admit-cards') }}" class="small-box-footer">
                    View Admit Cards <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Results</h3>
                    <p>Check exam results</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{ route('results') }}" class="small-box-footer">
                    View Results <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-link"></i>
                        Quick Links
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('categories') }}" class="btn btn-app">
                                <i class="fas fa-th"></i>
                                All Categories
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('latest-jobs') }}" class="btn btn-app">
                                <i class="fas fa-clock"></i>
                                Latest Jobs
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('answer-keys') }}" class="btn btn-app">
                                <i class="fas fa-key"></i>
                                Answer Keys
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-app">
                                <i class="fas fa-home"></i>
                                Home Page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie"></i>
                        Quick Stats
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Jobs</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>53</h3>
                                    <p>Active Categories</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>44</h3>
                                    <p>Recent Results</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>65</h3>
                                    <p>Admit Cards</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .btn-app {
            margin: 5px;
        }
    </style>
@stop

@section('js')
    {{-- Add here extra javascript --}}
    <script>
        console.log("Dashboard loaded with AdminLTE3!");
    </script>
@stop

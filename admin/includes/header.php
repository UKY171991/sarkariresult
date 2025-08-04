<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($page_title) ? $page_title . ' - ' . ADMIN_TITLE : ADMIN_TITLE; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
  <!-- Custom Admin CSS -->
  <style>
    .brand-link {
      background-color: #343a40 !important;
    }
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
      background-color: #007bff;
      color: #fff;
    }
    .content-wrapper {
      background-color: #f4f6f9;
    }
    .card {
      box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    }
    .table th {
      border-top: none;
      font-weight: 600;
      color: #495057;
    }
    .btn {
      border-radius: 0.25rem;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .main-header .navbar {
      background-color: #fff;
      border-bottom: 1px solid #dee2e6;
    }
    .navbar-light .navbar-nav .nav-link {
      color: #495057;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/images/logo.svg" alt="Sarkari Result Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link" target="_blank">
          <i class="fas fa-external-link-alt"></i> View Site
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id="unread-messages">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="https://via.placeholder.com/50x50" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Contact Form
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">New message from website...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/messages.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 job applications
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
      <!-- User Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="https://via.placeholder.com/35x35" class="img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline ml-1"><?php echo $_SESSION['admin_username'] ?? 'Admin'; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-header">
            <strong><?php echo $_SESSION['admin_username'] ?? 'Administrator'; ?></strong><br>
            <small class="text-muted"><?php echo $_SESSION['admin_role'] ?? 'admin'; ?></small>
          </div>
          <div class="dropdown-divider"></div>
          <a href="pages/profile.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <a href="pages/settings.php" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../assets/images/logo.svg" alt="Sarkari Result Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sarkari Result</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://via.placeholder.com/160x160" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="pages/profile.php" class="d-block"><?php echo $_SESSION['admin_username'] ?? 'Administrator'; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach($admin_menu as $key => $menu): ?>
            <?php if(isset($menu['admin_only']) && $menu['admin_only'] && !isAdmin()) continue; ?>
            
            <?php if(isset($menu['submenu'])): ?>
              <!-- Menu with submenu -->
              <li class="nav-item <?php echo (strpos(getCurrentPage(), $key) !== false) ? 'menu-open' : ''; ?>">
                <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), $key) !== false) ? 'active' : ''; ?>">
                  <i class="nav-icon <?php echo $menu['icon']; ?>"></i>
                  <p>
                    <?php echo $menu['title']; ?>
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php foreach($menu['submenu'] as $sub_key => $submenu): ?>
                    <li class="nav-item">
                      <a href="<?php echo $submenu['url']; ?>" class="nav-link <?php echo (getCurrentPage() == basename($submenu['url'], '.php')) ? 'active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo $submenu['title']; ?></p>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php else: ?>
              <!-- Single menu item -->
              <li class="nav-item">
                <a href="<?php echo $menu['url']; ?>" class="nav-link <?php echo (getCurrentPage() == basename($menu['url'], '.php')) ? 'active' : ''; ?>">
                  <i class="nav-icon <?php echo $menu['icon']; ?>"></i>
                  <p><?php echo $menu['title']; ?></p>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <?php if(isset($breadcrumb) && !empty($breadcrumb)): ?>
                <?php foreach($breadcrumb as $title => $url): ?>
                  <?php if($url): ?>
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></li>
                  <?php else: ?>
                    <li class="breadcrumb-item active"><?php echo $title; ?></li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="breadcrumb-item active">Dashboard</li>
              <?php endif; ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"><?php
        // Display success/error messages
        if(isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>' . $_SESSION['success_message'] . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            unset($_SESSION['success_message']);
        }
        
        if(isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>' . $_SESSION['error_message'] . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            unset($_SESSION['error_message']);
        }
        
        if(isset($_GET['error']) && $_GET['error'] == 'access_denied') {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Access denied. Admin privileges required.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
        ?>

<?php
if (!defined('ADMIN_AREA')) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Sarkari Result Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
  <!-- Summernote -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
  <!-- AdminLTE 3 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  
  <!-- Custom Admin Styles -->
  <style>
    :root {
      --primary-color: #007bff;
      --success-color: #28a745;
      --info-color: #17a2b8;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --dark-color: #343a40;
    }

    .main-header .navbar {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-bottom: none;
    }
    
    .main-sidebar {
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .main-sidebar .brand-link {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .main-sidebar .brand-link:hover {
      color: #fff;
    }
    
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
      background-color: rgba(102, 126, 234, 0.9);
      color: #fff;
    }
    
    .content-wrapper {
      background: #f4f6f9;
    }
    
    .card {
      border: none;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    
    .card-primary.card-outline {
      border-top: 3px solid var(--primary-color);
    }
    
    .card-success.card-outline {
      border-top: 3px solid var(--success-color);
    }
    
    .card-info.card-outline {
      border-top: 3px solid var(--info-color);
    }
    
    .card-warning.card-outline {
      border-top: 3px solid var(--warning-color);
    }
    
    .card-danger.card-outline {
      border-top: 3px solid var(--danger-color);
    }
    
    .btn {
      border-radius: 6px;
      font-weight: 500;
    }
    
    .btn-primary {
      background: linear-gradient(45deg, #667eea, #764ba2);
      border: none;
    }
    
    .btn-primary:hover {
      background: linear-gradient(45deg, #5a6fd8, #6941a0);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }
    
    .small-box {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    
    .small-box:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    
    .table {
      border-radius: 8px;
      overflow: hidden;
    }
    
    .table thead th {
      background: #f8f9fa;
      border: none;
      font-weight: 600;
      color: #495057;
    }
    
    .breadcrumb {
      background: transparent;
      padding: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
      content: "›";
      color: #6c757d;
    }
    
    .content-header {
      padding: 15px 0.5rem;
    }
    
    .sidebar-mini.sidebar-collapse .main-sidebar:hover {
      width: 250px;
    }
    
    @media (max-width: 767.98px) {
      .content-wrapper {
        margin-left: 0;
      }
    }
  </style>
  
  <?php if (isset($additional_css)) echo $additional_css; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/images/logo.svg" alt="Sarkari Result" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link" target="_blank">
          <i class="fas fa-eye mr-1"></i>View Website
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">
          <i class="fas fa-home mr-1"></i>Home
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Contact Messages">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id="message-count">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="pages/messages.php" class="dropdown-item">
            <div class="media">
              <img src="https://via.placeholder.com/50" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  New Contact Message
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Job inquiry from user...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/messages.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Notifications">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notification-count">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">5 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 3 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 2 new registrations
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
      <!-- User Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="https://via.placeholder.com/40" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">
            <?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; ?>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="https://via.placeholder.com/160" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Administrator'; ?>
              <small>Admin since Nov. 2023</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="pages/users.php" class="btn btn-default btn-flat">Users</a>
              </div>
              <div class="col-4 text-center">
                <a href="pages/settings.php" class="btn btn-default btn-flat">Settings</a>
              </div>
              <div class="col-4 text-center">
                <a href="pages/messages.php" class="btn btn-default btn-flat">Messages</a>
              </div>
            </div>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

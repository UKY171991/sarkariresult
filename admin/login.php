<?php
require_once 'config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        try {
            $db = getDBConnection();
            $stmt = $db->prepare("SELECT id, username, email, password, role, status FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] === 'active') {
                    // Set session variables
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_username'] = $user['username'];
                    $_SESSION['admin_email'] = $user['email'];
                    $_SESSION['admin_role'] = $user['role'];
                    
                    // Update last login
                    $stmt = $db->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
                    $stmt->execute([$user['id']]);
                    
                    header('Location: dashboard.php');
                    exit();
                } else {
                    $error_message = "Your account has been deactivated. Please contact administrator.";
                }
            } else {
                $error_message = "Invalid username or password.";
            }
        } catch (Exception $e) {
            $error_message = "Login failed. Please try again.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - Sarkari Result</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <!-- AdminLTE 3 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  
  <style>
    .login-page {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    .login-box {
      width: 360px;
      margin: auto;
      padding-top: 5%;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.95);
    }
    .card-header {
      background: transparent;
      border-bottom: none;
      text-align: center;
      padding: 2rem 1.5rem 1rem;
    }
    .login-logo a {
      font-size: 2.2rem;
      font-weight: 700;
      color: #2c3e50;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .login-logo img {
      height: 45px;
      width: auto;
    }
    .login-card-body {
      padding: 1.5rem 2rem 2rem;
    }
    .input-group {
      margin-bottom: 1.5rem;
    }
    .form-control {
      border-radius: 10px;
      border: 1px solid #e0e6ed;
      padding: 12px 15px;
      font-size: 0.95rem;
      height: auto;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .input-group-text {
      border-radius: 10px 0 0 10px;
      border: 1px solid #e0e6ed;
      background: #f8f9fa;
      color: #6c757d;
    }
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    .alert {
      border-radius: 10px;
      border: none;
      margin-bottom: 1rem;
    }
    .alert-danger {
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      border: 1px solid rgba(220, 53, 69, 0.2);
    }
    .icheck-primary {
      margin: 1rem 0;
    }
    .back-link {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1rem;
      border-top: 1px solid #e9ecef;
    }
    .back-link a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .back-link a:hover {
      color: #764ba2;
      text-decoration: none;
    }
    .forgot-password {
      text-align: center;
      margin-top: 1rem;
    }
    .forgot-password a {
      color: #6c757d;
      text-decoration: none;
      font-size: 0.9rem;
    }
    .forgot-password a:hover {
      color: #667eea;
      text-decoration: underline;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- Logo -->
  <div class="login-logo">
    <a href="../index.php">
      <i class="fas fa-user-shield"></i>
      <b>Sarkari</b>Result
    </a>
  </div>
  
  <!-- Login Card -->
  <div class="card card-outline">
    <div class="card-header text-center">
      <h4 class="mb-1">Admin Panel</h4>
      <p class="text-muted mb-0">Sign in to your admin account</p>
    </div>
    <div class="card-body login-card-body">
      <?php if (isset($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-triangle mr-2"></i><?php echo $error_message; ?>
      </div>
      <?php endif; ?>

      <form action="" method="post" class="needs-validation" novalidate>
        <div class="input-group">
          <input type="text" 
                 class="form-control" 
                 name="username" 
                 placeholder="Username or Email"
                 value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                 required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group">
          <input type="password" 
                 class="form-control" 
                 name="password" 
                 placeholder="Password"
                 required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-sign-in-alt mr-2"></i>Sign In
            </button>
          </div>
        </div>
      </form>

      <div class="forgot-password">
        <a href="forgot-password.php">
          <i class="fas fa-key mr-1"></i>Forgot your password?
        </a>
      </div>

      <div class="back-link">
        <a href="../index.php">
          <i class="fas fa-arrow-left mr-2"></i>Back to Website
        </a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    // Form validation
    $('.needs-validation').on('submit', function(e) {
        if (this.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
        }
        $(this).addClass('was-validated');
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Focus on first input
    $('input[name="username"]').focus();

    // Loading state on form submission
    $('form').on('submit', function() {
        const btn = $(this).find('button[type="submit"]');
        btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Signing in...');
        btn.prop('disabled', true);
    });
});
</script>
</body>
</html>
      border: 1px solid #e0e6ed;
      padding: 12px 15px;
      font-size: 0.95rem;
    }
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .input-group-text {
      border-radius: 10px 0 0 10px;
      border: 1px solid #e0e6ed;
      background: #f8f9fa;
    }
    .form-control.is-invalid {
      border-color: #dc3545;
    }
    .alert {
      border-radius: 10px;
      border: none;
    }
    .back-to-site {
      text-align: center;
      margin-top: 1rem;
    }
    .back-to-site a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }
    .back-to-site a:hover {
      color: #764ba2;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline">
    <div class="card-header">
      <div class="login-logo">
        <img src="../assets/images/logo.svg" alt="Logo" height="50" class="mb-3">
        <div>Sarkari Result</div>
      </div>
      <p class="login-subtitle">Admin Panel Access</p>
    </div>
    <div class="card-body">
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
          <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error_message; ?>
        </div>
      <?php endif; ?>

      <form action="" method="post" class="needs-validation" novalidate>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-user"></i>
              </span>
            </div>
            <input type="text" 
                   class="form-control" 
                   name="username" 
                   placeholder="Username or Email"
                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                   required>
            <div class="invalid-feedback">
              Please provide a valid username or email.
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-lock"></i>
              </span>
            </div>
            <input type="password" 
                   class="form-control" 
                   name="password" 
                   placeholder="Password"
                   required>
            <div class="invalid-feedback">
              Please provide your password.
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">
              Remember Me
            </label>
          </div>
        </div>

        <div class="form-group mb-4">
          <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Sign In
          </button>
        </div>
      </form>

      <div class="text-center">
        <a href="forgot-password.php" class="text-muted">
          <i class="fas fa-key mr-1"></i>
          Forgot your password?
        </a>
      </div>

      <div class="back-to-site">
        <a href="../index.php">
          <i class="fas fa-arrow-left mr-1"></i>
          Back to Website
        </a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    // Form validation
    $('.needs-validation').on('submit', function(e) {
        if (this.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
        }
        $(this).addClass('was-validated');
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Focus on first input
    $('input[name="username"]').focus();
});
</script>

</body>
</html>

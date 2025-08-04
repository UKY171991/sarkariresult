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
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  
  <style>
    .login-page {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    .login-box {
      width: 400px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background: transparent;
      border-bottom: none;
      text-align: center;
      padding: 2rem 2rem 0;
    }
    .login-logo {
      font-size: 2.5rem;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 1rem;
    }
    .login-subtitle {
      color: #6c757d;
      font-size: 0.95rem;
      margin-bottom: 0;
    }
    .card-body {
      padding: 2rem;
    }
    .form-control {
      border-radius: 10px;
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

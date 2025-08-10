<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Register') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Register</strong>
            <a class="small" href="/login">Login</a>
          </div>
          <div class="card-body">
            <?php $errors = session('errors') ?? []; ?>
            <?php if(isset($errors['general'])): ?><div class="alert alert-danger small"><?= esc($errors['general']) ?></div><?php endif; ?>
            <form method="post">
              <?= csrf_field() ?>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input class="form-control <?= isset($errors['username'])?'is-invalid':'' ?>" name="username" value="<?= esc(old('username','')) ?>" required>
                <?php if(isset($errors['username'])): ?><div class="invalid-feedback"><?= esc($errors['username']) ?></div><?php endif; ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Email (optional)</label>
                <input type="email" class="form-control <?= isset($errors['email'])?'is-invalid':'' ?>" name="email" value="<?= esc(old('email','')) ?>">
                <?php if(isset($errors['email'])): ?><div class="invalid-feedback"><?= esc($errors['email']) ?></div><?php endif; ?>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control <?= isset($errors['password'])?'is-invalid':'' ?>" name="password" required>
                  <?php if(isset($errors['password'])): ?><div class="invalid-feedback"><?= esc($errors['password']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control <?= isset($errors['confirm'])?'is-invalid':'' ?>" name="confirm" required>
                  <?php if(isset($errors['confirm'])): ?><div class="invalid-feedback"><?= esc($errors['confirm']) ?></div><?php endif; ?>
                </div>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" <?= old('is_admin')?'checked':'' ?>>
                <label class="form-check-label" for="is_admin">Make this user admin</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary" type="submit">Create account</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

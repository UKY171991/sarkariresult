<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Sarkari Portal') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f7f7f7; }
    .brand { background:#8b0000; color:#fff; }
    .brand a { color:#fff; text-decoration:none; }
    .section-card h5 { background:#8b0000; color:#fff; padding:8px 12px; margin:0; }
    .section-card .list-group-item { font-size:0.95rem; }
    footer { font-size:0.85rem; color:#666; }
  </style>
</head>
<body>
  <header class="brand py-3 mb-3">
    <div class="container">
      <h1 class="h3 m-0"><a href="/">Sarkari Portal</a></h1>
      <div class="small">Latest Jobs • Results • Admit Cards</div>
    </div>
  </header>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background:#b22222">
    <div class="container">
      <a class="navbar-brand d-lg-none" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/exam-result">Exam Result</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/admit-card">Admit Card</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/top-online-form">Top Online Form</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/answer-keys">Answer Keys</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/syllabus">Syllabus</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/admission-form">Admission Form</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/document-verification">Documents Verification</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/diploma-iti">Diploma / ITI</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/b-tech-m-tech">B.Tech / M.Tech</a></li>
          <li class="nav-item"><a class="nav-link" href="/category/hot-job">Hot Job</a></li>
        </ul>
        <div class="d-flex">
          <a class="btn btn-outline-light btn-sm" href="/admin">Admin</a>
        </div>
      </div>
    </div>
  </nav>
  <main class="container mb-5">
    <?= $this->renderSection('content') ?>
  </main>
  <footer class="container text-center mb-4">
    <div>Unofficial demo inspired by sarkariresult.com and sarkariexam.com</div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

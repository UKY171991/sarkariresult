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
  <main class="container mb-5">
    <?= $this->renderSection('content') ?>
  </main>
  <footer class="container text-center mb-4">
    <div>Unofficial demo inspired by sarkariresult.com and sarkariexam.com</div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<h2 class="mb-3"><?= esc($title ?? 'Category') ?></h2>
<ul class="list-group">
<?php foreach (($posts ?? []) as $p): ?>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div>
      <a href="<?= esc($p['external_url']) ?>" target="_blank" class="fw-semibold"><?= esc($p['title']) ?></a>
      <?php if (!empty($p['summary'])): ?><div class="small text-muted"><?= esc($p['summary']) ?></div><?php endif; ?>
    </div>
    <span class="badge bg-secondary"><?= esc($p['published_at'] ?? '-') ?></span>
  </li>
<?php endforeach; ?>
<?php if (empty($posts)): ?>
  <li class="list-group-item text-muted">No items</li>
<?php endif; ?>
</ul>
<?= $this->endSection() ?>

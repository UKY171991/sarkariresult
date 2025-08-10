<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<div class="row g-3">
  <div class="col-md-4">
    <div class="card section-card">
      <h5 class="card-header">Latest Jobs</h5>
      <ul class="list-group list-group-flush">
        <?php foreach (($jobs ?? []) as $item): ?>
          <li class="list-group-item">
            <a href="<?= esc($item['external_url']) ?>" target="_blank"><?= esc($item['title']) ?></a>
            <div class="small text-muted">Published: <?= esc($item['published_at']) ?></div>
          </li>
        <?php endforeach; ?>
        <?php if (empty($jobs)): ?>
          <li class="list-group-item text-muted">No jobs yet.</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card section-card">
      <h5 class="card-header">Results</h5>
      <ul class="list-group list-group-flush">
        <?php foreach (($results ?? []) as $item): ?>
          <li class="list-group-item">
            <a href="<?= esc($item['external_url']) ?>" target="_blank"><?= esc($item['title']) ?></a>
            <div class="small text-muted">Published: <?= esc($item['published_at']) ?></div>
          </li>
        <?php endforeach; ?>
        <?php if (empty($results)): ?>
          <li class="list-group-item text-muted">No results yet.</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card section-card">
      <h5 class="card-header">Admit Cards</h5>
      <ul class="list-group list-group-flush">
        <?php foreach (($admit_cards ?? []) as $item): ?>
          <li class="list-group-item">
            <a href="<?= esc($item['external_url']) ?>" target="_blank"><?= esc($item['title']) ?></a>
            <div class="small text-muted">Published: <?= esc($item['published_at']) ?></div>
          </li>
        <?php endforeach; ?>
        <?php if (empty($admit_cards)): ?>
          <li class="list-group-item text-muted">No admit cards yet.</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

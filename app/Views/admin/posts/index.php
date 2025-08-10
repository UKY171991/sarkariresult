<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Posts</h3>
    <a class="btn btn-primary btn-sm" href="/admin/posts/create"><i class="fas fa-plus"></i> New</a>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th><th>Title</th><th>Category</th><th>Status</th><th>Published</th><th style="width:160px">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (($posts ?? []) as $p): ?>
        <tr>
          <td><?= esc($p['id']) ?></td>
          <td><?= esc($p['title']) ?></td>
          <td><?= esc($p['category']) ?></td>
          <td><span class="badge badge-<?= $p['status']==='published'?'success':'secondary' ?>"><?= esc($p['status']) ?></span></td>
          <td><?= esc($p['published_at'] ?? '-') ?></td>
          <td>
            <a class="btn btn-sm btn-info" href="/admin/posts/edit/<?= esc($p['id']) ?>">Edit</a>
            <a class="btn btn-sm btn-danger" href="/admin/posts/delete/<?= esc($p['id']) ?>" onclick="return confirm('Delete this post?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($posts)): ?>
        <tr><td colspan="6" class="text-center text-muted p-3">No posts</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $errors = session('errors') ?? []; ?>
<div class="card">
  <div class="card-header"><h3 class="card-title"><?= esc($title ?? 'Post') ?></h3></div>
  <div class="card-body">
    <form method="post">
      <?= csrf_field() ?>
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" value="<?= esc(old('title', $post['title'] ?? '')) ?>" class="form-control <?= isset($errors['title'])?'is-invalid':'' ?>">
        <?php if(isset($errors['title'])): ?><div class="invalid-feedback"><?= esc($errors['title']) ?></div><?php endif; ?>
      </div>
      <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" value="<?= esc(old('slug', $post['slug'] ?? '')) ?>" class="form-control <?= isset($errors['slug'])?'is-invalid':'' ?>">
        <?php if(isset($errors['slug'])): ?><div class="invalid-feedback"><?= esc($errors['slug']) ?></div><?php endif; ?>
      </div>
      <div class="form-group">
        <label>Summary</label>
        <textarea name="summary" class="form-control" rows="3"><?= esc(old('summary', $post['summary'] ?? '')) ?></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Category</label>
          <select name="category" class="form-control">
            <?php $cat = old('category', $post['category'] ?? 'job'); ?>
            <option value="job" <?= $cat==='job'?'selected':'' ?>>Job</option>
            <option value="result" <?= $cat==='result'?'selected':'' ?>>Result</option>
            <option value="admit_card" <?= $cat==='admit_card'?'selected':'' ?>>Admit Card</option>
            <option value="answer_key" <?= $cat==='answer_key'?'selected':'' ?>>Answer Key</option>
            <option value="syllabus" <?= $cat==='syllabus'?'selected':'' ?>>Syllabus</option>
          </select>
        </div>
        <div class="form-group col-md-8">
          <label>External URL</label>
          <input type="url" name="external_url" value="<?= esc(old('external_url', $post['external_url'] ?? '')) ?>" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Status</label>
          <?php $status = old('status', $post['status'] ?? 'draft'); ?>
          <select name="status" class="form-control">
            <option value="draft" <?= $status==='draft'?'selected':'' ?>>Draft</option>
            <option value="published" <?= $status==='published'?'selected':'' ?>>Published</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Published At (Y-m-d H:i:s)</label>
          <input type="text" name="published_at" value="<?= esc(old('published_at', $post['published_at'] ?? '')) ?>" class="form-control">
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="/admin/posts">Cancel</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

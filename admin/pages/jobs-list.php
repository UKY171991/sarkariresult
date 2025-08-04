<?php
require_once '../config.php';
requireLogin();

$page_title = 'Jobs Management';
$breadcrumb = ['Jobs' => null];

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $db = getDBConnection();
        $stmt = $db->prepare("DELETE FROM jobs WHERE id = ?");
        if ($stmt->execute([$_GET['id']])) {
            $_SESSION['success_message'] = "Job deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to delete job.";
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
    header('Location: jobs-list.php');
    exit();
}

// Get all jobs
try {
    $db = getDBConnection();
    
    // Build query with filters
    $where_clause = "1=1";
    $params = [];
    
    if (isset($_GET['status']) && !empty($_GET['status'])) {
        $where_clause .= " AND status = ?";
        $params[] = $_GET['status'];
    }
    
    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $where_clause .= " AND category = ?";
        $params[] = $_GET['category'];
    }
    
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $where_clause .= " AND (title LIKE ? OR organization LIKE ?)";
        $params[] = '%' . $_GET['search'] . '%';
        $params[] = '%' . $_GET['search'] . '%';
    }
    
    $query = "SELECT * FROM jobs WHERE $where_clause ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    $jobs = $stmt->fetchAll();
    
    // Get categories for filter
    $categories = $db->query("SELECT DISTINCT category FROM jobs ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
    
} catch (Exception $e) {
    $error_message = "Error loading jobs: " . $e->getMessage();
    $jobs = [];
    $categories = [];
}

include '../includes/header.php';
?>

<!-- Content Header (Page header) -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-briefcase mr-2"></i>
          Jobs Management
        </h3>
        <div class="card-tools">
          <a href="jobs-add.php" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i>
            Add New Job
          </a>
        </div>
      </div>
      
      <!-- Filters -->
      <div class="card-body border-bottom">
        <form method="GET" class="row">
          <div class="col-md-3">
            <input type="text" 
                   name="search" 
                   class="form-control" 
                   placeholder="Search jobs..." 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          </div>
          <div class="col-md-2">
            <select name="status" class="form-control">
              <option value="">All Status</option>
              <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
              <option value="inactive" <?php echo (isset($_GET['status']) && $_GET['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
              <option value="expired" <?php echo (isset($_GET['status']) && $_GET['status'] == 'expired') ? 'selected' : ''; ?>>Expired</option>
            </select>
          </div>
          <div class="col-md-2">
            <select name="category" class="form-control">
              <option value="">All Categories</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] == $category) ? 'selected' : ''; ?>>
                  <?php echo ucwords(str_replace('-', ' ', $category)); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-info">
              <i class="fas fa-search mr-1"></i> Filter
            </button>
          </div>
          <div class="col-md-2">
            <a href="jobs-list.php" class="btn btn-secondary">
              <i class="fas fa-undo mr-1"></i> Reset
            </a>
          </div>
        </form>
      </div>
      
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Organization</th>
              <th>Category</th>
              <th>Posts</th>
              <th>Last Date</th>
              <th>Status</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($jobs)): ?>
              <?php foreach ($jobs as $job): ?>
                <tr>
                  <td><?php echo $job['id']; ?></td>
                  <td>
                    <strong><?php echo htmlspecialchars($job['title']); ?></strong>
                    <?php if ($job['qualification']): ?>
                      <br><small class="text-muted"><?php echo htmlspecialchars($job['qualification']); ?></small>
                    <?php endif; ?>
                  </td>
                  <td><?php echo htmlspecialchars($job['organization']); ?></td>
                  <td>
                    <span class="badge badge-info">
                      <?php echo ucwords(str_replace('-', ' ', $job['category'])); ?>
                    </span>
                  </td>
                  <td><?php echo number_format($job['posts']); ?></td>
                  <td>
                    <?php if ($job['last_date']): ?>
                      <?php 
                      $last_date = strtotime($job['last_date']);
                      $is_expired = $last_date < time();
                      ?>
                      <span class="<?php echo $is_expired ? 'text-danger' : 'text-success'; ?>">
                        <?php echo date('d M Y', $last_date); ?>
                      </span>
                    <?php else: ?>
                      <span class="text-muted">Not set</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="badge <?php echo getStatusBadge($job['status']); ?>">
                      <?php echo ucfirst($job['status']); ?>
                    </span>
                  </td>
                  <td><?php echo formatAdminDate($job['created_at']); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="../latest-jobs.php?id=<?php echo $job['id']; ?>" 
                         class="btn btn-sm btn-outline-primary" 
                         target="_blank"
                         title="View on Site">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="jobs-edit.php?id=<?php echo $job['id']; ?>" 
                         class="btn btn-sm btn-outline-info"
                         title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="jobs-list.php?action=delete&id=<?php echo $job['id']; ?>" 
                         class="btn btn-sm btn-outline-danger btn-delete"
                         data-name="<?php echo htmlspecialchars($job['title']); ?>"
                         title="Delete">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center text-muted py-4">
                  <i class="fas fa-inbox fa-3x mb-3"></i><br>
                  No jobs found
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6">
            <small class="text-muted">
              Showing <?php echo count($jobs); ?> jobs
            </small>
          </div>
          <div class="col-sm-6 text-right">
            <a href="jobs-add.php" class="btn btn-primary">
              <i class="fas fa-plus mr-1"></i>
              Add New Job
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>

<?php include '../includes/footer.php'; ?>

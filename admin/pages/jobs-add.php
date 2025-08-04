<?php
require_once '../config.php';
requireLogin();

$page_title = 'Add New Job';
$breadcrumb = ['Jobs' => 'jobs-list.php', 'Add Job' => null];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db = getDBConnection();
        
        $title = sanitizeInput($_POST['title']);
        $organization = sanitizeInput($_POST['organization']);
        $category = sanitizeInput($_POST['category']);
        $posts = (int)$_POST['posts'];
        $qualification = sanitizeInput($_POST['qualification']);
        $state = sanitizeInput($_POST['state']);
        $last_date = !empty($_POST['last_date']) ? $_POST['last_date'] : null;
        $apply_link = sanitizeInput($_POST['apply_link']);
        $description = $_POST['description']; // Don't sanitize HTML content
        $status = sanitizeInput($_POST['status']);
        
        $stmt = $db->prepare("
            INSERT INTO jobs (title, organization, category, posts, qualification, state, last_date, apply_link, description, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        if ($stmt->execute([$title, $organization, $category, $posts, $qualification, $state, $last_date, $apply_link, $description, $status])) {
            $_SESSION['success_message'] = "Job added successfully.";
            header('Location: jobs-list.php');
            exit();
        } else {
            $error_message = "Failed to add job.";
        }
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Get categories
try {
    $db = getDBConnection();
    $categories = $db->query("SELECT * FROM categories WHERE status = 'active' ORDER BY name")->fetchAll();
} catch (Exception $e) {
    $categories = [];
}

include '../includes/header.php';
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-plus mr-2"></i>
          Add New Job
        </h3>
        <div class="card-tools">
          <a href="jobs-list.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>
            Back to Jobs
          </a>
        </div>
      </div>
      
      <form method="POST" class="needs-validation" novalidate>
        <div class="card-body">
          <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
              <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error_message; ?>
            </div>
          <?php endif; ?>
          
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="title">Job Title <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control" 
                       id="title" 
                       name="title" 
                       value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>"
                       required>
                <div class="invalid-feedback">
                  Please provide a job title.
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                  <option value="active" <?php echo (isset($_POST['status']) && $_POST['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                  <option value="inactive" <?php echo (isset($_POST['status']) && $_POST['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                  <option value="expired" <?php echo (isset($_POST['status']) && $_POST['status'] == 'expired') ? 'selected' : ''; ?>>Expired</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="organization">Organization <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control" 
                       id="organization" 
                       name="organization" 
                       value="<?php echo isset($_POST['organization']) ? htmlspecialchars($_POST['organization']) : ''; ?>"
                       required>
                <div class="invalid-feedback">
                  Please provide an organization name.
                </div>
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="category">Category <span class="text-danger">*</span></label>
                <select class="form-control select2" id="category" name="category" required>
                  <option value="">Select Category</option>
                  <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['slug']; ?>" 
                            <?php echo (isset($_POST['category']) && $_POST['category'] == $category['slug']) ? 'selected' : ''; ?>>
                      <?php echo $category['name']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  Please select a category.
                </div>
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="posts">Number of Posts</label>
                <input type="number" 
                       class="form-control" 
                       id="posts" 
                       name="posts" 
                       value="<?php echo isset($_POST['posts']) ? $_POST['posts'] : '1'; ?>"
                       min="1">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" 
                       class="form-control" 
                       id="qualification" 
                       name="qualification" 
                       value="<?php echo isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification']) : ''; ?>"
                       placeholder="e.g., Graduate, 12th Pass, ITI">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="state">State/Location</label>
                <input type="text" 
                       class="form-control" 
                       id="state" 
                       name="state" 
                       value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>"
                       placeholder="e.g., All India, Bihar">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="last_date">Last Date to Apply</label>
                <input type="date" 
                       class="form-control" 
                       id="last_date" 
                       name="last_date" 
                       value="<?php echo isset($_POST['last_date']) ? $_POST['last_date'] : ''; ?>">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="apply_link">Application Link</label>
            <input type="url" 
                   class="form-control" 
                   id="apply_link" 
                   name="apply_link" 
                   value="<?php echo isset($_POST['apply_link']) ? htmlspecialchars($_POST['apply_link']) : ''; ?>"
                   placeholder="https://example.com/apply">
          </div>
          
          <div class="form-group">
            <label for="description">Job Description</label>
            <textarea class="form-control summernote" 
                      id="description" 
                      name="description" 
                      rows="8"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
            <small class="form-text text-muted">
              Provide detailed information about the job, requirements, selection process, etc.
            </small>
          </div>
        </div>
        
        <div class="card-footer">
          <div class="row">
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                Save Job
              </button>
              <a href="jobs-list.php" class="btn btn-secondary ml-2">
                <i class="fas fa-times mr-1"></i>
                Cancel
              </a>
            </div>
            <div class="col-md-6 text-right">
              <small class="text-muted">
                <i class="fas fa-info-circle mr-1"></i>
                All fields marked with <span class="text-danger">*</span> are required
              </small>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

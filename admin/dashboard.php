<?php
require_once 'config.php';
requireLogin();

$page_title = 'Dashboard';

// Get dashboard statistics
try {
    $db = getDBConnection();
    
    // Count total records
    $stats = [];
    
    // Jobs statistics
    $stmt = $db->query("SELECT 
        COUNT(*) as total_jobs,
        COUNT(CASE WHEN status = 'active' THEN 1 END) as active_jobs,
        COUNT(CASE WHEN last_date >= date('now') THEN 1 END) as open_jobs
        FROM jobs");
    $stats['jobs'] = $stmt->fetch();
    
    // Results statistics
    $stmt = $db->query("SELECT 
        COUNT(*) as total_results,
        COUNT(CASE WHEN status = 'active' THEN 1 END) as active_results
        FROM results");
    $stats['results'] = $stmt->fetch();
    
    // Admit cards statistics
    $stmt = $db->query("SELECT 
        COUNT(*) as total_admit_cards,
        COUNT(CASE WHEN status = 'available' THEN 1 END) as available_admit_cards
        FROM admit_cards");
    $stats['admit_cards'] = $stmt->fetch();
    
    // Answer keys statistics
    $stmt = $db->query("SELECT 
        COUNT(*) as total_answer_keys,
        COUNT(CASE WHEN status = 'active' THEN 1 END) as active_answer_keys
        FROM answer_keys");
    $stats['answer_keys'] = $stmt->fetch();
    
    // Contact messages statistics
    $stmt = $db->query("SELECT 
        COUNT(*) as total_messages,
        COUNT(CASE WHEN status = 'new' THEN 1 END) as unread_messages
        FROM contact_messages");
    $stats['messages'] = $stmt->fetch();
    
    // Recent activities
    $recent_jobs = $db->query("SELECT title, organization, created_at FROM jobs ORDER BY created_at DESC LIMIT 5")->fetchAll();
    $recent_messages = $db->query("SELECT name, subject, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
    
    // Monthly statistics for chart
    $monthly_stats = $db->query("
        SELECT 
            strftime('%Y-%m', created_at) as month,
            COUNT(CASE WHEN 'jobs' THEN 1 END) as jobs_count
        FROM jobs 
        WHERE created_at >= date('now', '-12 months')
        GROUP BY strftime('%Y-%m', created_at)
        ORDER BY month
    ")->fetchAll();
    
} catch (Exception $e) {
    $error_message = "Error loading dashboard data: " . $e->getMessage();
}

include 'includes/header.php';
?>

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo $stats['jobs']['total_jobs'] ?? 0; ?></h3>
        <p>Total Jobs</p>
      </div>
      <div class="icon">
        <i class="fas fa-briefcase"></i>
      </div>
      <a href="pages/jobs-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo $stats['results']['total_results'] ?? 0; ?></h3>
        <p>Results Published</p>
      </div>
      <div class="icon">
        <i class="fas fa-poll"></i>
      </div>
      <a href="pages/results-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo $stats['admit_cards']['total_admit_cards'] ?? 0; ?></h3>
        <p>Admit Cards</p>
      </div>
      <div class="icon">
        <i class="fas fa-id-card"></i>
      </div>
      <a href="pages/admit-cards-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo $stats['messages']['unread_messages'] ?? 0; ?></h3>
        <p>Unread Messages</p>
      </div>
      <div class="icon">
        <i class="fas fa-envelope"></i>
      </div>
      <a href="pages/messages.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-7 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Website Statistics
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#jobs-chart" data-toggle="tab">Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#results-chart" data-toggle="tab">Results</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Jobs -->
          <div class="chart tab-pane active" id="jobs-chart" style="position: relative; height: 300px;">
            <canvas id="jobsChart" height="300" style="height: 300px;"></canvas>
          </div>
          <div class="chart tab-pane" id="results-chart" style="position: relative; height: 300px;">
            <canvas id="resultsChart" height="300" style="height: 300px;"></canvas>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Recent Jobs -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-briefcase mr-1"></i>
          Recent Jobs
        </h3>
        <div class="card-tools">
          <a href="pages/jobs-add.php" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Job
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Organization</th>
                <th>Date Added</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recent_jobs)): ?>
                <?php foreach ($recent_jobs as $job): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($job['title']); ?></td>
                    <td><?php echo htmlspecialchars($job['organization']); ?></td>
                    <td><?php echo formatAdminDate($job['created_at']); ?></td>
                    <td>
                      <a href="pages/jobs-edit.php?id=<?php echo $job['id']; ?>" class="btn btn-sm btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" class="text-center text-muted">No jobs found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="pages/jobs-add.php" class="btn btn-sm btn-info float-left">Add New Job</a>
        <a href="pages/jobs-list.php" class="btn btn-sm btn-secondary float-right">View All Jobs</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.Left col -->
  
  <!-- Right col (fixed) -->
  <section class="col-lg-5 connectedSortable">
    <!-- Quick Actions -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-rocket mr-1"></i>
          Quick Actions
        </h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <a href="pages/jobs-add.php" class="btn btn-primary btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Job
            </a>
          </div>
          <div class="col-6">
            <a href="pages/results-add.php" class="btn btn-success btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Result
            </a>
          </div>
          <div class="col-6">
            <a href="pages/admit-cards-add.php" class="btn btn-warning btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Admit Card
            </a>
          </div>
          <div class="col-6">
            <a href="pages/answer-keys-add.php" class="btn btn-info btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Answer Key
            </a>
          </div>
          <div class="col-6">
            <a href="pages/admissions-add.php" class="btn btn-secondary btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Admission
            </a>
          </div>
          <div class="col-6">
            <a href="pages/syllabus-add.php" class="btn btn-dark btn-block mb-2">
              <i class="fas fa-plus mr-1"></i> Add Syllabus
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Messages -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-envelope mr-1"></i>
          Recent Messages
        </h3>
        <div class="card-tools">
          <span class="badge badge-danger"><?php echo $stats['messages']['unread_messages'] ?? 0; ?></span>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
              <?php if (!empty($recent_messages)): ?>
                <?php foreach ($recent_messages as $message): ?>
                  <tr>
                    <td class="mailbox-name">
                      <a href="pages/messages.php"><?php echo htmlspecialchars($message['name']); ?></a>
                    </td>
                    <td class="mailbox-subject">
                      <?php echo truncateAdminText($message['subject'], 30); ?>
                    </td>
                    <td class="mailbox-date">
                      <?php echo formatAdminDate($message['created_at']); ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center text-muted">No messages found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <a href="pages/messages.php" class="uppercase">View All Messages</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

    <!-- System Info -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-info-circle mr-1"></i>
          System Information
        </h3>
      </div>
      <div class="card-body">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-info"><i class="fas fa-database"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Database</span>
            <span class="info-box-number">SQLite</span>
          </div>
        </div>
        
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success"><i class="fab fa-php"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">PHP Version</span>
            <span class="info-box-number"><?php echo PHP_VERSION; ?></span>
          </div>
        </div>
        
        <div class="info-box">
          <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Server Time</span>
            <span class="info-box-number"><?php echo date('H:i'); ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.Right col -->
</div>
<!-- /.row (main row) -->

<?php
$custom_js = "
<script>
// Charts configuration
const ctx1 = document.getElementById('jobsChart').getContext('2d');
const jobsChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Active Jobs', 'Expired Jobs', 'Draft Jobs'],
        datasets: [{
            data: [" . ($stats['jobs']['active_jobs'] ?? 0) . ", " . (($stats['jobs']['total_jobs'] ?? 0) - ($stats['jobs']['active_jobs'] ?? 0)) . ", 0],
            backgroundColor: ['#17a2b8', '#dc3545', '#ffc107']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const ctx2 = document.getElementById('resultsChart').getContext('2d');
const resultsChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Results', 'Admit Cards', 'Answer Keys'],
        datasets: [{
            label: 'Count',
            data: [" . ($stats['results']['total_results'] ?? 0) . ", " . ($stats['admit_cards']['total_admit_cards'] ?? 0) . ", " . ($stats['answer_keys']['total_answer_keys'] ?? 0) . "],
            backgroundColor: ['#28a745', '#ffc107', '#17a2b8']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
";

include 'includes/footer.php';
?>

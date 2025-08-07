<?php
session_start();
require_once 'config.php';
requireLogin();

// Set page variables
$page_title = 'Dashboard';
$page_description = 'Administrative Dashboard';
$current_page = 'dashboard';

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
            COUNT(*) as jobs_count
        FROM jobs 
        WHERE created_at >= date('now', '-12 months')
        GROUP BY strftime('%Y-%m', created_at)
        ORDER BY month
    ")->fetchAll();
    
} catch (Exception $e) {
    $error_message = "Error loading dashboard data: " . $e->getMessage();
    $stats = ['jobs' => ['total_jobs' => 0, 'active_jobs' => 0, 'open_jobs' => 0],
              'results' => ['total_results' => 0, 'active_results' => 0],
              'admit_cards' => ['total_admit_cards' => 0, 'available_admit_cards' => 0],
              'answer_keys' => ['total_answer_keys' => 0, 'active_answer_keys' => 0],
              'messages' => ['total_messages' => 0, 'unread_messages' => 0]];
    $recent_jobs = [];
    $recent_messages = [];
    $monthly_stats = [];
}

include 'layouts/header.php';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
    <?php if (isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-ban"></i> Error!</h5>
      <?php echo htmlspecialchars($error_message); ?>
    </div>
    <?php endif; ?>

    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Jobs</span>
            <span class="info-box-number"><?php echo $stats['jobs']['total_jobs'] ?? 0; ?></span>
            <div class="progress">
              <div class="progress-bar bg-info" style="width: <?php echo ($stats['jobs']['active_jobs'] ?? 0) > 0 ? round(($stats['jobs']['active_jobs'] / $stats['jobs']['total_jobs']) * 100) : 0; ?>%"></div>
            </div>
            <span class="progress-description"><?php echo $stats['jobs']['active_jobs'] ?? 0; ?> Active Jobs</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-poll"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Results</span>
            <span class="info-box-number"><?php echo $stats['results']['total_results'] ?? 0; ?></span>
            <div class="progress">
              <div class="progress-bar bg-success" style="width: <?php echo ($stats['results']['active_results'] ?? 0) > 0 ? round(($stats['results']['active_results'] / $stats['results']['total_results']) * 100) : 0; ?>%"></div>
            </div>
            <span class="progress-description"><?php echo $stats['results']['active_results'] ?? 0; ?> Active</span>
          </div>
        </div>
      </div>

      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-id-card"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Admit Cards</span>
            <span class="info-box-number"><?php echo $stats['admit_cards']['total_admit_cards'] ?? 0; ?></span>
            <div class="progress">
              <div class="progress-bar bg-warning" style="width: <?php echo ($stats['admit_cards']['available_admit_cards'] ?? 0) > 0 ? round(($stats['admit_cards']['available_admit_cards'] / $stats['admit_cards']['total_admit_cards']) * 100) : 0; ?>%"></div>
            </div>
            <span class="progress-description"><?php echo $stats['admit_cards']['available_admit_cards'] ?? 0; ?> Available</span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-envelope"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Messages</span>
            <span class="info-box-number"><?php echo $stats['messages']['total_messages'] ?? 0; ?></span>
            <div class="progress">
              <div class="progress-bar bg-danger" style="width: <?php echo ($stats['messages']['unread_messages'] ?? 0) > 0 ? round(($stats['messages']['unread_messages'] / $stats['messages']['total_messages']) * 100) : 0; ?>%"></div>
            </div>
            <span class="progress-description"><?php echo $stats['messages']['unread_messages'] ?? 0; ?> Unread</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Statistics Overview
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">Recent Messages</h3>
            <div class="card-tools">
              <span title="<?php echo count($recent_messages); ?> Messages" class="badge badge-primary"><?php echo count($recent_messages); ?></span>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="direct-chat-messages">
              <?php if (empty($recent_messages)): ?>
                <div class="direct-chat-msg">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">System</span>
                    <span class="direct-chat-timestamp float-right"><?php echo date('d M h:i A'); ?></span>
                  </div>
                  <img class="direct-chat-img" src="https://ui-avatars.com/api/?name=System&background=007bff&color=fff" alt="message user image">
                  <div class="direct-chat-text">
                    No recent messages found.
                  </div>
                </div>
              <?php else: ?>
                <?php foreach ($recent_messages as $message): ?>
                <div class="direct-chat-msg">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left"><?php echo htmlspecialchars($message['name']); ?></span>
                    <span class="direct-chat-timestamp float-right"><?php echo date('d M h:i A', strtotime($message['created_at'])); ?></span>
                  </div>
                  <img class="direct-chat-img" src="https://ui-avatars.com/api/?name=<?php echo urlencode($message['name']); ?>&background=007bff&color=fff" alt="message user image">
                  <div class="direct-chat-text">
                    <?php echo htmlspecialchars($message['subject']); ?>
                  </div>
                </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-12">
                <a href="pages/messages.php" class="btn btn-primary btn-block">View All Messages</a>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.Left col -->
      
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <!-- Map card -->
        <div class="card bg-gradient-primary">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-map-marker-alt mr-1"></i>
              Visitors
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="world-map" style="height: 250px; width: 100%;"></div>
          </div>
          <div class="card-footer bg-transparent">
            <div class="row">
              <div class="col-4 text-center">
                <div id="sparkline-1"></div>
                <div class="text-white">Visitors</div>
              </div>
              <div class="col-4 text-center">
                <div id="sparkline-2"></div>
                <div class="text-white">Online</div>
              </div>
              <div class="col-4 text-center">
                <div id="sparkline-3"></div>
                <div class="text-white">Sales</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Calendar -->
        <div class="card bg-gradient-success">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="far fa-calendar-alt"></i>
              Calendar
            </h3>
            <div class="card-tools">
              <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                  <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu" role="menu">
                  <a href="#" class="dropdown-item">Add new event</a>
                  <a href="#" class="dropdown-item">Clear events</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">View calendar</a>
                </div>
              </div>
              <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body pt-0">
            <div id="calendar" style="width: 100%"></div>
          </div>
        </div>

        <!-- TO DO List -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="ion ion-clipboard mr-1"></i>
              Recent Jobs
            </h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm">
                <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <ul class="todo-list" data-widget="todo-list">
              <?php if (empty($recent_jobs)): ?>
                <li>
                  <span class="text">No recent jobs found</span>
                  <small class="badge badge-secondary"><i class="far fa-clock"></i> No data</small>
                </li>
              <?php else: ?>
                <?php foreach ($recent_jobs as $job): ?>
                <li>
                  <span class="text"><?php echo htmlspecialchars($job['title']); ?></span>
                  <small class="badge badge-info"><i class="far fa-building"></i> <?php echo htmlspecialchars($job['organization']); ?></small>
                  <small class="badge badge-secondary"><i class="far fa-clock"></i> <?php echo date('M d', strtotime($job['created_at'])); ?></small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
          <div class="card-footer clearfix">
            <a href="pages/jobs-add.php" class="btn btn-primary float-right">
              <i class="fas fa-plus"></i> Add Job
            </a>
          </div>
        </div>

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
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
// Custom JavaScript for dashboard charts
$custom_js = "
<script>
// Charts configuration
document.addEventListener('DOMContentLoaded', function() {
    // Jobs Chart
    const ctx1 = document.getElementById('revenue-chart-canvas').getContext('2d');
    const jobsChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Jobs Posted',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(60,141,188,0.1)',
                borderColor: 'rgba(60,141,188,1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Results Donut Chart
    const ctx2 = document.getElementById('sales-chart-canvas').getContext('2d');
    const resultsChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Active Results', 'Admit Cards', 'Answer Keys'],
            datasets: [{
                data: [" . ($stats['results']['total_results'] ?? 0) . ", " . ($stats['admit_cards']['total_admit_cards'] ?? 0) . ", " . ($stats['answer_keys']['total_answer_keys'] ?? 0) . "],
                backgroundColor: ['#28a745', '#ffc107', '#17a2b8']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Initialize the calendar
    $('#calendar').datetimepicker({
        format: 'L',
        inline: true
    });

    // Initialize sparklines
    $('.sparkline').each(function() {
        var \$this = \$(this);
        \$this.sparkline('html', {
            type: \$this.data('sparkline-type'),
            height: \$this.data('sparkline-height'),
            width: \$this.data('sparkline-width'),
            lineColor: \$this.data('sparkline-line-color'),
            fillColor: \$this.data('sparkline-fill-color'),
            spotColor: \$this.data('sparkline-spot-color')
        });
    });
});
</script>
";

include 'layouts/footer.php';
?>

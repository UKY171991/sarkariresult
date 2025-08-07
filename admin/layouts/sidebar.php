  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../assets/images/logo.svg" alt="Sarkari Result" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Sarkari</b>Result</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://via.placeholder.com/160" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block">
            <?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Administrator'; ?>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo (getCurrentPage() == 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Jobs Management -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'jobs') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'jobs') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Jobs Management
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-info right">
                  <?php 
                  try {
                    $db = getDBConnection();
                    $stmt = $db->query("SELECT COUNT(*) FROM jobs WHERE status = 'active'");
                    echo $stmt->fetchColumn();
                  } catch (Exception $e) { echo '0'; }
                  ?>
                </span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/jobs-list.php" class="nav-link <?php echo (getCurrentPage() == 'jobs-list') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Jobs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/jobs-add.php" class="nav-link <?php echo (getCurrentPage() == 'jobs-add') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Job</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/jobs-categories.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Job Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Results Management -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'results') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'results') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Results Management
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-success right">
                  <?php 
                  try {
                    $stmt = $db->query("SELECT COUNT(*) FROM results WHERE status = 'active'");
                    echo $stmt->fetchColumn();
                  } catch (Exception $e) { echo '0'; }
                  ?>
                </span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/results-list.php" class="nav-link <?php echo (getCurrentPage() == 'results-list') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Results</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/results-add.php" class="nav-link <?php echo (getCurrentPage() == 'results-add') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Result</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Admit Cards -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'admit-cards') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'admit-cards') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Admit Cards
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/admit-cards-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admit Cards</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/admit-cards-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Admit Card</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Answer Keys -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'answer-keys') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'answer-keys') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Answer Keys
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/answer-keys-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Answer Keys</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/answer-keys-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Answer Key</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Admissions -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'admissions') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'admissions') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Admissions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/admissions-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admissions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/admissions-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Admission</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Syllabus -->
          <li class="nav-item <?php echo (strpos(getCurrentPage(), 'syllabus') !== false) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (strpos(getCurrentPage(), 'syllabus') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Syllabus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/syllabus-list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Syllabus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/syllabus-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Syllabus</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Categories -->
          <li class="nav-item">
            <a href="pages/categories.php" class="nav-link <?php echo (getCurrentPage() == 'categories') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>Categories</p>
            </a>
          </li>

          <!-- Contact Messages -->
          <li class="nav-item">
            <a href="pages/messages.php" class="nav-link <?php echo (getCurrentPage() == 'messages') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Contact Messages
                <span class="badge badge-danger right" id="sidebar-message-count">
                  <?php 
                  try {
                    $stmt = $db->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'");
                    echo $stmt->fetchColumn();
                  } catch (Exception $e) { echo '0'; }
                  ?>
                </span>
              </p>
            </a>
          </li>

          <!-- Newsletter Subscribers -->
          <li class="nav-item">
            <a href="pages/newsletter.php" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Newsletter</p>
            </a>
          </li>

          <!-- Divider -->
          <li class="nav-header">SYSTEM</li>

          <!-- Users -->
          <?php if (isAdmin()): ?>
          <li class="nav-item">
            <a href="pages/users.php" class="nav-link <?php echo (getCurrentPage() == 'users') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Users Management</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- Site Settings -->
          <?php if (isAdmin()): ?>
          <li class="nav-item">
            <a href="pages/settings.php" class="nav-link <?php echo (getCurrentPage() == 'settings') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>Site Settings</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- Backup & Restore -->
          <?php if (isAdmin()): ?>
          <li class="nav-item">
            <a href="pages/backup.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>Backup & Restore</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- Profile -->
          <li class="nav-item">
            <a href="profile.php" class="nav-link <?php echo (getCurrentPage() == 'profile') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>My Profile</p>
            </a>
          </li>

          <!-- Logout -->
          <li class="nav-item">
            <a href="logout.php" class="nav-link" onclick="return confirm('Are you sure you want to logout?')">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

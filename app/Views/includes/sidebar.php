<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('/') ?>">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Home</span>
      </a>
    </li>

    <!-- SETTINGS -->
    <li class="nav-item nav-category">SETTINGS</li>

    <!-- Programs -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#programs" aria-expanded="false">
        <i class="mdi mdi-folder-multiple menu-icon"></i>
        <span class="menu-title">Manage Programs</span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="programs">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?= site_url('program_theme') ?>">Program Themes</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('programs') ?>">Manage Programs</a></li>
        </ul>
      </div>
    </li>

    <!-- Centers -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('center') ?>">
        <i class="mdi mdi-map-marker-radius menu-icon"></i>
        <span class="menu-title">Manage Centers</span>
      </a>
    </li>

    <!-- Batches -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('batches') ?>">
        <i class="mdi mdi-calendar-clock menu-icon"></i>
        <span class="menu-title">Manage Batches</span>
      </a>
    </li>

    <!-- Roles
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#rolesRights" aria-expanded="false">
        <i class="mdi mdi-account-key menu-icon"></i>
        <span class="menu-title">Roles & Rights</span>
        <i class="menu-arrow"></i>
      </a> 

      <div class="collapse" id="rolesRights">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?= site_url('roles/manage') ?>">Manage Roles</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('rights/manage') ?>">Manage Rights</a></li>
        </ul>
      </div>
    </li>-->

    <!-- Goal Types -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('goals/types') ?>">
        <i class="mdi mdi-calendar-multiselect menu-icon"></i>
        <span class="menu-title">Goal Types</span>
      </a>
    </li>
    <!-- Goals -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('goals') ?>">
        <i class="mdi mdi-target menu-icon"></i>
        <span class="menu-title">Goals</span>
      </a>
    </li>

    <!-- Expense Heads 
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('expense_heads') ?>">
        <i class="mdi mdi-currency-inr menu-icon"></i>
        <span class="menu-title">Expense Heads</span>
      </a>
    </li>-->

    <!-- Event Types 
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('eventtype') ?>">
        <i class="mdi mdi-calendar-multiselect menu-icon"></i>
        <span class="menu-title">Event Types</span>
      </a>
    </li>-->

    <!-- USERS 
    <li class="nav-item nav-category">Manage Users</li>

    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('users') ?>">
        <i class="mdi mdi-account-circle menu-icon"></i>
        <span class="menu-title">Manage Users</span>
      </a>
    </li> -->

    <!-- Uploads 
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('uploads') ?>">
        <i class="mdi mdi-upload menu-icon"></i>
        <span class="menu-title">Monthly Uploads</span>
      </a>
    </li>-->

    <!-- PROGRAM SECTION -->
    <li class="nav-item nav-category">PROGRAM</li>

    <!-- Manage Students -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#programsSubmenu" aria-expanded="false">
        <i class="mdi mdi-book-multiple menu-icon"></i>
        <span class="menu-title">Manage Students</span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="programsSubmenu">
        <ul class="nav flex-column sub-menu">

          <!-- Vijetaas -->
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#vijetaasSubmenu" aria-expanded="false">
              Vijetaas
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="vijetaasSubmenu">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('students/vijetaas') ?>">All Vijetaas</a>
                </li>

                <!-- <li class="nav-item">
                  <a class="nav-link" href="<?= site_url('students/vijetaas/results') ?>">Results</a>
                </li> -->

              </ul>
            </div>
          </li>

          <!-- Other Programs -->
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('index.php/ManageStudents/DoosraMauka'); ?>">
              Doosra Mauka Participants
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('students/learning_adda') ?>">
              Learning Adda Students
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('digitalshakti') ?>">
              Digital Shakti Students
            </a>
          </li>

        </ul>
      </div>
    </li>

    <!-- Attendance -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#attendanceSubmenu" aria-expanded="false">
        <i class="mdi mdi-calendar-check menu-icon"></i>
        <span class="menu-title">Manage Attendance</span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="attendanceSubmenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="<?= site_url('attendance/class') ?>">Class</a></li>
          <!--<li class="nav-item"><a class="nav-link" href="<?= site_url('attendance/event') ?>">Event</a></li> -->
        </ul>
      </div>
    </li>

    <!-- Results 
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('results') ?>">
        <i class="mdi mdi-file-certificate menu-icon"></i>
        <span class="menu-title">Results</span>
      </a>
    </li>-->

    <!-- FINANCE 
    <li class="nav-item nav-category">Manage Finance</li>

    <li class="nav-item"><a class="nav-link" href="<?= site_url('finance/fees') ?>"><i class="mdi mdi-cash-multiple menu-icon"></i> Fees</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= site_url('finance/donations') ?>"><i class="mdi mdi-currency-inr menu-icon"></i> Donations</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= site_url('finance/assets') ?>"><i class="mdi mdi-package-variant menu-icon"></i> Assets</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= site_url('finance/expenses') ?>"><i class="mdi mdi-cash-minus menu-icon"></i> Expenses</a></li>
    -->
    <!-- EVENTS 
    <li class="nav-item nav-category">Others</li>

    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('events') ?>">
        <i class="mdi mdi-calendar-multiple menu-icon"></i>
        <span class="menu-title">All Events</span>
      </a>
    </li>-->

  </ul>
</nav>
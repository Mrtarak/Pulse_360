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
      <a class="nav-link collapsed"
        data-bs-toggle="collapse"
        href="#programsSubmenu"
        aria-expanded="false">

        <i class="mdi mdi-book-multiple menu-icon"></i>
        <span class="menu-title">Manage Students</span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="programsSubmenu">
        <ul class="nav flex-column sub-menu">


          <!-- ================= Vijetaas ================= -->
          <li class="nav-item">
            <a class="nav-link collapsed"
              data-bs-toggle="collapse"
              href="#vijetaasSubmenu"
              aria-expanded="false">

              Project Vijetaas
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="vijetaasSubmenu">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('students/vijetaas') ?>">
                    All Students
                  </a>
                </li>

                <!-- Future Assessment
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Assessment
                            </a>
                        </li>
                        -->

              </ul>
            </div>
          </li>


          <!-- ================= Learning Adda ================= -->
          <li class="nav-item">
            <a class="nav-link collapsed"
              data-bs-toggle="collapse"
              href="#learningAddaSubmenu"
              aria-expanded="false">

              Learning Adda
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="learningAddaSubmenu">
              <ul class="nav flex-column sub-menu">

                <!-- All Students / Enrollment -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('students/learning_adda') ?>">
                    All Students
                  </a>
                </li>

                <!-- Assessment - Add URL later -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('assessment/learning-adda') ?>">
                    Assessment
                  </a>
                </li>

              </ul>
            </div>
          </li>

          <!-- ================= School Sahyog ================= -->
          <li class="nav-item">
            <a class="nav-link collapsed"
              data-bs-toggle="collapse"
              href="#schoolSahyogSubmenu"
              aria-expanded="false">

              School Sahyog
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="schoolSahyogSubmenu">
              <ul class="nav flex-column sub-menu">

                <!-- All Students / Enrollment -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('students/school_sahyog') ?>">
                    All Students
                  </a>
                </li>

                <!-- Assessment - Add later if required -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('assessment/school-sahyog') ?>">
                    Assessment
                  </a>
                </li>

              </ul>
            </div>
          </li>


          <!-- ================= Digital Shakti ================= -->
          <li class="nav-item">
            <a class="nav-link collapsed"
              data-bs-toggle="collapse"
              href="#digitalShaktiSubmenu"
              aria-expanded="false">

              Digital Shakti
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="digitalShaktiSubmenu">
              <ul class="nav flex-column sub-menu">

                <!-- All Students / Enrollment -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('digitalshakti') ?>">
                    All Students
                  </a>
                </li>

                <!-- Assessment -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('assessment/digital-shakti') ?>">
                    Assessment
                  </a>
                </li>

              </ul>
            </div>
          </li>


          <!-- ================= Doosra Mauka ================= -->
          <li class="nav-item">
            <a class="nav-link collapsed"
              data-bs-toggle="collapse"
              href="#doosraMaukaSubmenu"
              aria-expanded="false">

              Doosra Mauka
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="doosraMaukaSubmenu">
              <ul class="nav flex-column sub-menu">

                <!-- All Participants / Enrollment -->
                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= base_url('index.php/ManageStudents/DoosraMauka'); ?>">
                    All Participants
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link"
                    href="<?= site_url('assessment/doosra-mauka') ?>">
                    Assessment
                  </a>
                </li>

              </ul>
            </div>
          </li>


        </ul>
      </div>
    </li>

    <!-- Attendance -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('attendance/class') ?>">
        <i class="mdi mdi-calendar-check menu-icon"></i>
        <span class="menu-title">Manage Attendance</span>
      </a>
    </li>

    <!-- Results 
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('results') ?>">
        <i class="mdi mdi-file-certificate menu-icon"></i>
        <span class="menu-title">Results</span>
      </a>
    </li>-->


    <!-- ================= Manage Activities ================= -->
    <li class="nav-item">

      <a class="nav-link collapsed"
        data-bs-toggle="collapse"
        href="#activitiesSubmenu"
        aria-expanded="false">

        <i class="mdi mdi-calendar-star menu-icon"></i>

        <span class="menu-title">Manage Activities</span>

        <i class="menu-arrow"></i>

      </a>


      <div class="collapse" id="activitiesSubmenu">

        <ul class="nav flex-column sub-menu">


          <!-- PTM -->
          <li class="nav-item">

            <a class="nav-link"
              href="<?= site_url('activities/ptm') ?>">

              PTM

            </a>

          </li>


          <!-- Home Visit -->
          <li class="nav-item">

            <a class="nav-link"
              href="<?= site_url('activities/home-visit') ?>">

              Home Visit

            </a>

          </li>


        </ul>

      </div>

    </li>

    <!-- FINANCE -->
    <li class="nav-item nav-category"> Finance</li>

    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('fees') ?>">
        <i class="mdi mdi-cash-multiple menu-icon"></i>
        <span class="menu-title">Manage Fees</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('finance/donations') ?>">
        <i class="mdi mdi-currency-inr menu-icon"></i>
        <span class="menu-title">Manage Income</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('finance/assets') ?>">
        <i class="mdi mdi-package-variant menu-icon"></i>
        <span class="menu-title">Manage Assets</span>
      </a>
    </li>

    <!-- EVENTS 
    <li class="nav-item nav-category">Others</li>

    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('events') ?>">
        <i class="mdi mdi-calendar-multiple menu-icon"></i>
        <span class="menu-title">All Events</span>
      </a>
    </li>-->

    <!-- STATIC PAGES -->
    <li class="nav-item nav-category">STATIC PAGES</li>

    <li class="nav-item">

      <a class="nav-link collapsed"
        data-bs-toggle="collapse"
        href="#staticPagesSubmenu"
        aria-expanded="false">

        <i class="mdi mdi-file-document-multiple menu-icon"></i>

        <span class="menu-title">Static Pages</span>

        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="staticPagesSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- LA Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment.html') ?>">
              LA Assessment
            </a>
          </li>

          <!-- LA Assessment Add -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment_Add.html') ?>">
              LA Assessment Add
            </a>
          </li>

          <!-- LA Assessment View -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment_View.html') ?>">
              LA Assessment View
            </a>
          </li>


          <!-- DM Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment.html') ?>">
              DM Assessment
            </a>
          </li>

          <!-- DM Assessment Add -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment_Add.html') ?>">
              DM Assessment Add
            </a>
          </li>

          <!-- DM Assessment View -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment_View.html') ?>">
              DM Assessment View
            </a>
          </li>


          <!-- SS Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment.html') ?>">
              SS Assessment
            </a>
          </li>

          <!-- SS Assessment Add -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment_Add.html') ?>">
              SS Assessment Add
            </a>
          </li>

          <!-- SS Assessment View -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment_View.html') ?>">
              SS Assessment View
            </a>
          </li>


          <!-- DS Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DS_Assessment.html') ?>">
              DS Assessment
            </a>
          </li>


          <!-- DM Income Generation -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Income_Generation.html') ?>">
              DM Income Generation
            </a>
          </li>


          <!-- Daily Session Update -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/Daily_Session_Update.html') ?>">
              Daily Session Update
            </a>
          </li>


          <!-- LA PTM -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_PTM.html') ?>">
              LA PTM
            </a>
          </li>

        </ul>

      </div>

    </li>

  </ul>
</nav>
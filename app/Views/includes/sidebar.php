<?php

use Config\CorePrograms;
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav">

    <!-- =========================================================
         HOME
    ========================================================== -->
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('/') ?>">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>


    <!-- =========================================================
         SETTINGS
    ========================================================== -->
    <li class="nav-item nav-category">SETTINGS</li>


    <!-- =========================================================
         MANAGE PROGRAMS
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#programs"
        aria-expanded="false">

        <i class="mdi mdi-folder-multiple menu-icon"></i>
        <span class="menu-title">Manage Programs</span>
        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="programs">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('program_theme') ?>">
              Program Themes
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('programs') ?>">
              Manage Programs
            </a>
          </li>

        </ul>

      </div>

    </li>


    <!-- =========================================================
         MANAGE CENTERS
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('center') ?>">

        <i class="mdi mdi-map-marker-radius menu-icon"></i>
        <span class="menu-title">Manage Centers</span>

      </a>

    </li>


    <!-- =========================================================
         MANAGE BATCHES
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('batches') ?>">

        <i class="mdi mdi-calendar-clock menu-icon"></i>
        <span class="menu-title">Manage Batches</span>

      </a>

    </li>


    <!-- =========================================================
         GOAL TYPES
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('goals/types') ?>">

        <i class="mdi mdi-calendar-multiselect menu-icon"></i>
        <span class="menu-title">Goal Types</span>

      </a>

    </li>


    <!-- =========================================================
         GOALS
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('goals') ?>">

        <i class="mdi mdi-target menu-icon"></i>
        <span class="menu-title">Goals</span>

      </a>

    </li>


    <!-- =========================================================
         PROGRAM
    ========================================================== -->
    <li class="nav-item nav-category">PROGRAM</li>


    <!-- =========================================================
         PROJECT VIJETAAS
    ========================================================== -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#vijetaasProgramSubmenu"
        aria-expanded="false">

        <i class="mdi mdi-account-group menu-icon"></i>
        <span class="menu-title">Project Vijetaas</span>
        <i class="menu-arrow"></i>

      </a>


      <div class="collapse" id="vijetaasProgramSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- All Students -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('students/vijetaas') ?>">
              All Students
            </a>
          </li>


        </ul>

      </div>

    </li>


    <!-- LEARNING ADDA -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#learningAddaSubmenu"
        aria-expanded="false">

        <!-- Learning Adda -->
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">Learning Adda</span>
        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="learningAddaSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- All Students -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('students/learning_adda') ?>">
              All Students
            </a>
          </li>

          <!-- Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('assessment/learning-adda') ?>">
              Assessment
            </a>
          </li>

          <!-- Attendance -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('attendance/class?program_id=' . CorePrograms::LEARNING_ADDA) ?>">
              Attendance
            </a>
          </li>

          <!-- Fees -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('fees?program_id=' . CorePrograms::LEARNING_ADDA) ?>">
              Fees
            </a>
          </li>

        </ul>

      </div>

    </li>


    <!-- SCHOOL SAHYOG -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#schoolSahyogSubmenu"
        aria-expanded="false">

        <!-- School Sahyog -->
        <i class="mdi mdi-school-outline menu-icon"></i>
        <span class="menu-title">School Sahyog</span>
        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="schoolSahyogSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- All Students -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('students/school_sahyog') ?>">
              All Students
            </a>
          </li>

          <!-- Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('assessment/school-sahyog') ?>">
              Assessment
            </a>
          </li>

          <!-- Attendance -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('attendance/class?program_id=' . CorePrograms::SCHOOL_SAHYOG) ?>">
              Attendance
            </a>
          </li>

          <!-- Fees -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('fees?program_id=' . CorePrograms::SCHOOL_SAHYOG) ?>">
              Fees
            </a>
          </li>

        </ul>

      </div>

    </li>


    <!-- DIGITAL SHAKTI -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#digitalShaktiSubmenu"
        aria-expanded="false">

        <!-- Digital Shakti -->
        <i class="mdi mdi-laptop menu-icon"></i>
        <span class="menu-title">Digital Shakti</span>
        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="digitalShaktiSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- All Students -->
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

          <!-- Attendance -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('attendance/class?program_id=' . CorePrograms::DIGITAL_SHAKTI) ?>">
              Attendance
            </a>
          </li>

          <!-- Fees -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('fees?program_id=' . CorePrograms::DIGITAL_SHAKTI) ?>">
              Fees
            </a>
          </li>

        </ul>

      </div>

    </li>


    <!-- DOOSRA MAUKA -->
    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#doosraMaukaSubmenu"
        aria-expanded="false">

        <!-- Doosra Mauka -->
        <i class="mdi mdi-account-convert-outline menu-icon"></i>
        <span class="menu-title">Doosra Mauka</span>
        <i class="menu-arrow"></i>

      </a>

      <div class="collapse" id="doosraMaukaSubmenu">

        <ul class="nav flex-column sub-menu">

          <!-- All Students -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('ManageStudents/DoosraMauka') ?>">
              All Students
            </a>
          </li>

          <!-- Assessment -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('assessment/doosra-mauka') ?>">
              Assessment
            </a>
          </li>

          <!-- Attendance -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('attendance/class?program_id=' . CorePrograms::DOOSRA_MAUKA) ?>">
              Attendance
            </a>
          </li>

          <!-- Fees -->
          <li class="nav-item">
            <a class="nav-link"
              href="<?= site_url('fees?program_id=' . CorePrograms::DOOSRA_MAUKA) ?>">
              Fees
            </a>
          </li>

        </ul>

      </div>

    </li>


    <!-- =========================================================
         FINANCE
    ========================================================== 
    <li class="nav-item nav-category">FINANCE</li>-->


    <!-- Manage Fees 
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('fees') ?>">

        <i class="mdi mdi-cash-multiple menu-icon"></i>
        <span class="menu-title">Manage Fees</span>

      </a>

    </li>-->


    <!-- Manage Income 
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('finance/donations') ?>">

        <i class="mdi mdi-currency-inr menu-icon"></i>
        <span class="menu-title">Manage Income</span>

      </a>

    </li>-->


    <!-- Manage Assets 
    <li class="nav-item">

      <a class="nav-link"
        href="<?= site_url('finance/assets') ?>">

        <i class="mdi mdi-package-variant menu-icon"></i>
        <span class="menu-title">Manage Assets</span>

      </a>

    </li>-->


    <!-- =========================================================
         STATIC PAGES
    ========================================================== -->
    <li class="nav-item nav-category">STATIC PAGES</li>


    <li class="nav-item">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#staticPagesSubmenu"
        aria-expanded="false">

        <i class="mdi mdi-file-document-multiple menu-icon"></i>
        <span class="menu-title">Static Pages</span>
        <i class="menu-arrow"></i>

      </a>


      <div class="collapse" id="staticPagesSubmenu">

        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment.html') ?>">
              LA Assessment
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment_Add.html') ?>">
              LA Assessment Add
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/LA_Assessment_View.html') ?>">
              LA Assessment View
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment.html') ?>">
              DM Assessment
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment_Add.html') ?>">
              DM Assessment Add
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Assessment_View.html') ?>">
              DM Assessment View
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment.html') ?>">
              SS Assessment
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment_Add.html') ?>">
              SS Assessment Add
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/SS_Assessment_View.html') ?>">
              SS Assessment View
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DS_Assessment.html') ?>">
              DS Assessment
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/DM_Income_Generation.html') ?>">
              DM Income Generation
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link"
              href="<?= base_url('static-pages/Daily_Session_Update.html') ?>">
              Daily Session Update
            </a>
          </li>

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


<style>
  /* =========================================================
   SIDEBAR BACKGROUND
========================================================= */

  html body .sidebar,
  html body .sidebar.sidebar-offcanvas {

    background-color: #1B4482 !important;
    background-image: none !important;

  }


  /* =========================================================
   SIDEBAR TEXT
========================================================= */

  html body .sidebar .nav .nav-item .nav-link,
  html body .sidebar .nav .nav-item .nav-link .menu-title {

    color: #ffffff !important;

  }


  html body .sidebar .nav .nav-item .nav-link .menu-icon,
  html body .sidebar .nav .nav-item .menu-arrow {

    color: #ffffff !important;

  }


  /* =========================================================
   CATEGORY
========================================================= */

  html body .sidebar .nav .nav-item.nav-category {

    color: rgba(255, 255, 255, 0.70) !important;

  }


  /* =========================================================
   NORMAL HOVER
========================================================= */

  html body .sidebar .nav .nav-item .nav-link:hover {

    background-color: rgba(255, 255, 255, 0.18) !important;
    color: #ffffff !important;

    border-radius: 6px !important;

    font-weight: 600 !important;

  }


  html body .sidebar .nav .nav-item .nav-link:hover .menu-title {

    color: #ffffff !important;

  }


  html body .sidebar .nav .nav-item .nav-link:hover .menu-icon,
  html body .sidebar .nav .nav-item .nav-link:hover .menu-arrow {

    color: #ffffff !important;

  }


  /* =========================================================
   SUB MENU
========================================================= */

  html body .sidebar .nav .sub-menu {

    background-color: transparent !important;

  }


  html body .sidebar .nav .sub-menu .nav-item .nav-link {

    color: #ffffff !important;

  }


  html body .sidebar .nav .sub-menu .nav-item .nav-link:hover {

    background-color: rgba(255, 255, 255, 0.15) !important;
    color: #ffffff !important;

    border-radius: 5px !important;

    font-weight: 600 !important;

  }


  /* =========================================================
   ACTIVE MENU
========================================================= */

  html body .sidebar .nav .nav-item.active>.nav-link {

    background-color: rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;

    border-radius: 6px !important;

  }


  html body .sidebar .nav .nav-item.active>.nav-link .menu-title,
  html body .sidebar .nav .nav-item.active>.nav-link .menu-icon,
  html body .sidebar .nav .nav-item.active>.nav-link .menu-arrow {

    color: #ffffff !important;

  }


  /* =========================================================
   OPEN PARENT MENU
========================================================= */

  html body .sidebar .nav .nav-item.active>.nav-link,
  html body .sidebar .nav .nav-item.show>.nav-link {

    background-color: rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;

  }


  html body .sidebar .nav .nav-item.active>.nav-link:hover,
  html body .sidebar .nav .nav-item.show>.nav-link:hover {

    background-color: rgba(255, 255, 255, 0.18) !important;
    color: #ffffff !important;

  }


  /* =========================================================
   REMOVE FOCUS EFFECT
========================================================= */

  html body .sidebar .nav .nav-item .nav-link:focus {

    outline: none !important;
    box-shadow: none !important;

  }


  /* =========================================================
   COLLAPSED SIDEBAR
========================================================= */

  html body.sidebar-icon-only .sidebar {

    background-color: #1B4482 !important;
    background-image: none !important;

  }


  html body.sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-icon {

    color: #ffffff !important;

  }


  /* =========================================================
   COLLAPSED SIDEBAR HOVER
========================================================= */

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover>.nav-link {

    background-color: #ffffff !important;
    color: #1B4482 !important;

    border-radius: 6px !important;

  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover>.nav-link .menu-icon {

    color: #1B4482 !important;

  }


  /* =========================================================
   COLLAPSED POPUP
========================================================= */

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .collapse,
  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu {

    background-color: #ffffff !important;

  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link {

    color: #1B4482 !important;

  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link:hover {

    background-color: #eef2ff !important;
    color: #1B4482 !important;

  }


  /* =========================================================
   SIDEBAR PSEUDO ELEMENTS
========================================================= */

  html body .sidebar::before,
  html body .sidebar::after {

    background: transparent !important;

  }
</style>


<script>
  /* =========================================================
     PULSE 360 SIDEBAR ACTIVE MENU HANDLER
     
     Supports:
     1. Normal exact URL matching
     2. Query-string matching for program-specific pages
     
     Example:
     /attendance/class?program_id=PRG_LA
     /attendance/class?program_id=PRG_DM
     
     These will now be treated as DIFFERENT menu items.
  ========================================================== */

  (function() {

    /*
     =========================================================
     NORMALIZE PATH
    =========================================================
    */

    function normalizePath(path) {

      if (!path) {
        return '/';
      }

      /*
       * Remove query string and hash
       * ONLY from the pathname itself.
       */

      path = path.split('?')[0];
      path = path.split('#')[0];


      /*
       * Remove trailing slash
       * except root /
       */

      if (path.length > 1) {

        path = path.replace(/\/+$/, '');

      }


      return path.toLowerCase();

    }


    /*
     =========================================================
     GET URL OBJECT
    =========================================================
    */

    function getLinkUrl(link) {

      try {

        return new URL(
          link.getAttribute('href'),
          window.location.href
        );

      } catch (e) {

        return null;

      }

    }


    /*
     =========================================================
     GET PROGRAM ID
     
     Returns:
     
     PRG_LA
     PRG_DM
     PRG_DS
     PRG_SS
     etc.
     
     If no program_id exists, returns null.
    =========================================================
    */

    function getProgramId(url) {

      if (!url) {
        return null;
      }


      return url.searchParams.get('program_id');

    }


    /*
     =========================================================
     CLEAR ACTIVE STATES
    =========================================================
    */

    function clearActiveStates() {

      /*
       * Remove active from every nav item.
       */

      document
        .querySelectorAll('#sidebar .nav-item.active')
        .forEach(function(item) {

          item.classList.remove('active');

        });


      /*
       * Remove active from every nav link.
       */

      document
        .querySelectorAll('#sidebar .nav-link.active')
        .forEach(function(link) {

          link.classList.remove('active');

        });


      /*
       * Close previously opened collapses.
       *
       * We only remove .show from sidebar collapses.
       */

      document
        .querySelectorAll('#sidebar .collapse.show')
        .forEach(function(collapse) {

          collapse.classList.remove('show');

          collapse.style.height = '';

        });


      /*
       * Reset aria-expanded.
       */

      document
        .querySelectorAll(
          '#sidebar .nav-link[data-bs-toggle="collapse"]'
        )
        .forEach(function(link) {

          link.setAttribute(
            'aria-expanded',
            'false'
          );

        });

    }


    /*
     =========================================================
     CHECK WHETHER TWO LINKS MATCH
     
     IMPORTANT:
     
     Normal links:
       /goals
     
     match only:
       /goals
     
     They do NOT match:
       /goals/types
     
     
     Program links:
     
       /attendance/class?program_id=PRG_LA
     
     match only:
     
       /attendance/class?program_id=PRG_LA
     
     They do NOT match:
     
       /attendance/class?program_id=PRG_DM
    =========================================================
    */

    function linksMatch(linkUrl, currentUrl) {

      if (!linkUrl || !currentUrl) {

        return false;

      }


      /*
       * Compare pathname first.
       */

      var linkPath =
        normalizePath(
          linkUrl.pathname
        );


      var currentPath =
        normalizePath(
          currentUrl.pathname
        );


      /*
       * Path must match exactly.
       */

      if (linkPath !== currentPath) {

        return false;

      }


      /*
       * Get program IDs.
       */

      var linkProgramId =
        getProgramId(linkUrl);


      var currentProgramId =
        getProgramId(currentUrl);


      /*
       * =====================================================
       * PROGRAM-SPECIFIC URL
       * =====================================================
       *
       * If the sidebar link has program_id,
       * current page MUST have the same program_id.
       */

      if (linkProgramId !== null) {

        return (
          currentProgramId !== null &&
          linkProgramId === currentProgramId
        );

      }


      /*
       * =====================================================
       * NORMAL URL
       * =====================================================
       *
       * If sidebar link does NOT have program_id,
       * it should only match when current URL also
       * does NOT have program_id.
       */

      return currentProgramId === null;

    }


    /*
     =========================================================
     SET ACTIVE MENU
    =========================================================
    */

    function setActiveMenu() {

      var sidebar =
        document.getElementById('sidebar');


      if (!sidebar) {

        return;

      }


      /*
       * Current browser URL.
       */

      var currentUrl =
        new URL(
          window.location.href
        );


      /*
       * Clear old active states first.
       */

      clearActiveStates();


      var matchedLink = null;


      /*
       =======================================================
       FIND EXACT MATCH
       =======================================================
       */

      var links =
        sidebar.querySelectorAll(
          '.nav-link[href]:not([href^="#"])'
        );


      links.forEach(function(link) {

        /*
         * If a match has already been found,
         * don't overwrite it.
         */

        if (matchedLink) {

          return;

        }


        var href =
          link.getAttribute('href');


        if (
          !href ||
          href === '#'
        ) {

          return;

        }


        var linkUrl =
          getLinkUrl(link);


        if (!linkUrl) {

          return;

        }


        /*
         * Compare path + program_id.
         */

        if (
          linksMatch(
            linkUrl,
            currentUrl
          )
        ) {

          matchedLink = link;

        }

      });


      /*
       =======================================================
       NO MATCH
       =======================================================
       */

      if (!matchedLink) {

        return;

      }


      /*
       =======================================================
       SELECTED CHILD LINK
       =======================================================
       */

      matchedLink.classList.add(
        'active'
      );


      /*
       =======================================================
       SELECTED CHILD NAV ITEM
       =======================================================
       */

      var currentItem =
        matchedLink.closest(
          '.nav-item'
        );


      if (currentItem) {

        currentItem.classList.add(
          'active'
        );

      }


      /*
       =======================================================
       OPEN ALL PARENT MENUS
       =======================================================
       */

      var parent =
        currentItem;


      while (parent) {

        var parentNav =
          parent.parentElement;


        if (!parentNav) {

          break;

        }


        var parentItem =
          parentNav.closest(
            '.nav-item'
          );


        if (!parentItem) {

          break;

        }


        /*
         * Mark parent active.
         */

        parentItem.classList.add(
          'active'
        );


        /*
         * Find direct collapse belonging
         * to this parent.
         */

        var collapse =
          parentItem.querySelector(
            ':scope > .collapse'
          );


        if (collapse) {

          /*
           * Open submenu.
           */

          collapse.classList.add(
            'show'
          );


          collapse.style.height =
            'auto';


          /*
           * Update Bootstrap aria state.
           */

          var parentLink =
            parentItem.querySelector(
              ':scope > .nav-link'
            );


          if (parentLink) {

            parentLink.setAttribute(
              'aria-expanded',
              'true'
            );

          }

        }


        parent =
          parentItem;

      }

    }


    /*
     =========================================================
     PAGE LOAD
     =========================================================
    */

    window.addEventListener(
      'load',
      function() {

        /*
         * Wait for the theme's sidebar JS.
         */

        setTimeout(
          function() {

            setActiveMenu();

          },
          150
        );

      }
    );


    /*
     =========================================================
     HANDLE BROWSER BACK/FORWARD
     =========================================================
    */

    window.addEventListener(
      'popstate',
      function() {

        setActiveMenu();

      }
    );


  })();
</script>


<style>
  /* =========================================================
   SIDEBAR BASE
========================================================= */

  html body .sidebar,
  html body .sidebar.sidebar-offcanvas {

    background-color: #1B4482 !important;
    background-image: none !important;
  }


  /* =========================================================
   NORMAL MENU TEXT
========================================================= */

  html body .sidebar .nav .nav-item .nav-link,
  html body .sidebar .nav .nav-item .nav-link .menu-title {

    color: #ffffff !important;
  }


  html body .sidebar .nav .nav-item .nav-link .menu-icon,
  html body .sidebar .nav .nav-item .menu-arrow {

    color: #ffffff !important;
  }


  /* =========================================================
   CATEGORY TITLES
========================================================= */

  html body .sidebar .nav .nav-item.nav-category {

    color: rgba(255, 255, 255, 0.70) !important;
  }


  /* =========================================================
   NORMAL HOVER
========================================================= */

  html body .sidebar .nav .nav-item .nav-link:hover {

    background-color: rgba(255, 255, 255, 0.18) !important;
    color: #ffffff !important;

    border-radius: 6px !important;

    font-weight: 600 !important;

    transition: all 0.15s ease-in-out;
  }


  html body .sidebar .nav .nav-item .nav-link:hover .menu-title {

    color: #ffffff !important;
  }


  html body .sidebar .nav .nav-item .nav-link:hover .menu-icon,
  html body .sidebar .nav .nav-item .nav-link:hover .menu-arrow {

    color: #ffffff !important;
  }


  /* =========================================================
   SUB MENU
========================================================= */

  html body .sidebar .nav .sub-menu {

    background-color: transparent !important;
  }


  html body .sidebar .nav .sub-menu .nav-item .nav-link {

    color: #ffffff !important;
  }


  html body .sidebar .nav .sub-menu .nav-item .nav-link:hover {

    background-color: rgba(255, 255, 255, 0.15) !important;
    color: #ffffff !important;

    border-radius: 5px !important;

    font-weight: 600 !important;
  }


  /* =========================================================
   ACTIVE ITEM
   ONLY OUR JS SHOULD CONTROL THIS
========================================================= */

  html body .sidebar .nav .nav-item.active>.nav-link {

    background-color: rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;

    border-radius: 6px !important;
  }


  html body .sidebar .nav .nav-item.active>.nav-link .menu-title,
  html body .sidebar .nav .nav-item.active>.nav-link .menu-icon,
  html body .sidebar .nav .nav-item.active>.nav-link .menu-arrow {

    color: #ffffff !important;
  }


  /* =========================================================
   REMOVE FOCUS BLUE
========================================================= */

  html body .sidebar .nav .nav-item .nav-link:focus {

    outline: none !important;
    box-shadow: none !important;
  }


  /*
   IMPORTANT:
   Do NOT give :focus or :active a permanent background.
*/

  html body .sidebar .nav .nav-item .nav-link:active {

    color: #ffffff !important;
  }


  /* =========================================================
   COLLAPSED SIDEBAR
========================================================= */

  html body.sidebar-icon-only .sidebar {

    background-color: #1B4482 !important;
    background-image: none !important;
  }


  /* Keep icons white normally */

  html body.sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-icon {

    color: #ffffff !important;
  }


  /* =========================================================
   COLLAPSED SIDEBAR HOVER
========================================================= */

  /*
   The theme opens a white popup when hovering
   over an icon in collapsed mode.
*/

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover>.nav-link {

    background-color: #ffffff !important;
    color: #1B4482 !important;

    border-radius: 6px !important;
  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover>.nav-link .menu-title {

    color: #1B4482 !important;
  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover>.nav-link .menu-icon {

    color: #1B4482 !important;
  }


  /* =========================================================
   COLLAPSED POPUP / SUBMENU
========================================================= */

  /*
   THIS fixes the white text on white popup problem.
*/

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .collapse,
  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu {

    background-color: #ffffff !important;
  }


  /* Popup submenu text MUST be dark */

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link {

    color: #1B4482 !important;
  }


  /* Popup submenu text */

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link .menu-title {

    color: #1B4482 !important;
  }


  /* Popup submenu hover */

  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link:hover {

    background-color: #eef2ff !important;
    color: #1B4482 !important;

    border-radius: 5px !important;
  }


  html body.sidebar-icon-only .sidebar .nav .nav-item:hover .sub-menu .nav-link:hover .menu-title {

    color: #1B4482 !important;
  }


  /* =========================================================
   REMOVE SIDEBAR PSEUDO BACKGROUNDS
========================================================= */

  html body .sidebar::before,
  html body .sidebar::after {

    background: transparent !important;
  }
</style>


<style>
  /* =========================================================
   FIX OPEN PARENT MENU BECOMING WHITE
========================================================= */

  /* Manage Programs / Manage Students / Activities /
   Static Pages etc. when submenu is OPEN */

  html body .sidebar .nav .nav-item.active>.nav-link,
  html body .sidebar .nav .nav-item.show>.nav-link {

    background-color: rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;

  }


  /* Keep parent text WHITE */

  html body .sidebar .nav .nav-item.active>.nav-link .menu-title,
  html body .sidebar .nav .nav-item.show>.nav-link .menu-title {

    color: #ffffff !important;

  }


  /* Keep parent icon WHITE */

  html body .sidebar .nav .nav-item.active>.nav-link .menu-icon,
  html body .sidebar .nav .nav-item.show>.nav-link .menu-icon {

    color: #ffffff !important;

  }


  /* Keep arrow WHITE */

  html body .sidebar .nav .nav-item.active>.nav-link .menu-arrow,
  html body .sidebar .nav .nav-item.show>.nav-link .menu-arrow {

    color: #ffffff !important;

  }


  /* =========================================================
   WHEN MOUSE IS ON THE PARENT
========================================================= */

  html body .sidebar .nav .nav-item.active>.nav-link:hover,
  html body .sidebar .nav .nav-item.show>.nav-link:hover {

    background-color: rgba(255, 255, 255, 0.18) !important;
    color: #ffffff !important;

  }


  /* =========================================================
   IMPORTANT:
   Bootstrap collapse uses .show on the SUBMENU.
   Do not allow that .show state to turn the parent white.
========================================================= */

  html body .sidebar .nav .nav-item>.collapse.show {

    background-color: transparent !important;

  }


  /* Parent remains blue even when submenu is open */

  html body .sidebar .nav .nav-item:has(> .collapse.show)>.nav-link {

    background-color: rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;

  }


  html body .sidebar .nav .nav-item:has(> .collapse.show)>.nav-link .menu-title,
  html body .sidebar .nav .nav-item:has(> .collapse.show)>.nav-link .menu-icon,
  html body .sidebar .nav .nav-item:has(> .collapse.show)>.nav-link .menu-arrow {

    color: #ffffff !important;

  }
</style>
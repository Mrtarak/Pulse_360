<!-- app/Views/partials/navbar.php -->

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">

  <!-- =====================================================
       BRAND / LOGO SECTION
       ===================================================== -->
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

    <!-- MENU / PULSE ICON TOGGLE -->
    <div class="me-3 pulse-toggle-wrapper">

      <button
        class="navbar-toggler pulse-sidebar-toggle"
        type="button"
        data-bs-toggle="minimize"
        aria-label="Toggle Sidebar">

        <!-- Hamburger -->
        <span class="icon-menu pulse-menu-icon"></span>

        <!-- Pulse 360 icon shown only when collapsed -->
        <img
          src="<?= base_url('assets/images/pulse360-icon.png') ?>"
          alt="Pulse 360"
          class="pulse-mini-toggle-icon">

      </button>

    </div>


    <!-- =====================================================
         BIG PULSE 360 LOGO
         ===================================================== -->
    <div class="pulse-logo-container">

      <a class="navbar-brand brand-logo" href="<?= base_url('index') ?>">

        <img
          src="<?= base_url('assets/images/pulse360-logo.png') ?>"
          alt="Pulse 360 Logo"
          class="pulse-logo">

      </a>

    </div>

  </div>


  <!-- =====================================================
       RIGHT SIDE NAVBAR
       ===================================================== -->
  <div class="navbar-menu-wrapper d-flex align-items-top">

    <ul class="navbar-nav ms-auto">


      <!-- ===================================================
           NOTIFICATION
           =================================================== -->
      <li class="nav-item dropdown">

        <a
          class="nav-link count-indicator"
          id="notificationDropdown"
          href="#"
          data-bs-toggle="dropdown">

          <i class="icon-bell"></i>

          <span class="count"></span>

        </a>


        <div
          class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
          aria-labelledby="notificationDropdown">

          <a class="dropdown-item py-3 border-bottom">

            <p class="mb-0 fw-medium float-start">
              You have 4 new notifications
            </p>

            <span class="badge badge-pill badge-primary float-end">
              View all
            </span>

          </a>


          <a class="dropdown-item preview-item py-3">

            <div class="preview-thumbnail">
              <i class="mdi mdi-alert m-auto text-primary"></i>
            </div>

            <div class="preview-item-content">

              <h6 class="preview-subject fw-normal text-dark mb-1">
                Application Error
              </h6>

              <p class="fw-light small-text mb-0">
                Just now
              </p>

            </div>

          </a>


          <a class="dropdown-item preview-item py-3">

            <div class="preview-thumbnail">
              <i class="mdi mdi-lock-outline m-auto text-primary"></i>
            </div>

            <div class="preview-item-content">

              <h6 class="preview-subject fw-normal text-dark mb-1">
                Settings
              </h6>

              <p class="fw-light small-text mb-0">
                Private message
              </p>

            </div>

          </a>


          <a class="dropdown-item preview-item py-3">

            <div class="preview-thumbnail">
              <i class="mdi mdi-airballoon m-auto text-primary"></i>
            </div>

            <div class="preview-item-content">

              <h6 class="preview-subject fw-normal text-dark mb-1">
                New user registration
              </h6>

              <p class="fw-light small-text mb-0">
                2 days ago
              </p>

            </div>

          </a>

        </div>

      </li>


      <!-- ===================================================
           USER DROPDOWN
           =================================================== -->
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">

        <a
          class="nav-link"
          id="UserDropdown"
          href="#"
          data-bs-toggle="dropdown"
          aria-expanded="false">

          <img
            class="img-xs rounded-circle"
            src="<?= base_url('assets/images/pulse360-icon.png') ?>"
            alt="Profile image">

        </a>


        <div
          class="dropdown-menu dropdown-menu-right navbar-dropdown"
          aria-labelledby="UserDropdown">

          <div class="dropdown-header text-center">

            <img
              class="img-md rounded-circle"
              src="<?= base_url('assets/images/pulse360-icon.png') ?>"
              alt="Profile image">

            <p class="mb-1 mt-3 fw-semibold">
              Pulse 360
            </p>

            <p class="fw-light text-muted mb-0">
              blueparijaat@gmail.com
            </p>

          </div>


          <a class="dropdown-item">

            <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>

            My Profile

            <span class="badge badge-pill badge-danger">
              1
            </span>

          </a>


          <a class="dropdown-item">

            <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>

            Sign Out

          </a>

        </div>

      </li>

    </ul>


    <!-- =====================================================
         MOBILE MENU
         ===================================================== -->
    <button
      class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
      type="button"
      data-bs-toggle="offcanvas">

      <span class="mdi mdi-menu"></span>

    </button>

  </div>

</nav>


<!-- =========================================================
     PULSE 360 NAVBAR CSS
     ========================================================= -->
<style>
  /* =====================================================
     IMPORTANT:
     DO NOT CHANGE NAVBAR HEIGHT
     Let the existing theme control it.
     ===================================================== */


  /* =====================================================
     BIG LOGO
     ===================================================== */

  .navbar .brand-logo {
    display: flex !important;
    align-items: center;
    padding: 0 !important;
    margin: 0 !important;
  }

  .navbar .pulse-logo {
    width: 220px !important;
    height: auto !important;
    max-height: 75px !important;
    object-fit: contain !important;
    display: block !important;
  }


  /* =====================================================
     LOGO CONTAINER
     ===================================================== */

  .pulse-logo-container {
    display: flex;
    align-items: center;
  }


  /* =====================================================
     TOGGLE BUTTON
     ===================================================== */

  .pulse-toggle-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .pulse-sidebar-toggle {
    width: 40px !important;
    height: 40px !important;

    padding: 0 !important;
    margin: 0 !important;

    display: flex !important;
    align-items: center !important;
    justify-content: center !important;

    border: 0 !important;
    background: transparent !important;

    cursor: pointer;

    transform: none !important;
    -webkit-transform: none !important;
  }


  /* =====================================================
     HAMBURGER ICON
     ===================================================== */

  .pulse-menu-icon {
    display: block !important;

    font-size: 22px;

    transform: none !important;
    -webkit-transform: none !important;
  }


  /* =====================================================
     PULSE ICON
     Hidden when sidebar is open
     ===================================================== */

  .pulse-mini-toggle-icon {
    display: none !important;

    width: 38px !important;
    height: 38px !important;

    object-fit: cover !important;

    border-radius: 10px !important;

    margin: 0 !important;
    padding: 0 !important;

    transform: none !important;
    -webkit-transform: none !important;

    transform-origin: center !important;
  }


  /* =====================================================
     SIDEBAR COLLAPSED
     Hamburger disappears
     Pulse icon appears
     ===================================================== */

  body.sidebar-icon-only .pulse-menu-icon {
    display: none !important;
  }


  body.sidebar-icon-only .pulse-mini-toggle-icon {
    display: block !important;

    width: 38px !important;
    height: 38px !important;

    object-fit: cover !important;

    border-radius: 10px !important;

    transform: none !important;
    -webkit-transform: none !important;

    visibility: visible !important;
    opacity: 1 !important;
  }


  /* =====================================================
     KEEP TOGGLE UPRIGHT
     ===================================================== */

  body.sidebar-icon-only .pulse-sidebar-toggle {
    transform: none !important;
    -webkit-transform: none !important;
  }

  body.sidebar-icon-only .pulse-toggle-wrapper {
    transform: none !important;
    -webkit-transform: none !important;
  }


  /* =====================================================
     HOVER
     ===================================================== */

  body.sidebar-icon-only .pulse-sidebar-toggle:hover .pulse-mini-toggle-icon {

    transform: scale(1.05) !important;
    -webkit-transform: scale(1.05) !important;
  }


  /* =====================================================
     REMOVE ANY OLD MINI LOGO RULES
     ===================================================== */

  .navbar .brand-logo-mini {
    display: none !important;
  }

  /* =====================================================
   PULSE 360 PREMIUM NAVBAR
   ===================================================== */

  html body .navbar,
  html body .navbar-brand-wrapper,
  html body .navbar-menu-wrapper {
    background-color: #1B4482 !important;
    background-image: none !important;
  }


  /* Navbar text & icons */
  html body .navbar .nav-link,
  html body .navbar .icon-menu,
  html body .navbar .icon-bell {
    color: #ffffff !important;
  }
</style>
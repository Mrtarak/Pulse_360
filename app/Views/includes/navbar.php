<?php
// Get logged-in user details from session
$userName  = session()->get('User_Name') ?? 'User';
$userEmail = session()->get('User_Email') ?? '';
$userRole  = session()->get('Role_Name') ?? '';

// Get logged-in user's profile photo path
$userPhoto = trim((string) (session()->get('User_Photo_URL') ?? ''));


// Default profile image
$profileImage = base_url('assets/images/pulse360-icon.png');

// Validate saved profile image path and check that the file exists
$userPhoto = str_replace('\\', '/', $userPhoto);
$userPhoto = ltrim($userPhoto, '/');

if (
  $userPhoto !== '' &&
  strpos($userPhoto, 'uploads/users/') === 0 &&
  !in_array('..', explode('/', $userPhoto), true) &&
  is_file(FCPATH . $userPhoto)
) {
  $profileImage = base_url($userPhoto);
}
?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">

  <!-- LOGO AND SIDEBAR TOGGLE -->
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

    <div class="me-3 pulse-toggle-wrapper">
      <button class="navbar-toggler pulse-sidebar-toggle"
        type="button"
        data-bs-toggle="minimize"
        aria-label="Toggle Sidebar">

        <span class="icon-menu pulse-menu-icon"></span>

        <img src="<?= base_url('assets/images/pulse360-icon.png') ?>"
          alt="Pulse 360"
          class="pulse-mini-toggle-icon">
      </button>
    </div>

    <div class="pulse-logo-container">
      <a class="navbar-brand brand-logo" href="<?= base_url('index') ?>">
        <img src="<?= base_url('assets/images/pulse360-logo.png') ?>"
          alt="Pulse 360 Logo"
          class="pulse-logo">
      </a>
    </div>

  </div>


  <!-- NAVBAR MENU -->
  <div class="navbar-menu-wrapper d-flex align-items-top">

    <ul class="navbar-nav ms-auto">

      <!-- NOTIFICATION DROPDOWN -->
      <li class="nav-item dropdown">

        <!-- Keep your existing notification dropdown code here -->

      </li>



      <!-- USER PROFILE DROPDOWN -->
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">

        <a class="nav-link"
          id="UserDropdown"
          href="#"
          data-bs-toggle="dropdown"
          aria-expanded="false">

          <!-- SMALL PROFILE IMAGE -->
          <img
            src="<?= esc($profileImage) ?>"
            alt="Profile image"
            class="pulse-user-profile-image">

        </a>


        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
          aria-labelledby="UserDropdown">

          <!-- USER INFORMATION -->
          <div class="dropdown-header text-center">

            <!-- LARGE PROFILE IMAGE -->
            <img
              src="<?= esc($profileImage) ?>"
              alt="Profile image"
              class="pulse-dropdown-profile-image">

            <p class="mb-1 mt-3 fw-semibold">
              <?= esc($userName) ?>
            </p>

            <p class="fw-light text-muted mb-1">
              <?= esc($userEmail) ?>
            </p>

            <?php if (!empty($userRole)): ?>
              <small class="text-primary">
                <?= esc($userRole) ?>
              </small>
            <?php endif; ?>

          </div>


          <div class="dropdown-divider"></div>


          <!-- SIGN OUT -->
          <a href="<?= site_url('logout') ?>"
            class="dropdown-item text-danger"
            onclick="return confirm('Are you sure you want to logout?')">

            <i class="dropdown-item-icon mdi mdi-logout text-danger me-2"></i>

            Sign Out

          </a>

        </div>

      </li>

    </ul>


    <!-- MOBILE SIDEBAR TOGGLE -->
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
      type="button"
      data-bs-toggle="offcanvas">

      <span class="mdi mdi-menu"></span>

    </button>

  </div>

</nav>


<style>
  /* LOGO */
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

  .pulse-logo-container {
    display: flex;
    align-items: center;
  }


  /* SIDEBAR TOGGLE */
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

  .pulse-menu-icon {
    display: block !important;
    font-size: 22px;
    transform: none !important;
    -webkit-transform: none !important;
  }

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

  body.sidebar-icon-only .pulse-sidebar-toggle,
  body.sidebar-icon-only .pulse-toggle-wrapper {
    transform: none !important;
    -webkit-transform: none !important;
  }

  body.sidebar-icon-only .pulse-sidebar-toggle:hover .pulse-mini-toggle-icon {
    transform: scale(1.05) !important;
    -webkit-transform: scale(1.05) !important;
  }

  .navbar .brand-logo-mini {
    display: none !important;
  }


  /* NAVBAR COLORS */
  html body .navbar,
  html body .navbar-brand-wrapper,
  html body .navbar-menu-wrapper {
    background-color: #1B4482 !important;
    background-image: none !important;
  }

  html body .navbar .nav-link,
  html body .navbar .icon-menu,
  html body .navbar .icon-bell {
    color: #ffffff !important;
  }

  /* NAVBAR USER PROFILE IMAGE */
  /* Fix user profile image inside navbar dropdown */
  html body .navbar .user-dropdown>a.nav-link>img.pulse-user-profile-image {
    width: 35px !important;
    height: 35px !important;
    min-width: 35px !important;
    min-height: 35px !important;
    max-width: 35px !important;
    max-height: 35px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    object-position: center !important;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    content: none !important;
    background: transparent !important;
  }

  /* Prevent theme styles from replacing the profile image */
  html body .navbar .user-dropdown>a.nav-link {
    background-image: none !important;
  }

  /* Large profile image inside user dropdown */
  html body .navbar .user-dropdown .dropdown-menu .dropdown-header .pulse-dropdown-profile-image {
    width: 70px !important;
    height: 70px !important;
    min-width: 70px !important;
    min-height: 70px !important;
    max-width: 70px !important;
    max-height: 70px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    object-position: center !important;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    content: none !important;
    background: transparent !important;
    margin: 0 auto !important;
  }
</style>
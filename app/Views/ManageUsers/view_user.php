<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

<?= $this->include('includes/breadcrumb'); ?>

            <h4 class="card-title mb-4">User Details</h4>

<!-- User Details Section -->
<div class="row view-details">

  <!-- Profile Picture -->
  <div class="col-md-12 mb-3">
    <div style="min-width: 200px;"><strong>Profile Picture</strong> :</div>
    <div class="ms-3 mt-2">
      <img src="<?= base_url(esc($user['User_Photo_URL'] ?? 'assets/images/faces/default.jpg')) ?>" alt="Profile Pic" class="img-thumbnail" style="max-width: 150px; border-radius: 8px;">
    </div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Full Name</strong> :</div>
    <div class="ms-3"><?= esc($user['User_FirstName'] . ' ' . $user['User_LastName']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Gender</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Gender']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Date of Birth</strong> :</div>
    <div class="ms-3"><?= esc($user['User_DOB']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Email (Username)</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Login_MailID']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Phone</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Phone_No']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Aadhar No</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Aadhar_No']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>City/Village</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Village_City']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>District</strong> :</div>
    <div class="ms-3"><?= esc($user['User_District']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>State</strong> :</div>
    <div class="ms-3"><?= esc($user['User_State']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Pincode</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Pincode']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Nationality</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Nationality']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Full Address</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Address']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Joining Date</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Joining_Date']) ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Leaving Date</strong> :</div>
    <div class="ms-3"><?= esc($user['User_Leaving_Date'] ?? '—') ?></div>
  </div>

  <div class="col-md-12 mb-2 d-flex">
    <div style="min-width: 200px;"><strong>Status</strong> :</div>
    <?php
      $status = $user['User_Status'];
      $color = match($status) {
          'Active' => '#28a745',
          'Inactive' => '#dc3545',
          'Completed' => '#ffc107',
          default => '#6c757d',
      };
    ?>
    <span class="status-badge" style="background-color: <?= $color ?>; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
      <?= esc($status) ?>
    </span>
  </div>
</div>

<!-- Action Buttons -->
<div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
  <a href="<?= base_url('users/edit/' . $user['User_Id']) ?>" class="btn btn-warning btn-sm">
    <i class="mdi mdi-pencil"></i> Edit
  </a>
  <a href="<?= base_url('users/delete/' . $user['User_Id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
    <i class="mdi mdi-delete"></i> Delete
  </a>
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <?= view('includes/footer'); ?>

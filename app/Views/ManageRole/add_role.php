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

              <!-- Back Button -->
              <button class="btn btn-secondary mb-3" onclick="window.history.back()">
                <i class="mdi mdi-arrow-left"></i> Back
              </button>

              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Manage Role & Rights</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('roles'); ?>">Manage Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Role</li>
                </ol>
              </nav>

               <h4 class="card-title">Roles</h4>
               <p class="card-description">Add New Role</p>

        <form method="post" action="<?= site_url('roles/store') ?>">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>Role ID</label>
              <input type="text" name="Role_Id" class="form-control" id="role_id" placeholder="Enter Role ID" required>
            </div>

            <div class="col-md-6 form-group">
              <label >Role Name</label>
              <input type="text" name="Role_Name" class="form-control" id="role_name" placeholder="Enter Role Name" required>
            </div>

            <div class="col-md-12 form-group">
              <label >Role Description</label>
              <textarea name="Role_Description" class="form-control" id="role_desc" rows="3" placeholder="Enter Description"></textarea>
            </div>
            
            <div class="col-md-12 form-group">
              <label >Assign Rights</label>
              <select name="Right_Id" class="form-select" required>
                <option value="">-- Select Rights --</option>
                <?php foreach ($rights as $right): ?>
                  <option value="<?= $right['Right_Id'] ?>"><?= $right['Rights_Summary'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

                <div class="col-md-6 form-group">
      <label>Recorded By</label>
      <input type="text" name="Record_Added_By" class="form-control" value="<?= old('Record_Added_By') ?>" placeholder="Enter Who Recorded Record" >
    </div>

    <div class="col-md-6 form-group">
      <label>Recorded On</label>
      <input type="date" name="Rec_Added_On" class="form-control" value="<?= old('Rec_Added_On') ?>">
    </div>

  <div class="mt-4">
    <a href="<?= site_url('roles') ?>" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary me-2">Save</button>
  </div>
                  </form>
        <!-- Form End -->

      </div>
    </div>
  </div>
</div>

  <?= view('includes/footer'); ?>

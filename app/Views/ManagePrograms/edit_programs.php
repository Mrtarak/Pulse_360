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

          <?= view('includes/breadcrumb'); ?>

            <h4 class="card-title">Programs</h4>
<p class="card-description">Edit Program</p>

<?php if (isset($program)) : ?>
   <form id="programForm" class="forms-sample" onsubmit="return validateProgramForm()" action="<?= base_url('programs/update/' . $program['Program_Id']) ?>" method="post">
<?php endif; ?>
  <div class="row">
    <div class="col-md-6 form-group">
      <label>Program Name</label>
      <input type="text" id="program_name" name="Program_Name" class="form-control" value="<?= old('Program_Name', $program['Program_Name']) ?>"  >
    </div>

        <div class="col-md-6 form-group">
  <label>Program Theme</label>
  <select id="program_theme" class="form-select dropdown-bold" name="Program_Theme_Id" >
    <option value="">Select Theme</option>
    <?php foreach ($themes as $theme): ?>
        <option value="<?= esc($theme['Program_Theme_Id']) ?>"
            <?= old('Program_Theme_Id', $program['Program_Theme_Id'] ?? '') == $theme['Program_Theme_Id'] ? 'selected' : '' ?>>
            <?= esc($theme['Program_Theme_Name']) ?>
        </option>
    <?php endforeach; ?>
    </select>
</div>


    <div class="col-md-12 form-group">
    <label>About</label>
    <textarea id="program_about" name="Program_About" class="form-control" rows="5"><?= old('Program_About', $program['Program_About']) ?></textarea>
</div>

    <div class="col-md-6 form-group">
      <label>Start Date</label>
      <input type="date" id="program_start_date" name="Program_Start_Date" class="form-control" value="<?= old('Program_Start_Date', $program['Program_Start_Date']) ?>" max="<?= date('Y-m-d') ?>">
    </div>

    <div class="col-md-6 form-group">
      <label>End Date</label>
      <input type="date" id="program_end_date" name="Program_End_Date" class="form-control" value="<?= old('Program_End_Date', $program['Program_End_Date']) ?>">
    </div>


    <div class="col-md-6 form-group">
    <label>Applicable For</label>
    <textarea id="applicable_for" name="Applicable_For" class="form-control" rows="3" placeholder="Enter Age Group"><?= old('Applicable_For', $program['Applicable_For']) ?></textarea>
</div>

    <div class="col-md-6 form-group">
      <label>Status</label>
      <select id="program_status" class="form-select dropdown-bold" name="Program_Status" >
    <option value="">Select Status</option>
    <option value="Active" <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Active' ? 'selected' : '' ?>>Active</option>
    <option value="Inactive" <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
    <option value="Completed" <?= old('Program_Status', $program['Program_Status'] ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
</select>
    </div>
  </div>

  <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
    <a href="<?= site_url('programs') ?>" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary me-2">Save</button>
  </div>
</form>

      </div>
    </div>
  </div>
</div>

<!-- Footer scripts -->
  <script src="<?= base_url('assets/js/program-validation.js') ?>"></script>
<?= view('includes/footer'); ?>

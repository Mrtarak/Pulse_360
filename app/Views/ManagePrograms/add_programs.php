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
              <p class="card-description">Add Program</p>

<form id="programForm" class="forms-sample" onsubmit="return validateProgramForm()" action="<?= base_url('programs/store') ?>" method="post">
  <div class="row">
    <div  class="col-md-6 form-group">
      <label>Program Name <span class="text-danger">*</span></label>
      <input type="text" id="program_name" name="Program_Name" class="form-control" value="<?= old('Program_Name') ?>" placeholder="Enter Program Name" >
    </div>

        <div class="col-md-6 form-group">
  <label>Program Theme <span class="text-danger">*</span></label>
  <select id="program_theme" class="form-select" name="Program_Theme_Id" >
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
      <label>About <span class="text-danger">*</span></label>
      <textarea id="program_about" name="Program_About" class="form-control" rows="5" value="<?= old('Program_About') ?>" placeholder="Enter About Program" ></textarea>
    </div>

    <div class="col-md-6 form-group">
      <label>Start Date <span class="text-danger">*</span></label>
      <input type="date" id="program_start_date" name="Program_Start_Date" class="form-control" value="<?= old('Program_Start_Date') ?>" max="<?= date('Y-m-d') ?>">
    </div>

    <div class="col-md-6 form-group">
      <label>End Date</label>
      <input type="date" id="program_end_date" name="Program_End_Date" class="form-control" value="<?= old('Program_End_Date') ?>">
    </div>

    <div  class="col-md-12 form-group">
      <label>Applicable For <span class="text-danger">*</span></label>
      <textarea id="applicable_for" name="Applicable_For" class="form-control" value="<?= old('Applicable_For') ?>" placeholder="Enter to whom this Program is Applicable" ></textarea>
    </div>

    <div class="col-md-6 form-group">
      <label>Status <span class="text-danger">*</span></label>
      <select id="program_status" class="form-select" name="Program_Status" >
    <option value="">Select Status</option>
    <option value="Active" <?= old('Program_Status') == 'Active' ? 'selected' : '' ?>>Active</option>
    <option value="Inactive" <?= old('Program_Status') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
    <option value="Completed" <?= old('Program_Status') == 'Completed' ? 'selected' : '' ?>>Completed</option>
</select>
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

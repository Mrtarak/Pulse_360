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

              <h4 class="card-title">Program Theme</h4>
              <h4 class="card-description">Add Program Theme</h4>

              <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                  <?= session()->getFlashdata('error') ?>
                </div>
              <?php endif; ?>

              <form id="programThemeForm"
                class="forms-sample"
                action="<?= base_url('program_theme/store') ?>"
                method="post">

                <?= csrf_field() ?>

                <div class="row">

                  <!-- Program Theme Name -->
                  <div class="col-md-6 form-group mb-3">
                    <label>
                      Program Theme Name
                      <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                      name="Program_Theme_Name"
                      class="form-control"
                      placeholder="Enter Program Theme Name"
                      required>
                  </div>

                  <!-- Theme Suggested By -->
                  <div class="col-md-6 form-group mb-3">
                    <label>Theme Suggested By</label>
                    <input type="text"
                      name="Theme_Suggested_By"
                      class="form-control"
                      placeholder="Enter who Suggested Theme">
                  </div>

                  <!-- Description -->
                  <div class="col-md-12 form-group mb-3">
                    <label>
                      Description
                      <span class="text-danger">*</span>
                    </label>
                    <textarea name="Theme_Description"
                      class="form-control"
                      rows="4"
                      placeholder="Enter Description for Program Theme"
                      required></textarea>
                  </div>

                  <!-- Theme Added On -->
                  <div class="col-md-6 form-group mb-3">
                    <label>
                      Theme Added On
                      <span class="text-danger">*</span>
                    </label>
                    <input type="date"
                      name="Theme_Added_On"
                      class="form-control"
                      value="<?= date('Y-m-d') ?>"
                      max="<?= date('Y-m-d') ?>"
                      required>
                  </div>

                  <!-- Status -->
                  <div class="col-md-6 form-group mb-3">
                    <label>
                      Status
                      <span class="text-danger">*</span>
                    </label>

                    <select name="Theme_Status" class="form-select" required>
                      <option value=""selected>Select Status</option>
                      <option value="Active" >Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>

                </div>

                <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                  <a href="<?= site_url('program_theme') ?>"
                    class="btn btn-light me-2">
                    Cancel
                  </a>

                  <button type="submit"
                    class="btn btn-primary">
                    Save
                  </button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <?= view('includes/footer'); ?>
  </div>
</div>
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

              <h4 class="card-title">Add Goal</h4>

              <form method="post" action="<?= site_url('goals/save') ?>">

                <div class="row">

                  <!-- Goal ID -->
                  <div class="col-md-6 form-group">
                    <label>Goal ID</label>
                    <input type="text"
                      name="Goal_Id"
                      class="form-control"
                      placeholder="Ex: G001"
                      required>
                  </div>

                  <!-- Goal Type -->
                  <div class="col-md-6 form-group">
                    <label>Goal Type <span class="text-danger">*</span></label>
                    <select name="Goal_Type_Id" class="form-control" required>
                      <option value="">-- Select Goal Type --</option>

                      <?php foreach ($types as $type): ?>
                        <option value="<?= $type['Goal_Type_Id'] ?>">
                          <?= esc($type['Goal_Type_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <!-- Goal Title -->
                  <div class="col-md-12 form-group mt-3">
                    <label>Goal Title <span class="text-danger">*</span></label>
                    <input type="text"
                      name="Goal_Title"
                      class="form-control"
                      value="<?= old('Goal_Title') ?>"
                      placeholder="Enter Goal Title"
                      required>
                  </div>

                  <!-- Goal Description -->
                  <div class="col-md-12 form-group mt-3">
                    <label>Goal Description</label>
                    <textarea name="Goal_Description"
                      class="form-control"
                      rows="4"
                      placeholder="Enter Goal Description"><?= old('Goal_Description') ?></textarea>
                  </div>

                  <!-- Default Target -->
                  <div class="col-md-6 form-group mt-3">
                    <label>Default Target Value</label>
                    <input type="text"
                      name="Default_Target_Value"
                      class="form-control"
                      value="<?= old('Default_Target_Value') ?>"
                      placeholder="Ex: 1 Job, 10000 Income, 80% Score">
                  </div>

                  <!-- Status -->
                  <div class="col-md-6 form-group mt-3">
                    <label>Status</label>
                    <select name="Goal_Status" class="form-control">
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>

                </div>

                <div class="mt-4 d-flex justify-content-center">
                  <a href="<?= site_url('goals') ?>" class="btn btn-light me-2">
                    Cancel
                  </a>

                  <button type="submit" class="btn btn-primary">
                    Save Goal
                  </button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>
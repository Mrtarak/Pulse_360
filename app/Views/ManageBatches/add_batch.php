<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card shadow-sm border-0">
            <div class="card-body">

              <?= view('includes/breadcrumb'); ?>

              <h4 class="card-title mb-4">
                <i class="mdi mdi-plus-circle-outline me-2"></i> Add New Batch
              </h4>

              <form method="post" action="<?= site_url('batches/store') ?>">

                <div class="row g-3">

                  <div class="col-md-6">
                    <label class="form-label">Batch Name *</label>
                    <input type="text" name="Batch_Name" class="form-control" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Program *</label>
                    <select name="Program_Id" class="form-control" required>
                      <option value="">-- Select Program --</option>
                      <?php foreach ($programs as $program): ?>
                        <option value="<?= $program['Program_Id'] ?>">
                          <?= esc($program['Program_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Center *</label>
                    <select name="Center_Id" class="form-control" required>
                      <option value="">-- Select Center --</option>
                      <?php foreach ($centers as $center): ?>
                        <option value="<?= $center['Center_Id'] ?>">
                          <?= esc($center['Center_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Class Duration *</label>

                    <select
                      name="Duration_Hours"
                      class="form-control"
                      required>

                      <option value="">Select Duration</option>

                      <option value="1">1 Hour</option>
                      <option value="1.5">1.5 Hours</option>
                      <option value="2">2 Hours</option>
                      <option value="2.5">2.5 Hours</option>
                      <option value="3">3 Hours</option>
                      <option value="4">4 Hours</option>

                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="Batch_Start_Date" class="form-control" max="<?= date('Y-m-d') ?>" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">End Date *</label>
                    <input type="date" name="Batch_Last_Date" class="form-control">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Status *</label>
                    <select name="Batch_Status" class="form-control" required>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>

                  <div class="col-md-12">
                    <label class="form-label">Remarks</label>
                    <textarea name="Remarks" class="form-control"></textarea>
                  </div>

                  <!-- hidden system fields -->
                  <input type="hidden" name="Rec_Added_By" value="admin">
                  <input type="hidden" name="Rec_Updated_By" value="admin">

                </div>

                <div class="mt-4 d-flex gap-2">
                  <a href="<?= site_url('batches') ?>" class="btn btn-light">Cancel</a>
                  <button type="submit" class="btn btn-primary">
                    Save Batch
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
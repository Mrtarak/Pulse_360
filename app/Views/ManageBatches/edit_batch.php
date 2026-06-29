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

              <h4 class="card-title">Edit Batch</h4>

              <form method="post" action="<?= site_url('batches/update/' . $batch['Batch_Id']) ?>">

                <div class="row">

                  <!-- Batch Name -->
                  <div class="col-md-6 form-group">
                    <label>Batch Name</label>
                    <input type="text" name="Batch_Name"
                      class="form-control"
                      value="<?= esc($batch['Batch_Name']) ?>">
                  </div>

                  <!-- Program -->
                  <div class="col-md-6 form-group">
                    <label>Program</label>
                    <select name="Program_Id" class="form-control">
                      <option value="">-- Select Program --</option>
                      <?php foreach ($programs as $program): ?>
                        <option value="<?= $program['Program_Id'] ?>"
                          <?= ($batch['Program_Id'] == $program['Program_Id']) ? 'selected' : '' ?>>
                          <?= esc($program['Program_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <!-- Center -->
                  <div class="col-md-6 form-group">
                    <label>Center</label>
                    <select name="Center_Id" class="form-control">
                      <option value="">-- Select Center --</option>
                      <?php foreach ($centers as $center): ?>
                        <option value="<?= $center['Center_Id'] ?>"
                          <?= ($batch['Center_Id'] == $center['Center_Id']) ? 'selected' : '' ?>>
                          <?= esc($center['Center_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <!-- Duration -->
                  <div class="col-md-6 form-group">
                    <label>Class Duration</label>

                    <select name="Duration_Hours" class="form-control">

                      <option value="1"
                        <?= ($batch['Duration_Hours'] == '1') ? 'selected' : '' ?>>
                        1 Hour
                      </option>

                      <option value="1.5"
                        <?= ($batch['Duration_Hours'] == '1.5') ? 'selected' : '' ?>>
                        1.5 Hours
                      </option>

                      <option value="2"
                        <?= ($batch['Duration_Hours'] == '2') ? 'selected' : '' ?>>
                        2 Hours
                      </option>

                      <option value="2.5"
                        <?= ($batch['Duration_Hours'] == '2.5') ? 'selected' : '' ?>>
                        2.5 Hours
                      </option>

                      <option value="3"
                        <?= ($batch['Duration_Hours'] == '3') ? 'selected' : '' ?>>
                        3 Hours
                      </option>

                      <option value="4"
                        <?= ($batch['Duration_Hours'] == '4') ? 'selected' : '' ?>>
                        4 Hours
                      </option>

                    </select>
                  </div>

                  <!-- Start Date -->
                  <div class="col-md-6 form-group">
                    <label>Start Date</label>
                    <input type="date" name="Batch_Start_Date"
                      class="form-control"
                      value="<?= esc($batch['Batch_Start_Date']) ?>"max="<?= date('Y-m-d') ?>">
                  </div>

                  <!-- End Date -->
                  <div class="col-md-6 form-group">
                    <label>End Date</label>
                    <input type="date" name="Batch_Last_Date"
                      class="form-control"
                      value="<?= esc($batch['Batch_Last_Date']) ?>">
                  </div>

                  <!-- Status -->
                  <div class="col-md-6 form-group">
                    <label>Status</label>
                    <select name="Batch_Status" class="form-control">
                      <option value="Active" <?= ($batch['Batch_Status'] == 'Active') ? 'selected' : '' ?>>Active</option>
                      <option value="Inactive" <?= ($batch['Batch_Status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                      <option value="Completed" <?= ($batch['Batch_Status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
                    </select>
                  </div>

                </div>

                <!-- Remarks -->
                <div class="form-group mt-3">
                  <label>Remarks</label>
                  <textarea name="Remarks" class="form-control"><?= esc($batch['Remarks']) ?></textarea>
                </div>

                <div class="mt-4 d-flex gap-2">
                  <a href="<?= site_url('batches') ?>" class="btn btn-light">Cancel</a>
                  <button type="submit" class="btn btn-primary">Update</button>
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
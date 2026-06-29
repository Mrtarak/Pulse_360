<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <?= view('includes/breadcrumb'); ?>

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0">
                <i class="mdi mdi-book-open-page-variant me-2"></i>Center List
              </h4>
              <?= view('includes/messages'); ?>

              <div class="d-flex align-items-center">
                <label for="statusFilter" class="me-2">Status:</label>
                <select id="statusFilter" class="form-select me-3" style="width: 150px;">
                  <option value="">All</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Completed">Completed</option>
                </select>

                <a href="<?= base_url('center/add'); ?>" class="btn btn-primary btn-sm">
                  <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Center
                </a>
              </div>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
              <table id="centerTable" class="table table-striped">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Center Name</th>
                    <th>Inaugurated By</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($center)): ?>
                    <?php $i = 1; foreach ($center as $row): ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($row['Center_Name']) ?></td>
                        <td><?= esc($row['Center_Inaugurated_By']) ?></td>
                        <td><?= esc($row['Center_City']) ?></td>
                        <td><?= esc($row['Center_State']) ?></td>
                        <td><?= esc($row['Center_Capacity']) ?></td>

                        <td>
                          <?php
                            $status = $row['Center_Status'];
                            $badgeClass = match ($status) {
                              'Active' => 'badge bg-success text-white',
                              'Inactive' => 'badge bg-danger text-white',
                              default => 'badge bg-secondary text-white',
                            };
                          ?>
                          <span class="<?= $badgeClass ?>"><?= esc($status) ?></span>
                        </td>

                        <td>
                          <a href="<?= base_url('center/view/' . $row['Center_Id']) ?>" class="btn btn-info btn-sm">
                            <i class="mdi mdi-eye"></i>
                          </a>
                          <a href="<?= base_url('center/edit/' . $row['Center_Id']) ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center">No centers found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?= view('includes/footer'); ?>
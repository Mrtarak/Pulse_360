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

            <h4 class="card-title mb-4">
              <i class="mdi mdi-book-open-page-variant me-2"></i> Batch Details
            </h4>

            <div class="row">

              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Batch ID:</strong>
                <span><?= esc($batch['Batch_Id']) ?></span>
              </div>

              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Batch Name:</strong>
                <span><?= esc($batch['Batch_Name']) ?></span>
              </div>

              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Program ID:</strong>
                <span><?= esc($batch['Program_Id']) ?></span>
              </div>

              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Center ID:</strong>
                <span><?= esc($batch['Center_Id']) ?></span>
              </div>

              <!-- STATUS -->
              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Status:</strong>
                <?php
                $status = $batch['Batch_Status'];
                $color = match ($status) {
                  'Active' => '#28a745',
                  'Inactive' => '#dc3545',
                  'Completed' => '#ffc107',
                  default => '#6c757d',
                };
                ?>
                <span style="background:<?= $color ?>;color:#fff;padding:4px 10px;border-radius:5px;">
                  <?= esc($status) ?>
                </span>
              </div>

              <!-- TIME -->
              <tr>
                <th>Duration</th>
                <td><?= esc($batch['Duration_Hours']) ?> Hours</td>
              </tr>

              <!-- DATES -->
              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Start Date:</strong>
                <span><?= esc($batch['Batch_Start_Date']) ?></span>
              </div>

              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">End Date:</strong>
                <span><?= esc($batch['Batch_Last_Date'] ?? '—') ?></span>
              </div>

              <!-- REMARKS -->
              <div class="col-md-12 mb-2 d-flex">
                <strong style="width:200px;">Remarks:</strong>
                <span><?= esc($batch['Remarks'] ?? '—') ?></span>
              </div>

            </div>

            <!-- ACTIONS -->
            <div class="mt-4 d-flex gap-2 justify-content-center">
              <a href="<?= site_url('batches/edit/' . $batch['Batch_Id']) ?>" class="btn btn-warning">
                Edit
              </a>

              <a href="<?= site_url('batches/delete/' . $batch['Batch_Id']) ?>"
                onclick="return confirm('Are you sure?')"
                class="btn btn-danger">
                Delete
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>
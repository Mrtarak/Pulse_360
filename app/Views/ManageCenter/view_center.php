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
                    <i class="mdi mdi-book-open-page-variant me-2"></i> Center Details
                  </h4>
                  <div class="row view-details">
                  <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Center Name</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Name']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Description</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Description']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Inaugurated By</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Inaugurated_By']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Opening Date</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Opening_Date']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Address</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Address']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>City</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_City']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>State</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_State']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Pincode</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Pincode']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Capacity</strong> :</div>
        <div class="ms-3"><?= esc($center['Center_Capacity']) ?></div>
    </div>

        <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Status</strong> :</div>
        <?php
        $status = $center['Center_Status'];
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

        <div class=" mt-4 d-flex justify-content-center flex-wrap gap-3">
        <a href="<?= base_url('center/edit/' . $center['Center_Id']) ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="<?= base_url('center/delete/' . $center['Center_Id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
    </div>
</div>
</div>
</div>
</div>
</div>

<?= view('includes/footer'); ?>
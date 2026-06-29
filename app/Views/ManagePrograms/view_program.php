<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-lg-12 grid-margin stretch-card">
<div class="card">
    <div class="card-body">
<?= $this->include('includes/breadcrumb'); ?>

              <h4 class="card-title mb-4">
                    <i class="mdi mdi-book-open-page-variant me-2"></i> Program Details
                  </h4>

                  <!-- Details -->
                   <div class="row view-details">
                     <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Program Name</strong> :</div>
        <div class="ms-3"><?= esc($program['Program_Name']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Program Theme</strong> :</div>
        <div class="ms-3"><?= esc($program['Program_Theme_Name']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Applicable For</strong> :</div>
        <div class="ms-3"><?= esc($program['Applicable_For']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
<div style="min-width: 220px; white-space: nowrap;">
    <strong>About</strong> :
</div>
        <div class="ms-3"><?= esc($program['Program_About']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Program Start Date</strong> :</div>
        <div class="ms-3"><?= esc($program['Program_Start_Date']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Program End Date</strong> :</div>
        <div class="ms-3"><?= esc($program['Program_End_Date']) ?></div>
    </div>

    <div class="col-md-12 mb-2 d-flex">
        <div style="min-width: 200px;"><strong>Status</strong> :</div>
        <?php
        $status = $program['Program_Status'];
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
    
    <!-- actions -->
        <div class=" mt-4 d-flex justify-content-center flex-wrap gap-3">
        <a href="<?= base_url('programs/edit/' . $program['Program_Id']) ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="<?= base_url('programs/delete/' . $program['Program_Id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<?= view('includes/footer'); ?>
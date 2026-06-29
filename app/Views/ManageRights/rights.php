<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

          <?= view('includes/breadcrumb'); ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0"><i class="mdi mdi-book-open-page-variant me-2"></i>Rights List</h4>
              <a href="<?php echo base_url('rights/add') ?>" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Right
              </a>
            </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="rightsTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>Right ID</th>
                    <th>Rights Title</th>
                    <th>Rights Summary</th>
                    <th>Can Edit</th>
                    <th>Can View</th>
                    <th>Can Add</th>
                    <th>Can Delete</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($rights)): ?>
                  <?php $i=1; foreach ($rights as $row): ?>
                    <tr>
                      <td><?= esc($row['Right_Id']) ?></td>
                      <td><?= esc($row['Rights_Title']) ?></td>
                      <td><?= esc($row['Rights_Summary'] ?? 'N/A') ?></td>
                      <td><?= esc($row['Can_Edit']) ?></td>
                      <td><?= esc($row['Can_View']) ?></td>
                      <td><?= esc($row['Can_Add']) ?></td>
                      <td><?= esc($row['Can_Delete']) ?></td>
                      <td>
                        <a href="<?= site_url('rights/edit/' . $row['Right_Id']) ?>" class="btn btn-warning btn-sm">
                          <i class="mdi mdi-pencil"></i> 
                        </a>
                        <a href="<?= site_url('rights/delete/' . $row['Right_Id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this right?');">
                          <i class="mdi mdi-delete"></i> 
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center">No rights assigned yet.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div> 
        </div>

  <?= view('includes/footer'); ?>
             <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#rightsTable').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      info: true
    });
  });
</script>

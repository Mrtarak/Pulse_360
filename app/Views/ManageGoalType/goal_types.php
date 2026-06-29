<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

          <?= view('includes/breadcrumb'); ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="mdi mdi-shield-account me-2"></i>Goal Types List</h4>
                    <?= view('includes/messages'); ?>
              <a href="<?= site_url('goals/types/add') ?>" class="btn btn-primary btn-sm">
                      <i class="mdi mdi-plus-circle-outline me-1"></i> Add Goal Type
              </a>
            </div>
            <!--  Table -->
                          <div class="card">
              <div class="card-body">
        <div class="table-responsive">
        <table id="goalTypesTable" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Goal Name</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($types)): ?>
            <?php $i=1; foreach ($types as $type): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($type['Goal_Type_Name']) ?></td>
                <td><?= esc($type['Goal_Type_Description']) ?></td>
                <td>
                            <a href="<?= base_url('goals/types/view/' . $type['Goal_Type_Id']) ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-eye"></i>
                              </a>
                              <a href="<?= base_url('goals/types/edit/' . $type['Goal_Type_Id']) ?>" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i>
                              </a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php else: ?>
                       
                      <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<?= view('includes/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
     <script>
    $(document).ready(function () {
      $('#goalTypesTable').DataTable({
        paging: true,
      searching: true,
      ordering: true,
      info: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search GoalTypes..."
        }
      });
    });

  </script>

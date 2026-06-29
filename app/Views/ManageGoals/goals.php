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

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0">Goals</h4>
              <a href="<?= site_url('goals/add') ?>" class="btn btn-success btn-sm">
                <i class="mdi mdi-plus"></i> Add Goal
              </a>
            </div>

        <?php if (session()->getFlashdata('success')): ?>
          <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
        <?php endif; ?>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Goal ID</th>
              <th>Goal Type</th>
              <th>Added By</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($goals as $goal): ?>
              <tr>
                <td><?= esc($goal['Goal_Id']) ?></td>
                <td><?= esc($goal['Goal_Title']) ?></td>
                <td><?= esc($goal['Rec_Added_By']) ?></td>
                <td><?= esc($goal['Rec_Added_On']) ?></td>
                <td>
                  <a href="<?= site_url('goals/edit/' . $goal['Goal_Id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="<?= site_url('goals/delete/' . $goal['Goal_Id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this goal?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= view('includes/footer'); ?>

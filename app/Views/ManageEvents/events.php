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
              <h4 class="card-title mb-0">Event List</h4>
              <a href="<?= site_url('events/add') ?>" class="btn btn-success btn-sm">
                <i class="mdi mdi-plus"></i> Add Event
              </a>
            </div>
            <p class="card-description">Manage all scheduled events</p>

            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Event ID</th>
                    <th>Type</th>
                    <th>Place</th>
                    <th>Date</th>
                    <th>Mode</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($events as $event): ?>
                    <tr>
                      <td><?= esc($event['Event_Id']) ?></td>
                      <td><?= esc($event['Event_TypeName']) ?></td>
                      <td><?= esc($event['Event_Place']) ?></td>
                      <td><?= esc($event['Event_Date']) ?></td>
                      <td><?= esc($event['Event_Mode']) ?></td>
                      <td><label class="badge <?= $event['Event_Status'] === 'Active' ? 'badge-success' : 'badge-danger' ?>"><?= esc($event['Event_Status']) ?></label></td>
                      <td>
                        <a href="<?= site_url('events/edit/' . $event['Event_Id']) ?>" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                        <a href="<?= site_url('events/delete/' . $event['Event_Id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php if (empty($events)): ?>
                    <tr><td colspan="7" class="text-center">No events found.</td></tr>
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

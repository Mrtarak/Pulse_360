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
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0"><i class="mdi mdi-shield-account me-2"></i>Event Types</h4>
              <a href="<?php echo base_url('eventtype/add'); ?>" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus-circle-outline me-1"></i> Add EventType
              </a>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="eventTypesTable" class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Event Type Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($eventtypes)): ?>
                        <?php $i = 1;
                        foreach ($eventtypes as $eventtype): ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($eventtype['Event_Type_Name']) ?></td>
                            <td><?= esc($eventtype['Event_Type_About']) ?></td>
                            <td>
                              <a href="<?= base_url('eventtype/view/' . $eventtype['EventType_Id']) ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-eye"></i>
                              </a>
                              <a href="<?= base_url('eventtype/edit/' . $eventtype['EventType_Id']) ?>" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i>
                              </a>
                              <a href="<?= base_url('eventtype/delete/' . $eventtype['EventType_Id']) ?>" class="btn btn-danger btn-sm">
                                <i class="mdi mdi-delete"></i>
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
              $(document).ready(function() {
                var table = $('#eventTypesTable').DataTable({
                  paging: true,
                  searching: true,
                  ordering: true,
                  info: true,
                  language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search event types..."
                  }
                });
              });
            </script>
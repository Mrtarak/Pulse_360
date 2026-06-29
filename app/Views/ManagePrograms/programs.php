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
              <h4 class="card-title mb-0">
                <i class="mdi mdi-book-open-page-variant me-2"></i>Program List
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
                <a href="<?php echo base_url('forms/add_programs'); ?>" class="btn btn-primary btn-sm">
                  <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Program
                </a>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="programsTable" class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Program Name</th>
                        <th>Program Theme</th>
                        <th>Applicable For</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($programs)): ?>
                        <?php $i = 1;
                        foreach ($programs as $program): ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($program['Program_Name']) ?></td>
                            <td><?= esc($program['Program_Theme_Name']) ?></td>
                            <td><?= esc($program['Applicable_For']) ?></td>
                            <td>
                              <?php
                              $status = $program['Program_Status'];
                              $color = '';

                              switch ($status) {
                                case 'Active':
                                  $color = '#28a745';
                                  break;
                                case 'Inactive':
                                  $color = '#dc3545';
                                  break;
                                case 'Completed':
                                  $color = '#ffc107';
                                  break;
                                default:
                                  $color = '#6c757d';
                                  break;
                              }
                              ?>
                              <span style="background-color: <?= $color ?>; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                <?= esc($status) ?>
                              </span>
                            </td>
                            <td><?= esc($program['Program_Start_Date']) ?></td>
                            <td>
                              <a href="<?= base_url('programs/view/' . $program['Program_Id']) ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-eye"></i>
                              </a>
                              <a href="<?= base_url('programs/edit/' . $program['Program_Id']) ?>" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="7" class="text-center">No programs found.</td>
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
                var table = $('#programsTable').DataTable({
                  paging: true,
                  searching: true,
                  ordering: true,
                  info: true,
                  createdRow: function(row, data, dataIndex) {
                    // Store clean text in a data attribute
                    var statusText = $(row).find('td:eq(4)').text().trim();
                    $('td:eq(4)', row).attr('data-search', statusText);
                  },
                  columnDefs: [{
                    targets: 4,
                    render: function(data, type, row) {
                      if (type === 'filter' || type === 'sort') {
                        return $('<div>').html(data).text().trim();
                      }
                      return data;
                    }
                  }]
                });

                // Status Filter - exact match using regex
                $('#statusFilter').on('change', function() {
                  var selected = $(this).val();
                  table.column(4)
                    .search(selected ? '^' + selected + '$' : '', true, false) // exact match
                    .draw();
                });
              });
            </script>
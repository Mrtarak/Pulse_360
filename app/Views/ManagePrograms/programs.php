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
                <a href="<?php echo base_url('forms/add_programs'); ?>" class="btn btn-primary btn-sm">
                  <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Program
                </a>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row mb-4">

                  <div class="col-md-4">
                    <label class="form-label fw-bold">
                      <i class="mdi mdi-magnify"></i> Search Program
                    </label>

                    <input
                      type="text"
                      id="programSearch"
                      class="form-control"
                      placeholder="Search by Program Name">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label fw-bold">
                      <i class="mdi mdi-book-open-page-variant"></i> Program Theme
                    </label>

                    <select id="themeFilter" class="form-select">
                      <option value="">All Themes</option>

                      <?php
                      $themes = [];

                      foreach ($programs as $program) {
                        $themes[] = $program['Program_Theme_Name'];
                      }

                      $themes = array_unique($themes);
                      sort($themes);

                      foreach ($themes as $theme):
                      ?>
                        <option value="<?= esc($theme) ?>">
                          <?= esc($theme) ?>
                        </option>
                      <?php endforeach; ?>

                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label fw-bold">
                      <i class="mdi mdi-filter"></i> Status
                    </label>

                    <select id="statusFilter" class="form-select">
                      <option value="">All Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>

                  <div class="col-md-2 d-flex align-items-end">

                    <button
                      id="resetFilters"
                      class="btn btn-outline-secondary btn-sm px-3 rounded-pill">

                      <i class="mdi mdi-refresh me-1"></i>

                      Reset

                    </button>

                  </div>

                </div>
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

                  dom: 'lrtip',

                  paging: true,

                  ordering: true,

                  info: true,

                  pageLength: 10,

                  columnDefs: [{
                    targets: 4,
                    render: function(data, type) {

                      if (type === 'filter' || type === 'sort') {
                        return $('<div>').html(data).text().trim();
                      }

                      return data;

                    }
                  }]

                });

                // Search Program
                $('#programSearch').keyup(function() {

                  table.search($(this).val()).draw();

                });

                $('#themeFilter').change(function() {

                  table
                    .column(2)
                    .search($(this).val())
                    .draw();

                });

                // Status Filter
                $('#statusFilter').change(function() {

                  let status = $(this).val();

                  table
                    .column(4)
                    .search(status ? '^' + status + '$' : '', true, false)
                    .draw();

                });

                // Reset
                $('#resetFilters').click(function() {

                  $('#programSearch').val('');

                  $('#themeFilter').val('');

                  $('#statusFilter').val('');

                  table.search('');

                  table.column(4).search('');

                  table.draw();

                });

              });
            </script>
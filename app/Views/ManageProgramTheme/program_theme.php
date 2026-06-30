<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <?= view('includes/breadcrumb', [
              'main' => 'Home',
              'sub' => 'Program Themes',
              'sub_url' => base_url('program_theme')
            ]); ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0">
                <i class="mdi mdi-book-open-page-variant me-2"></i>Program Theme List
              </h4>
              <?= view('includes/messages'); ?>
              <a href="<?php echo base_url('program_theme/add'); ?>" class="btn btn-primary btn-sm">
                <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Program Theme
              </a>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row mb-4">

                  <div class="col-md-5">
                    <label class="form-label fw-bold">
                      <i class="mdi mdi-magnify"></i> Search Theme
                    </label>

                    <input type="text"
                      id="themeSearch"
                      class="form-control"
                      placeholder="Search by Theme Name">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label fw-bold">
                      <i class="mdi mdi-filter"></i> Status
                    </label>

                    <select id="statusFilter" class="form-select">
                      <option value="">All Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>

                  <div class="col-md-2 d-flex align-items-end">
                    <button id="resetFilters"
                      class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                      <i class="mdi mdi-refresh"></i>
                      Reset
                    </button>
                  </div>

                </div>
                <div class="table-responsive ">
                  <table id="themeTable" class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Theme Name</th>
                        <th>Description</th>
                        <th>Theme Added On</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($themes)): ?>
                        <?php $i = 1;
                        foreach ($themes as $theme): ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($theme['Program_Theme_Name']) ?></td>
                            <td><?= esc($theme['Theme_Description']) ?></td>
                            <td><?= esc($theme['Theme_Added_On']) ?></td>

                            <td>
                              <?php
                              $status = $theme['Theme_Status'];
                              $color = '';

                              switch ($status) {
                                case 'Active':
                                  $color = '#28a745';
                                  break;

                                case 'Inactive':
                                  $color = '#dc3545';
                                  break;

                                default:
                                  $color = '#6c757d';
                                  break;
                              }
                              ?>

                              <span style="
                                background-color: <?= $color ?>;
                                color:white;
                                padding:5px 10px;
                                border-radius:5px;
                                display:inline-block;
                                min-width:80px;
                                text-align:centser;
                            ">
                                <?= esc($status) ?>
                              </span>
                            </td>

                            <td>
                              <a href="<?= base_url('program_theme/view/' . $theme['Program_Theme_Id']) ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-eye"></i>
                              </a>
                              <a href="<?= base_url('program_theme/edit/' . $theme['Program_Theme_Id']) ?>" class="btn btn-warning btn-sm">
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
          </div>
        </div>
      </div>

      <?= view('includes/footer'); ?>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function() {
          var table = $('#themeTable').DataTable({

            dom: 'lrtip',

            paging: true,

            ordering: true,

            info: true,

            pageLength: 10

          });
          $('#themeSearch').keyup(function() {

            table.search($(this).val()).draw();

          });
          $('#statusFilter').change(function() {

            table
              .column(4)
              .search($(this).val())
              .draw();

          });
          $('#resetFilters').click(function() {

            $('#themeSearch').val('');

            $('#statusFilter').val('');

            table.search('');

            table.column(4).search('');

            table.draw();

          });
        });
      </script>
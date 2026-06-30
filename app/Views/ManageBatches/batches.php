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

              <!-- HEADER -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">
                  <i class="mdi mdi-calendar-clock me-2"></i> Batch List
                </h4>
                <?= view('includes/messages'); ?>

                <div class="d-flex align-items-center">
                  <a href="<?= base_url('batches/add'); ?>" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Batch
                  </a>
                </div>
              </div>

              <div class="row mb-4">

                <!-- Search -->
                <div class="col-md-3">
                  <label class="form-label fw-bold">
                    <i class="mdi mdi-magnify"></i> Batch Name
                  </label>

                  <input
                    type="text"
                    id="batchSearch"
                    class="form-control"
                    placeholder="Search Batch">
                </div>

                <!-- Program -->
                <div class="col-md-2">

                  <label class="form-label fw-bold">
                    <i class="mdi mdi-book-open-page-variant"></i> Program
                  </label>

                  <select id="programFilter" class="form-select">

                    <option value="">All Programs</option>

                    <?php
                    $programs = array_unique(array_column($batches, 'Program_Name'));
                    sort($programs);

                    foreach ($programs as $program):
                    ?>

                      <option value="<?= esc($program) ?>">
                        <?= esc($program) ?>
                      </option>

                    <?php endforeach; ?>

                  </select>

                </div>

                <!-- Center -->
                <div class="col-md-2">

                  <label class="form-label fw-bold">
                    <i class="mdi mdi-office-building"></i> Center
                  </label>

                  <select id="centerFilter" class="form-select">

                    <option value="">All Centers</option>

                    <?php
                    $centers = array_unique(array_column($batches, 'Center_Name'));
                    sort($centers);

                    foreach ($centers as $center):
                    ?>

                      <option value="<?= esc($center) ?>">
                        <?= esc($center) ?>
                      </option>

                    <?php endforeach; ?>

                  </select>

                </div>

                <!-- Status -->
                <div class="col-md-2">

                  <label class="form-label fw-bold">
                    <i class="mdi mdi-filter"></i> Status
                  </label>

                  <select id="statusFilter" class="form-select">

                    <option value="">All Status</option>

                    <option>Active</option>

                    <option>Inactive</option>

                    <option>Completed</option>

                  </select>

                </div>

                <!-- Reset -->

                <div class="col-md-2 d-flex align-items-end">

                  <button
                    id="resetFilters"
                    class="btn btn-outline-secondary btn-sm rounded-pill px-3">

                    <i class="mdi mdi-refresh"></i>

                    Reset

                  </button>

                </div>

              </div>

              <!-- TABLE -->
              <div class="table-responsive">
                <table id="batchTable" class="table table-striped table-bordered">

                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Batch Name</th>
                      <th>Program</th>
                      <th>Center</th>
                      <th>Status</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if (!empty($batches)): ?>
                      <?php $i = 1;
                      foreach ($batches as $batch): ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= esc($batch['Batch_Name']) ?></td>
                          <td><?= esc($batch['Program_Name']) ?></td>
                          <td><?= esc($batch['Center_Name']) ?></td>

                          <td>
                            <span class="badge <?= ($batch['Batch_Status'] === 'Active') ? 'bg-success' : 'bg-danger' ?>">
                              <?= esc($batch['Batch_Status']) ?>
                            </span>
                          </td>

                          <td><?= esc($batch['Batch_Start_Date']) ?></td>
                          <td><?= esc($batch['Batch_Last_Date'] ?? '-') ?></td>

                          <td>
                            <a href="<?= base_url('batches/view/' . $batch['Batch_Id']) ?>" class="btn btn-info btn-sm">
                              <i class="mdi mdi-eye"></i>
                            </a>

                            <a href="<?= site_url('batches/edit/' . $batch['Batch_Id']) ?>" class="btn btn-warning btn-sm">
                              <i class="mdi mdi-pencil"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
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
</div>

<?= view('includes/footer'); ?>

<!-- ================= DATATABLE JS (ONLY ONCE) ================= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {

    var table = $('#batchTable').DataTable({

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

    // Batch Name
    $('#batchSearch').on('keyup', function() {

      table.search($(this).val()).draw();

    });

    // Program
    $('#programFilter').on('change', function() {

      let val = $(this).val();

      table
        .column(2)
        .search(val ? '^' + val + '$' : '', true, false)
        .draw();

    });

    // Center
    $('#centerFilter').on('change', function() {

      let val = $(this).val();

      table
        .column(3)
        .search(val ? '^' + val + '$' : '', true, false)
        .draw();

    });

    // Status
    $('#statusFilter').on('change', function() {

      let val = $(this).val();

      table
        .column(4)
        .search(val ? '^' + val + '$' : '', true, false)
        .draw();

    });

    // Reset
    $('#resetFilters').on('click', function() {

      $('#batchSearch').val('');

      $('#programFilter').val('');

      $('#centerFilter').val('');

      $('#statusFilter').val('');

      table.search('');

      table.columns().search('');

      table.draw();

    });

  });
</script>
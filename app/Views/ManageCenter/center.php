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

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-0">
                <i class="mdi mdi-book-open-page-variant me-2"></i>Center List
              </h4>
              <?= view('includes/messages'); ?>

              <div class="d-flex align-items-center">
                <a href="<?= base_url('center/add'); ?>" class="btn btn-primary btn-sm">
                  <i class="mdi mdi-plus-circle-outline me-1"></i> Add New Center
                </a>
              </div>
            </div>
            <div class="row mb-4">

              <!-- Search Center -->
              <div class="col-md-3">
                <label class="form-label fw-bold">
                  <i class="mdi mdi-magnify"></i> Search Center
                </label>

                <input
                  type="text"
                  id="centerSearch"
                  class="form-control"
                  placeholder="Search Center Name">
              </div>

              <!-- City -->
              <div class="col-md-2">
                <label class="form-label fw-bold">
                  <i class="mdi mdi-city"></i> City
                </label>

                <select id="cityFilter" class="form-select">
                  <option value="">All Cities</option>

                  <?php
                  $cities = array_unique(array_column($center, 'Center_City'));
                  sort($cities);

                  foreach ($cities as $city):
                  ?>
                    <option value="<?= esc($city) ?>">
                      <?= esc($city) ?>
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>

              <!-- State -->
              <div class="col-md-2">
                <label class="form-label fw-bold">
                  <i class="mdi mdi-map-marker"></i> State
                </label>

                <select id="stateFilter" class="form-select">
                  <option value="">All States</option>

                  <?php
                  $states = array_unique(array_column($center, 'Center_State'));
                  sort($states);

                  foreach ($states as $state):
                  ?>
                    <option value="<?= esc($state) ?>">
                      <?= esc($state) ?>
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
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>

              <!-- Reset -->
              <div class="col-md-2 d-flex align-items-end">

                <button
                  id="resetFilters"
                  class="btn btn-outline-secondary btn-sm rounded-pill px-3">

                  <i class="mdi mdi-refresh me-1"></i>

                  Reset

                </button>

              </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">
              <table id="centerTable" class="table table-striped">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Center Name</th>
                    <th>Inaugurated By</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($center)): ?>
                    <?php $i = 1;
                    foreach ($center as $row): ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($row['Center_Name']) ?></td>
                        <td><?= esc($row['Center_Inaugurated_By']) ?></td>
                        <td><?= esc($row['Center_City']) ?></td>
                        <td><?= esc($row['Center_State']) ?></td>
                        <td><?= esc($row['Center_Capacity']) ?></td>

                        <td>
                          <?php
                          $status = $row['Center_Status'];
                          $badgeClass = match ($status) {
                            'Active' => 'badge bg-success text-white',
                            'Inactive' => 'badge bg-danger text-white',
                            default => 'badge bg-secondary text-white',
                          };
                          ?>
                          <span class="<?= $badgeClass ?>"><?= esc($status) ?></span>
                        </td>

                        <td>
                          <a href="<?= base_url('center/view/' . $row['Center_Id']) ?>" class="btn btn-info btn-sm">
                            <i class="mdi mdi-eye"></i>
                          </a>
                          <a href="<?= base_url('center/edit/' . $row['Center_Id']) ?>" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" class="text-center">No centers found.</td>
                    </tr>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {

    var table = $('#centerTable').DataTable({

      dom: 'lrtip',

      paging: true,

      ordering: true,

      info: true,

      pageLength: 10,

      columnDefs: [{
        targets: 6,
        render: function(data, type) {

          if (type === 'filter' || type === 'sort') {

            return $('<div>').html(data).text().trim();

          }

          return data;

        }
      }]

    });

    // Search Center
    $('#centerSearch').on('keyup', function() {
      table.search($(this).val()).draw();
    });

    // City
    $('#cityFilter').on('change', function() {

      let city = $(this).val();

      table
        .column(3)
        .search(city ? '^' + city + '$' : '', true, false)
        .draw();

    });

    // State
    $('#stateFilter').on('change', function() {

      let state = $(this).val();

      table
        .column(4)
        .search(state ? '^' + state + '$' : '', true, false)
        .draw();

    });

    // Status
    $('#statusFilter').on('change', function() {

      let status = $(this).val();

      table
        .column(6)
        .search(status ? '^' + status + '$' : '', true, false)
        .draw();

    });

    // Reset
    $('#resetFilters').click(function() {

      $('#centerSearch').val('');
      $('#cityFilter').val('');
      $('#stateFilter').val('');
      $('#statusFilter').val('');

      table.search('');

      table.columns().search('');

      table.draw();

    });

  });
</script>

<?= view('includes/footer'); ?>
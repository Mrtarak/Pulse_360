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

            <!-- PAGE HEADER -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

              <div>
                <h4 class="card-title mb-1">
                  <i class="mdi mdi-book-open-page-variant me-2"></i>
                  Program List
                </h4>

                <p class="text-muted mb-0">
                  Manage all programs and their details
                </p>
              </div>

              <a href="<?= base_url('forms/add_programs') ?>"
                class="btn btn-primary btn-sm mt-2 mt-md-0">

                <i class="mdi mdi-plus-circle-outline me-1"></i>
                Add New Program

              </a>

            </div>

            <?= view('includes/messages'); ?>

            <!-- FILTER SECTION -->
            <div class="card mb-4">
              <div class="card-body">

                <div class="row g-3">

                  <!-- SEARCH -->
                  <div class="col-md-4">

                    <label class="form-label fw-bold">
                      <i class="mdi mdi-magnify"></i>
                      Search Program
                    </label>

                    <input
                      type="text"
                      id="programSearch"
                      class="form-control"
                      placeholder="Search program name or heading">

                  </div>

                  <!-- THEME FILTER -->
                  <div class="col-md-3">

                    <label class="form-label fw-bold">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      Program Theme
                    </label>

                    <select id="themeFilter" class="form-select">

                      <option value="">All Themes</option>

                      <?php
                      $themes = [];

                      foreach ($programs as $program) {
                        if (!empty($program['Program_Theme_Name'])) {
                          $themes[] = $program['Program_Theme_Name'];
                        }
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

                  <!-- STATUS FILTER -->
                  <div class="col-md-3">

                    <label class="form-label fw-bold">
                      <i class="mdi mdi-filter"></i>
                      Status
                    </label>

                    <select id="statusFilter" class="form-select">

                      <option value="">All Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                      <option value="Completed">Completed</option>

                    </select>

                  </div>

                  <!-- RESET -->
                  <div class="col-md-2 d-flex align-items-end">

                    <button
                      type="button"
                      id="resetFilters"
                      class="btn btn-outline-secondary btn-sm px-3 rounded-pill w-100">

                      <i class="mdi mdi-refresh me-1"></i>
                      Reset

                    </button>

                  </div>

                </div>

              </div>
            </div>

            <!-- PROGRAM TABLE -->
            <div class="table-responsive">

              <table id="programsTable" class="table table-striped table-hover align-middle">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Program</th>
                    <th>Program Theme</th>
                    <th>Applicable For</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>

                  <?php if (!empty($programs)): ?>

                    <?php $i = 1; ?>

                    <?php foreach ($programs as $program): ?>

                      <tr>

                        <!-- SERIAL NUMBER -->
                        <td><?= $i++ ?></td>

                        <!-- PROGRAM NAME AND PROFILE -->
                        <td style="min-width:240px;">

                          <div class="d-flex align-items-center gap-3">

                            <?php if (!empty($program['Thumbnail_Image'])): ?>

                              <img
                                src="<?= base_url($program['Thumbnail_Image']) ?>"
                                alt="Program Profile"
                                style="
                                                                    width:55px;
                                                                    height:55px;
                                                                    object-fit:cover;
                                                                    border-radius:8px;
                                                                    border:1px solid #ddd;
                                                                ">

                            <?php else: ?>

                              <div style="
                                                                width:55px;
                                                                height:55px;
                                                                border-radius:8px;
                                                                background:#e9eef7;
                                                                display:flex;
                                                                align-items:center;
                                                                justify-content:center;
                                                            ">
                                <i class="mdi mdi-book-open-page-variant"
                                  style="font-size:25px;color:#1B4482;">
                                </i>
                              </div>

                            <?php endif; ?>

                            <div>

                              <div class="fw-bold">
                                <?= esc($program['Program_Name']) ?>
                              </div>

                              <?php if (!empty($program['Banner_Head'])): ?>

                                <small class="text-muted">
                                  <?= esc($program['Banner_Head']) ?>
                                </small>

                              <?php endif; ?>

                              <?php if (!empty($program['Banner_Subhead'])): ?>

                                <br>

                                <small class="text-muted">
                                  <?= esc($program['Banner_Subhead']) ?>
                                </small>

                              <?php endif; ?>

                            </div>

                          </div>

                        </td>

                        <!-- THEME -->
                        <td>
                          <?= esc($program['Program_Theme_Name'] ?? 'N/A') ?>
                        </td>

                        <!-- APPLICABLE FOR -->
                        <td style="min-width:140px;">
                          <?= esc($program['Applicable_For'] ?? 'N/A') ?>
                        </td>

                        <!-- STATUS -->
                        <td>

                          <?php
                          $status = $program['Program_Status'] ?? '';

                          $color = match ($status) {
                            'Active' => '#28a745',
                            'Inactive' => '#dc3545',
                            'Completed' => '#ffc107',
                            default => '#6c757d',
                          };

                          $textColor = $status === 'Completed'
                            ? '#212529'
                            : '#ffffff';
                          ?>

                          <span style="
                                                        background-color:<?= $color ?>;
                                                        color:<?= $textColor ?>;
                                                        padding:5px 11px;
                                                        border-radius:5px;
                                                        display:inline-block;
                                                        font-size:12px;
                                                        white-space:nowrap;
                                                    ">

                            <?= esc($status) ?>

                          </span>

                        </td>

                        <!-- START DATE -->
                        <td style="white-space:nowrap;">

                          <?= !empty($program['Program_Start_Date'])
                            ? date('d M Y', strtotime($program['Program_Start_Date']))
                            : 'N/A' ?>

                        </td>

                        <!-- ACTIONS -->
                        <td style="white-space:nowrap;">

                          <a
                            href="<?= base_url('programs/view/' . $program['Program_Id']) ?>"
                            class="btn btn-info btn-sm"
                            title="View Program">
                            <i class="mdi mdi-eye"></i>
                          </a>

                          <a
                            href="<?= base_url('programs/edit/' . $program['Program_Id']) ?>"
                            class="btn btn-warning btn-sm"
                            title="Edit Program">
                            <i class="mdi mdi-pencil"></i>
                          </a>

                        </td>

                      </tr>

                    <?php endforeach; ?>

                  <?php else: ?>

                    <tr>
                      <td colspan="7" class="text-center text-muted py-4">
                        <i class="mdi mdi-information-outline me-1"></i>
                        No programs found.
                      </td>
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

<!-- DATATABLE CSS -->
<link
  rel="stylesheet"
  href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DATATABLE JS -->
<!-- Assumes jQuery is already loaded by includes/header.php.
     Do not load a second jQuery copy if it is already present. -->

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {

    var table = $('#programsTable').DataTable({

      dom: 'lrtip',

      paging: true,

      ordering: true,

      info: true,

      pageLength: 10,

      order: [],

      columnDefs: [

        {
          targets: [0, 6],
          orderable: false
        },

        {
          targets: 4,

          render: function(data, type) {

            if (type === 'filter' || type === 'sort') {

              return $('<div>')
                .html(data)
                .text()
                .trim();

            }

            return data;

          }
        }

      ]

    });


    // SEARCH PROGRAM NAME / HEADING / SUBHEADING
    $('#programSearch').on('keyup', function() {

      table
        .column(1)
        .search($(this).val())
        .draw();

    });


    // THEME FILTER
    $('#themeFilter').on('change', function() {

      table
        .column(2)
        .search(
          $(this).val() ?
          '^' + $.fn.dataTable.util.escapeRegex($(this).val()) + '$' :
          '',
          true,
          false
        )
        .draw();

    });


    // STATUS FILTER
    $('#statusFilter').on('change', function() {

      let status = $(this).val();

      table
        .column(4)
        .search(
          status ? '^' + status + '$' : '',
          true,
          false
        )
        .draw();

    });


    // RESET FILTERS
    $('#resetFilters').on('click', function() {

      $('#programSearch').val('');
      $('#themeFilter').val('');
      $('#statusFilter').val('');

      table.search('');

      table.columns().search('');

      table.draw();

    });

  });
</script>

<?= view('includes/footer'); ?>
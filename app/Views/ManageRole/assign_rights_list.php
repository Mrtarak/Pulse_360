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
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h4 class="card-title mb-0">

                                <i class="mdi mdi-shield-key-outline me-2"></i>

                                Assign Rights

                            </h4>

                            <?= view('includes/messages'); ?>

                        </div>


                        <!-- INNER CARD -->
                        <div class="card">

                            <div class="card-body">

                                <!-- FILTER SECTION -->
                                <div class="row mb-4">

                                    <!-- SEARCH ROLE -->
                                    <div class="col-md-5">

                                        <label class="form-label fw-bold">

                                            <i class="mdi mdi-magnify"></i>

                                            Search Role

                                        </label>

                                        <input
                                            type="text"
                                            id="roleSearch"
                                            class="form-control"
                                            placeholder="Search by Role Name">

                                    </div>


                                    <!-- STATUS -->
                                    <div class="col-md-3">

                                        <label class="form-label fw-bold">

                                            <i class="mdi mdi-filter"></i>

                                            Status

                                        </label>

                                        <select
                                            id="statusFilter"
                                            class="form-select">

                                            <option value="">
                                                All Status
                                            </option>

                                            <option value="Active">
                                                Active
                                            </option>

                                            <option value="Inactive">
                                                Inactive
                                            </option>

                                        </select>

                                    </div>


                                    <!-- EMPTY SPACE -->
                                    <div class="col-md-2">
                                    </div>


                                    <!-- RESET -->
                                    <div class="col-md-2 d-flex align-items-end">

                                        <button
                                            id="resetFilters"
                                            type="button"
                                            class="btn btn-outline-secondary btn-sm px-3 rounded-pill">

                                            <i class="mdi mdi-refresh me-1"></i>

                                            Reset

                                        </button>

                                    </div>

                                </div>


                                <!-- ASSIGN RIGHTS TABLE -->
                                <div class="table-responsive">

                                    <table
                                        id="assignRightsTable"
                                        class="table table-striped">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Role Name</th>

                                                <th>Description</th>

                                                <th>Status</th>

                                                <th>Actions</th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php if (!empty($roles)): ?>

                                                <?php

                                                $i = 1;

                                                foreach ($roles as $role):

                                                    $isSystemRole =
                                                        ((int) ($role['Is_System_Role'] ?? 0) === 1);

                                                ?>

                                                    <tr>

                                                        <!-- SERIAL NUMBER -->
                                                        <td>

                                                            <?= $i++ ?>

                                                        </td>


                                                        <!-- ROLE NAME -->
                                                        <td>

                                                            <strong>
                                                                <?= esc($role['Role_Name']) ?>
                                                            </strong>

                                                            <?php if ($isSystemRole): ?>

                                                                <span
                                                                    class="badge bg-primary ms-2">

                                                                    <i class="mdi mdi-shield-check me-1"></i>

                                                                    System Role

                                                                </span>

                                                            <?php endif; ?>

                                                        </td>


                                                        <!-- DESCRIPTION -->
                                                        <td>

                                                            <?php

                                                            $description = trim(
                                                                $role['Role_Description'] ?? ''
                                                            );

                                                            ?>

                                                            <?php if ($description !== ''): ?>

                                                                <?= esc($description) ?>

                                                            <?php else: ?>

                                                                <span class="text-muted">
                                                                    —
                                                                </span>

                                                            <?php endif; ?>

                                                        </td>


                                                        <!-- STATUS -->
                                                        <td>

                                                            <?php

                                                            $status = $role['Role_Status'] ?? '';

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

                                                            <span
                                                                style="
                                                                    background-color: <?= $color ?>;
                                                                    color: white;
                                                                    padding: 5px 10px;
                                                                    border-radius: 5px;
                                                                    display: inline-block;
                                                                ">

                                                                <?= esc($status) ?>

                                                            </span>

                                                        </td>


                                                        <!-- ACTIONS -->
                                                        <td>

                                                            <!-- VIEW RIGHTS -->
                                                            <a
                                                                href="<?= site_url('roles/assign-rights/view/' . $role['Role_Id']); ?>"
                                                                class="btn btn-info btn-sm"
                                                                title="View Assigned Rights">

                                                                <i class="mdi mdi-eye"></i>

                                                            </a>


                                                            <?php if (!$isSystemRole): ?>

                                                                <!-- EDIT RIGHTS -->
                                                                <a
                                                                    href="<?= site_url('roles/assign-rights/edit/' . $role['Role_Id']); ?>"
                                                                    class="btn btn-warning btn-sm"
                                                                    title="Edit Assigned Rights">

                                                                    <i class="mdi mdi-pencil"></i>

                                                                </a>

                                                            <?php else: ?>

                                                                <!-- PROTECTED SYSTEM ROLE -->
                                                                <span
                                                                    class="badge bg-primary ms-1"
                                                                    title="Super Admin automatically has all active rights">

                                                                    <i class="mdi mdi-shield-check me-1"></i>

                                                                    Protected

                                                                </span>

                                                            <?php endif; ?>

                                                        </td>

                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php else: ?>

                                                <tr>

                                                    <td
                                                        colspan="5"
                                                        class="text-center">

                                                        No roles found.

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

        <?= view('includes/footer'); ?>

    </div>

</div>


<!-- =========================================================
     DATATABLE
========================================================= -->

<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {

        var table = $('#assignRightsTable').DataTable({

            dom: 'lrtip',

            paging: true,

            ordering: true,

            info: true,

            pageLength: 10,

            columnDefs: [{

                targets: 3,

                render: function(data, type) {

                    if (
                        type === 'filter' ||
                        type === 'sort'
                    ) {

                        return $('<div>')
                            .html(data)
                            .text()
                            .trim();

                    }

                    return data;

                }

            }]

        });


        // SEARCH ROLE

        $('#roleSearch').keyup(function() {

            table
                .search($(this).val())
                .draw();

        });


        // STATUS FILTER

        $('#statusFilter').change(function() {

            let status = $(this).val();

            table
                .column(3)
                .search(
                    status ?
                    '^' + status + '$' :
                    '',
                    true,
                    false
                )
                .draw();

        });


        // RESET FILTERS

        $('#resetFilters').click(function() {

            $('#roleSearch').val('');

            $('#statusFilter').val('');

            table.search('');

            table.column(3).search('');

            table.draw();

        });

    });
</script>
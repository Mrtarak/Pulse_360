
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
                                <i class="mdi mdi-account-multiple me-2"></i>
                                User List
                            </h4>

                            <div class="d-flex align-items-center gap-2">
                                <?= view('includes/messages'); ?>

                                <a href="<?= base_url('users/add'); ?>"
                                   class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-plus-circle-outline me-1"></i>
                                    Add New User
                                </a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">

                                <!-- Search and Filters -->
                                <div class="row mb-4">

                                    <div class="col-md-4">
                                        <label for="userSearch" class="form-label fw-bold">
                                            <i class="mdi mdi-magnify"></i>
                                            Search User
                                        </label>

                                        <input
                                            type="text"
                                            id="userSearch"
                                            class="form-control"
                                            placeholder="Search by Name, Email or ID">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="roleFilter" class="form-label fw-bold">
                                            <i class="mdi mdi-account-key-outline"></i>
                                            Role
                                        </label>

                                        <select id="roleFilter" class="form-select">
                                            <option value="">All Roles</option>

                                            <?php
                                            $roles = [];

                                            foreach ($users ?? [] as $user) {
                                                if (!empty($user['Role_Name'])) {
                                                    $roles[] = $user['Role_Name'];
                                                }
                                            }

                                            $roles = array_unique($roles);
                                            sort($roles);

                                            foreach ($roles as $role):
                                            ?>
                                                <option value="<?= esc($role) ?>">
                                                    <?= esc($role) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="statusFilter" class="form-label fw-bold">
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

                                    <div class="col-md-2 d-flex align-items-end">
                                        <button
                                            type="button"
                                            id="resetFilters"
                                            class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                                            <i class="mdi mdi-refresh me-1"></i>
                                            Reset
                                        </button>
                                    </div>

                                </div>

                                <!-- Users Table -->
                                <div class="table-responsive">
                                    <table id="usersTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if (!empty($users)): ?>

                                                <?php $i = 1; ?>

                                                <?php foreach ($users as $user): ?>
                                                    <tr>
                                                        <!-- Serial Number -->
                                                        <td><?= $i++ ?></td>

                                                        <!-- User ID -->
                                                        <td>
                                                            <?= esc($user['User_Id'] ?? '') ?>
                                                        </td>

                                                        <!-- Full User Name -->
                                                        <td>
                                                            <?= esc(
                                                                trim(
                                                                    ($user['User_FirstName'] ?? '') . ' ' .
                                                                    ($user['User_LastName'] ?? '')
                                                                )
                                                            ) ?>
                                                        </td>

                                                        <!-- Email Address -->
                                                        <td>
                                                            <?= esc($user['User_Login_MailID'] ?? '') ?>
                                                        </td>

                                                        <!-- Role -->
                                                        <td>
                                                            <?= esc($user['Role_Name'] ?? '—') ?>
                                                        </td>

                                                        <!-- Status -->
                                                        <td>
                                                            <?php
                                                            $status = $user['User_Status'] ?? 'Inactive';

                                                            switch ($status) {
                                                                case 'Active':
                                                                    $color = '#28a745';
                                                                    break;

                                                                case 'Inactive':
                                                                    $color = '#dc3545';
                                                                    break;

                                                                case 'Completed':
                                                                    $color = '#6c757d';
                                                                    break;

                                                                default:
                                                                    $color = '#6c757d';
                                                                    break;
                                                            }
                                                            ?>

                                                            <span style="
                                                                background-color: <?= $color ?>;
                                                                color: white;
                                                                padding: 5px 10px;
                                                                border-radius: 5px;
                                                                display: inline-block;
                                                            ">
                                                                <?= esc($status) ?>
                                                            </span>
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <a
                                                                href="<?= base_url('users/view/' . rawurlencode($user['User_Id'] ?? '')); ?>"
                                                                class="btn btn-info btn-sm"
                                                                title="View User">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>

                                                            <a
                                                                href="<?= base_url('users/edit/' . rawurlencode($user['User_Id'] ?? '')); ?>"
                                                                class="btn btn-warning btn-sm"
                                                                title="Edit User">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php else: ?>

                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No users found.
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

            <?= view('includes/footer'); ?>

            <!-- DataTables CSS -->
            <link
                rel="stylesheet"
                href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function () {

                    var table = $('#usersTable').DataTable({
                        dom: 'lrtip',
                        paging: true,
                        ordering: true,
                        info: true,
                        pageLength: 10,
                        columnDefs: [
                            {
                                targets: 6,
                                orderable: false,
                                render: function (data, type) {
                                    if (type === 'filter' || type === 'sort') {
                                        return $('<div>').html(data).text().trim();
                                    }

                                    return data;
                                }
                            }
                        ]
                    });

                    // Search by name, email, user ID, or other table data.
                    $('#userSearch').on('keyup', function () {
                        table.search($(this).val()).draw();
                    });

                    // Filter by role: column index 4.
                    $('#roleFilter').on('change', function () {
                        table
                            .column(4)
                            .search($(this).val())
                            .draw();
                    });

                    // Filter by status: column index 5.
                    $('#statusFilter').on('change', function () {
                        let status = $(this).val();

                        table
                            .column(5)
                            .search(
                                status ? '^' + status + '$' : '',
                                true,
                                false
                            )
                            .draw();
                    });

                    // Reset all filters.
                    $('#resetFilters').on('click', function () {
                        $('#userSearch').val('');
                        $('#roleFilter').val('');
                        $('#statusFilter').val('');

                        table.search('');
                        table.column(4).search('');
                        table.column(5).search('');

                        table.draw();
                    });

                });
            </script>

        </div>
    </div>
</div>

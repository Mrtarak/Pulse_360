<?= view('includes/header'); ?>

<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">

        <div class="content-wrapper">

            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <?= view(
                            'includes/breadcrumb',
                            [
                                'main' => 'Dashboard',
                                'sub'  => 'Vijetaas',
                                'sub_url' => base_url('students/vijetaas'),
                                'third' => 'Goal Management'
                            ]
                        ); ?>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h4 class="card-title mb-0">

                                <i class="mdi mdi-account-group me-2"></i>

                                Vijetaas – Goal Management

                            </h4>

                        </div>

                        <?= view('includes/messages'); ?>

                        <p class="card-description">

                            Manage each Vijetaas student, assign goals, and review progress by six-month session.

                        </p>

                        <div class="table-responsive">

                            <table id="goalManagementTable"
                                class="table table-striped">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Vijetaas Name</th>

                                        <th>Current Session</th>

                                        <th>Total Goals</th>

                                        <th>Active Goals</th>

                                        <th>Completed Goals</th>

                                        <th>Status</th>

                                        <th width="160">Actions</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php if (!empty($students)): ?>

                                        <?php $i = 1; ?>

                                        <?php foreach ($students as $student): ?>

                                            <?php
                                            $studentName = trim(
                                                ($student['First_Name'] ?? '') . ' ' .
                                                    ($student['Last_Name'] ?? '')
                                            );

                                            $sessionName = $student['Session_Name'] ?? 'Not Assigned';

                                            $studentStatus = $student['Vijeta_Status'] ?? 'Inactive';
                                            ?>

                                            <tr>

                                                <!-- Serial Number -->
                                                <td>
                                                    <?= $i++ ?>
                                                </td>

                                                <!-- Student Name -->
                                                <td>
                                                    <?= esc($studentName) ?>
                                                </td>

                                                <!-- Current Session -->
                                                <td>
                                                    <?= esc($sessionName) ?>
                                                </td>

                                                <!-- Total Goals -->
                                                <td>
                                                    <?= (int) ($student['Total_Goals'] ?? 0) ?>
                                                </td>

                                                <!-- Active Goals -->
                                                <td>
                                                    <?= (int) ($student['Active_Goals'] ?? 0) ?>
                                                </td>

                                                <!-- Completed Goals -->
                                                <td>
                                                    <?= (int) ($student['Completed_Goals'] ?? 0) ?>
                                                </td>

                                                <!-- Status -->
                                                <td>

                                                    <?php if ($studentStatus === 'Active'): ?>

                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>

                                                    <?php elseif ($studentStatus === 'Completed'): ?>

                                                        <span class="badge badge-info">
                                                            Completed
                                                        </span>

                                                    <?php else: ?>

                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>

                                                    <?php endif; ?>

                                                </td>

                                                <!-- Actions -->
                                                <td>

                                                    <a href="<?= base_url(
                                                                    'students/vijetaas/assign-goal/' .
                                                                        $student['Vijetaas_Stu_Id']
                                                                ) ?>"
                                                        class="btn btn-info btn-sm"
                                                        title="Assign Goals">

                                                        <i class="mdi mdi-plus"></i>

                                                    </a>

                                                    <a href="<?= base_url(
                                                                    'students/vijetaas/goals/review/' .
                                                                        $student['Vijetaas_Stu_Id']
                                                                ) ?>"
                                                        class="btn btn-warning btn-sm"
                                                        title="Review Goals">

                                                        <i class="mdi mdi-clipboard-check"></i>

                                                    </a>

                                                    <a href="<?= base_url(
                                                                    'students/vijetaas/goals/view-student/' .
                                                                        $student['Vijetaas_Stu_Id']
                                                                ) ?>"
                                                        class="btn btn-primary btn-sm"
                                                        title="View Goals">

                                                        <i class="mdi mdi-eye"></i>

                                                    </a>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <tr>

                                            <td colspan="8" class="text-center">

                                                No Vijetaas students found

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        $('#goalManagementTable').DataTable({

            paging: true,

            searching: true,

            ordering: true,

            info: true,

            order: [],

            language: {

                search: "_INPUT_",

                searchPlaceholder: "Search student..."

            },

            columnDefs: [

                {
                    targets: 7,
                    orderable: false
                }

            ]

        });

    });
</script>
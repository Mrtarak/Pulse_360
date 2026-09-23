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
                                'sub'  => 'Vijetaas Students',
                                'sub_url' => base_url('students/vijetaas')
                            ]
                        ); ?>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h4 class="card-title mb-0">

                                <i class="mdi mdi-account-group me-2"></i>

                                Vijetaas

                            </h4>

                            <?= view('includes/messages'); ?>

                            <a href="<?= base_url('students/vijetaas/add') ?>"
                                class="btn btn-primary btn-sm">

                                <i class="mdi mdi-plus-circle-outline me-1"></i>

                                Add New Student

                            </a>

                        </div>

                        <p class="card-description">

                            Manage Vijetaas Students

                        </p>


                        <div class="table-responsive">

                            <table
                                id="studentTable"
                                class="table table-striped">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Student ID</th>

                                        <th>Name</th>

                                        <th>Highest Qualification</th>

                                        <th>Email</th>

                                        <th>Phone</th>

                                        <th>Status</th>

                                        <th width="160">Actions</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php if (!empty($personalDetails)): ?>

                                        <?php $i = 1; ?>

                                        <?php foreach ($personalDetails as $student): ?>

                                            <tr>

                                                <!-- Serial Number -->
                                                <td>
                                                    <?= $i++ ?>
                                                </td>


                                                <!-- Student ID -->
                                                <td>

                                                    <?= esc(
                                                        $student['Vijetaas_Stu_Id'] ?? ''
                                                    ) ?>

                                                </td>


                                                <!-- Name -->
                                                <td>

                                                    <?= esc(
                                                        trim(
                                                            ($student['First_Name'] ?? '') .
                                                                ' ' .
                                                                ($student['Last_Name'] ?? '')
                                                        )
                                                    ) ?>

                                                </td>


                                                <!-- Highest Education -->
                                                <td>
                                                    <?= esc(
                                                        trim(
                                                            ($student['Highest_Qualification'] ?? '') .
                                                                (
                                                                    !empty($student['Highest_Specialization_Subject'])
                                                                    ? ' - ' . $student['Highest_Specialization_Subject']
                                                                    : ''
                                                                )
                                                        )
                                                    ) ?>
                                                </td>


                                                <!-- Email -->
                                                <td>

                                                    <?= esc(
                                                        $student['Email_Id'] ?? ''
                                                    ) ?>

                                                </td>


                                                <!-- Location -->
                                                <td>
                                                    <?= esc($student['Phone_No'] ?? '') ?>
                                                </td>


                                                <!-- Status -->
                                                <td>

                                                    <?php if (($student['Student_Status'] ?? '') == 'Active'): ?>

                                                        <span class="badge badge-success">

                                                            Active

                                                        </span>

                                                    <?php elseif (($student['Student_Status'] ?? '') == 'Completed'): ?>

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
                                                                    'students/vijetaas/view/' .
                                                                        $student['Vijetaas_Stu_Id']
                                                                ) ?>"
                                                        class="btn btn-info btn-sm">

                                                        <i class="mdi mdi-eye"></i>

                                                    </a>


                                                    <a href="<?= base_url(
                                                                    'students/vijetaas/edit/' .
                                                                        $student['Vijetaas_Stu_Id']
                                                                ) ?>"
                                                        class="btn btn-warning btn-sm">

                                                        <i class="mdi mdi-pencil"></i>

                                                    </a>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <tr>

                                            <td colspan="8"
                                                class="text-center">

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

        $('#studentTable').DataTable({

            paging: true,

            searching: true,

            ordering: true,

            info: true,

            language: {

                search: "_INPUT_",

                searchPlaceholder: "Search student..."

            }

        });

    });
</script>
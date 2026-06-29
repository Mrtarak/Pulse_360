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
                                'sub'  => 'Learning Adda Students',
                                'sub_url' => base_url('students/learning_adda')
                            ]
                        ); ?>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h4 class="card-title mb-0">
                                Learning Adda Students
                            </h4>

                            <?= view('includes/messages'); ?>

                            <a href="<?= base_url('students/learning_adda/add') ?>"
                                class="btn btn-primary btn-sm">

                                <i class="mdi mdi-plus-circle-outline me-1"></i>

                                Add New Student

                            </a>

                        </div>

                        <p class="card-description">
                            Manage Learning Adda Students
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

                                        <th>Gender</th>

                                        <th>Phone</th>

                                        <th>Email</th>

                                        <th>Center</th>

                                        <th>Batch</th>

                                        <th>Status</th>

                                        <th width="160">Actions</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php if (!empty($students)): ?>

                                        <?php $i = 1; ?>

                                        <?php foreach ($students as $student): ?>

                                            <tr>

                                                <td><?= $i++ ?></td>

                                                <td>
                                                    <?= esc($student['LA_Stu_Id']) ?>
                                                </td>

                                                <td>
                                                    <?= esc(
                                                        trim(
                                                            ($student['First_Name'] ?? '') .
                                                                ' ' .
                                                                ($student['Last_Name'] ?? '')
                                                        )
                                                    ) ?>
                                                </td>

                                                <td>
                                                    <?= esc($student['Gender'] ?? '') ?>
                                                </td>

                                                <td>
                                                    <?= esc($student['Phone_No'] ?? '') ?>
                                                </td>

                                                <td>
                                                    <?= esc($student['Email_Id'] ?? '') ?>
                                                </td>

                                                <td>
                                                    <?= esc($student['Center_Name'] ?? '') ?>
                                                </td>

                                                <td>
                                                    <?= esc($student['Batch_Name'] ?? '') ?>
                                                </td>

                                                <td>

                                                    <?php if (($student['LA_Status'] ?? '') == 'Active'): ?>

                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>

                                                    <?php elseif (($student['LA_Status'] ?? '') == 'Completed'): ?>

                                                        <span class="badge badge-info">
                                                            Completed
                                                        </span>

                                                    <?php else: ?>

                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>

                                                    <?php endif; ?>

                                                </td>

                                                <td>
                                                    <a href="<?= base_url('students/learning_adda/view/' . $student['LA_Stu_Id']) ?>"
                                                        class="btn btn-info btn-sm">

                                                        <i class="mdi mdi-eye"></i>

                                                    </a>

                                                    <a href="<?= base_url('students/learning_adda/edit/' . $student['LA_Stu_Id']) ?>"
                                                        class="btn btn-warning btn-sm">

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
<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">

        <?= view('includes/sidebar'); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <?= view('includes/breadcrumb'); ?>
                                <?= view('includes/messages'); ?>

                                <!-- Page Heading -->
                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <h4 class="card-title mb-0">
                                        <i class="mdi mdi-laptop menu-icon me-2"></i>
                                        Digital Shakti Participants
                                    </h4>

                                    <a href="<?= site_url('digitalshakti/add') ?>"
                                        class="btn btn-primary btn-sm">

                                        <i class="mdi mdi-plus-circle-outline me-1"></i>
                                        Add New Student

                                    </a>

                                </div>

                                <p class="card-description">
                                    Manage Digital Shakti Students
                                </p>

                                <!-- Student Table -->
                                <div class="table-responsive">

                                    <table class="table table-striped" id="studentTable">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Student ID</th>

                                                <th>Name</th>

                                                <th>Gender</th>

                                                <th>Phone</th>

                                                <th>Email</th>

                                                <th>Status</th>

                                                <th>Actions</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php if (!empty($students)): ?>

                                                <?php $i = 1; ?>

                                                <?php foreach ($students as $stu): ?>

                                                    <tr>

                                                        <!-- Serial Number -->
                                                        <td>
                                                            <?= $i++ ?>
                                                        </td>

                                                        <!-- Student ID -->
                                                        <td>
                                                            <?= esc($stu['DS_Stu_Id'] ?? '-') ?>
                                                        </td>

                                                        <!-- Name -->
                                                        <td>
                                                            <?= esc(
                                                                trim(
                                                                    ($stu['First_Name'] ?? '') . ' ' .
                                                                        ($stu['Last_Name'] ?? '')
                                                                )
                                                            ) ?>
                                                        </td>

                                                        <!-- Gender -->
                                                        <td>
                                                            <?= esc($stu['Gender'] ?? '-') ?>
                                                        </td>

                                                        <!-- Phone -->
                                                        <td>
                                                            <?= esc($stu['Phone_No'] ?? '-') ?>
                                                        </td>

                                                        <!-- Email -->
                                                        <td>
                                                            <?= esc($stu['Email_Id'] ?? '-') ?>
                                                        </td>

                                                        <!-- Status -->
                                                        <td>

                                                            <?php if (($stu['DS_Status'] ?? '') === 'Active'): ?>

                                                                <label class="badge badge-success">
                                                                    Active
                                                                </label>

                                                            <?php elseif (($stu['DS_Status'] ?? '') === 'Completed'): ?>

                                                                <label class="badge badge-info">
                                                                    Completed
                                                                </label>

                                                            <?php else: ?>

                                                                <label class="badge badge-danger">
                                                                    Inactive
                                                                </label>

                                                            <?php endif; ?>

                                                        </td>

                                                        <!-- Actions -->
                                                        <td>

                                                            <a href="<?= site_url('digitalshakti/view/' . $stu['DS_Stu_Id']) ?>"
                                                                class="btn btn-info btn-sm"
                                                                title="View">

                                                                <i class="mdi mdi-eye"></i>

                                                            </a>

                                                            <a href="<?= site_url('digitalshakti/edit/' . $stu['DS_Stu_Id']) ?>"
                                                                class="btn btn-warning btn-sm"
                                                                title="Edit">

                                                                <i class="mdi mdi-pencil"></i>

                                                            </a>

                                                        </td>

                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php else: ?>

                                                <tr>

                                                    <td colspan="8" class="text-center">

                                                        No Digital Shakti students found

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

    </div>

</div>

<?= view('includes/footer'); ?>


<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet"
    href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        $('#studentTable').DataTable({

            paging: true,

            searching: true,

            ordering: true,

            info: true,

            pageLength: 10,

            language: {

                search: "",

                searchPlaceholder: "Search student..."

            },

            columnDefs: [

                {
                    orderable: false,
                    targets: [7]
                }

            ]

        });

    });
</script>
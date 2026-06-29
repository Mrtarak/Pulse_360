<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">
           



                <!-- Header with Status Filter -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="mdi mdi-book-open-page-variant me-2"></i>Vijetaas List</h4>
                    <?= view('includes/messages'); ?>
                    <div class="d-flex align-items-center">
                        <label for="statusFilter" class="me-2">Status:</label>
                        <select id="statusFilter" class="form-select me-3" style="width: 150px;">
                            <option value="">All</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <a href="<?= site_url('students/vijetaas/add') ?>" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus-circle-outline me-1"></i> Add Vijetaas
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="card">
                    <ul class="nav nav-tabs" id="vijetaasTabs">

                        <li class="nav-item">
                            <a class="nav-link active"
                                data-bs-toggle="tab"
                                href="#personalTab">
                                Personal Details
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                data-bs-toggle="tab"
                                href="#goalTab">
                                Goal Details
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                data-bs-toggle="tab"
                                href="#mentorTab">
                                Mentor Details
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active"
                            id="personalTab">

                            <div class="table-responsive">

                                <table id="personalTable"
                                    class="table table-bordered table-striped">

                                    <thead>
                                        <tr>

                                            <th>#</th>

                                            <th>Name</th>

                                            <th>Education</th>

                                            <th>Email</th>

                                            <th>Location</th>

                                            <th>Status</th>

                                            <th>Actions</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php if (!empty($personalDetails)): ?>

                                            <?php $i = 1; ?>

                                            <?php foreach ($personalDetails as $row): ?>

                                                <tr>

                                                    <td><?= $i++ ?></td>

                                                    <td>
                                                        <?= esc(
                                                            $row['First_Name']
                                                                . ' ' .
                                                                $row['Last_Name']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Current_Education_level']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Email_Id']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Village_City']
                                                                . ', ' .
                                                                $row['State']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        $status = $row['Student_Status'];
                                                        $color = '';

                                                        switch ($status) {
                                                            case 'Active':
                                                                $color = '#28a745';
                                                                break;

                                                            case 'Inactive':
                                                            case 'Inactive':
                                                                $color = '#dc3545';
                                                                break;

                                                            case 'Completed':
                                                                $color = '#ffc107';
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
                                                        font-weight: 500;
                                                        min-width: 90px;
                                                        text-align: center;
                                                    ">
                                                            <?= esc($status) ?>
                                                        </span>
                                                    </td>

                                                    <td>

                                                        <a href="<?= site_url(
                                                                        'students/vijetaas/view/'
                                                                            . $row['Vijetaas_Stu_Id']
                                                                    ) ?>"
                                                            class="btn btn-info btn-sm">

                                                            View

                                                        </a>

                                                        <a href="<?= site_url(
                                                                        'students/vijetaas/edit/'
                                                                            . $row['Vijetaas_Stu_Id']
                                                                    ) ?>"
                                                            class="btn btn-warning btn-sm">

                                                            Edit

                                                        </a>



                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                        <div class="tab-pane fade"
                            id="goalTab">

                            <div class="table-responsive">

                                <table id="goalTable"
                                    class="table table-bordered table-striped">

                                    <thead>

                                        <tr>

                                            <th>#</th>

                                            <th>Name</th>

                                            <th>Goal</th>

                                            <th>Target</th>

                                            <th>Achieved</th>

                                            <th>Self Progress</th>

                                            <th>Mentor Progress</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php if (!empty($goalDetails)): ?>

                                            <?php $i = 1; ?>

                                            <?php foreach ($goalDetails as $row): ?>

                                                <tr>

                                                    <td><?= $i++ ?></td>

                                                    <td>
                                                        <?= esc(
                                                            $row['First_Name']
                                                                . ' ' .
                                                                $row['Last_Name']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Goal_Title']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Target_Value']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Achieved_Value']
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Self_Progress']
                                                        ) ?>%
                                                    </td>

                                                    <td>
                                                        <?= esc(
                                                            $row['Mentor_Progress']
                                                        ) ?>%
                                                    </td>

                                                    <td>

                                                        <a href="<?= site_url('students/vijetaas/view/' . $row['Vijetaas_Stu_Id']) ?>"
                                                            class="btn btn-info btn-sm">
                                                            View
                                                        </a>

                                                        <a href="<?= site_url('students/vijetaas/edit/' . $row['Vijetaas_Stu_Id']) ?>"
                                                            class="btn btn-warning btn-sm">
                                                            Edit
                                                        </a>



                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                        <div class="tab-pane fade"
                            id="mentorTab">

                            <div class="table-responsive">

                                <table id="mentorTable"
                                    class="table table-bordered table-striped">

                                    <thead>

                                        <tr>

                                            <th>#</th>

                                            <th>Name</th>

                                            <th>Mentor</th>

                                            <th>Status</th>

                                            <th>Enrollment Date</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php if (!empty($mentorDetails)): ?>

                                            <?php $i = 1; ?>

                                            <?php foreach ($mentorDetails as $row): ?>

                                                <tr>

                                                    <td><?= $i++ ?></td>

                                                    <td>
                                                        <?= esc(
                                                            $row['First_Name']
                                                                . ' ' .
                                                                $row['Last_Name']
                                                        ) ?>
                                                    </td>

                                                    <td>

                                                        <?= esc(
                                                            $row['User_FirstName']
                                                                . ' ' .
                                                                $row['User_LastName']
                                                        ) ?>

                                                    </td>

                                                    <td>
                                                        <?php
                                                        $status = $row['Vijeta_Status'];
                                                        $color = '';

                                                        switch ($status) {
                                                            case 'Active':
                                                                $color = '#28a745';
                                                                break;

                                                            case 'Inactive':
                                                            case 'Inactive':
                                                                $color = '#dc3545';
                                                                break;

                                                            case 'Completed':
                                                                $color = '#ffc107';
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
                                                        font-weight: 500;
                                                        min-width: 90px;
                                                        text-align: center;
                                                    ">
                                                            <?= esc($status) ?>
                                                        </span>
                                                    </td>

                                                    <td>

                                                        <?= esc(
                                                            $row['Enrollment_Date']
                                                        ) ?>

                                                    </td>

                                                    <td>

                                                        <a href="<?= site_url('students/vijetaas/view/' . $row['Vijetaas_Stu_Id']) ?>"
                                                            class="btn btn-info btn-sm">
                                                            View
                                                        </a>

                                                        <a href="<?= site_url('students/vijetaas/edit/' . $row['Vijetaas_Stu_Id']) ?>"
                                                            class="btn btn-warning btn-sm">
                                                            Edit
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    $(document).ready(function() {

                        $('#personalTable').DataTable();

                        $('#goalTable').DataTable();

                        $('#mentorTable').DataTable();

                    });
                </script>

                <?= view('includes/footer'); ?>

                <!-- DataTables -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
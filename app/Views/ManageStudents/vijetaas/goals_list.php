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
                                <i class="mdi mdi-book-open-page-variant me-2"></i>
                                Goal Master List
                            </h4>
                            <?= view('includes/messages'); ?>

                            <a href="<?= base_url('goals/add'); ?>"
                               class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus-circle-outline me-1"></i>
                                Add New Goal
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="goalsTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Goal ID</th>
                                        <th>Goal Title</th>
                                        <th>Goal Type</th>
                                        <th>Default Target</th>
                                        <th>Status</th>
                                        <th>Added By</th>
                                        <th>Added On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($goals)): ?>
                                        <?php $i = 1; ?>

                                        <?php foreach ($goals as $goal): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>

                                                <td>
                                                    <?= esc($goal['Goal_Id']) ?>
                                                </td>

                                                <td>
                                                    <?= esc($goal['Goal_Title']) ?>
                                                </td>

                                                <td>
                                                    <?= esc($goal['Goal_Type_Name'] ?? $goal['Goal_Type_Id']) ?>
                                                </td>

                                                <td>
                                                    <?= esc($goal['Default_Target_Value']) ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $status = $goal['Goal_Status'];

                                                    $color = match($status){
                                                        'Active' => '#28a745',
                                                        'Inactive' => '#dc3545',
                                                        default => '#6c757d'
                                                    };
                                                    ?>

                                                    <span style="
                                                        background-color: <?= $color ?>;
                                                        color:white;
                                                        padding:5px 10px;
                                                        border-radius:5px;">
                                                        <?= esc($status) ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <?= esc($goal['Rec_Added_By']) ?>
                                                </td>

                                                <td>
                                                    <?= esc($goal['Rec_Added_On']) ?>
                                                </td>

                                                <td>
                                                    <a href="<?= base_url('goals/view/'.$goal['Goal_Id']) ?>"
                                                       class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <a href="<?= base_url('goals/edit/'.$goal['Goal_Id']) ?>"
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

<?= view('includes/footer'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {

    $('#goalsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });

});
</script>
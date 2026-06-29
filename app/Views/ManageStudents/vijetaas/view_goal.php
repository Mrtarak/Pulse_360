<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card">
                <div class="card-body">

                    <?= view('includes/breadcrumb'); ?>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">
                            <i class="mdi mdi-eye me-2"></i>Goal Details
                        </h4>

                        
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Goal ID</label>
                            <p><?= esc($goal['Goal_Id']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Goal Type</label>
                            <p><?= esc($goal['Goal_Type_Name']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Goal Title</label>
                            <p><?= esc($goal['Goal_Title']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Default Target Value</label>
                            <p><?= esc($goal['Default_Target_Value']) ?></p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="fw-bold">Goal Description</label>
                            <p><?= esc($goal['Goal_Description']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Goal Status</label>
                            <p>
                                <?php
                                $status = $goal['Goal_Status'];

                                $color = match ($status) {
                                    'Active'   => '#28a745',
                                    'Inactive' => '#dc3545',
                                    default    => '#6c757d',
                                };
                                ?>
                                <span style="background:<?= $color ?>;color:#fff;padding:5px 10px;border-radius:5px;">
                                    <?= esc($status) ?>
                                </span>
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Recorded By</label>
                            <p><?= esc($goal['Rec_Added_By']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Recorded On</label>
                            <p><?= esc($goal['Rec_Added_On']) ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Updated By</label>
                            <p><?= esc($goal['Rec_Updated_By'] ?? '-') ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Last Updated On</label>
                            <p><?= esc($goal['Rec_Last_Updated_On'] ?? '-') ?></p>
                        </div>

                    </div>
                    <div>
                        <td>
                            

                            <a href="<?= base_url('goals/edit/' . $goal['Goal_Id']) ?>"
                                class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil"></i>Edit
                            </a>

                            <a href="<?= base_url('goals/delete/' . $goal['Goal_Id']) ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this Goal?')">
                                <i class="mdi mdi-delete"></i>Delete
                            </a>
                        </td>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?= view('includes/footer'); ?>
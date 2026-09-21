<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <?= $this->include('includes/breadcrumb'); ?>

                        <h4 class="card-title mb-4">
                            <i class="mdi mdi-shield-account-outline me-2"></i> Role Details
                        </h4>

                        <!-- Details -->
                        <div class="row view-details">

                            <div class="col-md-12 mb-2 d-flex">
                                <div style="min-width: 200px;">
                                    <strong>Role Name</strong> :
                                </div>

                                <div class="ms-3">
                                    <?= esc($role['Role_Name']) ?>
                                </div>
                            </div>


                            <div class="col-md-12 mb-2 d-flex">
                                <div style="min-width: 200px;">
                                    <strong>Role Description</strong> :
                                </div>

                                <div class="ms-3">
                                    <?= esc($role['Role_Description'] ?? '') ?>
                                </div>
                            </div>


                            <div class="col-md-12 mb-2 d-flex">
                                <div style="min-width: 200px;">
                                    <strong>Status</strong> :
                                </div>

                                <?php
                                $status = $role['Role_Status'];

                                $color = match ($status) {
                                    'Active' => '#28a745',
                                    'Inactive' => '#dc3545',
                                    default => '#6c757d',
                                };
                                ?>

                                <span
                                    class="status-badge"
                                    style="background-color: <?= $color ?>; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                    <?= esc($status) ?>
                                </span>

                            </div>


                            <!-- actions -->
                            <div class=" mt-4 d-flex justify-content-center flex-wrap gap-3">

                                <a
                                    href="<?= base_url('roles/edit/' . $role['Role_Id']) ?>"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a
                                    href="<?= base_url('roles/delete/' . $role['Role_Id']) ?>"
                                    onclick="return confirm('Are you sure?')"
                                    class="btn btn-danger btn-sm">
                                    Delete
                                </a>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('includes/footer'); ?>
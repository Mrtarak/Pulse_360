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

                        <?php
                        $isSystemRole = ((int) ($role['Is_System_Role'] ?? 0) === 1);
                        ?>

                        <h4 class="card-title mb-4">

                            <i class="mdi mdi-account-key me-2"></i>
                            Role Details

                        </h4>


                        <?php if ($isSystemRole): ?>

                            <!-- Protected System Role Message -->
                            <div class="alert alert-primary d-flex align-items-center mb-4"
                                role="alert">

                                <i class="mdi mdi-shield-check mdi-24px me-3"></i>

                                <div>

                                    <strong>Protected System Role</strong>

                                    <div class="mt-1">

                                        Super Admin is a protected system role.
                                        It automatically has all active permissions
                                        and cannot be edited, deactivated, or deleted.

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>


                        <!-- =========================================================
                 ROLE DETAILS
            ========================================================== -->

                        <div class="row view-details">


                            <!-- Role Name -->
                            <div class="col-md-12 mb-2 d-flex">
                                <div style="min-width: 200px;">
                                    <strong>Role Name</strong> :
                                </div>

                                <div class="ms-3">
                                    <?= esc($role['Role_Name']) ?>
                                </div>
                            </div>


                            <!-- Description -->
                            <div class="col-md-12 mb-2 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Description</strong> :
                                </div>

                                <div class="ms-3">

                                    <?php if (!empty($role['Role_Description'])): ?>

                                        <?= nl2br(esc($role['Role_Description'])) ?>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>


                            <!-- Role Type -->
                            <div class="col-md-12 mb-2 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Role Type</strong> :
                                </div>

                                <div class="ms-3">

                                    <?php if ($isSystemRole): ?>

                                        <span
                                            style="
                                                background-color: #1B4482;
                                                color: white;
                                                padding: 5px 10px;
                                                border-radius: 5px;
                                                display: inline-block;
                                                width: fit-content;
                                            ">

                                            <i class="mdi mdi-shield-check me-1"></i>
                                            System Role

                                        </span>

                                    <?php else: ?>

                                        <span
                                            style="
                                                background-color: #3ca1fa;
                                                color: white;
                                                padding: 5px 10px;
                                                border-radius: 5px;
                                                display: inline-block;
                                                width: fit-content;
                                            ">

                                            Normal Role

                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>



                            <!-- Status -->
                            <div class="col-md-12 mb-2 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Status</strong> :
                                </div>

                                <?php
                                $status = $role['Role_Status'];

                                $color = match ($status) {
                                    'Active'   => '#28a745',
                                    'Inactive' => '#dc3545',
                                    default    => '#6c757d',
                                };
                                ?>

                                <span
                                    class="status-badge ms-3"
                                    style="
                    background-color: <?= $color ?>;
                    color: white;
                    padding: 5px 10px;
                    border-radius: 5px;
                    display: inline-block;
                  ">

                                    <?= esc($status) ?>

                                </span>

                            </div>


                            <!-- Role ID -->
                            <div class="col-md-12 mb-2 d-flex">

                                <div style="min-width: 200px;">
                                    <strong>Role ID</strong> :
                                </div>

                                <div class="ms-3">

                                    <?= esc($role['Role_Id']) ?>

                                </div>

                            </div>


                            <!-- =======================================================
                   ACTIONS
              ======================================================== -->

                            <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                                <?php if (!$isSystemRole): ?>

                                    <!-- Edit -->
                                    <a
                                        href="<?= base_url('roles/edit/' . $role['Role_Id']) ?>"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>


                                    <!-- Delete -->
                                    <a
                                        href="<?= base_url('roles/delete/' . $role['Role_Id']) ?>"
                                        onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm">

                                        Delete

                                    </a>

                                <?php else: ?>

                                    <!-- Protected System Role -->
                                    <span
                                        class="btn btn-secondary btn-sm disabled">

                                        <i class="mdi mdi-lock me-1"></i>

                                        Protected System Role

                                    </span>

                                <?php endif; ?>


                                <!-- Back -->
                                <a
                                    href="<?= base_url('roles') ?>"
                                    class="btn btn-light btn-sm">

                                    <i class="mdi mdi-arrow-left me-1"></i>

                                    Back

                                </a>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?= view('includes/footer'); ?>

    </div>

</div>
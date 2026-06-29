<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <a href="<?= site_url('program_theme') ?>" class="btn btn-secondary mb-3">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>

                            <?= view('includes/breadcrumb'); ?>

                            <h4 class="card-title mb-4">
                                <i class="mdi mdi-book-open-page-variant me-2"></i>
                                Program Theme Details
                            </h4>

                            <?php if (!empty($theme)): ?>

                                <div class="row view-details">

                                    <div class="col-md-12 mb-3">
                                        <strong>Program Theme Name:</strong>
                                        <?= esc($theme['Program_Theme_Name']) ?>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <strong>Description:</strong>
                                        <?= esc($theme['Theme_Description']) ?>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <strong>Suggested By:</strong>
                                        <?= esc($theme['Theme_Suggested_By']) ?>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <strong>Theme Added On:</strong>
                                        <?= esc($theme['Theme_Added_On']) ?>
                                    </div>

                                    <div class="col-md-12 mb-2 d-flex">
                                        <div style="min-width: 200px;">
                                            <strong>Status</strong> :
                                        </div>

                                        <?php
                                        $status = $theme['Theme_Status'];

                                        $color = match ($status) {
                                            'Active'   => '#28a745',
                                            'Inactive' => '#dc3545',
                                            default    => '#6c757d',
                                        };
                                        ?>

                                        <span
                                            class="status-badge"
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

                                </div>

                                <div class="text-center mt-4">

                                    <a href="<?= base_url('program_theme/edit/' . $theme['Program_Theme_Id']) ?>"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <a href="<?= base_url('program_theme/delete/' . $theme['Program_Theme_Id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this Program Theme?')">
                                        Delete
                                    </a>

                                </div>

                            <?php else: ?>

                                <div class="alert alert-danger">
                                    Program Theme not found.
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= view('includes/footer'); ?>
    </div>
</div>
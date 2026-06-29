<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">
    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <?= view('includes/breadcrumb'); ?>

                            <h4 class="card-title">Program Theme</h4>
                            <h4 class="card-description">Edit Program Theme</h4>

                            <?php if (isset($theme)) : ?>
                                <form id="programThemeForm"
                                    class="forms-sample"
                                    onsubmit="return validateProgramThemeForm()"
                                    action="<?= base_url('program_theme/update/' . $theme['Program_Theme_Id']) ?>"
                                    method="post">

                                    <div class="row">

                                        <div class="col-md-6 form-group">
                                            <label>Program Theme Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                id="program_theme_name"
                                                name="Program_Theme_Name"
                                                class="form-control"
                                                value="<?= esc($theme['Program_Theme_Name']) ?>"
                                                placeholder="Enter Program Theme Name">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <input type="text"
                                                id="theme_description"
                                                name="Theme_Description"
                                                class="form-control"
                                                value="<?= esc($theme['Theme_Description']) ?>"
                                                placeholder="Enter Description for Program Theme">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Theme Suggested By</label>
                                            <input type="text"
                                                name="Theme_Suggested_By"
                                                class="form-control"
                                                value="<?= esc($theme['Theme_Suggested_By']) ?>"
                                                placeholder="Enter who Suggested Theme">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Theme Added On</label>
                                            <input type="date"
                                                class="form-control"
                                                value="<?= esc($theme['Theme_Added_On']) ?>"
                                                readonly>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label>Status</label>

                                            <select name="Theme_Status" class="form-select" required>

                                                <option value="Active"
                                                    <?= $theme['Theme_Status'] == 'Active' ? 'selected' : '' ?>>
                                                    Active
                                                </option>

                                                <option value="Inactive"
                                                    <?= $theme['Theme_Status'] == 'Inactive' ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                                        <a href="<?= site_url('program_theme') ?>" class="btn btn-light">
                                            Cancel
                                        </a>

                                        <button type="submit" class="btn btn-primary me-2">
                                            Save
                                        </button>
                                    </div>

                                </form>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= view('includes/footer'); ?>
    </div>
</div>
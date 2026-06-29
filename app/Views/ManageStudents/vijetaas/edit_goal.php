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

                            <h4 class="card-title">Edit Goal</h4>

                            <form method="post" action="<?= site_url('goals/update/' . $goal['Goal_Id']) ?>">

                                <div class="row">

                                    <!-- Goal ID -->
                                    <div class="col-md-6 form-group">
                                        <label>Goal ID</label>
                                        <input type="text"
                                               name="Goal_Id"
                                               class="form-control"
                                               value="<?= esc($goal['Goal_Id']) ?>"
                                               readonly>
                                    </div>

                                    <!-- Goal Type -->
                                    <div class="col-md-6 form-group">
                                        <label>Goal Type <span class="text-danger">*</span></label>

                                        <select name="Goal_Type_Id" class="form-control" required>
                                            <option value="">-- Select Goal Type --</option>

                                            <?php foreach ($types as $type): ?>
                                                <option value="<?= $type['Goal_Type_Id'] ?>"
                                                    <?= ($goal['Goal_Type_Id'] == $type['Goal_Type_Id']) ? 'selected' : '' ?>>
                                                    <?= esc($type['Goal_Type_Name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Goal Title -->
                                    <div class="col-md-12 form-group mt-3">
                                        <label>Goal Title <span class="text-danger">*</span></label>

                                        <input type="text"
                                               name="Goal_Title"
                                               class="form-control"
                                               value="<?= esc($goal['Goal_Title']) ?>"
                                               required>
                                    </div>

                                    <!-- Goal Description -->
                                    <div class="col-md-12 form-group mt-3">
                                        <label>Goal Description</label>

                                        <textarea name="Goal_Description"
                                                  class="form-control"
                                                  rows="4"><?= esc($goal['Goal_Description']) ?></textarea>
                                    </div>

                                    <!-- Default Target Value -->
                                    <div class="col-md-6 form-group mt-3">
                                        <label>Default Target Value</label>

                                        <input type="text"
                                               name="Default_Target_Value"
                                               class="form-control"
                                               value="<?= esc($goal['Default_Target_Value']) ?>">
                                    </div>

                                    <!-- Goal Status -->
                                    <div class="col-md-6 form-group mt-3">
                                        <label>Status</label>

                                        <select name="Goal_Status" class="form-control">
                                            <option value="Active"
                                                <?= ($goal['Goal_Status'] == 'Active') ? 'selected' : '' ?>>
                                                Active
                                            </option>

                                            <option value="Inactive"
                                                <?= ($goal['Goal_Status'] == 'Inactive') ? 'selected' : '' ?>>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mt-4 d-flex justify-content-center">
                                    <a href="<?= site_url('goals') ?>" class="btn btn-light me-2">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        Update Goal
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('includes/footer'); ?>
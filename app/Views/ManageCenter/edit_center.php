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

                            <h4 class="card-title">Center</h4>
                            <p class="card-description">Edit Center</p>

                            <form class="forms-sample"
                                action="<?= site_url('center/update/' . $center['Center_Id']) ?>"
                                method="post">

                                <?= csrf_field() ?>

                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label>Center Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="Center_Name"
                                            class="form-control"
                                            value="<?= old('Center_Name', $center['Center_Name']) ?>"
                                            placeholder="Enter Center Name">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Description <span class="text-danger">*</span></label>

                                        <textarea
                                            name="Center_Description"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Enter Description"><?= old('Center_Description', $center['Center_Description']) ?></textarea>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Inaugurated By</label>
                                        <input type="text"
                                            name="Center_Inaugurated_By"
                                            class="form-control"
                                            value="<?= old('Center_Inaugurated_By', $center['Center_Inaugurated_By']) ?>"
                                            placeholder="Enter Who Inaugurated">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Opening Date</label>
                                        <input type="date"
                                            name="Center_Opening_Date"
                                            class="form-control"
                                            value="<?= old('Center_Opening_Date', $center['Center_Opening_Date']) ?>"
                                            max="<?= date('Y-m-d') ?>">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="Center_Address"
                                            class="form-control"
                                            value="<?= old('Center_Address', $center['Center_Address']) ?>"
                                            placeholder="Enter Address">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="Center_City"
                                            class="form-control"
                                            value="<?= old('Center_City', $center['Center_City']) ?>"
                                            placeholder="Enter City">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="Center_State"
                                            class="form-control"
                                            value="<?= old('Center_State', $center['Center_State']) ?>"
                                            placeholder="Enter State">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="Center_Pincode"
                                            class="form-control"
                                            value="<?= old('Center_Pincode', $center['Center_Pincode']) ?>"
                                            placeholder="Enter Pincode">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Capacity</label>
                                        <input type="text"
                                            name="Center_Capacity"
                                            class="form-control"
                                            value="<?= old('Center_Capacity', $center['Center_Capacity']) ?>"
                                            placeholder="Enter Capacity">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Status <span class="text-danger">*</span></label>

                                        <select class="form-select" name="Center_Status">

                                            <option value="">Select Status</option>

                                            <option value="Active"
                                                <?= old('Center_Status', $center['Center_Status']) == 'Active' ? 'selected' : '' ?>>
                                                Active
                                            </option>

                                            <option value="Inactive"
                                                <?= old('Center_Status', $center['Center_Status']) == 'Inactive' ? 'selected' : '' ?>>
                                                Inactive
                                            </option>

                                            <option value="Completed"
                                                <?= old('Center_Status', $center['Center_Status']) == 'Completed' ? 'selected' : '' ?>>
                                                Completed
                                            </option>

                                        </select>

                                    </div>

                                    <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                                        <a href="<?= site_url('center') ?>" class="btn btn-light">
                                            Cancel
                                        </a>

                                        <button type="submit" class="btn btn-primary">
                                            Update Center
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <?= view('includes/footer'); ?>
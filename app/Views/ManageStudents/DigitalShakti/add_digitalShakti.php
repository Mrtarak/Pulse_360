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

                            <form action="<?= base_url('digitalshakti/save') ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <ul class="nav nav-tabs" id="studentTabs">

                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            data-bs-toggle="tab"
                                            href="#personal">
                                            Personal Info
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#education">
                                            Education
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#program">
                                            Program
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#family">
                                            Family
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content mt-3">

                                    <!-- PERSONAL TAB -->

                                    <div class="tab-pane fade show active"
                                        id="personal">

                                        <div class="row">

                                            <div class="col-md-4 mb-3">
                                                <label>First Name</label>
                                                <input type="text"
                                                    name="first_name"
                                                    class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Last Name</label>
                                                <input type="text"
                                                    name="last_name"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Gender</label>
                                                <select name="gender"
                                                    class="form-control"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>DOB</label>
                                                <input type="date"
                                                    name="dob"
                                                    class="form-control"
                                                    max="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Aadhar No</label>
                                                <input type="text"
                                                    name="aadhar_no"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Phone</label>
                                                <input type="text"
                                                    name="phone"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Email</label>
                                                <input type="email"
                                                    name="email"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>City</label>
                                                <input type="text"
                                                    name="city"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>District</label>
                                                <input type="text"
                                                    name="district"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>State</label>
                                                <input type="text"
                                                    name="state"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Pincode</label>
                                                <input type="text"
                                                    name="pincode"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Nationality</label>
                                                <input type="text"
                                                    name="nationality"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>Address</label>
                                                <textarea name="address"
                                                    class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <button type="button"
                                            class="btn btn-primary next-tab">
                                            Next
                                        </button>

                                    </div>
                                    <!-- EDUCATION TAB -->

                                    <div class="tab-pane fade"
                                        id="education">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Current Education</label>
                                                <input type="text"
                                                    name="current_edu"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Highest Education</label>
                                                <input type="text"
                                                    name="highest_edu"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Caste</label>
                                                <input type="text"
                                                    name="caste"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Status</label>

                                                <select name="status"
                                                    class="form-control">

                                                    <option value="Active">
                                                        Active
                                                    </option>

                                                    <option value="Inactive">
                                                        Inactive
                                                    </option>

                                                </select>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between mt-3">

                                            <button type="button"
                                                class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary next-tab">
                                                Next
                                            </button>

                                        </div>

                                    </div>


                                    <!-- PROGRAM TAB -->

                                    <div class="tab-pane fade"
                                        id="program">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Enrollment Date</label>
                                                <input type="date"
                                                    name="enroll_date"
                                                    class="form-control"
                                                    max="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Program</label>
                                                <input type="text"
                                                    class="form-control"
                                                    value="Digital Shakti"
                                                    readonly>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Center</label>

                                                <select class="form-control"
                                                    name="center_id"
                                                    required>

                                                    <option value="">
                                                        Select Center
                                                    </option>

                                                    <?php foreach ($centers as $center): ?>

                                                        <option value="<?= $center['Center_Id']; ?>">
                                                            <?= esc($center['Center_Name']); ?>
                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Batch</label>

                                                <select class="form-control"
                                                    name="batch_id"
                                                    required>

                                                    <option value="">
                                                        Select Batch
                                                    </option>

                                                    <?php foreach ($batches as $batch): ?>

                                                        <option value="<?= $batch['Batch_Id']; ?>">
                                                            <?= esc($batch['Batch_Name']); ?>
                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Program Level</label>

                                                <input type="text"
                                                    name="program_level"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Program Status</label>

                                                <select name="program_status"
                                                    class="form-control">

                                                    <option value="Active">
                                                        Active
                                                    </option>

                                                    <option value="Completed">
                                                        Completed
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Program Till</label>

                                                <input type="date"
                                                    name="prog_till"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between mt-3">

                                            <button type="button"
                                                class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary next-tab">
                                                Next
                                            </button>

                                        </div>

                                    </div>
                                    <!-- FAMILY TAB -->

                                    <div class="tab-pane fade"
                                        id="family">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Father Name</label>
                                                <input type="text"
                                                    name="father_name"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Father Contact</label>
                                                <input type="text"
                                                    name="father_contact"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Father Email</label>
                                                <input type="email"
                                                    name="father_email"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Father Occupation</label>
                                                <input type="text"
                                                    name="father_occupation"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother Name</label>
                                                <input type="text"
                                                    name="mother_name"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother Contact</label>
                                                <input type="text"
                                                    name="mother_contact"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother Email</label>
                                                <input type="email"
                                                    name="mother_email"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother Occupation</label>
                                                <input type="text"
                                                    name="mother_occupation"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Income</label>
                                                <input type="text"
                                                    name="income"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Siblings</label>
                                                <input type="number"
                                                    name="siblings"
                                                    class="form-control">
                                            </div>

                                        </div>

                                        <div class="text-end">

                                            <button type="submit"
                                                class="btn btn-primary">
                                                Save Student
                                            </button>

                                        </div>

                                    </div>

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
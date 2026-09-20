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

                            <h4 class="card-title"><i class="mdi mdi-account-group menu-icon"></i> Add Student</h4>
                            <form
                                action="<?= site_url('students/vijetaas/store') ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="studentTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal Info</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#education">Education</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#program">Program</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#family">Family</a></li>
                                </ul>

                                <div class="tab-content mt-3">

                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane fade show active" id="personal">
                                        <div class="row">
                                            <div class="col-md-4 mb-3"><label>First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="First_Name" class="form-control" value="<?= old('First_Name') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="Last_Name" class="form-control" value="<?= old('Last_Name') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Gender <span class="text-danger">*</span></label>
                                                <select name="Gender" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option <?= old('Gender', 'Male') ?>>Male</option>
                                                    <option <?= old('Gender', 'Female') ?>>Female</option>
                                                    <option <?= old('Gender', 'Other') ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" name="DOB" class="form-control" value="<?= old('DOB') ?>" max="<?= date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3"><label>Caste <span class="text-danger">*</span></label><input type="text" class="form-control" name="caste"></div>
                                            <div class="col-md-4 mb-3"><label>Aadhar No</label>
                                                <input type="text" name="Aadhar_No" class="form-control" value="<?= old('Aadhar_No') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="Phone_No" class="form-control" value="<?= old('Phone_No') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Email </label>
                                                <input type="email" name="Email_Id" class="form-control" value="<?= old('Email_Id') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>City/Village <span class="text-danger">*</span></label>
                                                <input type="text" name="Village_City" class="form-control" value="<?= old('Village_City') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>District <span class="text-danger">*</span></label>
                                                <input type="text" name="District" class="form-control" value="<?= old('District') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>State <span class="text-danger">*</span></label>
                                                <input type="text" name="State" class="form-control" value="<?= old('State') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Pincode <span class="text-danger">*</span></label>
                                                <input type="text" name="Pincode" class="form-control" value="<?= old('Pincode') ?>">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Nationality <span class="text-danger">*</span></label>
                                                <input type="text" name="Nationality" class="form-control" value="<?= old('Nationality') ?>">
                                            </div>
                                            <div class="col-md-12 mb-3"><label>Address <span class="text-danger">*</span></label>
                                                <textarea name="Address" class="form-control" value="<?= old('Address') ?>"></textarea>
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Photo </label>
                                                <input type="file"
                                                    name="photo"
                                                    class="form-control"
                                                    accept="image/*">

                                                <small class="text-muted">
                                                    Maximum file size: <strong>2 MB</strong>. Allowed formats:
                                                    <strong>JPG, JPEG, PNG</strong>.
                                                </small>
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Aadhar Photo</label>
                                                <input type="file"
                                                    name="aadhar_photo"
                                                    class="form-control"
                                                    accept="image/*">

                                                <small class="text-muted">
                                                    Maximum file size: <strong>2 MB</strong>. Allowed formats:
                                                    <strong>JPG, JPEG, PNG</strong>.
                                                </small>
                                            </div>
                                            <div class="col-md-12 mb-3"><label>Remarks</label>
                                                <textarea name="Remarks" class="form-control" value="<?= old('Remarks') ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end"><button type="button" class="btn btn-primary next-tab">Next</button></div>
                                    </div>

                                    <!-- Education Info -->
                                    <div class="tab-pane fade" id="education">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Course Enrolled In <span class="text-danger">*</span></label>
                                                <select name="Course_Enrolled" class="form-control" required>
                                                    <option value="">-- Select Course --</option>
                                                    <option <?= old('Course_Enrolled', 'B.Sc') ?>>B.Sc</option>
                                                    <option <?= old('Course_Enrolled', 'B.A') ?>>B.A</option>
                                                    <option <?= old('Course_Enrolled', 'B.Com') ?>>B.Com</option>
                                                    <option <?= old('Course_Enrolled', 'Engineering') ?>>Engineering</option>
                                                    <option <?= old('Course_Enrolled', 'Diploma') ?>>Diploma</option>
                                                    <option <?= old('Course_Enrolled', 'Other') ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Current Education Level <span class="text-danger">*</span></label>
                                                <input type="text" name="Current_Education_level" class="form-control" value="<?= old('Current_Education_level') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Highest Education Completed</label>
                                                <input type="text" name="Highest_Education_Completed" class="form-control" value="<?= old('Highest_Education_Completed') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Student Status <span class="text-danger">*</span></label>
                                                <select name="Student_Status" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option <?= old('Student_Status', 'Active') ?>>Active</option>
                                                    <option <?= old('Student_Status', 'Inactive') ?>>Inactive</option>
                                                    <option <?= old('Student_Status', 'Completed') ?>>Completed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Course Status <span class="text-danger">*</span></label>
                                                <select name="Course_Status" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option <?= old('Course_Status', 'Ongoing') ?>>Ongoing</option>
                                                    <option <?= old('Course_Status', 'Completed') ?>>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                            <button type="button" class="btn btn-primary next-tab">Next</button>
                                        </div>
                                    </div>

                                    <!-- Program Info -->
                                    <div class="tab-pane fade" id="program">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label>Program</label>
                                                <input type="text"
                                                    class="form-control"
                                                    value="Vijetaas"
                                                    readonly>

                                                <input type="hidden"
                                                    name="Program_Id"
                                                    value="<?= \Config\CorePrograms::VIJEETAS ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Vijetaas Email ID</label>
                                                <input type="email"
                                                    class="form-control"
                                                    name="Vijetas_Mail_Id">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Enrollment Date *</label>
                                                <input type="date"
                                                    class="form-control"
                                                    name="Enrollment_Date"
                                                    max="<?= date('Y-m-d') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Completion Date</label>
                                                <input type="date"
                                                    name="Completion_Date"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Status *</label>
                                                <select class="form-control"
                                                    name="Vijeta_Status"
                                                    required>

                                                    <option value="">Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                    <option value="Completed">Completed</option>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
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


                                    <!-- Family Info -->
                                    <div class="tab-pane fade" id="family">

                                        <div class="row">


                                            <!-- Father's Name -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian's Name</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="father_name"
                                                    value="<?= old('father_name') ?>">
                                            </div>

                                            <!-- Relation with Guardian -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Relation with Guardian
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select name="Guardian_Relation"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Relation --</option>

                                                    <option value="Father"
                                                        <?= old('Guardian_Relation') === 'Father' ? 'selected' : '' ?>>
                                                        Father
                                                    </option>

                                                    <option value="Mother"
                                                        <?= old('Guardian_Relation') === 'Mother' ? 'selected' : '' ?>>
                                                        Mother
                                                    </option>

                                                    <option value="Guardian"
                                                        <?= old('Guardian_Relation') === 'Guardian' ? 'selected' : '' ?>>
                                                        Guardian
                                                    </option>

                                                    <option value="Uncle"
                                                        <?= old('Guardian_Relation') === 'Uncle' ? 'selected' : '' ?>>
                                                        Uncle
                                                    </option>

                                                    <option value="Aunt"
                                                        <?= old('Guardian_Relation') === 'Aunt' ? 'selected' : '' ?>>
                                                        Aunt
                                                    </option>

                                                    <option value="Grandfather"
                                                        <?= old('Guardian_Relation') === 'Grandfather' ? 'selected' : '' ?>>
                                                        Grandfather
                                                    </option>

                                                    <option value="Grandmother"
                                                        <?= old('Guardian_Relation') === 'Grandmother' ? 'selected' : '' ?>>
                                                        Grandmother
                                                    </option>

                                                    <option value="Sibling"
                                                        <?= old('Guardian_Relation') === 'Sibling' ? 'selected' : '' ?>>
                                                        Sibling
                                                    </option>

                                                    <option value="Other"
                                                        <?= old('Guardian_Relation') === 'Other' ? 'selected' : '' ?>>
                                                        Other
                                                    </option>

                                                </select>
                                            </div>



                                            <!-- Father's Contact -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian's Contact</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="father_contact"
                                                    value="<?= old('father_contact') ?>">
                                            </div>

                                            <!-- Father's Email -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian's Email</label>
                                                <input type="email"
                                                    class="form-control"
                                                    name="father_email"
                                                    value="<?= old('father_email') ?>">
                                            </div>

                                            <!-- Father's Occupation -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian's Occupation</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="father_occupation"
                                                    value="<?= old('father_occupation') ?>">
                                            </div>

                                            <div class="w-100"></div>

                                            <!-- Mother's Name -->
                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Name</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_name"
                                                    value="<?= old('mother_name') ?>">
                                            </div>

                                            <!-- Mother's Contact -->
                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Contact</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_contact"
                                                    value="<?= old('mother_contact') ?>">
                                            </div>

                                            <!-- Mother's Email -->
                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Email</label>
                                                <input type="email"
                                                    class="form-control"
                                                    name="mother_email"
                                                    value="<?= old('mother_email') ?>">
                                            </div>

                                            <!-- Mother's Occupation -->
                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Occupation</label>
                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_occupation"
                                                    value="<?= old('mother_occupation') ?>">
                                            </div>

                                            <!-- Family Monthly Income -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Family Monthly Income
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    class="form-control"
                                                    name="income"
                                                    value="<?= old('income') ?>"
                                                    min="0"
                                                    step="1"
                                                    required>
                                            </div>

                                            <!-- Number of Siblings -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Number of Siblings
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    class="form-control"
                                                    name="siblings"
                                                    value="<?= old('siblings') ?>"
                                                    min="0"
                                                    required>
                                            </div>

                                        </div>

                                        <!-- Submit -->
                                        <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                                            <button type="button"
                                                class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <a href="<?= site_url('students/vijetaas') ?>"
                                                class="btn btn-light">
                                                Cancel
                                            </a>

                                            <button type="submit"
                                                class="btn btn-primary">
                                                Save
                                            </button>

                                        </div>

                                    </div>


                            </form>
                        </div>
                    </div>
                </div>

                <?= view('includes/footer'); ?>

                <script>
                    document.querySelectorAll(".next-tab").forEach(btn => {
                        btn.addEventListener("click", function() {
                            let active = document.querySelector("#studentTabs .nav-link.active");
                            let next = active.parentElement.nextElementSibling?.querySelector(".nav-link");
                            if (next) next.click();
                        });
                    });
                    document.querySelectorAll(".prev-tab").forEach(btn => {
                        btn.addEventListener("click", function() {
                            let active = document.querySelector("#studentTabs .nav-link.active");
                            let prev = active.parentElement.previousElementSibling?.querySelector(".nav-link");
                            if (prev) prev.click();
                        });
                    });
                </script>
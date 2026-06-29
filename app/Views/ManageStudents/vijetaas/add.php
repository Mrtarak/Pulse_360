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

                            <h4 class="card-title">Add Student</h4>
                            <form
                                action="<?= site_url('students/vijetaas/store') ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="studentTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal Info</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#education">Education</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#program">Program</a></li>
                                    <li class="nav-item"><a class="nav-link" id="goals-tab" data-bs-toggle="tab" href="#goals" role="tab">5. Goals</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#mentor">Mentor</a></li>
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
                                                <input type="date" name="DOB" class="form-control" value="<?= old('DOB') ?>"max="<?= date('Y-m-d') ?>">
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
                                                <input type="file" name="Photo_URL" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3"><label>Aadhar Photo</label>
                                                <input type="file" name="Aadhar_Photo_URL" class="form-control">
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

                                    <!-- Goal Info -->
                                    <div class="tab-pane fade" id="goals">

                                        <div class="row">

                                            <div class="col-md-12 mb-3">

                                                <label>Select Existing Goal *</label>

                                                <select class="form-control"
                                                    name="Goal_Id"
                                                    required>

                                                    <option value="">Select Goal</option>

                                                    <?php foreach ($goals as $goal): ?>

                                                        <option value="<?= esc($goal['Goal_Id']); ?>">

                                                            <?= esc($goal['Goal_Title']); ?>

                                                        </option>

                                                    <?php endforeach; ?>

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


                                    <!-- Mentor Info -->
                                    <div class="tab-pane fade" id="mentor">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label>Mentor *</label>

                                                <select class="form-control"
                                                    name="Mentor_Id"
                                                    required>

                                                    <option value="">Select Mentor</option>

                                                    <?php foreach ($mentors as $mentor): ?>

                                                        <option value="<?= esc($mentor['User_Id']); ?>">

                                                            <?= esc(
                                                                $mentor['User_FirstName'] .
                                                                    ' ' .
                                                                    $mentor['User_LastName']
                                                            ); ?>

                                                        </option>

                                                    <?php endforeach; ?>

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
                                            <div class="col-md-6 mb-3"><label>Father's Name <span class="text-danger">*</span></label><input type="text" class="form-control" name="father_name"></div>
                                            <div class="col-md-6 mb-3"><label>Father's Contact <span class="text-danger">*</span></label><input type="text" class="form-control" name="father_contact"></div>
                                            <div class="col-md-6 mb-3"><label>Father's Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="father_email"></div>
                                            <div class="col-md-6 mb-3"><label>Father's Occupation <span class="text-danger">*</span></label><input type="text" class="form-control" name="father_occupation"></div>
                                            <div class="col-md-6 mb-3"><label>Mother's Name <span class="text-danger">*</span></label><input type="text" class="form-control" name="mother_name"></div>
                                            <div class="col-md-6 mb-3"><label>Mother's Contact <span class="text-danger">*</span></label><input type="text" class="form-control" name="mother_contact"></div>
                                            <div class="col-md-6 mb-3"><label>Mother's Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="mother_email"></div>
                                            <div class="col-md-6 mb-3"><label>Mother's Occupation <span class="text-danger">*</span></label><input type="text" class="form-control" name="mother_occupation"></div>
                                            <div class="col-md-6 mb-3"><label>Family Monthly Income <span class="text-danger">*</span></label><input type="text" class="form-control" name="income"></div>
                                            <div class="col-md-6 mb-3"><label>Number of Siblings <span class="text-danger">*</span></label><input type="number" class="form-control" name="siblings"></div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                                            <a href="<?= site_url('students/vijetaas') ?>" class="btn btn-light">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
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
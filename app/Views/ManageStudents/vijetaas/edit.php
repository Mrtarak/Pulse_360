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

                            <h4 class="card-title">
                                Edit Vijetaas Student
                            </h4>

                            <form
                                action="<?= site_url('students/vijetaas/update/' . $student['Vijetaas_Stu_Id']) ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <!-- Tabs -->

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
                                            href="#goals">
                                            Goals
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#mentor">
                                            Mentor
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
                                                    value="<?= esc($student['First_Name']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Last Name</label>

                                                <input type="text"
                                                    name="last_name"
                                                    class="form-control"
                                                    value="<?= esc($student['Last_Name']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">

                                                <label>Gender</label>

                                                <select name="gender"
                                                    class="form-control">

                                                    <option value="Male"
                                                        <?= $student['Gender'] == 'Male' ? 'selected' : '' ?>>
                                                        Male
                                                    </option>

                                                    <option value="Female"
                                                        <?= $student['Gender'] == 'Female' ? 'selected' : '' ?>>
                                                        Female
                                                    </option>

                                                    <option value="Other"
                                                        <?= $student['Gender'] == 'Other' ? 'selected' : '' ?>>
                                                        Other
                                                    </option>

                                                </select>

                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Date Of Birth</label>

                                                <input type="date"
                                                    name="dob"
                                                    class="form-control"
                                                    value="<?= $student['DOB'] ?>"max="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Aadhar No</label>

                                                <input type="text"
                                                    name="aadhar_no"
                                                    class="form-control"
                                                    value="<?= esc($student['Aadhar_No']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Phone</label>

                                                <input type="text"
                                                    name="phone"
                                                    class="form-control"
                                                    value="<?= esc($student['Phone_No']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Email</label>

                                                <input type="email"
                                                    name="email"
                                                    class="form-control"
                                                    value="<?= esc($student['Email_Id']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>City / Village</label>

                                                <input type="text"
                                                    name="city"
                                                    class="form-control"
                                                    value="<?= esc($student['Village_City']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>District</label>

                                                <input type="text"
                                                    name="district"
                                                    class="form-control"
                                                    value="<?= esc($student['District']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>State</label>

                                                <input type="text"
                                                    name="state"
                                                    class="form-control"
                                                    value="<?= esc($student['State']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Pincode</label>

                                                <input type="text"
                                                    name="pincode"
                                                    class="form-control"
                                                    value="<?= esc($student['Pincode']) ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Nationality</label>

                                                <input type="text"
                                                    name="nationality"
                                                    class="form-control"
                                                    value="<?= esc($student['Nationality']) ?>">
                                            </div>

                                            <div class="col-md-12 mb-3">

                                                <label>Address</label>

                                                <textarea
                                                    name="address"
                                                    class="form-control"><?= esc($student['Address']) ?></textarea>

                                            </div>

                                            <div class="col-md-12 mb-3">

                                                <label>Remarks</label>

                                                <textarea
                                                    name="remarks"
                                                    class="form-control"><?= esc($student['Remarks']) ?></textarea>

                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end">

                                            <button type="button"
                                                class="btn btn-primary next-tab">
                                                Next
                                            </button>

                                        </div>

                                    </div>

                                    <!-- EDUCATION TAB -->

                                    <div class="tab-pane fade"
                                        id="education">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Education Level
                                                </label>

                                                <input type="text"
                                                    name="current_edu"
                                                    class="form-control"
                                                    value="<?= esc($student['Current_Education_level']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Highest Education Completed
                                                </label>

                                                <input type="text"
                                                    name="highest_edu"
                                                    class="form-control"
                                                    value="<?= esc($student['Highest_Education_Completed']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Student Status
                                                </label>

                                                <select name="status"
                                                    class="form-control">

                                                    <option value="Active"
                                                        <?= $student['Student_Status'] == 'Active' ? 'selected' : '' ?>>
                                                        Active
                                                    </option>

                                                    <option value="Inactive"
                                                        <?= $student['Student_Status'] == 'Inactive' ? 'selected' : '' ?>>
                                                        Inactive
                                                    </option>

                                                    <option value="Completed"
                                                        <?= $student['Student_Status'] == 'Completed' ? 'selected' : '' ?>>
                                                        Completed
                                                    </option>

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
                                    <!-- PROGRAM TAB -->

                                    <div class="tab-pane fade"
                                        id="program">

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
                                                    name="email"
                                                    value="<?= esc($student['Vijetas_Mail_Id']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Enrollment Date</label>

                                                <input type="date"
                                                    class="form-control"
                                                    name="enroll_date"max="<?= date('Y-m-d') ?>"    
                                                    value="<?= $student['Enrollment_Date'] ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Completion Date</label>

                                                <input type="date"
                                                    class="form-control"
                                                    name="completion_date"
                                                    value="<?= $student['Completion_Date'] ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Vijetaas Status</label>

                                                <select class="form-control"
                                                    name="status">

                                                    <option value="Active"
                                                        <?= $student['Vijeta_Status'] == 'Active' ? 'selected' : '' ?>>
                                                        Active
                                                    </option>

                                                    <option value="Inactive"
                                                        <?= $student['Vijeta_Status'] == 'Inactive' ? 'selected' : '' ?>>
                                                        Inactive
                                                    </option>

                                                    <option value="Completed"
                                                        <?= $student['Vijeta_Status'] == 'Completed' ? 'selected' : '' ?>>
                                                        Completed
                                                    </option>

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

                                    <!-- GOAL TAB -->

                                    <div class="tab-pane fade"
                                        id="goals">

                                        <div class="row">

                                            <div class="col-md-12 mb-3">

                                                <label>Select Goal</label>

                                                <select class="form-control"
                                                    name="goal_id">

                                                    <?php foreach ($goals as $goal): ?>

                                                        <option
                                                            value="<?= $goal['Goal_Id'] ?>"
                                                            <?= ($student['Goal_Id'] == $goal['Goal_Id']) ? 'selected' : '' ?>>

                                                            <?= esc($goal['Goal_Title']) ?>

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

                                    <!-- MENTOR TAB -->

                                    <div class="tab-pane fade"
                                        id="mentor">

                                        <div class="row">

                                            <div class="col-md-12 mb-3">

                                                <label>Select Mentor</label>

                                                <select class="form-control"
                                                    name="mentor_id">

                                                    <?php foreach ($mentors as $mentor): ?>

                                                        <option
                                                            value="<?= $mentor['User_Id'] ?>"
                                                            <?= ($student['Mentor_Id'] == $mentor['User_Id']) ? 'selected' : '' ?>>

                                                            <?= esc(
                                                                $mentor['User_FirstName']
                                                                    . ' ' .
                                                                    $mentor['User_LastName']
                                                            ) ?>

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

                                    <!-- FAMILY TAB -->

                                    <div class="tab-pane fade"
                                        id="family">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label>Father Name</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_name"
                                                    value="<?= esc($student['Fathers_Name']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Father Contact</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_contact"
                                                    value="<?= esc($student['Father_Contact_Number']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Father Email</label>

                                                <input type="email"
                                                    class="form-control"
                                                    name="father_email"
                                                    value="<?= esc($student['Father_Email_ID']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Father Occupation</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_occupation"
                                                    value="<?= esc($student['Father_Occupation']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Mother Name</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_name"
                                                    value="<?= esc($student['Mothers_Name']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Mother Contact</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_contact"
                                                    value="<?= esc($student['Mother_Contact_Number']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Mother Email</label>

                                                <input type="email"
                                                    class="form-control"
                                                    name="mother_email"
                                                    value="<?= esc($student['Mother_Email_ID']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Mother Occupation</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_occupation"
                                                    value="<?= esc($student['Mother_Occupation']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Family Monthly Income</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="income"
                                                    value="<?= esc($student['Family_Monthly_Income']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Number Of Siblings</label>

                                                <input type="number"
                                                    class="form-control"
                                                    name="siblings"
                                                    value="<?= esc($student['Sibling_Number']) ?>">

                                            </div>

                                        </div>

                                        <!-- BUTTONS -->

                                        <div class="mt-4 d-flex justify-content-center gap-3">

                                            <a href="<?= site_url('students/vijetaas') ?>"
                                                class="btn btn-light">

                                                Cancel

                                            </a>

                                            <button type="submit"
                                                class="btn btn-primary">

                                                Update Student

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

<script>
    document.querySelectorAll(".next-tab").forEach(btn => {

        btn.addEventListener("click", function() {

            let active = document.querySelector(
                "#studentTabs .nav-link.active"
            );

            let next = active.parentElement
                .nextElementSibling
                ?.querySelector(".nav-link");

            if (next) next.click();

        });

    });

    document.querySelectorAll(".prev-tab").forEach(btn => {

        btn.addEventListener("click", function() {

            let active = document.querySelector(
                "#studentTabs .nav-link.active"
            );

            let prev = active.parentElement
                .previousElementSibling
                ?.querySelector(".nav-link");

            if (prev) prev.click();

        });

    });
</script>
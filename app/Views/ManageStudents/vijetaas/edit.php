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

                            <h4 class="card-title"> <i class="mdi mdi-account-group menu-icon"></i>
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
                                                    value="<?= $student['DOB'] ?>" max="<?= date('Y-m-d') ?>">
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
                                                    value="<?= esc($student['Email_Id'] ?? '') ?>"
                                                    class="form-control">
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


                                            <!-- Student Photo -->
                                            <div class="col-md-6 mb-4">

                                                <div class="card shadow-sm border-0">

                                                    <div class="card-header bg-primary text-white text-center">
                                                        <h5 class="mb-0">
                                                            <i class="mdi mdi-account-circle"></i>
                                                            Student Photo
                                                        </h5>
                                                    </div>

                                                    <div class="card-body text-center">

                                                        <?php if (!empty($student['Photo_URL'])) : ?>

                                                            <img src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                                                class="img-thumbnail shadow mb-3"
                                                                style="width:220px;height:220px;object-fit:cover;border-radius:10px;"
                                                                alt="Student Photo">

                                                        <?php else : ?>

                                                            <div class="text-muted py-5">
                                                                <i class="mdi mdi-image-off mdi-48px"></i>
                                                                <p>No Student Photo</p>
                                                            </div>

                                                        <?php endif; ?>

                                                        <input type="file"
                                                            name="photo"
                                                            class="form-control"
                                                            accept="image/*">

                                                        <small class="text-muted">
                                                            Leave empty to keep existing photo.
                                                        </small>

                                                    </div>

                                                </div>

                                            </div>

                                            <!-- Aadhaar Photo -->
                                            <div class="col-md-6 mb-4">

                                                <div class="card shadow-sm border-0">

                                                    <div class="card-header bg-success text-white text-center">
                                                        <h5 class="mb-0">
                                                            <i class="mdi mdi-card-account-details"></i>
                                                            Aadhaar Photo
                                                        </h5>
                                                    </div>

                                                    <div class="card-body text-center">

                                                        <?php if (!empty($student['Aadhar_Photo_URL'])) : ?>

                                                            <img src="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                                                class="img-thumbnail shadow mb-3"
                                                                style="width:220px;height:220px;object-fit:cover;border-radius:10px;"
                                                                alt="Aadhaar Photo">

                                                        <?php else : ?>

                                                            <div class="text-muted py-5">
                                                                <i class="mdi mdi-image-off mdi-48px"></i>
                                                                <p>No Aadhaar Photo</p>
                                                            </div>

                                                        <?php endif; ?>

                                                        <input type="file"
                                                            name="aadhar_photo"
                                                            class="form-control"
                                                            accept="image/*">

                                                        <small class="text-muted">
                                                            Leave empty to keep existing Aadhaar photo.
                                                        </small>

                                                    </div>

                                                </div>

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

                                    <div class="tab-pane fade" id="education">

                                        <div class="row">

                                            <!-- ========================= -->
                                            <!-- CURRENT EDUCATION -->
                                            <!-- ========================= -->

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Current Education</h5>
                                                <hr>
                                            </div>


                                            <!-- Current Education Level -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Education Level
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="Current_Education_Level"
                                                    id="currentEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>

                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= ($student['Current_Education_Level'] ?? '') == $level['name'] ? 'selected' : '' ?>>

                                                            <?= esc($level['name']) ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>


                                            <!-- Current Qualification -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Qualification / Class
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="Current_Qualification"
                                                    id="currentQualification"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Qualification / Class --</option>

                                                </select>

                                            </div>


                                            <!-- Current Specialization -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Specialization / Subject
                                                </label>

                                                <input
                                                    type="text"
                                                    name="Current_Specialization_Subject"
                                                    class="form-control"
                                                    placeholder="Enter specialization or subject"
                                                    value="<?= esc($student['Current_Specialization_Subject'] ?? '') ?>">

                                            </div>


                                            <!-- Current Education Status -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Education Status
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="Current_Education_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <option value="Ongoing"
                                                        <?= ($student['Current_Education_Status'] ?? '') == 'Ongoing' ? 'selected' : '' ?>>
                                                        Ongoing
                                                    </option>

                                                    <option value="Completed"
                                                        <?= ($student['Current_Education_Status'] ?? '') == 'Completed' ? 'selected' : '' ?>>
                                                        Completed
                                                    </option>

                                                    <option value="Discontinued"
                                                        <?= ($student['Current_Education_Status'] ?? '') == 'Discontinued' ? 'selected' : '' ?>>
                                                        Discontinued
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- ========================= -->
                                            <!-- HIGHEST EDUCATION -->
                                            <!-- ========================= -->

                                            <div class="col-12 mt-3 mb-3">

                                                <h5 class="text-primary">
                                                    Highest Education Completed
                                                </h5>

                                                <hr>

                                            </div>


                                            <!-- Highest Education Level -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Highest Education Level
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="Highest_Education_Level"
                                                    id="highestEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>

                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= ($student['Highest_Education_Level'] ?? '') == $level['name'] ? 'selected' : '' ?>>

                                                            <?= esc($level['name']) ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>


                                            <!-- Highest Qualification -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Highest Qualification / Class
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="Highest_Qualification"
                                                    id="highestQualification"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Qualification / Class --</option>

                                                </select>

                                            </div>


                                            <!-- Highest Specialization -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Highest Specialization / Subject
                                                </label>

                                                <input
                                                    type="text"
                                                    name="Highest_Specialization_Subject"
                                                    class="form-control"
                                                    placeholder="Enter specialization or subject"
                                                    value="<?= esc($student['Highest_Specialization_Subject'] ?? '') ?>">

                                            </div>


                                            <!-- Student Status -->
                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Student Status
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="student_status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <option value="Active"
                                                        <?= ($student['Student_Status'] ?? '') == 'Active' ? 'selected' : '' ?>>
                                                        Active
                                                    </option>

                                                    <option value="Inactive"
                                                        <?= ($student['Student_Status'] ?? '') == 'Inactive' ? 'selected' : '' ?>>
                                                        Inactive
                                                    </option>

                                                    <option value="Completed"
                                                        <?= ($student['Student_Status'] ?? '') == 'Completed' ? 'selected' : '' ?>>
                                                        Completed
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- Navigation -->

                                        <div class="d-flex justify-content-between">

                                            <button
                                                type="button"
                                                class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button
                                                type="button"
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
                                                    name="vijetaas_email"
                                                    value="<?= esc($student['Vijetas_Mail_Id'] ?? '') ?>"
                                                    class="form-control">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Enrollment Date</label>

                                                <input type="date"
                                                    class="form-control"
                                                    name="enroll_date" max="<?= date('Y-m-d') ?>"
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
                                                    name="vijeta_status">

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


                                    <!-- FAMILY TAB -->

                                    <div class="tab-pane fade" id="family">

                                        <div class="row">

                                            <!-- Row 1 -->


                                            <div class="col-md-6 mb-3">

                                                <label>Guardian's Name</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_name"
                                                    value="<?= esc($student['Fathers_Name']) ?>">

                                            </div>

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
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Father' ? 'selected' : '' ?>>
                                                        Father
                                                    </option>

                                                    <option value="Mother"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Mother' ? 'selected' : '' ?>>
                                                        Mother
                                                    </option>

                                                    <option value="Guardian"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Guardian' ? 'selected' : '' ?>>
                                                        Guardian
                                                    </option>

                                                    <option value="Uncle"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Uncle' ? 'selected' : '' ?>>
                                                        Uncle
                                                    </option>

                                                    <option value="Aunt"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Aunt' ? 'selected' : '' ?>>
                                                        Aunt
                                                    </option>

                                                    <option value="Grandfather"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Grandfather' ? 'selected' : '' ?>>
                                                        Grandfather
                                                    </option>

                                                    <option value="Grandmother"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Grandmother' ? 'selected' : '' ?>>
                                                        Grandmother
                                                    </option>

                                                    <option value="Sibling"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Sibling' ? 'selected' : '' ?>>
                                                        Sibling
                                                    </option>

                                                    <option value="Other"
                                                        <?= ($student['Guardian_Relation'] ?? '') == 'Other' ? 'selected' : '' ?>>
                                                        Other
                                                    </option>

                                                </select>

                                            </div>




                                            <!-- Row 2 -->
                                            <div class="col-md-6 mb-3">

                                                <label>Guardian's Contact</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_contact"
                                                    value="<?= esc($student['Father_Contact_Number']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Guardian's Email</label>

                                                <input type="email"
                                                    class="form-control"
                                                    name="father_email"
                                                    value="<?= esc($student['Father_Email_ID']) ?>">

                                            </div>


                                            <!-- Row 3 -->
                                            <div class="col-md-6 mb-3">

                                                <label>Guardian's Occupation</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="father_occupation"
                                                    value="<?= esc($student['Father_Occupation']) ?>">

                                            </div>

                                            <!-- Force Mother Name to next row -->
                                            <div class="w-100"></div>

                                            <div class="col-md-6 mb-3">

                                                <label>Mother Name</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_name"
                                                    value="<?= esc($student['Mothers_Name']) ?>">

                                            </div>


                                            <!-- Row 4 -->
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


                                            <!-- Row 5 -->
                                            <div class="col-md-6 mb-3">

                                                <label>Mother Occupation</label>

                                                <input type="text"
                                                    class="form-control"
                                                    name="mother_occupation"
                                                    value="<?= esc($student['Mother_Occupation']) ?>">

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Family Monthly Income</label>

                                                <input type="number"
                                                    class="form-control"
                                                    name="income"
                                                    value="<?= esc($student['Family_Monthly_Income']) ?>"
                                                    min="0"
                                                    step="1">

                                            </div>


                                            <!-- Row 6 -->
                                            <div class="col-md-6 mb-3">

                                                <label>Number Of Siblings</label>

                                                <input type="number"
                                                    class="form-control"
                                                    name="siblings"
                                                    value="<?= esc($student['Sibling_Number']) ?>"
                                                    min="0">

                                            </div>

                                        </div>


                                        <!-- ONLY FINAL TAB BUTTONS -->

                                        <div class="mt-4 d-flex justify-content-center gap-3">

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

                                                Update Student

                                            </button>

                                        </div>

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
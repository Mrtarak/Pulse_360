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
                                <i class="mdi mdi-account-group menu-icon"></i>
                                Add Student
                            </h4>

                            <form
                                id="addStudentForm"
                                action="<?= site_url('students/vijetaas/store') ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <?= csrf_field() ?>

                                <!-- ================================================= -->
                                <!-- TAB NAVIGATION -->
                                <!-- ================================================= -->

                                <ul class="nav nav-tabs" id="studentTabs" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            data-bs-toggle="tab"
                                            href="#personal"
                                            role="tab">
                                            Personal Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#family"
                                            role="tab">
                                            Family Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#education"
                                            role="tab">
                                            Education
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#program"
                                            role="tab">
                                            Program Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#mentor"
                                            role="tab">
                                            Mentor Selection
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            data-bs-toggle="tab"
                                            href="#declaration"
                                            role="tab">
                                            Declaration & Documents
                                        </a>
                                    </li>

                                </ul>


                                <div class="tab-content mt-4">


                                    <!-- ================================================= -->
                                    <!-- 1. PERSONAL INFORMATION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade show active" id="personal">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Personal Details</h5>
                                                <hr>
                                            </div>

                                            <!-- First Name -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    First Name <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="First_Name"
                                                    class="form-control"
                                                    value="<?= old('First_Name') ?>"
                                                    required>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Last Name <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Last_Name"
                                                    class="form-control"
                                                    value="<?= old('Last_Name') ?>"
                                                    required>
                                            </div>

                                            <!-- Gender -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Gender <span class="text-danger">*</span>
                                                </label>

                                                <select name="Gender"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Gender --</option>

                                                    <option value="Male"
                                                        <?= old('Gender') === 'Male' ? 'selected' : '' ?>>
                                                        Male
                                                    </option>

                                                    <option value="Female"
                                                        <?= old('Gender') === 'Female' ? 'selected' : '' ?>>
                                                        Female
                                                    </option>

                                                    <option value="Other"
                                                        <?= old('Gender') === 'Other' ? 'selected' : '' ?>>
                                                        Other
                                                    </option>

                                                </select>
                                            </div>

                                            <!-- DOB -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Date of Birth <span class="text-danger">*</span>
                                                </label>

                                                <input type="date"
                                                    name="DOB"
                                                    class="form-control"
                                                    value="<?= old('DOB') ?>"
                                                    max="<?= date('Y-m-d') ?>"
                                                    required>
                                            </div>

                                            <!-- Caste -->
                                            <!-- Student Category -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Category <span class="text-danger">*</span>
                                                </label>

                                                <select name="Category_Id" class="form-control" required>
                                                    <option value="">Select Category</option>

                                                    <?php foreach (($categories ?? []) as $category): ?>
                                                        <option value="<?= esc($category['Category_Id']) ?>"
                                                            <?= old('Category_Id') === $category['Category_Id'] ? 'selected' : '' ?>>
                                                            <?= esc($category['Category_Name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- Aadhaar -->
                                            <div class="col-md-4 mb-3">
                                                <label>Aadhaar Number</label>

                                                <input type="text"
                                                    name="Aadhar_No"
                                                    class="form-control"
                                                    value="<?= old('Aadhar_No') ?>"
                                                    maxlength="20">
                                            </div>

                                            <!-- Phone -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Phone Number <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Phone_No"
                                                    class="form-control"
                                                    value="<?= old('Phone_No') ?>"
                                                    maxlength="15"
                                                    required>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-4 mb-3">
                                                <label>Email ID</label>

                                                <input type="email"
                                                    name="Email_Id"
                                                    class="form-control"
                                                    value="<?= old('Email_Id') ?>">
                                            </div>

                                            <!-- Nationality -->
                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Nationality <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Nationality"
                                                    class="form-control"
                                                    value="<?= old('Nationality', 'Indian') ?>"
                                                    required>
                                            </div>


                                            <!-- Student Photo -->
                                            <div class="col-md-6 mb-3">
                                                <label>Student Photo</label>

                                                <input type="file"
                                                    name="photo"
                                                    class="form-control"
                                                    accept=".jpg,.jpeg,.png">

                                                <small class="text-muted">
                                                    Maximum size: 2 MB. Allowed formats: JPG, JPEG, PNG.
                                                </small>
                                            </div>

                                            <!-- Aadhaar Photo -->
                                            <div class="col-md-6 mb-3">
                                                <label>Aadhaar Photo / Document</label>

                                                <input type="file"
                                                    name="aadhar_photo"
                                                    class="form-control"
                                                    accept=".jpg,.jpeg,.png">

                                                <small class="text-muted">
                                                    Maximum size: 2 MB. Allowed formats: JPG, JPEG, PNG.
                                                </small>
                                            </div>


                                            <!-- CURRENT ADDRESS -->
                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Current Address</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>
                                                    Address <span class="text-danger">*</span>
                                                </label>

                                                <textarea name="Address"
                                                    id="currentAddress"
                                                    class="form-control"
                                                    rows="2"
                                                    required><?= old('Address') ?></textarea>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    City / Village <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Village_City"
                                                    id="currentVillage"
                                                    class="form-control"
                                                    value="<?= old('Village_City') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    District <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="District"
                                                    id="currentDistrict"
                                                    class="form-control"
                                                    value="<?= old('District') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    State <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="State"
                                                    id="currentState"
                                                    class="form-control"
                                                    value="<?= old('State') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Pincode <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Pincode"
                                                    id="currentPincode"
                                                    class="form-control"
                                                    value="<?= old('Pincode') ?>"
                                                    maxlength="10"
                                                    required>
                                            </div>


                                            <!-- PERMANENT ADDRESS -->
                                            <div class="col-12 mt-3 mb-3">

                                                <h5 class="text-primary">Permanent Address</h5>

                                                <hr>

                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        class="form-check-input"
                                                        id="sameAsCurrentAddress"
                                                        name="same_as_current"
                                                        value="1"
                                                        <?= old('same_as_current') ? 'checked' : '' ?>>

                                                    <label class="form-check-label"
                                                        for="sameAsCurrentAddress">
                                                        Same as Current Address
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>
                                                    Address <span class="text-danger">*</span>
                                                </label>

                                                <textarea name="Permanent_Address"
                                                    id="permanentAddress"
                                                    class="form-control permanent-address"
                                                    rows="2"
                                                    required><?= old('Permanent_Address') ?></textarea>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    City / Village <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Permanent_Village_City"
                                                    id="permanentVillage"
                                                    class="form-control permanent-address"
                                                    value="<?= old('Permanent_Village_City') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    District <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Permanent_District"
                                                    id="permanentDistrict"
                                                    class="form-control permanent-address"
                                                    value="<?= old('Permanent_District') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    State <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Permanent_State"
                                                    id="permanentState"
                                                    class="form-control permanent-address"
                                                    value="<?= old('Permanent_State') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>
                                                    Pincode <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="Permanent_Pincode"
                                                    id="permanentPincode"
                                                    class="form-control permanent-address"
                                                    value="<?= old('Permanent_Pincode') ?>"
                                                    maxlength="10"
                                                    required>
                                            </div>

                                        </div>


                                        <div class="d-flex justify-content-end">
                                            <button type="button"
                                                class="btn btn-primary next-tab">
                                                Next
                                            </button>
                                        </div>

                                    </div>



                                    <!-- ================================================= -->
                                    <!-- 2. FAMILY INFORMATION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="family">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Guardian Information</h5>
                                                <hr>
                                            </div>

                                            <!-- Guardian Name -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Name</label>

                                                <input type="text"
                                                    name="father_name"
                                                    class="form-control"
                                                    value="<?= old('father_name') ?>">
                                            </div>

                                            <!-- Guardian Relation -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Guardian Relation <span class="text-danger">*</span>
                                                </label>

                                                <select name="Guardian_Relation"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Relation --</option>

                                                    <?php
                                                    $relations = [
                                                        'Father',
                                                        'Mother',
                                                        'Guardian',
                                                        'Uncle',
                                                        'Aunt',
                                                        'Grandfather',
                                                        'Grandmother',
                                                        'Sibling',
                                                        'Other'
                                                    ];
                                                    ?>

                                                    <?php foreach ($relations as $relation): ?>
                                                        <option value="<?= esc($relation) ?>"
                                                            <?= old('Guardian_Relation') === $relation ? 'selected' : '' ?>>
                                                            <?= esc($relation) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <!-- Guardian Contact -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Contact</label>

                                                <input type="text"
                                                    name="father_contact"
                                                    class="form-control"
                                                    value="<?= old('father_contact') ?>"
                                                    maxlength="15">
                                            </div>

                                            <!-- Guardian Email -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Email</label>

                                                <input type="email"
                                                    name="father_email"
                                                    class="form-control"
                                                    value="<?= old('father_email') ?>">
                                            </div>

                                            <!-- Guardian Occupation -->
                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Occupation</label>

                                                <input type="text"
                                                    name="father_occupation"
                                                    class="form-control"
                                                    value="<?= old('father_occupation') ?>">
                                            </div>


                                            <!-- MOTHER INFORMATION -->
                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Mother's Information</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Name</label>

                                                <input type="text"
                                                    name="mother_name"
                                                    class="form-control"
                                                    value="<?= old('mother_name') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Contact</label>

                                                <input type="text"
                                                    name="mother_contact"
                                                    class="form-control"
                                                    value="<?= old('mother_contact') ?>"
                                                    maxlength="15">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Email</label>

                                                <input type="email"
                                                    name="mother_email"
                                                    class="form-control"
                                                    value="<?= old('mother_email') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Occupation</label>

                                                <input type="text"
                                                    name="mother_occupation"
                                                    class="form-control"
                                                    value="<?= old('mother_occupation') ?>">
                                            </div>


                                            <!-- FAMILY DETAILS -->
                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Family Details</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Family Monthly Income <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    name="income"
                                                    class="form-control"
                                                    value="<?= old('income') ?>"
                                                    min="0"
                                                    step="0.01"
                                                    required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Number of Siblings <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    name="siblings"
                                                    class="form-control"
                                                    value="<?= old('siblings') ?>"
                                                    min="0"
                                                    step="1"
                                                    required>
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



                                    <!-- ================================================= -->
                                    <!-- 3. EDUCATION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="education">

                                        <div class="row">

                                            <!-- CURRENT EDUCATION -->
                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Current Education</h5>
                                                <hr>
                                            </div>

                                            <!-- Current Education Level -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Education Level <span class="text-danger">*</span>
                                                </label>

                                                <select name="Current_Education_Level"
                                                    id="currentEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>

                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= old('Current_Education_Level') == $level['name'] ? 'selected' : '' ?>>

                                                            <?= esc($level['name']) ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>


                                            <!-- Current Qualification -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Qualification / Class <span class="text-danger">*</span>
                                                </label>

                                                <select name="Current_Qualification"
                                                    id="currentQualification"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Qualification / Class --</option>

                                                </select>
                                            </div>


                                            <!-- College / Institution -->
                                            <div class="col-md-6 mb-3">
                                                <label>College / Institution Name</label>

                                                <input type="text"
                                                    name="College_Institution_Name"
                                                    class="form-control"
                                                    value="<?= old('College_Institution_Name') ?>">
                                            </div>


                                            <!-- University -->
                                            <div class="col-md-6 mb-3">
                                                <label>University Name</label>

                                                <input type="text"
                                                    name="University_Name"
                                                    class="form-control"
                                                    value="<?= old('University_Name') ?>">
                                            </div>


                                            <!-- Current Specialization -->
                                            <div class="col-md-6 mb-3">
                                                <label>Specialization / Subject</label>

                                                <input type="text"
                                                    name="Current_Specialization_Subject"
                                                    class="form-control"
                                                    placeholder="Enter specialization or subject"
                                                    value="<?= old('Current_Specialization_Subject') ?>">
                                            </div>


                                            <!-- Current Education Status -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Education Status <span class="text-danger">*</span>
                                                </label>

                                                <select name="Current_Education_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <?php
                                                    $educationStatuses = [
                                                        'Ongoing',
                                                        'Completed',
                                                        'Discontinued'
                                                    ];
                                                    ?>

                                                    <?php foreach ($educationStatuses as $status): ?>
                                                        <option value="<?= esc($status) ?>"
                                                            <?= old('Current_Education_Status') === $status ? 'selected' : '' ?>>
                                                            <?= esc($status) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>


                                            <!-- Course Type -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Course Type <span class="text-danger">*</span>
                                                </label>

                                                <select name="Course_Type"
                                                    id="courseType"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Course Type --</option>

                                                    <option value="Semester"
                                                        <?= old('Course_Type') === 'Semester' ? 'selected' : '' ?>>
                                                        Semester
                                                    </option>

                                                    <option value="Year"
                                                        <?= old('Course_Type') === 'Year' ? 'selected' : '' ?>>
                                                        Year
                                                    </option>

                                                </select>
                                            </div>


                                            <!-- Number of Semesters -->
                                            <div class="col-md-6 mb-3"
                                                id="semesterField"
                                                style="display:none;">

                                                <label>
                                                    Number of Semesters <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    name="Number_of_Semesters"
                                                    id="numberOfSemesters"
                                                    class="form-control"
                                                    value="<?= old('Number_of_Semesters') ?>"
                                                    min="1"
                                                    step="1">
                                            </div>


                                            <!-- Number of Years -->
                                            <div class="col-md-6 mb-3"
                                                id="yearField"
                                                style="display:none;">

                                                <label>
                                                    Number of Years <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    name="Number_of_Years"
                                                    id="numberOfYears"
                                                    class="form-control"
                                                    value="<?= old('Number_of_Years') ?>"
                                                    min="1"
                                                    step="1">
                                            </div>


                                            <!-- Course Start Date -->
                                            <div class="col-md-6 mb-3">
                                                <label>Course Start Date</label>

                                                <input type="date"
                                                    name="Course_Start_Date"
                                                    class="form-control"
                                                    value="<?= old('Course_Start_Date') ?>">
                                            </div>

                                            <!-- Expected Completion Date -->
                                            <div class="col-md-6 mb-3">
                                                <label>Expected Course Completion Date</label>

                                                <input type="date"
                                                    name="Expected_Course_Completion_Date"
                                                    class="form-control"
                                                    value="<?= old('Expected_Course_Completion_Date') ?>">
                                            </div>



                                            <!-- HIGHEST EDUCATION -->
                                            <div class="col-12 mt-4 mb-3">
                                                <h5 class="text-primary">Last Highest Education Completed</h5>
                                                <hr>
                                            </div>


                                            <!-- Highest Education Level -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Education Level <span class="text-danger">*</span>
                                                </label>

                                                <select name="Highest_Education_Level"
                                                    id="highestEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>

                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= old('Highest_Education_Level') == $level['name'] ? 'selected' : '' ?>>

                                                            <?= esc($level['name']) ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>


                                            <!-- Highest Qualification -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Qualification / Class <span class="text-danger">*</span>
                                                </label>

                                                <select name="Highest_Qualification"
                                                    id="highestQualification"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Qualification / Class --</option>

                                                </select>
                                            </div>


                                            <!-- Highest Specialization -->
                                            <div class="col-md-6 mb-3">
                                                <label>Specialization / Subject</label>

                                                <input type="text"
                                                    name="Highest_Specialization_Subject"
                                                    class="form-control"
                                                    placeholder="Enter specialization or subject"
                                                    value="<?= old('Highest_Specialization_Subject') ?>">
                                            </div>


                                            <!-- Student Status -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Student Status <span class="text-danger">*</span>
                                                </label>

                                                <select name="Student_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <?php
                                                    $studentStatuses = [
                                                        'Active',
                                                        'Inactive',
                                                        'Completed'
                                                    ];
                                                    ?>

                                                    <?php foreach ($studentStatuses as $status): ?>
                                                        <option value="<?= esc($status) ?>"
                                                            <?= old('Student_Status') === $status ? 'selected' : '' ?>>
                                                            <?= esc($status) ?>
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



                                    <!-- ================================================= -->
                                    <!-- 4. PROGRAM INFORMATION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="program">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Program Details</h5>
                                                <hr>
                                            </div>

                                            <!-- Program -->
                                            <div class="col-md-6 mb-3">
                                                <label>Program</label>

                                                <input type="text"
                                                    class="form-control"
                                                    value="Vijetaas"
                                                    readonly>

                                                <input type="hidden"
                                                    name="Program_Id"
                                                    value="<?= esc(\Config\CorePrograms::VIJEETAS) ?>">
                                            </div>


                                            <!-- Enrollment Date -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Enrollment Date <span class="text-danger">*</span>
                                                </label>

                                                <input type="date"
                                                    name="Enrollment_Date"
                                                    class="form-control"
                                                    value="<?= old('Enrollment_Date', date('Y-m-d')) ?>"
                                                    max="<?= date('Y-m-d') ?>"
                                                    required>
                                            </div>


                                            <!-- Completion Date -->
                                            <div class="col-md-6 mb-3">
                                                <label>Completion Date</label>

                                                <input type="date"
                                                    name="Completion_Date"
                                                    class="form-control"
                                                    value="<?= old('Completion_Date') ?>">
                                            </div>


                                            <!-- Program Status -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Program Status <span class="text-danger">*</span>
                                                </label>

                                                <select name="Vijeta_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <option value="Active"
                                                        <?= old('Vijeta_Status', 'Active') === 'Active' ? 'selected' : '' ?>>
                                                        Active
                                                    </option>

                                                    <option value="Inactive"
                                                        <?= old('Vijeta_Status') === 'Inactive' ? 'selected' : '' ?>>
                                                        Inactive
                                                    </option>

                                                    <option value="Completed"
                                                        <?= old('Vijeta_Status') === 'Completed' ? 'selected' : '' ?>>
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



                                    <!-- ================================================= -->
                                    <!-- 5. MENTOR SELECTION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="mentor">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Select Mentor(s)</h5>
                                                <hr>

                                                <p class="text-muted">
                                                    Select one or more mentors for this student.
                                                </p>
                                            </div>


                                            <?php if (!empty($mentors)): ?>

                                                <?php foreach ($mentors as $mentor): ?>

                                                    <div class="col-md-6 col-lg-4 mb-3 d-flex">

                                                        <div class="mentor-option">

                                                            <input type="checkbox"
                                                                class="form-check-input mentor-checkbox"
                                                                name="Mentor_Ids[]"
                                                                value="<?= esc($mentor['User_Id']) ?>"
                                                                id="mentor_<?= esc($mentor['User_Id']) ?>"
                                                                <?= in_array(
                                                                    $mentor['User_Id'],
                                                                    (array) old('Mentor_Ids', []),
                                                                    true
                                                                ) ? 'checked' : '' ?>>

                                                            <label class="mentor-label"
                                                                for="mentor_<?= esc($mentor['User_Id']) ?>">

                                                                <?= esc(
                                                                    trim(
                                                                        $mentor['User_FirstName'] . ' ' .
                                                                            $mentor['User_LastName']
                                                                    )
                                                                ) ?>

                                                            </label>

                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>

                                            <?php else: ?>

                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        No active mentors are currently available.
                                                    </div>
                                                </div>

                                            <?php endif; ?>

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



                                    <!-- ================================================= -->
                                    <!-- 6. DECLARATION & DOCUMENTS -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="declaration">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Referral Information</h5>
                                                <hr>
                                            </div>


                                            <!-- Referral Source -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    How did you hear about Project Vijetaas?
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select name="Referral_Source"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Referral Source --</option>

                                                    <?php
                                                    $referralSources = [
                                                        'School',
                                                        'College',
                                                        'Friend',
                                                        'Family',
                                                        'Social Media',
                                                        'Website',
                                                        'Newspaper',
                                                        'NGO',
                                                        'Other'
                                                    ];
                                                    ?>

                                                    <?php foreach ($referralSources as $source): ?>
                                                        <option value="<?= esc($source) ?>"
                                                            <?= old('Referral_Source') === $source ? 'selected' : '' ?>>
                                                            <?= esc($source) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>


                                            <!-- Referral Person / Organisation -->
                                            <div class="col-md-6 mb-3">
                                                <label>
                                                    Referring Person / Organisation Name
                                                </label>

                                                <input type="text"
                                                    name="Referral_Person_Organisation"
                                                    class="form-control"
                                                    value="<?= old('Referral_Person_Organisation') ?>"
                                                    placeholder="Enter name, if applicable">
                                            </div>



                                            <!-- Declaration Certificate -->
                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Declaration Certificate</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label>Upload Declaration Certificate</label>

                                                <input type="file"
                                                    name="declaration_certificate"
                                                    class="form-control"
                                                    accept=".pdf,.jpg,.jpeg,.png">

                                                <small class="text-muted">
                                                    Upload the declaration certificate.
                                                    Allowed formats: PDF, JPG, JPEG, PNG.
                                                </small>

                                            </div>



                                            <!-- Declaration Text -->
                                            <div class="col-12 mt-3 mb-3">

                                                <h5 class="text-primary">Declaration</h5>
                                                <hr>

                                                <div class="border rounded p-3">

                                                    <p class="mb-0">
                                                        I confirm that the information provided is accurate
                                                        to the best of my knowledge. I understand that
                                                        submitting this form does not guarantee selection
                                                        or financial assistance.
                                                    </p>

                                                </div>

                                            </div>


                                            <!-- Declaration Acceptance -->
                                            <div class="col-12 mb-3">

                                                <div class="form-check">

                                                    <input type="checkbox"
                                                        name="Declaration_Accepted"
                                                        id="Declaration_Accepted"
                                                        class="form-check-input"
                                                        value="1"
                                                        <?= old('Declaration_Accepted') ? 'checked' : '' ?>
                                                        required>

                                                    <label class="form-check-label"
                                                        for="Declaration_Accepted">

                                                        I have read and accept the declaration above.
                                                        <span class="text-danger">*</span>

                                                    </label>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- FINAL BUTTONS -->
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

        <?= view('includes/footer'); ?>

    </div>
</div>



<!-- ================================================= -->
<!-- PAGE-SPECIFIC STYLES -->
<!-- ================================================= -->
<style>
    /* Keep mentor checkboxes and names consistently aligned. */
    #mentor .mentor-option {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-height: 54px;
        padding: 12px 15px;
        border: 1px solid #d5deeb;
        border-radius: 8px;
        background: #fff;
    }

    #mentor .mentor-checkbox {
        position: static;
        float: none;
        flex: 0 0 17px;
        width: 17px;
        height: 17px;
        margin: 0;
        cursor: pointer;
    }

    #mentor .mentor-label {
        display: block;
        margin: 0;
        line-height: 1.4;
        cursor: pointer;
        overflow-wrap: anywhere;
    }

    #mentor .mentor-option:has(.mentor-checkbox:checked) {
        border-color: #1B4482;
        background: #f3f6fb;
    }
</style>

<!-- ================================================= -->
<!-- JAVASCRIPT -->
<!-- ================================================= -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('addStudentForm');

        const tabs = Array.from(
            document.querySelectorAll('#studentTabs .nav-link')
        );


        // =================================================
        // TAB NAVIGATION
        // =================================================

        function getActivePane() {
            return document.querySelector('.tab-pane.active');
        }

        function activateTab(paneId) {
            const tab = tabs.find(function(item) {
                return item.getAttribute('href') === '#' + paneId;
            });

            if (tab) {
                bootstrap.Tab.getOrCreateInstance(tab).show();
            }
        }

        function validatePane(pane) {

            const fields = pane.querySelectorAll(
                'input, select, textarea'
            );

            for (const field of fields) {

                if (field.disabled) {
                    continue;
                }

                if (!field.checkValidity()) {

                    field.reportValidity();

                    return false;
                }
            }

            return true;
        }


        document.querySelectorAll('.next-tab').forEach(function(button) {

            button.addEventListener('click', function() {

                const activePane = getActivePane();

                if (!validatePane(activePane)) {
                    return;
                }

                const currentIndex = tabs.findIndex(function(tab) {
                    return tab.classList.contains('active');
                });

                if (currentIndex < tabs.length - 1) {
                    activateTab(
                        tabs[currentIndex + 1].getAttribute('href').substring(1)
                    );
                }

            });

        });


        document.querySelectorAll('.prev-tab').forEach(function(button) {

            button.addEventListener('click', function() {

                const currentIndex = tabs.findIndex(function(tab) {
                    return tab.classList.contains('active');
                });

                if (currentIndex > 0) {
                    activateTab(
                        tabs[currentIndex - 1].getAttribute('href').substring(1)
                    );
                }

            });

        });


        // Validate all tabs before final submission.
        form.addEventListener('submit', function(event) {

            const panes = document.querySelectorAll('.tab-pane');

            for (const pane of panes) {

                if (!validatePane(pane)) {

                    event.preventDefault();

                    activateTab(pane.id);

                    return;
                }
            }

        });



        // =================================================
        // SAME AS CURRENT ADDRESS
        // =================================================

        const sameAddressCheckbox = document.getElementById(
            'sameAsCurrentAddress'
        );

        const addressFields = [{
                current: 'currentAddress',
                permanent: 'permanentAddress'
            },
            {
                current: 'currentVillage',
                permanent: 'permanentVillage'
            },
            {
                current: 'currentDistrict',
                permanent: 'permanentDistrict'
            },
            {
                current: 'currentState',
                permanent: 'permanentState'
            },
            {
                current: 'currentPincode',
                permanent: 'permanentPincode'
            }
        ];


        function copyCurrentAddress() {

            addressFields.forEach(function(item) {

                const currentField = document.getElementById(item.current);
                const permanentField = document.getElementById(item.permanent);

                if (sameAddressCheckbox.checked) {

                    permanentField.value = currentField.value;
                    permanentField.readOnly = true;

                } else {

                    permanentField.readOnly = false;

                }

            });

        }


        sameAddressCheckbox.addEventListener('change', copyCurrentAddress);


        // Update permanent address automatically if checkbox is selected.
        addressFields.forEach(function(item) {

            const currentField = document.getElementById(item.current);

            currentField.addEventListener('input', function() {

                if (sameAddressCheckbox.checked) {
                    copyCurrentAddress();
                }

            });

        });


        // Restore checkbox state after validation reload.
        if (sameAddressCheckbox.checked) {
            copyCurrentAddress();
        }



        // =================================================
        // COURSE TYPE
        // =================================================

        const courseType = document.getElementById('courseType');

        const semesterField = document.getElementById('semesterField');
        const yearField = document.getElementById('yearField');

        const numberOfSemesters = document.getElementById('numberOfSemesters');
        const numberOfYears = document.getElementById('numberOfYears');


        function updateCourseType() {

            semesterField.style.display = 'none';
            yearField.style.display = 'none';

            numberOfSemesters.required = false;
            numberOfYears.required = false;

            if (courseType.value === 'Semester') {

                semesterField.style.display = '';

                numberOfSemesters.required = true;
                numberOfYears.value = '';

            } else if (courseType.value === 'Year') {

                yearField.style.display = '';

                numberOfYears.required = true;
                numberOfSemesters.value = '';

            } else {

                numberOfSemesters.value = '';
                numberOfYears.value = '';

            }

        }


        courseType.addEventListener('change', updateCourseType);

        updateCourseType();



        // =================================================
        // QUALIFICATION AJAX
        // =================================================

        const qualificationUrl = <?= json_encode(
                                        site_url('students/vijetaas/getQualifications/')
                                    ) ?>;


        function loadQualifications(levelSelectId, qualificationSelectId, selectedValue) {

            const levelSelect = document.getElementById(levelSelectId);
            const qualificationSelect = document.getElementById(qualificationSelectId);

            const selectedOption = levelSelect.options[levelSelect.selectedIndex];

            const levelId = selectedOption ?
                selectedOption.getAttribute('data-id') :
                null;


            qualificationSelect.innerHTML =
                '<option value="">-- Select Qualification / Class --</option>';


            if (!levelId) {
                return;
            }


            qualificationSelect.innerHTML =
                '<option value="">Loading...</option>';


            fetch(qualificationUrl + encodeURIComponent(levelId), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })

                .then(function(response) {

                    if (!response.ok) {
                        throw new Error('Unable to load qualifications.');
                    }

                    return response.json();

                })

                .then(function(data) {

                    qualificationSelect.innerHTML =
                        '<option value="">-- Select Qualification / Class --</option>';


                    if (Array.isArray(data) && data.length > 0) {

                        data.forEach(function(qualification) {

                            const option = document.createElement('option');

                            option.value = qualification.name;
                            option.textContent = qualification.name;

                            if (selectedValue &&
                                selectedValue === qualification.name) {

                                option.selected = true;

                            }

                            qualificationSelect.appendChild(option);

                        });

                    } else {

                        qualificationSelect.innerHTML =
                            '<option value="">No qualifications available</option>';

                    }

                })

                .catch(function(error) {

                    console.error(error);

                    qualificationSelect.innerHTML =
                        '<option value="">Unable to load qualifications</option>';

                });

        }


        const currentEducationLevel = document.getElementById(
            'currentEducationLevel'
        );

        const highestEducationLevel = document.getElementById(
            'highestEducationLevel'
        );


        currentEducationLevel.addEventListener('change', function() {

            loadQualifications(
                'currentEducationLevel',
                'currentQualification',
                null
            );

        });


        highestEducationLevel.addEventListener('change', function() {

            loadQualifications(
                'highestEducationLevel',
                'highestQualification',
                null
            );

        });


        // Restore qualification dropdowns after validation reload.
        const oldCurrentQualification = <?= json_encode(
                                            old('Current_Qualification', '')
                                        ) ?>;

        const oldHighestQualification = <?= json_encode(
                                            old('Highest_Qualification', '')
                                        ) ?>;


        if (currentEducationLevel.value !== '') {

            loadQualifications(
                'currentEducationLevel',
                'currentQualification',
                oldCurrentQualification
            );

        }


        if (highestEducationLevel.value !== '') {

            loadQualifications(
                'highestEducationLevel',
                'highestQualification',
                oldHighestQualification
            );

        }

    });
</script>
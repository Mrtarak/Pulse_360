<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<?php
$student = $student ?? [];
$assignedMentorIds = $assignedMentorIds ?? [];

$currentQualification = $student['Current_Qualification'] ?? '';
$highestQualification = $student['Highest_Qualification'] ?? '';

$currentLevel = $student['Current_Education_Level'] ?? '';
$highestLevel = $student['Highest_Education_Level'] ?? '';

$currentCourseType = $student['Course_Type'] ?? '';

$permanentSameAsCurrent =
    ($student['Permanent_Address'] ?? '') === ($student['Address'] ?? '') &&
    ($student['Permanent_Village_City'] ?? '') === ($student['Village_City'] ?? '') &&
    ($student['Permanent_District'] ?? '') === ($student['District'] ?? '') &&
    ($student['Permanent_State'] ?? '') === ($student['State'] ?? '') &&
    ($student['Permanent_Pincode'] ?? '') === ($student['Pincode'] ?? '');

$declarationText = 'I confirm that the information provided is accurate to the best of my knowledge. I understand that submitting this form does not guarantee selection or financial assistance.';
?>

<div class="container-fluid page-body-wrapper">

    <?= view('includes/sidebar'); ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">

                            <?= view('includes/breadcrumb'); ?>
                            <?= view('includes/messages'); ?>

                            <h4 class="card-title">
                                <i class="mdi mdi-account-edit menu-icon"></i>
                                Edit Vijetaas Student
                            </h4>

                            <form
                                action="<?= site_url('students/vijetaas/update/' . $student['Vijetaas_Stu_Id']) ?>"
                                method="post"
                                enctype="multipart/form-data"
                                id="editStudentForm">

                                <?= csrf_field() ?>

                                <!-- TAB NAVIGATION -->

                                <ul class="nav nav-tabs" id="studentTabs">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personal">
                                            Personal Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#family">
                                            Family Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#education">
                                            Education
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#program">
                                            Program Information
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#mentors">
                                            Mentor Selection
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#declaration">
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

                                            <div class="col-md-4 mb-3">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="First_Name"
                                                    class="form-control"
                                                    value="<?= esc($student['First_Name'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Last_Name"
                                                    class="form-control"
                                                    value="<?= esc($student['Last_Name'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Gender <span class="text-danger">*</span></label>
                                                <select name="Gender" class="form-control" required>
                                                    <option value="">-- Select Gender --</option>
                                                    <?php foreach (['Male', 'Female', 'Other'] as $gender): ?>
                                                        <option value="<?= $gender ?>"
                                                            <?= ($student['Gender'] ?? '') === $gender ? 'selected' : '' ?>>
                                                            <?= $gender ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date"
                                                    name="DOB"
                                                    class="form-control"
                                                    value="<?= esc($student['DOB'] ?? '') ?>"
                                                    max="<?= date('Y-m-d') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Caste <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="caste"
                                                    class="form-control"
                                                    value="<?= esc($student['Student_Caste'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Aadhaar Number</label>
                                                <input type="text"
                                                    name="Aadhar_No"
                                                    class="form-control"
                                                    value="<?= esc($student['Aadhar_No'] ?? '') ?>"
                                                    maxlength="12">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Phone Number <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Phone_No"
                                                    class="form-control"
                                                    value="<?= esc($student['Phone_No'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Email ID</label>
                                                <input type="email"
                                                    name="Email_Id"
                                                    class="form-control"
                                                    value="<?= esc($student['Email_Id'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Nationality <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Nationality"
                                                    class="form-control"
                                                    value="<?= esc($student['Nationality'] ?? 'Indian') ?>"
                                                    required>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <h5 class="text-primary">Current Address</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <textarea name="Address"
                                                    id="currentAddress"
                                                    class="form-control"
                                                    rows="2"
                                                    required><?= esc($student['Address'] ?? '') ?></textarea>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>City / Village <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Village_City"
                                                    id="currentCity"
                                                    class="form-control"
                                                    value="<?= esc($student['Village_City'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>District <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="District"
                                                    id="currentDistrict"
                                                    class="form-control"
                                                    value="<?= esc($student['District'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>State <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="State"
                                                    id="currentState"
                                                    class="form-control"
                                                    value="<?= esc($student['State'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Pincode <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Pincode"
                                                    id="currentPincode"
                                                    class="form-control"
                                                    value="<?= esc($student['Pincode'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                    <h5 class="text-primary">Permanent Address</h5>

                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input"
                                                            id="sameAsCurrent"
                                                            <?= $permanentSameAsCurrent ? 'checked' : '' ?>>

                                                        <label class="form-check-label" for="sameAsCurrent">
                                                            Same as Current Address
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <textarea name="Permanent_Address"
                                                    id="permanentAddress"
                                                    class="form-control permanent-field"
                                                    rows="2"
                                                    required><?= esc($student['Permanent_Address'] ?? '') ?></textarea>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>City / Village <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Permanent_Village_City"
                                                    id="permanentCity"
                                                    class="form-control permanent-field"
                                                    value="<?= esc($student['Permanent_Village_City'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>District <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Permanent_District"
                                                    id="permanentDistrict"
                                                    class="form-control permanent-field"
                                                    value="<?= esc($student['Permanent_District'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>State <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Permanent_State"
                                                    id="permanentState"
                                                    class="form-control permanent-field"
                                                    value="<?= esc($student['Permanent_State'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Pincode <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="Permanent_Pincode"
                                                    id="permanentPincode"
                                                    class="form-control permanent-field"
                                                    value="<?= esc($student['Permanent_Pincode'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <!-- STUDENT PHOTO -->

                                            <div class="col-md-6 mb-4 mt-3">
                                                <div class="card shadow-sm border-0">
                                                    <div class="card-header bg-primary text-white text-center">
                                                        <h5 class="mb-0">Student Photo</h5>
                                                    </div>

                                                    <div class="card-body text-center">

                                                        <?php if (!empty($student['Photo_URL'])): ?>
                                                            <img
                                                                src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                                                class="img-thumbnail shadow mb-3"
                                                                style="width:180px;height:180px;object-fit:cover;border-radius:10px;"
                                                                alt="Student Photo">
                                                        <?php else: ?>
                                                            <div class="text-muted py-4">
                                                                <i class="mdi mdi-image-off mdi-48px"></i>
                                                                <p>No Student Photo</p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <input type="file"
                                                            name="photo"
                                                            class="form-control"
                                                            accept="image/jpeg,image/png,image/jpg">

                                                        <small class="text-muted">
                                                            Leave empty to keep the existing photo.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- AADHAAR DOCUMENT -->

                                            <div class="col-md-6 mb-4 mt-3">
                                                <div class="card shadow-sm border-0">
                                                    <div class="card-header bg-success text-white text-center">
                                                        <h5 class="mb-0">Aadhaar Document</h5>
                                                    </div>

                                                    <div class="card-body text-center">

                                                        <?php if (!empty($student['Aadhar_Photo_URL'])): ?>
                                                            <a href="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                                                target="_blank"
                                                                class="btn btn-outline-success mb-3">
                                                                <i class="mdi mdi-file-eye"></i>
                                                                View Existing Aadhaar Document
                                                            </a>
                                                        <?php else: ?>
                                                            <div class="text-muted py-3">
                                                                <i class="mdi mdi-file-hidden mdi-36px"></i>
                                                                <p>No Aadhaar Document</p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <input type="file"
                                                            name="aadhar_photo"
                                                            class="form-control"
                                                            accept="image/jpeg,image/png,image/jpg">

                                                        <small class="text-muted">
                                                            Leave empty to keep the existing document.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary next-tab">
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

                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Name</label>
                                                <input type="text"
                                                    name="father_name"
                                                    class="form-control"
                                                    value="<?= esc($student['Fathers_Name'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Relation with Guardian <span class="text-danger">*</span></label>
                                                <select name="Guardian_Relation" class="form-control" required>
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
                                                            <?= ($student['Guardian_Relation'] ?? '') === $relation ? 'selected' : '' ?>>
                                                            <?= esc($relation) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Contact</label>
                                                <input type="text"
                                                    name="father_contact"
                                                    class="form-control"
                                                    value="<?= esc($student['Father_Contact_Number'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Email</label>
                                                <input type="email"
                                                    name="father_email"
                                                    class="form-control"
                                                    value="<?= esc($student['Father_Email_ID'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Guardian Occupation</label>
                                                <input type="text"
                                                    name="father_occupation"
                                                    class="form-control"
                                                    value="<?= esc($student['Father_Occupation'] ?? '') ?>">
                                            </div>

                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Mother Information</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Name</label>
                                                <input type="text"
                                                    name="mother_name"
                                                    class="form-control"
                                                    value="<?= esc($student['Mothers_Name'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Contact</label>
                                                <input type="text"
                                                    name="mother_contact"
                                                    class="form-control"
                                                    value="<?= esc($student['Mother_Contact_Number'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Email</label>
                                                <input type="email"
                                                    name="mother_email"
                                                    class="form-control"
                                                    value="<?= esc($student['Mother_Email_ID'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Mother's Occupation</label>
                                                <input type="text"
                                                    name="mother_occupation"
                                                    class="form-control"
                                                    value="<?= esc($student['Mother_Occupation'] ?? '') ?>">
                                            </div>

                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Family Details</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Family Monthly Income <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    name="income"
                                                    class="form-control"
                                                    min="0"
                                                    step="1"
                                                    value="<?= esc($student['Family_Monthly_Income'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Number of Siblings <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    name="siblings"
                                                    class="form-control"
                                                    min="0"
                                                    value="<?= esc($student['Sibling_Number'] ?? '') ?>"
                                                    required>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button" class="btn btn-primary next-tab">
                                                Next
                                            </button>
                                        </div>

                                    </div>


                                    <!-- ================================================= -->
                                    <!-- 3. EDUCATION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="education">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Current Education</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Education Level <span class="text-danger">*</span></label>

                                                <select name="Current_Education_Level"
                                                    id="currentEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>
                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= $currentLevel === $level['name'] ? 'selected' : '' ?>>
                                                            <?= esc($level['name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Qualification / Class <span class="text-danger">*</span></label>

                                                <select name="Current_Qualification"
                                                    id="currentQualification"
                                                    class="form-control"
                                                    data-selected="<?= esc($currentQualification) ?>"
                                                    required>
                                                    <option value="">-- Select Qualification / Class --</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>College / Institution Name</label>
                                                <input type="text"
                                                    name="College_Institution_Name"
                                                    class="form-control"
                                                    value="<?= esc($student['College_Institution_Name'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>University Name</label>
                                                <input type="text"
                                                    name="University_Name"
                                                    class="form-control"
                                                    value="<?= esc($student['University_Name'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Specialization / Subject</label>
                                                <input type="text"
                                                    name="Current_Specialization_Subject"
                                                    class="form-control"
                                                    value="<?= esc($student['Current_Specialization_Subject'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Education Status <span class="text-danger">*</span></label>

                                                <select name="Current_Education_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <?php foreach (['Ongoing', 'Completed', 'Discontinued'] as $status): ?>
                                                        <option value="<?= $status ?>"
                                                            <?= ($student['Current_Education_Status'] ?? '') === $status ? 'selected' : '' ?>>
                                                            <?= $status ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Course Type <span class="text-danger">*</span></label>

                                                <select name="Course_Type"
                                                    id="courseType"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Course Type --</option>

                                                    <option value="Semester"
                                                        <?= $currentCourseType === 'Semester' ? 'selected' : '' ?>>
                                                        Semester
                                                    </option>

                                                    <option value="Year"
                                                        <?= $currentCourseType === 'Year' ? 'selected' : '' ?>>
                                                        Year
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3" id="semesterField">
                                                <label>Number of Semesters <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    name="Number_of_Semesters"
                                                    id="numberOfSemesters"
                                                    class="form-control"
                                                    min="1"
                                                    value="<?= esc($student['Number_of_Semesters'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3" id="yearField">
                                                <label>Number of Years <span class="text-danger">*</span></label>
                                                <input type="number"
                                                    name="Number_of_Years"
                                                    id="numberOfYears"
                                                    class="form-control"
                                                    min="1"
                                                    value="<?= esc($student['Number_of_Years'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Expected Course Completion Date</label>
                                                <input type="date"
                                                    name="Expected_Course_Completion_Date"
                                                    class="form-control"
                                                    value="<?= esc($student['Expected_Course_Completion_Date'] ?? '') ?>">
                                            </div>

                                            <div class="col-12 mt-4 mb-3">
                                                <h5 class="text-primary">Last Highest Education Completed</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Education Level <span class="text-danger">*</span></label>

                                                <select name="Highest_Education_Level"
                                                    id="highestEducationLevel"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Education Level --</option>

                                                    <?php foreach ($educationLevels as $level): ?>
                                                        <option
                                                            value="<?= esc($level['name']) ?>"
                                                            data-id="<?= esc($level['id']) ?>"
                                                            <?= $highestLevel === $level['name'] ? 'selected' : '' ?>>
                                                            <?= esc($level['name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Qualification / Class <span class="text-danger">*</span></label>

                                                <select name="Highest_Qualification"
                                                    id="highestQualification"
                                                    class="form-control"
                                                    data-selected="<?= esc($highestQualification) ?>"
                                                    required>

                                                    <option value="">-- Select Qualification / Class --</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Specialization / Subject</label>
                                                <input type="text"
                                                    name="Highest_Specialization_Subject"
                                                    class="form-control"
                                                    value="<?= esc($student['Highest_Specialization_Subject'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Student Status <span class="text-danger">*</span></label>

                                                <select name="Student_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <?php foreach (['Active', 'Inactive', 'Completed'] as $status): ?>
                                                        <option value="<?= $status ?>"
                                                            <?= ($student['Student_Status'] ?? '') === $status ? 'selected' : '' ?>>
                                                            <?= $status ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button" class="btn btn-primary next-tab">
                                                Next
                                            </button>
                                        </div>

                                    </div>


                                    <!-- ================================================= -->
                                    <!-- 4. PROGRAM INFORMATION -->
                                    <!-- ================================================= -->

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
                                                    value="<?= esc($student['Program_Id'] ?? \Config\CorePrograms::VIJEETAS) ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Enrollment Date <span class="text-danger">*</span></label>

                                                <input type="date"
                                                    name="Enrollment_Date"
                                                    class="form-control"
                                                    value="<?= esc($student['Enrollment_Date'] ?? '') ?>"
                                                    required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Completion Date</label>

                                                <input type="date"
                                                    name="Completion_Date"
                                                    class="form-control"
                                                    value="<?= esc($student['Completion_Date'] ?? '') ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Vijetaas Status <span class="text-danger">*</span></label>

                                                <select name="Vijeta_Status"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Status --</option>

                                                    <?php foreach (['Active', 'Inactive', 'Completed'] as $status): ?>
                                                        <option value="<?= $status ?>"
                                                            <?= ($student['Vijeta_Status'] ?? '') === $status ? 'selected' : '' ?>>
                                                            <?= $status ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button" class="btn btn-primary next-tab">
                                                Next
                                            </button>
                                        </div>

                                    </div>


                                    <!-- ================================================= -->
                                    <!-- 5. MENTOR SELECTION -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="mentors">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Assign Mentors</h5>
                                                <p class="text-muted">
                                                    Select one or more active mentors for this student.
                                                </p>
                                                <hr>
                                            </div>

                                            <?php if (!empty($mentors)): ?>

                                                <?php foreach ($mentors as $mentor): ?>

                                                    <div class="col-md-4 col-sm-6 mb-3">

                                                        <div class="form-check border rounded p-3">

                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input mentor-checkbox"
                                                                name="Mentor_Ids[]"
                                                                id="mentor_<?= esc($mentor['User_Id']) ?>"
                                                                value="<?= esc($mentor['User_Id']) ?>"
                                                                <?= in_array($mentor['User_Id'], $assignedMentorIds, true) ? 'checked' : '' ?>>

                                                            <label
                                                                class="form-check-label"
                                                                for="mentor_<?= esc($mentor['User_Id']) ?>">

                                                                <?= esc(trim($mentor['User_FirstName'] . ' ' . $mentor['User_LastName'])) ?>

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
                                            <button type="button" class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <button type="button" class="btn btn-primary next-tab">
                                                Next
                                            </button>
                                        </div>

                                    </div>


                                    <!-- ================================================= -->
                                    <!-- 6. DECLARATION AND DOCUMENTS -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade" id="declaration">

                                        <div class="row">

                                            <div class="col-12 mb-3">
                                                <h5 class="text-primary">Referral Information</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Referral Source <span class="text-danger">*</span></label>

                                                <select name="Referral_Source"
                                                    class="form-control"
                                                    required>

                                                    <option value="">-- Select Referral Source --</option>

                                                    <?php
                                                    $referralSources = [
                                                        'School',
                                                        'College',
                                                        'Social Media',
                                                        'Website',
                                                        'Friends / Family',
                                                        'NGO',
                                                        'Other'
                                                    ];
                                                    ?>

                                                    <?php foreach ($referralSources as $source): ?>
                                                        <option value="<?= esc($source) ?>"
                                                            <?= ($student['Referral_Source'] ?? '') === $source ? 'selected' : '' ?>>
                                                            <?= esc($source) ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Referring Person / Organisation</label>

                                                <input type="text"
                                                    name="Referral_Person_Organisation"
                                                    class="form-control"
                                                    value="<?= esc($student['Referral_Person_Organisation'] ?? '') ?>">
                                            </div>

                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Declaration</h5>
                                                <hr>

                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <?= esc($declarationText) ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">

                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        name="Declaration_Accepted"
                                                        id="Declaration_Accepted"
                                                        class="form-check-input"
                                                        value="1"
                                                        <?= !empty($student['Declaration_Accepted']) ? 'checked' : '' ?>
                                                        required>

                                                    <label class="form-check-label" for="Declaration_Accepted">
                                                        I have read and accept the declaration above.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="col-12 mt-3 mb-3">
                                                <h5 class="text-primary">Declaration Certificate</h5>
                                                <hr>
                                            </div>

                                            <div class="col-md-8 mb-3">

                                                <label>Upload Declaration Certificate</label>

                                                <input type="file"
                                                    name="declaration_certificate"
                                                    class="form-control"
                                                    accept=".pdf,.jpg,.jpeg,.png">

                                                <small class="text-muted">
                                                    Accepted formats: PDF, JPG, JPEG and PNG. Maximum size: 5 MB.
                                                    Leave empty to retain the existing certificate.
                                                </small>

                                                <?php if (!empty($student['Declaration_Certificate_URL'])): ?>

                                                    <div class="mt-3">
                                                        <a href="<?= base_url('uploads/students/declaration/' . $student['Declaration_Certificate_URL']) ?>"
                                                            target="_blank"
                                                            class="btn btn-outline-primary btn-sm">

                                                            <i class="mdi mdi-file-eye"></i>
                                                            View Existing Declaration Certificate

                                                        </a>
                                                    </div>

                                                <?php else: ?>

                                                    <p class="text-muted mt-2">
                                                        No declaration certificate uploaded.
                                                    </p>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                        <div class="mt-4 d-flex justify-content-center gap-3">

                                            <button type="button" class="btn btn-secondary prev-tab">
                                                Previous
                                            </button>

                                            <a href="<?= site_url('students/vijetaas') ?>"
                                                class="btn btn-light">
                                                Cancel
                                            </a>

                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-content-save"></i>
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
    document.addEventListener('DOMContentLoaded', function() {

        const tabs = Array.from(
            document.querySelectorAll('#studentTabs .nav-link')
        );

        // --------------------------------------------------
        // TAB NAVIGATION
        // --------------------------------------------------

        document.querySelectorAll('.next-tab').forEach(function(button) {

            button.addEventListener('click', function() {

                const activeIndex = tabs.findIndex(tab =>
                    tab.classList.contains('active')
                );

                if (activeIndex < tabs.length - 1) {
                    bootstrap.Tab.getOrCreateInstance(
                        tabs[activeIndex + 1]
                    ).show();
                }

            });

        });

        document.querySelectorAll('.prev-tab').forEach(function(button) {

            button.addEventListener('click', function() {

                const activeIndex = tabs.findIndex(tab =>
                    tab.classList.contains('active')
                );

                if (activeIndex > 0) {
                    bootstrap.Tab.getOrCreateInstance(
                        tabs[activeIndex - 1]
                    ).show();
                }

            });

        });


        // --------------------------------------------------
        // SAME AS CURRENT ADDRESS
        // --------------------------------------------------

        const sameAddressCheckbox = document.getElementById('sameAsCurrent');

        const addressFields = [
            ['currentAddress', 'permanentAddress'],
            ['currentCity', 'permanentCity'],
            ['currentDistrict', 'permanentDistrict'],
            ['currentState', 'permanentState'],
            ['currentPincode', 'permanentPincode']
        ];

        function copyCurrentAddress() {

            addressFields.forEach(function(fields) {

                const currentField = document.getElementById(fields[0]);
                const permanentField = document.getElementById(fields[1]);

                permanentField.value = currentField.value;
                permanentField.readOnly = true;

            });

        }

        function enablePermanentAddress() {

            addressFields.forEach(function(fields) {

                const permanentField = document.getElementById(fields[1]);
                permanentField.readOnly = false;

            });

        }

        if (sameAddressCheckbox) {

            if (sameAddressCheckbox.checked) {
                copyCurrentAddress();
            }

            sameAddressCheckbox.addEventListener('change', function() {

                if (this.checked) {
                    copyCurrentAddress();
                } else {
                    enablePermanentAddress();
                }

            });

            addressFields.forEach(function(fields) {

                const currentField = document.getElementById(fields[0]);

                currentField.addEventListener('input', function() {

                    if (sameAddressCheckbox.checked) {
                        copyCurrentAddress();
                    }

                });

            });

        }


        // --------------------------------------------------
        // EDUCATION QUALIFICATION AJAX
        // --------------------------------------------------

        const qualificationUrl = "<?= site_url('students/vijetaas/getQualifications/') ?>";

        function loadQualifications(levelSelectId, qualificationSelectId) {

            const levelSelect = document.getElementById(levelSelectId);
            const qualificationSelect = document.getElementById(qualificationSelectId);

            if (!levelSelect || !qualificationSelect) {
                return;
            }

            const selectedOption = levelSelect.options[levelSelect.selectedIndex];
            const levelId = selectedOption ? selectedOption.dataset.id : '';

            const selectedQualification = qualificationSelect.dataset.selected || '';

            qualificationSelect.innerHTML =
                '<option value="">-- Select Qualification / Class --</option>';

            if (!levelId) {
                return;
            }

            fetch(qualificationUrl + encodeURIComponent(levelId))
                .then(response => {

                    if (!response.ok) {
                        throw new Error('Unable to load qualifications.');
                    }

                    return response.json();

                })
                .then(data => {

                    data.forEach(function(qualification) {

                        const option = document.createElement('option');

                        option.value = qualification.name;
                        option.textContent = qualification.name;

                        if (qualification.name === selectedQualification) {
                            option.selected = true;
                        }

                        qualificationSelect.appendChild(option);

                    });

                })
                .catch(error => {

                    console.error(error);

                });

        }

        const currentLevelSelect = document.getElementById('currentEducationLevel');
        const highestLevelSelect = document.getElementById('highestEducationLevel');

        loadQualifications(
            'currentEducationLevel',
            'currentQualification'
        );

        loadQualifications(
            'highestEducationLevel',
            'highestQualification'
        );

        currentLevelSelect.addEventListener('change', function() {

            const qualificationSelect = document.getElementById('currentQualification');

            qualificationSelect.dataset.selected = '';

            loadQualifications(
                'currentEducationLevel',
                'currentQualification'
            );

        });

        highestLevelSelect.addEventListener('change', function() {

            const qualificationSelect = document.getElementById('highestQualification');

            qualificationSelect.dataset.selected = '';

            loadQualifications(
                'highestEducationLevel',
                'highestQualification'
            );

        });


        // --------------------------------------------------
        // COURSE TYPE: SEMESTER / YEAR
        // --------------------------------------------------

        const courseType = document.getElementById('courseType');

        const semesterField = document.getElementById('semesterField');
        const yearField = document.getElementById('yearField');

        const semesterInput = document.getElementById('numberOfSemesters');
        const yearInput = document.getElementById('numberOfYears');

        function updateCourseFields() {

            semesterField.style.display = 'none';
            yearField.style.display = 'none';

            semesterInput.required = false;
            yearInput.required = false;

            semesterInput.disabled = true;
            yearInput.disabled = true;

            if (courseType.value === 'Semester') {

                semesterField.style.display = '';
                semesterInput.required = true;
                semesterInput.disabled = false;

            } else if (courseType.value === 'Year') {

                yearField.style.display = '';
                yearInput.required = true;
                yearInput.disabled = false;

            }

        }

        courseType.addEventListener('change', updateCourseFields);

        updateCourseFields();

    });
</script>
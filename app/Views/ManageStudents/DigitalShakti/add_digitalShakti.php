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

                            <h4 class="card-title mb-4">
                                <i class="mdi mdi-laptop menu-icon"></i>
                                Add Digital Shakti Student
                            </h4>


                            <form action="<?= base_url('digitalshakti/save') ?>"
                                method="post"
                                enctype="multipart/form-data">


                                <!-- ================================================= -->
                                <!-- TABS -->
                                <!-- ================================================= -->

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


                                    <!-- ================================================= -->
                                    <!-- PERSONAL TAB -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade show active"
                                        id="personal">

                                        <div class="row">


                                            <!-- First Name -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    First Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="first_name"
                                                    class="form-control"
                                                    required>

                                            </div>


                                            <!-- Last Name -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Last Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="last_name"
                                                    class="form-control"
                                                    required>

                                            </div>


                                            <!-- Gender -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Gender
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select name="gender"
                                                    class="form-control"
                                                    required>

                                                    <option value="">
                                                        Select
                                                    </option>

                                                    <option value="Male">
                                                        Male
                                                    </option>

                                                    <option value="Female">
                                                        Female
                                                    </option>

                                                    <option value="Other">
                                                        Other
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- DOB -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    DOB
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="date"
                                                    name="dob"
                                                    class="form-control"
                                                    max="<?= date('Y-m-d') ?>"
                                                    required>

                                            </div>


                                            <!-- Aadhar -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Aadhar No
                                                </label>

                                                <input type="text"
                                                    name="aadhar_no"
                                                    class="form-control">

                                            </div>


                                            <!-- Phone -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Phone
                                                </label>

                                                <input type="text"
                                                    name="phone"
                                                    class="form-control">

                                            </div>


                                            <!-- Email -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Email
                                                </label>

                                                <input type="email"
                                                    name="email"
                                                    class="form-control">

                                            </div>


                                            <!-- Marital Status -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Marital Status
                                                </label>

                                                <select name="marital_status"
                                                    class="form-control">

                                                    <option value="">
                                                        Select
                                                    </option>

                                                    <option value="Single">
                                                        Single
                                                    </option>

                                                    <option value="Married">
                                                        Married
                                                    </option>

                                                    <option value="Widow">
                                                        Widow
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- CASTE MOVED HERE -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Caste
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="caste"
                                                    class="form-control"
                                                    required>

                                            </div>


                                            <!-- City -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    City
                                                </label>

                                                <input type="text"
                                                    name="city"
                                                    class="form-control">

                                            </div>


                                            <!-- District -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    District
                                                </label>

                                                <input type="text"
                                                    name="district"
                                                    class="form-control">

                                            </div>


                                            <!-- State -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    State
                                                </label>

                                                <input type="text"
                                                    name="state"
                                                    class="form-control">

                                            </div>


                                            <!-- Pincode -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Pincode
                                                </label>

                                                <input type="text"
                                                    name="pincode"
                                                    class="form-control">

                                            </div>


                                            <!-- Nationality -->

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Nationality
                                                </label>

                                                <input type="text"
                                                    name="nationality"
                                                    class="form-control"
                                                    value="Indian">

                                            </div>


                                            <!-- Address -->

                                            <div class="col-md-12 mb-3">

                                                <label>
                                                    Address
                                                </label>

                                                <textarea name="address"
                                                    class="form-control"
                                                    rows="3"></textarea>

                                            </div>


                                            <!-- Photos -->

                                            <div class="row">

                                                <div class="col-md-4 mb-3">

                                                    <label>
                                                        Student Photo
                                                    </label>

                                                    <input type="file"
                                                        name="photo"
                                                        class="form-control"
                                                        accept="image/*">

                                                    <small class="text-muted">

                                                        Maximum file size:
                                                        <strong>2 MB</strong>.
                                                        Allowed formats:
                                                        <strong>
                                                            JPG, JPEG, PNG
                                                        </strong>.

                                                    </small>

                                                </div>


                                                <div class="col-md-4 mb-3">

                                                    <label>
                                                        Aadhaar Photo
                                                    </label>

                                                    <input type="file"
                                                        name="aadhar_photo"
                                                        class="form-control"
                                                        accept="image/*">

                                                    <small class="text-muted">

                                                        Maximum file size:
                                                        <strong>2 MB</strong>.
                                                        Allowed formats:
                                                        <strong>
                                                            JPG, JPEG, PNG
                                                        </strong>.

                                                    </small>

                                                </div>

                                            </div>

                                        </div>


                                        <button type="button"
                                            class="btn btn-primary next-tab">

                                            Next

                                        </button>

                                    </div>


                                    <!-- ================================================= -->
                                    <!-- EDUCATION TAB -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade"
                                        id="education">

                                        <div class="row">


                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Current Education
                                                </label>

                                                <input type="text"
                                                    name="current_edu"
                                                    class="form-control">

                                            </div>


                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Highest Education
                                                </label>

                                                <input type="text"
                                                    name="highest_edu"
                                                    class="form-control">

                                            </div>


                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Status
                                                </label>

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


                                    <!-- ================================================= -->
                                    <!-- PROGRAM TAB -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade"
                                        id="program">

                                        <div class="row">


                                            <!-- Enrollment Date -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Enrollment Date
                                                </label>

                                                <input type="date"
                                                    name="enroll_date"
                                                    class="form-control"
                                                    max="<?= date('Y-m-d') ?>">

                                            </div>


                                            <!-- Program -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Program
                                                </label>

                                                <input type="text"
                                                    class="form-control"
                                                    value="Digital Shakti"
                                                    readonly>

                                            </div>


                                            <!-- Center -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Center
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select class="form-control"
                                                    name="center_id"
                                                    required>

                                                    <option value="">
                                                        Select Center
                                                    </option>

                                                    <?php foreach ($centers as $center): ?>

                                                        <option value="<?= $center['Center_Id']; ?>">

                                                            <?= esc(
                                                                $center['Center_Name']
                                                            ); ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>


                                            <!-- Batch -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Batch
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select class="form-control"
                                                    name="batch_id"
                                                    required>

                                                    <option value="">
                                                        Select Batch
                                                    </option>

                                                    <?php foreach ($batches as $batch): ?>

                                                        <option value="<?= $batch['Batch_Id']; ?>">

                                                            <?= esc(
                                                                $batch['Batch_Name']
                                                            ); ?>

                                                        </option>

                                                    <?php endforeach; ?>

                                                </select>

                                            </div>


                                            <!-- Program Level -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Program Level
                                                </label>

                                                <input type="text"
                                                    name="program_level"
                                                    class="form-control">

                                            </div>


                                            <!-- Program Status -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Program Status
                                                </label>

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


                                            <!-- Program Till -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Program Till
                                                </label>

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


                                    <!-- ================================================= -->
                                    <!-- FAMILY TAB -->
                                    <!-- ================================================= -->

                                    <div class="tab-pane fade"
                                        id="family">

                                        <div class="row">


                                            <!-- Guardian Name -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Guardian Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="father_name"
                                                    class="form-control"
                                                    required>

                                            </div>


                                            <!-- Guardian Relation -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Guardian Relation
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select name="guardian_relation"
                                                    class="form-control"
                                                    required>

                                                    <option value="">
                                                        Select Relation
                                                    </option>

                                                    <option value="Father">
                                                        Father
                                                    </option>

                                                    <option value="Mother">
                                                        Mother
                                                    </option>

                                                    <option value="Guardian">
                                                        Guardian
                                                    </option>

                                                    <option value="Uncle">
                                                        Uncle
                                                    </option>

                                                    <option value="Aunt">
                                                        Aunt
                                                    </option>

                                                    <option value="Grandfather">
                                                        Grandfather
                                                    </option>

                                                    <option value="Grandmother">
                                                        Grandmother
                                                    </option>

                                                    <option value="Sibling">
                                                        Sibling
                                                    </option>

                                                    <option value="Other">
                                                        Other
                                                    </option>

                                                </select>

                                            </div>


                                            <!-- Guardian Contact -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Guardian Contact
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text"
                                                    name="father_contact"
                                                    class="form-control"
                                                    required>

                                            </div>


                                            <!-- Guardian Email -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Guardian Email
                                                </label>

                                                <input type="email"
                                                    name="father_email"
                                                    class="form-control">

                                            </div>


                                            <!-- Guardian Occupation -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Guardian Occupation
                                                </label>

                                                <input type="text"
                                                    name="father_occupation"
                                                    class="form-control">

                                            </div>

                                            <div class="w-100"></div>


                                            <!-- Mother Name -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Mother Name
                                                </label>

                                                <input type="text"
                                                    name="mother_name"
                                                    class="form-control">

                                            </div>


                                            <!-- Mother Contact -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Mother Contact
                                                </label>

                                                <input type="text"
                                                    name="mother_contact"
                                                    class="form-control">

                                            </div>


                                            <!-- Mother Email -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Mother Email
                                                </label>

                                                <input type="email"
                                                    name="mother_email"
                                                    class="form-control">

                                            </div>


                                            <!-- Mother Occupation -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Mother Occupation
                                                </label>

                                                <input type="text"
                                                    name="mother_occupation"
                                                    class="form-control">

                                            </div>


                                            <!-- Family Income -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Family Monthly Income
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number"
                                                    name="income"
                                                    class="form-control"
                                                    min="0"
                                                    step="1"
                                                    required>

                                            </div>


                                            <!-- Siblings -->

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Number of Siblings
                                                </label>

                                                <input type="number"
                                                    name="siblings"
                                                    class="form-control"
                                                    min="0">

                                            </div>

                                        </div>


                                        <div class="text-end">

                                            <button type="submit"
                                                class="btn btn-primary">

                                                <i class="mdi mdi-content-save me-1"></i>

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
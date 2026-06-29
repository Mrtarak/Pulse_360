<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <?= view('includes/sidebar'); ?>

  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <?= view('includes/breadcrumb'); ?>

              <h4 class="card-title mb-3 text-primary">Edit Learning Adda Student</h4>
              <form method="post"
                action="<?= base_url('students/learning_adda/update/' . $student['LA_Stu_Id']) ?>"
                enctype="multipart/form-data">

                <?= csrf_field(); ?>

                <ul class="nav nav-tabs" id="studentTabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active"
                      id="personal-tab"
                      data-bs-toggle="tab"
                      href="#personal">
                      1. Personal Info
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      id="education-tab"
                      data-bs-toggle="tab"
                      href="#education">
                      2. Education
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      id="program-tab"
                      data-bs-toggle="tab"
                      href="#program">
                      3. Program
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      id="family-tab"
                      data-bs-toggle="tab"
                      href="#family">
                      4. Family
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
                          class="form-control"
                          name="first_name"
                          value="<?= esc($student['First_Name']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Last Name</label>
                        <input type="text"
                          class="form-control"
                          name="last_name"
                          value="<?= esc($student['Last_Name']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Gender</label>
                        <select class="form-control"
                          name="gender">

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
                        <label>Date of Birth</label>
                        <input type="date"
                          class="form-control"
                          name="dob"
                          value="<?= $student['DOB'] ?>"max="<?= date('Y-m-d') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Aadhar No</label>
                        <input type="text"
                          class="form-control"
                          name="aadhar_no"
                          value="<?= esc($student['Aadhar_No']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Phone</label>
                        <input type="text"
                          class="form-control"
                          name="phone"
                          value="<?= esc($student['Phone_No']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Email</label>
                        <input type="email"
                          class="form-control"
                          name="email"
                          value="<?= esc($student['Email_Id']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>City / Village</label>
                        <input type="text"
                          class="form-control"
                          name="city"
                          value="<?= esc($student['Village_City']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>District</label>
                        <input type="text"
                          class="form-control"
                          name="district"
                          value="<?= esc($student['District']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>State</label>
                        <input type="text"
                          class="form-control"
                          name="state"
                          value="<?= esc($student['State']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Pincode</label>
                        <input type="text"
                          class="form-control"
                          name="pincode"
                          value="<?= esc($student['Pincode']) ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Nationality</label>
                        <input type="text"
                          class="form-control"
                          name="nationality"
                          value="<?= esc($student['Nationality']) ?>">
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea class="form-control"
                          name="address"><?= esc($student['Address']) ?></textarea>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <textarea class="form-control"
                          name="remarks"><?= esc($student['Remarks']) ?></textarea>
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
                    id="education"
                    role="tabpanel">

                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <label>Current Education Level</label>
                        <input type="text"
                          class="form-control"
                          name="current_edu"
                          value="<?= esc($student['Current_Education_level']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Highest Education Completed</label>
                        <input type="text"
                          class="form-control"
                          name="highest_edu"
                          value="<?= esc($student['Highest_Education_Completed']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Student Class</label>
                        <input type="number"
                          class="form-control"
                          name="student_class"
                          value="<?= esc($student['Student_Class']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>School Name</label>
                        <input type="text"
                          class="form-control"
                          name="school_name"
                          value="<?= esc($student['School_Name']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>School Type</label>
                        <select class="form-control"
                          name="school_type">

                          <option value="Government"
                            <?= $student['School_Type'] == 'Government' ? 'selected' : '' ?>>
                            Government
                          </option>

                          <option value="Private"
                            <?= $student['School_Type'] == 'Private' ? 'selected' : '' ?>>
                            Private
                          </option>

                          <option value="Aided"
                            <?= $student['School_Type'] == 'Aided' ? 'selected' : '' ?>>
                            Aided
                          </option>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>School Medium</label>
                        <select class="form-control"
                          name="school_medium">

                          <option value="English"
                            <?= $student['School_Medium'] == 'English' ? 'selected' : '' ?>>
                            English
                          </option>

                          <option value="Bengali"
                            <?= $student['School_Medium'] == 'Bengali' ? 'selected' : '' ?>>
                            Bengali
                          </option>

                          <option value="Hindi"
                            <?= $student['School_Medium'] == 'Hindi' ? 'selected' : '' ?>>
                            Hindi
                          </option>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Caste</label>
                        <input type="text"
                          class="form-control"
                          name="caste"
                          value="<?= esc($student['Student_Caste']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Status</label>

                        <select class="form-control"
                          name="status">

                          <option value="Active"
                            <?= $student['Student_Status'] == 'Active' ? 'selected' : '' ?>>
                            Active
                          </option>

                          <option value="Inactive"
                            <?= $student['Student_Status'] == 'Inactive' ? 'selected' : '' ?>>
                            Inactive
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
                    id="program"
                    role="tabpanel">

                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <label>Enrollment Date</label>

                        <input type="date"
                          class="form-control"
                          name="enroll_date"max="<?= date('Y-m-d') ?>"
                          value="<?= $student['Enrollment_Date'] ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program</label>

                        <input type="text"
                          class="form-control"
                          value="<?= esc($student['Program_Name']) ?>"
                          readonly>

                        <input type="hidden"
                          name="Program_Id"
                          value="<?= esc($student['Program_Id']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Center</label>

                        <select class="form-control"
                          name="center_id">

                          <?php foreach ($centers as $center): ?>

                            <option value="<?= $center['Center_Id'] ?>"
                              <?= ($student['Center_Id'] == $center['Center_Id']) ? 'selected' : '' ?>>

                              <?= esc($center['Center_Name']) ?>

                            </option>

                          <?php endforeach; ?>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Batch</label>

                        <select class="form-control"
                          name="batch_id">

                          <?php foreach ($batches as $batch): ?>

                            <option value="<?= $batch['Batch_Id'] ?>"
                              <?= ($student['Batch_Id'] == $batch['Batch_Id']) ? 'selected' : '' ?>>

                              <?= esc($batch['Batch_Name']) ?>

                            </option>

                          <?php endforeach; ?>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program Status</label>

                        <select class="form-control"
                          name="program_status">

                          <option value="Active"
                            <?= $student['LA_Status'] == 'Active' ? 'selected' : '' ?>>
                            Active
                          </option>

                          <option value="Completed"
                            <?= $student['LA_Status'] == 'Completed' ? 'selected' : '' ?>>
                            Completed
                          </option>

                          <option value="Inactive"
                            <?= $student['LA_Status'] == 'Inactive' ? 'selected' : '' ?>>
                            Inactive
                          </option>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program Till</label>

                        <input type="date"
                          class="form-control"
                          name="prog_till"
                          value="<?= $student['Completion_Date'] ?>">
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
                        <label>Father's Name</label>
                        <input type="text"
                          class="form-control"
                          name="father_name"
                          value="<?= esc($student['Fathers_Name']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Contact</label>
                        <input type="text"
                          class="form-control"
                          name="father_contact"
                          value="<?= esc($student['Father_Contact_Number']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Email</label>
                        <input type="email"
                          class="form-control"
                          name="father_email"
                          value="<?= esc($student['Father_Email_ID']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Occupation</label>
                        <input type="text"
                          class="form-control"
                          name="father_occupation"
                          value="<?= esc($student['Father_Occupation']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Name</label>
                        <input type="text"
                          class="form-control"
                          name="mother_name"
                          value="<?= esc($student['Mothers_Name']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Contact</label>
                        <input type="text"
                          class="form-control"
                          name="mother_contact"
                          value="<?= esc($student['Mother_Contact_Number']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Email</label>
                        <input type="email"
                          class="form-control"
                          name="mother_email"
                          value="<?= esc($student['Mother_Email_ID']) ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Occupation</label>
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
                        <label>Number of Siblings</label>
                        <input type="number"
                          class="form-control"
                          name="siblings"
                          value="<?= esc($student['User_Siblings']) ?>">
                      </div>

                    </div>

                    <div class="d-flex justify-content-between">

                      <button type="button"
                        class="btn btn-secondary prev-tab">
                        Previous
                      </button>

                      <div>

                        <a href="<?= base_url('students/learning_adda') ?>"
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
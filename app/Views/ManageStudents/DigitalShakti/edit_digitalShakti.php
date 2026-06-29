<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-body">

          <?= view('includes/breadcrumb'); ?>

          <h4 class="card-title">Edit Digital Shakti Student</h4>

          <form action="<?= site_url('digitalshakti/update/' . $student['DS_Stu_Id']) ?>" method="post">

            <ul class="nav nav-tabs" id="studentTabs">

              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#personal">
                  Personal Info
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#education">
                  Education
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#program">
                  Program
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#family">
                  Family
                </a>
              </li>

            </ul>

            <div class="tab-content mt-3">

              <div class="tab-pane fade show active" id="personal">

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

                    <select name="gender" class="form-control">

                      <option value="Male"
                        <?= ($student['Gender'] == 'Male') ? 'selected' : '' ?>>
                        Male
                      </option>

                      <option value="Female"
                        <?= ($student['Gender'] == 'Female') ? 'selected' : '' ?>>
                        Female
                      </option>

                      <option value="Other"
                        <?= ($student['Gender'] == 'Other') ? 'selected' : '' ?>>
                        Other
                      </option>

                    </select>

                  </div>

                  <div class="col-md-4 mb-3">
                    <label>DOB</label>

                    <input type="date"
                      name="dob"
                      class="form-control"
                      value="<?= $student['DOB'] ?>"
                      max="<?= date('Y-m-d') ?>">
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
                    <label>City</label>

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

                    <textarea name="address"
                      class="form-control"><?= esc($student['Address']) ?></textarea>
                  </div>

                </div>

                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-primary next-tab">
                    Next
                  </button>
                </div>

              </div>
              <div class="tab-pane fade" id="education">

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label>Current Education</label>

                    <input type="text"
                      name="current_edu"
                      class="form-control"
                      value="<?= esc($student['Current_Education_level']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Highest Education</label>

                    <input type="text"
                      name="highest_edu"
                      class="form-control"
                      value="<?= esc($student['Highest_Education_Completed']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Caste</label>

                    <input type="text"
                      name="caste"
                      class="form-control"
                      value="<?= esc($student['Student_Caste']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Status</label>

                    <select name="status"
                      class="form-control">

                      <option value="Active"
                        <?= ($student['Student_Status'] == 'Active') ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option value="Inactive"
                        <?= ($student['Student_Status'] == 'Inactive') ? 'selected' : '' ?>>
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
              <div class="tab-pane fade" id="program">

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label>Enrollment Date</label>

                    <input type="date"
                      name="enroll_date"
                      class="form-control" max="<?= date('Y-m-d') ?>"
                      value="<?= $student['Enrollment_Date'] ?>">
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

                    <select name="center_id"
                      class="form-control">

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

                    <select name="batch_id"
                      class="form-control">

                      <?php foreach ($batches as $batch): ?>

                        <option value="<?= $batch['Batch_Id'] ?>"
                          <?= ($student['Batch_Id'] == $batch['Batch_Id']) ? 'selected' : '' ?>>

                          <?= esc($batch['Batch_Name']) ?>

                        </option>

                      <?php endforeach; ?>

                    </select>

                  </div>

                  <div class="col-md-6 mb-3">

                    <label>Program Level</label>

                    <input type="text"
                      name="program_level"
                      class="form-control"
                      value="<?= esc($student['Skill_level']) ?>">

                  </div>

                  <div class="col-md-6 mb-3">

                    <label>Program Status</label>

                    <select name="program_status"
                      class="form-control">

                      <option value="Active"
                        <?= ($student['DS_Status'] == 'Active') ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option value="Completed"
                        <?= ($student['DS_Status'] == 'Completed') ? 'selected' : '' ?>>
                        Completed
                      </option>

                    </select>

                  </div>

                  <div class="col-md-6 mb-3">

                    <label>Program Till</label>

                    <input type="date"
                      name="prog_till"
                      class="form-control"
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
              <div class="tab-pane fade" id="family">

                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label>Father Name</label>

                    <input type="text"
                      name="father_name"
                      class="form-control"
                      value="<?= esc($student['Fathers_Name']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Father Contact</label>

                    <input type="text"
                      name="father_contact"
                      class="form-control"
                      value="<?= esc($student['Father_Contact_Number']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Father Email</label>

                    <input type="email"
                      name="father_email"
                      class="form-control"
                      value="<?= esc($student['Father_Email_ID']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Father Occupation</label>

                    <input type="text"
                      name="father_occupation"
                      class="form-control"
                      value="<?= esc($student['Father_Occupation']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Mother Name</label>

                    <input type="text"
                      name="mother_name"
                      class="form-control"
                      value="<?= esc($student['Mothers_Name']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Mother Contact</label>

                    <input type="text"
                      name="mother_contact"
                      class="form-control"
                      value="<?= esc($student['Mother_Contact_Number']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Mother Email</label>

                    <input type="email"
                      name="mother_email"
                      class="form-control"
                      value="<?= esc($student['Mother_Email_ID']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Mother Occupation</label>

                    <input type="text"
                      name="mother_occupation"
                      class="form-control"
                      value="<?= esc($student['Mother_Occupation']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Income</label>

                    <input type="text"
                      name="income"
                      class="form-control"
                      value="<?= esc($student['Family_Monthly_Income']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Siblings</label>

                    <input type="number"
                      name="siblings"
                      class="form-control"
                      value="<?= esc($student['Sibling_Number']) ?>">
                  </div>

                </div>

                <div class="d-flex justify-content-between">

                  <button type="button"
                    class="btn btn-secondary prev-tab">
                    Previous
                  </button>

                  <button type="submit"
                    class="btn btn-success">
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

  <?= view('includes/footer'); ?>
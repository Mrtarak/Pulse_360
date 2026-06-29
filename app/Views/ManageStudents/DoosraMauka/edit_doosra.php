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
              <form action="<?= base_url('ManageStudents/DoosraMauka/update/' . $student['DM_Stu_Id']) ?>" method="post">
                <!-- Tabs -->
                <ul class="nav nav-tabs" id="studentTabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">1. Personal Info</a></li>
                  <li class="nav-item"><a class="nav-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab">2. Education</a></li>
                  <li class="nav-item"><a class="nav-link" id="program-tab" data-bs-toggle="tab" href="#program" role="tab">3. Program</a></li>
                  <li class="nav-item"><a class="nav-link" id="family-tab" data-bs-toggle="tab" href="#family" role="tab">6. Family Details</a></li>
                </ul>

                <div class="tab-content mt-3">
                  <!-- Personal Info -->

                  <div class="tab-pane fade show active" id="personal">
                    <div class="row">


                      <div class="col-md-4 mb-3">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text"
                          class="form-control"
                          name="first_name"
                          value="<?= esc($student['First_Name'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text"
                          class="form-control"
                          name="last_name"
                          value="<?= esc($student['Last_Name'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Gender <span class="text-danger">*</span></label>
                        <select class="form-control" name="gender">
                          <option value="">-- Select --</option>
                          <option value="Male" <?= (($student['Gender'] ?? '') == 'Male') ? 'selected' : '' ?>>Male</option>
                          <option value="Female" <?= (($student['Gender'] ?? '') == 'Female') ? 'selected' : '' ?>>Female</option>
                          <option value="Other" <?= (($student['Gender'] ?? '') == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Date of Birth</label>
                        <input type="date"
                          class="form-control"
                          name="dob"
                          value="<?= esc($student['DOB'] ?? '') ?>"max="<?= date('Y-m-d') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Aadhar No</label>
                        <input type="text"
                          class="form-control"
                          name="aadhar_no"
                          value="<?= esc($student['Aadhar_No'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Phone No</label>
                        <input type="text"
                          class="form-control"
                          name="phone"
                          value="<?= esc($student['Phone_No'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Email</label>
                        <input type="email"
                          class="form-control"
                          name="email"
                          value="<?= esc($student['Email_Id'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>City / Village</label>
                        <input type="text"
                          class="form-control"
                          name="city"
                          value="<?= esc($student['Village_City'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>District</label>
                        <input type="text"
                          class="form-control"
                          name="district"
                          value="<?= esc($student['District'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>State</label>
                        <input type="text"
                          class="form-control"
                          name="state"
                          value="<?= esc($student['State'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Pincode</label>
                        <input type="text"
                          class="form-control"
                          name="pincode"
                          value="<?= esc($student['Pincode'] ?? '') ?>">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Nationality</label>
                        <input type="text"
                          class="form-control"
                          name="nationality"
                          value="<?= esc($student['Nationality'] ?? '') ?>">
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea class="form-control"
                          name="address"><?= esc($student['Address'] ?? '') ?></textarea>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <textarea class="form-control"
                          name="remarks"><?= esc($student['Remarks'] ?? '') ?></textarea>
                      </div>

                    </div>

                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>

                  </div>





                  <!-- Education Info -->

                  <div class="tab-pane fade" id="education" role="tabpanel">

                    ```
                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <label>Current Education Level <span class="text-danger">*</span></label>
                        <input type="text"
                          class="form-control"
                          name="current_edu"
                          value="<?= esc($student['Current_Education_level'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Highest Education Completed</label>
                        <input type="text"
                          class="form-control"
                          name="highest_edu"
                          value="<?= esc($student['Highest_Education_Completed'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Caste <span class="text-danger">*</span></label>
                        <input type="text"
                          class="form-control"
                          name="caste"
                          value="<?= esc($student['Student_Caste'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Status <span class="text-danger">*</span></label>

                        <select class="form-control" name="status">

                          <option value="">-- Select --</option>

                          <option value="Active"
                            <?= (($student['Student_Status'] ?? '') == 'Active') ? 'selected' : '' ?>>
                            Active
                          </option>

                          <option value="Inactive"
                            <?= (($student['Student_Status'] ?? '') == 'Inactive') ? 'selected' : '' ?>>
                            Inactive
                          </option>

                          <option value="Completed"
                            <?= (($student['Student_Status'] ?? '') == 'Completed') ? 'selected' : '' ?>>
                            Completed
                          </option>

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
                    ```

                  </div>




                  <!-- Program Info -->

                  <div class="tab-pane fade" id="program" role="tabpanel">

                    ```
                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <label>Enrollment Date <span class="text-danger">*</span></label>
                        <input type="date"
                          class="form-control"
                          name="enroll_date" max="<?= date('Y-m-d') ?>"
                          value="<?= esc($student['Enrollment_Date'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program</label>
                        <input type="text"
                          class="form-control"
                          value="Doosra Mauka"
                          readonly>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Center <span class="text-danger">*</span></label>

                        <select class="form-control" name="center_id">

                          <option value="">-- Select Center --</option>

                          <?php foreach ($centers as $center): ?>

                            <option value="<?= $center['Center_Id']; ?>"
                              <?= ($student['Center_Id'] == $center['Center_Id']) ? 'selected' : ''; ?>>

                              <?= esc($center['Center_Name']); ?>

                            </option>

                          <?php endforeach; ?>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Batch <span class="text-danger">*</span></label>

                        <select class="form-control" name="batch_id">

                          <option value="">-- Select Batch --</option>

                          <?php foreach ($batches as $batch): ?>

                            <option value="<?= $batch['Batch_Id']; ?>"
                              <?= ($student['Batch_Id'] == $batch['Batch_Id']) ? 'selected' : ''; ?>>

                              <?= esc($batch['Batch_Name']); ?>

                            </option>

                          <?php endforeach; ?>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Marital Status</label>

                        <select class="form-control" name="marital_status">

                          <option value="">-- Select --</option>

                          <option value="Single"
                            <?= (($student['Marital_Status'] ?? '') == 'Single') ? 'selected' : ''; ?>>
                            Single
                          </option>

                          <option value="Married"
                            <?= (($student['Marital_Status'] ?? '') == 'Married') ? 'selected' : ''; ?>>
                            Married
                          </option>

                          <option value="Divorced"
                            <?= (($student['Marital_Status'] ?? '') == 'Divorced') ? 'selected' : ''; ?>>
                            Divorced
                          </option>

                          <option value="Widowed"
                            <?= (($student['Marital_Status'] ?? '') == 'Widowed') ? 'selected' : ''; ?>>
                            Widowed
                          </option>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program Status <span class="text-danger">*</span></label>

                        <select class="form-control" name="program_status">

                          <option value="">-- Select --</option>

                          <option value="Active"
                            <?= (($student['DM_Status'] ?? '') == 'Active') ? 'selected' : ''; ?>>
                            Active
                          </option>

                          <option value="Completed"
                            <?= (($student['DM_Status'] ?? '') == 'Completed') ? 'selected' : ''; ?>>
                            Completed
                          </option>

                          <option value="Inactive"
                            <?= (($student['DM_Status'] ?? '') == 'Inactive') ? 'selected' : ''; ?>>
                            Inactive
                          </option>

                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Program Till</label>

                        <input type="date"
                          class="form-control"
                          name="prog_till"
                          value="<?= esc($student['Completion_Date'] ?? '') ?>">
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
                    ```

                  </div>





                  <!-- Family Info -->

                  <div class="tab-pane fade" id="family">

                    ```
                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <label>Father's Name</label>
                        <input type="text"
                          class="form-control"
                          name="father_name"
                          value="<?= esc($student['Fathers_Name'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Contact</label>
                        <input type="text"
                          class="form-control"
                          name="father_contact"
                          value="<?= esc($student['Father_Contact_Number'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Email</label>
                        <input type="email"
                          class="form-control"
                          name="father_email"
                          value="<?= esc($student['Father_Email_ID'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Father's Occupation</label>
                        <input type="text"
                          class="form-control"
                          name="father_occupation"
                          value="<?= esc($student['Father_Occupation'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Name</label>
                        <input type="text"
                          class="form-control"
                          name="mother_name"
                          value="<?= esc($student['Mothers_Name'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Contact</label>
                        <input type="text"
                          class="form-control"
                          name="mother_contact"
                          value="<?= esc($student['Mother_Contact_Number'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Email</label>
                        <input type="email"
                          class="form-control"
                          name="mother_email"
                          value="<?= esc($student['Mother_Email_ID'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Mother's Occupation</label>
                        <input type="text"
                          class="form-control"
                          name="mother_occupation"
                          value="<?= esc($student['Mother_Occupation'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Family Monthly Income</label>
                        <input type="text"
                          class="form-control"
                          name="income"
                          value="<?= esc($student['Family_Monthly_Income'] ?? '') ?>">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Number of Siblings</label>
                        <input type="number"
                          class="form-control"
                          name="siblings"
                          value="<?= esc($student['Sibling_Number'] ?? '') ?>">
                      </div>

                    </div>

                    <div class="d-flex justify-content-between">

                      <button type="button"
                        class="btn btn-secondary prev-tab">
                        Previous
                      </button>

                      <div>
                        <a href="<?= base_url('ManageStudents/DoosraMauka') ?>"
                          class="btn btn-light">
                          Cancel
                        </a>

                        <button type="submit"
                          class="btn btn-primary">
                          Update Student
                        </button>
                      </div>

                    </div>
                    ```

                  </div>


                </div>
              </form>
              <!-- Form End -->
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?= view('includes/footer'); ?>
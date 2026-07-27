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

              <h4 class="card-title mb-4 text-primary">
                <i class="mdi mdi-account-edit me-2"></i>
                Edit Doosra Mauka Student
              </h4>

              <form action="<?= base_url('ManageStudents/DoosraMauka/update/' . $student['DM_Stu_Id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <!-- ===================================================== -->
                <!-- TABS -->
                <!-- ===================================================== -->

                <ul class="nav nav-tabs" id="studentTabs" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link active"
                      data-bs-toggle="tab"
                      href="#personal"
                      role="tab">
                      <i class="mdi mdi-account me-1"></i>
                      1. Personal Info
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#education"
                      role="tab">
                      <i class="mdi mdi-school me-1"></i>
                      2. Education
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#program"
                      role="tab">
                      <i class="mdi mdi-book-open-page-variant me-1"></i>
                      3. Program
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#family"
                      role="tab">
                      <i class="mdi mdi-account-group me-1"></i>
                      4. Family Details
                    </a>
                  </li>

                </ul>


                <div class="tab-content mt-4">

                  <!-- ===================================================== -->
                  <!-- PERSONAL INFO -->
                  <!-- ===================================================== -->

                  <div class="tab-pane fade show active"
                    id="personal"
                    role="tabpanel">

                    <div class="row">

                      <div class="col-md-4 mb-3">
                        <label>
                          First Name
                          <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                          class="form-control"
                          name="first_name"
                          value="<?= esc($student['First_Name'] ?? '') ?>"
                          required>
                      </div>


                      <div class="col-md-4 mb-3">
                        <label>
                          Last Name
                          <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                          class="form-control"
                          name="last_name"
                          value="<?= esc($student['Last_Name'] ?? '') ?>"
                          required>
                      </div>


                      <div class="col-md-4 mb-3">
                        <label>
                          Gender
                          <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                          name="gender"
                          required>

                          <option value="">
                            -- Select Gender --
                          </option>

                          <option value="Male"
                            <?= (($student['Gender'] ?? '') == 'Male') ? 'selected' : '' ?>>
                            Male
                          </option>

                          <option value="Female"
                            <?= (($student['Gender'] ?? '') == 'Female') ? 'selected' : '' ?>>
                            Female
                          </option>

                          <option value="Other"
                            <?= (($student['Gender'] ?? '') == 'Other') ? 'selected' : '' ?>>
                            Other
                          </option>

                        </select>
                      </div>


                      <div class="col-md-4 mb-3">
                        <label>Date of Birth</label>

                        <input type="date"
                          class="form-control"
                          name="dob"
                          max="<?= date('Y-m-d') ?>"
                          value="<?= esc($student['DOB'] ?? '') ?>">
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
                        <label>Marital Status</label>

                        <select class="form-control"
                          name="marital_status">

                          <option value="">
                            -- Select --
                          </option>

                          <option value="Single"
                            <?= (($student['Marital_Status'] ?? '') == 'Single') ? 'selected' : '' ?>>
                            Single
                          </option>

                          <option value="Married"
                            <?= (($student['Marital_Status'] ?? '') == 'Married') ? 'selected' : '' ?>>
                            Married
                          </option>

                          <option value="Divorced"
                            <?= (($student['Marital_Status'] ?? '') == 'Divorced') ? 'selected' : '' ?>>
                            Divorced
                          </option>

                          <option value="Widowed"
                            <?= (($student['Marital_Status'] ?? '') == 'Widowed') ? 'selected' : '' ?>>
                            Widowed
                          </option>

                        </select>
                      </div>


                      <div class="col-md-4 mb-3">
                        <label>Village / City</label>

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

                        <textarea
                          class="form-control"
                          rows="3"
                          name="address"><?= esc($student['Address'] ?? '') ?></textarea>
                      </div>


                      <!-- Student & Aadhaar Photos -->

                      <div class="row mt-3">

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

                                <a href="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                  target="_blank">

                                  <img src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                    class="img-thumbnail shadow mb-3"
                                    style="width:200px;height:200px;object-fit:cover;border-radius:10px;"
                                    alt="Student Photo">

                                </a>

                              <?php else : ?>

                                <div class="text-muted py-4">
                                  <i class="mdi mdi-image-off mdi-48px"></i>
                                  <p class="mt-2 mb-0">
                                    No Student Photo Available
                                  </p>
                                </div>

                              <?php endif; ?>

                              <div class="mt-3 text-start">

                                <label class="form-label">
                                  <?= !empty($student['Photo_URL'])
                                    ? 'Change Student Photo'
                                    : 'Upload Student Photo' ?>
                                </label>

                                <input type="file"
                                  name="student_photo"
                                  class="form-control"
                                  accept="image/jpeg,image/png,image/jpg">

                                <small class="text-muted">
                                  JPG, JPEG or PNG only.
                                </small>

                              </div>

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

                                <a href="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                  target="_blank">

                                  <img src="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                    class="img-thumbnail shadow mb-3"
                                    style="width:200px;height:200px;object-fit:cover;border-radius:10px;"
                                    alt="Aadhaar Photo">

                                </a>

                              <?php else : ?>

                                <div class="text-muted py-4">
                                  <i class="mdi mdi-image-off mdi-48px"></i>
                                  <p class="mt-2 mb-0">
                                    No Aadhaar Photo Available
                                  </p>
                                </div>

                              <?php endif; ?>

                              <div class="mt-3 text-start">

                                <label class="form-label">
                                  <?= !empty($student['Aadhar_Photo_URL'])
                                    ? 'Change Aadhaar Photo'
                                    : 'Upload Aadhaar Photo' ?>
                                </label>

                                <input type="file"
                                  name="aadhar_photo"
                                  class="form-control"
                                  accept="image/jpeg,image/png,image/jpg">

                                <small class="text-muted">
                                  JPG, JPEG or PNG only.
                                </small>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>


                      <div class="col-md-12 mb-3">
                        <label>Remarks</label>

                        <textarea
                          class="form-control"
                          rows="2"
                          name="remarks"><?= esc($student['Remarks'] ?? '') ?></textarea>
                      </div>

                    </div>


                    <div class="d-flex justify-content-end mt-3">

                      <button type="button"
                        class="btn btn-primary next-tab">

                        Next
                        <i class="mdi mdi-arrow-right ms-1"></i>

                      </button>

                    </div>

                  </div>


                  <!-- ===================================================== -->
                  <!-- EDUCATION -->
                  <!-- ===================================================== -->

                  <div class="tab-pane fade"
                    id="education"
                    role="tabpanel">

                    <div class="row">

                      <div class="col-md-6 mb-3">

                        <label>
                          Current Education Level
                          <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                          class="form-control"
                          name="current_edu"
                          value="<?= esc($student['Current_Education_level'] ?? '') ?>"
                          required>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Highest Education Completed
                        </label>

                        <input type="text"
                          class="form-control"
                          name="highest_edu"
                          value="<?= esc($student['Highest_Education_Completed'] ?? '') ?>">

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Caste
                          <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                          class="form-control"
                          name="caste"
                          value="<?= esc($student['Student_Caste'] ?? '') ?>"
                          required>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Student Status
                          <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                          name="status"
                          required>

                          <option value="">
                            -- Select Status --
                          </option>

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


                    <div class="d-flex justify-content-between mt-3">

                      <button type="button"
                        class="btn btn-secondary prev-tab">

                        <i class="mdi mdi-arrow-left me-1"></i>
                        Previous

                      </button>


                      <button type="button"
                        class="btn btn-primary next-tab">

                        Next
                        <i class="mdi mdi-arrow-right ms-1"></i>

                      </button>

                    </div>

                  </div>


                  <!-- ===================================================== -->
                  <!-- PROGRAM -->
                  <!-- ===================================================== -->

                  <div class="tab-pane fade"
                    id="program"
                    role="tabpanel">

                    <div class="row">

                      <div class="col-md-6 mb-3">

                        <label>
                          Enrollment Date
                          <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                          class="form-control"
                          name="enroll_date"
                          max="<?= date('Y-m-d') ?>"
                          value="<?= esc($student['Enrollment_Date'] ?? '') ?>"
                          required>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>Program</label>

                        <input type="text"
                          class="form-control"
                          value="Doosra Mauka"
                          readonly>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Center
                          <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                          name="center_id"
                          required>

                          <option value="">
                            -- Select Center --
                          </option>

                          <?php foreach ($centers as $center): ?>

                            <option
                              value="<?= esc($center['Center_Id']) ?>"
                              <?= (($student['Center_Id'] ?? '') == $center['Center_Id']) ? 'selected' : '' ?>>

                              <?= esc($center['Center_Name']) ?>

                            </option>

                          <?php endforeach; ?>

                        </select>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Batch
                          <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                          name="batch_id"
                          required>

                          <option value="">
                            -- Select Batch --
                          </option>

                          <?php foreach ($batches as $batch): ?>

                            <option
                              value="<?= esc($batch['Batch_Id']) ?>"
                              <?= (($student['Batch_Id'] ?? '') == $batch['Batch_Id']) ? 'selected' : '' ?>>

                              <?= esc($batch['Batch_Name']) ?>

                            </option>

                          <?php endforeach; ?>

                        </select>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>Marital Status</label>

                        <select class="form-control"
                          name="marital_status">

                          <option value="">
                            -- Select --
                          </option>

                          <option value="Single"
                            <?= (($student['Marital_Status'] ?? '') == 'Single') ? 'selected' : '' ?>>
                            Single
                          </option>

                          <option value="Married"
                            <?= (($student['Marital_Status'] ?? '') == 'Married') ? 'selected' : '' ?>>
                            Married
                          </option>

                          <option value="Divorced"
                            <?= (($student['Marital_Status'] ?? '') == 'Divorced') ? 'selected' : '' ?>>
                            Divorced
                          </option>

                          <option value="Widowed"
                            <?= (($student['Marital_Status'] ?? '') == 'Widowed') ? 'selected' : '' ?>>
                            Widowed
                          </option>

                        </select>

                      </div>


                      <div class="col-md-6 mb-3">

                        <label>
                          Program Status
                          <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                          name="program_status"
                          required>

                          <option value="">
                            -- Select Status --
                          </option>

                          <option value="Active"
                            <?= (($student['DM_Status'] ?? '') == 'Active') ? 'selected' : '' ?>>
                            Active
                          </option>

                          <option value="Completed"
                            <?= (($student['DM_Status'] ?? '') == 'Completed') ? 'selected' : '' ?>>
                            Completed
                          </option>

                          <option value="Inactive"
                            <?= (($student['DM_Status'] ?? '') == 'Inactive') ? 'selected' : '' ?>>
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


                    <div class="d-flex justify-content-between mt-3">

                      <button type="button"
                        class="btn btn-secondary prev-tab">

                        <i class="mdi mdi-arrow-left me-1"></i>
                        Previous

                      </button>


                      <button type="button"
                        class="btn btn-primary next-tab">

                        Next
                        <i class="mdi mdi-arrow-right ms-1"></i>

                      </button>

                    </div>

                  </div>


                  <!-- ===================================================== -->
                  <!-- FAMILY -->
                  <!-- ===================================================== -->

                  <div class="tab-pane fade"
                    id="family"
                    role="tabpanel">

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

                        <input type="number"
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


                    <!-- FINAL BUTTONS -->

                    <div class="d-flex justify-content-between mt-4">

                      <button type="button"
                        class="btn btn-secondary prev-tab">

                        <i class="mdi mdi-arrow-left me-1"></i>
                        Previous

                      </button>


                      <div>

                        <a href="<?= base_url('ManageStudents/DoosraMauka') ?>"
                          class="btn btn-light me-2">

                          <i class="mdi mdi-close me-1"></i>
                          Cancel

                        </a>


                        <button type="submit"
                          class="btn btn-primary">

                          <i class="mdi mdi-content-save me-1"></i>
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



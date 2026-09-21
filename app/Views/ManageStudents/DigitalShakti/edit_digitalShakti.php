<?= view('includes/header'); ?>
<?= view('includes/navbar'); ?>

<div class="container-fluid page-body-wrapper">

  <?= view('includes/sidebar'); ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-body">

          <?= view('includes/breadcrumb'); ?>

          <h4 class="card-title">
            <i class="mdi mdi-laptop menu-icon"></i>
            Edit Digital Shakti Student
          </h4>

          <form action="<?= site_url('digitalshakti/update/' . $student['DS_Stu_Id']) ?>"
            method="post"
            enctype="multipart/form-data">

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

              <!-- ===================================================== -->
              <!-- PERSONAL INFO -->
              <!-- ===================================================== -->

              <div class="tab-pane fade show active" id="personal">

                <div class="row">

                  <!-- First Name -->
                  <div class="col-md-4 mb-3">
                    <label>
                      First Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="first_name"
                      class="form-control"
                      value="<?= esc($student['First_Name']) ?>"
                      required>
                  </div>

                  <!-- Last Name -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Last Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="last_name"
                      class="form-control"
                      value="<?= esc($student['Last_Name']) ?>"
                      required>
                  </div>

                  <!-- Gender -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Gender <span class="text-danger">*</span>
                    </label>

                    <select name="gender"
                      class="form-control"
                      required>

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

                  <!-- DOB -->
                  <div class="col-md-4 mb-3">
                    <label>
                      DOB <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                      name="dob"
                      class="form-control"
                      value="<?= esc($student['DOB']) ?>"
                      max="<?= date('Y-m-d') ?>"
                      required>
                  </div>

                  <!-- Aadhar -->
                  <div class="col-md-4 mb-3">
                    <label>Aadhar No</label>

                    <input type="text"
                      name="aadhar_no"
                      class="form-control"
                      value="<?= esc($student['Aadhar_No']) ?>">
                  </div>

                  <!-- Phone -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Phone <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="phone"
                      class="form-control"
                      value="<?= esc($student['Phone_No']) ?>"
                      required>
                  </div>

                  <!-- Email -->
                  <div class="col-md-4 mb-3">
                    <label>Email</label>

                    <input type="email"
                      name="email"
                      class="form-control"
                      value="<?= esc($student['Email_Id']) ?>">
                  </div>

                  <!-- Marital Status -->
                  <div class="col-md-4 mb-3">
                    <label>Marital Status</label>

                    <select name="marital_status"
                      class="form-control">

                      <option value="">Select Marital Status</option>

                      <option value="Single"
                        <?= ($student['Marital_Status'] ?? '') == 'Single' ? 'selected' : '' ?>>
                        Single
                      </option>

                      <option value="Married"
                        <?= ($student['Marital_Status'] ?? '') == 'Married' ? 'selected' : '' ?>>
                        Married
                      </option>

                      <option value="Widow"
                        <?= ($student['Marital_Status'] ?? '') == 'Widow' ? 'selected' : '' ?>>
                        Widow
                      </option>

                    </select>
                  </div>

                  <!-- Caste -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Caste <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="caste"
                      class="form-control"
                      value="<?= esc($student['Student_Caste']) ?>"
                      required>
                  </div>

                  <!-- City -->
                  <div class="col-md-4 mb-3">
                    <label>
                      City <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="city"
                      class="form-control"
                      value="<?= esc($student['Village_City']) ?>"
                      required>
                  </div>

                  <!-- District -->
                  <div class="col-md-4 mb-3">
                    <label>
                      District <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="district"
                      class="form-control"
                      value="<?= esc($student['District']) ?>"
                      required>
                  </div>

                  <!-- State -->
                  <div class="col-md-4 mb-3">
                    <label>
                      State <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="state"
                      class="form-control"
                      value="<?= esc($student['State']) ?>"
                      required>
                  </div>

                  <!-- Pincode -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Pincode <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="pincode"
                      class="form-control"
                      value="<?= esc($student['Pincode']) ?>"
                      required>
                  </div>

                  <!-- Nationality -->
                  <div class="col-md-4 mb-3">
                    <label>
                      Nationality <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="nationality"
                      class="form-control"
                      value="<?= esc($student['Nationality']) ?>"
                      required>
                  </div>

                  <!-- Address -->
                  <div class="col-md-12 mb-3">
                    <label>
                      Address <span class="text-danger">*</span>
                    </label>

                    <textarea name="address"
                      class="form-control"
                      rows="3"
                      required><?= esc($student['Address']) ?></textarea>
                  </div>

                  <!-- Remarks -->
                  <div class="col-md-12 mb-3">
                    <label>Remarks</label>

                    <textarea name="remarks"
                      class="form-control"
                      rows="3"><?= esc($student['Remarks'] ?? '') ?></textarea>
                  </div>

                  <!-- Documents Heading -->
                  <div class="col-12">
                    <hr>

                    <h5 class="mb-4">
                      <i class="mdi mdi-image"></i>
                      Student Documents
                    </h5>
                  </div>

                  <div class="row mb-4">

                    <!-- Student Photo -->
                    <div class="col-md-6">

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
                                style="width:250px;height:250px;object-fit:cover;border-radius:10px;">

                            </a>

                          <?php else : ?>

                            <div class="text-muted py-5">

                              <i class="mdi mdi-image-off mdi-48px"></i>

                              <p class="mb-0 mt-2">
                                No Student Photo Available
                              </p>

                            </div>

                          <?php endif; ?>

                          <input type="file"
                            name="student_photo"
                            class="form-control mt-3"
                            accept="image/*">

                          <small class="text-muted">
                            Leave blank to keep existing photo.
                          </small>

                        </div>

                      </div>

                    </div>

                    <!-- Aadhaar Photo -->
                    <div class="col-md-6">

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
                                style="width:250px;height:250px;object-fit:cover;border-radius:10px;">

                            </a>

                          <?php else : ?>

                            <div class="text-muted py-5">

                              <i class="mdi mdi-image-off mdi-48px"></i>

                              <p class="mb-0 mt-2">
                                No Aadhaar Photo Available
                              </p>

                            </div>

                          <?php endif; ?>

                          <input type="file"
                            name="aadhar_photo"
                            class="form-control mt-3"
                            accept="image/*">

                          <small class="text-muted">
                            Leave blank to keep existing Aadhaar photo.
                          </small>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="d-flex justify-content-end">

                  <button type="button"
                    class="btn btn-primary next-tab">
                    Next
                  </button>

                </div>

              </div>


              <!-- ===================================================== -->
              <!-- EDUCATION -->
              <!-- ===================================================== -->

              <div class="tab-pane fade" id="education">

                <div class="row">

                  <!-- Current Education -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Current Education <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="current_edu"
                      class="form-control"
                      value="<?= esc($student['Current_Education_level']) ?>"
                      required>

                  </div>

                  <!-- Highest Education -->
                  <div class="col-md-6 mb-3">

                    <label>Highest Education</label>

                    <input type="text"
                      name="highest_edu"
                      class="form-control"
                      value="<?= esc($student['Highest_Education_Completed']) ?>">

                  </div>

                  <!-- Status -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Status <span class="text-danger">*</span>
                    </label>

                    <select name="status"
                      class="form-control"
                      required>

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


              <!-- ===================================================== -->
              <!-- PROGRAM -->
              <!-- ===================================================== -->

              <div class="tab-pane fade" id="program">

                <div class="row">

                  <!-- Enrollment Date -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Enrollment Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                      name="enroll_date"
                      class="form-control"
                      max="<?= date('Y-m-d') ?>"
                      value="<?= esc($student['Enrollment_Date']) ?>"
                      required>

                  </div>

                  <!-- Program -->
                  <div class="col-md-6 mb-3">

                    <label>Program</label>

                    <input type="text"
                      class="form-control"
                      value="Digital Shakti"
                      readonly>

                  </div>

                  <!-- Center -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Center <span class="text-danger">*</span>
                    </label>

                    <select name="center_id"
                      class="form-control"
                      required>

                      <?php foreach ($centers as $center): ?>

                        <option value="<?= $center['Center_Id'] ?>"
                          <?= ($student['Center_Id'] == $center['Center_Id']) ? 'selected' : '' ?>>

                          <?= esc($center['Center_Name']) ?>

                        </option>

                      <?php endforeach; ?>

                    </select>

                  </div>

                  <!-- Batch -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Batch <span class="text-danger">*</span>
                    </label>

                    <select name="batch_id"
                      class="form-control"
                      required>

                      <?php foreach ($batches as $batch): ?>

                        <option value="<?= $batch['Batch_Id'] ?>"
                          <?= ($student['Batch_Id'] == $batch['Batch_Id']) ? 'selected' : '' ?>>

                          <?= esc($batch['Batch_Name']) ?>

                        </option>

                      <?php endforeach; ?>

                    </select>

                  </div>

                  <!-- Program Level -->
                  <div class="col-md-6 mb-3">

                    <label>Program Level</label>

                    <input type="text"
                      name="program_level"
                      class="form-control"
                      value="<?= esc($student['Skill_level']) ?>">

                  </div>

                  <!-- Program Status -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Program Status <span class="text-danger">*</span>
                    </label>

                    <select name="program_status"
                      class="form-control"
                      required>

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

                  <!-- Program Till -->
                  <div class="col-md-6 mb-3">

                    <label>Program Till</label>

                    <input type="date"
                      name="prog_till"
                      class="form-control"
                      value="<?= esc($student['Completion_Date'] ?? '') ?>">

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


              <!-- ===================================================== -->
              <!-- FAMILY -->
              <!-- ===================================================== -->

              <div class="tab-pane fade" id="family">

                <div class="row">

                  <!-- Guardian Name -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Guardian Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="father_name"
                      class="form-control"
                      value="<?= esc($student['Fathers_Name']) ?>"
                      required>

                  </div>

                  <!-- Guardian Relation -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Guardian Relation <span class="text-danger">*</span>
                    </label>

                    <select name="guardian_relation"
                      class="form-control"
                      required>

                      <option value="">Select Relation</option>

                      <?php
                      $guardianRelation = $student['Guardian_Relation'] ?? '';
                      ?>

                      <option value="Father"
                        <?= ($guardianRelation == 'Father') ? 'selected' : '' ?>>
                        Father
                      </option>

                      <option value="Mother"
                        <?= ($guardianRelation == 'Mother') ? 'selected' : '' ?>>
                        Mother
                      </option>

                      <option value="Guardian"
                        <?= ($guardianRelation == 'Guardian') ? 'selected' : '' ?>>
                        Guardian
                      </option>

                      <option value="Uncle"
                        <?= ($guardianRelation == 'Uncle') ? 'selected' : '' ?>>
                        Uncle
                      </option>

                      <option value="Aunt"
                        <?= ($guardianRelation == 'Aunt') ? 'selected' : '' ?>>
                        Aunt
                      </option>

                      <option value="Grandfather"
                        <?= ($guardianRelation == 'Grandfather') ? 'selected' : '' ?>>
                        Grandfather
                      </option>

                      <option value="Grandmother"
                        <?= ($guardianRelation == 'Grandmother') ? 'selected' : '' ?>>
                        Grandmother
                      </option>

                      <option value="Sibling"
                        <?= ($guardianRelation == 'Sibling') ? 'selected' : '' ?>>
                        Sibling
                      </option>

                      <option value="Other"
                        <?= ($guardianRelation == 'Other') ? 'selected' : '' ?>>
                        Other
                      </option>

                    </select>

                  </div>

                  <!-- Guardian Contact -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Guardian Contact <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="father_contact"
                      class="form-control"
                      value="<?= esc($student['Father_Contact_Number']) ?>"
                      required>

                  </div>

                  <!-- Guardian Email -->
                  <div class="col-md-6 mb-3">

                    <label>Guardian Email</label>

                    <input type="email"
                      name="father_email"
                      class="form-control"
                      value="<?= esc($student['Father_Email_ID']) ?>">

                  </div>

                  <!-- Guardian Occupation -->
                  <div class="col-md-6 mb-3">

                    <label>Guardian Occupation</label>

                    <input type="text"
                      name="father_occupation"
                      class="form-control"
                      value="<?= esc($student['Father_Occupation']) ?>">

                  </div>

                  <div class="w-100"></div>

                  <!-- Mother Name -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Mother Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                      name="mother_name"
                      class="form-control"
                      value="<?= esc($student['Mothers_Name']) ?>"
                      required>

                  </div>

                  <!-- Mother Contact -->
                  <div class="col-md-6 mb-3">

                    <label>Mother Contact</label>

                    <input type="text"
                      name="mother_contact"
                      class="form-control"
                      value="<?= esc($student['Mother_Contact_Number']) ?>">

                  </div>

                  <!-- Mother Email -->
                  <div class="col-md-6 mb-3">

                    <label>Mother Email</label>

                    <input type="email"
                      name="mother_email"
                      class="form-control"
                      value="<?= esc($student['Mother_Email_ID']) ?>">

                  </div>

                  <!-- Mother Occupation -->
                  <div class="col-md-6 mb-3">

                    <label>Mother Occupation</label>

                    <input type="text"
                      name="mother_occupation"
                      class="form-control"
                      value="<?= esc($student['Mother_Occupation']) ?>">

                  </div>

                  <!-- Income -->
                  <div class="col-md-6 mb-3">

                    <label>
                      Family Monthly Income <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                      name="income"
                      class="form-control"
                      min="0"
                      step="1"
                      value="<?= esc($student['Family_Monthly_Income']) ?>"
                      required>

                  </div>

                  <!-- Siblings -->
                  <div class="col-md-6 mb-3">

                    <label>Number of Siblings</label>

                    <input type="number"
                      name="siblings"
                      class="form-control"
                      min="0"
                      step="1"
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

<?= view('includes/footer'); ?>


<script>
  document.addEventListener('DOMContentLoaded', function() {

    const tabs = [
      '#personal',
      '#education',
      '#program',
      '#family'
    ];

    document.querySelectorAll('.next-tab').forEach(function(button) {

      button.addEventListener('click', function() {

        const currentTab =
          this.closest('.tab-pane').id;

        const currentIndex =
          tabs.indexOf('#' + currentTab);

        if (currentIndex < tabs.length - 1) {

          const nextTab =
            document.querySelector(
              '[href="' + tabs[currentIndex + 1] + '"]'
            );

          if (nextTab) {
            new bootstrap.Tab(nextTab).show();
          }

        }

      });

    });


    document.querySelectorAll('.prev-tab').forEach(function(button) {

      button.addEventListener('click', function() {

        const currentTab =
          this.closest('.tab-pane').id;

        const currentIndex =
          tabs.indexOf('#' + currentTab);

        if (currentIndex > 0) {

          const previousTab =
            document.querySelector(
              '[href="' + tabs[currentIndex - 1] + '"]'
            );

          if (previousTab) {
            new bootstrap.Tab(previousTab).show();
          }

        }

      });

    });

  });
</script>
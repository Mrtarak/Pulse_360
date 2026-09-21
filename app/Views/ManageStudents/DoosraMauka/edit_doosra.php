<?= view('includes/header'); ?>

<div class="container-scroller">

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

                <h4 class="card-title mb-3 text-primary">
                  <i class="mdi mdi-account-convert-outline menu-icon"></i>
                  Edit Doosra Mauka Student
                </h4>


                <form
                  action="<?= base_url('ManageStudents/DoosraMauka/update/' . $student['DM_Stu_Id']) ?>"
                  method="post"
                  enctype="multipart/form-data">


                  <!-- ===================================================== -->
                  <!-- TABS -->
                  <!-- ===================================================== -->

                  <ul class="nav nav-tabs" id="studentTabs" role="tablist">

                    <!-- PERSONAL -->

                    <li class="nav-item">

                      <a
                        class="nav-link active"
                        data-bs-toggle="tab"
                        data-bs-target="#personal"
                        href="#personal">

                        1. Personal Info

                      </a>

                    </li>


                    <!-- EDUCATION -->

                    <li class="nav-item">

                      <a
                        class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#education"
                        href="#education">

                        2. Education

                      </a>

                    </li>


                    <!-- PROGRAM -->

                    <li class="nav-item">

                      <a
                        class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#program"
                        href="#program">

                        3. Program

                      </a>

                    </li>


                    <!-- FAMILY -->

                    <li class="nav-item">

                      <a
                        class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#family"
                        href="#family">

                        4. Family Details

                      </a>

                    </li>

                  </ul>


                  <div class="tab-content mt-3">


                    <!-- ===================================================== -->
                    <!-- PERSONAL TAB -->
                    <!-- ===================================================== -->

                    <div
                      class="tab-pane fade show active"
                      id="personal">

                      <div class="row">


                        <!-- FIRST NAME -->

                        <div class="col-md-4 mb-3">

                          <label>
                            First Name *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="first_name"
                            value="<?= esc($student['First_Name'] ?? '') ?>"
                            required>

                        </div>


                        <!-- LAST NAME -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Last Name *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="last_name"
                            value="<?= esc($student['Last_Name'] ?? '') ?>"
                            required>

                        </div>


                        <!-- GENDER -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Gender *
                          </label>

                          <select
                            class="form-control"
                            name="gender"
                            required>

                            <option value="">
                              Select
                            </option>

                            <option
                              value="Male"
                              <?= (($student['Gender'] ?? '') == 'Male') ? 'selected' : '' ?>>

                              Male

                            </option>

                            <option
                              value="Female"
                              <?= (($student['Gender'] ?? '') == 'Female') ? 'selected' : '' ?>>

                              Female

                            </option>

                            <option
                              value="Other"
                              <?= (($student['Gender'] ?? '') == 'Other') ? 'selected' : '' ?>>

                              Other

                            </option>

                          </select>

                        </div>


                        <!-- DOB -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Date Of Birth *
                          </label>

                          <input
                            type="date"
                            class="form-control"
                            name="dob"
                            max="<?= date('Y-m-d') ?>"
                            value="<?= esc($student['DOB'] ?? '') ?>"
                            required>

                        </div>


                        <!-- AADHAR -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Aadhar No
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="aadhar_no"
                            value="<?= esc($student['Aadhar_No'] ?? '') ?>">

                        </div>


                        <!-- PHONE -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Phone *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="phone"
                            value="<?= esc($student['Phone_No'] ?? '') ?>"
                            required>

                        </div>


                        <!-- EMAIL -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Email
                          </label>

                          <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="<?= esc($student['Email_Id'] ?? '') ?>">

                        </div>


                        <!-- MARITAL STATUS -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Marital Status
                          </label>

                          <select
                            class="form-control"
                            name="marital_status">

                            <option value="">
                              Select
                            </option>

                            <option
                              value="Single"
                              <?= (($student['Marital_Status'] ?? '') == 'Single') ? 'selected' : '' ?>>

                              Single

                            </option>

                            <option
                              value="Married"
                              <?= (($student['Marital_Status'] ?? '') == 'Married') ? 'selected' : '' ?>>

                              Married

                            </option>

                            <option
                              value="Widow"
                              <?= (($student['Marital_Status'] ?? '') == 'Widow') ? 'selected' : '' ?>>

                              Widow

                            </option>

                          </select>

                        </div>


                        <!-- CASTE -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Caste *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="caste"
                            value="<?= esc($student['Student_Caste'] ?? '') ?>"
                            required>

                        </div>


                        <!-- VILLAGE / CITY -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Village / City *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="city"
                            value="<?= esc($student['Village_City'] ?? '') ?>"
                            required>

                        </div>


                        <!-- DISTRICT -->

                        <div class="col-md-4 mb-3">

                          <label>
                            District *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="district"
                            value="<?= esc($student['District'] ?? '') ?>"
                            required>

                        </div>


                        <!-- STATE -->

                        <div class="col-md-4 mb-3">

                          <label>
                            State *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="state"
                            value="<?= esc($student['State'] ?? '') ?>"
                            required>

                        </div>


                        <!-- PINCODE -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Pincode *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="pincode"
                            value="<?= esc($student['Pincode'] ?? '') ?>"
                            required>

                        </div>


                        <!-- NATIONALITY -->

                        <div class="col-md-4 mb-3">

                          <label>
                            Nationality *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="nationality"
                            value="<?= esc($student['Nationality'] ?? 'Indian') ?>"
                            required>

                        </div>


                        <!-- ADDRESS -->

                        <div class="col-md-12 mb-3">

                          <label>
                            Address *
                          </label>

                          <textarea
                            class="form-control"
                            rows="3"
                            name="address"
                            required><?= esc($student['Address'] ?? '') ?></textarea>

                        </div>


                        <!-- ================================================= -->
                        <!-- STUDENT PHOTO -->
                        <!-- ================================================= -->

                        <div class="col-md-6 mb-3">

                          <div class="card shadow-sm border-0">

                            <div class="card-header bg-primary text-white text-center">

                              <h5 class="mb-0">

                                <i class="mdi mdi-account-circle"></i>
                                Student Photo

                              </h5>

                            </div>


                            <div class="card-body text-center">


                              <?php if (!empty($student['Photo_URL'])) : ?>

                                <a
                                  href="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
                                  target="_blank">

                                  <img
                                    src="<?= base_url('uploads/students/photos/' . $student['Photo_URL']) ?>"
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


                                <input
                                  type="file"
                                  name="student_photo"
                                  class="form-control"
                                  accept="image/jpeg,image/png,image/jpg">


                                <small class="text-muted">

                                  Maximum file size:
                                  <strong>2 MB</strong>.
                                  Allowed formats:
                                  <strong>JPG, JPEG, PNG</strong>.

                                </small>

                              </div>

                            </div>

                          </div>

                        </div>


                        <!-- ================================================= -->
                        <!-- AADHAAR PHOTO -->
                        <!-- ================================================= -->

                        <div class="col-md-6 mb-3">

                          <div class="card shadow-sm border-0">

                            <div class="card-header bg-success text-white text-center">

                              <h5 class="mb-0">

                                <i class="mdi mdi-card-account-details"></i>
                                Aadhaar Photo

                              </h5>

                            </div>


                            <div class="card-body text-center">


                              <?php if (!empty($student['Aadhar_Photo_URL'])) : ?>

                                <a
                                  href="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
                                  target="_blank">

                                  <img
                                    src="<?= base_url('uploads/students/aadhar/' . $student['Aadhar_Photo_URL']) ?>"
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


                                <input
                                  type="file"
                                  name="aadhar_photo"
                                  class="form-control"
                                  accept="image/jpeg,image/png,image/jpg">


                                <small class="text-muted">

                                  Maximum file size:
                                  <strong>2 MB</strong>.
                                  Allowed formats:
                                  <strong>JPG, JPEG, PNG</strong>.

                                </small>

                              </div>

                            </div>

                          </div>

                        </div>


                        <!-- REMARKS -->

                        <div class="col-md-12 mb-3">

                          <label>
                            Remarks
                          </label>

                          <textarea
                            class="form-control"
                            rows="2"
                            name="remarks"><?= esc($student['Remarks'] ?? '') ?></textarea>

                        </div>

                      </div>


                      <!-- PERSONAL NAVIGATION -->

                      <div class="d-flex justify-content-end">

                        <button
                          type="button"
                          class="btn btn-primary next-tab">

                          Next

                        </button>

                      </div>

                    </div>


                    <!-- ===================================================== -->
                    <!-- EDUCATION TAB -->
                    <!-- ===================================================== -->

                    <div
                      class="tab-pane fade"
                      id="education">

                      <div class="row">


                        <!-- CURRENT EDUCATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Current Education Level *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="current_edu"
                            value="<?= esc($student['Current_Education_level'] ?? '') ?>"
                            required>

                        </div>


                        <!-- HIGHEST EDUCATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Highest Education Completed
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="highest_edu"
                            value="<?= esc($student['Highest_Education_Completed'] ?? '') ?>">

                        </div>


                        <!-- STUDENT STATUS -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Student Status *
                          </label>

                          <select
                            class="form-control"
                            name="status"
                            required>

                            <option value="">
                              Select
                            </option>

                            <option
                              value="Active"
                              <?= (($student['Student_Status'] ?? '') == 'Active') ? 'selected' : '' ?>>

                              Active

                            </option>

                            <option
                              value="Inactive"
                              <?= (($student['Student_Status'] ?? '') == 'Inactive') ? 'selected' : '' ?>>

                              Inactive

                            </option>

                          </select>

                        </div>

                      </div>


                      <!-- EDUCATION NAVIGATION -->

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


                    <!-- ===================================================== -->
                    <!-- PROGRAM TAB -->
                    <!-- ===================================================== -->

                    <div
                      class="tab-pane fade"
                      id="program">

                      <div class="row">


                        <!-- ENROLLMENT DATE -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Enrollment Date *
                          </label>

                          <input
                            type="date"
                            class="form-control"
                            name="enroll_date"
                            max="<?= date('Y-m-d') ?>"
                            value="<?= esc($student['Enrollment_Date'] ?? '') ?>"
                            required>

                        </div>


                        <!-- PROGRAM -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Program
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            value="Doosra Mauka"
                            readonly>

                        </div>


                        <!-- CENTER -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Center *
                          </label>

                          <select
                            class="form-control"
                            name="center_id"
                            required>

                            <option value="">
                              Select Center
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


                        <!-- BATCH -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Batch *
                          </label>

                          <select
                            class="form-control"
                            name="batch_id"
                            required>

                            <option value="">
                              -- Select Batch --
                            </option>

                            <?php if (!empty($batches)): ?>

                              <?php foreach ($batches as $batch): ?>

                                <option
                                  value="<?= esc($batch['Batch_Id']) ?>"
                                  <?= (($student['Batch_Id'] ?? '') == $batch['Batch_Id']) ? 'selected' : '' ?>>

                                  <?= esc($batch['Batch_Name']) ?>

                                </option>

                              <?php endforeach; ?>

                            <?php else: ?>

                              <option value="">
                                No Batch Available
                              </option>

                            <?php endif; ?>

                          </select>

                        </div>


                        <!-- PROGRAM STATUS -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Program Status *
                          </label>

                          <select
                            class="form-control"
                            name="program_status"
                            required>

                            <option value="">
                              Select
                            </option>

                            <option
                              value="Active"
                              <?= (($student['DM_Status'] ?? '') == 'Active') ? 'selected' : '' ?>>

                              Active

                            </option>

                            <option
                              value="Completed"
                              <?= (($student['DM_Status'] ?? '') == 'Completed') ? 'selected' : '' ?>>

                              Completed

                            </option>

                          </select>

                        </div>


                        <!-- COMPLETION DATE -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Completion Date
                          </label>

                          <input
                            type="date"
                            class="form-control"
                            name="prog_till"
                            value="<?= esc($student['Completion_Date'] ?? '') ?>">

                        </div>

                      </div>


                      <!-- PROGRAM NAVIGATION -->

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


                    <!-- ===================================================== -->
                    <!-- FAMILY TAB -->
                    <!-- ===================================================== -->

                    <div
                      class="tab-pane fade"
                      id="family">

                      <div class="row">


                        <!-- GUARDIAN NAME -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Name *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="father_name"
                            value="<?= esc($student['Fathers_Name'] ?? '') ?>"
                            required>

                        </div>


                        <!-- GUARDIAN RELATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Relation *
                          </label>

                          <select
                            class="form-control"
                            name="guardian_relation"
                            required>

                            <option value="">
                              Select Relation
                            </option>

                            <option
                              value="Father"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Father') ? 'selected' : '' ?>>

                              Father

                            </option>

                            <option
                              value="Mother"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Mother') ? 'selected' : '' ?>>

                              Mother

                            </option>

                            <option
                              value="Guardian"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Guardian') ? 'selected' : '' ?>>

                              Guardian

                            </option>

                            <option
                              value="Uncle"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Uncle') ? 'selected' : '' ?>>

                              Uncle

                            </option>

                            <option
                              value="Aunt"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Aunt') ? 'selected' : '' ?>>

                              Aunt

                            </option>

                            <option
                              value="Grandfather"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Grandfather') ? 'selected' : '' ?>>

                              Grandfather

                            </option>

                            <option
                              value="Grandmother"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Grandmother') ? 'selected' : '' ?>>

                              Grandmother

                            </option>

                            <option
                              value="Sibling"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Sibling') ? 'selected' : '' ?>>

                              Sibling

                            </option>

                            <option
                              value="Other"
                              <?= (($student['Guardian_Relation'] ?? '') == 'Other') ? 'selected' : '' ?>>

                              Other

                            </option>

                          </select>

                        </div>


                        <!-- GUARDIAN CONTACT -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Contact *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="father_contact"
                            value="<?= esc($student['Father_Contact_Number'] ?? '') ?>"
                            required>

                        </div>


                        <!-- GUARDIAN EMAIL -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Email
                          </label>

                          <input
                            type="email"
                            class="form-control"
                            name="father_email"
                            value="<?= esc($student['Father_Email_ID'] ?? '') ?>">

                        </div>


                        <!-- GUARDIAN OCCUPATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Occupation
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="father_occupation"
                            value="<?= esc($student['Father_Occupation'] ?? '') ?>">

                        </div>


                        <div class="w-100"></div>


                        <!-- MOTHER NAME -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Name *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="mother_name"
                            value="<?= esc($student['Mothers_Name'] ?? '') ?>"
                            required>

                        </div>


                        <!-- MOTHER CONTACT -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Contact
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="mother_contact"
                            value="<?= esc($student['Mother_Contact_Number'] ?? '') ?>">

                        </div>


                        <!-- MOTHER EMAIL -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Email
                          </label>

                          <input
                            type="email"
                            class="form-control"
                            name="mother_email"
                            value="<?= esc($student['Mother_Email_ID'] ?? '') ?>">

                        </div>


                        <!-- MOTHER OCCUPATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Occupation
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="mother_occupation"
                            value="<?= esc($student['Mother_Occupation'] ?? '') ?>">

                        </div>


                        <!-- FAMILY INCOME -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Family Monthly Income *
                          </label>

                          <input
                            type="number"
                            class="form-control"
                            name="income"
                            value="<?= esc($student['Family_Monthly_Income'] ?? '') ?>"
                            required>

                        </div>


                        <!-- SIBLINGS -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Number Of Siblings
                          </label>

                          <input
                            type="number"
                            class="form-control"
                            name="siblings"
                            value="<?= esc($student['Sibling_Number'] ?? '') ?>">

                        </div>

                      </div>


                      <!-- FAMILY NAVIGATION -->

                      <div class="d-flex justify-content-between">

                        <button
                          type="button"
                          class="btn btn-secondary prev-tab">

                          Previous

                        </button>


                        <div>

                          <a
                            href="<?= base_url('ManageStudents/DoosraMauka'); ?>"
                            class="btn btn-light">

                            Cancel

                          </a>


                          <button
                            type="submit"
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

</div>


<?= view('includes/footer'); ?>
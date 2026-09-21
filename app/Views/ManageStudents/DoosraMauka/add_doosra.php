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
                  Add Doosra Mauka Student
                </h4>

                <form
                  action="<?= base_url('ManageStudents/DoosraMauka/store') ?>"
                  method="post"
                  enctype="multipart/form-data">

                  <!-- TABS -->

                  <ul class="nav nav-tabs" id="studentTabs" role="tablist">

                    <!-- PERSONAL -->

                    <li class="nav-item">
                      <a class="nav-link active"
                        data-bs-toggle="tab"
                        data-bs-target="#personal"
                        href="#personal">
                        1. Personal Info
                      </a>
                    </li>

                    <!-- EDUCATION -->

                    <li class="nav-item">
                      <a class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#education"
                        href="#education">
                        2. Education
                      </a>
                    </li>

                    <!-- PROGRAM -->

                    <li class="nav-item">
                      <a class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#program"
                        href="#program">
                        3. Program
                      </a>
                    </li>

                    <!-- FAMILY -->

                    <li class="nav-item">
                      <a class="nav-link"
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

                    <div class="tab-pane fade show active"
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
                            Date Of Birth *
                          </label>

                          <input
                            type="date"
                            class="form-control"
                            name="dob"
                            max="<?= date('Y-m-d') ?>"
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
                            name="aadhar_no">

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
                            name="email">

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


                        <!-- CASTE -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Caste *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="caste"
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
                            value="Indian"
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
                            required></textarea>

                        </div>


                        <!-- STUDENT PHOTO -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Student Photo
                          </label>

                          <input
                            type="file"
                            class="form-control"
                            name="photo"
                            accept="image/*">

                          <small class="text-muted">
                            Maximum file size:
                            <strong>2 MB</strong>.
                            Allowed formats:
                            <strong>JPG, JPEG, PNG</strong>.
                          </small>

                        </div>


                        <!-- AADHAAR PHOTO -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Aadhaar Photo
                          </label>

                          <input
                            type="file"
                            class="form-control"
                            name="aadhar_photo"
                            accept="image/*">

                          <small class="text-muted">
                            Maximum file size:
                            <strong>2 MB</strong>.
                            Allowed formats:
                            <strong>JPG, JPEG, PNG</strong>.
                          </small>

                        </div>


                        <!-- REMARKS -->

                        <div class="col-md-12 mb-3">

                          <label>
                            Remarks
                          </label>

                          <textarea
                            class="form-control"
                            rows="2"
                            name="remarks"></textarea>

                        </div>

                      </div>


                      <!-- NEXT -->

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

                    <div class="tab-pane fade"
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
                            name="highest_edu">

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

                            <option value="Active">
                              Active
                            </option>

                            <option value="Inactive">
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

                    <div class="tab-pane fade"
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
                                value="<?= $center['Center_Id']; ?>">

                                <?= esc($center['Center_Name']); ?>

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
                                  value="<?= $batch['Batch_Id']; ?>">

                                  <?= esc($batch['Batch_Name']); ?>

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

                            <option value="Active">
                              Active
                            </option>

                            <option value="Completed">
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
                            name="prog_till">

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

                    <div class="tab-pane fade"
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


                        <!-- GUARDIAN CONTACT -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Contact *
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="father_contact"
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
                            name="father_email">

                        </div>


                        <!-- GUARDIAN OCCUPATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Guardian Occupation
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="father_occupation">

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
                            name="mother_contact">

                        </div>


                        <!-- MOTHER EMAIL -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Email
                          </label>

                          <input
                            type="email"
                            class="form-control"
                            name="mother_email">

                        </div>


                        <!-- MOTHER OCCUPATION -->

                        <div class="col-md-6 mb-3">

                          <label>
                            Mother's Occupation
                          </label>

                          <input
                            type="text"
                            class="form-control"
                            name="mother_occupation">

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
                            name="siblings">

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

                            Save Student

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
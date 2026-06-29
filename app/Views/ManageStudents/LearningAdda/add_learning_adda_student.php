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

              <form
                method="post"
                action="<?= base_url('students/learning_adda/store') ?>"
                enctype="multipart/form-data">

                <ul class="nav nav-tabs" id="studentTabs">

                  <li class="nav-item">
                    <a class="nav-link active"
                      data-bs-toggle="tab"
                      href="#personal">
                      1. Personal Info
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#education">
                      2. Education
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#program">
                      3. Program
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link"
                      data-bs-toggle="tab"
                      href="#family">
                      4. Family Details
                    </a>
                  </li>

                </ul>

                <div class="tab-content mt-3">

                  <!-- ===================================== -->
                  <!-- PERSONAL TAB -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade show active"
                    id="personal">

                    <div class="row">

                      <div class="col-md-4 mb-3">
                        <label>First Name *</label>
                        <input
                          type="text"
                          name="first_name"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Last Name *</label>
                        <input
                          type="text"
                          name="last_name"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Gender *</label>
                        <select
                          name="gender"
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

                      <div class="col-md-4 mb-3">
                        <label>DOB *</label>
                        <input
                          type="date"
                          name="dob"
                          class="form-control"
                          max="<?= date('Y-m-d') ?>"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Aadhar No</label>
                        <input
                          type="text"
                          name="aadhar_no"
                          class="form-control">
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Phone *</label>
                        <input
                          type="text"
                          name="phone"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Email *</label>
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>City / Village *</label>
                        <input
                          type="text"
                          name="city"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>District *</label>
                        <input
                          type="text"
                          name="district"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>State *</label>
                        <input
                          type="text"
                          name="state"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Pincode *</label>
                        <input
                          type="text"
                          name="pincode"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label>Nationality *</label>
                        <input
                          type="text"
                          name="nationality"
                          class="form-control"
                          required>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Address *</label>
                        <textarea
                          name="address"
                          rows="3"
                          class="form-control"
                          required></textarea>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Photo</label>
                        <input
                          type="file"
                          name="photo"
                          class="form-control">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Aadhar Photo</label>
                        <input
                          type="file"
                          name="aadhar_photo"
                          class="form-control">
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <textarea
                          name="remarks"
                          rows="3"
                          class="form-control"></textarea>
                      </div>

                    </div>

                    <div class="text-end">

                      <button
                        type="button"
                        class="btn btn-primary next-tab">
                        Next
                      </button>

                    </div>

                  </div>

                  <!-- ===================================== -->
                  <!-- EDUCATION TAB -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade"
                    id="education">

                    <div class="row">

                      <div class="col-md-6 mb-3">

                        <label>
                          Current Education Level *
                        </label>

                        <input
                          type="text"
                          name="current_edu"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Highest Education Completed
                        </label>

                        <input
                          type="text"
                          name="highest_edu"
                          class="form-control">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Student Class *
                        </label>

                        <input
                          type="number"
                          name="student_class"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          School Name *
                        </label>

                        <input
                          type="text"
                          name="school_name"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          School Type *
                        </label>

                        <select
                          name="school_type"
                          class="form-control"
                          required>

                          <option value="">
                            Select
                          </option>

                          <option value="Government">
                            Government
                          </option>

                          <option value="Private">
                            Private
                          </option>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          School Medium *
                        </label>

                        <select
                          name="school_medium"
                          class="form-control"
                          required>

                          <option value="">
                            Select
                          </option>

                          <option value="English">
                            English
                          </option>

                          <option value="Hindi">
                            Hindi
                          </option>

                          <option value="Bengali">
                            Bengali
                          </option>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Caste *
                        </label>

                        <input
                          type="text"
                          name="caste"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Student Status *
                        </label>

                        <select
                          name="status"
                          class="form-control"
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
                  <!-- ===================================== -->
                  <!-- PROGRAM TAB -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade"
                    id="program">

                    <div class="row">

                      <div class="col-md-6 mb-3">

                        <label>
                          Enrollment Date *
                        </label>

                        <input
                          type="date"
                          name="enroll_date"
                          class="form-control"
                          max="<?= date('Y-m-d') ?>"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Program
                        </label>

                        <input
                          type="text"
                          class="form-control"
                          value="Learning Adda"
                          readonly>

                        <input
                          type="hidden"
                          name="Program_Id"
                          value="<?= \Config\CorePrograms::LEARNING_ADDA ?>">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Center
                        </label>

                        <select
                          name="center_id"
                          class="form-control">

                          <option value="">
                            Select Center
                          </option>

                          <?php if (!empty($centers)): ?>

                            <?php foreach ($centers as $center): ?>

                              <option value="<?= $center['Center_Id'] ?>">

                                <?= esc($center['Center_Name']) ?>

                              </option>

                            <?php endforeach; ?>

                          <?php endif; ?>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Batch
                        </label>

                        <select
                          name="batch_id"
                          class="form-control">

                          <option value="">
                            Select Batch
                          </option>

                          <?php if (!empty($batches)): ?>

                            <?php foreach ($batches as $batch): ?>

                              <option value="<?= $batch['Batch_Id'] ?>">

                                <?= esc($batch['Batch_Name']) ?>

                              </option>

                            <?php endforeach; ?>

                          <?php endif; ?>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Learning Adda Status *
                        </label>

                        <select
                          name="program_status"
                          class="form-control"
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

                          <option value="Inactive">
                            Inactive
                          </option>

                        </select>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Completion Date
                        </label>

                        <input
                          type="date"
                          name="prog_till"
                          class="form-control">

                      </div>

                    </div>

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

                  <!-- ===================================== -->
                  <!-- FAMILY TAB -->
                  <!-- ===================================== -->

                  <div class="tab-pane fade"
                    id="family">

                    <div class="row">

                      <div class="col-md-6 mb-3">

                        <label>
                          Father's Name *
                        </label>

                        <input
                          type="text"
                          name="father_name"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Father's Contact *
                        </label>

                        <input
                          type="text"
                          name="father_contact"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Father's Email
                        </label>

                        <input
                          type="email"
                          name="father_email"
                          class="form-control">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Father's Occupation
                        </label>

                        <input
                          type="text"
                          name="father_occupation"
                          class="form-control">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Mother's Name *
                        </label>

                        <input
                          type="text"
                          name="mother_name"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Mother's Contact *
                        </label>

                        <input
                          type="text"
                          name="mother_contact"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Mother's Email
                        </label>

                        <input
                          type="email"
                          name="mother_email"
                          class="form-control">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Mother's Occupation
                        </label>

                        <input
                          type="text"
                          name="mother_occupation"
                          class="form-control">

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Family Monthly Income *
                        </label>

                        <input
                          type="number"
                          name="income"
                          class="form-control"
                          required>

                      </div>

                      <div class="col-md-6 mb-3">

                        <label>
                          Number Of Siblings *
                        </label>

                        <input
                          type="number"
                          name="siblings"
                          class="form-control"
                          required>

                      </div>

                    </div>

                    <div class="d-flex justify-content-between">

                      <button
                        type="button"
                        class="btn btn-secondary prev-tab">
                        Previous
                      </button>

                      <div>

                        <a href="<?= base_url('students/learning_adda') ?>"
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

  <?= view('includes/footer'); ?>

  
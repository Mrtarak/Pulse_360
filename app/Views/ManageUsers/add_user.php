<?php $nationalities = require APPPATH . 'Config/Nationalities.php'; ?>

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

              <h4 class="card-title">Users</h4>
              <p class="card-description">Add user</p>

              <form class="forms-sample" action="<?= site_url('users/store') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <!-- Section 1: Personal Details -->
                  <h5 class="mb-3 text-primary">Personal Details</h5>
                  <div class="col-md-6 mb-3">
                    <label>First Name <span class="text-danger"><span class="text-danger"><span class="text-danger">*</span></span></span></label>
                    <input type="text" name="User_FirstName" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Last Name <span class="text-danger"><span class="text-danger">*</span></span></label>
                    <input type="text" name="User_LastName" class="form-control" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select class="form-select" name="User_Gender">
                      <option value="">Select Gender</option>
                      <option value="Male" <?= old('User_Gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                      <option value="Female" <?= old('User_Gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                      <option value="Other" <?= old('User_Gender') == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="User_DOB" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Email </label>
                    <input type="email" name="User_Login_MailID" class="form-control" required>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Phone Number </label>
                    <input type="text" name="User_Phone_No" class="form-control" value="<?= old('User_Phone_No') ?>" placeholder="Enter Phone Number">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Nationality</label>
                    <select name="User_Nationality" class="form-select" required>
                      <option value="">-- Select Nationality --</option>
                      <?php foreach ($nationalities as $nation): ?>
                        <option value="<?= esc($nation) ?>" <?= old('User_Nationality') == $nation ? 'selected' : '' ?>>
                          <?= esc($nation) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Village/City <span class="text-danger">*</span></label>
                    <input type="text" name="User_Village_City" class="form-control" value="<?= old('User_Village_City') ?>" placeholder="Enter Village/City">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>District <span class="text-danger">*</span></label>
                    <input type="text" name="User_District" class="form-control" value="<?= old('User_District') ?>" placeholder="Enter District">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>State <span class="text-danger">*</span></label>
                    <input type="text" name="User_State" class="form-control" value="<?= old('User_State') ?>" placeholder="Enter State">
                  </div>
                  <div class="col-md-6 form-group">
                    <label>PinCode <span class="text-danger">*</span></label>
                    <input type="text" name="User_Pincode" class="form-control" value="<?= old('User_Nationality	') ?>" placeholder="Enter Nationality">
                  </div>
                  <div class="col-md-12 form-group">
                    <label>Full Address <span class="text-danger">*</span></label>
                    <textarea name="User_Address"
                      class="form-control"><?= old('User_Address') ?></textarea>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Joining Date <span class="text-danger">*</span></label>
                    <input type="date" name="User_Joining_Date" class="form-control" value="<?= old('User_Joining_Date') ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Leaving Date</label>
                    <input type="date" name="User_Leaving_Date" class="form-control" value="<?= old('User_Joining_Date') ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="User_Status">
                      <option value="">Select Status</option>
                      <option value="Active" <?= old('User_Status') == 'Active' ? 'selected' : '' ?>>Active</option>
                      <option value="Inactive" <?= old('User_Status') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                      <option value="Completed" <?= old('User_Status') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <label>Program</label>
                    <select name="Program_Id" class="form-select">
                      <option value="">Select Program</option>

                      <?php foreach ($programs as $program): ?>
                        <option value="<?= $program['Program_Id'] ?>">
                          <?= esc($program['Program_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <label>Role</label>
                    <select name="Role_Id" class="form-select">
                      <option value="">Select Role</option>

                      <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['Role_Id'] ?>">
                          <?= esc($role['Role_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <!-- Section 2: Photos & Documents -->
                  <h5 class="mt-4 mb-3 text-primary">Photos & Documents</h5>
                  <div class="col-md-6 form-group">
                    <label>Aadhar Number <span class="text-danger">*</span></label>
                    <input type="text" name="User_Aadhar_No" class="form-control" value="<?= old('User_Aadhar_No') ?>" placeholder="Enter Aadhar Number">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Aadhar Photo</label>
                    <input type="file" name="User_Aadhar_Photo" class="form-control" value="<?= old('User_Aadhar_Photo') ?>" placeholder="Upload Aadhar Photo">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>User Photo</label>
                    <input type="file" name="User_Photo" class="form-control" value="<?= old('User_Photo') ?>" placeholder="Upload Your Photo">
                  </div>
                  <!-- Section 3: Login Credentials -->
                  <h5 class="mt-4 mb-3 text-primary">Login Credentials</h5>
                  <div class="col-md-6 mb-3">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="confirm_password" class="form-control" required>
                  </div>
                </div>

                <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                  <a href="<?= site_url('users') ?>" class="btn btn-light">Cancel</a>
                  <button type="submit" class="btn btn-primary me-2">Save</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

      <!-- Footer scripts -->
      <?= view('includes/footer'); ?>
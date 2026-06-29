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
              <p class="card-description">Edit User</p>

              <form class="forms-sample"
                action="<?= site_url('users/update/' . $user['User_Id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <div class="row">

                  <h5 class="mb-3 text-primary">Personal Details</h5>

                  <div class="col-md-6 mb-3">
                    <label>First Name <span class="text-danger">*</span></label>
                    <input type="text"
                      name="User_FirstName"
                      class="form-control"
                      value="<?= old('User_FirstName', $user['User_FirstName']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text"
                      name="User_LastName"
                      class="form-control"
                      value="<?= old('User_LastName', $user['User_LastName']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Gender</label>
                    <select class="form-select" name="User_Gender">
                      <option value="">Select Gender</option>

                      <option value="Male"
                        <?= old('User_Gender', $user['User_Gender']) == 'Male' ? 'selected' : '' ?>>
                        Male
                      </option>

                      <option value="Female"
                        <?= old('User_Gender', $user['User_Gender']) == 'Female' ? 'selected' : '' ?>>
                        Female
                      </option>

                      <option value="Other"
                        <?= old('User_Gender', $user['User_Gender']) == 'Other' ? 'selected' : '' ?>>
                        Other
                      </option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Date of Birth</label>
                    <input type="date"
                      name="User_DOB"
                      class="form-control"
                      value="<?= old('User_DOB', $user['User_DOB']) ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email"
                      name="User_Login_MailID"
                      class="form-control"
                      value="<?= old('User_Login_MailID', $user['User_Login_MailID']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Phone Number</label>
                    <input type="text"
                      name="User_Phone_No"
                      class="form-control"
                      value="<?= old('User_Phone_No', $user['User_Phone_No']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Nationality</label>
                    <input type="text"
                      name="User_Nationality"
                      class="form-control"
                      value="<?= old('User_Nationality', $user['User_Nationality']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Village/City</label>
                    <input type="text"
                      name="User_Village_City"
                      class="form-control"
                      value="<?= old('User_Village_City', $user['User_Village_City']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>District</label>
                    <input type="text"
                      name="User_District"
                      class="form-control"
                      value="<?= old('User_District', $user['User_District']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>State</label>
                    <input type="text"
                      name="User_State"
                      class="form-control"
                      value="<?= old('User_State', $user['User_State']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Pincode</label>
                    <input type="text"
                      name="User_Pincode"
                      class="form-control"
                      value="<?= old('User_Pincode', $user['User_Pincode']) ?>">
                  </div>

                  <div class="col-md-12 form-group">
                    <label>Full Address</label>
                    <textarea name="User_Address"
                      class="form-control"><?= old('User_Address', $user['User_Address']) ?></textarea>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Joining Date</label>
                    <input type="date"
                      name="User_Joining_Date"
                      class="form-control"
                      value="<?= old('User_Joining_Date', $user['User_Joining_Date']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Leaving Date</label>
                    <input type="date"
                      name="User_Leaving_Date"
                      class="form-control"
                      value="<?= old('User_Leaving_Date', $user['User_Leaving_Date']) ?>">
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Status</label>
                    <select class="form-select" name="User_Status">

                      <option value="Active"
                        <?= old('User_Status', $user['User_Status']) == 'Active' ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option value="Inactive"
                        <?= old('User_Status', $user['User_Status']) == 'Inactive' ? 'selected' : '' ?>>
                        Inactive
                      </option>

                      <option value="Completed"
                        <?= old('User_Status', $user['User_Status']) == 'Completed' ? 'selected' : '' ?>>
                        Completed
                      </option>

                    </select>
                  </div>
                  <!-- Role & Program -->

                  <div class="col-md-6 form-group">
                    <label>Role</label>
                    <select name="Role_Id" class="form-select">
                      <option value="">Select Role</option>

                      <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['Role_Id'] ?>"
                          <?= old('Role_Id', $user['Role_Id']) == $role['Role_Id'] ? 'selected' : '' ?>>
                          <?= esc($role['Role_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label>Program</label>
                    <select name="Program_Id" class="form-select">
                      <option value="">Select Program</option>

                      <?php foreach ($programs as $program): ?>
                        <option value="<?= $program['Program_Id'] ?>"
                          <?= old('Program_Id', $user['Program_Id']) == $program['Program_Id'] ? 'selected' : '' ?>>
                          <?= esc($program['Program_Name']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>


                  <!-- Photos & Documents -->

                  <h5 class="mt-4 mb-3 text-primary">Photos & Documents</h5>

                  <div class="col-md-6 form-group">
                    <label>Aadhar Number</label>
                    <input type="text"
                      name="User_Aadhar_No"
                      class="form-control"
                      value="<?= old('User_Aadhar_No', $user['User_Aadhar_No']) ?>">
                  </div>


                  <!-- Current User Photo -->

                  <div class="col-md-6 form-group">
                    <label>Current User Photo</label>

                    <?php if (!empty($user['User_Photo_URL'])): ?>
                      <div class="mb-2">
                        <img src="<?= base_url($user['User_Photo_URL']) ?>"
                          width="120"
                          class="img-thumbnail">
                      </div>
                    <?php else: ?>
                      <p class="text-muted">No Photo Uploaded</p>
                    <?php endif; ?>

                    <input type="file"
                      name="User_Photo"
                      class="form-control">
                  </div>


                  <!-- Current Aadhar Photo -->

                  <div class="col-md-6 form-group mt-3">
                    <label>Current Aadhar Photo</label>

                    <?php if (!empty($user['User_Aadhar_Photo_URL'])): ?>
                      <div class="mb-2">
                        <img src="<?= base_url($user['User_Aadhar_Photo_URL']) ?>"
                          width="120"
                          class="img-thumbnail">
                      </div>
                    <?php else: ?>
                      <p class="text-muted">No Aadhar Uploaded</p>
                    <?php endif; ?>

                    <input type="file"
                      name="User_Aadhar_Photo"
                      class="form-control">
                  </div>
                  <!-- Login Credentials -->

                  <h5 class="mt-4 mb-3 text-primary">Login Credentials</h5>

                  <div class="col-md-6 mb-3">
                    <label>New Password</label>
                    <input type="password"
                      name="User_Password"
                      class="form-control"
                      placeholder="Leave blank to keep existing password">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Confirm Password</label>
                    <input type="password"
                      name="Confirm_Password"
                      class="form-control"
                      placeholder="Re-enter password">
                  </div>

                  <div class="col-12 mt-4 text-center">
                    <a href="<?= site_url('users') ?>" class="btn btn-light">
                      Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                      Update User
                    </button>
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
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

              <h4 class="card-title">Roles</h4>
              <p class="card-description">Edit Role</p>

              <form
                id="roleForm"
                class="forms-sample"
                action="<?= base_url('roles/update/' . $role['Role_Id']) ?>"
                method="post">

                <div class="row">

                  <!-- Role Name -->
                  <div class="col-md-6 form-group">
                    <label>
                      Role Name <span class="text-danger">*</span>
                    </label>

                    <input
                      type="text"
                      id="role_name"
                      name="Role_Name"
                      class="form-control"
                      value="<?= old('Role_Name', $role['Role_Name']) ?>"
                      placeholder="Enter Role Name"
                      required>
                  </div>

                  <!-- Status -->
                  <div class="col-md-6 form-group">
                    <label>
                      Status <span class="text-danger">*</span>
                    </label>

                    <select
                      id="role_status"
                      class="form-select"
                      name="Role_Status"
                      required>

                      <option value="">Select Status</option>

                      <option value="Active"
                        <?= old('Role_Status', $role['Role_Status']) == 'Active' ? 'selected' : '' ?>>
                        Active
                      </option>

                      <option value="Inactive"
                        <?= old('Role_Status', $role['Role_Status']) == 'Inactive' ? 'selected' : '' ?>>
                        Inactive
                      </option>

                    </select>
                  </div>

                  <!-- Role Description -->
                  <div class="col-md-12 form-group">
                    <label>Role Description</label>

                    <textarea
                      id="role_description"
                      name="Role_Description"
                      class="form-control"
                      rows="5"
                      placeholder="Enter Role Description"><?= old('Role_Description', $role['Role_Description'] ?? '') ?></textarea>
                  </div>

                  <!-- Buttons -->
                  <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">

                    <a
                      href="<?= site_url('roles') ?>"
                      class="btn btn-light">
                      Cancel
                    </a>

                    <button
                      type="submit"
                      class="btn btn-primary me-2">
                      Update
                    </button>

                  </div>

                </div>

              </form>

            </div>
          </div>
        </div>
      </div>

      <?= view('includes/footer'); ?>
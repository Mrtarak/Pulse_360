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
                            <?= view('includes/messages'); ?>

                            <h4 class="card-title">Users</h4>
                            <p class="card-description">Edit User</p>

                            <form
                                class="forms-sample"
                                id="editUserForm"
                                action="<?= site_url('users/update/' . rawurlencode($user['User_Id'])) ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >
                                <?= csrf_field() ?>

                                <div class="row">

                                    <!-- Section 1: Personal Details -->
                                    <h5 class="mb-3 text-primary">Personal Details</h5>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_FirstName">
                                            First Name <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_FirstName"
                                            name="User_FirstName"
                                            class="form-control"
                                            value="<?= esc(old('User_FirstName', $user['User_FirstName'] ?? '')) ?>"
                                            maxlength="100"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_LastName">
                                            Last Name <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_LastName"
                                            name="User_LastName"
                                            class="form-control"
                                            value="<?= esc(old('User_LastName', $user['User_LastName'] ?? '')) ?>"
                                            maxlength="100"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Gender">Gender</label>
                                        <select
                                            class="form-select"
                                            id="User_Gender"
                                            name="User_Gender"
                                        >
                                            <option value="">Select Gender</option>

                                            <option
                                                value="Male"
                                                <?= old('User_Gender', $user['User_Gender'] ?? '') === 'Male' ? 'selected' : '' ?>
                                            >
                                                Male
                                            </option>

                                            <option
                                                value="Female"
                                                <?= old('User_Gender', $user['User_Gender'] ?? '') === 'Female' ? 'selected' : '' ?>
                                            >
                                                Female
                                            </option>

                                            <option
                                                value="Other"
                                                <?= old('User_Gender', $user['User_Gender'] ?? '') === 'Other' ? 'selected' : '' ?>
                                            >
                                                Other
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_DOB">Date of Birth</label>
                                        <input
                                            type="date"
                                            id="User_DOB"
                                            name="User_DOB"
                                            class="form-control"
                                            value="<?= esc(old('User_DOB', $user['User_DOB'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_Login_MailID">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            id="User_Login_MailID"
                                            name="User_Login_MailID"
                                            class="form-control"
                                            value="<?= esc(old('User_Login_MailID', $user['User_Login_MailID'] ?? '')) ?>"
                                            maxlength="254"
                                            autocomplete="email"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Phone_No">Phone Number</label>
                                        <input
                                            type="tel"
                                            id="User_Phone_No"
                                            name="User_Phone_No"
                                            class="form-control"
                                            value="<?= esc(old('User_Phone_No', $user['User_Phone_No'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Nationality">Nationality</label>
                                        <input
                                            type="text"
                                            id="User_Nationality"
                                            name="User_Nationality"
                                            class="form-control"
                                            value="<?= esc(old('User_Nationality', $user['User_Nationality'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Village_City">Village/City</label>
                                        <input
                                            type="text"
                                            id="User_Village_City"
                                            name="User_Village_City"
                                            class="form-control"
                                            value="<?= esc(old('User_Village_City', $user['User_Village_City'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_District">District</label>
                                        <input
                                            type="text"
                                            id="User_District"
                                            name="User_District"
                                            class="form-control"
                                            value="<?= esc(old('User_District', $user['User_District'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_State">State</label>
                                        <input
                                            type="text"
                                            id="User_State"
                                            name="User_State"
                                            class="form-control"
                                            value="<?= esc(old('User_State', $user['User_State'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Pincode">Pincode</label>
                                        <input
                                            type="text"
                                            id="User_Pincode"
                                            name="User_Pincode"
                                            class="form-control"
                                            value="<?= esc(old('User_Pincode', $user['User_Pincode'] ?? '')) ?>"
                                            maxlength="10"
                                        >
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="User_Address">Full Address</label>
                                        <textarea
                                            id="User_Address"
                                            name="User_Address"
                                            class="form-control"
                                            rows="3"
                                        ><?= esc(old('User_Address', $user['User_Address'] ?? '')) ?></textarea>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Joining_Date">Joining Date</label>
                                        <input
                                            type="date"
                                            id="User_Joining_Date"
                                            name="User_Joining_Date"
                                            class="form-control"
                                            value="<?= esc(old('User_Joining_Date', $user['User_Joining_Date'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Leaving_Date">Leaving Date</label>
                                        <input
                                            type="date"
                                            id="User_Leaving_Date"
                                            name="User_Leaving_Date"
                                            class="form-control"
                                            value="<?= esc(old('User_Leaving_Date', $user['User_Leaving_Date'] ?? '')) ?>"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Status">
                                            Status <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            class="form-select"
                                            id="User_Status"
                                            name="User_Status"
                                            required
                                        >
                                            <option
                                                value="Active"
                                                <?= old('User_Status', $user['User_Status'] ?? '') === 'Active' ? 'selected' : '' ?>
                                            >
                                                Active
                                            </option>

                                            <option
                                                value="Inactive"
                                                <?= old('User_Status', $user['User_Status'] ?? '') === 'Inactive' ? 'selected' : '' ?>
                                            >
                                                Inactive
                                            </option>

                                            <option
                                                value="Completed"
                                                <?= old('User_Status', $user['User_Status'] ?? '') === 'Completed' ? 'selected' : '' ?>
                                            >
                                                Completed
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Role Assignment -->
                                    <div class="col-md-6 form-group">
                                        <label for="Role_Id">
                                            Role <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            id="Role_Id"
                                            name="Role_Id"
                                            class="form-select"
                                            required
                                        >
                                            <option value="">Select Role</option>

                                            <?php foreach ($roles as $role): ?>
                                                <?php
                                                $roleStatus = $role['Role_Status'] ?? '';
                                                $currentRoleId = $user['Role_Id'] ?? '';
                                                $isCurrentRole = $currentRoleId == $role['Role_Id'];
                                                ?>

                                                <?php if ($roleStatus === 'Active' || $isCurrentRole): ?>
                                                    <option
                                                        value="<?= esc($role['Role_Id']) ?>"
                                                        <?= old('Role_Id', $currentRoleId) == $role['Role_Id'] ? 'selected' : '' ?>
                                                    >
                                                        <?= esc($role['Role_Name']) ?>
                                                        <?= $roleStatus !== 'Active' ? ' (Inactive - Current Role)' : '' ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Photos & Documents -->
                                    <h5 class="mt-4 mb-3 text-primary">Photos &amp; Documents</h5>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Aadhar_No">Aadhar Number</label>
                                        <input
                                            type="text"
                                            id="User_Aadhar_No"
                                            name="User_Aadhar_No"
                                            class="form-control"
                                            value="<?= esc(old('User_Aadhar_No', $user['User_Aadhar_No'] ?? '')) ?>"
                                        >
                                    </div>

                                    <!-- Current User Photo -->
                                    <div class="col-md-6 form-group">
                                        <label for="User_Photo">Current User Photo</label>

                                        <?php if (! empty($user['User_Photo_URL'])): ?>
                                            <div class="mb-2">
                                                <img
                                                    src="<?= esc(base_url($user['User_Photo_URL'])) ?>"
                                                    width="120"
                                                    alt="Current user photo"
                                                    class="img-thumbnail"
                                                >
                                            </div>
                                        <?php else: ?>
                                            <p class="text-muted">No Photo Uploaded</p>
                                        <?php endif; ?>

                                        <input
                                            type="file"
                                            id="User_Photo"
                                            name="User_Photo"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp"
                                        >

                                        <small class="text-muted">
                                            Select a new image only if you want to replace the current photo.
                                        </small>
                                    </div>

                                    <!-- Current Aadhar Photo -->
                                    <div class="col-md-6 form-group mt-3">
                                        <label for="User_Aadhar_Photo">Current Aadhar Photo</label>

                                        <?php if (! empty($user['User_Aadhar_Photo_URL'])): ?>
                                            <div class="mb-2">
                                                <img
                                                    src="<?= esc(base_url($user['User_Aadhar_Photo_URL'])) ?>"
                                                    width="120"
                                                    alt="Current Aadhar document"
                                                    class="img-thumbnail"
                                                >
                                            </div>
                                        <?php else: ?>
                                            <p class="text-muted">No Aadhar Uploaded</p>
                                        <?php endif; ?>

                                        <input
                                            type="file"
                                            id="User_Aadhar_Photo"
                                            name="User_Aadhar_Photo"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp,application/pdf"
                                        >

                                        <small class="text-muted">
                                            Select a replacement document only if required.
                                        </small>
                                    </div>

                                    <!-- Login Credentials -->
                                    <h5 class="mt-4 mb-3 text-primary">Login Credentials</h5>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_Password">New Password</label>
                                        <input
                                            type="password"
                                            id="User_Password"
                                            name="User_Password"
                                            class="form-control"
                                            minlength="8"
                                            autocomplete="new-password"
                                            placeholder="Leave blank to keep existing password"
                                        >
                                        <small class="text-muted">
                                            Leave blank if you do not want to change the password.
                                        </small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="Confirm_Password">Confirm New Password</label>
                                        <input
                                            type="password"
                                            id="Confirm_Password"
                                            name="Confirm_Password"
                                            class="form-control"
                                            minlength="8"
                                            autocomplete="new-password"
                                            placeholder="Re-enter the new password"
                                        >
                                    </div>

                                    <!-- Form Actions -->
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editUserForm');
    const password = document.getElementById('User_Password');
    const confirmPassword = document.getElementById('Confirm_Password');

    if (!form || !password || !confirmPassword) {
        return;
    }

    function validatePasswordConfirmation() {
        if (password.value === '' && confirmPassword.value === '') {
            confirmPassword.setCustomValidity('');
            return;
        }

        if (password.value === '') {
            confirmPassword.setCustomValidity(
                'Enter a new password before confirming it.'
            );
            return;
        }

        if (confirmPassword.value === '') {
            confirmPassword.setCustomValidity(
                'Please confirm the new password.'
            );
            return;
        }

        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity(
                'Password and confirm password do not match.'
            );
            return;
        }

        confirmPassword.setCustomValidity('');
    }

    password.addEventListener('input', validatePasswordConfirmation);
    confirmPassword.addEventListener('input', validatePasswordConfirmation);

    form.addEventListener('submit', function (event) {
        validatePasswordConfirmation();

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
        }
    });
});
</script>

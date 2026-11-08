<?php
$nationalities = require APPPATH . 'Config/Nationalities.php';
?>

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
                            <p class="card-description">Add user</p>

                            <form
                                class="forms-sample"
                                action="<?= site_url('users/store') ?>"
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
                                            value="<?= esc(old('User_FirstName') ?? '') ?>"
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
                                            value="<?= esc(old('User_LastName') ?? '') ?>"
                                            maxlength="100"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Gender">
                                            Gender <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            class="form-select"
                                            id="User_Gender"
                                            name="User_Gender"
                                            required
                                        >
                                            <option value="">Select Gender</option>
                                            <option value="Male" <?= old('User_Gender') === 'Male' ? 'selected' : '' ?>>
                                                Male
                                            </option>
                                            <option value="Female" <?= old('User_Gender') === 'Female' ? 'selected' : '' ?>>
                                                Female
                                            </option>
                                            <option value="Other" <?= old('User_Gender') === 'Other' ? 'selected' : '' ?>>
                                                Other
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="User_DOB">
                                            Date of Birth <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="date"
                                            id="User_DOB"
                                            name="User_DOB"
                                            class="form-control"
                                            value="<?= esc(old('User_DOB') ?? '') ?>"
                                            required
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
                                            value="<?= esc(old('User_Login_MailID') ?? '') ?>"
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
                                            value="<?= esc(old('User_Phone_No') ?? '') ?>"
                                            placeholder="Enter Phone Number"
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Nationality">
                                            Nationality <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            id="User_Nationality"
                                            name="User_Nationality"
                                            class="form-select"
                                            required
                                        >
                                            <option value="">-- Select Nationality --</option>

                                            <?php foreach ($nationalities as $nation): ?>
                                                <option
                                                    value="<?= esc($nation) ?>"
                                                    <?= old('User_Nationality') === $nation ? 'selected' : '' ?>
                                                >
                                                    <?= esc($nation) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Village_City">
                                            Village/City <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_Village_City"
                                            name="User_Village_City"
                                            class="form-control"
                                            value="<?= esc(old('User_Village_City') ?? '') ?>"
                                            placeholder="Enter Village/City"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_District">
                                            District <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_District"
                                            name="User_District"
                                            class="form-control"
                                            value="<?= esc(old('User_District') ?? '') ?>"
                                            placeholder="Enter District"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_State">
                                            State <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_State"
                                            name="User_State"
                                            class="form-control"
                                            value="<?= esc(old('User_State') ?? '') ?>"
                                            placeholder="Enter State"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Pincode">
                                            PinCode <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_Pincode"
                                            name="User_Pincode"
                                            class="form-control"
                                            value="<?= esc(old('User_Pincode') ?? '') ?>"
                                            placeholder="Enter PinCode"
                                            maxlength="10"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="User_Address">
                                            Full Address <span class="text-danger">*</span>
                                        </label>
                                        <textarea
                                            id="User_Address"
                                            name="User_Address"
                                            class="form-control"
                                            rows="3"
                                            required
                                        ><?= esc(old('User_Address') ?? '') ?></textarea>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Joining_Date">
                                            Joining Date <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="date"
                                            id="User_Joining_Date"
                                            name="User_Joining_Date"
                                            class="form-control"
                                            value="<?= esc(old('User_Joining_Date') ?? '') ?>"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Leaving_Date">Leaving Date</label>
                                        <input
                                            type="date"
                                            id="User_Leaving_Date"
                                            name="User_Leaving_Date"
                                            class="form-control"
                                            value="<?= esc(old('User_Leaving_Date') ?? '') ?>"
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
                                            <option value="">Select Status</option>
                                            <option value="Active" <?= old('User_Status', 'Active') === 'Active' ? 'selected' : '' ?>>
                                                Active
                                            </option>
                                            <option value="Inactive" <?= old('User_Status') === 'Inactive' ? 'selected' : '' ?>>
                                                Inactive
                                            </option>
                                            <option value="Completed" <?= old('User_Status') === 'Completed' ? 'selected' : '' ?>>
                                                Completed
                                            </option>
                                        </select>
                                    </div>

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
                                                <?php if (($role['Role_Status'] ?? '') === 'Active'): ?>
                                                    <option
                                                        value="<?= esc($role['Role_Id']) ?>"
                                                        <?= old('Role_Id') == $role['Role_Id'] ? 'selected' : '' ?>
                                                    >
                                                        <?= esc($role['Role_Name']) ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Section 2: Photos & Documents -->
                                    <h5 class="mt-4 mb-3 text-primary">Photos &amp; Documents</h5>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Aadhar_No">
                                            Aadhar Number <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="User_Aadhar_No"
                                            name="User_Aadhar_No"
                                            class="form-control"
                                            value="<?= esc(old('User_Aadhar_No') ?? '') ?>"
                                            placeholder="Enter Aadhar Number"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Aadhar_Photo">Aadhar Photo</label>
                                        <input
                                            type="file"
                                            id="User_Aadhar_Photo"
                                            name="User_Aadhar_Photo"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp,application/pdf"
                                        >
                                        <small class="text-muted">
                                            Select a supported image or PDF file.
                                        </small>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="User_Photo">User Photo</label>
                                        <input
                                            type="file"
                                            id="User_Photo"
                                            name="User_Photo"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp"
                                        >
                                        <small class="text-muted">
                                            Select a JPG, PNG, or WebP image.
                                        </small>
                                    </div>

                                    <!-- Section 3: Login Credentials -->
                                    <h5 class="mt-4 mb-3 text-primary">Login Credentials</h5>

                                    <div class="col-md-6 mb-3">
                                        <label for="password">
                                            Password <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-control"
                                            minlength="8"
                                            autocomplete="new-password"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="confirm_password">
                                            Confirm Password <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="password"
                                            id="confirm_password"
                                            name="confirm_password"
                                            class="form-control"
                                            minlength="8"
                                            autocomplete="new-password"
                                            required
                                        >
                                    </div>

                                </div>

                                <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
                                    <a href="<?= site_url('users') ?>" class="btn btn-light">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= view('includes/footer'); ?>
    </div>
</div>

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class Users extends BaseController
{
    protected $userModel;

    private const USER_UPLOAD_DIRECTORY = 'uploads/users';
    private const MAX_IMAGE_SIZE = 2097152; // 2 MB

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display all users.
     */
    public function index()
    {
        $data['users'] = $this->userModel->getUsersWithRole();

        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();

        return view('ManageUsers/users', $data);
    }

    /**
     * Display the Add User form.
     */
    public function add()
    {
        $roleModel = new RoleModel();

        $data['roles'] = $roleModel
            ->where('Role_Status', 'Active')
            ->findAll();

        return view('ManageUsers/add_user', $data);
    }

    /**
     * Create a new user.
     */
    public function store()
    {
        $db = db_connect();

        $firstName = trim(
            (string) $this->request->getPost('User_FirstName')
        );

        $lastName = trim(
            (string) $this->request->getPost('User_LastName')
        );

        $email = strtolower(
            trim((string) $this->request->getPost('User_Login_MailID'))
        );

        $password = (string) $this->request->getPost('password');

        $confirmPassword = $this->request->getPost('Confirm_Password');

        if ($confirmPassword === null) {
            $confirmPassword = $this->request->getPost('confirm_password');
        }

        $roleId = trim(
            (string) $this->request->getPost('Role_Id')
        );

        // Validate names.
        if ($firstName === '' || $lastName === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'First name and last name are required.');
        }

        // Validate email.
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter a valid email address.');
        }

        if (strlen($email) > 254) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The email address is too long.');
        }

        // Validate password.
        if (strlen($password) < 8) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password must contain at least 8 characters.');
        }

        if (
            !is_string($confirmPassword)
            || $password !== $confirmPassword
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password and confirm password do not match.');
        }

        // Validate Aadhaar number uniqueness.
        $aadhaarNo = trim(
            (string) $this->request->getPost('User_Aadhar_No')
        );

        if ($aadhaarNo !== '') {
            $existingAadhaar = $db->table('user_m')
                ->where('User_Aadhar_No', $aadhaarNo)
                ->get()
                ->getRowArray();

            if ($existingAadhaar) {
                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'This Aadhaar number is already registered to another user.'
                    );
            }
        }

        // Validate email uniqueness.
        $existingUser = $db->table('user_m')
            ->where('User_Login_MailID', $email)
            ->get()
            ->getRowArray();

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This email address is already registered.');
        }

        // Validate selected role.
        if ($roleId === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a role for this user.');
        }

        $role = $db->table('role_m')
            ->where('Role_Id', $roleId)
            ->get()
            ->getRowArray();

        if (!$role) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The selected role does not exist.');
        }

        if (($role['Role_Status'] ?? '') !== 'Active') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You cannot assign an inactive role.');
        }

        // Validate user status.
        $status = trim(
            (string) $this->request->getPost('User_Status')
        );

        if ($status === '') {
            $status = 'Active';
        }

        if (!in_array($status, ['Active', 'Inactive', 'Completed'], true)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid user status.');
        }

        // Upload profile photo.
        $profileUpload = $this->processImageUpload('User_Photo');

        if (!$profileUpload['success']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $profileUpload['error']);
        }

        // Upload Aadhaar photo.
        $aadhaarUpload = $this->processImageUpload('User_Aadhar_Photo');

        if (!$aadhaarUpload['success']) {
            $this->deleteUploadedFile($profileUpload['new_path']);

            return redirect()->back()
                ->withInput()
                ->with('error', $aadhaarUpload['error']);
        }

        // Prepare user record.
        // Program_Id is NULL because program assignment is optional.
        $data = [
            'User_Id' => 'USR_' . bin2hex(random_bytes(8)),
            'User_FirstName'        => $firstName,
            'User_LastName'         => $lastName,
            'User_Gender'           => $this->request->getPost('User_Gender'),
            'User_DOB'              => $this->request->getPost('User_DOB') ?: null,
            'User_Login_MailID'     => $email,
            'User_Aadhar_No'        => $aadhaarNo !== '' ? $aadhaarNo : null,
            'User_Phone_No'         => $this->request->getPost('User_Phone_No'),
            'User_Village_City'     => $this->request->getPost('User_Village_City'),
            'User_District'         => $this->request->getPost('User_District'),
            'User_State'            => $this->request->getPost('User_State'),
            'User_Pincode'          => $this->request->getPost('User_Pincode'),
            'User_Nationality'      => $this->request->getPost('User_Nationality'),
            'User_Address'          => $this->request->getPost('User_Address'),
            'User_Joining_Date'     => $this->request->getPost('User_Joining_Date') ?: null,
            'User_Leaving_Date'     => $this->request->getPost('User_Leaving_Date') ?: null,
            'User_Status'           => $status,
            'User_Photo_URL'        => $profileUpload['path'],
            'User_Aadhar_Photo_URL' => $aadhaarUpload['path'],
            'Role_Id'               => $roleId,
            'Record_Added_By'       => 'ADMIN',
            'Rec_Added_On'          => date('Y-m-d'),
            'Rec_Updated_By'        => 'ADMIN',
            'User_Password'         => password_hash($password, PASSWORD_DEFAULT),
        ];

        try {
            if (!$this->userModel->insert($data)) {
                log_message(
                    'error',
                    'User creation failed. Model errors: '
                        . json_encode($this->userModel->errors())
                        . ' Database error: '
                        . json_encode($db->error())
                );

                $this->deleteUploadedFile($profileUpload['new_path']);
                $this->deleteUploadedFile($aadhaarUpload['new_path']);

                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Unable to add user. Please check the application logs for details.'
                    );
            }
        } catch (\Throwable $e) {
            $this->deleteUploadedFile($profileUpload['new_path']);
            $this->deleteUploadedFile($aadhaarUpload['new_path']);

            log_message(
                'error',
                'User creation exception: ' . $e->getMessage()
            );

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to add user. Please check the application logs for details.'
                );
        }

        return redirect()->to(site_url('users'))
            ->with('success', 'User added successfully.');
    }

    /**
     * Display user details.
     */
    public function view($id)
    {
        $data['user'] = $this->userModel
            ->select('user_m.*, role_m.Role_Name')
            ->join('role_m', 'role_m.Role_Id = user_m.Role_Id', 'left')
            ->where('user_m.User_Id', $id)
            ->first();

        if (!$data['user']) {
            return redirect()->to(site_url('users'))
                ->with('error', 'User not found.');
        }

        return view('ManageUsers/view_user', $data);
    }

    /**
     * Display Edit User form.
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(site_url('users'))
                ->with('error', 'User not found.');
        }

        $roleModel = new RoleModel();

        // Include active roles and the user's existing role.
        $data['roles'] = $roleModel
            ->groupStart()
            ->where('Role_Status', 'Active')
            ->orWhere('Role_Id', $user['Role_Id'])
            ->groupEnd()
            ->findAll();

        $data['user'] = $user;

        return view('ManageUsers/edit_user', $data);
    }

    /**
     * Update an existing user.
     */
    public function update($id)
    {
        $db = db_connect();

        $existingUser = $this->userModel->find($id);

        if (!$existingUser) {
            return redirect()->to(site_url('users'))
                ->with('error', 'User not found.');
        }

        $firstName = trim(
            (string) $this->request->getPost('User_FirstName')
        );

        $lastName = trim(
            (string) $this->request->getPost('User_LastName')
        );

        $email = strtolower(
            trim((string) $this->request->getPost('User_Login_MailID'))
        );

        $roleId = trim(
            (string) $this->request->getPost('Role_Id')
        );

        // Validate names.
        if ($firstName === '' || $lastName === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'First name and last name are required.');
        }

        // Validate email.
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter a valid email address.');
        }

        if (strlen($email) > 254) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The email address is too long.');
        }

        // Validate Aadhaar uniqueness, excluding the current user.
        $aadhaarNo = trim(
            (string) $this->request->getPost('User_Aadhar_No')
        );

        if ($aadhaarNo !== '') {
            $duplicateAadhaar = $db->table('user_m')
                ->where('User_Aadhar_No', $aadhaarNo)
                ->where('User_Id !=', $id)
                ->get()
                ->getRowArray();

            if ($duplicateAadhaar) {
                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'This Aadhaar number is already registered to another user.'
                    );
            }
        }

        // Validate email uniqueness, excluding the current user.
        $duplicateEmail = $db->table('user_m')
            ->where('User_Login_MailID', $email)
            ->where('User_Id !=', $id)
            ->get()
            ->getRowArray();

        if ($duplicateEmail) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'This email address is already registered to another user.'
                );
        }

        // Validate role.
        if ($roleId === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a role for this user.');
        }

        $role = $db->table('role_m')
            ->where('Role_Id', $roleId)
            ->get()
            ->getRowArray();

        if (!$role) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The selected role does not exist.');
        }

        // Do not allow assigning an inactive role.
        // The current inactive role may be retained.
        if (
            ($role['Role_Status'] ?? '') !== 'Active'
            && $roleId !== ($existingUser['Role_Id'] ?? '')
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You cannot assign an inactive role.');
        }

        // Protect the last user assigned to a system role.
        $currentRole = $db->table('role_m')
            ->where('Role_Id', $existingUser['Role_Id'] ?? '')
            ->get()
            ->getRowArray();

        if (
            $currentRole
            && (int) ($currentRole['Is_System_Role'] ?? 0) === 1
            && $roleId !== ($existingUser['Role_Id'] ?? '')
        ) {
            $systemRoleUserCount = $db->table('user_m')
                ->where('Role_Id', $existingUser['Role_Id'])
                ->countAllResults();

            if ($systemRoleUserCount <= 1) {
                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'The last user assigned to the system Super Admin role cannot be reassigned.'
                    );
            }
        }

        // Validate status.
        $status = trim(
            (string) $this->request->getPost('User_Status')
        );

        if (!in_array($status, ['Active', 'Inactive', 'Completed'], true)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid user status.');
        }

        // Process optional profile photo replacement.
        $profileUpload = $this->processImageUpload(
            'User_Photo',
            $existingUser['User_Photo_URL'] ?? null
        );

        if (!$profileUpload['success']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $profileUpload['error']);
        }

        // Process optional Aadhaar photo replacement.
        $aadhaarUpload = $this->processImageUpload(
            'User_Aadhar_Photo',
            $existingUser['User_Aadhar_Photo_URL'] ?? null
        );

        if (!$aadhaarUpload['success']) {
            $this->deleteUploadedFile($profileUpload['new_path']);

            return redirect()->back()
                ->withInput()
                ->with('error', $aadhaarUpload['error']);
        }

        $data = [
            'User_FirstName'        => $firstName,
            'User_LastName'         => $lastName,
            'User_Gender'           => $this->request->getPost('User_Gender'),
            'User_DOB'              => $this->request->getPost('User_DOB') ?: null,
            'User_Login_MailID'     => $email,
            'User_Aadhar_No'        => $aadhaarNo !== '' ? $aadhaarNo : null,
            'User_Phone_No'         => $this->request->getPost('User_Phone_No'),
            'User_Village_City'     => $this->request->getPost('User_Village_City'),
            'User_District'         => $this->request->getPost('User_District'),
            'User_State'            => $this->request->getPost('User_State'),
            'User_Pincode'          => $this->request->getPost('User_Pincode'),
            'User_Nationality'      => $this->request->getPost('User_Nationality'),
            'User_Address'          => $this->request->getPost('User_Address'),
            'User_Joining_Date'     => $this->request->getPost('User_Joining_Date') ?: null,
            'User_Leaving_Date'     => $this->request->getPost('User_Leaving_Date') ?: null,
            'User_Status'           => $status,
            'User_Photo_URL'        => $profileUpload['path'],
            'User_Aadhar_Photo_URL' => $aadhaarUpload['path'],
            'Role_Id'               => $roleId,
            'Rec_Updated_By'        => 'ADMIN',
            'Rec_Last_Updated_On'   => date('Y-m-d'),
        ];

        // Program_Id is deliberately not updated here.
        // The user's existing program assignment is preserved.

        // Update password only when a new password is provided.
        $password = (string) $this->request->getPost('User_Password');

        $confirmPassword = $this->request->getPost('Confirm_Password');

        if ($confirmPassword === null) {
            $confirmPassword = $this->request->getPost('confirm_password');
        }

        if ($password !== '') {
            if (strlen($password) < 8) {
                $this->deleteUploadedFile($profileUpload['new_path']);
                $this->deleteUploadedFile($aadhaarUpload['new_path']);

                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'New password must contain at least 8 characters.'
                    );
            }

            if (
                !is_string($confirmPassword)
                || $password !== $confirmPassword
            ) {
                $this->deleteUploadedFile($profileUpload['new_path']);
                $this->deleteUploadedFile($aadhaarUpload['new_path']);

                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Password and confirm password do not match.'
                    );
            }

            $data['User_Password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        try {
            if (!$this->userModel->update($id, $data)) {
                log_message(
                    'error',
                    'User update failed for ' . $id
                        . '. Model errors: ' . json_encode($this->userModel->errors())
                        . ' Database error: ' . json_encode($db->error())
                );

                $this->deleteUploadedFile($profileUpload['new_path']);
                $this->deleteUploadedFile($aadhaarUpload['new_path']);

                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Unable to update user. Please check the application logs for details.'
                    );
            }
        } catch (\Throwable $e) {
            $this->deleteUploadedFile($profileUpload['new_path']);
            $this->deleteUploadedFile($aadhaarUpload['new_path']);

            log_message(
                'error',
                'User update exception for ' . $id . ': ' . $e->getMessage()
            );

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to update user. Please check the application logs for details.'
                );
        }

        // Delete old files only after the database update succeeds.
        if ($profileUpload['new_path'] !== null) {
            $this->deleteUploadedFile(
                $existingUser['User_Photo_URL'] ?? null
            );
        }

        if ($aadhaarUpload['new_path'] !== null) {
            $this->deleteUploadedFile(
                $existingUser['User_Aadhar_Photo_URL'] ?? null
            );
        }

        return redirect()->to(site_url('users'))
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     * Users assigned to a system role cannot be deleted here.
     */
    public function delete($id)
    {
        $existingUser = $this->userModel->find($id);

        if (!$existingUser) {
            return redirect()->to(site_url('users'))
                ->with('error', 'User not found.');
        }

        $db = db_connect();

        $role = $db->table('role_m')
            ->where('Role_Id', $existingUser['Role_Id'] ?? '')
            ->get()
            ->getRowArray();

        if ($role && (int) ($role['Is_System_Role'] ?? 0) === 1) {
            return redirect()->to(site_url('users'))
                ->with(
                    'error',
                    'A user assigned to the system Super Admin role cannot be deleted here.'
                );
        }

        try {
            if (!$this->userModel->delete($id)) {
                return redirect()->to(site_url('users'))
                    ->with('error', 'Unable to delete user.');
            }
        } catch (\Throwable $e) {
            log_message(
                'error',
                'User deletion failed for ' . $id . ': ' . $e->getMessage()
            );

            return redirect()->to(site_url('users'))
                ->with(
                    'error',
                    'Unable to delete user. Please check whether this user is linked to other records.'
                );
        }

        $this->deleteUploadedFile(
            $existingUser['User_Photo_URL'] ?? null
        );

        $this->deleteUploadedFile(
            $existingUser['User_Aadhar_Photo_URL'] ?? null
        );

        return redirect()->to(site_url('users'))
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Validate and save an optional JPG or PNG image.
     */
    private function processImageUpload(
        string $fieldName,
        ?string $existingPath = null
    ): array {
        $file = $this->request->getFile($fieldName);

        if (!$file) {
            return [
                'success'  => true,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => null,
            ];
        }

        // Keep the existing file if no replacement was selected.
        if ($file->getError() === UPLOAD_ERR_NO_FILE) {
            return [
                'success'  => true,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => null,
            ];
        }

        if ($file->getError() !== UPLOAD_ERR_OK || !$file->isValid()) {
            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'The selected image could not be uploaded. Please try again.',
            ];
        }

        if ($file->getSize() > self::MAX_IMAGE_SIZE) {
            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'Each image must be 2 MB or smaller.',
            ];
        }

        // Verify the actual image data.
        $imageInfo = @getimagesize($file->getTempName());

        if ($imageInfo === false || empty($imageInfo['mime'])) {
            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'The uploaded file is not a valid JPG or PNG image.',
            ];
        }

        $mimeType = $imageInfo['mime'];

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
        ];

        if (!isset($allowedTypes[$mimeType])) {
            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'Only JPG and PNG images are allowed.',
            ];
        }

        $uploadDirectory = FCPATH . self::USER_UPLOAD_DIRECTORY;

        if (!is_dir($uploadDirectory)) {
            if (
                !mkdir($uploadDirectory, 0755, true)
                && !is_dir($uploadDirectory)
            ) {
                return [
                    'success'  => false,
                    'path'     => $existingPath,
                    'new_path' => null,
                    'error'    => 'Unable to create the user upload directory. Please check folder permissions.',
                ];
            }
        }

        if (!is_writable($uploadDirectory)) {
            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'The user upload directory is not writable. Please check folder permissions.',
            ];
        }

        // Generate a random filename.
        $newFileName = bin2hex(random_bytes(16))
            . '.'
            . $allowedTypes[$mimeType];

        try {
            $file->move($uploadDirectory, $newFileName);
        } catch (\Throwable $e) {
            log_message(
                'error',
                'User image upload failed: ' . $e->getMessage()
            );

            return [
                'success'  => false,
                'path'     => $existingPath,
                'new_path' => null,
                'error'    => 'Unable to save the uploaded image. Please try again.',
            ];
        }

        $relativePath = self::USER_UPLOAD_DIRECTORY . '/' . $newFileName;

        return [
            'success'  => true,
            'path'     => $relativePath,
            'new_path' => $relativePath,
            'error'    => null,
        ];
    }

    /**
     * Delete files only from the uploads/users directory.
     */
    private function deleteUploadedFile(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $relativePath = str_replace('\\', '/', $relativePath);
        $relativePath = ltrim($relativePath, '/');

        $expectedPrefix = self::USER_UPLOAD_DIRECTORY . '/';

        if (strpos($relativePath, $expectedPrefix) !== 0) {
            return;
        }

        // Prevent path traversal.
        $segments = explode('/', $relativePath);

        if (in_array('..', $segments, true)) {
            return;
        }

        $fullPath = FCPATH . $relativePath;

        if (is_file($fullPath) && !@unlink($fullPath)) {
            log_message(
                'warning',
                'Unable to remove user upload: ' . $relativePath
            );
        }
    }
}

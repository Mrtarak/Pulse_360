<?php

namespace App\Controllers;

use Config\Database;

class Auth extends BaseController
{
    /**
     * Display the login page.
     */
    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(site_url('/'));
        }

        return view('auth/login');
    }

    /**
     * Validate credentials and create the authenticated session.
     */
    public function authenticate()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('error', 'Please enter your email address and password.');
        }

        $db = Database::connect();

        // Get user and assigned role information.
        $user = $db->table('user_m u')
            ->select([
                'u.User_Id',
                'u.User_FirstName',
                'u.User_LastName',
                'u.User_Login_MailID',
                'u.User_Password',
                'u.User_Photo_URL',
                'u.User_Status',
                'u.Role_Id',
                'r.Role_Name',
                'r.Role_Status',
                'r.Is_System_Role',
            ])
            ->join('role_m r', 'r.Role_Id = u.Role_Id', 'left')
            ->where('u.User_Login_MailID', $email)
            ->limit(1)
            ->get()
            ->getRowArray();

        // Validate credentials.
        if (
            !$user ||
            !password_verify(
                $password,
                (string) ($user['User_Password'] ?? '')
            )
        ) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('error', 'Invalid email address or password.');
        }

        // Validate user status.
        if (
            strtolower(trim((string) ($user['User_Status'] ?? ''))) !== 'active'
        ) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('error', 'Your account is inactive. Please contact the administrator.');
        }

        // Validate assigned role.
        if (
            empty($user['Role_Id']) ||
            strtolower(trim((string) ($user['Role_Status'] ?? ''))) !== 'active'
        ) {
            return redirect()->to(site_url('login'))
                ->withInput()
                ->with('error', 'Your assigned role is inactive or unavailable. Please contact the administrator.');
        }

        $roleId = (string) $user['Role_Id'];

        /*
         * SUPER ADMIN IDENTIFICATION
         *
         * ROLE001 is the Super Admin role.
         * We also verify Is_System_Role = 1.
         */
        $isSuperAdmin = (
            $roleId === 'ROLE001' &&
            (int) ($user['Is_System_Role'] ?? 0) === 1
        );

        /*
         * LOAD ALL ACTIVE RIGHTS
         *
         * These records are also used to calculate parent
         * rights for sidebar visibility.
         */
        $allRights = $db->table('right_m')
            ->select([
                'Right_Id',
                'Parent_Right_Id',
                'Right_Key',
            ])
            ->where('Right_Status', 'Active')
            ->get()
            ->getResultArray();

        $rightsById = [];

        foreach ($allRights as $right) {
            $rightsById[$right['Right_Id']] = $right;
        }

        /*
         * LOAD DIRECTLY ASSIGNED RIGHTS
         */
        if ($isSuperAdmin) {

            // Super Admin receives every active right.
            $assignedRights = $allRights;
        } else {

            // Other roles receive only explicitly assigned rights.
            $assignedRights = $db->table('role_right_rel rr')
                ->select([
                    'rm.Right_Id',
                    'rm.Parent_Right_Id',
                    'rm.Right_Key',
                ])
                ->join(
                    'right_m rm',
                    'rm.Right_Id = rr.Right_Id',
                    'inner'
                )
                ->where('rr.Role_Id', $roleId)
                ->where('rm.Right_Status', 'Active')
                ->get()
                ->getResultArray();
        }

        /*
         * DIRECT RIGHTS
         *
         * These rights will control actual page access.
         */
        $directRightIds = [];
        $directRightKeys = [];

        /*
         * VISIBLE RIGHTS
         *
         * These rights control sidebar visibility.
         * Parent rights are included here only.
         */
        $visibleRightIds = [];
        $visibleRightKeys = [];

        foreach ($assignedRights as $right) {

            $rightId = $right['Right_Id'];
            $rightKey = $right['Right_Key'];

            // Store directly assigned rights.
            $directRightIds[] = $rightId;
            $directRightKeys[] = $rightKey;

            // Every directly assigned right is also visible.
            $visibleRightIds[] = $rightId;
            $visibleRightKeys[] = $rightKey;

            /*
             * Walk through parent rights.
             * This makes parent menus visible without
             * granting access to sibling child pages.
             */
            $parentId = $right['Parent_Right_Id'];

            while (!empty($parentId)) {

                if (!isset($rightsById[$parentId])) {
                    break;
                }

                $parentRight = $rightsById[$parentId];

                $visibleRightIds[] = $parentRight['Right_Id'];
                $visibleRightKeys[] = $parentRight['Right_Key'];

                $parentId = $parentRight['Parent_Right_Id'];
            }
        }

        // Remove duplicate values.
        $directRightIds = array_values(array_unique($directRightIds));
        $directRightKeys = array_values(array_unique($directRightKeys));

        $visibleRightIds = array_values(array_unique($visibleRightIds));
        $visibleRightKeys = array_values(array_unique($visibleRightKeys));

        /*
         * REGENERATE SESSION
         */
        session()->regenerate(true);

        /*
         * STORE AUTHENTICATION AND PERMISSION DATA
         */
        session()->set([

            // Authentication
            'isLoggedIn' => true,

            // User information
            'User_Id' => $user['User_Id'],

            'User_Name' => trim(
                ($user['User_FirstName'] ?? '') . ' ' .
                    ($user['User_LastName'] ?? '')
            ),

            'User_Email' => $user['User_Login_MailID'],

            // Logged-in user's profile photo
            'User_Photo_URL' => $user['User_Photo_URL'] ?? '',

            // Role information
            'Role_Id' => $roleId,
            'Role_Name' => $user['Role_Name'],
            'Is_Super_Admin' => $isSuperAdmin,

            // Direct permissions: used for actual authorization.
            'User_Right_Ids' => $directRightIds,
            'User_Rights' => $directRightKeys,

            // Visible permissions: used for sidebar menus.
            'User_Visible_Right_Ids' => $visibleRightIds,
            'User_Visible_Rights' => $visibleRightKeys,
        ]);

        return redirect()->to(site_url('/'));
    }

    /**
     * End the current authenticated session.
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'))
            ->with('success', 'You have been logged out successfully.');
    }
}

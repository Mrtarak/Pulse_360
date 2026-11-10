<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionFilter implements FilterInterface
{
    /**
     * Check whether the logged-in user has the required permission.
     *
     * Multiple permission arguments are supported.
     * If any one matches, access is allowed.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Super Admin bypasses individual permission checks.
        if (session()->get('Is_Super_Admin') === true) {
            return null;
        }

        // No permission argument means access is denied.
        if (empty($arguments) || !is_array($arguments)) {
            return $this->forbiddenResponse();
        }

        // Read only directly assigned rights.
        $userRights = session()->get('User_Rights');

        if (!is_array($userRights)) {
            $userRights = [];
        }

        // Allow access if the user has at least one required right.
        foreach ($arguments as $requiredRight) {
            if (
                is_string($requiredRight) &&
                in_array($requiredRight, $userRights, true)
            ) {
                return null;
            }
        }

        return $this->forbiddenResponse();
    }

    /**
     * Return HTTP 403 Forbidden.
     */
    private function forbiddenResponse(): ResponseInterface
    {
        return service('response')
            ->setStatusCode(403)
            ->setBody(
                '<!DOCTYPE html>
                <html>
                <head>
                    <title>403 - Access Denied</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background: #f5f6fa;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-height: 100vh;
                            margin: 0;
                        }
                        .error-box {
                            background: #fff;
                            padding: 40px;
                            border-radius: 10px;
                            text-align: center;
                            box-shadow: 0 3px 15px rgba(0,0,0,.08);
                            max-width: 420px;
                        }
                        h1 {
                            color: #dc3545;
                            font-size: 48px;
                            margin: 0 0 10px;
                        }
                        p {
                            color: #555;
                            line-height: 1.6;
                        }
                        a {
                            display: inline-block;
                            margin-top: 15px;
                            padding: 10px 20px;
                            background: #1B4482;
                            color: #fff;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                    </style>
                </head>
                <body>
                    <div class="error-box">
                        <h1>403</h1>
                        <h2>Access Denied</h2>
                        <p>You do not have permission to access this page.</p>
                        <a href="' . site_url('/') . '">Back to Dashboard</a>
                    </div>
                </body>
                </html>'
            );
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // No action required.
    }
}

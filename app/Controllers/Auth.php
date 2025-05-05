<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    public function register()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON();

        if (!$data->username || !$data->password || !$data->email) {
            return $this->failValidationErrors('Missing required fields.');
        }

        $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);

        $userData = [
            'username' => $data->username,
            'email' => $data->email,
            'password' => $hashedPassword,
            'role' => 'member' // Default role
        ];

        $userModel->insert($userData);

        return $this->respondCreated(['message' => 'User registered successfully']);
    }

    public function login()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON();

        $user = $userModel->where('username', $data->username)->first();

        if (!$user || !password_verify($data->password, $user['password'])) {
            return $this->failUnauthorized('Invalid username or password');
        }

        unset($user['password']); // Hide password hash

        return $this->respond(['message' => 'Login successful', 'user' => $user]);
    }
}

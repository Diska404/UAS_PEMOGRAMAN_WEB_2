<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        $payload = $this->payload();
        $email = trim($payload['email'] ?? '');
        $password = $payload['password'] ?? '';

        if ($email === '' || $password === '') {
            return $this->failValidationErrors('Email dan password wajib diisi.');
        }

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Email atau password tidak sesuai.');
        }

        $token = bin2hex(random_bytes(32));
        $this->userModel->update($user['id_user'], ['token' => $token]);

        return $this->respond([
            'status' => true,
            'message' => 'Login berhasil.',
            'token' => $token,
            'user' => [
                'id_user' => $user['id_user'],
                'nama' => $user['nama'],
                'email' => $user['email'],
            ],
        ]);
    }

    public function profile()
    {
        $user = $this->currentUser();

        if (!$user) {
            return $this->failUnauthorized('Sesi tidak valid.');
        }

        return $this->respond([
            'status' => true,
            'user' => [
                'id_user' => $user['id_user'],
                'nama' => $user['nama'],
                'email' => $user['email'],
            ],
        ]);
    }

    public function logout()
    {
        $user = $this->currentUser();

        if ($user) {
            $this->userModel->update($user['id_user'], ['token' => null]);
        }

        return $this->respond([
            'status' => true,
            'message' => 'Logout berhasil.',
        ]);
    }

    private function currentUser(): ?array
    {
        $userId = $_SERVER['AUTH_USER_ID'] ?? null;

        if (!$userId) {
            return null;
        }

        return $this->userModel->find((int) $userId);
    }

    private function payload(): array
    {
        return $this->request->getJSON(true) ?? $this->request->getPost() ?? [];
    }
}

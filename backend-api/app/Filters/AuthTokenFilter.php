<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthTokenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (strtolower($request->getMethod()) === 'options') {
            return null;
        }

        $authorization = $request->getHeaderLine('Authorization');
        $token = $this->extractToken($authorization);

        if ($token === '') {
            return $this->unauthorized('Token tidak ditemukan pada Authorization Bearer.');
        }

        $user = (new UserModel())->where('token', $token)->first();

        if (!$user) {
            return $this->unauthorized('Token tidak valid atau sesi sudah berakhir.');
        }

        $_SERVER['AUTH_USER_ID'] = $user['id_user'];

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }

    private function extractToken(string $authorization): string
    {
        if (stripos($authorization, 'Bearer ') !== 0) {
            return '';
        }

        return trim(substr($authorization, 7));
    }

    private function unauthorized(string $message)
    {
        return service('response')->setStatusCode(401)->setJSON([
            'status' => false,
            'message' => $message,
        ]);
    }
}

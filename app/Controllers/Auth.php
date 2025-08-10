<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($this->request->getMethod() === 'post') {
            $username = (string) $this->request->getPost('username');
            $password = (string) $this->request->getPost('password');
            $redirect = (string) $this->request->getPost('redirect') ?: '/admin';

            $user = (new UserModel())->where('username', $username)->first();
            if ($user && password_verify($password, $user['password_hash'])) {
                $session->set(['user_id' => $user['id'], 'username' => $user['username'], 'is_admin' => (bool)$user['is_admin']]);
                return redirect()->to($redirect);
            }
            return redirect()->back()->withInput()->with('error', 'Invalid credentials');
        }
        $redirect = $this->request->getGet('redirect') ?? '/admin';
        return view('auth/login', ['title' => 'Admin Login', 'redirect' => $redirect]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

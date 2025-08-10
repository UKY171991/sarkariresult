<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        $session = session();
        $model = new \App\Models\UserModel();
        if ($this->request->getMethod() === 'post') {
            $username = trim((string) $this->request->getPost('username'));
            $email = trim((string) $this->request->getPost('email'));
            $password = (string) $this->request->getPost('password');
            $confirm = (string) $this->request->getPost('confirm');
            $is_admin = (int) ($this->request->getPost('is_admin') ? 1 : 0);

            $errors = [];
            if ($username === '' || strlen($username) < 3) $errors['username'] = 'Username too short';
            if ($email !== '' && ! filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email';
            if (strlen($password) < 6) $errors['password'] = 'Minimum 6 characters';
            if ($password !== $confirm) $errors['confirm'] = 'Passwords do not match';
            if ($model->where('username', $username)->first()) $errors['username'] = 'Username already exists';

            if (empty($errors)) {
                $ok = $model->insert([
                    'username' => $username,
                    'email' => $email ?: null,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'is_admin' => $is_admin,
                ]);
                if ($ok) {
                    $session->setFlashdata('message', 'Registration successful. You can login now.');
                    return redirect()->to('/login');
                }
                $errors = $model->errors() ?: ['general' => 'Failed to register'];
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        return view('auth/register', ['title' => 'Register']);
    }
    public function login()
    {
        $session = session();
        if ($this->request->getMethod() === 'post') {
            $username = (string) $this->request->getPost('username');
            $password = (string) $this->request->getPost('password');
            $redirect = (string) $this->request->getPost('redirect') ?: '/admin';
            // Normalize redirect to local path to avoid external/full-URL redirects being blocked
            if (preg_match('#^https?://#i', $redirect)) {
                $parts = parse_url($redirect);
                $path = $parts['path'] ?? '/admin';
                $query = isset($parts['query']) && $parts['query'] !== '' ? ('?' . $parts['query']) : '';
                $redirect = $path . $query;
            }
            if ($redirect === '' || $redirect[0] !== '/') {
                $redirect = '/admin';
            }

            $user = (new UserModel())->where('username', $username)->first();
            if ($user && password_verify($password, $user['password_hash'])) {
                $session->set(['user_id' => $user['id'], 'username' => $user['username'], 'is_admin' => (bool)$user['is_admin']]);
                return redirect()->to($redirect);
            }
            return redirect()->back()->withInput()->with('error', 'Invalid credentials');
        }
        $redirect = $this->request->getGet('redirect') ?? '/admin';
        // Also normalize any incoming redirect query
        if (preg_match('#^https?://#i', $redirect)) {
            $parts = parse_url($redirect);
            $path = $parts['path'] ?? '/admin';
            $query = isset($parts['query']) && $parts['query'] !== '' ? ('?' . $parts['query']) : '';
            $redirect = $path . $query;
        }
        if ($redirect === '' || $redirect[0] !== '/') {
            $redirect = '/admin';
        }
        return view('auth/login', ['title' => 'Admin Login', 'redirect' => $redirect]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

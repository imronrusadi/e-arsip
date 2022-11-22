<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->auth = new AuthModel();
    }
    public function index()
    {
        return redirect()->to(base_url('login'));
    }
    public function login()
    {
        if (session('id_user')) {
            return redirect()->to(base_url('home'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->auth->where('email', $post['email'])->first();
        $user = $query;
        if ($user) {
            // $hast = password_hash($user['password'], PASSWORD_BCRYPT);
            if (password_verify($post['password'], $user->password)) {
                $params = [
                    'id_user' => $user->id_user,
                    'id_dept' => $user->id_dept
                ];
                session()->set($params);
                return redirect()->to(base_url('home'));
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->remove('id_user');
        return redirect()->to(base_url('login'));
    }
}

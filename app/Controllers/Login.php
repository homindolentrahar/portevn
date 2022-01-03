<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        helper(['form']);
        $isLoggedIn = session()->get('logged_in');
        $data = [
            'title' => "Login",
            'isLoggedIn' => $isLoggedIn,
        ];
        return view('pages/login', $data);
    }

    public function auth()
    {
        $session = session();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $this->model->where('user_email', $email)->first();

        if ($data) {
            $pass = $data['user_password'];
            $verifyPass = password_verify($password, $pass);

            if ($verifyPass) {
                $sessionData = [
                    'user_id' => $data['user_id'],
                    'user_name' => $data['user_name'],
                    'user_email' => $data['user_email'],
                    'logged_in' => true,
                ];

                $session->set($sessionData);

                return redirect()->to('/');
            } else {
                $session->setFlashdata('message', 'Wrong email or password!');

                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('message', 'User not found!');

            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/login');
    }
}

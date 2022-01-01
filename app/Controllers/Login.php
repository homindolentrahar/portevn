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
        $isLoggedIn = session()->get('isLoggedIn');
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

        $data = $this->model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $verifyPass = password_verify($password, $pass);

            if ($verifyPass) {
                $sessionData = [
                    'user_id' => $data['user_id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
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

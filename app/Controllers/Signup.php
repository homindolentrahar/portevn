<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signup extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }


    public function index()
    {
        $isLoggedIn = session()->get('isLoggedIn');
        $data = [
            'title' => "Sign Up",
            'isLoggedIn' => $isLoggedIn
        ];
        return view('pages/signup', $data);
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min_length[6]',
            'email' => 'required|min_length[6]|valid_email|is_unique[user.user_id]',
            'password' => 'required|min_length[6]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'user_name' => $this->request->getVar('name'),
                'user_email' => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $this->model->insert($data);

            return redirect()->to('/login');
        } else {
            $isLoggedIn = session()->get('isLoggedIn');
            $data = [
                'title' => "Sign Up",
                'validation' => $this->validator,
                'isLoggedIn' => $isLoggedIn,
            ];

            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->to('/signup');
        }
    }
}

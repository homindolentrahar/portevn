<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();

        $isLoggedIn = session()->get('logged_in');

        $data = [
            'title' => "Events",
            'categories' => $model->getCategories(),
            'isLoggedIn' => $isLoggedIn,
        ];

        return view('pages/home', $data);
    }
}

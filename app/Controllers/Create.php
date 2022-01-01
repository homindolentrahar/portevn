<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Create extends BaseController
{
    public function index()
    {
        $model = new CategoryModel();
        $categories = $model->getCategories();

        $isLoggedIn = session()->get('logged_in');
        $data = [
            'title' => "Add an Event",
            'categories' => $categories,
            'isLoggedIn' => $isLoggedIn,
        ];
        return view('pages/create', $data);
    }
}

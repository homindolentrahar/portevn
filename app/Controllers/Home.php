<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\EventModel;

class Home extends BaseController
{
    public function index()
    {
        $eventModel = new EventModel();
        $categoryModel = new CategoryModel();

        $isLoggedIn = session()->get('logged_in');

        $data = [
            'title' => "Events",
            'categories' => $categoryModel->getCategories(),
            'events' => $eventModel->getEvents(),
            'isLoggedIn' => $isLoggedIn,
        ];

        return view('pages/home', $data);
    }
}

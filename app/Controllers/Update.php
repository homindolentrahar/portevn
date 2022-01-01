<?php

namespace App\Controllers;

class Update extends BaseController
{
    public function index()
    {
        $isLoggedIn = session()->get('logged_in');
        $data = [
            'title' => "Update an Event",
            'isLoggedIn' => $isLoggedIn,
        ];
        return view('pages/update', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $logged_in = session()->get('logged_in');

        if ($logged_in) {
            $userModel = new UserModel();
            $bookingModel = new BookingModel();
            $user = $userModel->where('user_id', session()->get('user_id'))->first();
            $bookedEvents = $bookingModel->getEvents(session()->get('user_id'));

            $data = [
                'title' => "Profile",
                'user' => $user,
                'events' => $bookedEvents,
            ];

            return view('pages/profile', $data);
        } else {
            session()->setFlashdata('error', "You're not login already");
            return redirect()->to('/');
        }
    }
}

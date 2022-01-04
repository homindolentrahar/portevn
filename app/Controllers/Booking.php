<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\EventModel;

class Booking extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BookingModel();
    }

    public function index($id)
    {
        $model = new EventModel();

        $event = $model->getEvents($id);
        $logged_in = session()->get('logged_in');
        $recommendations = $model->getFilteredEvents($event[0]['category_slug']);

        if ($logged_in) {
            if ($event[0]['capacity'] == 0) {
                session()->setFlashdata('error', "Event is not accepting more participant");
                return redirect()->to("events/$id");
            }

            $data = [
                'title' => "Book an Event",
                'event' => $event,
                'recommendations' => $recommendations,
            ];

            return view('pages/book', $data);
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to('/');
        }
    }

    public function process()
    {
        $logged_in = session()->get('logged_in');

        if ($logged_in) {
            // Updating capacity
            $event_id = $this->request->getVar('event_id');
            $amount = $this->request->getVar('amount');

            $eventModel = new EventModel();
            $event = $eventModel->getEvents($event_id);

            $oldCapacity = $event[0]['capacity'];
            if ($amount > 0 && $amount <= $oldCapacity) {
                $event[0]['capacity'] = $oldCapacity  - $amount;

                $eventModel->update($event_id, $event[0]);
            }

            $data = [
                "timestamp" => date("Y-m-d H:i:s"),
                "event_id" => $event_id,
                "user_id" => session()->get('user_id'),
                "amount" => $amount,
            ];

            $this->model->save($data);

            session()->setFlashdata('success', "Event booked successfully!");
            return redirect()->to('/');
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to('/');
        }
    }
}

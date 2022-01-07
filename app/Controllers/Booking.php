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
            session()->setFlashdata('error', "You must login first to book event");
            return redirect()->to('/login');
        }
    }

    public function process()
    {
        $logged_in = session()->get('logged_in');
        $event_id = $this->request->getVar('event_id');
        $amount = $this->request->getVar('amount');

        if ($logged_in) {
            // Updating capacity 
            $eventModel = new EventModel();
            $event = $eventModel->getEvents($event_id);

            $user_name = session()->get('user_name');
            $event_title = $event[0]['title'];
            $event_date = date('d, M Y', strtotime($event[0]['event_time']));
            $event_time = date('H:i', strtotime($event[0]['event_time']));
            $event_venue = $event[0]['venue'];
            $event_location = $event[0]['location'];
            $event_contact = $event[0]['contact'];

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

            $email = \Config\Services::email();

            $content = "
<div>
    <h1>Hi, $user_name</h1>
    <br>
    <p>You've booked <b>$amount tickets</b> for <b>$event_title</b> event. This event will be held:</p>
    <p>Date: $event_date</p>
    <p>Time: $event_time</p>
    <p>Venue: $event_venue</p>
    <p>Location: $event_location</p>
    <br>
    <p>You may contacted <b>$event_contact</b> regarding payment issue</p>
    <br><br>
    <p><b>Regards,</b></p>
    <p><b>Portevn support</b></p>
</div>
            ";

            $email->setFrom("SENDER'S EMAIL", "Portevn Support Teams");
            $email->setTo(session()->get('user_email'));
            $email->setSubject("Booking Event Receipt");
            $email->setMessage($content);

            $email->send();

            session()->setFlashdata('success', "Event booked successfully!");
            return redirect()->to("/events/$event_id");
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to("/events/$event_id");
        }
    }
}

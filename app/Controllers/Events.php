<?php

namespace App\Controllers;

use App\Models\EventModel;

class Events extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new EventModel();
    }

    public function create()
    {
        $image = $this->request->getFile('image');

        if ($image->getError() == 4) {
            $imageName = 'default.jpg';
        } else {
            $imageName = $image->getRandomName();
            $image->move('img', $imageName);
        }

        $this->model->insert([
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'event_time' => $this->request->getVar('event_time'),
            'category_id' => $this->request->getVar('category'),
            'venue' => $this->request->getVar('venue'),
            'location' => $this->request->getVar('location'),
            'price' => $this->request->getVar('price'),
            'capacity' => $this->request->getVar('capacity'),
            'image_url' => $imageName,
            'post_url' => $this->request->getVar('instagram'),
            'contact' => $this->request->getVar('contact'),
        ]);

        session()->setFlashdata('message', "Event added!");

        return redirect()->to('/');
    }
}

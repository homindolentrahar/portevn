<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\EventModel;

class Events extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new EventModel();
    }

    // Views
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => "Events",
            'categories' => $categoryModel->getCategories(),
            'events' => $this->model->getEvents(),
            'isLoggedIn' => session()->get('logged_in'),
        ];

        return view('pages/home', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add an Event',
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/create', $data);
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Update an Event',
            'validation' => \Config\Services::validation(),
            'event' => $this->model->getEvents($id),
            'categories' => $categoryModel->getCategories(),
            'isLoggedIn' => session()->get('logged_in'),
        ];

        return view('pages/update', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Event',
            'event' => $this->model->getEvents($id),
            'isLoggedIn' => session()->get('logged_in'),
        ];

        if (empty($data['event'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event $id not found");
        }

        return view('pages/detail', $data);
    }

    // Actions
    public function save()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'image' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => "File size too big",
                    'is_image' => "Choose an image file",
                    'mime_in' => "Choose an image file",
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('pages/create')->withInput();
        }

        $imageFile = $this->request->getFile('image');

        if ($imageFile->getError() == 4) {
            $imageName = 'default.png';
        } else {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('img', $imageName);
        }

        $this->model->save([
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

        return redirect()->to('/events');
    }

    public function update($id)
    {
        // $oldComic = $this->model->getComic($this->request->getVar('slug'));

        // if ($oldComic['title'] == $this->request->getVar('title')) {
        // $rule_title = 'required';
        // } else {
        // $rule_title = 'required|is_unique[comics.title]';
        // }

        if (!$this->validate([
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            // 'cover' => [
            // 'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
            // 'errors' => [
            // 'max_size' => "File size too big",
            // 'is_image' => "Choose an image file",
            // 'mime_in' => "Choose an image file",
            // ]
            // ]
        ])) {
            // $validation = \Config\Services::validation();

            return redirect()->to("/events/edit/$id")->withInput();
        }

        $imageFile = $this->request->getFile('image');

        if ($imageFile->getError() == 4) {
            $imageName = $this->request->getVar('previous_image');
        } else {
            $imageName = $imageFile->getRandomName();

            unlink('img/' . $this->request->getVar('previous_image'));
            $imageFile->move('img', $imageName);
        }

        $this->model->save([
            'event_id' => $id,
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

        session()->setFlashdata('alert', 'Event updated!');

        return redirect()->to('/');
    }

    // public function update()
    // {
    //     $image = $this->request->getFile('image');

    //     if ($image->getError() == 4) {
    //         $imageName = 'default.jpg';
    //     } else {
    //         $imageName = $image->getRandomName();
    //         $image->move('img', $imageName);
    //     }

    //     $this->model->update($this->request->getVar('id'), [
    //         'title' => $this->request->getVar('title'),
    //         'description' => $this->request->getVar('description'),
    //         'event_time' => $this->request->getVar('event_time'),
    //         'category_id' => $this->request->getVar('category'),
    //         'venue' => $this->request->getVar('venue'),
    //         'location' => $this->request->getVar('location'),
    //         'price' => $this->request->getVar('price'),
    //         'capacity' => $this->request->getVar('capacity'),
    //         'image_url' => $imageName,
    //         'post_url' => $this->request->getVar('instagram'),
    //         'contact' => $this->request->getVar('contact'),
    //     ]);

    //     session()->setFlashdata('message', "Event updated!");

    //     return redirect()->to('/');
    // }

    // public function delete($id)
    // {
    //     $comic = $this->model->find($id);

    //     if ($comic['cover'] != 'default.jpg') {
    //         unlink('img/' . $comic['cover']);
    //     }

    //     $this->model->delete($id);

    //     session()->setFlashdata('alert', 'Comic deleted!');

    //     return redirect()->to('/comics');
    // }  
}

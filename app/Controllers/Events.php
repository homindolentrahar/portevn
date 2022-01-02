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
            // 'isLoggedIn' => session()->get('logged_in'),
        ];

        return view('pages/home', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Event',
            'event' => $this->model->getEvents($id),
            // 'isLoggedIn' => session()->get('logged_in'),
        ];

        if (empty($data['event'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event $id not found");
        }

        return view('pages/detail', $data);
    }

    public function create()
    {
        $model = new CategoryModel();
        $data = [
            'title' => 'Add an Event',
            'categories' => $model->getCategories(),
        ];

        return view('pages/create', $data);
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Update an Event',
            // 'validation' => \Config\Services::validation(),
            'event' => $this->model->getEvents($id),
            'categories' => $categoryModel->getCategories(),
        ];

        return view('pages/update', $data);
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
            'venue' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'capacity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'post_url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'contact' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => "File size too big",
                    'is_image' => "Choose an image file",
                    'mime_in' => "Choose an image file",
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->to('/events/create')->withInput();
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
            'post_url' => $this->request->getVar('post_url'),
            'contact' => $this->request->getVar('contact'),
        ]);

        session()->setFlashdata('success', "Event added!");

        return redirect()->to('/');
    }

    public function update($id)
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
            'venue' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'capacity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'post_url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'contact' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} must not be empty!",
                    'is_unique' => "{field} is already available",
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => "File size too big",
                    'is_image' => "Choose an image file",
                    'mime_in' => "Choose an image file",
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());

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

        session()->setFlashdata('success', 'Event updated!');

        return redirect()->to('/');
    }

    public function delete($id)
    {
        $event = $this->model->find($id);

        if ($event['image_url'] != 'default.jpg') {
            unlink('img/' . $event['image_url']);
        }

        $this->model->delete($id);

        session()->setFlashdata('success', 'Event deleted!');

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

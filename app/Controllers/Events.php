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
        ];


        return view('pages/home', $data);
    }

    public function filtered($slug)
    {
        $categoryModel = new CategoryModel();

        $data = [
            'title' => "Events | $slug",
            'categories' => $categoryModel->getCategories(),
            'events' => $this->model->getFilteredEvents($slug),
        ];

        return view('pages/home', $data);
    }

    public function detail($id)
    {
        $events = $this->model->getEvents($id);

        $data = [
            'title' => 'Detail Event',
            'event' => $events,
            'logged_in' => session()->get('logged_in'),
            'is_owner' => $events[0]['user_id'] == session()->get('user_id'),
        ];

        if (empty($data['event'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event $id not found");
        }

        return view('pages/detail', $data);
    }

    public function create()
    {
        $logged_in = session()->get('logged_in');

        if ($logged_in) {
            $model = new CategoryModel();
            $data = [
                'title' => 'Add an Event',
                'categories' => $model->getCategories(),
            ];

            return view('pages/create', $data);
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to('/');
        }
    }

    public function edit($id)
    {
        $model = $this->model->getEvents($id);
        $logged_in = session()->get('logged_in');
        $is_owner = $model[0]['user_id'] == session()->get('user_id');

        if ($logged_in && $is_owner) {
            $categoryModel = new CategoryModel();
            $data = [
                'title' => 'Update an Event',
                'event' => $model,
                'categories' => $categoryModel->getCategories(),
            ];

            return view('pages/update', $data);
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to('/');
        }
    }

    public function book($id)
    {
        $model = $this->model->getEvents($id);
        $logged_in = session()->get('logged_in');
        $recommendations = $this->model->getFilteredEvents($model[0]['category_slug']);

        if ($logged_in) {
            if ($model[0]['capacity'] == 0) {
                session()->setFlashdata('error', "Event is not accepting more participant");
                return redirect()->to("events/$id");
            }

            $data = [
                'title' => "Book an Event",
                'event' => $model,
                'recommendations' => $recommendations,
            ];

            return view('pages/book', $data);
        } else {
            session()->setFlashdata('error', "You're not authorized to see the page");
            return redirect()->to('/');
        }
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
            'user_id' => session()->get('user_id'),
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
            'post_url' => $this->request->getVar('post_url'),
            'contact' => $this->request->getVar('contact'),
            'user_id' => session()->get('user_id'),
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
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'event_id';
    protected $allowedFields = ['title', 'description', 'price', 'capacity', 'venue', 'location', 'event_time', 'post_url', 'contact', 'image_url', 'category_id'];

    public function getEvents($eventId = false)
    {
        if (!$eventId) {
            // return $this->findAll();
            return $this->db
                ->table('event')
                ->join('category', 'event.category_id=category.category_id')
                ->get()
                ->getResultArray();
        }

        // return $this->where('event_id', $eventId)->first();
        return $this->db
            ->table('event')
            ->join('category', 'event.category_id=category.category_id')
            ->where('event_id', $eventId)
            ->get()
            ->getResultArray();
    }
}

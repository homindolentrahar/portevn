<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $allowedFields = ['timestamp', 'event_id', 'user_id', 'amount'];

    public function getEvents($userId)
    {
        return $this->db
            ->table('booking')
            ->join('event', 'event.event_id=booking.event_id')
            ->where("booking.user_id", $userId)
            ->get()
            ->getResultArray();
    }
}

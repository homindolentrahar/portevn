<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $allowedFields = ['timestamp', 'event_id', 'user_id', 'amount'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'service_name',
        'service_type',
        'office',
        'client_name',
        'client_contact_no',
        'status',
        'booked_at'
    ];
}
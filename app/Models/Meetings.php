<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'datetime',
        'creator_email',
        'attendee1_email',
        'attendee2_email',
    ];
}

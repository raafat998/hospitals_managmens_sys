<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    protected $fillable = [
        'doctor_id',
        'section_id',
        'name',
        'email',
        'phone',
        'type',
        'appointment',
        'notes',
    ];
}
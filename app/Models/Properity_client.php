<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properity_client extends Model
{
    use HasFactory;

    protected $table = 'client_property';

    protected $fillable = [
        'client_id',
        'property_id',

    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_phone',
        'client_email',
        'role_id',
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'client_property');
    }
}

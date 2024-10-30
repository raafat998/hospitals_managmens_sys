<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;
    protected $fillable = ['renter_name','renter_phone','renter_email','role_id','password','address'] ;
    public function roles(){
        return $this->belongsTo(Role::class);
    }
    public function properties(){
        return $this->hasMany(Property::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Add this property to allow mass assignment
    protected $fillable = ['filename', 'imageable_id', 'imageable_type'];

    // Get the parent imageable model (doctor or other)
    public function imageable()
    {
        return $this->morphTo();
    }
}

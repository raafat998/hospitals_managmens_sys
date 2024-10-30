<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionTranslation extends Model
{
    protected $fillable = ['name','description'];
    public $timestamps = false;
    use HasFactory;
}

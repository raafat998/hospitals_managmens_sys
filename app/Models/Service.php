<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    public $fillable= ['price','description','status'];
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'Service_Group')
                    ->withPivot('quantity') // تأكد من إضافة هذا السطر
                    ->withTimestamps(); // إذا كنت تريد استخدام الطوابع الزمنية
    }

}

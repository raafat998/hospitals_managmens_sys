<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Astrotomic\Translatable\Translatable;

class Doctor extends Authenticatable 
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name', 'appointments'];
    
    protected $fillable = [
        'id',
        'user_id',
        'section_id',
        'role_id',
        'email', 
        'password', 
        'phone',
    ];

    protected $hidden = [ // إضافة الخصائص المخفية
        'password',
        'remember_token',
    ];

    /**
     * Get the Doctor's image (polymorphic relationship).
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // علاقة الطبيب مع القسم
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // علاقة الطبيب مع المواعيد
    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_doctor');
    }

    // علاقة الطبيب مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

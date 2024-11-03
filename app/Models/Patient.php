<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','Address'];
    public $fillable= ['email','password','Date_Birth','phone','Gender','Blood_Group','user_id','role_id'];
 

    protected $hidden = [ 
        'password',
        'remember_token',
    ];
    public function translations()
    {
        return $this->hasMany(PatientTranslation::class);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    
}

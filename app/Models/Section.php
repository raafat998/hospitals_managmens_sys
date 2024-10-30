<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use Translatable; // 2. To add translation methods
    protected $fillable =['name','description'];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name','description'];
    use HasFactory;

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
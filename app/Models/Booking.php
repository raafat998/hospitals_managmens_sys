<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // تحديد الحقول القابلة للتعديل (fillable)
    protected $fillable = [
        'start_date',
        'end_date',
        'total_price',
        'payment_status',
        'client_id',
        'property_id',
    ];


    public static function isDateRangeBooked($propertyId, $startDate, $endDate)
    {
        return self::where('property_id', $propertyId)
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function($query) use ($startDate, $endDate) {
                          $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                      });
            })
            ->exists();
    }

    // العلاقة مع النموذج Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع النموذج Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

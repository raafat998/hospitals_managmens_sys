<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Property;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function testTotalPriceCalculation()
    {
        // إنشاء عقار مع تحديد الاسم والسعر
        $property = Property::create([
            'property_name' => 'ooooooooo',
            'price' => 1000,
            'property_size' => 999, // تأكد من تعيين قيمة هنا
            'garage_size' => 19,
            'rooms' => 4,
            'bathrooms' => 2,
            'availability' => true,
            'description' => 'Sample description',
            'available_from' => now(),
            'renter_id' => 1, // تأكد من وجود قيمة صحيحة أو تعديلها
        ]);
    
        $startDate = '2024-01-01';
        $endDate = '2024-03-31'; // فترة 3 شهور
    
        $expectedTotalPrice = 3 * 1000;
    
        $response = $this->post(route('bookings.store'), [
            'client_id' => 1,
            'property_id' => $property->id,
            'start_date' => '2024-01',
            'end_date' => '2024-03',
            'payment_status' => 'paid',
        ]);
    
        $this->assertDatabaseHas('bookings', [
            'total_price' => $expectedTotalPrice,
        ]);
    }
}

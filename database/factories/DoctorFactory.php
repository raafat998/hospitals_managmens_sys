<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use App\Models\User; // تأكد من استيراد نموذج User
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // إنشاء مستخدم عشوائي مع تعيين role_id
        $user = User::factory()->create([
            'role_id' => 2, // أو أي قيمة مناسبة لrole_id للطبيب
        ]);

        return [
            'user_id' => $user->id, // تعيين user_id للمستخدم الذي تم إنشاؤه
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // كلمة المرور
            'phone' => '0775666647',
            'section_id' => Section::all()->random()->id,
            'role_id' => 2,
        ];
    }
}

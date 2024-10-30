<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // تأكد من استيراد نموذج Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['role_name' => 'admin'],
            ['role_name' => 'user'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        $user = User::create(
            [
                'name' => 'test',
                'email' => 'raafat.hamdan98@gmail.com',
                'password' => bcrypt('2161998rrr'),
                'roles_name'=>['user'],
                'active'=>1,
                'admin' => 0,
                'approved_at' => now(),
        ]);





        // Fake users

    }
}

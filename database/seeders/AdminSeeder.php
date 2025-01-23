<?php

namespace Database\Seeders;


use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the email already exists
    if (!DB::table('admins')->where('email', 'admin@yahoo.com')->exists()) {
        DB::table('admins')->insert([
            'name' => 'admin',
            'mobile' => '012345678',
            'email' => 'admin@yahoo.com',
            'img' => 'path/to/image',
            'password' => bcrypt('password'), // Ensure you hash the password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }




    // $owner->syncRoles(['owners' => 1]);

    }
}

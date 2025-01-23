<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'facebook_link' => 'http://facebook.com/page1',
            'instagram_link' => 'http://instagram.com/page1',
            'whats_up' => '010********',
            'phone' => '01012345678',
            'x_link' => 'http://twitter.com',
            'website' => 'http://website.com',
            'snapchat' => 'http://snapchat.com',
            'tax' => '15',
        ]);
    }
}

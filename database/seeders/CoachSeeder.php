<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\Package;
use App\Models\Category;
use App\Models\Coaching\Coach;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


    $Coach=Coach::create([
        'name' => 'sherif',
        'email' => 'coach@yahoo.com',
        'mobile' => '1234567890',
        'password' => Hash::make('password'),
        'img' => 'path/to/image.jpg',
        'is_active' => true,
        'lng' => 46.6753,
        'lat' => 24.7136,
        'start_time' => "12:00:00",
        'end_time' => "23:00:00",
        'location' => 'Riyadh, Saudi Arabia',
        'city_id' => 1,
        'country_id' => 1,
    ]);
    // $categories=Category::all();
    // $Coach->categories()->attach($categories);
    // // $package = Package::where("type", "club")->latest()->first();
    // // $Club->subscriptions()->create([
    // //     'amount' => $package->price,
    // //     'package_id' => $package->id,
    // //     'start_date' => now(),
    // //     'end_date' => $package->time==-1? null: now()->addMonths($package->time),
    // // ]);



    $Coach=Coach::create([
        'name' => 'mohamed',
        'email' => 'coach@gmail.com',
        'mobile' => '0987654321',
        'password' => Hash::make('password'),
        'img' => 'path/to/image2.jpg',
        'is_active' => false,
        'lng' => 50.5553,
        'lat' => 26.3335,
        'start_time' => "12:00:00",
        'end_time' => "23:00:00",
        'location' => 'Dammam, Saudi Arabia',
        'city_id' => 2,
        'country_id' => 2,
    ]);
    // $Coach->categories()->attach($categories);
    // $package = Package::where("type", "club")->latest()->first();
    // $Coach->subscriptions()->create([
    //     'amount' => $package->price,
    //     'package_id' => $package->id,
    //     'start_date' => now(),
    //     'end_date' => $package->time==-1? null: now()->addMonths($package->time),
    // ]);

    // $Vendor=Vendor::create([
    //     'name' => 'vendor',
    //     'email' => 'vendor@yahoo.com',
    //     'mobile' => '1234567890',
    //     'password' => Hash::make('password'),
    //     'img' => 'path/to/image.jpg',
    //     'is_active' => true,
    //     'lng' => 46.6753,
    //     'lat' => 24.7136,
    //     'location' => 'Riyadh, Saudi Arabia'
    // ]);
    // $package = Package::where("type", "vendor")->latest()->first();
    // // $Vendor->subscriptions()->create([
    // //     'amount' => $package->price,
    // //     'package_id' => $package->id,
    // //     'start_date' => now(),
    // //     'end_date' => $package->time==-1? null: now()->addMonths($package->time),
    // // ]);
    // $Vendor=Vendor::create([
    //     'name' => 'vendor2',
    //     'email' => 'vendor@gmail.com',
    //     'mobile' => '0987654321',
    //     'password' => Hash::make('password'),
    //     'img' => 'path/to/image2.jpg',
    //     'is_active' => false,
    //     'lng' => 50.5553,
    //     'lat' => 26.3335,
    //     'location' => 'Dammam, Saudi Arabia'
    // ]);
    // $Vendor->subscriptions()->create([
    //     'amount' => $package->price,
    //     'package_id' => $package->id,
    //     'start_date' => now(),
    //     'end_date' => $package->time==-1? null: now()->addMonths($package->time),
    // ]);
    // }
}
}

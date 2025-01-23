<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Slider::create(['image' => 'slider1.jpg']);
        Slider::create(['image' => 'slider2.jpg']);
        Slider::create(['image' => 'slider3.jpg']);
    }
}

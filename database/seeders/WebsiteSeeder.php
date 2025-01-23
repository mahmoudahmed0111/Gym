<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\Classe;
use App\Models\Gallery;
use App\Models\LandingSlider;
use App\Models\Link;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $landingslider1 = LandingSlider::create([
            'name' => 'Landing Slider 1',
            'description' => 'Landing Slider 1 Description',
            'img' => 'landingslider/66b8eab34e73b_hero-1.jpg',
        ]);

        $landingslider2 = LandingSlider::create([
            'name' => 'Landing Slider 2',
            'description' => 'Landing Slider 2 Description',
            'img' => 'landingslider/66b8eefe60005_hero-2.jpg',
        ]);

        $team1 = Team::create([
            'name' => 'Mahmoud',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d4af8e637_team-3.jpg'
        ]);

        $team2 = Team::create([
            'name' => 'Mohamed',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d49e25292_team-2.jpg'
        ]);

        $team3 = Team::create([
            'name' => 'zaky',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d486a1304_team-4.jpg'
        ]);

        $team4 = Team::create([
            'name' => 'Nada',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d4e0b6022_team-5.jpg'
        ]);

        $team5 = Team::create([
            'name' => 'malak',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d4ccb3756_team-1.jpg'
        ]);

        $team6 = Team::create([
            'name' => 'shahd',
            'description' => 'Gym Trainer',
            'img' => 'team/66b8d4f004312_team-6.jpg'
        ]);

        $gallery1 = Gallery::create([
            'img' => 'gallery/66b8cb9e34806_gallery-1.jpg'
        ]);

        $gallery2 = Gallery::create([
            'img' => 'gallery/66b8cba8c4d99_gallery-2.jpg'
        ]);

        $gallery3 = Gallery::create([
            'img' => 'gallery/66b8cbafa79eb_gallery-3.jpg'
        ]);

        $gallery4 = Gallery::create([
            'img' => 'gallery/66b8cbb96c9db_gallery-4.jpg'
        ]);

        $gallery5 = Gallery::create([
            'img' => 'gallery/66b8cbc1f16a1_gallery-5.jpg'
        ]);

        $gallery6 = Gallery::create([
            'img' => 'gallery/66b8cbc9d7672_gallery-6.jpg'
        ]);

        $gallery7 = Gallery::create([
            'img' => 'gallery/66b8cbd4e2e3b_gallery-7.jpg'
        ]);

        $gallery8 = Gallery::create([
            'img' => 'gallery/66b8cbe2b4fb3_gallery-8.jpg'
        ]);

        $classe1 = Classe::create([
            'name' => 'cardio 1',
            'description' => 'intell incomming',
            'img' => 'classes/66b8c48a22395_class-1.jpg'
        ]);

        $classe2 = Classe::create([
            'name' => 'cardio 2',
            'description' => 'intell incomming',
            'img' => 'classes/66b8c3dbe3780_class-2.jpg'
        ]);

        $classe3 = Classe::create([
            'name' => 'cardio 3',
            'description' => 'intell incomming',
            'img' => 'classes/66b8c4a405b57_class-3.jpg'
        ]);

        $classe4 = Classe::create([
            'name' => 'cardio 4',
            'description' => 'intell incomming',
            'img' => 'classes/66b8c4baa5c76_class-4.jpg'
        ]);

        $classe5 = Classe::create([
            'name' => 'cardio 5',
            'description' => 'intell incomming',
            'img' => 'classes/66b8c4d21f736_class-5.jpg'
        ]);

        $aboutus = AboutUs::create([
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'video' => 'Video/66bb4b2ebd9a2_mahmoud.mp4'
        ]);

        $link1 = Link::create([
            'name' => 'Facebook',
            'link' => 'https://www.facebook.com',
            'icon' => 'fa fa-facebook'
        ]);

        $link2 = Link::create([
            'name' => 'Instagram',
            'link' => 'https://www.instagram.com',
            'icon' => 'fa fa-instagram'
        ]);

        $link3 = Link::create([
            'name' => 'Twitter',
            'link' => 'https://www.twitter.com',
            'icon' => 'fa fa-twitter'
        ]);

        $testimonial1 = Testimonial::create([
            'name' => 'Mahmoud',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb55b1950b6_team-2.jpg'
        ]);

        $testimonial2 = Testimonial::create([
            'name' => 'Mohamed',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb55c2c4b4b_team-4.jpg'
        ]);

        $testimonial3 = Testimonial::create([
            'name' => 'Zikka',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb5503d0738_team-3.jpg'
        ]);

        $testimonial4 = Testimonial::create([
            'name' => 'Nada',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb55d7ea6b1_team-5.jpg'
        ]);

        $testimonial5 = Testimonial::create([
            'name' => 'tassnem',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb55ec86c43_team-1.jpg'
        ]);

        $testimonial6 = Testimonial::create([
            'name' => 'shahd',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore facilisis.',
            'img' => 'testimonials/66bb560465a8b_team-6.jpg'
        ]);




    }
}

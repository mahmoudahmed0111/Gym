<?php

namespace App\Http\Controllers\Website;

use App\Models\Contact;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Classe;
use App\Models\Gallery;
use App\Models\LandingSlider;
use App\Models\Link;
use App\Models\Package;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function home()
    {
        $landingslider = LandingSlider::get();
        $classes = Classe::get();
        $gallery = Gallery::get();
        $team = Team::get();
        $package = Package::with('features')->get();
        $links = Link::all();
        // return $package ;
        return view('website.index' , compact("landingslider", "classes", "gallery", "team", "package", "links"));
    }
    public function aboutUs()
    {
        $team = Team::get();
        $links = Link::all();
        $aboutus = AboutUs::with('features')->get();
        $testimonials = Testimonial::get();
        return view('website.about-us.index' , compact("team" , "links" , "aboutus" , "testimonials"));
    }
    public function classes()
    {
        $classes = Classe::get();
        $links = Link::all();
        return view('website.classes.index' , compact("classes" , "links"));
    }
    public function services()
    {
        $services = Service::get();
        $links = Link::all();
        $team = Team::get();
        $package = Package::with('features')->get();
        $aboutus = AboutUs::with('features')->get();
        return view('website.services.index' , compact("services" , "links", "team", "package", "aboutus"));
    }
    public function team()
    {
        $team = Team::get();
        $links = Link::all();
        return view('website.team.index' , compact("team" , "links"));
    }
    public function contact()
    {
        $links = Link::all();
        return view('website.contact.index' , compact("links"));
    }

    public function registeration()
    {
        return view('website.registeration.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'msg' => 'required|string',
        ]);


        Contact::create($request->all());
        Session::flash('success_message', ('Thank you for Contacting'));
        // If there are errors
        // toastr()->error('Failed to send message. Please check your inputs.');

        return redirect()->route('home');
    }
    public function gallery()
    {
        $links = Link::all();
        return view('website.gallery.index' , compact("links"));
    }
    public function calculater()
    {
        $links = Link::all();
        return view('website.calculater.index' , compact("links"));
    }
    public function blog()
    {
        $links = Link::all();
        return view('website.blog.index' , compact("links"));
    }
    public function error404()
    {
        return view('website.error.index');
    }


}

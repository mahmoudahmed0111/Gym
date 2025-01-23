<?php

use App\Http\Controllers\Dashboard\ContactsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Website\WebsiteController;





// Website Routes



Route::controller(WebsiteController::class)->group(function () {
    Route::get('/website', 'home')->name('home');
    Route::get('/website/aboutUs', 'aboutUs')->name('website.aboutUs');
    Route::get('/website/classes', 'classes')->name('website.classes');
    Route::get('/website/services', 'services')->name('website.services');
    Route::get('/website/team', 'team')->name('website.team');
    Route::get('/website/contact', 'contact')->name('website.contact');
    Route::post('/website/contact', 'store')->name('website.contact');
    Route::get('/website/gallery', 'gallery')->name('website.gallery');
    Route::get('/website/calculater', 'calculater')->name('website.calculater');
    Route::get('/website/blog', 'blog')->name('website.blog');
    Route::get('/website/error404', 'error404')->name('website.error404');
    Route::get('/website/content', 'content')->name('website.content');
    Route::get('/website/registeration', 'registeration')->name('website.registeration');


});



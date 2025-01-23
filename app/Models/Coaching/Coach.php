<?php

namespace App\Models\Coaching;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Food;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Trainee;
use App\Models\Category;
use App\Models\Training;
use App\Models\TypeCategory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'img',
        'is_active',
        'lng',
        'lat',
        'end_time',
        'start_time',
        'balance',
        'location',
        'country_id',
        'city_id'
    ];






    public function isBookingTimeValid($bookingStartTime, $bookingEndTime)
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);

        $bookingStart = Carbon::parse($bookingStartTime);
        $bookingEnd = Carbon::parse($bookingEndTime);

        return $bookingStart->between($startTime, $endTime) && $bookingEnd->between($startTime, $endTime);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function paymentsFromAdmin()
    // {
    //     return $this->hasMany(AdminToClubPayment::class);
    // }

    // public function supports()
    // {
    //     return $this->morphMany(Support::class, 'owner');
    // }
    // public function subscriptions()
    // {
    //     return $this->morphMany(SubscriptionPackage::class, 'subscribable');
    // }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }


    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_coach');
    }




}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        'cover_img',
        'is_active',
        "type_account",
        "uid",
        "city_id",
    ];

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
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function supports()
    {
        return $this->morphMany(Support::class, 'owner');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }


    public function getClubs()
    {
        $user = Auth::user();
        $clubs = Club::where('city_id', $user->city_id)->get();

        return response()->json([
            'clubs' => $clubs
        ]);
    }

}

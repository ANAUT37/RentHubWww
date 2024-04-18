<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */ 
    protected $fillable = [
        'display_id',
        'email',
        'password',
        'type',
        'phone',
        'phone_code',
        'second_mail',
        'country_code',
        'profile_pic_url',
        'profile_banner_url',
        'last_login',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public static function getDisplayId($userId){
        $displayId = User::where('id', $userId)->value('display_id');
        return $displayId;
    }
    public static function getProfilePic($userId){
        $url = User::where('id', $userId)->value('profile_pic_url');
        return $url;
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}

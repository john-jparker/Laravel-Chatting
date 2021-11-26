<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'last_message',
        'total_unread'
    ];

    public function getLastMessageAttribute()
    {
        return Message::where(function ($query){
            return $query->where('sender_id', auth()->id())
                ->where('receiver_id', $this->attributes['id'])
                ->where('type', Message::Types['Sender']);
        })->orWhere(function ($query){
            return $query->where('sender_id', $this->attributes['id'])
                ->where('receiver_id', auth()->id())
                ->where('type', Message::Types['Receiver']);
        })->orderby('id', 'desc')->first();
    }

    public function getTotalUnreadAttribute()
    {
        return Message::where('sender_id', $this->attributes['id'])
            ->where('receiver_id', auth()->id())
            ->where('type', Message::Types['Receiver'])
            ->where('read_at', null)->count();
    }
}

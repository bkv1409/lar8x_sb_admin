<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use LogsActivity;

    public static $STATUS = [
        'ENABLED' => 1,
        'DISABLED' => 0,
    ];

    public static $DEFAULT_AVATAR = '/adminlte/img/user4-128x128.jpg';

    public static $COMMON_VALIDATE_ARRAY = [
        'name'     => 'required',
//        'email'    => 'required|email|unique:users,email,' . $user->id,
//            'img_link' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'img_link' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'job' => 'nullable|max:100',
        'bio' => 'nullable|max:255',
        'skills' => 'nullable|max:255',
        'experience' => 'nullable|max:255',
    ];

    public static $PASSWORD_VALIDATE_ARRAY = [
//        'password' => 'same:confirm-password',
        'password' => [
            'required',
            'string',
            'min:8',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'same:confirm_password'
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


}

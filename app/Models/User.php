<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',           // Added
        'staff_number',       // Added
        'admission_number',   // Added
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
        'password' => 'hashed',
    ];

    /**
     * Get the user profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * Method to find a user by various credentials.
     */
    public static function findUserByCredential($credential)
    {
        return self::where(function($query) use ($credential) {
            $query->where('email', $credential)
                  ->orWhere('username', $credential)
                  ->orWhere('staff_number', $credential)
                  ->orWhere('admission_number', $credential);
        })->first();
    }
}

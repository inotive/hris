<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\SearchTrait;
use Faker\Core\Uuid as CoreUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

use function Ramsey\Uuid\v4;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasUuids;

    use SearchTrait;

    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'image',
        'company_id',
    ];

    public $rules = [
        'image' => '',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'role'  => 'required',
        'company_id'  => '',
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

    public static function role_options()
    {
        return [
            'superadmin'    => __('Superadmin'),
            'admin'    => __('Admin'),
            'finance'    => __('Finance'),
            'content'    => __('Content'),
        ];
    } 

    public static function boot()
    {
        parent::boot();

        static::creating(function($row){
          if ($row->password == null)  $row->password = bcrypt(rand(100000,999999) . uniqid());
        });
    }

    public function role_label()
    {
        return self::role_options()[$this->role] ?? '-';
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

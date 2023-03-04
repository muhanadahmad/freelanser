<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'password',
        'status'
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

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
            ->withDefault();
    }

    public static function rules($id = 0){
        return
        [
            'name' => 'required|string|min:5|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function scopeFilter(Builder $builder,$filter){
        if($filter['name'] ?? null){
            $builder->where('name',$filter['name']);
         }

         if($filter['status'] ?? null){
            $builder->where('status',$filter['status']);
         }

    }

  
}

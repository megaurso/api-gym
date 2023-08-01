<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->{$user->getKeyName()} = Uuid::uuid4()->toString();
            $user->ativo = false;
        });
    }

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'isAdmin',
        'phone'
        
    ];

  
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function gymPlans()
    {
        return $this->belongsToMany(GymPlan::class, 'user_gym_plan', 'user_id', 'gym_plan_id');
    }

    public function currentPlan()
    {
        return $this->belongsTo(GymPlan::class, 'current_plan');
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

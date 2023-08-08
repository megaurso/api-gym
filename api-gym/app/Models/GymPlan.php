<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class GymPlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'gym_plans';
    public $incrementing = false;
    protected static function booted()
    {
        static::creating(function ($plans) {
            $plans->{$plans->getKeyName()} = Uuid::uuid4()->toString();
        });
    }

    public function users()
    {
        return $this->hasMany(User::class, 'current_plan');
    }

    protected $fillable = [
        'name',
        'validity',
        'price'        
    ];

}

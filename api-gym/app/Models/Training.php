<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Training extends Model
{
    use SoftDeletes,HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'trainings';
    public $incrementing = false;
    protected static function booted()
    {
        static::creating(function ($workingOut) {
            $workingOut->{$workingOut->getKeyName()} = Uuid::uuid4()->toString();
            $workingOut->horario_entrada = now();
        });
    }


    protected $fillable = ['user_id'];

    protected $dates = ['horario_entrada', 'horario_saida', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
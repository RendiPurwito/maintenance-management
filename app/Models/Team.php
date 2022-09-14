<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setMemAttribute($value)
    {
        $this->attributes['user_id'] = json_encode($value);
    }

    public function getMemAttribute($value)
    {
        return $this->attributes['user_id'] = json_decode($value);
    }
}

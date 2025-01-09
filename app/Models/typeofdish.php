<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class typeofdish extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'typeofdish';

    public $timestamps = true;

    public function dish()
    {
        return $this->hasMany(dish::class, 'typeofdish_id', 'id');
    }
}
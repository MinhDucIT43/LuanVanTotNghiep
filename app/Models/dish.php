<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class dish extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'dish';

    public $timestamps = true;

    public function typeofdish()
    {
        return $this->belongsTo(typeofdish::class, 'typeofdish', 'id');
    }
}

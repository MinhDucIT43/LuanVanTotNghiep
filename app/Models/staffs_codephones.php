<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class staffs_codephones extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'staffs_codephones';

    public $timestamps = true;
}

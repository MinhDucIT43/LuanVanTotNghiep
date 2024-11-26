<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class staffs extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'staffs';

    public $timestamps = true;

    protected $primaryKey = 'staff_code';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function positions()
    {
        return $this->belongsTo(positions::class, 'position_code', 'position_code');
    }

    public function codephones()
    {
        return $this->belongsToMany(codephones::class);
    }
}

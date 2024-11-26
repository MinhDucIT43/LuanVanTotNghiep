<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class positions extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'positions';

    public $timestamps = true;

    protected $primaryKey = 'position_code';

    public function staffs()
    {
        return $this->hasMany(staffs::class, 'position_code', 'position_code');
    }
}
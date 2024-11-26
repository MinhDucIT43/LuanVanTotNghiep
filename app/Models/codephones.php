<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class codephones extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'codephones';

    protected $primaryKey = 'codephone_code';

    public $timestamps = true;

    public function staffs()
    {
        return $this->belongsToMany(staffs::class);
    }
}

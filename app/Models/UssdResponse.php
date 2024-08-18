<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdResponse extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'response'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}

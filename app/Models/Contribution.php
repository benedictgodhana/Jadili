<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'description', 'amount', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

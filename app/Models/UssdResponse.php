<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdResponse extends Model
{
    use HasFactory;

    protected $table = 'ussd_responses';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'ussd_flow_step_id',
        'response',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ussdFlowStep()
    {
        return $this->belongsTo(UssdFlowStep::class, 'ussd_flow_step_id');
    }
}

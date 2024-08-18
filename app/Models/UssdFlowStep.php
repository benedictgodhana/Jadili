<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdFlowStep extends Model
{
    use HasFactory;

    protected $table = 'ussd_flow_steps';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'ussd_flow_id',
        'step_number',
        'message',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function ussdFlow()
    {
        return $this->belongsTo(UssdFlow::class, 'ussd_flow_id');
    }

    public function ussdResponses()
    {
        return $this->hasMany(UssdResponse::class, 'ussd_flow_step_id');
    }


}

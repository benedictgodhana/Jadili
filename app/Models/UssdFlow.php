<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdFlow extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'ussd_flows';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if not used
    public $timestamps = true;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'flow_name',
        'description',
    ];

    // Define the date format for the model's attributes
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Define relationships if applicable
    

    public function ussdFlowSteps()
    {
        return $this->hasMany(UssdFlowStep::class, 'ussd_flow_id');
    }
}

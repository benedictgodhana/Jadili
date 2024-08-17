<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensitizationCampaign extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'sensitization_campaigns';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if not used
    public $timestamps = true;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    // Define the date format for the model's attributes
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}

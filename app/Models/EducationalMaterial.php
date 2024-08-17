<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalMaterial extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'educational_materials';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if not used
    public $timestamps = true;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'file_path',
    ];
}

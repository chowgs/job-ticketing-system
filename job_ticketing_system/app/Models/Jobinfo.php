<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobinfo extends Model
{
    use HasFactory;

    protected $table = 'job_info';

    protected $fillable = [
        'name',
        'email',
        'number',
        'department',
        'problem_statement',
        'requests',
        'attending_personnel',
        'remarks',
        'created_at',
        'date_returned',
        'datetime_started',
        'datetime_accomplished',
        'transaction_code',
        'status',
        'reason',
        'no_units',

    ];

}

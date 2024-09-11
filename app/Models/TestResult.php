<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'course',
        'quest1', 'quest2', 'quest3',
        'correct1', 'correct2', 'correct3',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Model create(array $attributes = [])
 * @method static orderBy(string $string, string $string1)
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['theme', 'message', 'image'];
}

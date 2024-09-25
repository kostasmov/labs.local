<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Model create(array $attributes = [])
 * @method static orderBy(string $string, string $string1)
 * @method static findOrFail(mixed $postID)
 * @method static find(mixed $postID)
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['theme', 'message', 'image'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

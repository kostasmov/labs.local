<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $blog_id
 * @property mixed $comment
 * @property int $user_id
 * @property mixed $created_at
 * @property User $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'user_id', 'comment'];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpParser\Node\Expr\Array_;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type'];

    protected $hidden = ['created_at', 'updated_at'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre_relations', 'book_id', 'genre_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

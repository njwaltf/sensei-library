<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'comment_text'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        // wan tu wan
        return $this->belongsTo(Book::class);
    }
    use HasFactory;
}

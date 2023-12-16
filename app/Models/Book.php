<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public function scopeSearch($query, $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('desc', 'like', "%$keyword%")
                    ->orWhere('writer', 'like', "%$keyword%")
                    ->orWhere('publisher', 'like', "%$keyword%");
            });
        });
    }

    public function scopeFilterByGenre($query, $genreId)
    {
        return $query->when($genreId, function ($query, $genreId) {
            $query->where('type_id', $genreId);
        });
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    use HasFactory;
}

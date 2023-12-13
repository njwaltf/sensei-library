<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [
        'id'
    ];
    // protected $fillable = [
    //     '','','','','','','',
    // ]

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forfeit extends Model
{
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        // wan tu wan
        return $this->belongsTo(Book::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    use HasFactory;
}

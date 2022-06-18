<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "cantidad",
        "tipo",
        "acomodacion",
        "hotel_id"
    ];

    /**
     * It returns the hotel that is associated with the room.
     * 
     * @return The hotel model
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hoteles','hotel_id');
    }
}

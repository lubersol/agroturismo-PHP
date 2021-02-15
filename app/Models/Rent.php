<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    public $table = 'rents';
    public $timestampstimestamps = false;

    protected $fillable = [
        'startDate',
        'endDate',
        'room_id',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class); // Muchos a muchos
    }
}

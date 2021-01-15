<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    

    protected $guarded = [];
    
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function rooms(){
        return $this->belongsToMany(Room::class,'rent_room','rent_id','room_id'); // Muchos a muchos
    }
    
}

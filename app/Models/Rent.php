<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function rooms(){
        return $this->belongsToMany(Room::class); // Muchos a muchos
    }
    
}

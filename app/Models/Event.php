<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date_event',
        'place',
        'nbr_place',
        'place_dispo',
        'status',
        'category_id',
    ];

    public function category(){
        $this->hasOne(Category::class);
    }

    public function users_reservation(){
        return $this->BelongsToMany(User::class,'reservations'); 
    }

}

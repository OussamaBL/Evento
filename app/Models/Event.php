<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{

    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'date_event',
        'price',
        'place',
        'nbr_place',
        'place_dispo',
        'status',
        'duration',
        'category_id',
        'user_id',
    ];

    public function category(){
       return $this->belongsTo(Category::class);
    }

    public function users_reservation(){
        return $this->BelongsToMany(User::class,'reservations'); 
    }
    public function organizer(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function image()
    {
        return $this->hasOne(Media::class)->where('collection_name', 'images');
    }

}

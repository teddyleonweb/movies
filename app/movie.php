<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class movie extends Model
{
    protected $fillable =[
        'user_id', 'category_id', 'name', 'slug', 'extracto','sinopsis', 'file'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categoria(){
        
        return $this->belongsTo('App\categoria','category_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categoria extends Model
{
    protected $fillable =[
        'name','slug'
    ];

    public function movies(){
        return $this->HasMany(movie::class);
    }


    //
}

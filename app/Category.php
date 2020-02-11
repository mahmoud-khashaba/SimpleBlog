<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Category extends Model
{
    use UUId;
    

    public $incrementing = false;
    
    protected $casts = [
        'id' =>'string'
    ];

     protected $fillable = [
        'name'
    ];


     public function articles()
    {
        return $this->belongsToMany(Article::class, 'category_article');
    }

}

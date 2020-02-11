<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use UUId;



    public $incrementing = false;
    
    protected $casts = [
        'id' =>'string'
    ];

     protected $fillable = [
        'title', 'content'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_article');
    }

    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
}

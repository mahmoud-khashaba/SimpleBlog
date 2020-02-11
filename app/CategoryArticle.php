<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class CategoryArticle extends Model
{

    use UUId;

	protected $table = 'category_article';

    public $incrementing = false;
    
    protected $casts = [
        'id' =>'string',
	    'category_id' =>'string',
	   	'article_id' =>'string',
    ];

}

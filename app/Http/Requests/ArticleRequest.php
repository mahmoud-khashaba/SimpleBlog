<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Article;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::guard()->check())
        {
            return abort(403, 'Access denied');
        }else
        {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:1|max:191',
            'contents'=>'required|min:1',
            'categories'=>'required|array|min:1',
            'categories.*' =>'min:1'
        ];
    }

     public function store()
    {


        $article = new Article();
        $article->title = $this->title;
        $article->content = $this->contents;
        $article->user_id = Auth::guard()->user()->id;
        $article->slug = str_slug($this->title);
       

         while(Article::where('slug',$article->slug)->first())
        {
            $article->slug .= '-' . str_random(2);
        }
        $article->save();
        $article->refresh();

         if(is_array($this->categories) && count($this->categories))
        {

            $article->categories()->attach($this->categories);
        }
    }
    
     public function edit($slug = false)
    {


        $article = Article::where('slug',$slug)->firstOrFail();
        if($article->title != $this->title)
        {
            $article->slug = str_slug($this->title);
             while(Article::where('slug',$article->slug)->first())
            {
                $article->slug .= '-' . str_random(2);
            }

        }
        
         if(is_array($this->categories) && count($this->categories))
        {

            $article->categories()->attach($this->categories);

        }

        $article->title = $this->title;
        $article->content = $this->contents;
        $article->save();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use View;
use Auth;

class ArticleController extends Controller
{
	public function index()
	{
		$categories = Category::all();

		$articles = Article::where('published',1)->with('categories')->latest()->paginate(10);
		
		return view('home',compact('articles','categories'));

	} 

	public function show($slug)
	{	
			$article = Article::where('slug',$slug)->firstOrFail();
			return View::make('single')->with('article',$article);
	}

	public function getEdit($slug)
	{
		$article = Article::where('slug',$slug)->firstOrFail();
        $categories = Category::all();

		$user = Auth::guard()->user();

		if ($user->can('update',$article))
		{
		return view('edit',compact('article','categories'));

		}else 
		{
			return abort(403, 'Access denied');

		}
	}

	public function postEdit($slug,ArticleRequest $request)
	{
		$article = Article::where('slug',$slug)->firstOrFail();

		$user = Auth::guard()->user();

		if ($user->can('update',$article))
		{
			$request->edit();
		    return redirect('/');

		}else 
		{
			return abort(403, 'Access denied');

		}

	}

	public function getCreate()
	{
		if(!Auth::guard()->check())
        {
        	return abort(403, 'Access denied');

        }
        $categories = Category::all();
        return View::make('create')->with('categories',$categories);
	}

	public function postCreate(ArticleRequest $request)
	{
        if(!Auth::guard()->check())
        {
        	return abort(403, 'Access denied');

        }

        $request->store();
        return redirect('/');

	}

	public function delete($slug)
	{
		$article = Article::where('slug',$slug)->firstOrFail();

		$user = Auth::guard()->user();

		if ($user->can('delete',$article))
		{
			$article->delete();
			return redirect('/');
		}else 
		{
			return abort(403, 'Access denied');

		}
		
	}
	public function byCategory($slug)
	{
		$category = Category::where('slug',$slug)->firstOrFail();

		$articles = $category->articles()->where('published',1)->distinct()->latest()->paginate(10);

		return view('by_category',compact('articles','category'));

	}
}

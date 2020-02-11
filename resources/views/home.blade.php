@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Articles</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!count($articles))
                    {{'there\'s no articles in the right moment you can create following this link'}}
                    <a href="{{ url('/create') }}" >create</a>
                    @endif
                    @foreach($articles as $article)
                        <div class="card" style="width: 18rem;">
                          <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text">{{$article->content}}</p>
                            <a href="{{ url('/update', ['slug' => $article->slug]) }}" class="card-link">edit</a>
                            <a href="{{ url('/show', ['slug' => $article->slug]) }}" class="card-link">show</a>
                            <form action="{{ url('/delete', ['slug' => $article->slug]) }}" method="post">
                                <input class="btn btn-default" type="submit" value="Delete" />
                                @method('delete')
                                @csrf
                            </form>
                          </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-body">
                   @foreach($categories as $category)
                    <div class="card" style="width: 18rem;">
                          <div class="card-body">
                            <h5 class="card-title">see posts categorized as {{$category->name}}</h5>
                            <a href="{{ url('/category', ['slug' => $category->slug]) }}" class="card-link">here</a>
                          </div>
                        </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

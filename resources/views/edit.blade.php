@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">edit {{$article->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <form action="{{ url('/update', ['slug' => $article->slug]) }}" method="post">
                                <input class="form-control" value="{{$article->title}}" name="title" placeholder="title" />
                                 @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input class="form-control"  value="{{$article->content}}" name="contents" placeholder= "contents" />
                                @error('contents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @php
                                $existing_cats = [];
                                foreach($article->categories()->pluck('name') as $cat)
                                {
                                    $existing_cats[] = $cat;
                                }

                                
                                @endphp
                                <select class="custom-select" name="categories[]" multiple>
                                    <option  value="">choose from categories</option>
                                    @foreach($categories as $category)
                                    <option 

                                    @if(in_array($category->name,$existing_cats)) 
                                    selected 

                                    @endif 
                                     value="{{$category->id}}">{{$category->name}}</option>

                                    @endforeach
                                </select>
                                 @error('categories[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input class="btn btn-primary mx-auto" type="submit" value="update" />
                                @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

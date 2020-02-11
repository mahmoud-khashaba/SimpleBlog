@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Article {{$article->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

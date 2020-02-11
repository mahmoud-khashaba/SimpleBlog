@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create an Article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <form action="{{ url('/create') }}" method="post">
                                <input class="form-control" name="title" placeholder="title" />
                                <input class="form-control" name="contents" placeholder= "content" />

                                <select class="custom-select" name="categories[]" multiple>
                                    <option selected value="">choose from categories</option>
                                    @foreach($categories as $category)
                                    <option  value="{{$category->id}}">{{$category->name}}</option>

                                    @endforeach
                                </select>
                                <input class="btn btn-primary mx-auto" type="submit" value="create" />
                                @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

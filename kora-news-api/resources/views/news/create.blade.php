@extends('layouts.main')

@section('content')

<div class="container main-container">
    <form action="{{url('news')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <h3 class="text-center mb-4 font-weight-bold">Add News</h3>
            <input type="text" name="title" class="form-control mb-3" value="{{old('title')}}" placeholder="News Title*">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea name="content" placeholder="Write News Contnet*" value="{{old('content')}}" rows="10" class="form-control mb-3"></textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input multiple type="file" name="images[]" class="mb-3">
            @error('images')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <h4 class="mb-3" style="font-family: monospace">Choose the News Tags</h4>
            <select multiple name="tags[]" class="form-control mb-3">
                @foreach ($tags as $tag)
                    <option value="{{$tag['id']}}">{{$tag['name']}}</option>
                @endforeach
            </select>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-primary btn-block mt-5">ADD</button>
        </div>

    </form>
</div>

@endsection('content')
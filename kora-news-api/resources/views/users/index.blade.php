@extends('layouts.main')

@section('content')
    <div class="container main-container d-flex flex-column align-items-center">
        @foreach ($news as $new)
            {{ $new['title'] }}
            <br/>
            {{$new['tags'][0]['name']}}
        @endforeach
        <div class="mt-5">
            {{ $news->links() }}
        </div>
        
    </div>

    
@endsection

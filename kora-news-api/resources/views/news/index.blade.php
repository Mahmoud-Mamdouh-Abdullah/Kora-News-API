@extends('layouts.main')

@section('content')

    <div class="container main-container">

        <a href="{{ url('news/create') }}" class="btn btn-primary btn-block mb-3">Add news</a>
        <table class="table table-bordered">
            <thead>
                <tr class="row">
                    <th class="col-lg-1">&nbsp#</th>
                    <th class="col-lg-4">
                        <div class="btn-group">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-expanded="false">
                                    title
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ url('news/sort/desc') }}">Sort desc</a></li>
                                    <li><a class="dropdown-item" href="{{ url('news/sort/asc') }}">Sort asc</a></li>
                                    <li><a class="dropdown-item" href="{{ url('news') }}">Default</a></li>
                                </ul>
                            </div>
                    </th>
                    <th class="col-lg-1">tags</th>
                    <th class="col-lg-2">username</th>
                    <th class="col-lg-2">image</th>
                    <th class="col-lg-2">actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($news_list as $news)
                    <tr class="row">
                        <th class="col-lg-1">&nbsp{{ $i }}</th>
                        <td class="col-lg-4">{{ $news['title'] }}</td>
                        <td class="col-lg-1">
                            @foreach ($news['tags'] as $tag)
                                - {{ $tag['name'] }} <br>
                            @endforeach
                        </td>
                        <td class="col-lg-2">{{ $news['user']['name'] }}</td>
                        <th class="col-lg-2">
                            @if (count($news['images']) > 0)
                                <img width="100px" height="100px" src="{{ url('storage/' . $news['images'][0]['url']) }}">
                            @endif
                        </th>
                        <td class="col-lg-2">
                            <div class="col-lg-12">
                                <a href="{{ url('news/' . $news['id'] . '/edit') }}" class="btn btn-primary">Edit</a>
                                <form action="{{ url('news/' . $news['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mt-3">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        {{ $news_list->links() }}
    </div>

@endsection('content')

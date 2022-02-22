@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$category->name}}</h2>
                </div>

                <div class="card-body">
                    {{-- slug --}}
                    <div>
                        Slug : {{$category->slug}}
                    </div>

                    {{-- azioni --}}
                    <div class="mt-4 d-flex">
                        {{-- bottone modifica --}}
                        <a href="{{route("categories.edit", $category->id)}}"><button type="button" class="btn btn-warning mr-2">modifica</button></a>
                        {{-- bottone elimina --}}
                        <form action="{{route("categories.destroy", $category->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">elimina</button>
                        </form>
                    </div>

                    {{-- post associati --}}
                    @if (count($category->posts) > 0 )
                        <div class="mt-5">
                            Post associati: 
                            <ul>
                                @foreach ($category->posts as $post)
                                    <li>{{$post->title}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
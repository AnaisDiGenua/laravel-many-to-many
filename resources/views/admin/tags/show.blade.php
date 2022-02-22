@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$tag->name}}</h2>
                </div>

                <div class="card-body">
                    {{-- slug --}}
                    <div>
                        Slug : {{$tag->slug}}
                    </div>

                    {{-- azioni --}}
                    <div class="mt-4 d-flex">
                        {{-- bottone modifica --}}
                        <a href="{{route("tags.edit", $tag->id)}}"><button type="button" class="btn btn-warning mr-2">modifica</button></a>
                        {{-- bottone elimina --}}
                        <form action="{{route("tags.destroy", $tag->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">elimina</button>
                        </form>
                    </div>

                    {{-- post associati --}}
                    @if (count($tag->posts) > 0 )
                        <div class="mt-5">
                            Post associati: 
                            <ul>
                                @foreach ($tag->posts as $post)
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
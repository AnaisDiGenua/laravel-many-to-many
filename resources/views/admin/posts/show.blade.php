@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$post->title}}</h2>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        @if ($post->published)
                            <span class="badge badge-success">pubblicato</span>
                        @else
                            <span class="badge badge-secondary">bozza</span>
                        @endif
                        @if ($post->category)
                        <span class="badge badge-info">{{$post->category->name}}</span>
                        @endif
                    </div>
                    {{$post->content}}
                    <div class="mt-3">
                        @if ($post->image)
                            <img src="{{asset("storage/{$post->image}")}}" alt="{{$post->title}}" width="300">
                        @endif
                    </div>
                    <div class="mt-5 d-flex">
                        {{-- bottone modifica --}}
                        <a href="{{route("posts.edit", $post->id)}}"><button type="button" class="btn btn-warning mr-2">modifica</button></a>
                        {{-- bottone elimina --}}
                        <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
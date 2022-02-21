@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista posts</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route("posts.create")}}"><button type="button" class="btn btn-info">aggiungi post</button></a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Stato</th>
                                <th scope="col">Azione</th>
                                <th scope="col">Azione</th>
                                <th scope="col">Azione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th >{{$post->id}}</th>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->slug}}</td>
                                    <td class="text-center">
                                        @if ($post->category)
                                            <span class="badge badge-info">{{$post->category->name}}</span>
                                        @else
                                        <span class="badge badge-secondary">nessuna</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($post->published)
                                            <span class="badge badge-success">pubblicato</span>
                                        @else
                                            <span class="badge badge-secondary">bozza</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- bottone visualizza --}}
                                        <a href="{{route("posts.show", $post->id)}}"><button type="button" class="btn btn-primary">visualizza</button></a>
                                    </td>
                                    <td>
                                        {{-- bottone modifica --}}
                                        <a href="{{route("posts.edit", $post->id)}}"><button type="button" class="btn btn-warning">modifica</button></a>
                                    </td>
                                    <td>
                                        {{-- bottone elimina --}}
                                        <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
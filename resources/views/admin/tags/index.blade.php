@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista tags</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route("tags.create")}}"><button type="button" class="btn btn-info">aggiungi tag</button></a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Azione</th>
                                <th scope="col">Azione</th>
                                <th scope="col">Azione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <th >{{$tag->id}}</th>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->slug}}</td>
                                    <td>
                                        {{-- bottone visualizza --}}
                                        <a href="{{route("tags.show", $tag->id)}}"><button type="button" class="btn btn-primary">visualizza</button></a>
                                    </td>
                                    <td>
                                        {{-- bottone modifica --}}
                                        <a href="{{route("tags.edit", $tag->id)}}"><button type="button" class="btn btn-warning">modifica</button></a>
                                    </td>
                                    <td>
                                        {{-- bottone elimina --}}
                                        <form action="{{route("tags.destroy", $tag->id)}}" method="POST">
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
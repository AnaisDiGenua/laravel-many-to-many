@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Nuovo tag</h2>
                </div>

                <div class="card-body">
                    <form action="{{route("tags.store")}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del tag" value="{{old('name')}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- bottone crea --}}
                        <button type="submit" class="btn btn-primary">crea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
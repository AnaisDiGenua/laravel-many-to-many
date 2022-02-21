@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Nuovo post</h2>
                </div>

                <div class="card-body">
                    <form action="{{route("posts.store")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title')}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Contenuto</label>
                            <textarea type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" placeholder="Inserisci il contenuto">{{old('content')}}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                <option value=""}}>Seleziona una categoria</option>
                                @foreach ($categories as $category) {
                                    <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                }
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" {{old('published') ? "checked" : ""}}>
                            <label class="form-check-label" for="published">Pubblica</label> 
                            @error('published')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <img id="uploadPreview" src="https://via.placeholder.com/300x200" width="100">
                            <label for="image">Aggiungi immagine</label>
                            <input type="file" id="image" name="image">
                            {{-- script per la preview dell'immagine --}}
                            <script type="text/javascript">

                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("image").files[0]);
                            
                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                                    };
                                };
                            
                            </script> 
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
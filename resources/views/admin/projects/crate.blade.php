@extends('layouts/admin')

@section('content')

<form action="{{route('admin.projects.store')}}" method="POST" class="py-5" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title">Titolo</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="cover_image">Imagine del Progetto</label>
        <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
        @error('cover_image')
        <div class="invalid-feedback">
          {{$message}}
        </div>    
      @enderror
    </div>

    <div class="mb-3">
        <label for="description">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')}}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thumb">Link repo</label>
        <input class="form-control @error('thumb') is-invalid @enderror" type="text" name="thumb" id="thumb"  value="{{old('thumb')}}">
        @error('thumb')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="category_id">Categoria</label>
        <select class="form-select " aria-label="Default select example" name="category_id" id="category_id" >
            <option value="">Nessuna</option>
            @foreach($categories as $category){
                <option value="{{$category->id}}" >{{$category->name}}</option>
            }
            @endforeach
        </select> 
    </div>

    <div class="mb-3 form-group">
        <h4>technologies</h4>
  
        @foreach($technologies as $tag)
        <div class="form-check">                                                                       
          <input type="checkbox" id="tag-{{$tag->id}}" name="technologies[]" value="{{$tag->id}}" @checked(in_array($tag->id , old('technologies',[])))>
          <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
        </div>
        @endforeach
  
      </div>

    <button type="submit" class="btn btn-primary">Aggiungi</button>

    
</form>
@endsection

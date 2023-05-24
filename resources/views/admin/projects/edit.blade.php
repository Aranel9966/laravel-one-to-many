@extends('layouts/admin')

@section('content')

<form action="{{route('admin.projects.store')}}" method="POST" class="py-5">
    @csrf

    <div class="mb-3">
        <label for="title">Titolo</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title')?? $project->title}}">
        @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')?? $project->description}}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="thumb">Link repo</label>
        <input class="form-control @error('thumb') is-invalid @enderror" type="text" name="thumb" id="thumb"  value="{{old('thumb')?? $project->thumb}} ">
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
                <option value="{{$category->id}}" {{$category->id == old('category_id', $project->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
            }
            @endforeach
        </select> 
    </div>
    

    <button type="submit" class="btn btn-primary">Aggiungi</button>

    
</form>
@endsection

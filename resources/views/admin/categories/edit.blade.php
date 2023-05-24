@extends('layouts/admin')

@section('content')

<form action="{{route('admin.categories.store')}}" method="POST" class="py-5">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name">Nome</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name')?? $category->name}}">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description">Descrizione</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{old('description')?? $category->description}}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    


    <button type="submit" class="btn btn-primary">Aggiungi</button>

</form>
@endsection

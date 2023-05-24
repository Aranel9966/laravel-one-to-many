@extends('layouts/admin')

@section('content')

<div class="main pt-5 ">
  <h1>{{$category->name}}</h1>
  <hr>
  <p>{{$category->description}}</p>
  <p>{{$category->slug}}</p>
</div>

<div class="d-flex justify-content-between m-5">
  <a href="{{route('admin.categories.edit', $category)}}" class="btn btn-primary">Modifica la categoria</a>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Elimina
  </button>
</div>


<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare il post "{{$category->name}}"
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
          @csrf
          @method('DELETE')
        
          <button type="submit" class="btn btn-danger">Elimina il post</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
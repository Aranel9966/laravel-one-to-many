@extends('layouts/admin')

@section('content')

<div class="main pt-5 ">
  <h1>{{$project->title}}</h1>
  <hr>
  <img class="w-25" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
  <h3>{{$project->category?->name}}</h3>

  <p>
    @foreach($project->technologies as $tag)
    <span class="badge rounded-pill mx-1" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
    @endforeach
  </p>

  <p>{{$project->description}}</p>

  <a href="{{$project->thumb}}" target="_blank">{{$project->thumb}}</a>
</div>

<div class="d-flex justify-content-between m-5">
  <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary">Modifica il post</a>
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
        Sei sicuro di voler eliminare il post "{{$project->title}}"
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
          @csrf
          @method('DELETE')
        
          <button type="submit" class="btn btn-danger">Elimina il progetto</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts/admin')

@section('content')

{{-- <form action="{{route('admin.projects.index')}}" method="GET">
  @csrf
  <label for="title">search</label>
  <input type="text" name="title" id="title">
  <button type="submit"> cerca</button>
</form> --}}



<table class="mt-5 table table-striped">
  <thead>
    <th>
      Titolo
    </th>
    <th>
      Categoria
    </th>
    <th>
      Descrizione
    </th>
    <th>
      Link-repo
    </th>
    <th>
      slag
    </th>
    <th>
      Categorie
    </th>
  </thead>

  <tbody>
    {{-- {{dd($projects->categories)}} --}}


    @foreach($projects as $project)
    <tr >
      <td>{{$project->title}}</td>

      <td>{{ $project->category?->name}}</td>

      <td>{{$project->description}}</td>

      <td> <a href="{{$project->thumb}}">{{$project->thumb}}</a> </td>

      <td>{{$project->slug}}</td>

      <td>
        {{-- {{dd($project->technologies)}} --}}
        @foreach($project->technologies as $tag)
            <span class="badge rounded-pill mx-1" style="background-color: {{$tag->color}}">{{$tag->name}}</span>
            @endforeach
      </td>

      <td><a href="{{route('admin.projects.show', $project->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>

    </tr>
    @endforeach

    {{-- <div class="container text-center py-5">
      <a class="btn btn-primary" href="{{route('admin.projects.create')}}">Aggiungi un progetto</a>
    </div> --}}

  </tbody>
</table>
@endsection
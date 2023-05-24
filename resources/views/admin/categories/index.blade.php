@extends('layouts/admin')

@section('content')

<table class="mt-5 table table-striped">
  <thead>
    <th>
      Nome
    </th>
    <th>
      Descrizione
    </th>
    <th>
      slag
    </th>
  </thead>

  <tbody>

    @foreach($categories as $category)
    <tr >
      <td>{{$category->name}}</td>
      <td>{{$category->description}}</td>
      {{-- <td> <a href="{{$category->thumb}}">{{$category->thumb}}</a> </td> --}}
      <td>{{$category->slug}}</td>
      <td><a href="{{route('admin.categories.show', $category->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
    </tr>
    @endforeach

    {{-- <div class="container text-center py-5">
      <a class="btn btn-primary" href="{{route('admin.categorys.create')}}">Aggiungi un progetto</a>
    </div> --}}

  </tbody>
</table>
@endsection
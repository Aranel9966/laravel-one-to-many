@extends('layouts/admin')

@section('content')

<table class="mt-5 table table-striped">
  <thead>
    <th>
      Nome
    </th>
    <th>
      slag
    </th>
  </thead>

  <tbody>

    @foreach($technologies as $item)
    <tr >
      <td>{{$item->name}}</td>
      <td>{{$item->slug}}</td>
      <td><a href="{{route('admin.technologies.show', $item->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
    </tr>
    @endforeach

    {{-- <div class="container text-center py-5">
      <a class="btn btn-primary" href="{{route('admin.items.create')}}">Aggiungi un progetto</a>
    </div> --}}

  </tbody>
</table>
@endsection
@extends('layouts/admin')

@section('content')

<form action="{{route('admin.technologies.store')}}" method="POST" class="py-5">
    @csrf

    <div class="mb-3">
        <label for="name">Nome</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">Aggiungi</button>

</form>
@endsection

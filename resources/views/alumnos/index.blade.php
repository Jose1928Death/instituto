@extends('plantillas.plantilla')
@section('titulo')
instituto
@endsection
@section('cabecera')
Instituto
@endsection
@section('contenido')
@if($text=Session::get("mensaje"))
    <p class="bg-secondary text-white p-2 my-3">{{$text}}</p>
@endif
<a href="{{route('alumnos.create')}}"  class="btn btn-dark mb-3"><i class="fa fa-plus"></i> Crear Alumno</a>
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Email</th>
        <th scope="col">Foto</th>
        <th scope="col">Telefono</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($alumnos as $item)
        <tr style="vertical-align: middle">
        <td>{{$item->nombre}}</td>
        <td>{{$item->apellidos}}</td>
        <td>{{$item->email}}</td>
        <td><img src="{{asset($item->foto)}}" width="95rem" height="90rem" class="rounded-circe"></td>
        <td>{{$item->telefono}}</td>
        <td>
            <form name="a" action="{{route('alumnos.destroy', $item)}}" method='POST' class="form-inline">
                @csrf
                @method("DELETE")
                <a href="{{route('alumnos.edit', $item)}}" class="btn btn-light btn-lg"><i class="fa fa-edit"></i> Editar</a>
                <button type="submit" class="btn btn-warning btn-lg" onclick="return confirm('¿Borrar Alumno?')">
                    <i class="fa fa-trash"></i> Borrar</button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$alumnos->links()}}
@endsection

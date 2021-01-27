@extends('plantillas.plantilla')
@section('titulo')
nuevo alumno
@endsection
@section('cabecera')
Crear Alumno
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger my-3 p-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="fom" action="{{route('alumnos.store')}}" method="POST" enctype="multipart/form-data" class="mt-3">
@csrf
<div class="row">
    <div class="col-2">
        <input type="text" name="nombre" required placeholder="Nombre" class="form-control">
    </div>
    <div class="col-5">
        <input type="text" name="apellidos" required placeholder="Apellidos" class="form-control">
    </div>
    <div class="col-5">
        <input type="file" name="foto" class="form-control-file" />
    </div>
</div>
<div class="row mt-3">
<div class="col-7">
    <input type="text" name="email" required placeholder="Email" class="form-control">
</div>
<div class="row mt-3">
    <div class="col-7">
        <input type="text" name="telefono" required placeholder="Telefono" class="form-control">
    </div>
</div>
</div>
<div class="row mt-3">
    <div class="col">
        <button type="submit" class="btn btn-dark"><i class="fa fa-plus"></i> Crear Alumno</button>
        <button type="reset" class="btn btn-warning"><i class="fa fa-brush"></i> Limpiar</button>
        <a href="{{route('alumnos.index')}}" class="btn btn-light"><i class="fa fa-house-user"></i> Inicio</a>
    </div>
</div>
</form>
@endsection

@extends('layout')
@section('title','personas | ' . $persona->cPerApellido  )
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Detalles de la persona</h2>
        <p><strong>Apellido:</strong> {{ $persona->cPerApellido }}</p>
        <p><strong>Nombre:</strong> {{ $persona->cPerNombre }}</p>
        <p><strong>Dirección:</strong> {{ $persona->cPerDireccion }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $persona->dPerFecNac }}</p>
        <p><strong>Edad:</strong> {{ $persona->nPerEdad }}</p>
        <p><strong>Sexo:</strong> {{ $persona->cPerSexo }}</p>
        <p><strong>Sueldo:</strong> {{ $persona->nPerSueldo }}</p>
        <p><strong>RND:</strong> {{ $persona->cPerRnd }}</p>
        <p><strong>Estado:</strong> {{ $persona->nPerEstado }}</p>
    </div>
</div>

        <td><img src="/storage/{{ $persona->image }}" alt="{{ $persona->titulo }}" width="100" height="50"></td>

        <a href="{{ route('personas.edit', $persona) }}">
            <button>Editar</button>
        </a>



        <form action="{{ route('personas.destroy',$persona) }}" method="POST">
            @csrf @method('DELETE')
            <button>Eliminar</button>
</form>

@endsection
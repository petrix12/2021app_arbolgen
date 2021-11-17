@extends('adminlte::page')

@section('title', 'Editar usuario | Soluciones++')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="h5">Nombre:</h2>
            <p class="form-control">{{ $user->name }}</p>
            <h2 class="h5">Lista de roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="h5">Personalizar aplicación:</h2>
            {!! Form::model($user, ['route' => ['admin.customize', $user], 'method' => 'put']) !!}
                {!! Form::label('default_name_family', 'Nombre del árbol genealógico: ') !!}
                {!! Form::text('default_name_family', null, ['class' => 'form-control' . ($errors->has('default_name_family') ? ' is-invalid' :  ''), 'placeholder' => 'Escriba el apellido principal para la aplicación']) !!}
                {!! Form::label('default_tree_id', 'Id por defecto: ') !!}
                {!! Form::number('default_tree_id', null, ['class' => 'form-control' . ($errors->has('default_tree_id') ? ' is-invalid' :  ''), 'placeholder' => 'Indique el id por defecto para la vista del árbol']) !!}
                {!! Form::submit('Personalizar', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
@extends('adminlte::page')

@section('title', 'Documentación de la aplicación | Soluciones++')

@section('content_header')
    <h1>Documentación de la aplicación</h1>
@stop

@section('content')
    <section class="my-10">
        <div class="container">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <iframe
                    title="Inline Frame Example"
                    width="100%"
                    height="800"
                    src="{{ asset('storage/paso-paso.html') }}">
                </iframe>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- ARCHIVOS CSS REQUERIDOS POR LA APLICACIÓN --}}
@stop

@section('js')
    {{-- ARCHIVOS JS REQUERIDOS POR LA APLICACIÓN --}}
@stop
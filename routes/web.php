<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard/{id?}', function ($id=1) {
    return view('dashboard', compact('id'));
})->name('dashboard');

Route::view('documentos', 'documentacion')->name('documentacion')->middleware('can:Admin');

// Grupo de rutas CRUD
Route::group(['middleware' => ['auth'], 'as' => 'crud.'], function(){
    Route::resource('trees', TreeController::class)->names('trees')
		->middleware('can:VerArboles');
    Route::resource('files', FileController::class)->names('files')
        ->middleware('can:VerArboles');
    Route::get('regresar', [FileController::class, 'regresar'])->name('regresar')
        ->middleware('can:VerArboles');
});

// RUTAS PARA EL MANTENIMIENTO DE LA APLICACIÓN EN PRODUCCIÓN
// Ruta para ejecutar en producción: $ php artisan key:generate
Route::get('key-generate', function(){
    Artisan::call('key:generate');
});

// Ruta para ejecutar en producción: $ php artisan storage:link
Route::get('storage-link', function(){
    Artisan::call('storage:link');
});

// Ruta para ejecutar en producción: $ php artisan config:cache
Route::get('config-cache', function(){
    Artisan::call('config:cache');
});

// Ruta para ejecutar en producción: $ php artisan cache:clear
Route::get('cache-clear', function(){
    Artisan::call('cache:clear');
});

// Ruta para ejecutar en producción: $ php artisan route:clear
Route::get('route-clear', function(){
    Artisan::call('route:clear');
});

// Ruta para ejecutar en producción: $ php artisan config:clear
Route::get('config-clear', function(){
    Artisan::call('config:clear');
});

// Ruta para ejecutar en producción: $ php artisan view:clear
Route::get('view-clear', function(){
    Artisan::call('view:clear');
});
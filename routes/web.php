<?php

use App\Http\Controllers\TreeController;
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
});
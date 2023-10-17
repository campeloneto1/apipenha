<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgressorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BairroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SubunidadeController;
use App\Http\Controllers\SubunidadeBairroController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' =>  ['guest:api', 'middleware' => 'throttle:5,1']], function() {
    Route::post('/login', [AuthController::class, 'login']);    
    Route::post('/cadastrese', [UserController::class, 'cadastrese']);     
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/logout', [AuthController::class, 'logout']); 
    Route::get('/check', [AuthController::class, 'check']); 

    Route::apiResource('agressores', AgressorController::class);
    Route::apiResource('bairros', BairroController::class);
    Route::apiResource('cidades', CidadeController::class);
    Route::apiResource('denuncias', DenunciaController::class);
    Route::apiResource('emergencias', EmergenciaController::class);
    Route::apiResource('estados', EstadoController::class);
    Route::apiResource('logs', LogController::class);
    Route::apiResource('orgaos', OrgaoController::class);
    Route::apiResource('paises', PaisController::class);
    Route::apiResource('perfis', PerfilController::class);
    Route::apiResource('subunidades', SubunidadeController::class);
    Route::apiResource('subunidades-bairros', SubunidadeBairroController::class);
    Route::apiResource('unidades', UnidadeController::class);
    Route::apiResource('users', UserController::class);
    
});
<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\Management\ManagementController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/management/inmueble/{display_id}',[InmuebleController::class,'index']);
    //INCIDENCES
    Route::post('/management/contract/{display_id}/request/handle', [ContractController::class, 'requestHandle']);
    Route::post('/management/contract/request/new', [ContractController::class, 'createRequest']);

    Route::get('/management/contract/{display_id}/request', [ContractController::class, 'request']);

    Route::get('/management/contract/{display_id}/incidences/new', [IncidenceController::class, 'new']); //CREAR UNA INCIDENCIA
    Route::post('/management/contract/{display_id}/incidences/save', [IncidenceController::class, 'save']); //CREAR UNA INCIDENCIA
    Route::get('/management/contract/{display_id}/incidences/{incidence_id}', [IncidenceController::class, 'show']); //UNA EN ESPECIFICO
    Route::get('/management/contract/{display_id}/incidences', [IncidenceController::class, 'index']); //TODAS LAS DE UN CONTRATO
    Route::get('/management/contract/request/{display_id}/data', [ContractController::class, 'getData']);

    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::get('/management/contract/new', [ContractController::class, 'new']);

    Route::get('/management/contract/{display_id}', [ContractController::class, 'show']);
    Route::get('/management/contract', [ContractController::class, 'index'])->name('management.contracts');
    Route::get('/management/contract/new', [ContractController::class, 'new']);
    Route::post('/management/contract/save', [ContractController::class, 'save']);
    Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
    Route::get('/management/anuncios', [ManagementController::class, 'anuncios'])->name('management.anuncios');
});

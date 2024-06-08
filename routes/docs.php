<?php

use App\Http\Controllers\DocsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
    Route::post('/docs/new', [DocsController::class, 'create'])->name('docs.create');
    Route::get('/docs/delete/{display_id}', [DocsController::class, 'delete']);
    Route::post('/docs/{display_id}/saveRoles', [DocsController::class, 'saveRoles']);
    Route::post('/docs/{display_id}/shareRole', [DocsController::class, 'shareRole']);
    Route::post('/docs/{display_id}/save', [DocsController::class, 'save']);
    Route::get('/docs/{display_id}/data',[DocsController::class,'getData']);
    Route::get('/docs/{display_id}', [DocsController::class, 'show'])->name('docs.show');

});
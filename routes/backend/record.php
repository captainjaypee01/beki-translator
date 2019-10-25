<?php

use App\Http\Controllers\Backend\Record\TranslateController;
use App\Http\Controllers\Backend\Record\WordController; 

Route::group([
    'prefix' => 'record',
    'as' => 'record.',
], function () {

    // Word Routes
    Route::group([
        'prefix' => 'word',
        'as' => 'word.', 
    ], function () {
    
        Route::get('/', [WordController::class, 'index'])->name('index'); 
        Route::get('/create', [WordController::class, 'create'])->name('create');
        Route::post('/', [WordController::class, 'store'])->name('store');

        Route::group(['prefix' => '{word}'], function () {
            Route::get('/', [WordController::class, 'show'])->name('show');
            Route::get('/edit', [WordController::class, 'edit'])->name('edit');
            Route::get('mark/{status}', [WordController::class, 'mark'])->name('mark')->where(['status' => '[0,1]']); 
            Route::get('/translation/remove/{translate}', [WordController::class, 'removeTranslation'])->name('translation.remove');
            Route::post('/translation/add', [WordController::class, 'addTranslation'])->name('translation.add');
            Route::patch('/', [WordController::class, 'update'])->name('update');
            Route::delete('/', [WordController::class, 'destroy'])->name('destroy');
        });
    });

    
    // Word Routes
    Route::group([
        'prefix' => 'translate',
        'as' => 'translate.', 
    ], function () {
    
        Route::get('/', [TranslateController::class, 'index'])->name('index'); 
        Route::get('/create', [TranslateController::class, 'create'])->name('create');
        Route::post('/', [TranslateController::class, 'store'])->name('store');

        Route::group(['prefix' => '{translate}'], function () {
            Route::get('/', [TranslateController::class, 'show'])->name('show');
            Route::get('/edit', [TranslateController::class, 'edit'])->name('edit');
            Route::get('mark/{status}', [TranslateController::class, 'mark'])->name('mark')->where(['status' => '[0,1]']); 
            Route::patch('/', [TranslateController::class, 'update'])->name('update');
            Route::delete('/', [TranslateController::class, 'destroy'])->name('destroy');
        });
    });


});

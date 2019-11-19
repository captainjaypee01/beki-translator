<?php
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */

use App\Http\Controllers\Frontend\Record\WordListController;

Route::group(['middleware' => ['auth', 'password_expires']], function () {

    Route::group(['namespace' => 'Record', 'as' => 'record.'], function () {

        // Word Routes
        Route::group([
            'prefix' => 'word',
            'as' => 'word.', 
        ], function () {
        
            Route::get('/', [WordListController::class, 'index'])->name('index'); 
            Route::get('/create', [WordListController::class, 'create'])->name('create');
            Route::post('/', [WordListController::class, 'store'])->name('store');

            Route::group(['prefix' => '{word}'], function () {
                Route::get('/', [WordListController::class, 'show'])->name('show');
                Route::get('/edit', [WordListController::class, 'edit'])->name('edit');
                Route::get('/translate/{translate}', [WordListController::class, 'editTranslate'])->name('translate.edit');
                Route::get('mark/{status}', [WordListController::class, 'mark'])->name('mark')->where(['status' => '[0,1]']); 
                Route::get('/translation/remove/{translate}', [WordListController::class, 'removeTranslation'])->name('translation.remove');
                Route::post('/translation/add', [WordListController::class, 'addTranslation'])->name('translation.add');
                Route::patch('/', [WordListController::class, 'update'])->name('update');
                Route::patch('/translate/{translate}', [WordListController::class, 'updateTranslation'])->name('translate.update');
                Route::delete('/', [WordListController::class, 'destroy'])->name('destroy');
            });
        });

    });
});

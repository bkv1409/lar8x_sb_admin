<?php

use Bkv1409\SystemConfig\Http\Controllers\SystemConfigController;
use Illuminate\Support\Facades\Route;

// System config
Route::get('system-configs/{system_config}/change-status', [SystemConfigController::class, 'changeStatus'])->name('admin.system-configs.changeStatus');
Route::get('system-configs/{id?}/check-value', [SystemConfigController::class, 'checkValue'])->name('admin.system-configs.checkValue');
Route::post('system-configs/{id?}', [SystemConfigController::class, 'save'])->name('admin.system-configs.store');

Route::name('admin.')->group(function () {
    Route::resource('system-configs', SystemConfigController::class)->except([
        'store', 'update'
    ]);
});

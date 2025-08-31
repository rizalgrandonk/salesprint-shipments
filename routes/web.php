<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/', 'AdminUsersController@index')->name('index');
            Route::get('/create', 'AdminUsersController@create')->name('create');
            Route::post('/', 'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login', 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit', 'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}', 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}', 'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation', 'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('shipments')->name('shipments/')->group(static function () {
            Route::get('/', 'ShipmentsController@index')->name('index');
            Route::get('/create', 'ShipmentsController@create')->name('create');
            Route::post('/', 'ShipmentsController@store')->name('store');
            Route::get('/{shipment}/edit', 'ShipmentsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ShipmentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{shipment}', 'ShipmentsController@update')->name('update');
            Route::delete('/{shipment}', 'ShipmentsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/', 'AdminUsersController@index')->name('index');
            Route::get('/create', 'AdminUsersController@create')->name('create');
            Route::post('/', 'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login', 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit', 'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}', 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}', 'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation', 'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('provinces')->name('provinces/')->group(static function () {
            Route::get('/', 'ProvincesController@index')->name('index');
            Route::get('/create', 'ProvincesController@create')->name('create');
            Route::post('/populate', 'ProvincesController@populate')->name('populate');
            Route::post('/', 'ProvincesController@store')->name('store');
            Route::post('/{province}/populate_cities', 'ProvincesController@populate_cities')
                ->name('populate_cities');
            Route::get('/{province}/edit', 'ProvincesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ProvincesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{province}', 'ProvincesController@update')->name('update');
            Route::delete('/{province}', 'ProvincesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('cities')->name('cities/')->group(static function () {
            Route::get('/', 'CitiesController@index')->name('index');
            Route::get('/create', 'CitiesController@create')->name('create');
            Route::post('/populate', 'CitiesController@populate')->name('populate');
            Route::post('/', 'CitiesController@store')->name('store');
            Route::get('/{city}/edit', 'CitiesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CitiesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{city}', 'CitiesController@update')->name('update');
            Route::delete('/{city}', 'CitiesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('districts')->name('districts/')->group(static function () {
            Route::get('/', 'DistrictsController@index')->name('index');
            Route::get('/create', 'DistrictsController@create')->name('create');
            Route::post('/populate', 'DistrictsController@populate')->name('populate');
            Route::post('/', 'DistrictsController@store')->name('store');
            Route::get('/{district}/edit', 'DistrictsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'DistrictsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{district}', 'DistrictsController@update')->name('update');
            Route::delete('/{district}', 'DistrictsController@destroy')->name('destroy');
        });
    });
});

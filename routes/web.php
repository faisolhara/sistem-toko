<?php

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
    if (Auth::check()) {
        return redirect ('/dashboard');
    }else{
        return redirect ('/login');
    }
});

Route::group(['middleware' => ['menu']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('master-user')->group(function () {
        Route::any('/', 'Master\MasterUserController@index')->name('master-user-index');
        Route::get('/add', 'Master\MasterUserController@add')->name('master-user-add');
        Route::get('/edit/{id}', 'Master\MasterUserController@edit')->name('master-user-edit');
        Route::post('/save', 'Master\MasterUserController@save')->name('master-user-save');
    });

    Route::prefix('master-role')->group(function () {
        Route::any('/', 'Master\MasterRoleController@index')->name('master-role-index');
        Route::get('/add', 'Master\MasterRoleController@add')->name('master-role-add');
        Route::get('/edit/{id}', 'Master\MasterRoleController@edit')->name('master-role-edit');
        Route::post('/save', 'Master\MasterRoleController@save')->name('master-role-save');
    });

    Route::prefix('master-category')->group(function () {
        Route::any('/', 'Master\MasterCategoryController@index')->name('master-category-index');
        Route::get('/add', 'Master\MasterCategoryController@add')->name('master-category-add');
        Route::get('/edit/{id}', 'Master\MasterCategoryController@edit')->name('master-category-edit');
        Route::post('/save', 'Master\MasterCategoryController@save')->name('master-category-save');
    });

    Route::prefix('master-uom')->group(function () {
        Route::any('/', 'Master\MasterUomController@index')->name('master-uom-index');
        Route::get('/add', 'Master\MasterUomController@add')->name('master-uom-add');
        Route::get('/edit/{id}', 'Master\MasterUomController@edit')->name('master-uom-edit');
        Route::post('/save', 'Master\MasterUomController@save')->name('master-uom-save');
    });

    Route::prefix('master-item')->group(function () {
        Route::any('/', 'Master\MasterItemController@index')->name('master-item-index');
        Route::get('/add', 'Master\MasterItemController@add')->name('master-item-add');
        Route::get('/edit/{id}', 'Master\MasterItemController@edit')->name('master-item-edit');
        Route::post('/save', 'Master\MasterItemController@save')->name('master-item-save');
    });

    Route::prefix('master-supplier')->group(function () {
        Route::any('/', 'Master\MasterSupplierController@index')->name('master-supplier-index');
        Route::get('/add', 'Master\MasterSupplierController@add')->name('master-supplier-add');
        Route::get('/edit/{id}', 'Master\MasterSupplierController@edit')->name('master-supplier-edit');
        Route::post('/save', 'Master\MasterSupplierController@save')->name('master-supplier-save');
    });

    Route::prefix('master-conversion')->group(function () {
        Route::any('/', 'Master\MasterConversionController@index')->name('master-conversion-index');
        Route::get('/add', 'Master\MasterConversionController@add')->name('master-conversion-add');
        Route::get('/edit/{id}', 'Master\MasterConversionController@edit')->name('master-conversion-edit');
        Route::post('/save', 'Master\MasterConversionController@save')->name('master-conversion-save');
        Route::get('/get-uom/', 'Master\MasterConversionController@getUom')->name('master-conversion-get-uom');
    });

    Route::prefix('item-stock')->group(function () {
        Route::any('/', 'Transaction\ItemStockController@index')->name('item-stock-index');
        Route::get('/add', 'Transaction\ItemStockController@add')->name('item-stock-add');
        Route::get('/edit/{id}', 'Transaction\ItemStockController@edit')->name('item-stock-edit');
        Route::post('/save', 'Transaction\ItemStockController@save')->name('item-stock-save');
    });

    Route::prefix('receipt-item')->group(function () {
        Route::any('/', 'Transaction\ReceiptItemController@index')->name('receipt-item-index');
        Route::get('/add', 'Transaction\ReceiptItemController@add')->name('receipt-item-add');
        Route::get('/edit/{id}', 'Transaction\ReceiptItemController@edit')->name('receipt-item-edit');
        Route::post('/save', 'Transaction\ReceiptItemController@save')->name('receipt-item-save');
    });

    Route::prefix('adjustment-stock')->group(function () {
        Route::any('/', 'Transaction\AdjustmentStockController@index')->name('adjustment-stock-index');
        Route::get('/add', 'Transaction\AdjustmentStockController@add')->name('adjustment-stock-add');
        Route::get('/edit/{id}', 'Transaction\AdjustmentStockController@edit')->name('adjustment-stock-edit');
        Route::post('/save', 'Transaction\AdjustmentStockController@save')->name('adjustment-stock-save');
    });

    Route::prefix('payment')->group(function () {
        Route::any('/', 'Transaction\PaymentController@index')->name('payment-index');
        Route::get('/add', 'Transaction\PaymentController@add')->name('payment-add');
        Route::get('/edit/{id}', 'Transaction\PaymentController@edit')->name('payment-edit');
        Route::post('/save', 'Transaction\PaymentController@save')->name('payment-save');
    });

    Route::prefix('api')->group(function () {
        Route::get('/get-uom-item', 'Master\ApiController@getUomItem')->name('api-uom-item');
        Route::get('/get-uom-by-item', 'Master\ApiController@getUomByItem')->name('api-uom-by-item');
    });
});

Auth::routes();


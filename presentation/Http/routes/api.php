<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Presentation\Http\Actions;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/send_email', Actions\SendEmail::class);

Route::prefix('users')->group(function() {
    Route::post('/recovery', Actions\Users\RecoveryPasswordAction::class)->name('recoveryPassword');

    Route::post('/forgot', Actions\Users\ChangePasswordFromRecoveryAction::class)->name('changePasswordFromRecovery');

    Route::get('/{id}/enable', Actions\Users\EnableUserAction::class)->name('enableUser');

    Route::get('/{id}/disable', Actions\Users\DisableUserAction::class)->name('disableUser');

    Route::get('/{id}', Actions\Users\ShowUserAction::class)->name('showOneUser');
});

Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', Actions\Auth\LoginAction::class)->name('login');
    Route::post('renew-token', Actions\Auth\RenewTokenAction::class)->name('renew-token');
    Route::post('signup', Actions\Customers\StoreWebCustomerAction::class)->name('createWebCustomer');
    Route::post('change-password', Actions\Auth\ChangePasswordAction::class)->name('change-password');
});


Route::prefix('employees')->group(function () {
    Route::post('/', Actions\Employees\StoreEmployeeAction::class)->name('createEmployee');
    Route::get('/', Actions\Employees\FindEmployeeAction::class)->name('listEmployee');
});

Route::prefix('customers')->group(function () {
    Route::post('/', Actions\Customers\StoreCustomerAction::class)->name('createCustomer');
    Route::get('/{id}', Actions\Customers\FindCustomerAction::class)->name('findCustomer');
    Route::put('/{id}', Actions\Customers\UpdateCustomerAction::class)->name('updateCustomer');
    Route::get('/', Actions\Customers\IndexCustomerAction::class)->name('listCustomers');
});

Route::prefix('admins')->group(function () {
    Route::post('/', Actions\Admins\StoreAdminAction::class)->name('createAdmin');
});

Route::group([
    'prefix' => 'products'
],function ($router) {
    Route::put('/{id}', Actions\Products\UpdateProductAction::class)->name('updateProduct');
    Route::get('/{uuid}', Actions\Products\FindProductAction::class)->name('findProduct');
    Route::delete('/{id}', Actions\Products\DestroyProductAction::class)->name('destroyProduct');
    Route::post('/', Actions\Products\StoreProductAction::class)->name('createProduct');
});

Route::prefix('search')->group(function () {
    Route::get('/', Actions\Products\SearchProductsAction::class)->name('searchProducts');
    Route::get('home', Actions\Products\SearchProductsForHomeAction::class)->name('searchProducts');
});

Route::prefix('inventory')->group(function () {
    Route::post('/{id}', Actions\Products\UpdateInventory::class)->name('updateInventoryProduct');
    Route::get('/', Actions\Stock\IndexProductStock::class)->name('indexProductsStock');
    Route::get('/{id}', Actions\Stock\FindProductStock::class)->name('findProductsStock');
});

Route::prefix('filters')->group(function () {
    Route::get('/', Actions\Filters\IndexFiltersAction::class)->name('indexFilters');
    Route::post('/', Actions\Filters\StoreFiltersAction::class)->name('addFilter');
    Route::put('/{id}', Actions\Filters\UpdateFiltersAction::class)->name('updateFilter');
    Route::delete('/{id}', Actions\Filters\DestroyFilterAction::class)->name('destroyFilter');
});

Route::prefix('categories')->group(function () {
    Route::post('/', Actions\Categories\StoreCategoryAction::class)->name('storeCategory');
    Route::put('/{id}', Actions\Categories\UpdateCategoryAction::class)->name('updateCategory');
    Route::get('/', Actions\Categories\IndexCategoryAction::class)->name('indexCategory');
    Route::delete('/{id}', Actions\Categories\DestroyCategoryAction::class)->name('destroyCategory');
});

Route::prefix('payments')->group(function () {
    Route::post('/mercadopago', Actions\Payments\MercadoPagoExecute::class)->name('paymentMercadoPago');
});

Route::prefix('notifications')->group(function() {
    Route::post('/', Actions\Notifications\CheckNotificationUser::class)->name('checkNotificationUser');
});

Route::prefix('orders')->group(function () {
    Route::get('/', Actions\Orders\IndexOrdersAction::class)->name('getOrders');
    Route::get('all', Actions\Orders\IndexAllOrdersAction::class)->name('getAllOrders');
});

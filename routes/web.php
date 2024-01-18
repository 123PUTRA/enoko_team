<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/location-form', [AddressController::class, 'showLocationForm'])->name('location.form');
Route::post('/save-selected-location', [AddressController::class, 'saveSelectedLocation'])->name('save.selected.location');
Route::get('/show-selected-location', [AddressController::class, 'showSelectedLocation'])->name('show.selected.location');
Route::get('/provinsi/{provinsi}/cities', [AddressController::class, 'getCitiesByProvince']);
Route::get('/kabupaten/{kabupaten}/districts', [AddressController::class, 'getDistrictsByKabupaten']);


Route::get('/barang/category/{category}', [BarangController::class, 'category'])->name('barang.category');
Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search');
Route::get('/category/show/{category}', [CategoryController::class, 'showCategory'])->name('category.show');


Route::middleware('web')->group(function () {
    Route::get('/store/detail/{storeId}', [StoreController::class, 'detail'])->name('store.detail');


    // grup middleware 'auth'
    Route::middleware(['auth'])->group(function () {
        // Rute-rute yang memerlukan otentikasi
        Route::prefix('store')->group(function () {
            // Rute-rute toko
            Route::get('/dashboard', [StoreController::class, 'dashboard'])->name('store.dashboard');
            Route::get('/open_store_form', [StoreController::class, 'openStoreForm'])->name('store.open_store_form');
            Route::post('/open_store_submit', [StoreController::class, 'openStore'])->name('store.open_store_submit');
            Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
            Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
            Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
            Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
            Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
            Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
            Route::post('/cart/update/{index}', [BarangController::class, 'updateCart'])->name('cart.update');
           Route::delete('/cart/remove/{id}', [BarangController::class, 'removeFromCart'])->name('cart.remove');
           Route::post('/cart/checkout', [BarangController::class, 'checkoutCart'])->name('cart.checkout');
            Route::get('/cart', [BarangController::class, 'showCart'])->name('cart.show');
            Route::post('/barang/add-to-cart/{barang}', [BarangController::class, 'addToCart'])->name('barang.addToCart');


        });
    });
});

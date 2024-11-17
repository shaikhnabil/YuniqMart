<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\CreateCategory;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Products;
use App\Livewire\Cart\Cart;
use App\Livewire\Cart\Invoice;
use App\Livewire\Home;
use App\Livewire\Notifications;
use App\Livewire\Orders\Adresses;
use App\Livewire\Orders\MyOrders;
use App\Livewire\Products\ProductsDetails;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\GoogleController;



// Route::get('/', function () {
//     return view('home');
// })->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';

//products routes
// Route::get('/', [ProductsController::class, 'index'])->name('index');

Route::get('/', Home::class)->name('index');

// Route::get('/products', [ProductsController::class, 'products'])->name('products')->middleware('auth:admin');

Route::get('/admin/categories', Categories::class)->name('categories')->middleware('auth:admin');
Route::get('/admin/categories/{view}', Categories::class)->name('categories.create')->middleware('auth:admin');
Route::get('/admin/categories/{view}/{id}', Categories::class)->name('category.edit')->middleware('auth:admin');

Route::get('/admin/orders', Orders::class)->name('admin.orders')->middleware('auth:admin');

Route::post('admin/products/toggle-status/{productId}', [Products::class, 'toggleStatus'])->name('products.toggleStatus');
Route::get('/products/data', [Products::class, 'products'])->name('products_data')->middleware('auth:admin');
Route::get('/admin/products', Products::class)->name('products')->middleware('auth:admin');
Route::get('/admin/products/{view}', Products::class)->name('products.create')->middleware('auth:admin');
Route::get('product/{id}', ProductsDetails::class)->name('products.show');
Route::get('/admin/product/{view}/{product_id}', Products::class)->name('products.edit')->middleware('auth:admin');
Route::get('/admin/{view}', Products::class)->name('products.trashed')->middleware('auth:admin');
Route::get('/subcategories/{id}', [Products::class, 'show'])->name('subcategory.show')->middleware('auth:admin');



// Route::get('/create-product', [ProductsController::class, 'create'])->name('products.create')->middleware('auth:admin');
// Route::get('product/{slug}', [ProductsController::class, 'show'])->name('products.show');
// Route::post('/create-product', [ProductsController::class, 'store'])->name('products.store')->middleware('auth:admin');
// Route::get('product/edit/{slug}', [ProductsController::class, 'edit'])->name('products.edit')->middleware('auth:admin');
// Route::get('product/edit/{id}', [Products::class, 'edit'])->name('products.edit')->middleware('auth:admin');
// Route::put('product/edit/{slug}', [ProductsController::class, 'update'])->name('products.update')->middleware('auth:admin');
// Route::delete('product/delete/{slug}', [ProductsController::class, 'destroy'])->name('products.destroy')->middleware('auth:admin');
// Route::get('/trashed_products', [ProductsController::class, 'trashed_products'])->name('products.trashed')->middleware('auth:admin');
// Route::get('/restore/{slug}', [ProductsController::class, 'restore'])->name('products.restore')->middleware('auth:admin');
//Route::get('/admin/trashed_products/restore/{slug}', Products::class)->name('products.restore')->middleware('auth:admin');
//Route::delete('/force_delete/{slug}', [ProductsController::class, 'force_delete'])->name('products.force_delete')->middleware('auth:admin');

//categories route
Route::get('/admin/categories', Categories::class)->name('categories')->middleware('auth:admin');
Route::get('/admin/categories/{view}', Categories::class)->name('categories.create')->middleware('auth:admin');
Route::get('/admin/categories/{view}/{id}', Categories::class)->name('category.edit')->middleware('auth:admin');
// Route::get('/categories', [CategoriesController::class, 'index'])->name('categories')->middleware('auth:admin');
// Route::get('/create-category', [CategoriesController::class, 'create'])->name('categories.create')->middleware('auth:admin');
//Route::post('/create-category', [CategoriesController::class, 'store'])->name('categories.store')->middleware('auth:admin');
// Route::get('category/edit/{category:slug}', [CategoriesController::class, 'edit'])->name('category.edit')->middleware('auth:admin');
// Route::put('category/edit/{category:slug}', [CategoriesController::class, 'update'])->name('category.update')->middleware('auth:admin');
//Route::post('category/delete/{category:slug}', [CategoriesController::class, 'destroy'])->name('category.delete')->middleware('auth:admin');

//sub category route
// Route::post('/child_category', [SubCategoryController::class, 'store'])->name('subcategory.store')->middleware('auth:admin');
// Route::get('admin/categories/subcategory/{slug}', [SubCategoryController::class, 'edit'])->name('subcategory.edit')->middleware('auth:admin');
// Route::put('/update_child_category/{slug}', [SubCategoryController::class, 'update'])->name('subcategory.update')->middleware('auth:admin');
// Route::delete('/delete_child_category/{slug}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete')->middleware('auth:admin');


//cart routes
Route::get('cart', Cart::class, )->name('cart.index');
//Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
//Route::post('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::get('cart', [CartController::class, 'index'])->name('cart.index');
// Route::get('checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::get('/my-orders', MyOrders::class)->name('myorders')->middleware('auth');
Route::get('/Manage-Addresses', Adresses::class)->name('manage.address')->middleware('auth');
Route::get('checkout', Cart::class)->name('checkout')->middleware('auth');
//Route::post('/checkout/direct/{id}', [CartController::class, 'directCheckout'])->name('checkout.direct')->middleware('auth');
Route::post('/place-order', [Cart::class, 'placeOrder'])->name('placeorder')->middleware('auth');
// Route::post('/place-order', [CartController::class, 'placeOrder'])->name('placeorder')->middleware('auth');
// Route::get('/invoice/{order_number}', [CartController::class, 'invoice'])->name('invoice')->middleware('auth');
Route::get('/invoice/{order_number}', Invoice::class)->name('invoice')->middleware('auth');
Route::get('/invoicepdf/{order_number}', [Invoice::class, 'generateInvoice'])->name('invoice.generate')->middleware('auth');

//Route::get('/invoicepdf/{order_number}', [CartController::class, 'generateInvoice'])->name('invoice.generate')->middleware('auth');

//Orders route

//google login route
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('login.callback');

//notification
Route::get('/mark-as-read', [Home::class,'markAsRead'])->name('mark-as-read');
Route::get('/mark-as-read/{id}', [Notifications::class,'markAsReadone'])->name('markasreadone');
Route::get('/notifications', Notifications::class)->name('notifications');





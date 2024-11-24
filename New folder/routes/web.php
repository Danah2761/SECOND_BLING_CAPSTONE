<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCRUDController;
use App\Http\Controllers\Admin\AuthenticatorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\ProductCheckController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DealController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Models\Deal;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'mainHome'])->name('mainHome');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::view('terms', 'customer.terms')->name('terms');
Route::view('about', 'customer.about')->name('about');
Route::view('contact_us', 'customer.contact_us')->name('contact_us');
Route::get('products', [HomeController::class, 'products'])->name('products.index');
Route::get('products/{product}', [HomeController::class, 'showProduct'])->name('products.show');

Route::prefix('customer')->name('customer.')->group(function () {
    Route::view('forgot_password', 'customer.auth.forgot_password')->name('forgot_password');
    Route::get('login', [CustomerController::class, 'showLoginForm'])->name('loginForm');
    Route::post('login', [CustomerController::class, 'login'])->name('login');
    Route::get('register', [CustomerController::class, 'showRegisterForm'])->name('registerForm');
    Route::post('register', [CustomerController::class, 'register'])->name('register');
    Route::middleware('auth:customer')->group(function () {
        Route::post('logout', [CustomerController::class, 'logout'])->name('logout');

        Route::get('profile', [CustomerController::class, 'showProfile'])->name('profile');
        Route::post('profile', [CustomerController::class, 'updateProfile'])->name('updateProfile');
        Route::post('password/update', [CustomerController::class, 'updatePassword'])->name('updatePassword');
        Route::post('addNewReview', [\App\Http\Controllers\Customer\ReviewController::class, 'addNewReview'])->name('addNewReview');
        Route::delete('deleteReview', [\App\Http\Controllers\Customer\ReviewController::class, 'deleteReview'])->name('deleteReview');

        Route::delete('cart/remove/{productId}', [DealController::class, 'removeFromCart'])->name('cart.remove');

        Route::get('cart', [DealController::class, 'cart'])->name('cart');
        Route::post('cart/add', [DealController::class, 'addToCart'])->name('addToCart');
        Route::post('shipping-info/update', [DealController::class, 'updateShippingInfo'])->name('updateShippingInfo');
        Route::get('place-order', [DealController::class, 'placeOrder'])->name('placeOrder');
        Route::get('deal-summary/{deal}', [DealController::class, 'dealSummary'])->name('dealSummary');
        Route::get('order-confirmation/{dealId}', [DealController::class, 'confirmation'])->name('confirmation');
        Route::get('trackOrder', [DealController::class, 'trackOrder'])->name('trackOrder');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('loginForm');
    Route::post('login', [AdminController::class, 'login'])->name('login');
    Route::get('password/reset', [AdminController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::middleware('auth:admin,authen')->group(function () {
        Route::get('home', [AdminController::class, 'home'])->name('home');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('myProfile', [AdminController::class, 'showAuthenticatorProfile'])->name('authen.show');
        Route::get('profile', [AdminController::class, 'showProfileData'])->name('profile.show');
        Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::post('authenticator/update', [AdminController::class, 'updateProfileAuthenticator'])->name('authen.update');
        Route::resource('categories', CategoryController::class);
        Route::resource('admins', AdminCRUDController::class);
        Route::resource('authenticators', AuthenticatorController::class);

        Route::get('suppliers', [GeneralController::class, 'listSuppliers'])->name('suppliers.index');
        Route::get('suppliers/{id}', [GeneralController::class, 'showSupplierDetails'])->name('suppliers.show');
        Route::post('suppliers/{id}/toggle-status', [GeneralController::class, 'toggleSupplierStatus'])->name('suppliers.toggleStatus');
        Route::get('customers', [GeneralController::class, 'listCustomers'])->name('customers.index');
        Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);
        Route::get('products', [ProductCheckController::class, 'products'])->name('products.index');
        Route::delete('products/{product}', [ProductCheckController::class, 'destroy'])->name('products.destroy');
        Route::get('products-check', [ProductCheckController::class, 'index'])->name('products_check.index');
        Route::get('products-check/{id}/check', [ProductCheckController::class, 'checkProduct'])->name('products_check.check');
        Route::post('products-check/{id}/status', [ProductCheckController::class, 'updateStatus'])->name('products_check.updateStatus');
        // Sales Summary Report
        Route::get('reports/sales-summary', [ReportAdminController::class, 'salesSummary'])
            ->name('reports.salesSummary');

        // Product Authentication Status Report
        Route::get('reports/product-authentication-status', [ReportAdminController::class, 'productAuthenticationStatus'])
            ->name('reports.productAuthenticationStatus');

        // Supplier Performance Report
        Route::get('reports/seller-performance', [ReportAdminController::class, 'supplierPerformance'])
            ->name('reports.supplierPerformance');


        Route::get('deals', [\App\Http\Controllers\Admin\DealsController::class, 'index'])->name('deals.index');
        Route::get('deals/{id}', [\App\Http\Controllers\Admin\DealsController::class, 'show'])->name('deals.show');
        Route::post('deals/{id}/status', [\App\Http\Controllers\Admin\DealsController::class, 'changeStatus'])->name('deals.changeStatus');
    });
});



Route::prefix('seller')->name('seller.')->group(function () {
    Route::get('login', [SupplierController::class, 'showLoginForm'])->name('loginForm');
    Route::post('login', [SupplierController::class, 'login'])->name('login');

    Route::get('register', [SupplierController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('register', [SupplierController::class, 'register'])->name('register');
    Route::get('password/reset', [SupplierController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::middleware('auth:seller')->group(function () {
        Route::get('home', [SupplierController::class, 'home'])->name('home');
        Route::post('logout', [SupplierController::class, 'logout'])->name('logout');
        Route::get('profile', [SupplierController::class, 'showProfile'])->name('profile.show');
        Route::post('profile/update', [SupplierController::class, 'updateProfile'])->name('profile.update');
        Route::get('verification/checking', [\App\Http\Controllers\Supplier\ProductController::class, 'checking'])->name('products.checking');
        Route::resource('products', \App\Http\Controllers\Supplier\ProductController::class);
        Route::resource('reviews', \App\Http\Controllers\Supplier\ReviewController::class);

        Route::get('deals', [\App\Http\Controllers\Supplier\DealsController::class, 'index'])->name('deals.index');
        Route::get('deals/{id}', [\App\Http\Controllers\Supplier\DealsController::class, 'show'])->name('deals.show');
        Route::post('deals/{id}/status', [\App\Http\Controllers\Supplier\DealsController::class, 'changeStatus'])->name('deals.changeStatus');
        Route::get('topSellingProducts', [\App\Http\Controllers\Supplier\SupplierController::class, 'topSellingProducts'])->name('topSellingProducts');


        Route::get('monthly-orders', function () {
            $supplierId = auth('seller')->user()->seller_id;
            $monthlyOrders = Deal::selectRaw('MONTH(deal_date) as month, SUM(total_price) as total_orders')
                ->where('seller_id', $supplierId)
                ->groupBy('month')
                ->get();
            return response()->json($monthlyOrders);
        })->name('monthly-orders');

    });
});

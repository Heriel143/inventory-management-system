<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\ProductControler;
use App\Http\Controllers\Pos\PurchaseControler;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\ReceivedPurchaseController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Models\Invoice;
use App\Models\ReceivedPurchase;
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
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/getdata', [DataController::class, 'getData'])->name('get-data');


    // return view('admin.index');
});

Route::middleware('auth')->group(function () {


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
        Route::get('/admin/edit/profile', 'editProfile')->name('edit.profile');
        Route::post('/admin/store/profile', 'updateProfile')->name('store.profile');
        Route::get('/admin/change/password', 'changePassword')->name('change.password');
        Route::post('/admin/update/password', 'updatePassword')->name('update.password');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/admin/all/suppliers', 'allSuppliers')->name('all.suppliers');
        Route::get('/admin/add/supplier', 'addSupplier')->name('add.supplier');
        Route::post('/admin/store/supplier', 'storeSupplier')->name('store.supplier');
        Route::get('/admin/edit/supplier/{id}', 'editSupplier')->name('edit.supplier');
        Route::post('/admin/update/supplier', 'updateSupplier')->name('update.supplier');
        Route::get('/admin/delete/supplier/{id}', 'deleteSupplier')->name('delete.supplier');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/admin/all/customers', 'allCustomers')->name('all.customers');
        Route::get('/admin/add/customer', 'addCustomer')->name('add.customer');
        Route::post('/admin/store/customer', 'storeCustomer')->name('store.customer');
        Route::get('/admin/edit/customer/{id}', 'editCustomer')->name('edit.customer');
        Route::post('/admin/update/customer', 'updateCustomer')->name('update.customer');
        Route::get('/admin/delete/customer/{id}', 'deleteCustomer')->name('delete.customer');
        Route::get('/admin/credit/customer', 'creditCustomers')->name('credit.customers');
        Route::get('/admin/customers/purchases', 'customersPurchases')->name('customers.purchases');
        Route::get('/admin/print/customers/purchases', 'printCustomersPurchases')->name('print.customers.purchases');
        Route::get('/admin/customer/purchases/{id}', 'customerPurchases')->name('customer.purchases');
        Route::get('/admin/print/credit/customer', 'printCreditCustomers')->name('print.credit.customers');
        Route::get('/admin/edit/customer/invoice/{id}', 'editCustomerInvoice')->name('edit.customer.invoice');
        Route::post('/admin/update/customer/invoice/{invoice_id}', 'updateCustomerInvoice')->name('update.customer.invoice');
        Route::get('/admin/view/customer/invoice/{invoice_id}', 'viewCustomerInvoice')->name('view.customer.invoice');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/admin/all/units', 'allUnits')->name('all.units');
        Route::get('/admin/add/unit', 'addUnit')->name('add.unit');
        Route::post('/admin/store/unit', 'storeUnit')->name('store.unit');
        Route::get('/admin/edit/unit/{id}', 'editUnit')->name('edit.unit');
        Route::post('/admin/update/unit', 'updateUnit')->name('update.unit');
        Route::get('/admin/delete/unit/{id}', 'deleteUnit')->name('delete.unit');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all/categories', 'allCategories')->name('all.categories');
        Route::get('/admin/add/category', 'addCategory')->name('add.category');
        Route::post('/admin/store/category', 'storeCategory')->name('store.category');
        Route::get('/admin/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/admin/update/category', 'updateCategory')->name('update.category');
        Route::get('/admin/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });
    Route::controller(ProductControler::class)->group(function () {
        Route::get('/admin/all/products', 'allProducts')->name('all.products');
        Route::get('/admin/add/product', 'addProduct')->name('add.product');
        Route::post('/admin/store/product', 'storeProduct')->name('store.product');
        Route::get('/admin/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/admin/update/product', 'updateProduct')->name('update.product');
        Route::post('/admin/view/product', 'viewProduct')->name('view.product');
        Route::get('/admin/delete/product/{id}', 'deleteProduct')->name('delete.product');
    });

    Route::controller(PurchaseControler::class)->group(function () {
        Route::get('/admin/all/purchases', 'allPurchases')->name('all.purchases');
        Route::get('/admin/pending/purchases', 'pendingPurchases')->name('pending.purchases');
        // Route::get('/admin/receive/purchases', 'receivePurchases')->name('receive.purchases');
        Route::get('/admin/approve/purchases/{id}', 'approvePurchase')->name('approve.purchase');
        Route::get('/admin/add/purchase', 'addPurchase')->name('add.purchase');
        Route::post('/admin/store/purchase', 'storePurchase')->name('store.purchase');
        Route::get('/admin/delete/purchase/{id}', 'deletePurchase')->name('delete.purchase');
        Route::get('/get-category', 'getCategory')->name('get-category');
        Route::get('/get-product', 'getProduct')->name('get-product');
        Route::get('/admin/purchase/report', 'purchaseReport')->name('purchase.report');
        Route::get('/admin/print/purchase/report', 'printPurchaseReport')->name('print.purchase.report');
    });
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/admin/all/invoices', 'allInvoices')->name('all.invoices');
        Route::get('/admin/pending/invoices', 'pendingInvoices')->name('pending.invoices');
        Route::get('/admin/approve/invoice/{id}', 'approveInvoice')->name('approve.invoice');
        Route::get('/admin/add/invoices', 'addInvoice')->name('add.invoice');
        Route::post('/admin/store/invoice', 'storeInvoice')->name('store.invoice');
        Route::get('/admin/delete/invoice/{id}', 'deleteInvoice')->name('delete.invoice');
        Route::post('//admin/store/approval/{id}', 'storeApproval')->name('store.approval');
        Route::get('/admin/view/invoice/{id}', 'viewInvoice')->name('view.invoice');
        Route::get('/admin/view/proforma/{id}', 'viewProforma')->name('view.proforma');
        Route::get('/admin/view/delivery/{id}', 'viewDelivery')->name('view.delivery');
        Route::get('/admin/get-stock', 'getStock')->name('get-stock');
        Route::get('/admin/get-product-invoice', 'getProduct')->name('get-product-invoice');
        Route::get('/admin/daily/invoice/report', 'dailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/admin/get/daily/invoice/report', 'getDailyInvoiceReport')->name('get.daily.invoice.report');
    });
    Route::controller(StockController::class)->group(function () {
        Route::get('/admin/stock/report', 'stockReport')->name('stock.report');
        Route::get('/admin/print/stock/report', 'printStoctReport')->name('print.stock.report');
        Route::get('/admin/supplier/report', 'supplierReport')->name('supplier.report');
        Route::get('/admin/print/supplier/report', 'printSupplierReport')->name('print.supplier.report');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/all/employees', 'allEmployees')->name('all.employees');
        Route::get('/admin/add/employee', 'addEmployee')->name('add.employee');
        Route::post('/admin/store/employee', 'storeEmployee')->name('store.employee');
        Route::get('/admin/edit/employee/{id}', 'editEmployee')->name('edit.employee');
        Route::post('/admin/update/employee', 'updateEmployee')->name('update.employee');
        Route::get('/admin/delete/employee/{id}', 'deleteEmployee')->name('delete.employee');
    });

    Route::controller(RegionController::class)->group(function () {
        Route::get('/admin/all/regions', 'allRegions')->name('all.regions');
        Route::post('/admin/store/region', 'storeRegion')->name('store.region');
        Route::get('/admin/edit/region/{id}', 'editRegion')->name('edit.region');
        Route::post('/admin/update/region', 'updateRegion')->name('update.region');
        Route::get('/admin/delete/region/{id}', 'deleteRegion')->name('delete.region');
    });
    Route::controller(ReceivedPurchaseController::class)->group(function () {
        Route::get('/admin/receive/purchases', 'all')->name('receive.purchases.all');
        Route::get('/admin/receive/purchase/{id}', 'receive')->name('receive.purchase');
        Route::get('/admin/receive/purchase/details/{id}', 'receiveDetails')->name('receive.purchase.details');
        Route::post('/admin/receive/details', 'receiveDetailOn')->name('receive.details');
        Route::get('/admin/receive/incomplete', 'receivedAllIncomplete')->name('receive.purchases.incomplete');
        Route::get('/admin/receive/incomplete/print', 'receivedAllIncompletePrint')->name('print.incomplete.purchase');
    });
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/admin/notification/{id}', 'notify')->name('notification');
        // Route::get('/admin/receive/purchase/{id}', 'receive')->name('receive.purchase');
        // Route::get('/admin/receive/purchase/details/{id}', 'receiveDetails')->name('receive.purchase.details');
        // Route::post('/admin/receive/details', 'receiveDetailOn')->name('receive.details');
        // Route::get('/admin/receive/incomplete', 'receivedAllIncomplete')->name('receive.purchases.incomplete');
        // Route::get('/admin/receive/incomplete/print', 'receivedAllIncompletePrint')->name('print.incomplete.purchase');
    });
});

require __DIR__ . '/auth.php';

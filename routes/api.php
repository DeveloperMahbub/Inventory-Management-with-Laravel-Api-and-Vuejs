<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\VatController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;





Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::apiResource('/employee',EmployeeController::class);
Route::apiResource('/supplier',SupplierController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/product',ProductController::class);
Route::apiResource('/customer',CustomerController::class);

//Stock
Route::post('/stock/update/{id}',[ProductController::class,'stockUpdate']);
Route::apiResource('/expense',ExpenseController::class);

//Salary
Route::post('/salary/paid/{id}',[SalaryController::class,'paid']);
Route::get('/salary',[SalaryController::class,'allSalary']);
Route::get('/salary/view/{id}',[SalaryController::class,'viewSalary']);
Route::get('/edit/salary/{id}',[SalaryController::class,'editSalary']);
Route::post('/salary/update/{id}',[SalaryController::class,'updateSalary']);
Route::get('/getting/product/{id}',[PosController::class,'getProduct']);

//Cart
Route::get('/addToCart/{id}',[CartController::class,'addToCart']);
Route::get('/cart/product',[CartController::class,'cartProduct']);
Route::get('/remove/Cart/{id}',[CartController::class,'removeCart']);
Route::get('/increment/{id}',[CartController::class,'increment']);
Route::get('/deccrement/{id}',[CartController::class,'deccrement']);
//Vat
Route::get('/vats',[VatController::class,'vats']);
Route::post('/orderdone',[PosController::class,'orderDone']);
//Order
Route::get('/orders',[OrderController::class,'todayOrder']);
Route::get('/order/details/{id}',[OrderController::class,'orderCustomerDetails']);
Route::get('/order/orderDetails/{id}',[OrderController::class,'allOrderDetails']);
Route::post('/search/order',[OrderController::class,'searchOrderByDate']);

//Dashbord Route
Route::get('/todaySell',[HomeController::class,'todaySell']);
Route::get('/todayIncome',[HomeController::class,'todayIncome']);
Route::get('/todayDue',[HomeController::class,'todayDue']);
Route::get('/todayExpense',[HomeController::class,'todayExpense']);
Route::get('/stockOut',[HomeController::class,'stockOut']);
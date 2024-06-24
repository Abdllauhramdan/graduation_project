<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineSearchController;
use App\Http\Controllers\SalesOperationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// عرض جميع الفئات
Route::get('categories', [CategoryController::class, 'index']);
// إنشاء فئة جديدة
Route::post('categories', [CategoryController::class, 'store']);
// عرض فئة محددة
Route::get('categories/{category}', [CategoryController::class, 'show']);
// تحديث فئة موجودة
Route::put('categories/{category}', [CategoryController::class, 'update']);
// حذف فئة موجودة
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
// استعادة فئة محذوفة
Route::post('categories/{id}/restore', [CategoryController::class, 'restore']);
// حذف فئة بشكل نهائي
Route::delete('categories/{category}/force', [CategoryController::class, 'forceDelete']);
//////////////////////////////////////////////////////////////////////////////////////////////////


// عرض جميع الأدوية
Route::get('medicines', [MedicineController::class, 'index']);
// إنشاء دواء جديد
Route::post('medicines', [MedicineController::class, 'store']);
// عرض دواء محدد
Route::get('medicines/{medicine}', [MedicineController::class, 'show']);
// تحديث دواء موجود
Route::put('medicines/{medicine}', [MedicineController::class, 'update']);
// حذف دواء موجود
Route::delete('medicines/{medicine}', [MedicineController::class, 'destroy']);
// استعادة دواء محذوف
Route::post('medicines/{id}/restore', [MedicineController::class, 'restore']);
// حذف دواء بشكل نهائي
Route::delete('medicines/{medicine}/force', [MedicineController::class, 'forceDelete']);
//////////////////////////////////////////////////////////////////////////////////////////////////

// البحث عن الأدوية بالاسم
Route::get('medicines/search-by-name', [MedicineSearchController::class, 'searchByName']);
// البحث عن الأدوية بالفئة
Route::get('medicines/search/category', [MedicineSearchController::class, 'searchByCategory']);
// البحث عن الأدوية بالشركة
Route::get('medicines/search/company', [MedicineSearchController::class, 'searchByCompany']);
//////////////////////////////////////////////////////////////////////////////////////////////////
// جلب كل عمليات البيع
Route::get('sales-operations', [SalesOperationController::class, 'index']);
// إنشاء عملية بيع جديدة
Route::post('sales-operations', [SalesOperationController::class, 'store']);
// جلب تفاصيل عملية بيع معينة
Route::get('sales-operations/{salesOperation}', [SalesOperationController::class, 'show']);
// تحديث عملية بيع
Route::put('sales-operations/{salesOperation}', [SalesOperationController::class, 'update']);
// حذف عملية بيع
Route::delete('sales-operations/{salesOperation}', [SalesOperationController::class, 'destroy']);
// استعادة عملية بيع محذوفة
Route::post('sales-operations/{id}/restore', [SalesOperationController::class, 'restore']);
// حذف عملية بيع بشكل دائم
Route::delete('sales-operations/{salesOperation}/force-delete', [SalesOperationController::class, 'forceDelete']);
// إزالة دواء من عملية بيع
Route::delete('sales-operations/{salesOperation}/remove-medicine/{medicineId}', [SalesOperationController::class, 'removeMedicine']);




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});



// مجموعة الراوتات المتعلقة بإدارة المستخدمين والتي تتطلب مصادقة مسبقة
Route::group(['middleware' => ['auth:api']], function () {
    // عرض بيانات المستخدم
    Route::get('/user/{user}', [AuthController::class, 'show']);
    
    // تحديث بيانات المستخدم
    Route::put('/user/{user}', [AuthController::class, 'update']);
    
    // حذف المستخدم
    Route::delete('/user/{user}', [AuthController::class, 'destroy']);
    
    // استعادة المستخدم المحذوف
    Route::post('/user/restore/{id}', [AuthController::class, 'restoreUser']);
    
    // الحذف النهائي للمستخدم
    Route::delete('/user/force-delete/{user}', [AuthController::class, 'forceDeleteUser']);
});

// راوتات الموظفين

// قائمة جميع الموظفين
Route::get('/employees', [EmployeeController::class, 'index']);
// إنشاء موظف جديد
Route::post('/employees', [EmployeeController::class, 'store']);
// عرض تفاصيل موظف محدد
Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
// تحديث بيانات موظف محدد
Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
// حذف موظف محدد
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);
// استعادة موظف محذوف
Route::post('/employees/{id}/restore', [EmployeeController::class, 'restore']);
// حذف موظف بشكل نهائي
Route::delete('/employees/{id}/force-delete', [EmployeeController::class, 'forceDelete']);




// // البحث عن دواء بالاسم
// Route::get('/medicines/search-by-name', [MedicineSearchController::class, 'searchByName']);

// // البحث عن الأدوية بالفئة
// Route::get('/medicines/search-by-category', [MedicineSearchController::class, 'searchByCategory']);

// // البحث عن الأدوية بالشركة المصنعة
// Route::get('/medicines/search-by-company', [MedicineSearchController::class, 'searchByCompany']);

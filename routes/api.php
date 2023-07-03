<?php

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['login' => LoginController::class, 'employees' => EmployeeController::class,
'projects' => ProjectController::class, 'companies' => CompanyController::class]);

Route::get('/company-employees-count-filter', [CompanyController::class, 'companyEmployeesCountFilter']);
Route::get('/company-name-filter', [EmployeeController::class, 'companyNameFilter']);
Route::get('/employees-project-filter', [EmployeeController::class, 'employeeProjectFilter']);
Route::get('/employees-name-project-filter', [EmployeeController::class, 'employeeNameProjectFilter']);
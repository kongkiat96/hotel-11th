<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();


Route::get('logout', 'Auth\LoginController@logout');

Route::middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@index');

    Route::prefix('table')->group(function () {
        Route::get('', 'Table\TableController@index');
    });

    Route::prefix('employee')->group(function () {
        Route::prefix('/list-all-employee')->group(function () {
            Route::get('', 'Employee\EmployeeController@getAllEmployee');
            Route::get('/table-employee-current', 'Employee\EmployeeController@showDataEmployeeCurrent');
            Route::get('/table-employee-disable', 'Employee\EmployeeController@showDataEmployeeDisable');
        });

        Route::prefix('/search-employee')->group(function () {
            Route::get('', 'Employee\EmployeeController@searchEmployee');
        });

        Route::post('/delete-employee/{employeeID}', 'Employee\EmployeeController@deleteEmployee');

        Route::prefix('/edit-employee')->group(function () {
            Route::get('/show-edit-employee/{employeeID}', 'Employee\EmployeeController@showEditEmployee');
            Route::post('/save-edit-employee/{employeeID}', 'Employee\EmployeeController@editEmployee');
        });


        Route::prefix('/add-employee')->group(function () {
            Route::get('', 'Employee\EmployeeController@addEmployee');
            Route::post('/save-employee', 'Employee\EmployeeController@saveEmployee');
        });
    });

    Route::prefix('settings-system')->group(function () {
        Route::prefix('/work-status')->group(function () {
            Route::get('', 'Settings\SetStatusController@index');

            Route::get('/status-modal', 'Settings\SetStatusController@showStatusModal');
            Route::get('/flag-type-modal', 'Settings\SetStatusController@showFlagTypeModal');

            Route::get('/table-status', 'Settings\SetStatusController@showDataStatus');
            Route::get('/table-flag-type', 'Settings\SetStatusController@showDataFlagType');

            Route::post('/save-status', 'Settings\SetStatusController@saveDataStatus');
            Route::get('/show-edit-status/{statusID}', 'Settings\SetStatusController@showEditStatus');
            Route::post('/edit-status/{statusID}', 'Settings\SetStatusController@editStatus');
            Route::post('/delete-status/{statusID}', 'Settings\SetStatusController@deleteStatus');

            Route::post('/save-flag-type', 'Settings\SetStatusController@saveDataFlagType');
            Route::get('/show-edit-flag-type/{flagTypeID}', 'Settings\SetStatusController@showEditFlagType');
            Route::post('/edit-flag-type/{flagTypeID}', 'Settings\SetStatusController@editFlagType');
            Route::post('/delete-flag-type/{flagTypeID}', 'Settings\SetStatusController@deleteFlagType');
        });

        Route::prefix('/menu')->group(function () {
            Route::get('', 'Settings\MenuController@index');
        });

        Route::prefix('/about-company')->group(function () {
            Route::get('', 'Settings\AboutCompanyController@index');

            Route::get('/company-modal', 'Settings\AboutCompanyController@showCompanyModal');
            Route::get('/department-modal', 'Settings\AboutCompanyController@showDepartmentModal');
            Route::get('/group-modal', 'Settings\AboutCompanyController@showGroupModal');
            Route::get('/prefix-name-modal', 'Settings\AboutCompanyController@showPrefixNameModal');
            Route::get('/class-list-modal', 'Settings\AboutCompanyController@showClassListModal');

            Route::get('/table-company', 'Settings\AboutCompanyController@showDataCompany');
            Route::get('/table-department', 'Settings\AboutCompanyController@showDataDepartment');
            Route::get('/table-group', 'Settings\AboutCompanyController@showDataGroup');
            Route::get('/table-prefix-name', 'Settings\AboutCompanyController@showDataPrefixName');
            Route::get('/table-class-list', 'Settings\AboutCompanyController@showDataClassList');

            Route::post('/save-company', 'Settings\AboutCompanyController@saveDataCompany');
            Route::get('/show-edit-company/{companyID}', 'Settings\AboutCompanyController@showEditCompany');
            Route::post('/edit-company/{companyID}', 'Settings\AboutCompanyController@editCompany');
            Route::post('/delete-company/{companyID}', 'Settings\AboutCompanyController@deleteCompany');

            Route::post('/save-department', 'Settings\AboutCompanyController@saveDataDepartment');
            Route::get('/show-edit-department/{departmentID}', 'Settings\AboutCompanyController@showEditDepartment');
            Route::post('/edit-department/{departmentID}', 'Settings\AboutCompanyController@editDepartment');
            Route::post('/delete-department/{departmentID}', 'Settings\AboutCompanyController@deleteDepartment');

            Route::post('/save-group', 'Settings\AboutCompanyController@saveDataGroup');
            Route::get('/show-edit-group/{groupID}', 'Settings\AboutCompanyController@showEditGroup');
            Route::post('/edit-group/{groupID}', 'Settings\AboutCompanyController@editGroup');
            Route::post('/delete-group/{groupID}', 'Settings\AboutCompanyController@deleteGroup');

            Route::post('/save-prefix-name', 'Settings\AboutCompanyController@saveDataPrefixName');
            Route::get('/show-edit-prefix-name/{prefixNameID}', 'Settings\AboutCompanyController@showEditPrefixName');
            Route::post('/edit-prefix-name/{prefixNameID}', 'Settings\AboutCompanyController@editPrefixName');
            Route::post('/delete-prefix-name/{prefixNameID}', 'Settings\AboutCompanyController@deletePrefixName');

            Route::post('/save-class-list', 'Settings\AboutCompanyController@saveDataClassList');
            Route::get('/show-edit-class-list/{classListID}', 'Settings\AboutCompanyController@showEditClassList');
            Route::post('/edit-class-list/{classListID}', 'Settings\AboutCompanyController@editClassList');
            Route::post('/delete-class-list/{classListID}', 'Settings\AboutCompanyController@deleteClassList');
        });
    });


    Route::prefix('getMaster')->group(function () {
        Route::get('/get-company/{id}', 'Master\getDataMasterController@getDataCompany');
        Route::get('/get-department/{id}', 'Master\getDataMasterController@getDataDepartment');
        Route::get('/get-group/{id}', 'Master\getDataMasterController@getDataGroup');
        Route::get('/get-prefix-name', 'Master\getDataMasterController@getDataPrefixName');
        Route::get('/get-province', 'Master\getDataMasterController@getDataProvince');
        Route::get('/get-amphoe/{provinceID}', 'Master\getDataMasterController@getDataAmphoe');
        Route::get('/get-tambon/{aumphoeID}', 'Master\getDataMasterController@getDataTambon');
    });

    Route::prefix('test')->group(function () {
        Route::post('', 'Test\KongkiatController@index');
    });
});


//Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

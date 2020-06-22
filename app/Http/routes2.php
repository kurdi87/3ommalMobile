<?php


$cp_route_name = config('app.cp_route_name');

// Display all SQL executed in Eloquent
Event::listen('illuminate.query', function ($query) {
    var_dump($query);
});

Route::get('/_debugbar/assets/stylesheets', [
    'as' => 'debugbar-css',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
]);

Route::get('/_debugbar/assets/javascript', [
    'as' => 'debugbar-js',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
]);


Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('/', 'Admin\LoginController@index');
    Route::post('login', 'Admin/LoginController@check');
    Route::get('relogin', 'Admin/LoginController@relogin');

}
);


Route::group(['namespace' => 'Admin', 'prefix' => $cp_route_name], function () {


    Route::group(['middleware' => 'admin'], function () {

        // for setting
        Route::get('setting', ['as' => 'edit_setting', 'uses' => 'SettingController@index']);
        Route::post('setting', ['as' => 'update_setting', 'uses' => 'SettingController@update']);
        //end for setting

        //


        Route::get('main', ['as' => 'main', 'uses' => 'LoginController@index']);

        ///////////


        //profile
        Route::get('profile/edit', ['uses' => 'UsersController@profile']);
        Route::get('profile/overview', ['uses' => 'UsersController@profileOverview']);
        Route::post('profile/updateProfile', ['uses' => 'UsersController@updateProfile']);


        Route::get('constants', ['uses' => 'ConstantsController@index']);
        Route::get('constants/view', ['as' => 'constants_view', 'uses' => 'ConstantsController@index']);
        Route::get('constants/viewar', ['as' => 'constants_viewar', 'uses' => 'ConstantsController@index_ar']);
        Route::get('constants/viewru', ['as' => 'constants_viewru', 'uses' => 'ConstantsController@index_ru']);
        Route::get('constants/edit/{id}', ['as' => 'constants_user', 'uses' => 'ConstantsController@edit']);
        Route::post('constants/update/{id}', ['as' => 'constants_user', 'uses' => 'ConstantsController@update']);
        Route::post('constants/uploadImage/{id}/{type}', 'ConstantsController@uploadImage');
        ///////
        Route::get('procedure', ['uses' => 'ProcedureController@index']);
        Route::get('procedure/view', ['as' => 'procedure_view', 'uses' => 'ProcedureController@index']);
        Route::get('procedure/list', ['as' => 'procedure_list', 'uses' => 'ProcedureController@get']);
        Route::get('procedure/changeStatus', ['as' => 'change_procedure_status', 'uses' => 'ProcedureController@changeStatus']);
        Route::get('procedure/edit/{id}', ['as' => '', 'uses' => 'ProcedureController@edit']);
        Route::post('procedure/update/{id}', ['as' => 'procedure_user', 'uses' => 'ProcedureController@update']);
        Route::get('procedure/create', ['as' => 'create_procedure', 'uses' => 'ProcedureController@create']);
        Route::post('procedure/store', ['as' => 'store_procedure', 'uses' => 'ProcedureController@store']);
        Route::get('procedure/delete', ['as' => '', 'uses' => 'ProcedureController@delete']);


        Route::post('procedure/addSub', ['as' => '', 'uses' => 'ProcedureController@addSub']);
        Route::get('procedure/listSubProcedures/{id}', ['as' => '', 'uses' => 'ProcedureController@getSubProcedures']);
        Route::get('procedure/changeSubStatus', ['as' => '', 'uses' => 'ProcedureController@changeSubStatus']);
        Route::get('procedure/editSub/{id}', ['as' => '', 'uses' => 'ProcedureController@editSub']);
        Route::post('procedure/storeSub', ['as' => '', 'uses' => 'ProcedureController@storeSub']);


        ////
        Route::get('financeParty', ['uses' => 'FinancePartyController@index']);
        Route::get('financeParty/view', ['as' => 'financeParty_view', 'uses' => 'FinancePartyController@index']);
        Route::get('financeParty/list', ['as' => 'financeParty_list', 'uses' => 'FinancePartyController@get']);
        Route::get('financeParty/changeStatus', ['as' => 'change_financeParty_status', 'uses' => 'FinancePartyController@changeStatus']);
        Route::get('financeParty/edit/{id}', ['as' => 'financeParty_user', 'uses' => 'FinancePartyController@edit']);
        Route::post('financeParty/update/{id}', ['as' => 'financeParty_user', 'uses' => 'FinancePartyController@update']);
        Route::get('financeParty/create', ['as' => 'create_financeParty', 'uses' => 'FinancePartyController@create']);
        Route::post('financeParty/store', ['as' => 'store_financeParty', 'uses' => 'FinancePartyController@store']);
        Route::post('financeParty/uploadImage/{id}', 'FinancePartyController@uploadImage');
        Route::post('financeParty/addAtt', ['as' => '', 'uses' => 'FinancePartyController@addAtt']);
        Route::get('financeParty/listAtt/{id}', ['as' => '', 'uses' => 'FinancePartyController@getAtt']);
        Route::get('financeParty/changeAttStatus', ['as' => '', 'uses' => 'FinancePartyController@changeAttStatus']);
        Route::get('financeParty/editAtt/{id}', ['as' => '', 'uses' => 'FinancePartyController@editAtt']);
        Route::post('financeParty/storeAtt', ['as' => '', 'uses' => 'FinancePartyController@storeAtt']);
        Route::post('financeParty/uploadAtt/{id}', 'FinancePartyController@uploadAtt');
        ////
        Route::get('employee', ['uses' => 'EmployeeController@index']);
        Route::get('employee/view', ['as' => 'employee_view', 'uses' => 'EmployeeController@index']);
        Route::get('employee/list', ['as' => 'employee_list', 'uses' => 'EmployeeController@get']);
        Route::get('employee/changeStatus', ['as' => 'change_employee_status', 'uses' => 'EmployeeController@changeStatus']);
        Route::get('employee/edit/{id}', ['as' => 'employee_user', 'uses' => 'EmployeeController@edit']);
        Route::post('employee/update/{id}', ['as' => 'employee_user', 'uses' => 'EmployeeController@update']);
        Route::get('employee/create', ['as' => 'create_employee', 'uses' => 'EmployeeController@create']);
        Route::post('employee/store', ['as' => 'store_employee', 'uses' => 'EmployeeController@store']);
        Route::post('employee/uploadImage/{id}', 'EmployeeController@uploadImage');
        Route::post('employee/addAtt', ['as' => '', 'uses' => 'EmployeeController@addAtt']);
        Route::get('employee/listAtt/{id}', ['as' => '', 'uses' => 'EmployeeController@getAtt']);
        Route::get('employee/changeAttStatus', ['as' => '', 'uses' => 'EmployeeController@changeAttStatus']);
        Route::get('employee/editAtt/{id}', ['as' => '', 'uses' => 'EmployeeController@editAtt']);
        Route::post('employee/storeAtt', ['as' => '', 'uses' => 'EmployeeController@storeAtt']);
        Route::post('employee/uploadAtt/{id}', 'EmployeeController@uploadAtt');
        Route::get('employee/printForm/{id}', ['as' => '', 'uses' => 'EmployeeController@printForm']);

        ///
        Route::get('patient', ['uses' => 'PatientController@index']);
        Route::get('patient/view', ['as' => 'patient_view', 'uses' => 'PatientController@index']);
        Route::get('patient/delete', ['as' => '', 'uses' => 'PatientController@delete']);
        Route::get('patient/list', ['as' => 'patient_list', 'uses' => 'PatientController@get']);
        Route::get('patient/changeStatus', ['as' => 'change_patient_status', 'uses' => 'PatientController@changeStatus']);
        Route::get('patient/edit/{id}', ['as' => 'patient_user', 'uses' => 'PatientController@edit']);
        Route::get('patient/patienthistory/{id}', ['as' => 'patient_user', 'uses' => 'PatientController@patienthistory']);
        Route::post('patient/update/{id}', ['as' => 'patient_user', 'uses' => 'PatientController@update']);
        Route::get('patient/create', ['as' => 'create_patient', 'uses' => 'PatientController@create']);
        Route::post('patient/store', ['as' => 'store_patient', 'uses' => 'PatientController@store']);
        Route::post('patient/uploadImage/{id}', 'PatientController@uploadImage');
        Route::post('patient/addAtt', ['as' => '', 'uses' => 'PatientController@addAtt']);
        Route::get('patient/listAtt/{id}', ['as' => '', 'uses' => 'PatientController@getAtt']);
        Route::get('patient/changeAttStatus', ['as' => '', 'uses' => 'PatientController@changeAttStatus']);
        Route::get('patient/editAtt/{id}', ['as' => '', 'uses' => 'PatientController@editAtt']);
        Route::post('patient/storeAtt', ['as' => '', 'uses' => 'PatientController@storeAtt']);
        Route::post('patient/uploadAtt/{id}', 'PatientController@uploadAtt');
        /////////////////////////////////////////////////////////////////////////////
        ///
        Route::get('beneficiary', ['uses' => 'BeneficiaryController@index']);
        Route::get('beneficiary/view', ['as' => 'beneficiary_view', 'uses' => 'BeneficiaryController@index']);
        Route::get('beneficiary/delete', ['as' => '', 'uses' => 'BeneficiaryController@delete']);
        Route::get('beneficiary/list', ['as' => 'beneficiary_list', 'uses' => 'BeneficiaryController@get']);
        Route::get('beneficiary/changeStatus', ['as' => 'change_beneficiary_status', 'uses' => 'BeneficiaryController@changeStatus']);
        Route::get('beneficiary/edit/{id}', ['as' => 'beneficiary_user', 'uses' => 'BeneficiaryController@edit']);
        Route::get('beneficiary/beneficiaryhistory/{id}', ['as' => 'beneficiary_user', 'uses' => 'BeneficiaryController@beneficiaryhistory']);
        Route::post('beneficiary/update/{id}', ['as' => 'beneficiary_user', 'uses' => 'BeneficiaryController@update']);
        Route::get('beneficiary/create', ['as' => 'create_beneficiary', 'uses' => 'BeneficiaryController@create']);
        Route::post('beneficiary/store', ['as' => 'store_beneficiary', 'uses' => 'BeneficiaryController@store']);
        Route::post('beneficiary/uploadImage/{id}', 'BeneficiaryController@uploadImage');
        Route::post('beneficiary/addAtt', ['as' => '', 'uses' => 'BeneficiaryController@addAtt']);
        Route::get('beneficiary/listAtt/{id}', ['as' => '', 'uses' => 'BeneficiaryController@getAtt']);
        Route::get('beneficiary/changeAttStatus', ['as' => '', 'uses' => 'BeneficiaryController@changeAttStatus']);
        Route::get('beneficiary/editAtt/{id}', ['as' => '', 'uses' => 'BeneficiaryController@editAtt']);
        Route::post('beneficiary/storeAtt', ['as' => '', 'uses' => 'BeneficiaryController@storeAtt']);
        Route::post('beneficiary/uploadAtt/{id}', 'BeneficiaryController@uploadAtt');


        Route::post('beneficiary/addDependencies', ['as' => '', 'uses' => 'BeneficiaryController@addDependencies']);
        Route::get('beneficiary/listDependencies/{id}', ['as' => '', 'uses' => 'BeneficiaryController@getDependencies']);
        Route::get('beneficiary/changeDependenciesStatus', ['as' => '', 'uses' => 'BeneficiaryController@changeDependenciesStatus']);
        Route::get('beneficiary/editDependencies/{id}', ['as' => '', 'uses' => 'BeneficiaryController@editDependencies']);
        Route::post('beneficiary/storeDependencies', ['as' => '', 'uses' => 'BeneficiaryController@storeDependencies']);
        Route::post('beneficiary/uploadDependencies/{id}', 'BeneficiaryController@uploadDependencies');

        /////////////////////////////////////////////////////////////////////////////
        ///


        Route::get('speciality', ['uses' => 'SpecialityController@index']);
        Route::get('speciality/view', ['as' => 'speciality_view', 'uses' => 'SpecialityController@index']);
        Route::get('speciality/list', ['as' => 'speciality_list', 'uses' => 'SpecialityController@get']);
        Route::get('speciality/changeStatus', ['as' => 'change_speciality_status', 'uses' => 'SpecialityController@changeStatus']);
        Route::get('speciality/edit/{id}', ['as' => 'speciality_user', 'uses' => 'SpecialityController@edit']);
        Route::post('speciality/update/{id}', ['as' => 'speciality_user', 'uses' => 'SpecialityController@update']);
        Route::get('speciality/create', ['as' => 'create_speciality', 'uses' => 'SpecialityController@create']);
        Route::post('speciality/store', ['as' => 'store_speciality', 'uses' => 'SpecialityController@store']);
        Route::get('speciality/delete', ['uses' => 'SpecialityController@delete']);
        //route
        Route::get('specialityDieseas', ['uses' => 'SpecialityDieseasController@index']);
        Route::get('specialityDieseas/view', ['as' => 'specialityDieseas_view', 'uses' => 'SpecialityDieseasController@index']);
        Route::get('specialityDieseas/list', ['as' => 'specialityDieseas_list', 'uses' => 'SpecialityDieseasController@get']);
        Route::get('specialityDieseas/changeStatus', ['as' => 'change_specialityDieseas_status', 'uses' => 'SpecialityDieseasController@changeStatus']);
        Route::get('specialityDieseas/edit/{id}', ['as' => 'specialityDieseas_user', 'uses' => 'SpecialityDieseasController@edit']);
        Route::post('specialityDieseas/update/{id}', ['as' => 'specialityDieseas_user', 'uses' => 'SpecialityDieseasController@update']);
        Route::get('specialityDieseas/create', ['as' => 'create_specialityDieseas', 'uses' => 'SpecialityDieseasController@create']);
        Route::post('specialityDieseas/store', ['as' => 'store_specialityDieseas', 'uses' => 'SpecialityDieseasController@store']);
        Route::get('specialityDieseas/delete', ['uses' => 'SpecialityDieseasController@delete']);
        ////

        ///
        Route::get('address', ['uses' => 'AddressController@index']);
        Route::get('address/view', ['as' => 'address_view', 'uses' => 'AddressController@index']);
        Route::get('address/list', ['as' => 'address_list', 'uses' => 'AddressController@get']);
        Route::get('address/changeStatus', ['as' => 'change_address_status', 'uses' => 'AddressController@changeStatus']);
        Route::get('address/edit/{id}', ['as' => 'address_user', 'uses' => 'AddressController@edit']);
        Route::post('address/update/{id}', ['as' => 'address_user', 'uses' => 'AddressController@update']);
        Route::get('address/create', ['as' => 'create_address', 'uses' => 'AddressController@create']);
        Route::post('address/store', ['as' => 'store_address', 'uses' => 'AddressController@store']);
        Route::post('address/uploadImage/{id}', 'AddressController@uploadImage');
        Route::post('address/addAtt', ['as' => '', 'uses' => 'AddressController@addAtt']);
        Route::get('address/listAtt/{id}', ['as' => '', 'uses' => 'AddressController@getAtt']);
        Route::get('address/changeAttStatus', ['as' => '', 'uses' => 'AddressController@changeAttStatus']);
        Route::get('address/editAtt/{id}', ['as' => '', 'uses' => 'AddressController@editAtt']);
        Route::post('address/storeAtt', ['as' => '', 'uses' => 'AddressController@storeAtt']);
        Route::post('address/uploadAtt/{id}', 'AddressController@uploadAtt');
        /////////////////////////////////////////////////////////////////////////////
        Route::post('admission/addAtt', ['as' => '', 'uses' => 'AdmissionController@addAtt']);
        Route::get('admission/listAtt/{id}', ['as' => '', 'uses' => 'AdmissionController@getAtt']);
        Route::get('admission/changeAttStatus', ['as' => '', 'uses' => 'AdmissionController@changeAttStatus']);
        Route::get('admission/editAtt/{id}', ['as' => '', 'uses' => 'AdmissionController@editAtt']);
        Route::post('admission/storeAtt', ['as' => '', 'uses' => 'AdmissionController@storeAtt']);
        Route::post('admission/uploadAtt/{id}', 'AdmissionController@uploadAtt');
        Route::get('admission/getMonth', ['as' => '', 'uses' => 'AdmissionController@getMonth']);
        Route::get('admission/getMonthAgent', ['as' => '', 'uses' => 'AdmissionController@getMonthAgent']);
        Route::get('admission/getMonthHospital', ['as' => '', 'uses' => 'AdmissionController@getMonthHospital']);
        Route::get('admission/getDepartmentDischarged', ['as' => '', 'uses' => 'AdmissionController@getDepartmentDischarged']);
        Route::get('admission/getMonthFinanceParty', ['as' => '', 'uses' => 'AdmissionController@getMonthFinanceParty']);
        /////////Treatment Requests
        ///
        Route::get('service', ['uses' => 'ServiceController@index']);
        Route::get('service/view', ['as' => 'service_view', 'uses' => 'ServiceController@index']);
        Route::get('service/list', ['as' => 'service_list', 'uses' => 'ServiceController@get']);
        Route::get('service/changeStatus', ['as' => 'change_service_status', 'uses' => 'ServiceController@changeStatus']);
        Route::get('service/edit/{id}', ['as' => 'service_user', 'uses' => 'ServiceController@edit']);
        Route::post('service/update/{id}', ['as' => 'service_user', 'uses' => 'ServiceController@update']);
        Route::get('service/create', ['as' => 'create_service', 'uses' => 'ServiceController@create']);
        Route::post('service/store', ['as' => 'store_service', 'uses' => 'ServiceController@store']);
        /////////Treatment Requests
        Route::get('treatRequest', ['uses' => 'TreatRequestController@index']);
        Route::get('treatRequest/view', ['as' => 'treatRequest_view', 'uses' => 'TreatRequestController@index']);
        Route::get('treatRequest/list', ['as' => 'treatRequest_list', 'uses' => 'TreatRequestController@get']);
        Route::get('treatRequest/changeStatus', ['as' => 'change_treatRequest_status', 'uses' => 'TreatRequestController@changeStatus']);
        Route::get('treatRequest/edit/{id}', ['as' => 'treatRequest_user', 'uses' => 'TreatRequestController@edit']);
        Route::post('treatRequest/update/{id}', ['as' => 'treatRequest_user', 'uses' => 'TreatRequestController@update']);
        Route::get('treatRequest/create', ['as' => 'create_treatRequest', 'uses' => 'TreatRequestController@create']);
        Route::post('treatRequest/store', ['as' => 'store_treatRequest', 'uses' => 'TreatRequestController@store']);
        ////////
        Route::get('department', ['uses' => 'DepartmentController@index']);
        Route::get('department/view', ['as' => 'department_view', 'uses' => 'DepartmentController@index']);
        Route::get('department/list', ['as' => 'department_list', 'uses' => 'DepartmentController@get']);
        Route::get('department/changeStatus', ['as' => 'change_department_status', 'uses' => 'DepartmentController@changeStatus']);
        Route::get('department/edit/{id}', ['as' => 'department_user', 'uses' => 'DepartmentController@edit']);
        Route::post('department/update/{id}', ['as' => 'department_user', 'uses' => 'DepartmentController@update']);
        Route::get('department/create', ['as' => 'create_department', 'uses' => 'DepartmentController@create']);
        Route::post('department/store', ['as' => 'store_department', 'uses' => 'DepartmentController@store']);
        Route::get('department/delete', ['as' => '', 'uses' => 'DepartmentController@delete']);
        ////
        Route::get('hr_department', ['uses' => 'Hr_departmentController@index']);
        Route::get('hr_department/view', ['as' => 'hr_department_view', 'uses' => 'Hr_departmentController@index']);
        Route::get('hr_department/list', ['as' => 'hr_department_list', 'uses' => 'Hr_departmentController@get']);
        Route::get('hr_department/changeStatus', ['as' => 'change_hr_department_status', 'uses' => 'Hr_departmentController@changeStatus']);
        Route::get('hr_department/edit/{id}', ['as' => 'hr_department_user', 'uses' => 'Hr_departmentController@edit']);
        Route::post('hr_department/update/{id}', ['as' => 'hr_department_user', 'uses' => 'Hr_departmentController@update']);
        Route::get('hr_department/create', ['as' => 'create_hr_department', 'uses' => 'Hr_departmentController@create']);
        Route::post('hr_department/store', ['as' => 'store_hr_department', 'uses' => 'Hr_departmentController@store']);
        Route::get('hr_department/delete', ['as' => '', 'uses' => 'Hr_departmentController@delete']);
        //route
        //route
        Route::get('country', ['uses' => 'CountryController@index']);
        Route::get('country/view', ['as' => 'country_view', 'uses' => 'CountryController@index']);
        Route::get('country/list', ['as' => 'country_list', 'uses' => 'CountryController@get']);
        Route::get('country/changeStatus', ['as' => 'change_country_status', 'uses' => 'CountryController@changeStatus']);
        Route::get('country/edit/{id}', ['as' => 'country_user', 'uses' => 'CountryController@edit']);
        Route::post('country/update/{id}', ['as' => 'country_user', 'uses' => 'CountryController@update']);
        Route::get('country/create', ['as' => 'create_country', 'uses' => 'CountryController@create']);
        Route::post('country/store', ['as' => 'store_country', 'uses' => 'CountryController@store']);
        Route::post('country/uploadImage/{id}', 'CountryController@uploadImage');
        Route::get('country/delete', ['as' => '', 'uses' => 'CountryController@delete']);
        /////
        Route::get('city', ['uses' => 'CityController@index']);
        Route::get('city/view', ['as' => 'city_view', 'uses' => 'CityController@index']);
        Route::get('city/list', ['as' => 'city_list', 'uses' => 'CityController@get']);
        Route::get('city/changeStatus', ['as' => 'change_city_status', 'uses' => 'CityController@changeStatus']);
        Route::get('city/edit/{id}', ['as' => 'city_user', 'uses' => 'CityController@edit']);
        Route::post('city/update/{id}', ['as' => 'city_user', 'uses' => 'CityController@update']);
        Route::get('city/create', ['as' => 'create_city', 'uses' => 'CityController@create']);
        Route::post('city/store', ['as' => 'store_city', 'uses' => 'CityController@store']);
        Route::post('city/uploadImage/{id}', 'CityController@uploadImage');
        Route::get('city/delete', ['as' => '', 'uses' => 'CityController@delete']);
        ///
        Route::get('headline', ['uses' => 'HeadlineController@index']);
        Route::get('headline/view', ['as' => 'headline_view', 'uses' => 'HeadlineController@index']);
        Route::get('headline/list', ['as' => 'headline_list', 'uses' => 'HeadlineController@get']);
        Route::get('headline/changeStatus', ['as' => 'change_headline_status', 'uses' => 'HeadlineController@changeStatus']);
        Route::get('headline/edit/{id}', ['as' => 'headline_user', 'uses' => 'HeadlineController@edit']);
        Route::post('headline/update/{id}', ['as' => 'headline_user', 'uses' => 'HeadlineController@update']);
        Route::get('headline/create', ['as' => 'create_headline', 'uses' => 'HeadlineController@create']);
        Route::post('headline/store', ['as' => 'store_headline', 'uses' => 'HeadlineController@store']);
        Route::post('headline/uploadImage/{id}', 'HeadlineController@uploadImage');

        //Hospitals
        Route::get('recipe', ['uses' => 'RecipeController@index']);
        Route::get('recipe/view', ['as' => 'hospital_view', 'uses' => 'RecipeController@index']);
        Route::get('recipe/list', ['as' => 'hospital_list', 'uses' => 'RecipeController@get']);
        Route::get('recipe/changeStatus', ['as' => 'change_hospital_status', 'uses' => 'RecipeController@changeStatus']);
        Route::get('recipe/edit/{id}', ['as' => 'hospital_user', 'uses' => 'RecipeController@edit']);
        Route::post('recipe/update/{id}', ['as' => 'hospital_user', 'uses' => 'RecipeController@update']);
        Route::post('recipe/addDept', ['as' => '', 'uses' => 'RecipeController@addDept']);
        Route::get('recipe/editDept/{id}', ['as' => '', 'uses' => 'RecipeController@editDept']);
        Route::post('recipe/storeDept', ['as' => '', 'uses' => 'RecipeController@storeDept']);
        Route::get('recipe/listDepartment/{id}', ['as' => '', 'uses' => 'RecipeController@getDepartment']);
        Route::get('recipe/changeDeptStatus', ['as' => '', 'uses' => 'RecipeController@changeDeptStatus']);
        Route::post('recipe/addPro', ['as' => '', 'uses' => 'RecipeController@addPro']);
        Route::get('recipe/listProcedure/{id}', ['as' => '', 'uses' => 'RecipeController@getProcedure']);
        Route::get('recipe/editPro/{id}', ['as' => '', 'uses' => 'RecipeController@editPro']);
        Route::post('recipe/storePro', ['as' => '', 'uses' => 'RecipeController@storePro']);
        Route::get('recipe/changeProStatus', ['as' => '', 'uses' => 'RecipeController@changeProStatus']);
        Route::post('recipe/addStat', ['as' => '', 'uses' => 'RecipeController@addStat']);
        Route::get('recipe/listStatistics/{id}', ['as' => '', 'uses' => 'RecipeController@getStatistics']);
        Route::get('recipe/changeStatStatus', ['as' => '', 'uses' => 'RecipeController@changeStatStatus']);
        Route::get('recipe/editStat/{id}', ['as' => '', 'uses' => 'RecipeController@editStat']);
        Route::post('recipe/storeStat', ['as' => '', 'uses' => 'RecipeController@storeStat']);
        Route::post('recipe/addHospitalAdv', ['as' => '', 'uses' => 'RecipeController@addHospitalAdv']);
        Route::get('recipe/listHospitalAdv/{id}', ['as' => '', 'uses' => 'RecipeController@getHospitalAdv']);
        Route::get('recipe/changeAdvStatus', ['as' => '', 'uses' => 'RecipeController@changeAdvStatus']);
        Route::get('recipe/editHospitalAdv/{id}', ['as' => '', 'uses' => 'RecipeController@editHospitalAdv']);
        Route::post('recipe/storeHospitalAdv', ['as' => '', 'uses' => 'RecipeController@storeHospitalAdv']);
        Route::post('recipe/addPhoto', ['as' => '', 'uses' => 'RecipeController@addPhoto']);
        Route::get('recipe/listPhotos/{id}', ['as' => '', 'uses' => 'RecipeController@getPhoto']);
        Route::get('recipe/changePhotoStatus', ['as' => '', 'uses' => 'RecipeController@changePhotoStatus']);
        Route::get('recipe/editPhoto/{id}', ['as' => '', 'uses' => 'RecipeController@editPhoto']);
        Route::post('recipe/storePhoto', ['as' => '', 'uses' => 'RecipeController@storePhoto']);
        Route::post('recipe/uploadPhoto/{id}', 'RecipeController@uploadPhoto');
        Route::get('recipe/create', ['as' => 'create_hospital', 'uses' => 'RecipeController@create']);
        Route::post('recipe/store', ['as' => 'store_hospital', 'uses' => 'RecipeController@store']);
        Route::post('recipe/uploadImage/{id}', 'RecipeController@uploadImage');
        Route::get('recipe/delete', ['as' => '', 'uses' => 'RecipeController@delete']);
        ///////Events
        //Events
        Route::get('event', ['uses' => 'EventController@index']);
        Route::get('event/view', ['as' => 'event_view', 'uses' => 'EventController@index']);
        Route::get('event/eventprint/{id}', ['as' => '', 'uses' => 'EventController@eventprint']);
        Route::get('event/list', ['as' => 'event_list', 'uses' => 'EventController@get']);
        Route::get('event/referralForm/{id}', ['as' => 'event_viewR', 'uses' => 'EventController@referralForm']);
        Route::get('event/viewR', ['as' => 'event_viewR', 'uses' => 'EventController@indexR']);
        Route::get('event/listR', ['as' => 'event_listR', 'uses' => 'EventController@getR']);
        Route::get('event/changeStatus', ['as' => 'change_event_status', 'uses' => 'EventController@changeStatus']);
        Route::get('event/edit/{id}', ['as' => 'event_user', 'uses' => 'EventController@edit']);
        Route::post('event/update/{id}', ['as' => 'event_user', 'uses' => 'EventController@update']);
        Route::post('event/addDept', ['as' => '', 'uses' => 'EventController@addDept']);
        Route::get('event/editDept/{id}', ['as' => '', 'uses' => 'EventController@editDept']);
        Route::post('event/storeDept', ['as' => '', 'uses' => 'EventController@storeDept']);
        Route::get('event/listDepartment/{id}', ['as' => '', 'uses' => 'EventController@getDepartment']);
        Route::get('event/changeDeptStatus', ['as' => '', 'uses' => 'EventController@changeDeptStatus']);
        Route::post('event/addPro', ['as' => '', 'uses' => 'EventController@addPro']);
        Route::get('event/listProcedure/{id}', ['as' => '', 'uses' => 'EventController@getProcedure']);
        Route::get('event/editPro/{id}', ['as' => '', 'uses' => 'EventController@editPro']);
        Route::get('event/addNewPro', ['as' => '', 'uses' => 'EventController@addNewPro']);
        Route::get('event/process/{id}', ['as' => '', 'uses' => 'EventController@process']);

        Route::post('event/storePro', ['as' => '', 'uses' => 'EventController@storePro']);
        Route::get('event/changeProStatus', ['as' => '', 'uses' => 'EventController@changeProStatus']);

        Route::post('event/addAtt', ['as' => '', 'uses' => 'EventController@addAtt']);
        Route::get('event/listAtt/{id}', ['as' => '', 'uses' => 'EventController@getAtt']);
        Route::get('event/changeAttStatus', ['as' => '', 'uses' => 'EventController@changeAttStatus']);
        Route::get('event/editAtt/{id}', ['as' => '', 'uses' => 'EventController@editAtt']);
        Route::post('event/storeAtt', ['as' => '', 'uses' => 'EventController@storeAtt']);
        Route::post('event/uploadAtt/{id}', 'EventController@uploadAtt');
        Route::get('event/create', ['as' => 'create_event', 'uses' => 'EventController@create']);
        Route::post('event/store', ['as' => 'store_event', 'uses' => 'EventController@store']);
        Route::get('event/email/{id}', ['as' => '', 'uses' => 'EventController@email']);
        Route::post('event/sendEmail', ['as' => 'send_email', 'uses' => 'EventController@sendEmail']);
        Route::post('event/uploadImage/{id}', 'EventController@uploadImage');
        Route::get('event/referralStatus/{id}', ['as' => '', 'uses' => 'EventController@referralStatus']);
        Route::post('event/changeReferralStatus', ['as' => '', 'uses' => 'EventController@changeReferralStatus']);
//////////////////////Exception
        Route::get('exception', ['uses' => 'ExceptionController@index']);
        Route::get('exception/view', ['as' => 'exception_view', 'uses' => 'ExceptionController@index']);
        Route::get('exception/exceptionprint/{id}', ['as' => '', 'uses' => 'ExceptionController@exceptionprint']);
        Route::get('exception/list', ['as' => 'exception_list', 'uses' => 'ExceptionController@get']);
        Route::get('exception/changeStatus', ['as' => 'change_exception_status', 'uses' => 'ExceptionController@changeStatus']);
        Route::get('exception/edit/{id}', ['as' => 'exception_user', 'uses' => 'ExceptionController@edit']);
        Route::post('exception/update/{id}', ['as' => 'exception_user', 'uses' => 'ExceptionController@update']);
        Route::post('exception/addDept', ['as' => '', 'uses' => 'ExceptionController@addDept']);
        Route::get('exception/editDept/{id}', ['as' => '', 'uses' => 'ExceptionController@editDept']);
        Route::post('exception/storeDept', ['as' => '', 'uses' => 'ExceptionController@storeDept']);
        Route::get('exception/listDepartment/{id}', ['as' => '', 'uses' => 'ExceptionController@getDepartment']);
        Route::get('exception/changeDeptStatus', ['as' => '', 'uses' => 'ExceptionController@changeDeptStatus']);
        Route::post('exception/addPro', ['as' => '', 'uses' => 'ExceptionController@addPro']);
        Route::get('exception/listProcedure/{id}', ['as' => '', 'uses' => 'ExceptionController@getProcedure']);
        Route::get('exception/editPro/{id}', ['as' => '', 'uses' => 'ExceptionController@editPro']);
        Route::get('exception/addNewPro', ['as' => '', 'uses' => 'ExceptionController@addNewPro']);
        Route::get('exception/process/{id}', ['as' => '', 'uses' => 'ExceptionController@process']);
        Route::post('exception/storePro', ['as' => '', 'uses' => 'ExceptionController@storePro']);
        Route::get('exception/changeProStatus', ['as' => '', 'uses' => 'ExceptionController@changeProStatus']);

        Route::post('exception/addAtt', ['as' => '', 'uses' => 'ExceptionController@addAtt']);
        Route::get('exception/listAtt/{id}', ['as' => '', 'uses' => 'ExceptionController@getAtt']);
        Route::get('exception/changeAttStatus', ['as' => '', 'uses' => 'ExceptionController@changeAttStatus']);
        Route::get('exception/editAtt/{id}', ['as' => '', 'uses' => 'ExceptionController@editAtt']);
        Route::post('exception/storeAtt', ['as' => '', 'uses' => 'ExceptionController@storeAtt']);
        Route::post('exception/uploadAtt/{id}', 'ExceptionController@uploadAtt');
        Route::get('exception/create', ['as' => 'create_exception', 'uses' => 'ExceptionController@create']);
        Route::post('exception/store', ['as' => 'store_exception', 'uses' => 'ExceptionController@store']);
        Route::post('exception/uploadImage/{id}', 'ExceptionController@uploadImage');


        /////request to call
        Route::get('request_to_call', ['uses' => 'Request_to_callController@index']);
        Route::get('request_to_call/view', ['as' => 'request_to_call_view', 'uses' => 'Request_to_callController@index']);
        Route::get('request_to_call/list', ['as' => '', 'uses' => 'Request_to_callController@get']);


        Route::get('request_to_call/changeStatus', ['as' => 'change_request_to_call_status', 'uses' => 'Request_to_callController@changeStatus']);
        Route::get('request_to_call/edit/{id}', ['as' => 'request_to_call_user', 'uses' => 'Request_to_callController@edit']);
        Route::post('request_to_call/update/{id}', ['as' => 'request_to_call_user', 'uses' => 'Request_to_callController@update']);

        Route::get('request_to_call/process/{id}', ['as' => '', 'uses' => 'Request_to_callController@process']);

        Route::get('request_to_call/create', ['as' => 'create_request_to_call', 'uses' => 'Request_to_callController@create']);
        Route::post('request_to_call/store', ['as' => 'store_request_to_call', 'uses' => 'Request_to_callController@store']);

        /// //////
        ///
        //Events
        Route::get('admission', ['uses' => 'AdmissionController@index']);
        Route::get('admission/view', ['as' => 'admission_view', 'uses' => 'AdmissionController@index']);
        Route::get('admission/list', ['as' => 'admission_list', 'uses' => 'AdmissionController@get']);
        Route::get('admission/changeStatus', ['as' => 'change_admission_status', 'uses' => 'AdmissionController@changeStatus']);
        Route::get('admission/edit/{id}', ['as' => 'admission_user', 'uses' => 'AdmissionController@edit']);
        Route::post('admission/update/{id}', ['as' => 'admission_user', 'uses' => 'AdmissionController@update']);
        Route::get('admission/create', ['as' => 'create_admission', 'uses' => 'AdmissionController@create']);
        Route::post('admission/store', ['as' => 'store_admission', 'uses' => 'AdmissionController@store']);
        Route::get('admission/admissionprint/{id}', ['as' => '', 'uses' => 'AdmissionController@admissionprint']);
        Route::post('admission/addPro', ['as' => '', 'uses' => 'AdmissionController@addPro']);
        Route::get('admission/listProcedure/{id}', ['as' => '', 'uses' => 'AdmissionController@getProcedure']);
        Route::get('admission/editPro/{id}', ['as' => '', 'uses' => 'AdmissionController@editPro']);
        Route::post('admission/storePro', ['as' => '', 'uses' => 'AdmissionController@storePro']);
        Route::get('admission/changeProStatus', ['as' => '', 'uses' => 'AdmissionController@changeProStatus']);
        Route::get('admission/process/{id}', ['as' => '', 'uses' => 'AdmissionController@process']);
        Route::get('admission/visit/{id}', ['as' => '', 'uses' => 'AdmissionController@visit']);
        Route::get('admission/discharge/{id}', ['as' => '', 'uses' => 'AdmissionController@discharge']);
        Route::post('admission/addDischarge', ['as' => '', 'uses' => 'AdmissionController@addDischarge']);
        Route::get('admission/viewVisit/{id}', ['as' => '', 'uses' => 'AdmissionController@viewVisit']);
        Route::get('admission/visitprint/{id}', ['as' => '', 'uses' => 'AdmissionController@visitprint']);
        Route::post('admission/addVisit', ['as' => '', 'uses' => 'AdmissionController@addVisit']);
        Route::post('admission/addAtt', ['as' => '', 'uses' => 'AdmissionController@addAtt']);
        Route::get('admission/listAtt/{id}', ['as' => '', 'uses' => 'AdmissionController@getAtt']);
        Route::get('admission/changeAttStatus', ['as' => '', 'uses' => 'AdmissionController@changeAttStatus']);
        Route::get('admission/editAtt/{id}', ['as' => '', 'uses' => 'AdmissionController@editAtt']);
        Route::post('admission/storeAtt', ['as' => '', 'uses' => 'AdmissionController@storeAtt']);
        Route::post('admission/uploadAtt/{id}', 'AdmissionController@uploadAtt');
        /////////Treatment Requests
        Route::get('invoice', ['uses' => 'InvoiceController@index']);
        Route::get('invoice/view', ['as' => 'invoice_view', 'uses' => 'InvoiceController@index']);
        Route::get('invoice/list', ['as' => 'invoice_list', 'uses' => 'InvoiceController@get']);
        Route::get('invoice/changeStatus', ['as' => 'change_invoice_status', 'uses' => 'InvoiceController@changeStatus']);
        Route::get('invoice/edit/{id}', ['as' => 'invoice_user', 'uses' => 'InvoiceController@edit']);
        Route::post('invoice/update/{id}', ['as' => 'invoice_user', 'uses' => 'InvoiceController@update']);
        Route::get('invoice/create', ['as' => 'create_invoice', 'uses' => 'InvoiceController@create']);
        Route::post('invoice/store', ['as' => 'store_invoice', 'uses' => 'InvoiceController@store']);
        Route::get('invoice/getMonth', ['as' => '', 'uses' => 'InvoiceController@getMonth']);
        Route::get('invoice/getYear', ['as' => '', 'uses' => 'InvoiceController@getYear']);
        Route::get('invoice/SubmitprintInvoice/{id}', ['as' => '', 'uses' => 'InvoiceController@SubmitprintInvoice']);
        Route::get('invoice/getMonthCommision', ['as' => '', 'uses' => 'InvoiceController@getMonthCommision']);


        Route::post('invoice/addPro', ['as' => '', 'uses' => 'InvoiceController@addPro']);
        Route::get('invoice/listProcedure/{id}', ['as' => '', 'uses' => 'InvoiceController@getProcedure']);
        Route::get('invoice/editPro/{id}', ['as' => '', 'uses' => 'InvoiceController@editPro']);
        Route::post('invoice/storePro', ['as' => '', 'uses' => 'InvoiceController@storePro']);
        Route::get('invoice/changeProStatus', ['as' => '', 'uses' => 'InvoiceController@changeProStatus']);
        Route::get('invoice/process/{id}', ['as' => '', 'uses' => 'InvoiceController@process']);
        Route::get('invoice/invoiceForm/{id}', ['as' => '', 'uses' => 'InvoiceController@invoiceForm']);
        Route::post('invoice/addAtt', ['as' => '', 'uses' => 'InvoiceController@addAtt']);
        Route::get('invoice/listAtt/{id}', ['as' => '', 'uses' => 'InvoiceController@getAtt']);
        Route::get('invoice/changeAttStatus', ['as' => '', 'uses' => 'InvoiceController@changeAttStatus']);
        Route::get('invoice/editAtt/{id}', ['as' => '', 'uses' => 'InvoiceController@editAtt']);
        Route::post('invoice/storeAtt', ['as' => '', 'uses' => 'InvoiceController@storeAtt']);
        Route::post('invoice/uploadAtt/{id}', 'InvoiceController@uploadAtt');
        ///
        ///


        /////appoiuntment
        Route::get('appointment', ['uses' => 'AppointmentController@index']);
        Route::get('appointment/view', ['as' => 'appointment_view', 'uses' => 'AppointmentController@index']);
        Route::get('appointment/list', ['as' => 'appointment_list', 'uses' => 'AppointmentController@get']);
        Route::get('appointment/changeStatus', ['as' => 'change_appointment_status', 'uses' => 'AppointmentController@changeStatus']);
        Route::get('appointment/edit/{id}', ['as' => 'appointment_user', 'uses' => 'AppointmentController@edit']);
        Route::post('appointment/update/{id}', ['as' => 'appointment_user', 'uses' => 'AppointmentController@update']);
        Route::get('appointment/reminder/{id}', ['as' => 'appointment_user', 'uses' => 'AppointmentController@reminder']);
        Route::get('appointment/process/{id}', ['as' => '', 'uses' => 'AppointmentController@process']);
        Route::get('appointment/delete', ['as' => '', 'uses' => 'AppointmentController@delete']);

        Route::post('appointment/addAtt', ['as' => '', 'uses' => 'AppointmentController@addAtt']);
        Route::get('appointment/listAtt/{id}', ['as' => '', 'uses' => 'AppointmentController@getAtt']);
        Route::get('appointment/changeAttStatus', ['as' => '', 'uses' => 'AppointmentController@changeAttStatus']);
        Route::get('appointment/editAtt/{id}', ['as' => '', 'uses' => 'AppointmentController@editAtt']);
        Route::post('appointment/storeAtt', ['as' => '', 'uses' => 'AppointmentController@storeAtt']);
        Route::post('appointment/uploadAtt/{id}', 'AppointmentController@uploadAtt');
        Route::get('appointment/create', ['as' => 'create_appointment', 'uses' => 'AppointmentController@create']);
        Route::post('appointment/store', ['as' => 'store_appointment', 'uses' => 'AppointmentController@store']);
        Route::post('appointment/uploadImage/{id}', 'AppointmentController@uploadImage');
        Route::get('appointment/nextappointment/{id}', ['as' => '', 'uses' => 'AppointmentController@nextappointment']);
        Route::post('appointment/addnextappointment', ['as' => '', 'uses' => 'AppointmentController@addnextappointment']);
        Route::post('appointment/storePro', ['as' => '', 'uses' => 'AppointmentController@storePro']);

        Route::get('appointment/actionappointment/{id}', ['as' => '', 'uses' => 'AppointmentController@actionappointment']);
        Route::post('appointment/addactionappointment', ['as' => '', 'uses' => 'AppointmentController@addactionappointment']);


        Route::post('appointment/addPro', ['as' => '', 'uses' => 'AppointmentController@addPro']);
        Route::get('appointment/listProcedure/{id}', ['as' => '', 'uses' => 'AppointmentController@getProcedure']);
        Route::get('appointment/editPro/{id}', ['as' => '', 'uses' => 'AppointmentController@editPro']);
        Route::get('appointment/addNewPro', ['as' => '', 'uses' => 'AppointmentController@addNewPro']);
        Route::get('appointment/event', ['as' => '', 'uses' => 'AppointmentController@event']);
        Route::get('appointment/changeProStatus', ['as' => '', 'uses' => 'AppointmentController@changeProStatus']);
        ///
        Route::get('commitment', ['uses' => 'CommitmentController@index']);
        Route::get('commitment/view', ['as' => 'commitment_view', 'uses' => 'CommitmentController@index']);
        Route::get('commitment/list', ['as' => 'commitment_list', 'uses' => 'CommitmentController@get']);
        Route::get('commitment/changeStatus', ['as' => 'change_commitment_status', 'uses' => 'CommitmentController@changeStatus']);
        Route::get('commitment/edit/{id}', ['as' => 'commitment_user', 'uses' => 'CommitmentController@edit']);
        Route::post('commitment/update/{id}', ['as' => 'commitment_user', 'uses' => 'CommitmentController@update']);
        Route::get('commitment/process/{id}', ['as' => '', 'uses' => 'CommitmentController@process']);
        Route::get('commitment/delete', ['as' => '', 'uses' => 'CommitmentController@delete']);
        Route::post('commitment/addAtt', ['as' => '', 'uses' => 'CommitmentController@addAtt']);
        Route::get('commitment/listAtt/{id}', ['as' => '', 'uses' => 'CommitmentController@getAtt']);
        Route::get('commitment/changeAttStatus', ['as' => '', 'uses' => 'CommitmentController@changeAttStatus']);
        Route::get('commitment/editAtt/{id}', ['as' => '', 'uses' => 'CommitmentController@editAtt']);
        Route::post('commitment/storeAtt', ['as' => '', 'uses' => 'CommitmentController@storeAtt']);
        Route::post('commitment/uploadAtt/{id}', 'CommitmentController@uploadAtt');
        Route::get('commitment/SubmitprintCommitment/{id}', ['as' => '', 'uses' => 'CommitmentController@SubmitprintCommitment']);
        Route::get('commitment/printCommitment/{id}', ['as' => '', 'uses' => 'CommitmentController@printCommitment']);
        Route::get('commitment/create', ['as' => 'create_commitment', 'uses' => 'CommitmentController@create']);
        Route::post('commitment/store', ['as' => 'store_commitment', 'uses' => 'CommitmentController@store']);
        Route::post('commitment/store', ['as' => 'store_commitment', 'uses' => 'CommitmentController@store']);
        Route::post('commitment/uploadImage/{id}', 'CommitmentController@uploadImage');
        Route::get('commitment/event', ['as' => '', 'uses' => 'CommitmentController@event']);
        Route::get('commitment/cstatus/{id}', ['as' => '', 'uses' => 'CommitmentController@cstatus']);
        Route::post('commitment/addcstatus', ['as' => '', 'uses' => 'CommitmentController@addcstatus']);
        Route::get('commitment/email/{id}', ['as' => '', 'uses' => 'CommitmentController@email']);
        Route::post('commitment/sendEmail', ['as' => 'send_email', 'uses' => 'CommitmentController@sendEmail']);
        Route::post('commitment/addPro', ['as' => '', 'uses' => 'CommitmentController@addPro']);
        Route::get('commitment/listProcedure/{id}', ['as' => '', 'uses' => 'CommitmentController@getProcedure']);
        Route::get('commitment/editPro/{id}', ['as' => '', 'uses' => 'CommitmentController@editPro']);
        Route::get('commitment/addNewPro', ['as' => '', 'uses' => 'CommitmentController@addNewPro']);
        Route::get('commitment/changeProStatus', ['as' => '', 'uses' => 'CommitmentController@changeProStatus']);
        Route::post('commitment/addMed', ['as' => '', 'uses' => 'CommitmentController@addMed']);
        Route::get('commitment/listMedication/{id}', ['as' => '', 'uses' => 'CommitmentController@getMedication']);
        Route::get('commitment/editMed/{id}', ['as' => '', 'uses' => 'CommitmentController@editMed']);
        Route::post('commitment/storeMed', ['as' => '', 'uses' => 'CommitmentController@storeMed']);
        Route::post('commitment/storePro', ['as' => '', 'uses' => 'CommitmentController@storePro']);
        Route::get('commitment/addNewMed', ['as' => '', 'uses' => 'CommitmentController@addNewMed']);
        Route::get('commitment/changeMedStatus', ['as' => '', 'uses' => 'CommitmentController@changeMedStatus']);

        ////
        Route::get('claim', ['uses' => 'ClaimController@index']);
        Route::get('claim/view', ['as' => 'claim_view', 'uses' => 'ClaimController@index']);
        Route::get('claim/list', ['as' => 'claim_list', 'uses' => 'ClaimController@get']);
        Route::get('claim/changeStatus', ['as' => 'change_claim_status', 'uses' => 'ClaimController@changeStatus']);
        Route::get('claim/edit/{id}', ['as' => 'claim_user', 'uses' => 'ClaimController@edit']);
        Route::post('claim/update/{id}', ['as' => 'claim_user', 'uses' => 'ClaimController@update']);
        Route::get('claim/process/{id}', ['as' => '', 'uses' => 'ClaimController@process']);
        Route::get('claim/delete', ['as' => '', 'uses' => 'ClaimController@delete']);
        Route::post('claim/addAtt', ['as' => '', 'uses' => 'ClaimController@addAtt']);
        Route::get('claim/listAtt/{id}', ['as' => '', 'uses' => 'ClaimController@getAtt']);
        Route::get('claim/changeAttStatus', ['as' => '', 'uses' => 'ClaimController@changeAttStatus']);
        Route::get('claim/editAtt/{id}', ['as' => '', 'uses' => 'ClaimController@editAtt']);
        Route::post('claim/storeAtt', ['as' => '', 'uses' => 'ClaimController@storeAtt']);
        Route::post('claim/uploadAtt/{id}', 'ClaimController@uploadAtt');
        Route::get('claim/printClaim/{id}', ['as' => '', 'uses' => 'ClaimController@printClaim']);
        Route::get('claim/create', ['as' => 'create_claim', 'uses' => 'ClaimController@create']);
        Route::post('claim/store', ['as' => 'store_claim', 'uses' => 'ClaimController@store']);
        Route::post('claim/uploadImage/{id}', 'ClaimController@uploadImage');
        Route::get('claim/event', ['as' => '', 'uses' => 'ClaimController@event']);
        Route::get('claim/cstatus/{id}', ['as' => '', 'uses' => 'ClaimController@cstatus']);
        Route::post('claim/addcstatus', ['as' => '', 'uses' => 'ClaimController@addcstatus']);
        ///
        ///
        Route::get('accident', ['uses' => 'AccidentController@index']);
        Route::get('accident/view', ['as' => 'accident_view', 'uses' => 'AccidentController@index']);
        Route::get('accident/list', ['as' => 'accident_list', 'uses' => 'AccidentController@get']);
        Route::get('accident/changeStatus', ['as' => 'change_accident_status', 'uses' => 'AccidentController@changeStatus']);
        Route::get('accident/edit/{id}', ['as' => 'accident_user', 'uses' => 'AccidentController@edit']);
        Route::post('accident/update/{id}', ['as' => 'accident_user', 'uses' => 'AccidentController@update']);
        Route::get('accident/process/{id}', ['as' => '', 'uses' => 'AccidentController@process']);
        Route::get('accident/delete', ['as' => '', 'uses' => 'AccidentController@delete']);
        Route::post('accident/addAtt', ['as' => '', 'uses' => 'AccidentController@addAtt']);
        Route::get('accident/listAtt/{id}', ['as' => '', 'uses' => 'AccidentController@getAtt']);
        Route::get('accident/changeAttStatus', ['as' => '', 'uses' => 'AccidentController@changeAttStatus']);
        Route::get('accident/editAtt/{id}', ['as' => '', 'uses' => 'AccidentController@editAtt']);
        Route::post('accident/storeAtt', ['as' => '', 'uses' => 'AccidentController@storeAtt']);
        Route::post('accident/uploadAtt/{id}', 'AccidentController@uploadAtt');
        Route::get('accident/printAccident/{id}', ['as' => '', 'uses' => 'AccidentController@printAccident']);
        Route::get('accident/printAccidentPaitent/{id}', ['as' => '', 'uses' => 'AccidentController@printAccidentPaitent']);
        Route::get('accident/create', ['as' => 'create_accident', 'uses' => 'AccidentController@create']);
        Route::post('accident/store', ['as' => 'store_accident', 'uses' => 'AccidentController@store']);
        Route::post('accident/uploadImage/{id}', 'AccidentController@uploadImage');
        Route::get('accident/event', ['as' => '', 'uses' => 'AccidentController@event']);
        Route::get('accident/cstatus/{id}', ['as' => '', 'uses' => 'AccidentController@cstatus']);
        Route::post('accident/addcstatus', ['as' => '', 'uses' => 'AccidentController@addcstatus']);
        Route::post('accident/addPatient', ['as' => '', 'uses' => 'AccidentController@addPatient']);
        Route::get('accident/listPatient/{id}', ['as' => '', 'uses' => 'AccidentController@getAccidentPatient']);
        Route::get('accident/editPatient/{id}', ['as' => '', 'uses' => 'AccidentController@editPatient']);
        Route::post('accident/storePatient', ['as' => '', 'uses' => 'AccidentController@storePatient']);
        Route::get('accident/changePatientStatus', ['as' => '', 'uses' => 'AccidentController@changePatientStatus']);
        Route::get('accident/getPatientInvoices/{id}', ['as' => '', 'uses' => 'AccidentController@getPatientInvoices']);
        Route::post('accident/addPatientOnly', ['as' => '', 'uses' => 'AccidentController@addPatientOnly']);
        Route::get('accident/listPatientOnly/{id}', ['as' => '', 'uses' => 'AccidentController@getAccidentPatientOnly']);
        Route::get('accident/editPatientOnly/{id}', ['as' => '', 'uses' => 'AccidentController@editPatientOnly']);
        Route::post('accident/storePatientOnly', ['as' => '', 'uses' => 'AccidentController@storePatientOnly']);
        Route::get('accident/changePatientOnlyStatus', ['as' => '', 'uses' => 'AccidentController@changePatientOnlyStatus']);
        Route::get('accident/getData', ['as' => '', 'uses' => 'AccidentController@getData']);
        Route::get('accident/sendData/{id}', ['as' => '', 'uses' => 'AccidentController@sendData']);
        Route::get('accident/email/{id}', ['as' => '', 'uses' => 'AccidentController@email']);
        Route::post('accident/sendEmail', ['as' => 'send_email', 'uses' => 'AccidentController@sendEmail']);
        Route::get('accident/getPatientOnlyInvoices/{id}', ['as' => '', 'uses' => 'AccidentController@getPatientOnlyInvoices']);
        ///
        Route::get('card', ['uses' => 'CardController@index']);
        Route::get('card/view', ['as' => 'card_view', 'uses' => 'CardController@index']);
        Route::get('card/list', ['as' => 'card_list', 'uses' => 'CardController@get']);
        Route::get('card/changeStatus', ['as' => 'change_card_status', 'uses' => 'CardController@changeStatus']);
        Route::get('card/edit/{id}', ['as' => 'card_user', 'uses' => 'CardController@edit']);
        Route::post('card/update/{id}', ['as' => 'card_user', 'uses' => 'CardController@update']);
        Route::get('card/process/{id}', ['as' => '', 'uses' => 'CardController@process']);
        Route::get('card/delete', ['as' => '', 'uses' => 'CardController@delete']);
        Route::post('card/addAtt', ['as' => '', 'uses' => 'CardController@addAtt']);
        Route::get('card/listAtt/{id}', ['as' => '', 'uses' => 'CardController@getAtt']);
        Route::get('card/changeAttStatus', ['as' => '', 'uses' => 'CardController@changeAttStatus']);
        Route::get('card/editAtt/{id}', ['as' => '', 'uses' => 'CardController@editAtt']);
        Route::post('card/storeAtt', ['as' => '', 'uses' => 'CardController@storeAtt']);
        Route::post('card/uploadAtt/{id}', 'CardController@uploadAtt');
        Route::get('card/printCard/{id}', ['as' => '', 'uses' => 'CardController@printCard']);
        Route::get('card/create', ['as' => 'create_card', 'uses' => 'CardController@create']);
        Route::post('card/store', ['as' => 'store_card', 'uses' => 'CardController@store']);
        Route::post('card/uploadImage/{id}', 'CardController@uploadImage');
        Route::get('card/event', ['as' => '', 'uses' => 'CardController@event']);
        Route::get('card/cstatus/{id}', ['as' => '', 'uses' => 'CardController@cstatus']);
        Route::post('card/addcstatus', ['as' => '', 'uses' => 'CardController@addcstatus']);
        ////employee payment
        Route::get('payment', ['uses' => 'PaymentController@index']);
        Route::get('payment/view', ['as' => 'payment_view', 'uses' => 'PaymentController@index']);
        Route::get('payment/list', ['as' => 'payment_list', 'uses' => 'PaymentController@get']);
        Route::get('payment/changeStatus', ['as' => 'change_payment_status', 'uses' => 'PaymentController@changeStatus']);
        Route::get('payment/edit/{id}', ['as' => 'payment_user', 'uses' => 'PaymentController@edit']);
        Route::post('payment/update/{id}', ['as' => 'payment_user', 'uses' => 'PaymentController@update']);
        Route::get('payment/process/{id}', ['as' => '', 'uses' => 'PaymentController@process']);
        Route::get('payment/delete', ['as' => '', 'uses' => 'PaymentController@delete']);
        Route::post('payment/addAtt', ['as' => '', 'uses' => 'PaymentController@addAtt']);
        Route::get('payment/listAtt/{id}', ['as' => '', 'uses' => 'PaymentController@getAtt']);
        Route::get('payment/changeAttStatus', ['as' => '', 'uses' => 'PaymentController@changeAttStatus']);
        Route::get('payment/editAtt/{id}', ['as' => '', 'uses' => 'PaymentController@editAtt']);
        Route::post('payment/storeAtt', ['as' => '', 'uses' => 'PaymentController@storeAtt']);
        Route::post('payment/uploadAtt/{id}', 'PaymentController@uploadAtt');
        Route::get('payment/printPayment/{id}', ['as' => '', 'uses' => 'PaymentController@printPayment']);
        Route::get('payment/create', ['as' => 'create_payment', 'uses' => 'PaymentController@create']);
        Route::post('payment/store', ['as' => 'store_payment', 'uses' => 'PaymentController@store']);
        Route::post('payment/uploadImage/{id}', 'PaymentController@uploadImage');
        Route::get('payment/event', ['as' => '', 'uses' => 'PaymentController@event']);
        Route::get('payment/cstatus/{id}', ['as' => '', 'uses' => 'PaymentController@cstatus']);
        Route::post('payment/addcstatus', ['as' => '', 'uses' => 'PaymentController@addcstatus']);
        Route::get('payment/getMonthPayment', ['as' => '', 'uses' => 'PaymentController@getMonthPayment']);
        ///
        Route::get('revenue', ['uses' => 'RevenueController@index']);
        Route::get('revenue/view', ['as' => 'revenue_view', 'uses' => 'RevenueController@index']);
        Route::get('revenue/list', ['as' => 'revenue_list', 'uses' => 'RevenueController@get']);
        Route::get('revenue/changeStatus', ['as' => 'change_revenue_status', 'uses' => 'RevenueController@changeStatus']);
        Route::get('revenue/edit/{id}', ['as' => 'revenue_user', 'uses' => 'RevenueController@edit']);
        Route::post('revenue/update/{id}', ['as' => 'revenue_user', 'uses' => 'RevenueController@update']);
        Route::get('revenue/process/{id}', ['as' => '', 'uses' => 'RevenueController@process']);
        Route::get('revenue/delete', ['as' => '', 'uses' => 'RevenueController@delete']);
        Route::post('revenue/addAtt', ['as' => '', 'uses' => 'RevenueController@addAtt']);
        Route::get('revenue/listAtt/{id}', ['as' => '', 'uses' => 'RevenueController@getAtt']);
        Route::get('revenue/changeAttStatus', ['as' => '', 'uses' => 'RevenueController@changeAttStatus']);
        Route::get('revenue/editAtt/{id}', ['as' => '', 'uses' => 'RevenueController@editAtt']);
        Route::post('revenue/storeAtt', ['as' => '', 'uses' => 'RevenueController@storeAtt']);
        Route::post('revenue/uploadAtt/{id}', 'RevenueController@uploadAtt');
        Route::get('revenue/printRevenue/{id}', ['as' => '', 'uses' => 'RevenueController@printRevenue']);
        Route::get('revenue/create', ['as' => 'create_revenue', 'uses' => 'RevenueController@create']);
        Route::post('revenue/store', ['as' => 'store_revenue', 'uses' => 'RevenueController@store']);
        Route::post('revenue/uploadImage/{id}', 'RevenueController@uploadImage');
        Route::get('revenue/event', ['as' => '', 'uses' => 'RevenueController@event']);
        Route::get('revenue/cstatus/{id}', ['as' => '', 'uses' => 'RevenueController@cstatus']);
        Route::post('revenue/addcstatus', ['as' => '', 'uses' => 'RevenueController@addcstatus']);
        Route::get('revenue/getMonthRevenue', ['as' => '', 'uses' => 'RevenueController@getMonthRevenue']);


        ///
        Route::get('employeePayment', ['uses' => 'EmployeePaymentController@index']);
        Route::get('employeePayment/view', ['as' => 'employeePayment_view', 'uses' => 'EmployeePaymentController@index']);
        Route::get('employeePayment/list', ['as' => 'employeePayment_list', 'uses' => 'EmployeePaymentController@get']);
        Route::get('employeePayment/changeStatus', ['as' => 'change_employeePayment_status', 'uses' => 'EmployeePaymentController@changeStatus']);
        Route::get('employeePayment/edit/{id}', ['as' => 'employeePayment_user', 'uses' => 'EmployeePaymentController@edit']);
        Route::post('employeePayment/update/{id}', ['as' => 'employeePayment_user', 'uses' => 'EmployeePaymentController@update']);
        Route::get('employeePayment/process/{id}', ['as' => '', 'uses' => 'EmployeePaymentController@process']);
        Route::get('employeePayment/delete', ['as' => '', 'uses' => 'EmployeePaymentController@delete']);
        Route::post('employeePayment/addAtt', ['as' => '', 'uses' => 'EmployeePaymentController@addAtt']);
        Route::get('employeePayment/listAtt/{id}', ['as' => '', 'uses' => 'EmployeePaymentController@getAtt']);
        Route::get('employeePayment/changeAttStatus', ['as' => '', 'uses' => 'EmployeePaymentController@changeAttStatus']);
        Route::get('employeePayment/editAtt/{id}', ['as' => '', 'uses' => 'EmployeePaymentController@editAtt']);
        Route::post('employeePayment/storeAtt', ['as' => '', 'uses' => 'EmployeePaymentController@storeAtt']);
        Route::post('employeePayment/uploadAtt/{id}', 'EmployeePaymentController@uploadAtt');
        Route::get('employeePayment/printEmployeePayment/{id}', ['as' => '', 'uses' => 'EmployeePaymentController@printEmployeePayment']);
        Route::get('employeePayment/create', ['as' => 'create_employeePayment', 'uses' => 'EmployeePaymentController@create']);
        Route::post('employeePayment/store', ['as' => 'store_employeePayment', 'uses' => 'EmployeePaymentController@store']);
        Route::post('employeePayment/uploadImage/{id}', 'EmployeePaymentController@uploadImage');
        Route::get('employeePayment/event', ['as' => '', 'uses' => 'EmployeePaymentController@event']);
        Route::get('employeePayment/cstatus/{id}', ['as' => '', 'uses' => 'EmployeePaymentController@cstatus']);
        Route::post('employeePayment/addcstatus', ['as' => '', 'uses' => 'EmployeePaymentController@addcstatus']);
        Route::get('employeePayment/getMonthPayment', ['as' => '', 'uses' => 'EmployeePaymentController@getMonthPayment']);

        /// ///
        Route::get('gop', ['uses' => 'GopController@index']);
        Route::get('gop/view', ['as' => 'gop_view', 'uses' => 'GopController@index']);
        Route::get('gop/list', ['as' => 'gop_list', 'uses' => 'GopController@get']);
        Route::get('gop/changeStatus', ['as' => 'change_gop_status', 'uses' => 'GopController@changeStatus']);
        Route::get('gop/edit/{id}', ['as' => 'gop_user', 'uses' => 'GopController@edit']);
        Route::post('gop/update/{id}', ['as' => 'gop_user', 'uses' => 'GopController@update']);
        Route::get('gop/GopPrint/{id}', ['as' => '', 'uses' => 'GopController@GopPrint']);
        Route::get('gop/process/{id}', ['as' => '', 'uses' => 'GopController@process']);
        Route::get('gop/delete', ['as' => '', 'uses' => 'GopController@delete']);

        Route::post('gop/addAtt', ['as' => '', 'uses' => 'GopController@addAtt']);
        Route::get('gop/listAtt/{id}', ['as' => '', 'uses' => 'GopController@getAtt']);
        Route::get('gop/changeAttStatus', ['as' => '', 'uses' => 'GopController@changeAttStatus']);
        Route::get('gop/editAtt/{id}', ['as' => '', 'uses' => 'GopController@editAtt']);
        Route::post('gop/storeAtt', ['as' => '', 'uses' => 'GopController@storeAtt']);
        Route::post('gop/uploadAtt/{id}', 'GopController@uploadAtt');
        Route::get('gop/create', ['as' => 'create_gop', 'uses' => 'GopController@create']);
        Route::post('gop/store', ['as' => 'store_gop', 'uses' => 'GopController@store']);
        Route::post('gop/uploadImage/{id}', 'GopController@uploadImage');
        Route::get('gop/nextgop/{id}', ['as' => '', 'uses' => 'GopController@nextgop']);
        Route::post('gop/addnextgop', ['as' => '', 'uses' => 'GopController@addnextgop']);
        Route::post('gop/storePro', ['as' => '', 'uses' => 'GopController@storePro']);


        Route::get('gop/actiongop/{id}', ['as' => '', 'uses' => 'GopController@actiongop']);
        Route::post('gop/addactiongop', ['as' => '', 'uses' => 'GopController@addactiongop']);


        Route::post('gop/addPro', ['as' => '', 'uses' => 'GopController@addPro']);
        Route::get('gop/listProcedure/{id}', ['as' => '', 'uses' => 'GopController@getProcedure']);
        Route::get('gop/editPro/{id}', ['as' => '', 'uses' => 'GopController@editPro']);
        Route::get('gop/addNewPro', ['as' => '', 'uses' => 'GopController@addNewPro']);
        Route::get('gop/event', ['as' => '', 'uses' => 'GopController@event']);
        Route::get('gop/changeProStatus', ['as' => '', 'uses' => 'GopController@changeProStatus']);

        Route::post('gop/addMed', ['as' => '', 'uses' => 'GopController@addMed']);
        Route::get('gop/listMedication/{id}', ['as' => '', 'uses' => 'GopController@getMedication']);
        Route::get('gop/editMed/{id}', ['as' => '', 'uses' => 'GopController@editMed']);
        Route::post('gop/storeMed', ['as' => '', 'uses' => 'GopController@storeMed']);
        Route::get('gop/addNewMed', ['as' => '', 'uses' => 'GopController@addNewMed']);
        Route::get('gop/changeMedStatus', ['as' => '', 'uses' => 'GopController@changeMedStatus']);
        Route::get('gop/email/{id}', ['as' => '', 'uses' => 'GopController@email']);
        Route::post('gop/sendEmail', ['as' => 'send_email', 'uses' => 'GopController@sendEmail']);
        /////
        Route::get('vacation', ['uses' => 'VacationController@index']);
        Route::get('vacation/view', ['as' => 'vacation_view', 'uses' => 'VacationController@index']);
        Route::get('vacation/list', ['as' => 'vacation_list', 'uses' => 'VacationController@get']);
        Route::get('vacation/myView', ['as' => 'vacation_my_view', 'uses' => 'VacationController@indexMy']);
        Route::get('vacation/myList', ['as' => 'vacation_my_list', 'uses' => 'VacationController@getMyVacation']);
        Route::get('vacation/changeStatus', ['as' => 'change_vacation_status', 'uses' => 'VacationController@changeStatus']);
        Route::get('vacation/edit/{id}', ['as' => 'vacation_user', 'uses' => 'VacationController@edit']);
        Route::post('vacation/update/{id}', ['as' => 'vacation_user', 'uses' => 'VacationController@update']);
        Route::get('vacation/VacationPrint/{id}', ['as' => '', 'uses' => 'VacationController@VacationPrint']);
        Route::get('vacation/process/{id}', ['as' => '', 'uses' => 'VacationController@process']);
        Route::get('vacation/delete', ['as' => '', 'uses' => 'VacationController@delete']);
        Route::post('vacation/addAtt', ['as' => '', 'uses' => 'VacationController@addAtt']);
        Route::get('vacation/listAtt/{id}', ['as' => '', 'uses' => 'VacationController@getAtt']);
        Route::get('vacation/changeAttStatus', ['as' => '', 'uses' => 'VacationController@changeAttStatus']);
        Route::get('vacation/editAtt/{id}', ['as' => '', 'uses' => 'VacationController@editAtt']);
        Route::post('vacation/storeAtt', ['as' => '', 'uses' => 'VacationController@storeAtt']);
        Route::post('vacation/uploadAtt/{id}', 'VacationController@uploadAtt');
        Route::get('vacation/create', ['as' => 'vacation_add', 'uses' => 'VacationController@create']);
        Route::post('vacation/store', ['as' => 'store_vacation', 'uses' => 'VacationController@store']);
        Route::post('vacation/uploadImage/{id}', 'VacationController@uploadImage');
        Route::get('vacation/nextvacation/{id}', ['as' => '', 'uses' => 'VacationController@nextvacation']);
        Route::post('vacation/addnextvacation', ['as' => '', 'uses' => 'VacationController@addnextvacation']);
        Route::post('vacation/storePro', ['as' => '', 'uses' => 'VacationController@storePro']);
        Route::get('vacation/actionvacation/{id}', ['as' => '', 'uses' => 'VacationController@actionvacation']);
        Route::post('vacation/addactionvacation', ['as' => '', 'uses' => 'VacationController@addactionvacation']);
        Route::get('vacation/email/{id}', ['as' => '', 'uses' => 'VacationController@email']);
        Route::post('vacation/sendEmail', ['as' => 'send_email', 'uses' => 'VacationController@sendEmail']);
        ///
        Route::get('lead', ['uses' => 'LeadController@index']);
        Route::get('lead/view', ['as' => 'lead_view', 'uses' => 'LeadController@index']);
        Route::get('lead/list', ['as' => 'lead_list', 'uses' => 'LeadController@get']);
        Route::get('lead/changeStatus', ['as' => 'change_lead_status', 'uses' => 'LeadController@changeStatus']);
        Route::get('lead/edit/{id}', ['as' => 'lead_user', 'uses' => 'LeadController@edit']);
        Route::post('lead/update/{id}', ['as' => 'lead_user', 'uses' => 'LeadController@update']);
        Route::get('lead/process/{id}', ['as' => '', 'uses' => 'LeadController@process']);

        Route::post('lead/addAtt', ['as' => '', 'uses' => 'LeadController@addAtt']);
        Route::get('lead/listAtt/{id}', ['as' => '', 'uses' => 'LeadController@getAtt']);
        Route::get('lead/changeAttStatus', ['as' => '', 'uses' => 'LeadController@changeAttStatus']);
        Route::get('lead/editAtt/{id}', ['as' => '', 'uses' => 'LeadController@editAtt']);
        Route::post('lead/storeAtt', ['as' => '', 'uses' => 'LeadController@storeAtt']);
        Route::post('lead/uploadAtt/{id}', 'LeadController@uploadAtt');
        Route::get('lead/create', ['as' => 'create_lead', 'uses' => 'LeadController@create']);
        Route::post('lead/store', ['as' => 'store_lead', 'uses' => 'LeadController@store']);
        Route::post('lead/uploadImage/{id}', 'LeadController@uploadImage');
        Route::post('lead/addPro', ['as' => '', 'uses' => 'LeadController@addPro']);
        Route::get('lead/listProcedure/{id}', ['as' => '', 'uses' => 'LeadController@getProcedure']);
        Route::get('lead/editPro/{id}', ['as' => '', 'uses' => 'LeadController@editPro']);
        Route::get('lead/addNewPro', ['as' => '', 'uses' => 'LeadController@addNewPro']);

        //Doctors
        Route::get('doctor', ['uses' => 'DoctorController@index']);
        Route::get('doctor/view', ['as' => 'doctor_view', 'uses' => 'DoctorController@index']);
        Route::get('doctor/list', ['as' => 'doctor_list', 'uses' => 'DoctorController@get']);
        Route::get('doctor/changeStatus', ['as' => 'change_doctor_status', 'uses' => 'DoctorController@changeStatus']);
        Route::get('doctor/delete', ['as' => '', 'uses' => 'DoctorController@delete']);
        Route::get('doctor/edit/{id}', ['as' => 'doctor_user', 'uses' => 'DoctorController@edit']);
        Route::post('doctor/update/{id}', ['as' => 'doctor_user', 'uses' => 'DoctorController@update']);

        Route::post('doctor/addStat', ['as' => '', 'uses' => 'DoctorController@addStat']);
        Route::get('doctor/editStat/{id}', ['as' => '', 'uses' => 'DoctorController@editStat']);
        Route::post('doctor/storeStat', ['as' => '', 'uses' => 'DoctorController@storeStat']);


        Route::get('doctor/listStatistics/{id}', ['as' => '', 'uses' => 'DoctorController@getStatistics']);
        Route::get('doctor/changeStatStatus', ['as' => '', 'uses' => 'DoctorController@changeStatStatus']);

        Route::get('doctor/create', ['as' => 'create_doctor', 'uses' => 'DoctorController@create']);
        Route::post('doctor/store', ['as' => 'store_doctor', 'uses' => 'DoctorController@store']);

        Route::post('doctor/uploadImage/{id}', 'DoctorController@uploadImage');

        Route::post('doctor/addPro', ['as' => '', 'uses' => 'DoctorController@addPro']);
        Route::get('doctor/listProcedure/{id}', ['as' => '', 'uses' => 'DoctorController@getProcedure']);
        Route::get('doctor/editPro/{id}', ['as' => '', 'uses' => 'DoctorController@editPro']);
        Route::post('doctor/storePro', ['as' => '', 'uses' => 'DoctorController@storePro']);
        Route::get('doctor/changeProStatus', ['as' => '', 'uses' => 'DoctorController@changeProStatus']);

        Route::post('doctor/addNdieseas', ['as' => '', 'uses' => 'DoctorController@addNdieseas']);
        Route::post('doctor/addDieseas', ['as' => '', 'uses' => 'DoctorController@addDieseas']);
        Route::get('doctor/listDieseas/{id}', ['as' => '', 'uses' => 'DoctorController@getDieseas']);
        Route::get('doctor/editDieseas/{id}', ['as' => '', 'uses' => 'DoctorController@editDieseas']);
        Route::post('doctor/storeDieseas', ['as' => '', 'uses' => 'DoctorController@storeDieseas']);
        Route::get('doctor/changeDieseasStatus', ['as' => '', 'uses' => 'DoctorController@changeDieseasStatus']);
        ///////

        Route::get('user', ['as' => 'user_view', 'uses' => 'UsersController@index']);
        Route::get('user/view', ['as' => 'user_view', 'uses' => 'UsersController@index']);
        Route::get('user/list', ['as' => 'user_list', 'uses' => 'UsersController@get']);
        Route::get('user/changeStatus', ['as' => 'change_user_status', 'uses' => 'UsersController@changeStatus']);
        Route::post('user/changePassword', ['as' => 'change_user_password', 'uses' => 'UsersController@changePassword']);
        Route::get('user/changeRole', ['as' => 'change_user_role', 'uses' => 'UsersController@changeRole']);
        Route::get('user/create', ['as' => 'create_user', 'uses' => 'UsersController@create']);
        Route::post('user/store', ['as' => 'store_user', 'uses' => 'UsersController@store']);
        Route::get('user/edit/{id}', ['as' => 'edit_user', 'uses' => 'UsersController@edit']);
        Route::post('user/update/{id}', ['as' => 'update_user', 'uses' => 'UsersController@update']);
        Route::get('user/actionRole/{id}', ['as' => 'action_role', 'uses' => 'UsersController@actionRole']);
        Route::post('user/validateInput/{id?}', ['uses' => 'UsersController@validateInput']);
        ////

        Route::get('role', ['as' => 'role_view', 'uses' => 'RoleController@index']);
        Route::get('role/list', ['as' => 'role_list', 'uses' => 'RoleController@get']);
        Route::get('role/changeStatus/{id}', ['as' => 'change_role_status', 'uses' => 'RoleController@changeStatus']);
        Route::get('role/create', ['as' => 'create_role', 'uses' => 'RoleController@create']);
        Route::post('role/store', ['as' => 'store_role', 'uses' => 'RoleController@store']);
        Route::get('role/edit/{id}', ['as' => 'edit_role', 'uses' => 'RoleController@edit']);
        Route::post('role/update/{id}', ['as' => 'update_role', 'uses' => 'RoleController@update']);
        Route::get('role/usersCount/{id}', ['as' => 'role_user_count', 'uses' => 'RoleController@usersCount']);
        ///
        Route::get('types', ['uses' => 'TypesController@index']);
        Route::get('types/view', ['as' => 'types_view', 'uses' => 'TypesController@index']);
        Route::get('types/list', ['as' => 'types_list', 'uses' => 'TypesController@get']);
        Route::get('types/changeStatus', ['as' => 'change_types_status', 'uses' => 'TypesController@changeStatus']);
        Route::get('types/edit/{id}', ['as' => 'types_user', 'uses' => 'TypesController@edit']);
        Route::post('types/update/{id}', ['as' => 'types_user', 'uses' => 'TypesController@update']);
        Route::get('types/create', ['as' => 'create_types', 'uses' => 'TypesController@create']);
        Route::post('types/store', ['as' => 'store_types', 'uses' => 'TypesController@store']);
        Route::get('types/delete', ['uses' => 'TypesController@delete']);

        // end roles routes
        Route::get('/', 'DashboardController@getIndex');
        Route::get('dashboard', 'DashboardController@getIndex');
        Route::get('dashboard/finance', ['as' => 'dashboard_finance', 'uses' => 'DashboardController@getIndexF']);
        Route::get('dashboard/chron', ['as' => 'dashboard_chron', 'uses' => 'DashboardController@chron']);
        Route::get('dashboard/finance/getStat', ['as' => '', 'uses' => 'DashboardController@getStat']);
        Route::get('logout', 'LoginController@logout');
        Route::get('lock', 'LoginController@lock');
        Route::post('upload/{name?}/{package?}', 'SuperAdminController@uploadAjax');
        Route::post('uploadProfile', 'SuperAdminController@uploadProfile');
        Route::post('updatePasswordProfile', 'UsersController@updatePasswordProfile');
        // for ajax routes
        Route::post('ajax/upload', ['as' => 'upload_media_item', 'uses' => 'AjaxController@postUpload']);
        // end ajax routes
        Route::controller('ajax', 'AjaxController');
    });
    Route::group(['middleware' => 'admin.guest'], function () {
        // for login

        Route::get('login', 'LoginController@index');
        Route::post('login', 'LoginController@check');
        Route::get('relogin', 'LoginController@relogin');
    });


});


Route::group(['middleware' => 'site'], function () {

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'LoginController@getLogout');
    });
    Route::post('validateInput/{id?}', ['uses' => 'LoginController@validateInput']);  // Route::controller('/', 'HomepageController');

});

Route::group(['prefix' => 'api'], function ($router) {

    Route::group(['namespace' => 'Admin\API\Controllers'], function ($route) {

        Route::post('user/login', 'SessionController@create');
        Route::group(['middleware' => 'jwt.auth'], function ($route) {

            //   Route::post('customer/register', 'CustomerController@create');


            //Invoice routes


            // Route::post('customer/forgot-password', 'ForgotPasswordController@store');

            Route::get('user/logout', 'SessionController@destroy');

            //Route::get('customer/get', 'SessionController@get');

            //('customer/profile', 'SessionController@update');

            /*  Route::get('customers/{id}', 'ResourceController@get')->defaults('_config', [
                  'repository' => 'Webkul\Customer\Repositories\CustomerRepository',
                  'resource' => 'Webkul\API\Http\Resources\Customer\Customer',
                  'authorization_required' => true
              ]);*/


            Route::get('accident', 'AccidentController@index');

            Route::get('accident/{id}', 'AccidentController@get');

            Route::delete('accident/{id}', 'AccidentController@destroy');

            Route::put('accident/{id}', 'AccidentController@update');

            Route::post('accident/create', 'AccidentController@store');


            Route::delete('accidentAtt/{id}', ['as' => '', 'uses' => 'AccidentController@destroyAtt']);


            Route::post('accidentAtt/create/{id}', 'AccidentController@uploadAtt');

            Route::delete('accidentPatient/{id}', ['as' => '', 'uses' => 'AccidentController@changePatientOnlyStatus']);

            Route::put('accidentPatient/{id}', ['as' => '', 'uses' => 'AccidentController@updatePatientOnly']);
            Route::post('accidentPatient/create/{id}', ['as' => '', 'uses' => 'AccidentController@storePatientOnly']);
            Route::get('accident/getData', ['as' => '', 'uses' => 'AccidentController@getData']);
            Route::get('accident/sendData/{id}', ['as' => '', 'uses' => 'AccidentController@sendData']);


            //
            /*
            Route::get('chat/', 'ChatController@index');
            Route::get('chat/{message}', 'ChatController@show');
            Route::post('chat', 'ChatController@store');
            Route::put('chat/{message}', 'ChatController@update');
            Route::patch('chat/{message}', 'ChatController@update');
            Route::delete('chat/{message}', 'ChatController@destroy');


            //Wishlist routes
           */
        });
    });
});
  


 
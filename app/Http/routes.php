<?php


$cp_route_name = config('app.cp_route_name');
$user_route_name = config('app.user_route_name');

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
    Route::get('website', 'LaborController@index');
    Route::get('index', 'LaborController@index');
    Route::get('Main Page', 'LaborController@index');
    Route::get('/', 'LaborController@index');
    Route::get('/main', 'LaborController@web');
    Route::get('register', 'LaborController@register');
    Route::get('newUser', 'LaborController@newUser');
    Route::get('about', 'LaborController@about');
    Route::get('contact', 'LaborController@contact');
    Route::get('privacy', 'LaborController@privacy');
    Route::get('category', 'LaborController@getCategories');
    Route::get('subCategory', 'LaborController@getSubCategories');
    Route::get('term', 'LaborController@term');
    Route::get('job-application', 'LaborController@jobApplication');
    Route::get('policy', 'LaborController@policy');

}
);


Route::group(['namespace' => 'User', 'prefix' => $user_route_name], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        // for login
        Route::get('login', 'UserLoginController@index');
        Route::get('forget_password', 'UserLoginController@forget_password');
        Route::post('login', 'UserLoginController@check');
        Route::get('autologin', 'UserLoginController@check');
        Route::post('reset_password', 'UserLoginController@resetPassword');
        Route::post('create', 'UserLoginController@create');

        Route::get('relogin', 'UserLoginController@relogin');
        Route::get('logout', 'UserLoginController@logout');
        Route::get('lock', 'UserLoginController@lock');
        Route::post('verify', 'UserLoginController@verify');
        Route::get('verifyPass', 'UserLoginController@verifyPass');
        Route::post('sendCode', 'UserLoginController@sendCode');
        Route::get('reset_new_password', 'UserLoginController@reset_new_password');
        Route::post('newPass', 'UserLoginController@newPass');
        Route::post('uploadFile', 'UserLaborController@uploadFile');

        Route::get('profile', 'UserLaborController@profile');

        Route::post('updateProfile', 'UserLaborController@updateProfile');
        Route::post('createRefund', 'UserLaborController@createRefund');
        Route::get('refund', 'UserLaborController@refund');
        Route::post('createInjury', 'UserLaborController@createInjury');
        Route::post('jobApplication', 'UserLaborController@jobApplication');
        Route::get('injury', 'UserLaborController@injury');
        Route::get('requests', 'UserLaborController@requests');

    });


});
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
        // menu
        Route::get('menu', ['as' => 'menu_view', 'uses' => 'MenuController2@index']);
        Route::get('menu/view', ['as' => 'menu_view', 'uses' => 'MenuController2@index']);
        Route::get('menu/list', ['as' => 'menu_list', 'uses' => 'MenuController2@get']);
        Route::get('menu/changeStatus', ['as' => 'change_menu_status', 'uses' => 'MenuController2@changeStatus']);
        Route::get('menu/edit/{id}', ['as' => '', 'uses' => 'MenuController2@edit']);
        Route::post('menu/update/{id}', ['as' => '', 'uses' => 'MenuController2@update']);
        Route::get('menu/create', ['as' => '', 'uses' => 'MenuController2@create']);
        Route::post('menu/store', ['as' => '', 'uses' => 'MenuController2@store']);
        ///////
        /////////////////////////////////////////////////////////////////////////////
        ///
        Route::get('skill', ['uses' => 'SkillController@index']);
        Route::get('skill/view', ['as' => 'skill_view', 'uses' => 'SkillController@index']);
        Route::get('skill/list', ['as' => 'skill_list', 'uses' => 'SkillController@get']);
        Route::get('skill/changeStatus', ['as' => 'change_skill_status', 'uses' => 'SkillController@changeStatus']);
        Route::get('skill/edit/{id}', ['as' => 'skill_user', 'uses' => 'SkillController@edit']);
        Route::post('skill/update/{id}', ['as' => 'skill_user', 'uses' => 'SkillController@update']);
        Route::get('skill/create', ['as' => 'create_skill', 'uses' => 'SkillController@create']);
        Route::post('skill/store', ['as' => 'store_skill', 'uses' => 'SkillController@store']);
        Route::get('skill/delete', ['uses' => 'SkillController@delete']);
        //route

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
        Route::get('question', ['uses' => 'QuestionController@index']);
        Route::get('question/view', ['as' => 'question_view', 'uses' => 'QuestionController@index']);
        Route::get('question/list', ['as' => 'question_list', 'uses' => 'QuestionController@get']);
        Route::get('question/changeStatus', ['as' => 'change_question_status', 'uses' => 'QuestionController@changeStatus']);
        Route::get('question/edit/{id}', ['as' => 'question_user', 'uses' => 'QuestionController@edit']);
        Route::post('question/update/{id}', ['as' => 'question_user', 'uses' => 'QuestionController@update']);
        Route::get('question/create', ['as' => 'create_question', 'uses' => 'QuestionController@create']);
        Route::post('question/store', ['as' => 'store_question', 'uses' => 'QuestionController@store']);
        Route::get('question/delete', ['uses' => 'QuestionController@delete']);
        Route::get('question/process/{id}', ['as' => '', 'uses' => 'QuestionController@process']);
        Route::post('question/addOption', ['as' => '', 'uses' => 'QuestionController@addOption']);
        Route::get('question/listOption/{id}', ['as' => '', 'uses' => 'QuestionController@getOption']);
        Route::get('question/editOption/{id}', ['as' => '', 'uses' => 'QuestionController@editOption']);
        Route::get('question/addNewOption', ['as' => '', 'uses' => 'QuestionController@addNewOption']);
        Route::get('question/changeOptionStatus', ['as' => '', 'uses' => 'QuestionController@changeOptionStatus']);
        Route::get('question/deleteOption', ['as' => '', 'uses' => 'QuestionController@deleteOption']);
        Route::post('question/storeOption', ['as' => '', 'uses' => 'QuestionController@storeOption']);
        ////
        Route::get('jobs', ['uses' => 'JobsController@index']);
        Route::get('jobs/view', ['as' => 'jobs_view', 'uses' => 'JobsController@index']);
        Route::get('jobs/list', ['as' => 'jobs_list', 'uses' => 'JobsController@get']);
        Route::get('jobs/changeStatus', ['as' => 'change_jobs_status', 'uses' => 'JobsController@changeStatus']);
        Route::get('jobs/edit/{id}', ['as' => 'jobs_user', 'uses' => 'JobsController@edit']);
        Route::post('jobs/update/{id}', ['as' => 'jobs_user', 'uses' => 'JobsController@update']);
        Route::get('jobs/create', ['as' => 'create_jobs', 'uses' => 'JobsController@create']);
        Route::post('jobs/store', ['as' => 'store_jobs', 'uses' => 'JobsController@store']);
        Route::get('jobs/delete', ['uses' => 'JobsController@delete']);
        Route::get('jobs/process/{id}', ['as' => '', 'uses' => 'JobsController@process']);

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
        Route::get('injury', ['uses' => 'InjuryController@index']);
        Route::get('injury/view', ['as' => 'injury_view', 'uses' => 'InjuryController@index']);
        Route::get('injury/list', ['as' => 'injury_list', 'uses' => 'InjuryController@get']);
        Route::get('injury/changeStatus', ['as' => 'change_injury_status', 'uses' => 'InjuryController@changeStatus']);
        Route::get('injury/edit/{id}', ['as' => 'injury_user', 'uses' => 'InjuryController@edit']);
        Route::post('injury/update/{id}', ['as' => 'injury_user', 'uses' => 'InjuryController@update']);
        Route::get('injury/create', ['as' => 'create_injury', 'uses' => 'InjuryController@create']);
        Route::post('injury/store', ['as' => 'store_injury', 'uses' => 'InjuryController@store']);
        Route::post('injury/addAtt', ['as' => '', 'uses' => 'InjuryController@addAtt']);
        Route::get('injury/listAtt/{id}', ['as' => '', 'uses' => 'InjuryController@getAtt']);
        Route::get('injury/changeAttStatus', ['as' => '', 'uses' => 'InjuryController@changeAttStatus']);
        Route::get('injury/editAtt/{id}', ['as' => '', 'uses' => 'InjuryController@editAtt']);
        Route::post('injury/storeAtt', ['as' => '', 'uses' => 'InjuryController@storeAtt']);
        Route::post('injury/uploadAtt/{id}', 'InjuryController@uploadAtt');
        ////////
        Route::get('job', ['uses' => 'JobController@index']);
        Route::get('job/view', ['as' => 'job_view', 'uses' => 'JobController@index']);
        Route::get('job/list', ['as' => 'job_list', 'uses' => 'JobController@get']);
        Route::get('job/changeStatus', ['as' => 'change_job_status', 'uses' => 'JobController@changeStatus']);
        Route::get('job/edit/{id}', ['as' => 'job_user', 'uses' => 'JobController@edit']);
        Route::post('job/update/{id}', ['as' => 'job_user', 'uses' => 'JobController@update']);
        Route::get('job/create', ['as' => 'create_job', 'uses' => 'JobController@create']);
        Route::post('job/store', ['as' => 'store_job', 'uses' => 'JobController@store']);
        Route::post('job/addAtt', ['as' => '', 'uses' => 'JobController@addAtt']);
        Route::get('job/listAtt/{id}', ['as' => '', 'uses' => 'JobController@getAtt']);
        Route::get('job/changeAttStatus', ['as' => '', 'uses' => 'JobController@changeAttStatus']);
        Route::get('job/editAtt/{id}', ['as' => '', 'uses' => 'JobController@editAtt']);
        Route::post('job/storeAtt', ['as' => '', 'uses' => 'JobController@storeAtt']);
        Route::post('job/uploadAtt/{id}', 'JobController@uploadAtt');

        /////request to call
        /// 
        Route::get('salary', ['uses' => 'SalaryController@index']);
        Route::get('salary/view', ['as' => 'salary_view', 'uses' => 'SalaryController@index']);
        Route::get('salary/list', ['as' => 'salary_list', 'uses' => 'SalaryController@get']);
        Route::get('salary/changeStatus', ['as' => 'change_salary_status', 'uses' => 'SalaryController@changeStatus']);
        Route::get('salary/edit/{id}', ['as' => 'salary_user', 'uses' => 'SalaryController@edit']);
        Route::post('salary/update/{id}', ['as' => 'salary_user', 'uses' => 'SalaryController@update']);
        Route::get('salary/create', ['as' => 'create_salary', 'uses' => 'SalaryController@create']);
        Route::post('salary/store', ['as' => 'store_salary', 'uses' => 'SalaryController@store']);
        Route::post('salary/addAtt', ['as' => '', 'uses' => 'SalaryController@addAtt']);
        Route::get('salary/listAtt/{id}', ['as' => '', 'uses' => 'SalaryController@getAtt']);
        Route::get('salary/changeAttStatus', ['as' => '', 'uses' => 'SalaryController@changeAttStatus']);
        Route::get('salary/editAtt/{id}', ['as' => '', 'uses' => 'SalaryController@editAtt']);
        Route::post('salary/storeAtt', ['as' => '', 'uses' => 'SalaryController@storeAtt']);
        Route::post('salary/uploadAtt/{id}', 'SalaryController@uploadAtt');
        
        
        Route::get('request_to_call', ['uses' => 'Request_to_callController@index']);
        Route::get('request_to_call/view', ['as' => 'request_to_call_view', 'uses' => 'Request_to_callController@index']);
        Route::get('request_to_call/list', ['as' => '', 'uses' => 'Request_to_callController@get']);
///
        // menu

        ///////

        Route::get('request_to_call/changeStatus', ['as' => 'change_request_to_call_status', 'uses' => 'Request_to_callController@changeStatus']);
        Route::get('request_to_call/edit/{id}', ['as' => 'request_to_call_user', 'uses' => 'Request_to_callController@edit']);
        Route::post('request_to_call/update/{id}', ['as' => 'request_to_call_user', 'uses' => 'Request_to_callController@update']);

        Route::get('request_to_call/process/{id}', ['as' => '', 'uses' => 'Request_to_callController@process']);

        Route::get('request_to_call/create', ['as' => 'create_request_to_call', 'uses' => 'Request_to_callController@create']);
        Route::post('request_to_call/store', ['as' => 'store_request_to_call', 'uses' => 'Request_to_callController@store']);

        /// //////
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

        //Recipes
        //Recipes
        Route::get('recipe', ['uses' => 'RecipeController@index']);
        Route::get('recipe/view', ['as' => 'recipe_view', 'uses' => 'RecipeController@index']);
        Route::get('recipe/list', ['as' => 'recipe_list', 'uses' => 'RecipeController@get']);
        Route::get('recipe/changeStatus', ['as' => 'change_recipe_status', 'uses' => 'RecipeController@changeStatus']);

        Route::get('recipe/edit/{id}', ['as' => 'recipe_user', 'uses' => 'RecipeController@edit']);
        Route::post('recipe/update/{id}', ['as' => 'recipe_user', 'uses' => 'RecipeController@update']);

        Route::post('recipe/addDept', ['as' => '', 'uses' => 'RecipeController@addDept']);

        Route::get('recipe/editDept/{id}', ['as' => '', 'uses' => 'RecipeController@editDept']);
        Route::post('recipe/storeDept', ['as' => '', 'uses' => 'RecipeController@storeDept']);

        Route::get('recipe/listDepartment/{id}', ['as' => '', 'uses' => 'RecipeController@getDepartment']);
        Route::get('recipe/changeDeptStatus', ['as' => '', 'uses' => 'RecipeController@changeDeptStatus']);

        Route::post('recipe/addCategory', ['as' => '', 'uses' => 'RecipeController@addCategory']);
        Route::get('recipe/listCategory/{id}', ['as' => '', 'uses' => 'RecipeController@getCategory']);
        Route::get('recipe/editCategory/{id}', ['as' => '', 'uses' => 'RecipeController@editCategory']);
        Route::post('recipe/storeCategory', ['as' => '', 'uses' => 'RecipeController@storeCategory']);

        Route::get('recipe/changeCategoryStatus', ['as' => '', 'uses' => 'RecipeController@changeCategoryStatus']);

        Route::post('recipe/addStat', ['as' => '', 'uses' => 'RecipeController@addStat']);
        Route::get('recipe/listStatistics/{id}', ['as' => '', 'uses' => 'RecipeController@getStatistics']);
        Route::get('recipe/changeValue', ['as' => '', 'uses' => 'RecipeController@changeValue']);
        Route::get('recipe/changeStatStatus', ['as' => '', 'uses' => 'RecipeController@changeStatStatus']);
        Route::get('recipe/editStat/{id}', ['as' => '', 'uses' => 'RecipeController@editStat']);
        Route::post('recipe/storeStat', ['as' => '', 'uses' => 'RecipeController@storeStat']);

        Route::post('recipe/addRecipeAdv', ['as' => '', 'uses' => 'RecipeController@addRecipeAdv']);
        Route::get('recipe/listRecipeAdv/{id}', ['as' => '', 'uses' => 'RecipeController@getRecipeAdv']);
        Route::get('recipe/changeAdvStatus', ['as' => '', 'uses' => 'RecipeController@changeAdvStatus']);
        Route::get('recipe/editAdv/{id}', ['as' => '', 'uses' => 'RecipeController@editRecipeAdv']);
        Route::post('recipe/storeAdv', ['as' => '', 'uses' => 'RecipeController@storeRecipeAdv']);


        Route::post('recipe/addPhoto', ['as' => '', 'uses' => 'RecipeController@addPhoto']);
        Route::get('recipe/listPhotos/{id}', ['as' => '', 'uses' => 'RecipeController@getPhoto']);
        Route::get('recipe/changePhotoStatus', ['as' => '', 'uses' => 'RecipeController@changePhotoStatus']);
        Route::get('recipe/editPhoto/{id}', ['as' => '', 'uses' => 'RecipeController@editPhoto']);
        Route::post('recipe/storePhoto', ['as' => '', 'uses' => 'RecipeController@storePhoto']);
        Route::post('recipe/uploadPhoto/{id}', 'RecipeController@uploadPhoto');


        Route::get('recipe/create', ['as' => 'create_recipe', 'uses' => 'RecipeController@create']);
        Route::post('recipe/store', ['as' => 'store_recipe', 'uses' => 'RecipeController@store']);

        Route::post('recipe/uploadImage/{id}', 'RecipeController@uploadImage');
        Route::get('recipe/delete', ['uses' => 'RecipeController@delete']);
        Route::post('recipe/addNdieseas', ['as' => '', 'uses' => 'RecipeController@addNdieseas']);
        Route::post('recipe/addDieseas', ['as' => '', 'uses' => 'RecipeController@addDieseas']);
        Route::get('recipe/listDieseas/{id}', ['as' => '', 'uses' => 'RecipeController@getDieseas']);
        Route::get('recipe/editDieseas/{id}', ['as' => '', 'uses' => 'RecipeController@editDieseas']);
        Route::post('recipe/storeDieseas', ['as' => '', 'uses' => 'RecipeController@storeDieseas']);
        Route::get('recipe/changeDieseasStatus', ['as' => '', 'uses' => 'RecipeController@changeDieseasStatus']);



        /////request to call
        ///
        Route::get('category', ['uses' => 'CategoryController@index']);
        Route::get('category/view', ['as' => 'category_view', 'uses' => 'CategoryController@index']);
        Route::get('category/list', ['as' => 'category_list', 'uses' => 'CategoryController@get']);
        Route::get('category/changeStatus', ['as' => 'change_category_status', 'uses' => 'CategoryController@changeStatus']);
        Route::get('category/edit/{id}', ['as' => 'category_user', 'uses' => 'CategoryController@edit']);
        Route::post('category/update/{id}', ['as' => 'category_user', 'uses' => 'CategoryController@update']);
        Route::get('category/create', ['as' => 'create_category', 'uses' => 'CategoryController@create']);
        Route::post('category/store', ['as' => 'store_category', 'uses' => 'CategoryController@store']);
        Route::get('category/delete', ['uses' => 'CategoryController@delete']);

        Route::post('category/addSub', ['as' => '', 'uses' => 'CategoryController@addSub']);
        Route::get('category/listSubCategorys/{id}', ['as' => '', 'uses' => 'CategoryController@getSubCategorys']);
        Route::get('category/changeSubStatus', ['as' => '', 'uses' => 'CategoryController@changeSubStatus']);
        Route::get('category/editSub/{id}', ['as' => '', 'uses' => 'CategoryController@editSub']);
        Route::post('category/storeSub', ['as' => '', 'uses' => 'CategoryController@storeSub']);

////


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
        ///
        Route::get('user', ['as' => 'userCustomer_view', 'uses' => 'UsersCustomerController@index']);
        Route::get('userCustomer/view', ['as' => 'user_customer_view', 'uses' => 'UsersCustomerController@index']);
        Route::get('userCustomer/list', ['as' => 'user_customer_list', 'uses' => 'UsersCustomerController@get']);
        Route::get('userCustomer/changeStatus', ['as' => 'change_user_customer_status', 'uses' => 'UsersCustomerController@changeStatus']);
        Route::post('userCustomer/changePassword', ['as' => 'change_user_customer_password', 'uses' => 'UsersCustomerController@changePassword']);
        Route::get('userCustomer/changeRole', ['as' => 'change_user_customer_role', 'uses' => 'UsersCustomerController@changeRole']);
        Route::get('userCustomer/create', ['as' => 'create_user_customer', 'uses' => 'UsersCustomerController@create']);
        Route::post('userCustomer/store', ['as' => 'store_user_customer', 'uses' => 'UsersCustomerController@store']);
        Route::get('userCustomer/edit/{id}', ['as' => 'edit_user_customer', 'uses' => 'UsersCustomerController@edit']);
        Route::post('userCustomer/update/{id}', ['as' => 'update_user_customer', 'uses' => 'UsersCustomerController@update']);
        Route::post('userCustomer/uploadCustomerProfile/{id}', ['uses' => 'UsersCustomerController@uploadUserProfile']);
        Route::get('userCustomer/actionRole/{id}', ['as' => 'action_role_customer', 'uses' => 'UsersCustomerController@actionRole']);
        Route::post('userCustomer/validateInput/{id?}', ['uses' => 'UsersCustomerController@validateInput']);
        /////

        ////
        ///

        Route::get('role', ['as' => 'role_view', 'uses' => 'RoleController@index']);
        Route::get('role/list', ['as' => 'role_list', 'uses' => 'RoleController@get']);
        Route::get('role/changeStatus/{id}', ['as' => 'change_role_status', 'uses' => 'RoleController@changeStatus']);
        Route::get('role/create', ['as' => 'create_role', 'uses' => 'RoleController@create']);
        Route::post('role/store', ['as' => 'store_role', 'uses' => 'RoleController@store']);
        Route::get('role/edit/{id}', ['as' => 'edit_role', 'uses' => 'RoleController@edit']);
        Route::post('role/update/{id}', ['as' => 'update_role', 'uses' => 'RoleController@update']);
        Route::get('role/usersCount/{id}', ['as' => 'role_user_count', 'uses' => 'RoleController@usersCount']);
        ///
        Route::get('lookUp', ['uses' => 'LookUpController@index']);
        Route::get('lookUp/view', ['as' => 'lookUp_view', 'uses' => 'LookUpController@index']);
        Route::get('lookUp/list', ['as' => 'lookUp_list', 'uses' => 'LookUpController@get']);
        Route::get('lookUp/changeStatus', ['as' => 'change_lookUp_status', 'uses' => 'LookUpController@changeStatus']);
        Route::get('lookUp/edit/{id}', ['as' => 'lookUp_user', 'uses' => 'LookUpController@edit']);
        Route::post('lookUp/update/{id}', ['as' => 'lookUp_user', 'uses' => 'LookUpController@update']);
        Route::get('lookUp/create', ['as' => 'create_lookUp', 'uses' => 'LookUpController@create']);
        Route::post('lookUp/store', ['as' => 'store_lookUp', 'uses' => 'LookUpController@store']);
        Route::get('lookUp/delete', ['uses' => 'LookUpController@delete']);
        ////
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
        Route::get('logout', 'LoginController@logout');
        Route::get('lock', 'LoginController@lock');
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


            Route::get('getLists', 'LaborController@getLists');
            Route::get('labor_requests_injury', 'LaborController@labor_requests_injury');
            Route::post('labor_requests_injury/create', 'LaborController@storelaborRequestInjury');
            Route::put('labor_requests_injury/{id}', 'LaborController@updatelaborRequestInjury');
            Route::delete('labor_requests_injury/{id}', 'LaborController@destroylaborRequestInjury');


            Route::get('getLists', 'LaborController@getLists');
            Route::get('labor_requests_injury', 'LaborController@labor_requests_injury');
            Route::post('labor_requests_injury/create', 'LaborController@storelaborRequestInjury');
            Route::put('labor_requests_injury/{id}', 'LaborController@updatelaborRequestInjury');
            Route::delete('labor_requests_injury/{id}', 'LaborController@destroylaborRequestInjury');


            Route::post('user/reset_password', 'UserController@resetPassword');
            Route::post('user/create', 'UserController@create');
            Route::put('user/update', 'UserController@update');

            Route::post('user/verify', 'UserController@verify');
            Route::post('user/reset_new_password', 'UserController@reset_new_password');
            Route::post('user/newPass', 'UserController@newPass');


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





  



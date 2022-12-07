<?php

Route::get('/', 'PageController@main')->name('main');
Route::get('/c/{category}', 'PageController@category')->name('category');
Route::get('/p/{page}', 'PageController@page')->name('page');

Route::get('/about', 'PageController@about')->name('about');
Route::get('/team', 'PageController@team')->name('team');
Route::get('/fundraisers', 'PageController@fundraisers')->name('fundraisers');
Route::get('/fundraising/{fundraising}', 'PageController@fundraising')->name('fundraising');
Route::get('/requisites', 'PageController@requisites')->name('requisites');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::post('content-pages/parse-csv-import', 'ContentPageController@parseCsvImport')->name('content-pages.parseCsvImport');
    Route::post('content-pages/process-csv-import', 'ContentPageController@processCsvImport')->name('content-pages.processCsvImport');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::post('faq-categories/parse-csv-import', 'FaqCategoryController@parseCsvImport')->name('faq-categories.parseCsvImport');
    Route::post('faq-categories/process-csv-import', 'FaqCategoryController@processCsvImport')->name('faq-categories.processCsvImport');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/parse-csv-import', 'FaqQuestionController@parseCsvImport')->name('faq-questions.parseCsvImport');
    Route::post('faq-questions/process-csv-import', 'FaqQuestionController@processCsvImport')->name('faq-questions.processCsvImport');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Requisite Group
    Route::delete('requisite-groups/destroy', 'RequisiteGroupController@massDestroy')->name('requisite-groups.massDestroy');
    Route::resource('requisite-groups', 'RequisiteGroupController');

    // Requisite
    Route::delete('requisites/destroy', 'RequisiteController@massDestroy')->name('requisites.massDestroy');
    Route::resource('requisites', 'RequisiteController');

    // Fundraising
    Route::delete('fundraisings/destroy', 'FundraisingController@massDestroy')->name('fundraisings.massDestroy');
    Route::post('fundraisings/media', 'FundraisingController@storeMedia')->name('fundraisings.storeMedia');
    Route::post('fundraisings/ckmedia', 'FundraisingController@storeCKEditorImages')->name('fundraisings.storeCKEditorImages');
    Route::resource('fundraisings', 'FundraisingController');

    // Collectible
    Route::delete('collectibles/destroy', 'CollectibleController@massDestroy')->name('collectibles.massDestroy');
    Route::post('collectibles/media', 'CollectibleController@storeMedia')->name('collectibles.storeMedia');
    Route::post('collectibles/ckmedia', 'CollectibleController@storeCKEditorImages')->name('collectibles.storeCKEditorImages');
    Route::resource('collectibles', 'CollectibleController');

    // Purchasing List
    Route::delete('purchasing-lists/destroy', 'PurchasingListController@massDestroy')->name('purchasing-lists.massDestroy');
    Route::resource('purchasing-lists', 'PurchasingListController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

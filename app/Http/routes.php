<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::post('login', [
    'as'   => 'post_login',
    'uses' => 'Auth\AuthSoapController@postLogin'
]);

Route::get('logout', [
    'as'   => 'logout',
    'uses' => 'Auth\AuthSoapController@logout'
]);

// App

Route::post('upload-file', [
    'as'         => 'upload_file',
    'uses'       => 'AppUploadFiles@uploadFile'
]);

Route::post('remove-file', [
    'as'         => 'remove_file',
    'middleware' => 'accept-ajax',
    'uses'       => 'AppUploadFiles@removeFile'
]);

Route::get('get-app-file/{name?}/{id?}', [
    'as'   => 'get_app_file',
    'uses' => 'AppBasic@getAppFile'
]);

Route::post('sendFormEmail', [
    'as'         => 'sendFormEmail',
    'middleware' => 'accept-ajax',
    'uses'       => 'AppStandartController@sendFormEmail'
]);

Route::post('getClientData', [
    'as'         => 'getClientData',
    'middleware' => 'accept-ajax',
    'uses'       => 'AppBasic@getClientData'
]);

Route::post('getPaymentSchedule', [
    'as'         => 'getPaymentSchedule',
    'middleware' => 'accept-ajax',
    'uses'       => 'AppBasic@getPaymentSchedule'
]);
 Route::post('get-apps', [
    'as'         => 'get_apps',
    'middleware' => 'accept-ajax',
    'uses'       => 'AppBasic@getApplications'
]);

Route::multilingual(function(){
    Route::get('faq', [
        'as'   => 'faq',
        'uses' => 'AppBasic@faq'
    ]);
    Route::get('agreement', [
        'as'   => 'agreement',
        'uses' => 'AppBasic@agreement'
    ]);
    Route::get('/', [
        'as'   => 'get_login',
        'uses' => 'Auth\AuthSoapController@getLogin'
    ]);
    Route::get('cerere-online', [
        'as'         => 'online',
        'middleware' => 'create_app',
        'uses'       => 'AppOnlineController@index'
    ]);
    Route::post('app-online-post', [
        'as'   => 'app_online_post',
        'uses' => 'AppOnlineController@aplicationPost'
    ]);
});



Route::multilingual(function(){
    Route::group(['middleware' => 'auth_soap_standart'], function () {
        Route::get('standart', [
            'as'         => 'standart',
            'middleware' => 'create_app',
            'uses'       => 'AppStandartController@index'
        ]);
        Route::post('app-standart-post', [
            'as'   => 'app_standart_post',
            'uses' => 'AppStandartController@appPost'
        ]); 

    });   
    Route::group(['middleware' => 'auth_soap_business'], function () {   
        Route::get('business', [
            'as'         => 'business',
            'middleware' => 'create_app',
            'uses'       => 'AppBusinessController@index'
        ]);
        Route::post('app-business-post', [
            'as'   => 'app_business_post',
            'uses' => 'AppBusinessController@appPost'
        ]);
    });
    Route::group(['middleware' => 'auth_soap_credit_auto'], function () {
        Route::get('creditare-auto', [
            'as'         => 'credit_auto',
            'middleware' => 'create_app',
            'uses'       => 'AppCreditAutoController@index'
        ]); 

        Route::post('app-credit-auto-post', [
            'as'   => 'app_credit_auto_post',
            'uses' => 'AppCreditAutoController@appPost'
        ]);
    });
});

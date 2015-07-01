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

//Route::get('/', function () {
//    return view('welcome');
//});
//
Route::post('/fileupload', 'FileUploadController@upload');
Route::post('/dataImport', 'FileUploadController@import');

Route::get('member/add/{n}', 'MemberController@create');
Route::get('member/export', 'MemberController@export');
Route::get('member/import', 'MemberController@import');

//records
Route::group(['prefix' => 'api/records'], function () {
    Route::get('majors', 'RecordController@majors');
    Route::get('degrees', 'RecordController@degrees');
    Route::get('grades', 'RecordController@grades');
});
Route::get('/api/records/byInput', 'RecordController@byInput');

//phoneupdate
Route::get('/phone/update', 'PhoneUpdateController@index');

//any
Route::any('{path?}', function()
{
    return File::get(public_path() . '/ng/app/index.html');
})->where("path", ".+");
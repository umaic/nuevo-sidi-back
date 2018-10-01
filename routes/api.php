<?php

use Illuminate\Http\Request;

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

Route::post('login', 'AuthController@login');
Route::post('user', 'UserController@store');

Route::group(['middleware' => 'jwt_auth0'],function(){  

	//Datatables Pagination
    Route::get('list-administrative', 'AdministrativeDivisionsController@getByPagination');
	Route::get('list-relation', 'OrganizationProjectRelationController@getByPagination');
	Route::get('list-organizations', 'OrganizationsController@getByPagination');
	Route::get('list-project', 'ProjectClassController@getByPagination');
	Route::get('list-contact', 'ContactGroupsController@getByPagination');
	Route::get('list-types', 'OrganizationTypesController@getByPagination');
	Route::get('list-userprofiles', 'UserProfilesController@getByPagination');
	Route::get('list-allprojects', 'ProjectController@getByPagination');

	//Resources
	Route::resource('administrative', 'AdministrativeDivisionsController');
	Route::resource('relation', 'OrganizationProjectRelationController');
	Route::resource('organizations', 'OrganizationsController');
	Route::resource('project', 'ProjectClassController');
	Route::resource('contact', 'ContactGroupsController');
	Route::resource('types', 'OrganizationTypesController');
	Route::resource('userprofiles', 'UserProfilesController');
	Route::resource('allprojects', 'ProjectController');

	//Custom
	Route::post('validatePermission', 'UserController@validatePermission');
	Route::get('getAllRegions', 'AdministrativeDivisionsController@getAllRegions');
});
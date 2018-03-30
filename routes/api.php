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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//auth paths
Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');
Route::get('/showProfile/{id}','AuthController@showProfile');
Route::post('/editProfile','AuthController@editProfile');
//roles paths
Route::get('/getUserRoles','RoleController@getUserRoles');

//project Paths
Route::post('/addProject','ProjectController@addProject');
Route::get('/getUserProjects/{id}','AuthController@getUserProjects');
Route::post('/editProject','ProjectController@editProject');
Route::get('/getProjectCategories','CategoryController@getProjectCategories');
//Route::post('/showProject/{id}','ProjectController@showProject');
Route::get('/getUserProject/{id}','ProjectController@getUserProject');
Route::get('/getAllProjects','ProjectController@getAllProjects');
Route::get('/getSelectedProjects/{input}','ProjectController@getSelectedProjects');
Route::delete('/deleteProject/{id}','ProjectController@deleteUserProject');
//project_comments routes
Route::post('/addProjectComment','ProjectCommentController@addProjectComment');
Route::get('/getProjectCommentsByPid/{id}','ProjectCommentController@getProjectCommentsByPid');
//project_ratings routes
Route::post('/addProjectRating','ProjectRatingController@addProjectRating');
Route::get('/getNoProjectRating/{id}','ProjectRatingController@getNoOfProjectRating');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/contacts', "App\Http\Controllers\ContactController@index")->middleware('custom_auth');
// Route::post('/login', "App\Http\Controllers\ContactController@index")->middleware('custom_auth');

// Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Route::post('add-filter', "App\Http\Controllers\FilterController@addFilter")->middleware('auth:api');
// Route::post('add-image', "App\Http\Controllers\ImageController@addImage")->middleware('auth:api');
// Route::post('update-image', "App\Http\Controllers\ImageController@updateImage")->middleware('auth:api');
// Route::post('delete-image', "App\Http\Controllers\ImageController@deleteImage")->middleware('auth:api');
Route::post('add-page', "App\Http\Controllers\PageController@addPage")->middleware('auth:api');
Route::post('update-page', "App\Http\Controllers\PageController@updatePage")->middleware('auth:api');
Route::post('delete-page', "App\Http\Controllers\PageController@deletePage")->middleware('auth:api');

Route::post('add-personal', "App\Http\Controllers\PersonalController@addPersonal")->middleware('auth:api');
Route::post('update-personal', "App\Http\Controllers\PersonalController@updatePersonal")->middleware('auth:api');
Route::post('delete-personal', "App\Http\Controllers\PersonalController@deletePersonal")->middleware('auth:api');

Route::post('save-contacts', "App\Http\Controllers\ContactsController@saveContacts")->middleware('auth:api');
Route::post('save-main-page', "App\Http\Controllers\MainPageController@saveMainPage")->middleware('auth:api');
Route::post('create-regalia', "App\Http\Controllers\RegaliaController@createRegalia")->middleware('auth:api');
Route::post('update-regalia', "App\Http\Controllers\RegaliaController@updateRegalia")->middleware('auth:api');
Route::post('delete-regalia', "App\Http\Controllers\RegaliaController@deleteRegalia")->middleware('auth:api');
Route::post('get-tabs-admin', "App\Http\Controllers\TabsController@getTabsAdmin")->middleware('auth:api');
Route::post('create-tab', "App\Http\Controllers\TabsController@createTab")->middleware('auth:api');
Route::post('delete-tab', "App\Http\Controllers\TabsController@deleteTab")->middleware('auth:api');
Route::post('update-tab', "App\Http\Controllers\TabsController@updateTab")->middleware('auth:api');
Route::post('save-admin', "App\Http\Controllers\AdminController@saveAdmin")->middleware('auth:api');


// Route::post('get-filters', "App\Http\Controllers\FilterController@getFilters");
Route::post('get-main-page', "App\Http\Controllers\MainPageController@getMainPage");
// Route::post('get-filter-admin', "App\Http\Controllers\FilterController@getFilterAdmin")->middleware('auth:api');
// Route::post('update-filter', "App\Http\Controllers\FilterController@updateFilter")->middleware('auth:api');
// Route::post('delete-filter', "App\Http\Controllers\FilterController@deleteFilter")->middleware('auth:api');
// Route::get('get-images', "App\Http\Controllers\ImageController@getImages");
// Route::get('get-category-images', "App\Http\Controllers\ImageController@getCategoryImages");
// Route::post('get-likes', "App\Http\Controllers\ImageController@getLikes");
// Route::post('get-images-admin', "App\Http\Controllers\ImageController@getImagesAdmin")->middleware('auth:api');
Route::post('get-contacts', "App\Http\Controllers\ContactsController@getContacts");
Route::post('get-admin', "App\Http\Controllers\AdminController@getAdmin");
Route::post('get-regalia', "App\Http\Controllers\RegaliaController@getRegalia");
Route::post('get-tabs', "App\Http\Controllers\TabsController@getTabs");
// Route::post("cv", "App\Http\Controllers\PagesController@convertAllImagesToWebp");
Route::post('get-page', "App\Http\Controllers\PageController@getPage");
Route::post('get-pages', "App\Http\Controllers\PageController@getPages");
Route::post('get-pages-admin', "App\Http\Controllers\PageController@getPagesAdmin")->middleware('auth:api');
Route::post('get-page-admin', "App\Http\Controllers\PageController@getPageAdmin")->middleware('auth:api');
Route::post('get-personal', "App\Http\Controllers\PersonalController@getPersonals");
Route::post('get-personals-admin', "App\Http\Controllers\PersonalController@getPersonalsAdmin")->middleware('auth:api');
Route::post('get-personal-admin', "App\Http\Controllers\PersonalController@getPersonalAdmin")->middleware('auth:api');
Route::post('get-personal', "App\Http\Controllers\PersonalController@getPersonal");
Route::post('set-personal-status', "App\Http\Controllers\MainPageController@setPersonalStatus")->middleware('auth:api');
Route::post('get-personal-status', "App\Http\Controllers\MainPageController@getPersonalStatus");
Route::post("upload-image", "App\Http\Controllers\PageController@uploadImage");

Route::post("get-blogs", "App\Http\Controllers\PageController@getBlogs");
Route::post("view-page", "App\Http\Controllers\PageController@viewPage");

// Route::post("cv", "App\Http\Controllers\ContactsController@cve");
// Route::post('get-image-admin', "App\Http\Controllers\ImageController@getImageAdmin");
Route::get('get-email-token', "App\Http\Controllers\AdminController@getEmailToken");
Route::post('send-email', "App\Http\Controllers\AdminController@sendEmail");
// Route::middleware('auth:api')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});




Route::post('oauth/authorize', [ApproveAuthorizationController::class, 'approve']);
Route::delete('oauth/authorize', [DenyAuthorizationController::class, 'deny']);
Route::post('oauth/token', [AccessTokenController::class, 'issueToken'])->middleware('throttle');
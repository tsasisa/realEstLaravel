<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');

//linking to display contact and about pages
Route::get('contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');


Route::group(['prefix' => 'props'], function(){

Route::get('/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'single'])->name('single.prop');

//inserting requests (for contact form)
Route::post('/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'insertRequests'])->name('insert.request');

//saving props
Route::post('/save-props/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'archive'])->name('archive.prop');

//display prop based on buy and rent
Route::get('/type/Buy', [App\Http\Controllers\Props\PropertiesController::class, 'propsBuy'])->name('buy.prop');
Route::get('/type/Rent', [App\Http\Controllers\Props\PropertiesController::class, 'propsRent'])->name('rent.prop');

//display prop based on home types
Route::get('/home-type/{hometype}', [App\Http\Controllers\Props\PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometype');

//listing in ascending and descending
Route::get('/price-asc', [App\Http\Controllers\Props\PropertiesController::class, 'priceAsc'])->name('price.asc.prop');
Route::get('/price-desc', [App\Http\Controllers\Props\PropertiesController::class, 'priceDesc'])->name('price.desc.prop');

// searching for props
Route::any('/search', [App\Http\Controllers\Props\PropertiesController::class, 'searchProps'])->name('search.prop');


});

Route::group(['prefix' => 'users'], function(){

// user page
Route::get('/all-requests', [App\Http\Controllers\Users\UsersController::class, 'allRequests'])->name('all.requests');
Route::get('/all-savedprops', [App\Http\Controllers\Users\UsersController::class, 'allSavedProps'])->name('all.saved.props');

});

Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
Route::post('admin/check-login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix'=> 'admin', 'middleware' => 'auth:admin'], function(){

Route::get('/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

// admins
Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.admins');
Route::get('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('create.admins');
Route::post('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'saveAdmins'])->name('save.admins');


// hometype requests
Route::get('/all-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'allHomeTypes'])->name('admins.hometypes');
Route::get('/create-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'createHomeTypes'])->name('create.hometypes');
// logic to make new hometype
Route::post('/create-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'saveHomeTypes'])->name('save.hometypes');

// updating
Route::get('/update-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateHomeTypes'])->name('update.hometypes');
Route::post('/update-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updatedHomeTypes'])->name('updated.hometypes');

// deleting
Route::get('/delete-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteHomeTypes'])->name('delete.hometypes');

// requests 
Route::get('/all-requests', [App\Http\Controllers\Admins\AdminsController::class, 'Requests'])->name('all.requests');

// props
Route::get('/all-props', [App\Http\Controllers\Admins\AdminsController::class, 'allProps'])->name('all.props');
// create props
Route::get('/create-props', [App\Http\Controllers\Admins\AdminsController::class, 'createProps'])->name('create.props');
Route::post('/create-props', [App\Http\Controllers\Admins\AdminsController::class, 'saveProps'])->name('save.props');

// crreate gallery
Route::get('/create-gallery', [App\Http\Controllers\Admins\AdminsController::class, 'createGallery'])->name('create.gallery');
Route::post('/create-gallery', [App\Http\Controllers\Admins\AdminsController::class, 'saveGallery'])->name('save.gallery');

// delete prop
Route::get('/delete-prop/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteProps'])->name('delete.props');



});

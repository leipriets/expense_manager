<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;
// Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');   
Route::get('/expense-chart', 'HomeController@expenses_json')->name('expense-chart')->middleware('auth');;


Route::get('/expense_categories', 'ExpenseCategoriesController@index')->name('expense_categories')->middleware('auth');

// add expense category
Route::post('/add_expense_cat', 'ExpenseCategoriesController@store')->name('add_expense_cat')->middleware('auth');
// update expense category
Route::post('/update_expense_cat', 'ExpenseCategoriesController@update')->name('update_expense_cat')->middleware('auth');
// get data by id expense category
Route::get('/edit_expense_cat', 'ExpenseCategoriesController@edit')->name('edit_expense_cat')->middleware('auth');
Route::post('/delete-expense-cat/{id}', 'ExpenseCategoriesController@delete')->name('delete-expense-cat')->middleware('auth');


// Expenses
Route::get('/expense', 'ExpensesController@index')->name('expense')->middleware('auth');
Route::get('/expense-form', 'ExpensesController@expense_form')->name('expense-form')->middleware('auth');
Route::post('/add_expense', 'ExpensesController@store')->name('add_expense')->middleware('auth');
Route::post('/update_expense', '
@update')->name('update_expense')->middleware('auth');
Route::get('/edit-expense/{id}', 'ExpensesController@edit')->name('edit-expense')->middleware('auth');
Route::post('/delete-expense/{id}', 'ExpensesController@delete')->name('delete-expense')->middleware('auth');


// Roles
Route::get('/roles', 'RoleController@index')->name('roles')->middleware('auth');
Route::get('/role-form', 'RoleController@role_form')->name('role-form')->middleware('auth');
Route::post('/add-role', 'RoleController@store')->name('add-role')->middleware('auth');
Route::post('/edit-role/{id}', 'RoleController@edit')->name('add-role')->middleware('auth');
Route::post('/update-role', 'RoleController@update')->name('update-role')->middleware('auth');
Route::post('/delete-role/{id}', 'RoleController@delete')->name('delete-role')->middleware('auth');


// Users
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/user-form', 'UserController@user_form')->name('user-form')->middleware('auth');
Route::post('/add-user', 'UserController@store')->name('add-user')->middleware('auth');
Route::post('/update-user', 'UserController@update')->name('update-user')->middleware('auth');
Route::post('/delete-user/{id}', 'UserController@delete')->name('delete-user')->middleware('auth');

Route::get('/change-password', 'ChangePasswordController@index')->name('change-password')->middleware('auth');
Route::post('changepassword', 'ChangePasswordController@store')->name('change.password');



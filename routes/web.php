<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

});
//if user is not logged in, redirect to login page

Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin group middleware
    Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::get('admin/manage-users', [AdminController::class, 'manageUsers'])->name('manage-users');
    Route::get('admin/department', [AdminController::class, 'manageDepartments'])->name('departments');
    Route::post('admin/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('admin/users/delete/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('admin/users/edit/{user}', [AdminController::class, 'editUser'])->name('users.edit');

    Route::post('/store-department', [AdminController::class, 'storeDepartment'])->name('departments.store');

    Route::get('manage-files', [AdminController::class, 'manageFiles'])->name('manage-files');
    Route::post('admin/files/upload', [AdminController::class, 'upload'])->name('files.upload');
    Route::get('admin/files/download/{file}', [AdminController::class, 'download'])->name('files.download');
    Route::get('admin/files/lock/{file}', [AdminController::class, 'lock'])->name('files.lock');
    Route::get('admin/files/unlock/{file}', [AdminController::class, 'unlock'])->name('files.unlock');
    Route::get('admin/files/delete/{file}', [AdminController::class, 'deleteFile'])->name('files.delete');




Route::patch('/files/{file}', [AdminController::class, 'update'])->name('files.update');
Route::get('admin/files/archive/{file}', [AdminController::class, 'archive'])->name('files.archive');
Route::get('admin/achievd-files', [AdminController::class, 'viewArchivedFiles'])->name('achieved-files');
Route::get('admin/files/unarchive/{file}', [AdminController::class, 'unarchive'])->name('files.unarchive');

Route::get('admin/folders', [AdminController::class, 'viewFolders'])->name('folders');

Route::post('/folders/create', [AdminController::class, 'createFolder'])->name('folders.create');


});//End of Admin Middleware

    Route::middleware(['auth','role:secretary'])->group(function(){
    Route::get('/secretary/dashboard', [SecretaryController::class, 'SecretaryDashboard'])->name('secretary.dashboard');
    Route::get('/secretary/users', [SecretaryController::class, 'users'])->name('secretary.users');
    Route::get('/secretary/users/deactivate/{user}', [SecretaryController::class, 'deactivateUser'])->name('secretary.users.deactivate');
    Route::post('/secretary/users/edit/{user}', [SecretaryController::class, 'editUser'])->name('secretary.users.edit');
    Route::get('/secretary/files/', [SecretaryController::class, 'files'])->name('secretary.files');
    Route::get('/secretary/folders/', [SecretaryController::class, 'folders'])->name('secretary.folders');
    Route::post('/secretary/folders/', [SecretaryController::class, 'storeFolders'])->name('secretary.folders.create');
    Route::post('/secretary/folders/edit/{folder}', [SecretaryController::class, 'editFolder'])->name('secretary.folders.edit');
    Route::get('/secretary/folders/delete/{folder}', [SecretaryController::class, 'deleteFolder'])->name('secretary.folders.delete');
    Route::post('/secretary/files/upload', [SecretaryController::class, 'upload'])->name('secretary.files.upload');
    Route::get('/secretary/files/download/{file}', [SecretaryController::class, 'download'])->name('secretary.files.download');
    Route::get('/secretary/files/lock/{file}', [SecretaryController::class, 'lock'])->name('secretary.files.lock');
    Route::get('/secretary/files/unlock/{file}', [SecretaryController::class, 'unlock'])->name('secretary.files.unlock');
    Route::get('/secretary/files/delete/{file}', [SecretaryController::class, 'deleteFile'])->name('secretary.files.delete');
    Route::patch('/secretary/files/{file}', [SecretaryController::class, 'update'])->name('secretary.files.update');






 });//End of Secretary Middleware
 Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('users.dashboard');
    Route::get('/user/users', [UserController::class, 'users'])->name('users.users');
    Route::get('/user/users/deactivate/{user}', [UserController::class, 'deactivateUser'])->name('users.users.deactivate');
    Route::post('/user/users/edit/{user}', [UserController::class, 'editUser'])->name('users.users.edit');
    Route::get('/user/files/', [UserController::class, 'files'])->name('users.files');
    Route::get('/user/folders/', [UserController::class, 'folders'])->name('users.folders');
    Route::post('/user/folders/', [UserController::class, 'storeFolders'])->name('users.folders.create');
    Route::post('/user/folders/edit/{folder}', [UserController::class, 'editFolder'])->name('users.folders.edit');
    Route::get('/user/folders/delete/{folder}', [UserController::class, 'deleteFolder'])->name('users.folders.delete');
    Route::post('/user/files/upload', [UserController::class, 'upload'])->name('users.files.upload');
    Route::get('/user/files/download/{file}', [UserController::class, 'download'])->name('users.files.download');
    Route::get('/user/files/lock/{file}', [UserController::class, 'lock'])->name('users.files.lock');
    Route::get('/user/files/unlock/{file}', [UserController::class, 'unlock'])->name('users.files.unlock');
    Route::get('/user/files/delete/{file}', [UserController::class, 'deleteFile'])->name('users.files.delete');
    Route::patch('/user/files/{file}', [UserController::class, 'update'])->name('users.files.update');

 });//End of Secretary Middleware

    Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

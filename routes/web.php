<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RoleController;
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
    return redirect()->route('post.listing');
});

Route::prefix('registration')->controller(RegistrationController::class)->group(function () {
    Route::get('/', 'create')->name('registration.create');
    Route::post('/', 'store')->name('registration.store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('login.store');
    Route::delete('logout/{user}', 'destroy')->name('logout');
});

Route::prefix('forgot-password')->controller(ForgotPasswordController::class)->middleware('guest')->group(function () {
    Route::get('/', 'create')->name('password.request');
    Route::post('/', 'store')->name('password.email');
});

Route::prefix('reset-password')->controller(ResetPasswordController::class)->middleware('guest')->group(function () {
    Route::get('/{token}', 'edit')->name('password.reset');
    Route::post('/', 'update')->name('password.update');
});

Route::prefix('email')->controller(VerificationController::class)->middleware('auth')->group(function () {
    Route::get('verify', 'showNotice')->name('verification.notice');
    Route::post('verification-notification', 'sendNewLink')->middleware('throttle:3,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
});

Route::resource('profile', ProfileController::class)->only(['show', 'edit', 'update', 'destroy']);
Route::get('profile/{profile}/posts', [ProfileController::class, 'showPosts'])->name('profile.posts');
Route::delete('profile/{profile}/delete-avatar', [ProfileController::class, 'setDefaultAvatar'])->name('profile.delete-avatar');

Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::get('/', 'listing')->name('post.listing');
    Route::get('search', 'search')->name('post.search');
    Route::get('popular', 'showPopular')->name('post.popular');
    Route::get('category/{category:slug}', 'showByCategory')->name('post.category');
});

Route::prefix('post')->controller(PostController::class)->group(function () {
    Route::get('create', 'create')->name('post.create');
    Route::post('/', 'store')->name('post.store');
    Route::get('{post:slug}', 'show')->name('post.show');
    Route::get('{post:slug}/edit', 'edit')->name('post.edit');
    Route::put('{post}', 'update')->name('post.update');
    Route::delete('{post}', 'destroy')->name('post.destroy');
});

Route::resource('post.comments', CommentController::class)
                        ->only(['index', 'store', 'destroy'])
                        ->shallow();

Route::prefix('admin')->middleware(['auth', 'blocked', 'role:super-admin|admin'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('user.index');

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::put('/{user}', 'update')->name('user.update');
        Route::get('role-update/{user}/show', 'roleUpdateShow')->name('user.role-show');
        Route::put('role-update/{user}', 'roleUpdate')->name('user.role-update');
        Route::get('permission-update/{user}/show', 'permissionUpdateShow')->name('user.permission-show');
        Route::put('permission-update/{user}', 'permissionUpdate')->name('user.permission-update');
    });

    Route::prefix('publication')->controller(PublicationController::class)->group(function () {
        Route::get('/', 'index')->name('publication.index');
        Route::post('{post}/store', 'store')->name('publication.store');
        Route::put('{post}/update', 'update')->middleware('can:unpublish post')->name('publication.update');
        Route::delete('{post}', 'destroy')->name('publication.destroy');
    });

    Route::get('posts', [PostController::class, 'index'])->name('post.index');

    Route::resource('category', CategoryController::class);
    
    Route::resource('role', RoleController::class);
    
    Route::resource('permission', PermissionController::class);
});
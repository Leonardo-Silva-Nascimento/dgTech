<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use App\Http\Controllers\ProtectedDownloads;
use App\Http\Controllers\Userlist;
use App\Http\Controllers\Utils;
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

Route::middleware(['auth', 'has.temp.password'])->group(function () {

    Route::get('/usuarios', [Userlist::class, 'index'])->name('list.users');
    Route::post('/usuarios', [Userlist::class, 'index'])->name('listP.users');
    Route::get('usuarios/RelatorioExcel', [Userlist::class, 'exportarRelatorioExcel'])->name('get.Excel.users');

    Route::get('usuarios/criar', [Userlist::class, 'create'])
        ->name('form.store.user');

    Route::post('usuarios/criar', [Userlist::class, 'store'])
        ->name('store.user');

    Route::get('usuarios/editar/{user_id}', [Userlist::class, 'edit'])
        ->name('form.update.user');

    Route::post('usuarios/editar/{user_id}', [Userlist::class, 'update'])
        ->name('update.user');

    Route::get('Profile', [Userlist::class, 'editProfile'])
        ->name('form.update.profile');

    Route::post('Profile', [Userlist::class, 'updateProfile'])
        ->name('update.userProfile');

    Route::post('usuarios/{user_id}', [Userlist::class, 'delete'])
        ->name('form.delete.user');

    Route::get('usuarios/recuperar-senha-interno/{user_id}', [Userlist::class, 'resendPassword'])
        ->name('resend.password.user');

    Route::get('download-files/{path}', [ProtectedDownloads::class, 'download'])->name('download.files');
    Route::get('download2-files/{path}', [ProtectedDownloads::class, 'download2'])->name('download2.files');

    Route::get('/index', function () {return redirect()->route('list.Dashboard');})->name('home');
    Route::get('/', function () {return redirect()->route('list.Dashboard');});

    //rota principal dashboard
    Route::get('Dashboard', [Dashboard::class, 'index'])->name('list.Dashboard');

    Route::get('cep/{cep}', [Utils::class, 'getAddressViaCep'])->name('get.address.viacep');
    Route::post('toggle-column-table/', [Utils::class, 'toggleColumnsTables'])
        ->name('toggle.columns.tables');

    Route::post('/logout', [Login::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/nova-senha', [Login::class, 'replaceTempPasswordView'])->name('temp.password');
    Route::post('/nova-senha', [Login::class, 'replaceTempPassword'])->name('send.temp.password');
});

Route::get('get-files/{filename?}', [ProtectedDownloads::class, 'showJobImage'])
    ->name('get.files');

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login', [Login::class, 'login'])->name('action.login');
Route::get('/esqueci-minha-senha', [Login::class, 'forgotPassword'])->name('forgot.password');
Route::post('/esqueci-minha-senha', [Login::class, 'recoveryPasswordSend'])->name('forgot.password.send');
Route::get('/recuperar-minha-senha', [Login::class, 'recoveryPassword'])->name('recovery.password');
Route::get('/recuperar-minha-senha/{code}', [Login::class, 'recoveryPassword'])->name('recovery.password');
Route::post('/recuperar-minha-senha/{code}', [Login::class, 'recoveryPasswordSend'])->name('recovery.password.send');

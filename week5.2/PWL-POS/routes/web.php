<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Penjualan_DetailController;

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
    return view('welcome');
});
Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::prefix('level')->group(function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::get('/tambah', [LevelController::class, 'tambah']) ;
    Route::post('/tambah_simpan', [LevelController::class, 'tambah_simpan']);
    Route::get('/ubah/{id}', [LevelController::class, 'edit']);
    Route::put('/ubah_simpan/{id}', [LevelController::class, 'ubah_simpan']);
    Route::get('/hapus/{id}', [LevelController::class, 'hapus']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});
Route::prefix('level')->group(function () {
    Route::get('/', [LevelController::class, 'index'])->name('level.index');
    Route::get('/create', [LevelController::class, 'create'])->name('level.create');
    Route::post('/', [LevelController::class, 'store'])->name('level.store');
    Route::get('/edit/{id}', [LevelController::class, 'edit'])->name('level.edit');
    Route::put('/update/{id}', [LevelController::class, 'update'])->name('level.update');
    Route::delete('/delete/{id}', [LevelController::class, 'destroy'])->name('level.destroy');
});
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
Route::prefix('stock')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('stock.index');
    Route::get('/create', [StockController::class, 'create'])->name('stock.create');
    Route::post('/', [StockController::class, 'store'])->name('stock.store');
    Route::get('/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::put('/update/{id}', [StockController::class, 'update'])->name('stock.update');
    Route::delete('/delete/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
});
Route::prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::put('/update/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/delete/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
});
Route::prefix('penjualan_detail')->group(function () {
    Route::get('/', [Penjualan_DetailController::class, 'index'])->name('penjualan_detail.index');
    Route::get('/create', [Penjualan_DetailController::class, 'create'])->name('penjualan_detail.create');
    Route::post('/', [Penjualan_DetailController::class, 'store'])->name('penjualan_detail.store');
    Route::get('/edit/{id}', [Penjualan_DetailController::class, 'edit'])->name('penjualan_detail.edit');
    Route::put('/update/{id}', [Penjualan_DetailController::class, 'update'])->name('penjualan_detail.update');
    Route::delete('/delete/{id}', [Penjualan_DetailController::class, 'destroy'])->name('penjualan_detail.destroy');
});

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GiftController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homeadmin;
use App\Http\Controllers\Homemanajer;
use App\Http\Controllers\KlaimPoinController;
use App\Http\Controllers\KlasifikasiGunungController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManajerDashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PoinLoyalitasController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UmpanBalikController;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [DashboardController::class, 'index'])->name('index');
// Route::get('/', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/member/dashboard', [DashboardController::class, 'index'])->name('index');


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['auth']], function () {

    //start user
    Route::get('/member/rekomendasi', [DashboardController::class, 'rekomendasi'])->name('rekomendasi');
    Route::get('/member/kritiksaran', [KritikSaranController::class, 'index'])->name('kritiksaran');
    Route::get('/member/profil', [DashboardController::class, 'profil'])->name('profil');
    Route::get('/admin/editMemberr/{id}', [DashboardController::class, 'showmember'])->name('editMemberr');
    Route::put('/admin/updateMemberr/{id}', [DashboardController::class, 'updatemember'])->name('updateMemberr');
    // Route::get('/rekomendasi/{id}', [DashboardController::class, 'detailGunung'])->name('detail.gunung');
    Route::get('/rekomendasi/{id}/filter', [DashboardController::class, 'filterByCategory'])->name('gunung.filter');
    Route::get('/member/poin', [PoinController::class, 'poin'])->name('poin');
    Route::get('/member/klaim', [PoinController::class, 'klaim'])->name('klaim');
    Route::post('/member/klaim/store', [PoinController::class, 'store'])->name('member.klaim.store');
    Route::get('/statusklaim/{nama_gift}', [KlaimPoinController::class, 'statusklaim'])->name('statusklaim');
    // Route::get('/member/klaim/statusklaim/{nama_gift}', [PoinController::class, 'statusklaim'])->name('statusklaim');

    Route::get('/member/klaim/statusklaim', [PoinController::class, 'showStatusklaim'])->name('member.statusklaim');

    Route::post('/simpan-kritik-saran', [KritikSaranController::class, 'simpan'])->name('simpanKritikSaran');
    //end user
    Route::post('/admin/transaksi/getPoin', [TransaksiController::class, 'getPoin'])->name('transaksi.getPoin');

    Route::group(['middleware' => ['cekUserLogin:admin']], function () {
        Route::resource('klasifikasigunung', KlasifikasiGunungController::class);

        // CRUD klasifikasi gunung
        Route::get('/admin/addGunung', [KlasifikasiGunungController::class, 'addGunung'])->name('addGunung');
        Route::POST('/admin/addDatagunung', [KlasifikasiGunungController::class, 'store'])->name('addDatagunung');
        Route::get('/admin/editGunung/{id}', [KlasifikasiGunungController::class, 'show'])->name('editGunung');
        Route::put('/admin/updateGunung/{id}', [KlasifikasiGunungController::class, 'update'])->name('updateGunung');
        Route::get('/admin/deleteGunung/{id}', [KlasifikasiGunungController::class, 'destroy'])->name('deleteGunung');


        Route::resource('member', MemberController::class);

        // CRUD Member
        Route::get('/admin/addMember', [MemberController::class, 'addMember'])->name('addMember');
        Route::POST('/admin/addDataMember', [MemberController::class, 'store'])->name('addDataMember');
        Route::get('/admin/editMember/{id}', [MemberController::class, 'show'])->name('editMember');
        Route::put('/admin/updateMember/{id}', [MemberController::class, 'update'])->name('updateMember');
        Route::get('/admin/deleteMember/{id}', [MemberController::class, 'destroy'])->name('deleteMember');

        Route::resource('transaksi', TransaksiController::class);


        // CRUD TRANSAKSI
        Route::get('/admin/addTransaksi', [TransaksiController::class, 'addTransaksi'])->name('addTransaksi');
        Route::POST('/admin/addDataTransaksi', [TransaksiController::class, 'store'])->name('addDataTransaksi');
        Route::get('/admin/editTransaksi/{id}', [TransaksiController::class, 'show'])->name('editTransaksi');
        Route::get('/admin/transaksi/view/{id}', [TransaksiController::class, 'view'])->name('transaksi.view');
        Route::post('/admin/updateTransaksi/{id}', [TransaksiController::class, 'update'])->name('updateTransaksi');
        Route::get('/admin/deleteTransaksi/{id}', [TransaksiController::class, 'destroy'])->name('deleteTransaksi');


        Route::get('/admin/viewTransaksi/{id}', [TransaksiController::class, 'view'])->name('viewTransaksi');
        Route::get('/get-poin-total/{nama}', [TransaksiController::class, 'getPoinTotal']);
        Route::get('/user/{userId}/total-poin', [TransaksiController::class, 'getTotalPoin']);



        Route::resource('gift', GiftController::class);
        Route::get('/admin/addGift', [GiftController::class, 'addGift'])->name('addGift');
        Route::POST('/admin/addDataGift', [GiftController::class, 'store'])->name('addDataGift');
        Route::get('/admin/editGift/{id}', [GiftController::class, 'show'])->name('editGift');
        Route::put('/admin/updateGift/{id}', [GiftController::class, 'update'])->name('updateGift');
        Route::get('/admin/deleteGift/{id}', [GiftController::class, 'destroy'])->name('deleteGift');

        Route::resource('laporan', LaporanController::class);
        Route::get('/admin/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
        Route::get('/admin/laporanklaim', [LaporanController::class, 'laporanklaim'])->name('laporanklaim');



        Route::resource('klaimpoin', KlaimPoinController::class);
        Route::get('/admin/klaim/klaimMember/{id}', [KlaimPoinController::class, 'update'])->name('klaim.klaimMember');
        Route::get('/admin/klaim/rejectKlaim/{id}', [KlaimPoinController::class, 'reject'])->name('klaim.rejectKlaim');
        Route::get('umpanbalik', [KritikSaranController::class, 'umpanbalik'])->name('umpanbalik');
        Route::get('/admin/deleteKritiksaran/{id}', [KritikSaranController::class, 'destroy'])->name('deleteKritiksaran');        
        Route::resource('laporan', LaporanController::class);
    });

    Route::group(['middleware' => ['cekUserLogin:kasir']], function () {
        Route::resource('produk', ProdukController::class);

        Route::get('/kasir/addProduk', [ProdukController::class, 'addProduk'])->name('addProduk');
        Route::POST('/kasir/addData', [ProdukController::class, 'store'])->name('addData');
        Route::get('/kasir/editProduk/{id}', [ProdukController::class, 'show'])->name('editProduk');
        Route::put('/kasir/updateData/{id}', [ProdukController::class, 'update'])->name('updateProduk');
        Route::get('/kasir/deleteProduk/{id}', [ProdukController::class, 'destroy'])->name('deleteProduk');

        Route::get('/kasir/transaksi', [TransaksiController::class, 'index'])->name('transaksi.kasir');
        Route::get('/kasir/transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.tambah');
        Route::POST('/kasir/transaksi/simpan', [TransaksiController::class, 'store'])->name('transaksi.simpan');
        Route::get('/kasir/editTransaksi/{id}', [TransaksiController::class, 'show'])->name('editTransaksi');
        Route::get('/kasir/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('kasir.transaksi.edit');
        Route::post('/kasir/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('kasir.transaksi.update');
        Route::get('/kasir/transaksi/show/{id}', [TransaksiController::class, 'view'])->name('transaksi.show');
        Route::post('/kasir/updateTransaksi/{id}', [TransaksiController::class, 'update'])->name('updateTransaksi');
        Route::get('/kasir/deleteTransaksi/{id}', [TransaksiController::class, 'destroy'])->name('deleteTransaksi');
    });

    Route::group(['middleware' => ['cekUserLogin:manajer']], function () {
        Route::get('/manajer/dashboard', [ManajerDashboardController::class, 'index'])->name('manajer.dashboard');


    });

    // Route::group(['middleware' => ['cekUserLogin:mem']], function(){
    //     Route::resource('produk',ProdukController::class);
    // });
});

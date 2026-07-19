<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Frontend\WaliAuthController;
use App\Http\Controllers\Frontend\WaliController;

use App\Models\Registrasi;
use App\Models\Post;
use App\Models\Profil;
use App\Models\Payment;

use Illuminate\Support\Facades\Route;

//FRONTEND
Route::get('/', function () {

    $profil = Profil::first();
    $posts = Post::where( 'status', 'Published' ) ->latest()->take(2)->get();
    $gallery = Post::inRandomOrder() ->take(6)->get();

    return view( 'frontend.home', compact('posts', 'profil', 'gallery'));

});

Route::get('/profil', function(){

    $profil = Profil::first();
    return view('frontend.profil', compact('profil')
    );})->name('profil');

Route::get('/posts', function(){

    $posts= Post::where(
    'status',
    'Published'
    )
    ->latest()->paginate(9);

    return view(
    'frontend.posts.index', compact('posts'));})->name('posts');

Route::get('/posts/{slug}', function($slug){

    $post= Post::with('images')
    ->where( 'slug', $slug)
    ->firstOrFail();

    return view(
    'frontend.posts.show', compact('post')

    );

    })

    ->name('posts.show');


Route::get('/pendaftaran', [RegistrasiController::class, 'frontend']) ->name('registrasi');
Route::post('/pendaftaran', [RegistrasiController::class, 'storeFrontend']) ->name('registrasi.storeFrontend');
Route::resource('payments',PaymentController::class);

Route::post('/midtrans/callback', [PaymentController::class, 'callback']);
Route::get(
    '/payments/{payment}/pay',
    [PaymentController::class, 'pay']
)->name('payments.pay');
Route::get(
    '/cek-pembayaran',
    function () {
        return view('frontend.payment-check');
    }
)->name('payment.check');
Route::post(
    '/cek-pembayaran',
    [PaymentController::class, 'checkPayment']
)->name('payment.check.search');

// Route::get(
//     '/register',
//     [WaliAuthController::class,'register']
// )->name('wali.register');

// Route::post(
//     '/register',
//     [WaliAuthController::class,'store']
// )->name('wali.register.store');


Route::prefix('wali')->name('wali.')->group(function () {

    Route::get('/pendaftaran', [RegistrasiController::class, 'frontend']) ->name('registrasi');
    Route::post('/pendaftaran', [RegistrasiController::class, 'storeFrontend']) ->name('registrasi.storeFrontend');
    // Route::resource('payments',PaymentController::class);

    Route::post('/midtrans/callback', [PaymentController::class, 'callback']);
    Route::get(
        '/payments/{payment}/pay',
        [PaymentController::class, 'pay']
    )->name('payments.pay');
    // Route::get(
    //     '/cek-pembayaran',
    //     function () {
    //         return view('frontend.payment-check');
    //     }
    // )->name('payment.check');
    // Route::post(
    //     '/cek-pembayaran',
    //     [PaymentController::class, 'checkPayment']
    // )->name('payment.check.search');

    // Route::get(
    //     '/home',
    //     [WaliController::class,'home']
    // )->name('home');

    Route::get('/register', [WaliAuthController::class, 'register'])->name('register');
    Route::post('/register', [WaliAuthController::class, 'store'])->name('register.store');

    Route::get('/login', [WaliAuthController::class, 'login'])->name('login');
    Route::post('/login', [WaliAuthController::class, 'authenticate'])->name('authenticate');

    Route::post('/logout', [WaliAuthController::class, 'logout'])->name('logout');

});

Route::prefix('wali')
    ->name('wali.')
    ->middleware('auth')
    ->group(function () {

        Route::get(
            '/home',
            [WaliController::class, 'home']
        )->name('home');
        Route::get(
            '/payment',
            [WaliController::class,'payment']
        )->name('payment');

        Route::get(
            '/payment/proof',
            [WaliController::class,'paymentProof']
        )->name('payment.proof');

        Route::post(
            '/payment/proof',
            [WaliController::class,'storePaymentProof']
        )->name('payment.proof.store');

    });
//BACKEND
// Route::prefix('wali')->middleware('auth')->group(function () {
    
        
// });

Route::prefix('admin') ->middleware('auth') ->name('admin.') ->group(function(){

    Route::resource( 'profil', ProfilController::class);
    Route::resource( 'guru', GuruController::class);
    Route::resource('registrasi', RegistrasiController::class);
    Route::resource('admin/posts', PostController::class);
    Route::resource('admin/payment-types',PaymentTypeController::class);
    // Route::resource('admin/profil', ProfilController::class);

    // Route::get('profil', [ProfilController::class,'edit'])->name('profil.edit');
    // Route::put('profil', [ProfilController::class,'update'])->name('profil.update');

    Route::patch('/registrasi/{registrasi}/status', [RegistrasiController::class, 'updateStatus']
        )->name('registrasi.status');

    Route::get('/dashboard', function(){
    $total = Registrasi::count();
    $menunggu = Registrasi::where(
        'status',
        'Menunggu'
    )->count();
    $diterima = Registrasi::where(
        'status',
        'Diterima'
    )->count();
    $ditolak = Registrasi::where(
        'status',
        'Ditolak'
    )->count();

    $latest = Registrasi::latest()
        ->take(5)
        ->get();

    $totalTagihan =
    Payment::sum('nominal');

    $totalLunas =
    Payment::where(
    'status',
    'Lunas'
    )->sum('nominal');

    $totalBelum =
    Payment::where(
    'status',
    'Belum Bayar'
    )->sum('nominal');

    $totalTransaksi =
    Payment::count();

    return view(
        'admin.dashboard',
        compact(
        'total',
        'menunggu',
        'diterima',
        'ditolak',
        'latest',

        'totalTagihan',
        'totalLunas',
        'totalBelum',
        'totalTransaksi'
        ));
        
    })
    ->middleware('auth') ->name('dashboard');

    Route::get('/admin/registrasi/export', [RegistrasiController::class,'export']
    )->name('registrasi.export');

    Route::get('/payments/student/{registrasi}', [PaymentController::class, 'studentPayments']
    )->name('payments.showByStudent');

    Route::get('/payments/student/{registrasi}',[PaymentController::class,'studentPayments']
    )->name('payments.student');

});

require __DIR__.'/auth.php';

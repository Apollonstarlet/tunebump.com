<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
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

Auth::routes();
Route::get('email/verify', [PageController::class, 'Refresh'])->name('verification.notice');

Route::get('/', [PageController::class, 'HomePage']);
Route::get('logout', [PageController::class, 'ErrorPage']);
Route::get('for-artists', [PageController::class, 'ForArtists']);
Route::get('for-curators', [PageController::class, 'ForCurators']);
Route::get('artist-login', [PageController::class, 'ArtistLogin']);
Route::get('curator-login', [PageController::class, 'CuratorLogin']);
Route::get('support', [PageController::class, 'SupportPage']);
Route::get('faq', [PageController::class, 'FaqPage']);
Route::get('privacy', [PageController::class, 'PrivacyPage']);
Route::get('terms', [PageController::class, 'TermsPage']);
Route::get('artist-register', [PageController::class, 'ArtistRegister']);

Route::post('getsub', [PlaylistsController::class, 'GetSubGenres']);
Route::post('getsub_num', [PlaylistsController::class, 'GetSubNum']);

// locale route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('fresh', function() { Artisan::call('migrate:fresh'); return back();});
// Cache Clear
Route::get('clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return back();
});

Route::post('pay', [PaymentController::class, 'pay'])->name('paypal.post');
Route::get('success', [PaymentController::class, 'success']);
Route::get('error', [PaymentController::class, 'error']);

                          // Artist
// Overview
Route::get('home', [MusicController::class, 'Home'])->name('home');
Route::get('home-hot', [MusicController::class, 'Hot'])->name('/home-hot');
Route::post('add_like', [PlaylistsController::class, 'addLike']);
Route::post('remove_like', [PlaylistsController::class, 'RemoveLike']);
// New Promotion
Route::get('submit-song', [MusicController::class, 'NewSong']);
Route::post('newSong', [MusicController::class, 'AddSong'])->name('add.song');
// Promotions
Route::get('promotions', [MusicController::class, 'Promotions'])->name('history');
Route::post('reviews', [MusicController::class, 'Reviews'])->name('reviews');
Route::post('cancel', [MusicController::class, 'Cancel'])->name('cancel');
Route::post('link', [MusicController::class, 'FilterSong'])->name('link');
// Credits
Route::get('credits', [BalanceController::class, 'Credits'])->name('credits');
Route::post('stripe', [BalanceController::class, 'Charge'])->name('stripe.post');
// Setting
Route::get('setting', [UsersController::class, 'Setting'])->name('setting');
Route::post('profile', [UsersController::class, 'Profile'])->name('profile');
Route::post('set-pwd', [UsersController::class, 'SetPassword'])->name('set-pwd');
                          // Curator
// Overview
Route::get('dashboard', [SpotifyController::class, 'ToReview']);
Route::get('all-music', [SpotifyController::class, 'Dashbord']);
Route::get('hot-music', [SpotifyController::class, 'Hot']);
Route::post('signup', [SpotifyController::class, 'Signup'])->name('signup');
Route::post('review', [SpotifyController::class, 'Review'])->name('review');
// Playlists
Route::get('playlists', [SpotifyController::class, 'Playlist']);
Route::post('addPlaylist', [SpotifyController::class, 'AddPlaylist'])->name('addPlaylist');
// Balance
Route::get('balance', [SpotifyController::class, 'Balance']);
Route::post('invoice', [SpotifyController::class, 'SendInvoice'])->name('send-invoice');

                          // Admin
Route::get('verifyPlaylist', [AdminController::class, 'Playlists']);
Route::get('curators', [AdminController::class, 'Curators']);
Route::get('withdraw', [AdminController::class, 'Withdraw']);
Route::post('status', [AdminController::class, 'Status'])->name('status');
Route::post('admin-pay', [AdminController::class, 'Payment'])->name('pay');

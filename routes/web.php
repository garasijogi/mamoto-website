<?php

use Illuminate\Support\Facades\Auth;
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

//1) User routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/portfolio/wedding', 'PortfolioController@wedding')->name('portfolio.wedding');
Route::get('/portfolio/prewed', 'PortfolioController@prewed')->name('portfolio.prewed');
Route::get('/portfolio/sp', 'PortfolioController@sp')->name('portfolio.sp');
Route::get('/portfolio/lamaran', 'PortfolioController@lamaran')->name('portfolio.lamaran');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/faq', 'FAQController@index')->name('faq');
Route::get('/booknow', 'BookNowController@index')->name('booknow');
Route::get('/promo', 'PromoController@index')->name('promo');

//2) Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {

    //2.1) Dashboard
    Route::get('', 'DashboardController@index')->name('admin');

    //2.2) Kelola User
    Route::get('user', 'KelolaUserController@index')->name('admin.user');
    Route::get('user/create', 'KelolaUserController@create')->name('admin.user.create');
    Route::post('user/store', 'KelolaUserController@store');
    Route::get('user/{user:username}/edit', 'KelolaUserController@edit');
    Route::patch('user/{user:username}/edit', 'KelolaUserController@update');
    Route::delete('user/{user:username}/delete', 'KelolaUserController@destroy');

    //2.3) Kelola Home
    Route::get('home', 'KelolaHomeController@index')->name('admin.home');

    //2.4) Kelola Portfolio
    Route::get('portfolio', 'KelolaPortfolioController@index')->name('admin.portfolio');
    Route::get('portfolio/create', 'KelolaPortfolioController@create')->name('admin.portfolio.create');
    Route::post('portfolio/store', 'KelolaPortfolioController@store');
    Route::get('portfolio/{portfolio:slug}', 'KelolaPortfolioController@show')->name('admin.portfolio.show');
    Route::get('portfolio/{portfolio:slug}/edit', 'KelolaPortfolioController@edit');
    Route::patch('portfolio/{portfolio:slug}/edit', 'KelolaPortfolioController@update');
    Route::delete('portfolio/{portfolio:slug}/delete', 'KelolaPortfolioController@destroy');

    //2.5) Kelola About
    Route::get('about', 'KelolaAboutController@index')->name('admin.about');
    Route::post('about/edit', 'KelolaAboutController@edit')->name('admin.about.edit');

    //2.6) Kelola Promo
    Route::get('promo', 'KelolaPromoController@index')->name('admin.promo');

    //2.7) Kelola FAQ
    Route::get('faq', 'KelolaFAQController@index')->name('admin.faq');

    //2.8) Kelola Pesanan
    Route::get('pesanan', 'KelolaPesananController@index')->name('admin.pesanan');

    //2.9) Kelola Feedback
    Route::get('feedback', 'KelolaFeedbackController@index')->name('admin.feedback');

    /* ---------------------------------- MAIN SLUG ---------------------------------- */
    //2.9) Kelola Portofolio
    Route::get('{portfolio:slug}', 'KelolaPortfolioController@show')->name('admin.portfolio.show');

});

//3) Auth
Auth::routes();

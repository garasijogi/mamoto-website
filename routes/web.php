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
Route::prefix('portfolio')->group(function () {
    Route::get('wedding', 'PortfolioController@wedding')->name('portfolio.wedding');
    Route::get('prewed', 'PortfolioController@prewed')->name('portfolio.prewed');
    Route::get('sp', 'PortfolioController@sp')->name('portfolio.sp');
    Route::get('lamaran', 'PortfolioController@lamaran')->name('portfolio.lamaran');
    Route::get('{pfType_id}/{portfolios:slug}', 'PortfolioController@show')->name('portfolio.show');
});
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/pricelist', 'PricelistController@index')->name('pricelist');
Route::get('/faq', 'FAQController@index')->name('faq');
Route::get('/booknow', 'BookNowController@index')->name('booknow');
Route::post('/booknow/book', 'BookNowController@store');
Route::get('/booksuccess', function () {
    return view('booksuccess');
})->name('booksuccess');
Route::get('/promo', 'PromoController@index')->name('promo');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/feedback', 'FeedbackController@index')->name('feedback');
Route::post('/feedback/post', 'FeedbackController@store');

// promo routes
Route::get('/promo/get', 'KelolaPromoController@get')->name('promo.get');
Route::post('/promo/getOnce', 'KelolaPromoController@getOnce')->name('promo.getOnce');

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
    Route::get('jumbotron', 'KelolaHomeController@jumbotron')->name('admin.jumbotron');
    Route::patch('jumbotron/{jumbotron:id}/edit', 'KelolaHomeController@update_jumbotron');
    Route::get('displayed-portfolio/{id}', 'KelolaHomeController@displayed_portfolio')->name('admin.displayedportfolio');
    Route::patch('displayed-portfolio/{pftype}/edit', 'KelolaHomeController@update_dp');
    Route::patch('displayed-feedback/edit', 'KelolaHomeController@update_df');
    Route::get('displayed-feedback/{df:id}/clear', 'KelolaHomeController@clear_df');
    Route::get('displayed-promo', 'KelolaHomeController@displayed_promo')->name('admin.displayedpromo');
    Route::get('displayed-promo/{id}/add', 'KelolaHomeController@store_displayed_promo');

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
    // FIXME resolve get route security
    Route::get('promo/get', 'KelolaPromoController@get')->name('admin.promo.get');
    Route::post('promo/getOnce', 'KelolaPromoController@getOnce')->name('admin.promo.getOnce');
    Route::post('promo/add', 'KelolaPromoController@add')->name('admin.promo.add');
    Route::post('promo/edit', 'KelolaPromoController@edit')->name('admin.promo.edit');
    Route::post('promo/remove', 'KelolaPromoController@remove')->name('admin.promo.remove');
    // DANGEROUS ROUTE?!
    // Route::post('promo/removeAll', 'KelolaPromoController@removeAll')->name('admin.promo.removeAll');

    //2.7) Kelola FAQ
    Route::get('faq', 'KelolaFAQController@index')->name('admin.faq');
    Route::get('faq/create', 'KelolaFAQController@create')->name('admin.faq.create');
    Route::post('faq/store', 'KelolaFAQController@store');
    Route::get('faq/{faq:id}/edit', 'KelolaFAQController@edit');
    Route::patch('faq/{faq:id}/edit', 'KelolaFAQController@update');
    Route::delete('faq/{faq:id}/delete', 'KelolaFAQController@destroy');

    //2.8) Kelola Pesanan
    Route::get('pesanan', 'KelolaPesananController@index')->name('admin.pesanan');
    Route::post('pesanan/change-status/{id}', 'KelolaPesananController@changeStatus');
    Route::post('pesanan/{id}/edit', 'KelolaPesananController@edit');
    Route::post('pesanan/{id}/delete', 'KelolaPesananController@destroy');

    //2.9) Kelola Feedback
    Route::get('feedback', 'KelolaFeedbackController@index')->name('admin.feedback');
    Route::post('feedback/edit/{feedback:id}', 'KelolaFeedbackController@edit');
    Route::post('feedback/delete/{id}', 'KelolaFeedbackController@delete');

    //2.10) Kelola Gambar
    Route::post('kelolagambar/upload', 'kelolaGambarController@upload')->name('admin.uploadGambar');
    Route::get('kelolagambar/getIndex', 'kelolaGambarController@getIndex')->name('admin.uploadGetIndex');
    Route::post('kelolagambar/removeIndex', 'kelolaGambarController@removeIndex')->name('admin.uploadRemoveIndex');

    //2.11) Kelola Contact
    Route::get('contact', 'KelolaContactController@index')->name('admin.contact');
    Route::post('contact/save', 'KelolaContactController@save')->name('admin.contact.save');

    /* ---------------------------------- MAIN SLUG ---------------------------------- */
    //2.9) Kelola Portofolio
    Route::get('{portfolio:slug}', 'KelolaPortfolioController@show')->name('admin.portfolio.show');
});

//3) Auth
Auth::routes();

<?php

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
// Cache clear route
use Illuminate\Support\Facades\Route;

Auth::routes(['register'=>false,'reset' => false]);


Route::middleware('auth')->group(function (){
//    Route::name('dashboard')->get('/', function () {
//        return view('pages.dashboard');
//    });
    Route::get('/','DashBoradController@index')->name('dashboard');


    Route::get(
        'cache-clear',
        function () {
            $exitCode = \Artisan::call('cache:clear');
            $exitCode = \Artisan::call('route:clear');
            $exitCode = \Artisan::call('config:clear');
            $exitCode = \Artisan::call('view:clear');
            return redirect()->back();
        }
    );
//
//Route::name('dashboard')->get('/', function () {
//    return view('pages.dashboard');
//});

//Channels
    Route::get('channels', 'ChannelController@index')->name('channels');
    Route::get('channels/disabled', 'ChannelController@disabled')->name('channels.disabled');
    Route::post('channels/create', 'ChannelController@store')->name('channel.store');
    Route::get('channels/channel/{id}', 'ChannelController@show')->name('channel.show');
    Route::put('channels/channel/{id}', 'ChannelController@update')->name('channel.update');
    Route::put('channels/reset/{id}','ChannelController@reset')->name('channel.reset');
    Route::delete('channels/channel/{id}', 'ChannelController@destroy')->name('channel.destroy');

    Route::post('channels/enable/channel', 'ChannelController@enable')->name('channel.enable');

    Route::get('channel/{id}', 'ChannelController@epg')->name('epg.show');
    Route::get('channel/{id}/programs','ChannelController@getPrograms')->name('channel.programs');
    Route::get('channels/list', 'ChannelController@list')->name('channels.list');
    Route::delete('channel/{id}/programs/delete-from','ChannelController@deleteFromDate')->name('channel.delete-from');



    Route::post('program/check', 'ProgramController@check')->name('program.check');
    Route::post('program/save', 'ProgramController@store')->name('program.store');


//EPG/XML
    Route::get('epg', 'EpgController@index')->name('epg');
    Route::get('epg/build', 'EpgController@buildFullEPG')->name('epg.build');

    Route::get('epg/url', 'ChannelController@showChannelByURL')->name('epg.url');
    Route::post('epg/url/add', 'ChannelController@addChannelByURL')->name('epg.url.add');
    Route::delete('epg/url/delete/{id}', 'ChannelController@deleteChannelByURL')->name('epg.url.delete');
    Route::put('epg/url/{id}', 'ChannelController@updateChannelByURL')->name('epg.url.update');
    Route::get('epg/url/fetch/{id}', 'ChannelController@fetchChannelEpgByURL')->name('epg.url.fetch');
    Route::get('epg/url/grab/{id}', 'ChannelController@grabChannelEpgByURL')->name('epg.url.grab');
    Route::get('epg/download/{id}','EpgController@downloadByUrl')->name('epg.download');
    //Categories
    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::post('categories/create', 'CategoryController@store')->name('category.store');
    Route::get('categories/category/{id}', 'CategoryController@show')->name('category.show');
    Route::put('categories/category/{id}', 'CategoryController@update')->name('category.update');
    Route::delete('categories/category/{id}', 'CategoryController@destroy')->name('category.destroy');


    Route::get('/home', 'HomeController@index')->name('home');



});

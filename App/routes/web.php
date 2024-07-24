<?php

use App\Http\Controllers\HajjsController;
use App\Models\Bookings;
use App\Models\Hajjs;
use Illuminate\Console\View\Components\Alert;
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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});

Route::post('/create', function () {
    $booking = new Bookings();
    $booking->national_id = request('national_id');
    $booking->name = request('name');
    $booking-> gender= request('gender');
    $booking->age = request('age');
    $booking->nationality = request('nationality');
    $booking->group_id = request('group_id');
    $booking->special_needs = request('special_needs');
    $booking->medical_conditions = request('medical_conditions');
    $booking->save();
    return redirect('/form');
});

Route::get ("/upload",function(){
    return view('upload');
}); 
Route::post('/upload-csv', [HajjsController::class, 'uploadCSV'])->name('upload.csv');

<?php

use App\Http\Controllers\MachinesController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReservationsController;
//use App\Components\CalendarManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Models\Machines;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

/*Route::middleware(['auth:sanctum', 'verified'])->get('/machine', function () {
    return view('dashboard.machine.show');
})->name('machine');*/
Route::middleware(['auth:sanctum', 'verified'])->get('/machine',
    [MachinesController::class, 'render']
)->name('machine');

/*Route::middleware(['auth:sanctum', 'verified'])->get('/calendar', function () {
    return view('dashboard.calendar');
})->name('calendar');*/
/*Route::middleware(['auth:sanctum', 'verified'])->get('/calendar',
    [CalendarController::class, 'render']
)->name('calendar');*/
Route::middleware(['auth:sanctum', 'verified'])->get('/calendar/{machine?}/{week?}', function($machineName = null, $week=0) {
    return view('dashboard.calendar.show', ['machine'=>$machineName,'week'=>$week]);
    }
)//->where(['week' => '[0-9]+'])
    ->where(['week' => '0|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17'])
    ->whereAlphaNumeric('machine')
    ->name('calendar');

Route::middleware(['auth:sanctum', 'verified'])->get('/reserve',function() {
    return view('dashboard.reserve.show',);
})->name('reserve');

/*
Route::get('/greeting/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'it'])) {
        abort(400);
    }

    App::setLocale($locale);

    //
});

Route::get('/{lang}', function ($lang) {
    App::setlocale($lang);
    return view('welcome');
});
*/
//Route::middleware(['auth:sanctum', 'verified'])->get('viewM', CalendarManager::class);

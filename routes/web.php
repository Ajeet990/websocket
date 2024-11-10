<?php

use Illuminate\Support\Facades\Route;
use App\Events\SendNotification;

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
// Route::get('/pusher', function () {
//     return view('pusher');
// });
Route::get('/pusher2', function () {
    return view('pusher2');
});

Route::get('/sendPusher', function () {
    // $data = [
    //     "name" => "Ajeet",
    //     "role" => "Developer"
    // ];
    // event(new SendNotification($data, 'my-channel2', 'my-event2'));
    // return "Hi event triggered.";
    
    $data = [
        "name" => "Ajeet",
        "role" => "Developer",
        "status" => "start"
    ];
    event(new SendNotification($data, 'my-channel2', 'my-event2'));
    return response()->json([
        "success" => true,
        "message" => "Meeting started"
    ]);
});


Route::get('/endSendPusher', function() {
    $data = [
        "name" => "Ajeet",
        "role" => "Developer",
        "status" => "end"
    ];
    event(new SendNotification($data, 'my-channel2', 'my-event2'));
    return response()->json([
        "success" => true,
        "message" => "Meeting ended"
    ]);
});

<?php

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



/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/sql/injection', function () {
return view('sql/injection');
});
//Route::post('/sql/injection', 'SQLController@injectionMySQLi');
// Route::post('/sql/injection', 'SQLController@noInjectionMySQLi');
// Route::post('/sql/injection', 'SQLController@injectionPDO');
 Route::post('/sql/injection', 'SQLController@noInjectionPDO');
// Route::post('/sql/injection', 'SQLController@injectionLaravelQueryBuilder');
// Route::post('/sql/injection', 'SQLController@noInjectionLaravelQueryBuilder');

Route::get('/sql/search_win', function () {
return view('sql/search_win');
});
Route::post('/sql/search_win_results', 'SQLController@searchWinResults');
*/
Route::get('/', 'WCController@search');
Route::post('/search_results', 'WCController@searchResults');
Route::get('/ui/search/update_Teams/{t_id}/{k_id}','WCController@updateTeams');
Route::post('/ui/search/update_Teams/{t_id}/{k_id}','WCController@updateTeams');
Route::get('/ui/search/update_Groups/{t_id}','WCController@updateGroups');
Route::post('ui/search/update_Groups/{t_id}','WCController@updateGroups');

/*
Route::get('/vuejs/hello_vuejs', function () {
    return view('vuejs/hello_vuejs', [
        'message' => "Hello VueJS!! from Server",
        'select_data' => [
            ['value' => "1", 'text' => "A"],
            ['value' => "2", 'text' => "B"],
            ['value' => "3", 'text' => "C"],
            ['value' => "4", 'text' => "D"],
            ['value' => "5", 'text' => "E"]
        ]
    ]);
});


////////////////////////////////////////////////////////////
// Sample: AJAX
Route::get('/ajax/hello_ajax', function () {
    return view('ajax/hello_ajax');
});
Route::get('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});
Route::post('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});
////////////////////////////////////////////////////////////*/
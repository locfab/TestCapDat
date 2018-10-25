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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/superform', function () {
    return view('form');
});

Route::get('/fin', function () {
    return view('fin');
});
Route::post('file/create', function (\Illuminate\Http\Request $request){
    $validatedData = $request->validate([
        'filename' => 'required|max:100',
    ]);
    $monPetitTableau = array (
        "meta"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
        "type" => array(1, 2, 3, 4, 5, 6),
        "treatment"   => array("first", 5 => "second", "third")
    );
    if($validatedData)
    {
        $name = $request->input('filename');
    }
    else
    {
        var_dump("erreur");
    }

    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($monPetitTableau,JSON_PRETTY_PRINT));
    fclose($fp);
});
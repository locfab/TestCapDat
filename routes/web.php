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
        'client' => 'required|min:2|max:100',
        'filename' => 'required|min:2|max:100',
        'frequency' => 'required',
        'deposit' => 'required',
        'name' => 'required',
        'type' => 'required|not_in:0',
    ]);


    if($validatedData)
    {
        $client = $request->input('client');
        $filename = $request->input('filename');
        $frequency = $request->input('frequency');
        $deposit = $request->input('deposit');
        $name = $request->input('name');
        $type = $request->input('type');

        $monPetitTableau = array (
            "meta"  => array("client" => $client, "filename" => $filename, "frequency" => $frequency, "deposit" => $deposit, "format" => array("name" => $name, "firstline" => 0, "endline" => "\n", "separator" => ",", "columns"=> '4'), 'encoding' => 'ISO8859-1', 'protocol' => array("mode"=> "HOSTED", "path" => "/home/user/Documents/contacts/")),
            "type" => $type,
        );


        if($type == 'contact')//contact
        {
            $validatedData = $request->validate([
                'firstname' => 'required|min:2|max:100',
                'lastname' => 'required|min:2|max:100',
                'adress' => 'required|min:2|max:255',
                'mail' => 'required|regex:/^.+@.+$/i',
                'country' => 'required|min:2|max:255',
                'city' => 'required|min:2|max:255',
                'postal' => 'required|min:2|max:255'
                //'birthday' => 'date',
                //'source' => 'required|min:2|max:255'
            ]);
            if($validatedData)
            {
                $firstname = $request->input('firstname');
                $lastname = $request->input('lastname');
                $adress = $request->input('adress');
                $mail = $request->input('mail');
                $country = $request->input('country');
                $city = $request->input('city');
                $postal = $request->input('postal');
                //$birthday = $request->input('birthday');
                //$source = $request->input('source');

            }
            else
            {
                return redirect()->route('welcome')->withInput($request->all())->withErrors($validatedData->errors());
            }
        }
        if($type == "product")
        {
            $validatedData = $request->validate([
                'nameProduct' => 'required|min:2|max:255',
                'description' => 'required|min:2|max:255',
                'price' => 'required',
                'currency' => 'required',
                'source' => 'required|min:2|max:255',
                'weblink' => 'required|url'

            ]);

            if($validatedData)
            {
                $nameProduct = $request->input('nameProduct');
                $description = $request->input('description');
                $price = $request->input('price');
                $currency = $request->input('currency');
                $source = $request->input('source');
                $weblink = $request->input('weblink');
            }
            else
            {
                return redirect()->route('form')->withInput($request->all())->withErrors($validatedData->errors());
            }
        }

    }
    else
    {
        return redirect()->route('form')->withInput($request->all())->withErrors($validatedData->errors());
    }
    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($monPetitTableau,JSON_PRETTY_PRINT));
    fclose($fp);

    return redirect('superform')->with('message', 'itSAllGoodMan');;
});
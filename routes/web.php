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

Route::post('file/create', function (\Illuminate\Http\Request $request){
    $inputs = $request->all();
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
        $monPetitTableau = array (
            "meta"  => array("client" => $inputs["client"], "filename" => $inputs["filename"], "frequency" => $inputs["frequency"], "deposit" => $inputs["deposit"], "format" => array("name" => $inputs["client"], "firstline" => 0, "endline" => "\n", "separator" => ",", "columns"=> '4'), 'encoding' => 'ISO8859-1', 'protocol' => array("mode"=> "HOSTED", "path" => "/home/user/Documents/contacts/")),
            "type" => $inputs["type"],
        );


        if($inputs["type"] == 'contact')//contact
        {
            $validatedData = $request->validate([
                'firstname' => 'required|min:2|max:100',
                'lastname' => 'required|min:2|max:100',
                'adress' => 'required|min:2|max:255',
                'mail' => 'required|regex:/^.+@.+$/i',
                'country' => 'required|min:2|max:255',
                'city' => 'required|min:2|max:255',
                'postal' => 'required|min:2|max:255',
                'source1' => 'required|min:2|max:255',
                'birthday1' => 'required|date'
            ]);
            if($validatedData)
            {
                $monArray = [];
                $data = array('firstname'=>$inputs["firstname"], 'lastname' => $inputs["lastname"], 'adress' => $inputs["adress"], 'mail' => $inputs["mail"], 'country' => $inputs["country"], 'city' => $inputs["city"], 'postal' => $inputs["postal"], 'source' => $inputs["source1"], 'birthday' => $inputs["birthday1"]);
                foreach ($data as $key => $value) {
                    if (!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$value))
                        $monArray[] = array("head" => $key, "location" => $key, "type" => gettype($value));
                    else
                        $monArray[] = array("head" => $key, "format" => $value, "location" => $key, "type" => "date");

                }
                $monPetitTableau["treatment"] = $monArray;
            }
            else
            {
                return redirect()->route('welcome')->withInput($request->all())->withErrors($validatedData->errors());
            }
        }
        else if($inputs["type"] == "product")
        {
            $validatedData = $request->validate([
                'nameProduct' => 'required|min:2|max:255',
                'description' => 'required|min:2|max:255',
                'birthday2' => 'required|date',
                'price' => 'required|integer',
                'currency' => 'required',
                'source2' => 'required|min:2|max:255',
                'weblink' => 'required|url',
            ]);

            if($validatedData)
            {
                $monArray = [];
                $data = array('nameProduct'=>$inputs["nameProduct"], 'description' => $inputs["description"],'birthday' => $inputs["birthday2"], 'price' => $inputs["price"], 'currency' => $inputs["currency"], 'source2' => $inputs["source2"], 'weblink' => $inputs["weblink"]);
                foreach ($data as $key => $value) {
                    if (!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$value))
                        $monArray[] = array("head" => $key, "location" => $key, "type" => gettype($value));
                    else
                        $monArray[] = array("head" => $key, "format" => $value, "location" => $key, "type" => "date");

                }
                $monPetitTableau["treatment"] = $monArray;
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
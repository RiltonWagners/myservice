<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        $states = State::all();

        $zipcode = $request->zipcode;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://viacep.com.br/ws/'.$zipcode.'/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //Exemplo de retorno
        /*
        {
        "cep": "38425-381",
        "logradouro": "Avenida Doutor Munir Tannús Abdalla",
        "complemento": "",
        "bairro": "Shopping Park",
        "localidade": "Uberlândia",
        "uf": "MG",
        "ibge": "3170206",
        "gia": "",
        "ddd": "34",
        "siafi": "5403"
        }
        */

        $state_name = "";

        if(!isset(json_decode($response)->erro)){
            foreach($states as $state){
                if($state['uf'] == json_decode($response)->uf){
                    $state_name =  $state['name'];
                }            
            }
        }
        
        return view('publications.function.district', ['district' => json_decode($response), 'state' => $state_name]);
    }

    public function edit(District $district)
    {
        //
    }

    public function update(Request $request, District $district)
    {
        //
    }

    public function destroy(District $district)
    {
        //
    }
}

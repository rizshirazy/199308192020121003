<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->data = [];
        $this->detail = [];
    }

    public function index()
    {
        $this->storeDataFromJson();
        return view('dashboard', ['data' => $this->data]);
    }

    public function storeDataFromJson()
    {
        $response1 = Curl::to('http://103.226.55.159/json/data_rekrutmen.json')
            ->get();

        $response2 = Curl::to('http://103.226.55.159/json/data_attribut.json')
            ->get();

        $json_decode1 = json_decode($response1, true);
        $json_decode2 = json_decode($response2, true);

        $rawData = $json_decode1['Form Responses 1'];
        $this->data = array_values(array_sort($rawData, function ($value) {
            return $value['posisi_yang_dipilih'];
        }));

        $this->detail = $json_decode2;
    }
}

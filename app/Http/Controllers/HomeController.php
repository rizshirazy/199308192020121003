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
        $dataPeserta = [];


        foreach ($rawData as $peserta) {
            $id = $peserta['id'];

            $dataPeserta[$id]['nama'] = $peserta['nama'];
            $dataPeserta[$id]['nip'] =  $peserta['nip'];
            $dataPeserta[$id]['satuan_kerja'] =  $peserta['satuan_kerja'];
            $dataPeserta[$id]['posisi_yang_dipilih'] =  $peserta['posisi_yang_dipilih'];
            $dataPeserta[$id]['posisi_yang_dipilih'] =  $peserta['posisi_yang_dipilih'];
            $dataPeserta[$id]['bahasa_pemrograman_yang_dikuasai'] =  $peserta['bahasa_pemrograman_yang_dikuasai'];
            $dataPeserta[$id]['database_yang_dikuasai'] =  $peserta['database_yang_dikuasai'];
            $dataPeserta[$id]['tools_yang_dikuasai'] =  $peserta['tools_yang_dikuasai'];
            $dataPeserta[$id]['pernah_membuat_mobile_apps'] =  $peserta['pernah_membuat_mobile_apps'];

            $i = 0;
            foreach ($json_decode2 as $nilai) {
                if ($peserta['id'] == $nilai['id_pendaftar']) {
                    $dataPeserta[$id]['nilai'][$i]['jenis_attr'] = $nilai['jenis_attr'];
                    $dataPeserta[$id]['nilai'][$i]['value'] = $nilai['value'];
                    $i++;
                }
            }
        }

        $this->data = array_values(array_sort($dataPeserta, function ($value) {
            return $value['posisi_yang_dipilih'];
        }));

        $this->detail = $json_decode2;
    }
}

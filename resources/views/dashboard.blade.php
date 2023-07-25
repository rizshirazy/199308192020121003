@extends('layouts.app')

@section('content')
<div class="container p-10">
    <h1 class="text-xl uppercase">Data Rekrutmen</h1>

    <table class="table table-xs table-zebra my-5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Satuan Kerja</th>
                <th>Posisi Yang Dipilih</th>
                <th>Bahasa Pemrogramman Yang Dikuasai</th>
                <th>Database Yang Dikuasai</th>
                <th>Tools Yang Dikuasai</th>
                <th>Pernah Membuat Mobile Apps</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['nip'] }}</td>
                <td>{{ $item['satuan_kerja'] }}</td>
                <td>{{ $item['posisi_yang_dipilih'] }}</td>
                <td>{{ $item['bahasa_pemrograman_yang_dikuasai'] }}</td>
                <td>{{ $item['database_yang_dikuasai'] }}</td>
                <td>{{ $item['tools_yang_dikuasai'] }}</td>
                <td>{!! $item['pernah_membuat_mobile_apps'] == 'Ya' ? '<i class="fa-solid fa-circle-check text-error"></i>' : '<i class="fa-solid fa-circle-xmark text-success"></i>'!!}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
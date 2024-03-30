<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak {{$category->nama ?? 'Semua'}} Laporan</title>

    <!-- Custom fonts for this template-->
    <link href="/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body onload="window.print()">
    <h1 class="text-center">Laporan {{$category->nama ?? 'Semua'}}</h1>
    <h4 class="text-center">Dicetak Oleh : {{auth()->user()->name}}</h4>
    <table class="table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Kategori</th>
                <th>Jumlah Produksi</th>
                <th>Jumlah Barang Keluar</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_kuantitas_produksi = 0;
            $total_barang_keluar = 0;
            @endphp
            @foreach ($items as $index => $item)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->category->nama}}</td>
                @if ($item->tipe == 'BARANG KELUAR')
                @php
                $total_barang_keluar += $item->kuantitas;
                @endphp
                <td>0</td>
                <td>{{$item->kuantitas}}</td>
                @else
                @php
                $total_kuantitas_produksi += $item->kuantitas;
                @endphp
                <td>{{$item->kuantitas}}</td>
                <td>0</td>
                @endif
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th>Total</th>
                <th>{{$total_kuantitas_produksi}}</th>
                <th>{{$total_barang_keluar}}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>

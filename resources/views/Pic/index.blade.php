@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container row m-auto" >
            Welcome Team Leader <h2>{{ Auth::user()->nama_lengkap }}</h2>
        </div>

        <div class="container mt-4">
            <table id="jadwalTable" class="table table-bordered">
            <thead>
                <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Posisi</th>
                <th>Tanggal</th>
                <th>Jam Standby</th>
                <th>Jam Pelayanan</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwal->detail->cabang["nama_cabang"] }}</td>
                    <td>{{ $jadwal->bagian["nama_bagian"] }}</td>
                    <td>{{ \Carbon\Carbon::parse($jadwal->detail->tanggal_jadwal)->format('d M Y') }}</td>
                    <td>{{ $jadwal->detail->jadwalIbadah["jam_stand_by"] }}</td>
                    <td>{{ $jadwal->detail->jadwalIbadah["jam_mulai"] }} - {{ $jadwal->detail->jadwalIbadah["jam_akhir"] }}</td>
                    <td>
                    <a href="{{ route('pic_detail', $jadwal->id_jadwal_h) }}" class="btn btn-success">Detail</a>
                    <a href="asdasd" class="btn btn-warning">Tukar</a>
                    <a href="asdasd" class="btn btn-danger">Tolak</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <hr>

        <div class="container mt-4">
            <h2>{{$team["nama_tim_pelayanan_h"]}}</h2>
            <table id="teamTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No Telp.</th>
                </tr>
            </thead>
            <tbody>
                @foreach($team->tim_pelayanan_d as $item)
                    {{ dd($team->tim_pelayanan_d) }}
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user["nama_lengkap"] }}</td>
                    <td>{{ $item->user["telp"] }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
<script>

    $(document).ready(function () {
        $('#jadwalTable').DataTable({
            "pageLength": 5
        });

        $('#teamTable').DataTable({
            "pageLength": 5
        });
    });

</script>
@endsection

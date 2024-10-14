@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="header">
                    <h1>Detail Jadwal</h1>
                    {{-- <p>Berikut adalah detail jadwal yang telah diatur.</p> --}}
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
            <table id="jadwalTable" class="table table-bordered">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Lokasi</th>
                <th>Posisi</th>
                <th>Tanggal</th>
                <th>Jam Standby</th>
                <th>Jam Pelayanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal->detail as $jadwal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwal->user["nama_lengkap"] }}</td>
                    <td>{{ $jadwal->detail->cabang["nama_cabang"] }}</td>
                    <td>{{ $jadwal->bagian["nama_bagian"] }}</td>
                    <td>{{ \Carbon\Carbon::parse($jadwal->detail->tanggal_jadwal)->format('d M Y') }}</td>
                    <td>{{ $jadwal->detail->jadwalIbadah["jam_stand_by"] }}</td>
                    <td>{{ $jadwal->detail->jadwalIbadah["jam_mulai"] }} - {{ $jadwal->detail->jadwalIbadah["jam_akhir"] }}</td>

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
    });

</script>
@endsection

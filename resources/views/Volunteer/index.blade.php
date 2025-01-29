@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container" >
            <h2>{{ Auth::user()->nama_lengkap }}'s Schedule</h2>
        </div>

        <div class="container mt-4">
            <table id="jadwalTable" class="table table-striped table-bordered">
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
                    @foreach($jadwal as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->detail->cabang["nama_cabang"] }}</td>
                        <td>{{ $jadwal->bagian["nama_bagian"] }}</td>
                        <td>{{ \Carbon\Carbon::parse($jadwal->detail->tanggal_jadwal)->format('d M Y') }}</td>
                        <td>{{ $jadwal->detail->jadwalIbadah["jam_stand_by"] }}</td>
                        <td>{{ $jadwal->detail->jadwalIbadah["jam_mulai"] }} - {{ $jadwal->detail->jadwalIbadah["jam_akhir"] }}</td>
                        <td>
                        <a href="{{ route('volunteer_detail', $jadwal->id_jadwal_h) }}" class="btn btn-success">Detail</a>
                        <a href="asdasd" class="btn btn-warning">Tukar / Ganti</a>
                        {{-- <a href="asdasd" class="btn btn-danger">Tolak</a> --}}
                        </td>
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
            "paging": true,
            "pageLength": 10,
        });
    });

</script>
@endsection

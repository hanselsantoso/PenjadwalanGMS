@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="mb-3">
                <a href="/volunteer" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="row align-items-center mb-4 shadow-sm rounded bg-light">                
                <div class="col-md px-4 pt-2 mb-2">
                    <h2 class="text-primary fw-bold mb-3">
                        Detail Jadwal
                    </h2>
                    <h5 class="text-primary fw-bold mb-3">
                        {{$jadwal->cabang->nama_cabang}}: {{$jadwal->jadwalIbadah->nama_ibadah}}
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-calendar-fill"></i>
                        <p class="mb-0 ms-2">Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d-m-Y') }}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-clock-fill"></i> 
                        <p class="mb-0 ms-2">Jam: {{$jadwal->jadwalIbadah->jam_mulai}} - {{$jadwal->jadwalIbadah->jam_akhir}}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-bell-fill"></i> 
                        <p class="mb-0 ms-2">Stand By: {{$jadwal->jadwalIbadah->jam_stand_by}}</p>
                    </h5>
                </div>
            </div>

            <table id="jadwalTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Nama Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal->detail as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->bagian["nama_bagian"] }}</td>
                        <td>{{ $jadwal->user["nama_lengkap"] }}</td>
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

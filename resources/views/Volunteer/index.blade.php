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
                        <a href="{{ route('volunteer.detail', $jadwal->id_jadwal_h) }}" class="btn btn-success">Detail</a>
                        <a href="asdasd" class="btn btn-warning">Tukar / Ganti</a>
                        {{-- <a href="asdasd" class="btn btn-danger">Tolak</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <!-- Tukar Jadwal Modal -->
    <div class="modal fade" id="createJadwal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tukar Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('tukar_jadwal') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label>Jadwal Saya</label>
                            <select class="form-control" name="jadwal_saya" required>
                                <option value="" disabled selected>Pilih Jadwal</option>
                                @foreach($jadwal as $j)
                                    <option value="{{ $j->id_jadwal_d }}">
                                        {{ $j->detail->cabang["nama_cabang"] }} - 
                                        {{ $j->bagian["nama_bagian"] }} -
                                        {{ \Carbon\Carbon::parse($j->detail->tanggal_jadwal)->format('d M Y') }} -
                                        {{ $j->detail->jadwalIbadah["jam_mulai"] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label>Tukar Dengan</label>
                            <select class="form-control" name="jadwal_tukar" required>
                                <option value="" disabled selected>Pilih Volunteer</option>
                                @foreach($jadwal as $j)
                                    <option value="{{ $j->id_jadwal_d }}">
                                        {{ $j->user["nama_lengkap"] }} - 
                                        {{ $j->detail->cabang["nama_cabang"] }} -
                                        {{ $j->bagian["nama_bagian"] }} -
                                        {{ \Carbon\Carbon::parse($j->detail->tanggal_jadwal)->format('d M Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="alasan">Alasan Tukar</label>
                            <textarea class="form-control" name="alasan" rows="3" required></textarea>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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

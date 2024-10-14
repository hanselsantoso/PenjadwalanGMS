@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container row m-auto" >
            Welcome Volunteer <h2>{{ Auth::user()->nama_lengkap }}</h2>
        </div>

        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    Jadwal Pelayanan
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                {{-- <th>Kegiatan</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal_h as $header)
                                <tr>
                                    <td colspan="4" class="text-center font-weight-bold">{{ $header->tanggal }}</td>
                                </tr>
                                @foreach($header->jadwal_d as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detail->tanggal }}</td>
                                        <td>{{ $detail->waktu }}</td>
                                        <td>{{ $detail->kegiatan }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>

    $(document).ready(function () {
        
    });

</script>
@endsection

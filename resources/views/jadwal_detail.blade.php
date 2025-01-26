@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="mb-3">
                <a href="{{ route('jadwal_index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="row align-items-center mb-2 shadow-sm rounded bg-light">
                <div class="col-md px-4 pt-2 mb-2">
                    <h2 class="text-primary fw-bold mb-3">
                        Jadwal {{$jadwal->cabang->nama_cabang}}: {{$jadwal->jadwalIbadah->nama_ibadah}}
                    </h2>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-calendar-fill"></i>
                        <p class="mb-0 ms-2">Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d-m-Y') }}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-clock-fill"></i> 
                        <p class="mb-0 ms-2">Jam {{$jadwal->jadwalIbadah->jam_mulai}} - {{$jadwal->jadwalIbadah->jam_akhir}}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-bell-fill"></i> 
                        <p class="mb-0 ms-2">Stand By: {{$jadwal->jadwalIbadah->jam_stand_by}}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-check-circle-fill"></i>
                        <p class="mb-0 ms-2">
                            Status: 
                            <span class="{{$jadwal->status_jadwal_h == 1 ? 'text-success fw-bold' : 'text-danger fw-bold'}}">
                                {{$jadwal->status_jadwal_h == 1 ? "Aktif" : "Tidak Aktif"}}
                            </span>
                        </p>
                    </h5>
                </div>

                <div class="d-flex gap-2 text-start px-4 pb-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJadwal" 
                        {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }}
                    >
                        Tambah Jadwal
                    </button>

                    <form action="{{ route('jadwal_automation') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jadwal" value="{{ $id_H }}">
                        <button type="submit" class="btn btn-success" 
                            {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }}
                        >
                            Automate Schedule
                        </button>
                    </form>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="45%">Nama Anggota</th>
                        <th width="20%">Bagian</th>
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal->detail as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_h" value="{{$item["id_jadwal_h"] }}">
                            <input type="hidden" name="nama_bagian" value="{{$item["id_jadwal_d"] }}">
                            <input type="hidden" name="nama_bagian" value="{{$item["id_bagian"] }}">
                            <input type="hidden" name="nama_bagian" value="{{$item["id_user"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->user->nama_lengkap }}</td>
                            <td> {{$item->bagian->nama_bagian }}</td>
                            <td> {{$item->status_jadwal_d == 1 ? "Aktif" : "Tidak Aktif" }}</td>

                            <td>
                                <button href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateJadwal" 
                                    {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }}
                                >
                                    Update
                                </button>

                                <form action="/admin/jadwal/detail/delete/{{ $item["id_jadwal_d"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100" 
                                        {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }}
                                    >
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createJadwal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_detail_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jadwal" value="{{$jadwal["id_jadwal_h"]}}">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="user">Anggota</label>
                            <select class="form-control" name="user" required>
                                <option value="" disabled selected>Pilih Anggota</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="bagian">Bagian</label>
                            <select class="form-control" name="bagian" required>
                                <option value="" disabled selected>Pilih Bagian</option>
                                @foreach ($bagian as $item)
                                    <option value="{{ $item->id_bagian }}">{{ $item->nama_bagian }}</option>
                                @endforeach
                            </select>
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

    <!-- Update User Modal -->
    <div class="modal fade" id="updateJadwal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_detail_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_jadwal_h">
                    <input type="hidden" name="jadwal">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="user">Anggota</label>
                            <select class="form-control" name="user" required>
                                <option value="" disabled selected>Pilih Anggota</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="bagian">Bagian</label>
                            <select class="form-control" name="bagian" required>
                                <option value="" disabled selected>Pilih Jam</option>
                                @foreach ($bagian as $item)
                                    <option value="{{ $item->id_bagian }}">{{ $item->nama_bagian }}</option>
                                @endforeach
                            </select>
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
    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            var hiddenInputs = row.find('input[type="hidden"]');
            var data = [];
            hiddenInputs.each(function() {
                var value = $(this).val();
                data.push(value);
            });
            console.log(data);
            let id = data[0];
            let jadwal = data[1];
            let bagian = data[2];
            let user = data[3];

            $('#updateJadwal').find('input[name="id_jadwal_h"]').val(id);
            $('#updateJadwal').find('input[name="jadwal"]').val(jadwal);
            $('#updateJadwal').find('select[name="bagian"]').val(bagian);
            $('#updateJadwal').find('select[name="user"]').val(user);

            $('#updateJadwal').find('input[name="tanggal_jadwal"]').datepicker('setDate', tanggal);

            // $("#tanggal_jadwal").datepicker("setDate", tanggal);
        });
    });

</script>
@endsection


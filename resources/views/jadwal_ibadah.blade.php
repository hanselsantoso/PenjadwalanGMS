@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Jadwal Ibadah</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJadwalIbadah">
                        Tambah Jadwal Ibadah 
                    </button>
                </div>
            </div>

            <h4>Jadwal Ibadah Aktif</h4>
            <table id="tabelIbadahActive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="25%">Nama Ibadah</th>
                        <th width="20%">Alias</th>
                        <th width="10%">Jam Stand By</th>
                        <th width="10%">Jam Mulai</th>
                        <th width="10%">Jam Akhir</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalActive as $item)
                    <tr>
                        <input type="hidden" name="id_jadwal_ibadah" value="{{$item["id_jadwal_ibadah"] }}">
                        <input type="hidden" name="nama_ibadah" value="{{$item["nama_ibadah"] }}">
                        <input type="hidden" name="alias_ibadah" value="{{$item["alias_ibadah"] }}">
                        <input type="hidden" name="jadwal_stand_by" value="{{$item["jam_stand_by"] }}">
                        <input type="hidden" name="jadwal_mulai" value="{{$item["jam_mulai"] }}">
                        <input type="hidden" name="jadwal_akhir" value="{{$item["jam_akhir"] }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{$item["nama_ibadah"] }}</td>
                        <td> {{$item["alias_ibadah"] }}</td>
                        <td> {{$item["jam_stand_by"] }}</td>
                        <td> {{$item["jam_mulai"] }}</td>
                        <td> {{$item["jam_akhir"] }}</td>

                        <td>
                            <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateJadwalIbadah">
                                Update
                            </a>
                            <form action="{{ route('jadwal_ibadah.deactivate', $item['id_jadwal_ibadah']) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Suspend</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <br>
            <hr/>
            <h4>Jadwal Ibadah Tidak Aktif</h4>
            <table id="tabelIbadahInactive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="25%">Nama Ibadah</th>
                        <th width="20%">Alias</th>
                        <th width="10%">Jam Stand By</th>
                        <th width="10%">Jam Mulai</th>
                        <th width="10%">Jam Akhir</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalInactive as $item)
                    <tr>
                        <input type="hidden" name="id_jadwal_ibadah" value="{{$item["id_jadwal_ibadah"] }}">
                        <input type="hidden" name="nama_ibadah" value="{{$item["nama_ibadah"] }}">
                        <input type="hidden" name="alias_ibadah" value="{{$item["alias_ibadah"] }}">
                        <input type="hidden" name="jadwal_stand_by" value="{{$item["jam_stand_by"] }}">
                        <input type="hidden" name="jadwal_mulai" value="{{$item["jam_mulai"] }}">
                        <input type="hidden" name="jadwal_akhir" value="{{$item["jam_akhir"] }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{$item["nama_ibadah"] }}</td>
                        <td> {{$item["alias_ibadah"] }}</td>
                        <td> {{$item["jam_stand_by"] }}</td>
                        <td> {{$item["jam_mulai"] }}</td>
                        <td> {{$item["jam_akhir"] }}</td>

                        <td>
                            <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateJadwalIbadah">
                                Update
                            </a>
                            <form action="{{ route('jadwal_ibadah.activate', $item['id_jadwal_ibadah']) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Activate</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createJadwalIbadah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal Ibadah</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_ibadah.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nama_ibadah">Nama Ibadah</label>
                            <input type="text" class="form-control" name="nama_ibadah" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="alias_ibadah">Alias Ibadah</label>
                            <input type="text" class="form-control" name="alias_ibadah" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="jam_stand_by">Jam Stand By</label>
                            <input class="form-control" type="time" id="jam_stand_by" name="jam_stand_by" value="00:00" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="jam_mulai">Jam Ibadah Mulai</label>
                            <input class="form-control" type="time" id="jam_mulai" name="jam_mulai" value="00:00" required>
                        </div>

                        <div class="form-group mb-1">
                            <label for="jam_akhir">Jam Ibadah Selesai</label>
                            <input class="form-control" type="time" id="jam_akhir" name="jam_akhir" value="00:00" required>
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
    <div class="modal fade" id="updateJadwalIbadah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Jadwal Ibadah</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_ibadah.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_jadwal_ibadah">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group mb-1">
                                <label for="nama_ibadah">Nama Ibadah</label>
                                <input type="text" class="form-control" name="nama_ibadah" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="alias_ibadah">Alias Ibadah</label>
                                <input type="text" class="form-control" name="alias_ibadah" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="jam_stand_by">Jam Stand By</label>
                                <input class="form-control" type="time" id="jam_stand_by" name="jam_stand_by" value="00:00" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="jam_mulai">Jam Ibadah Mulai</label>
                                <input class="form-control" type="time" id="jam_mulai" name="jam_mulai" value="00:00" required>
                            </div>

                            <div class="form-group mb-1">
                                <label for="jam_akhir">Jam Ibadah Selesai</label>
                                <input class="form-control" type="time" id="jam_akhir" name="jam_akhir" value="00:00" required>
                            </div>

                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
<script>
    $('#tabelIbadahActive').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $('#tabelIbadahInactive').DataTable({
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

            let id = data[0];
            let nama_ibadah = data[1];
            let alias_ibadah = data[2];
            let stand = data[3];
            let awal = data[4];
            let akhir = data[5];

            $('#updateJadwalIbadah').find('input[name="id_jadwal_ibadah"]').val(id);
            $('#updateJadwalIbadah').find('input[name="nama_ibadah"]').val(nama_ibadah);
            $('#updateJadwalIbadah').find('input[name="alias_ibadah"]').val(alias_ibadah);
            $('#updateJadwalIbadah').find('input[name="jam_stand_by"]').val(stand);
            $('#updateJadwalIbadah').find('input[name="jam_mulai"]').val(awal);
            $('#updateJadwalIbadah').find('input[name="jam_akhir"]').val(akhir);
        });
    });

</script>
@endsection


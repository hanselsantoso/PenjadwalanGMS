@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Jadwal</h2>
                </div>

                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJadwal">
                        Tambah Jadwal
                    </button>
                </div>
            </div>
            
            <div class="col-md p-2 px-3 mt-2 mb-3 shadow-sm rounded bg-light">
                <form action="{{ route('jadwal.download') }}" method="GET">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-auto mb-0">
                            <label for="start_date" class="form-label me-3">From Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="col-auto mb-0">
                            <label for="end_date" class="form-label me-3">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>
                        Download
                    </button>
                </form>
            </div>

            <h4>Jadwal Aktif</h4>
            <table id="tabelJadwalActive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Cabang</th>
                        <th width="20%">Nama Ibadah</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Stand By</th>
                        <th width="10%">Jam</th>
                        <th width="10%">PIC</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($jadwalActive as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_h" value="{{$item["id_jadwal_h"] }}">
                            <input type="hidden" name="cabang" value="{{$item["id_cabang"] }}">
                            <input type="hidden" name="tanggal_jadwal" value="{{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}">
                            <input type="hidden" name="jadwal_ibadah" value="{{$item["id_jadwal_ibadah"] }}">
                            <input type="hidden" name="pic_user" value="{{$item["pic"] }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->cabang->nama_cabang ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->nama_ibadah ?? "-" }}</td>
                            <td> {{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}</td>
                            <td> {{ $item->jadwalIbadah->jam_stand_by ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->jam_mulai ?? "-" }} - {{$item->jadwalIbadah->jam_akhir ?? "-" }}</td>
                            <td> {{ $item->user->nama_lengkap ?? "-" }}</td>

                            <td>
                                <a href="/admin/jadwal/detail/{{$item["id_jadwal_h"] }}" class="btn btn-primary w-100 mb-2">
                                    Detail
                                </a>

                                <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateJadwal">
                                    Update
                                </a>

                                <form action="/admin/jadwal/deactivate/{{ $item["id_jadwal_h"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Deactivate</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <hr/>
            <h4>Jadwal Tidak Aktif</h4>
            <table id="tabelJadwalInactive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Cabang</th>
                        <th width="20%">Nama Ibadah</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Stand By</th>
                        <th width="10%">Jam</th>
                        <th width="10%">PIC</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($jadwalInactive as $item)
                        <tr>
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->cabang->nama_cabang ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->nama_ibadah ?? "-" }}</td>
                            <td> {{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}</td>
                            <td> {{ $item->jadwalIbadah->jam_stand_by ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->jam_mulai ?? "-" }} - {{$item->jadwalIbadah->jam_akhir ?? "-" }}</td>
                            <td> {{ $item->user->nama_lengkap ?? "-" }}</td>

                            <td>
                                <a href="/admin/jadwal/detail/{{$item["id_jadwal_h"] }}" class="btn btn-primary w-100 mb-2">
                                    Detail
                                </a>

                                <form action="/admin/jadwal/activate/{{ $item["id_jadwal_h"] }}" method="post">
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
    <div class="modal fade" id="createJadwal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('jadwal_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="text" class="form-control datepicker" id="tanggal_jadwal"  name="tanggal_jadwal" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="cabang">Cabang</label>
                            <select class="form-control" name="cabang" required>
                                <option value="" disabled selected>Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="jadwal_ibadah">Ibadah</label>
                            <select class="form-control" name="jadwal_ibadah" required>
                                <option value="" disabled selected>Pilih Ibadah</option>
                                @foreach ($jadwalIbadah as $item)
                                    <option value="{{ $item->id_jadwal_ibadah }}">{{ $item->nama_ibadah }}: {{ $item->jam_mulai }} - {{ $item->jam_akhir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="pic_user">PIC</label>
                            <select class="form-control" name="pic_user" required disabled>
                                <option value="" disabled selected>Pilih PIC</option>
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
                    <h4 class="modal-title">Ubah Bagian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_jadwal_h">
                    <input type="hidden" name="cabang">
                    <input type="hidden" name="jadwal_ibadah">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="text" class="form-control datepicker" id="tanggal_jadwal" name="tanggal_jadwal" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="cabang">Cabang</label>
                            <select class="form-control" name="cabang" required disabled>
                                <option value="" disabled selected>Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="jadwal_ibadah">Ibadah</label>
                            <select class="form-control" name="jadwal_ibadah" required disabled>
                                <option value="" disabled selected>Pilih Ibadah</option>
                                @foreach ($jadwalIbadah as $item)
                                    @if($item->id_cabang == old('cabang'))
                                        <option value="{{ $item->id_jadwal_ibadah }}">{{ $item->nama_ibadah }}: {{ $item->jam_mulai }} - {{ $item->jam_akhir }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="user">PIC</label>
                            <select class="form-control" name="pic_user" required>
                                <option value="" disabled selected>Pilih PIC</option>
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
    $('#tabelJadwalActive').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $('#tabelJadwalInactive').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    var USERS = @json($user);
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;

    // Set the default value property to today's date
    $('#tanggal_jadwal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $("#tanggal_jadwal").val(today);
    // $('#tanggal_jadwal').datepicker({
    //     format: 'dd-mm-yyyy',
    //     autoclose: true
    // });

    $(document).ready(function () {
        // Add this new event handler
        $('select[name="cabang"]').on('change', function() {
            var cabangId = $(this).val();
            var picUser = $('select[name="pic_user"]');
            
            picUser.prop('disabled', !cabangId);
            picUser.empty();
            picUser.append('<option value="" disabled selected>Pilih PIC</option>');
            
            if (cabangId) {
                $.each(USERS, function(index, item) {
                    if (item.id_cabang == cabangId) {
                        picUser.append(new Option(
                            item.nama_lengkap,
                            item.id
                        ));
                    }
                });
            }
        });
        
        // Existing buttonEdit click handler
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            var hiddenInputs = row.find('input[type="hidden"]');
            var data = [];
            hiddenInputs.each(function() {
                var value = $(this).val();
                data.push(value);
            });

            let id = data[0];
            let cabang = data[1];
            let tanggal = data[2];
            let jadwal = data[3];
            let pic = data[4];
            // Convert date format from DD-MM-YYYY to MM-DD-YYYY
            let dateParts = tanggal.split('-');
            let formattedDate = dateParts[1] + '-' + dateParts[0] + '-' + dateParts[2];
            tanggal = formattedDate;
            
            $('#updateJadwal').find('input[name="id_jadwal_h"]').val(id);
            $('#updateJadwal').find('input[name="tanggal_jadwal"]').datepicker('setDate', tanggal);
            $('#updateJadwal').find('input[name="cabang"]').val(cabang);
            $('#updateJadwal').find('select[name="cabang"]').val(cabang);
            $('#updateJadwal').find('input[name="jadwal_ibadah"]').val(jadwal);
            $('#updateJadwal').find('select[name="jadwal_ibadah"]').val(jadwal);

            
            var picUser = $('#updateJadwal').find('select[name="pic_user"]');
            picUser.empty();
            picUser.append('<option value="" disabled selected>Pilih PIC</option>');
            $.each(USERS, function(index, item) {
                if (item.id_cabang == cabang) {
                    picUser.append(new Option(
                        item.nama_lengkap,
                        item.id
                    ));
                }
            });
            picUser.val(pic);
        });
    });

</script>
@endsection


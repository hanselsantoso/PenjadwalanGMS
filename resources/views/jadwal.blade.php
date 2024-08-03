@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar Jadwal</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJadwal">
                        Tambah Jadwal
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Cabang</th>
                    <th>Tanggal</th>
                    <th>Stand By</th>
                    <th>Jam</th>
                    <th>PIC</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($jadwal as $item)
                    <tr>
                        <input type="hidden" name="id_jadwal_h" value="{{$item["id_jadwal_h"] }}">
                        <input type="hidden" name="nama_bagian" value="{{$item["id_cabang"] }}">
                        <input type="hidden" name="nama_bagian" value="{{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}">
                        <input type="hidden" name="nama_bagian" value="{{$item["id_jadwal_ibadah"] }}">
                        <input type="hidden" name="nama_bagian" value="{{$item["pic"] }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{$item->cabang->nama_cabang }}</td>
                        <td> {{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}</td>
                        <td> {{$item->jadwalIbadah->jam_stand_by }}</td>
                        <td> {{$item->jadwalIbadah->jam_mulai }} - {{$item->jadwalIbadah->jam_akhir }}</td>
                        <td> {{$item->user->nama_lengkap }}</td>

                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                            <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateJadwal">Update</a>
                            @if ($item->status_tag == 1)
                                <form action="/admin/bagian/deactivate/{{ $item["id_bagian"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Suspend</button>
                                </form>
                            @else
                                <form action="/admin/bagian/activate/{{ $item["id_bagian"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Aktifkan</button>
                                </form>
                            @endif
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
                        <div class="form-group">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="text" class="form-control datepicker"  name="tanggal_jadwal" required>
                        </div>
                        <div class="form-group">
                            <label for="cabang">Cabang</label>
                            <select class="form-control" name="cabang" required>
                                <option value="0">Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jadwal_ibadah">Slot Jadwal</label>
                            <select class="form-control" name="jadwal_ibadah" required>
                                <option value="0">Pilih Jam</option>
                                @foreach ($jadwalIbadah as $item)
                                    <option value="{{ $item->id_jadwal_ibadah }}">{{ $item->jam_mulai }} - {{ $item->jam_akhir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user">PIC</label>
                            <select class="form-control" name="user" required>
                                <option value="0">Pilih User</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
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
                    <h4 class="modal-title">Ubah Bagian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('bagian_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_jadwal_h">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="text" class="form-control datepicker" id="tanggal_jadwal" name="tanggal_jadwal" required>
                        </div>
                        <div class="form-group">
                            <label for="cabang">Cabang</label>
                            <select class="form-control" name="cabang" required>
                                <option value="0">Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jadwal_ibadah">Slot Jadwal</label>
                            <select class="form-control" name="jadwal_ibadah" required>
                                <option value="0">Pilih Jam</option>
                                @foreach ($jadwalIbadah as $item)
                                    <option value="{{ $item->id_jadwal_ibadah }}">{{ $item->jam_mulai }} - {{ $item->jam_akhir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user">PIC</label>
                            <select class="form-control" name="user" required>
                                <option value="0">Pilih User</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
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
            let cabang = data[1];
            let tanggal = data[2];
            let slot = data[3];
            let pic = data[4];

            $('#updateJadwal').find('select[name="id_jadwal_h"]').val(id);
            $('#updateJadwal').find('select[name="cabang"]').val(cabang);
            $('#updateJadwal').find('select[name="jadwal_ibadah"]').val(slot);
            $('#updateJadwal').find('select[name="user"]').val(pic);

            $('#updateJadwal').find('input[name="tanggal_jadwal"]').datepicker('setDate', tanggal);

            // $("#tanggal_jadwal").datepicker("setDate", tanggal);
        });
    });

</script>
@endsection


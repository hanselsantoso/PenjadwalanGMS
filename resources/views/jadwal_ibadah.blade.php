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

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="30%">Nama Ibadah</th>
                        <th width="30%">Alias</th>
                        <th width="15%">Jam Stand By</th>
                        <th width="15%">Jam Mulai</th>
                        <th width="15%">Jam Akhir</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
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
                            @if ($item->status_jadwal_ibadah == 1)
                                <form action="/admin/jadwal_ibadah/deactivate/{{ $item["id_jadwal_ibadah"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                </form>
                            @else
                                <form action="/admin/jadwal_ibadah/activate/{{ $item["id_jadwal_ibadah"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Aktifkan</button>
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
    @php
    function generateTimeOptions() {
        $options = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $time1 = sprintf("%02d:00", $hour);
            $time2 = sprintf("%02d:30", $hour);
            $options[] = "<option value=\"{$time1}\">{$time1}</option>";
            $options[] = "<option value=\"{$time2}\">{$time2}</option>";
        }
        $options[] = "<option value=\"24:00\">24:00</option>";
        return implode("\n", $options);
    }
    @endphp
    <div class="modal fade" id="createJadwalIbadah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal Ibadah</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_ibadah_store') }}" method="post">
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
                            <label for="nama_tag">Jam Stand By</label>
                            <select class="form-control" name="jam_stand_by" id="jam_stand_by">
                                {!! generateTimeOptions() !!}
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_tag">Jam Ibadah Mulai</label>
                            <select class="form-control" name="jam_mulai" id="jam_mulai">
                                {!! generateTimeOptions() !!}
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="nama_tag">Jam Ibadah Selesai</label>
                            <select class="form-control" name="jam_akhir" id="jam_akhir">
                                {!! generateTimeOptions() !!}
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
    <div class="modal fade" id="updateJadwalIbadah">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Jadwal Ibadah</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('jadwal_ibadah_update') }}" method="post">
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
                                <label for="nama_tag">Jam Stand By</label>
                                <select class="form-control" name="jam_stand_by" id="jam_stand_by">
                                    {!! generateTimeOptions() !!}
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="nama_tag">Jam Ibadah Mulai</label>
                                <select class="form-control" name="jam_mulai" id="jam_mulai">
                                    {!! generateTimeOptions() !!}
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label for="nama_tag">Jam Ibadah Selesai</label>
                                <select class="form-control" name="jam_akhir" id="jam_akhir">
                                    {!! generateTimeOptions() !!}
                                </select>
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
            let nama_ibadah = data[1];
            let alias_ibadah = data[2];
            let stand = data[3];
            let awal = data[4];
            let akhir = data[5];

            $('#updateJadwalIbadah').find('input[name="id_jadwal_ibadah"]').val(id);
            $('#updateJadwalIbadah').find('input[name="nama_ibadah"]').val(nama_ibadah);
            $('#updateJadwalIbadah').find('input[name="alias_ibadah"]').val(alias_ibadah);
            $('#updateJadwalIbadah').find('select[name="jam_stand_by"]').val(stand);
            $('#updateJadwalIbadah').find('select[name="jam_mulai"]').val(awal);
            $('#updateJadwalIbadah').find('select[name="jam_akhir"]').val(akhir);
        });
    });

</script>
@endsection


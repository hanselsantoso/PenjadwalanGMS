@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar Cabang</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
                        Tambah Cabang
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID Cabang</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    {{-- @foreach ($user as $item) --}}
                        <tr>
                            <td>dummy id</td>
                            <td>dummy nama</td>
                            <td>dummy status</td>
                            {{-- <td> {{$item["id_cabang"] }}</td>
                            <td> {{$item["nama_cabang"] }}</td>
                            <td> {{$item["status_cabang"] }}</td> --}}
                            <td>
                                <a href="" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateUser">Update</a>
                                <a href=""  class="btn btn-warning">button</a>
                                {{-- @if ($item->status_user == 1)
                                    <form action="/admin/user/deactivate/{{ $item["id"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </form>
                                @else
                                    <form action="/admin/user/activate/{{ $item["id"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Aktifkan</button>
                                    </form>
                                @endif --}}
                            </td>
                        </tr>
                    {{-- @endforeach --}}

                </tbody>
              </table>
        </div>
    </div>
    <!-- Create User Modal -->
    <div class="modal fade" id="createUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('user_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nij">Nama Cabang</label>
                            <input type="text" class="form-control" name="nij" required>
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
    <div class="modal fade" id="updateUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('user_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="idUser">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nij">Nama Cabang</label>
                            <input type="text" class="form-control" name="nij" required>
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
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;

    // Set the default value property to today's date
    $('#tglLahir').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $("#tglLahir").val(today);
    $('#tglLahirUpdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
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
            let nij = data[1];
            let nama = data[2];
            let email = data[3];
            let alamat = data[4];
            let jenis_kelamin = data[5];
            let tempatLahir = data[6];
            let tanggalLahir = data[7];
            let telp = data[8];
            let kesibukan = data[9];
            let nomor_cg = data[10];
            let posisi_cg = data[11];
            let nama_pemimpin = data[12];
            let telp_pemimpin = data[13];

            $('#updateUser').find('input[name="idUser"]').val(id);
            $('#updateUser').find('input[name="nij"]').val(nij);
            $('#updateUser').find('input[name="nama_lengkap"]').val(nama);
            $('#updateUser').find('input[name="alamat"]').val(alamat);
            $('#updateUser').find('select[name="kesibukan"]').val(kesibukan);
            $('#updateUser').find('input[name="email"]').val(email);
            $('#updateUser').find('input[name="tempatLahir"]').val(tempatLahir);
            $('#updateUser').find('input[name="tglLahirUpdate"]').datepicker('setDate', tanggalLahir);

            $("#tglLahirUpdate").datepicker("setDate", tanggalLahir);

            $('#updateUser').find('select[name="jenis_kelamin"]').val(jenis_kelamin);
            $('#updateUser').find('input[name="telp"]').val(telp);
            $('#updateUser').find('input[name="nomor_cg"]').val(nomor_cg);
            $('#updateUser').find('select[name="posisi_cg"]').val(posisi_cg);
            $('#updateUser').find('input[name="nama_pemimpin"]').val(nama_pemimpin);
            $('#updateUser').find('input[name="telp_pemimpin"]').val(telp_pemimpin);
        });
    });

</script>
@endsection


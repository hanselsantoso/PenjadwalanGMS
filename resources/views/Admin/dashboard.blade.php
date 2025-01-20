@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Data Volunteer</h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
                            Tambah Volunteer 
                        </button>
                    </div>
                </div>

                <div class="col-md p-2 px-3 mt-2 mb-3 shadow-sm rounded bg-light">                    
                    <form action="{{ route('user.excel_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="file" class="form-label fs-4">Upload User Excel File</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-success">Import Users</button>
                        </div>
                    </form>
                </div>

            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIJ</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <input type="hidden" name="idUser" value="{{$item["id"] }}">
                            <input type="hidden" name="nij" value="{{$item["nij"] }}">
                            <input type="hidden" name="nama" value="{{$item["nama_lengkap"] }}">
                            <input type="hidden" name="email" value="{{$item["email"] }}">
                            <input type="hidden" name="alamat" value="{{$item["alamat"] }}">
                            <input type="hidden" name="jenis_kelamin" value="{{$item["jenis_kelamin"] }}">
                            <input type="hidden" name="tempatLahir" value="{{$item["tempat_lahir"] }}">
                            <input type="hidden" name="tanggalLahir" value="{{$item->getTanggal($item["tanggal_lahir"])}}">
                            <input type="hidden" name="telp" value="{{$item["telp"] }}">
                            <input type="hidden" name="kesibukan" value="{{$item["kesibukan"] }}">
                            <input type="hidden" name="nomor_cg" value="{{$item["nomor_cg"] }}">
                            <input type="hidden" name="posisi_cg" value="{{$item["posisi_cg"] }}">
                            <input type="hidden" name="nama_pemimpin" value="{{$item["nama_pemimpin"] }}">
                            <input type="hidden" name="telp_pemimpin" value="{{$item["telp_pemimpin"] }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{$item["nij"] }}</td>
                            <td> {{$item["nama_lengkap"] }}</td>
                            <td> {{$item["email"] }}</td>
                            <td> {{$item["telp"] }}</td>
                            <td> {{$item["status_user"] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                {{-- <a href="" class="btn btn-primary">View</a> --}}
                                <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateUser">
                                    Update
                                </a>

                                @if ($item->status_user == 1)
                                    <form action="/admin/user/deactivate/{{ $item["id"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                    </form>
                                @else
                                    <form action="/admin/user/activate/{{ $item["id"] }}" method="post">
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
    <div class="modal fade" id="createUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('user_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nij">NIJ*</label>
                            <input type="text" class="form-control" name="nij" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_lengkap">Nama Lengkap*</label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="alamat">Alamat*</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="jenis_kelamin">Jenis Kelamin*</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="tempat_lahir">Tempat Lahir*</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="tanggal_lahir">Tanggal Lahir* [bug]</label>
                            <input type="text" class="form-control datepicker" id="tglLahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="telp">No. Telp*</label>
                            <input type="text" class="form-control" name="telp" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="kesibukan">Kesibukan*</label>
                            <select class="form-control" name="kesibukan" required>
                                <option value="Bekerja">Bekerja</option>
                                <option value="Kuliah">Kuliah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nomor_cg">Nomor CG*</label>
                            <input type="text" class="form-control" name="nomor_cg" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="posisi_cg">Posisi CG*</label>
                            <select class="form-control" name="posisi_cg" required>
                                <option value="Anggota">Anggota</option>
                                <option value="Pemimpin">Pemimpin</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_pemimpin">Nama Pemimpin*</label>
                            <input type="text" class="form-control" name="nama_pemimpin" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="telp_pemimpin">No. Telp Pemimpin*</label>
                            <input type="text" class="form-control" name="telp_pemimpin" required>
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
                    <h4 class="modal-title">Ubah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('user_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="idUser">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nij">NIJ*</label>
                            <input type="text" class="form-control" name="nij" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_lengkap">Nama Lengkap*</label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="alamat">Alamat*</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="jenis_kelamin">Jenis Kelamin*</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="tempat_lahir">Tempat Lahir*</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="tanggal_lahir">Tanggal Lahir*</label>
                            <input type="text" class="form-control" id="tglLahirUpdate" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="telp">No. Telp*</label>
                            <input type="text" class="form-control" name="telp" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="kesibukan">Kesibukan*</label>
                            <select class="form-control" name="kesibukan" required>
                                <option value="Bekerja">Bekerja</option>
                                <option value="Kuliah">Kuliah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nomor_cg">Nomor CG*</label>
                            <input type="text" class="form-control" name="nomor_cg" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="posisi_cg">Posisi CG*</label>
                            <select class="form-control" name="posisi_cg" required>
                                <option value="Anggota">Anggota</option>
                                <option value="Pemimpin">Pemimpin</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_pemimpin">Nama Pemimpin*</label>
                            <input type="text" class="form-control" name="nama_pemimpin" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="telp_pemimpin">No. Telp Pemimpin*</label>
                            <input type="text" class="form-control" name="telp_pemimpin" required>
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
            let tempat_lahir = data[6];
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
            $('#updateUser').find('input[name="tempat_lahir"]').val(tempat_lahir);
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


@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar User</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
                        Tambah User
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIJ</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telp</th>
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
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item["nij"] }}</td>
                            <td> {{$item["nama_lengkap"] }}</td>
                            <td> {{$item["email"] }}</td>
                            <td> {{$item["telp"] }}</td>
                            <td>
                                <a href="" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateUser">Update</a>
                                @if ($item->status_user == 1)
                                    <form action="/admin/user/deactivate/{{ $item["id"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </form>
                                @else
                                    <form action="/admin/user/activate/{{ $item["id"] }}" method="post">
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
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nij">NIJ:</label>
                                    <input type="text" class="form-control" id="nij" name="nij" value="{{ old('nij') }}">
                                    @error('nij')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                    @error('nama_lengkap')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="kesibukan">Kesibukan:</label>
                                    <select class="form-control" id="kesibukan" name="kesibukan">
                                        <option value="Pekerja" {{ old('kesibukan') == 'Pekerja' ? 'selected' : '' }}>Pekerja</option>
                                        <option value="Pelajar" {{ old('kesibukan') == 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                                        <option value="Mahasiswa" {{ old('kesibukan') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value="Lainnya" {{ old('kesibukan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kesibukan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Tempat lahir :</label>
                                    <input type="tempatLahir" class="form-control" id="tempatLahir" name="tempatLahir" value="{{ old('tempatLahir') }}">
                                    @error('tempatLahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tglLahirUpdate">Tanggal lahir :</label>
                                    <input type="text" class="form-control" id="tglLahirUpdate" name="tglLahirUpdate">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="1" {{ old('jenis_kelamin') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="0" {{ old('jenis_kelamin') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telp">Nomor Telepon:</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}" placeholder="+62872619819">
                                    @error('telp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nomor_cg">Nomor CG:</label>
                                    <input type="text" class="form-control" id="nomor_cg" name="nomor_cg" value="{{ old('nomor_cg') }}">
                                    @error('nomor_cg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="posisi_cg">Posisi CG:</label>
                                    <select class="form-control" id="posisi_cg" name="posisi_cg">
                                        <option value="Simpatisan" {{ old('posisi_cg') == 'Simpatisan' ? 'selected' : '' }}>Simpatisan</option>
                                        <option value="Member" {{ old('posisi_cg') == 'Member' ? 'selected' : '' }}>Member</option>
                                        <option value="Sponsor" {{ old('posisi_cg') == 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
                                        <option value="CG Leader" {{ old('posisi_cg') == 'CG Leader' ? 'selected' : '' }}>CG Leader</option>
                                        <option value="Coach" {{ old('posisi_cg') == 'Coach' ? 'selected' : '' }}>Coach</option>
                                        <option value="T.L" {{ old('posisi_cg') == 'T.L' ? 'selected' : '' }}>T.L</option>
                                    </select>
                                    @error('posisi_cg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="nama_pemimpin">Nama Pemimpin:</label>
                                        <input type="text" class="form-control" id="nama_pemimpin" name="nama_pemimpin" value="{{ old('nama_pemimpin') }}">
                                        @error('nama_pemimpin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telp_pemimpin">Nomor Telepon Pemimpin:</label>
                                        <input type="text" class="form-control" id="telp_pemimpin" name="telp_pemimpin" value="{{ old('telp_pemimpin') }}">
                                        @error('telp_pemimpin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nij">NIJ:</label>
                                    <input type="text" class="form-control" id="nij" name="nij" value="{{ old('nij') }}">
                                    @error('nij')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                                    @error('nama_lengkap')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="kesibukan">Kesibukan:</label>
                                    <select class="form-control" id="kesibukan" name="kesibukan">
                                        <option value="Pekerja" {{ old('kesibukan') == 'Pekerja' ? 'selected' : '' }}>Pekerja</option>
                                        <option value="Pelajar" {{ old('kesibukan') == 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                                        <option value="Mahasiswa" {{ old('kesibukan') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value="Lainnya" {{ old('kesibukan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kesibukan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Tempat lahir :</label>
                                    <input type="tempatLahir" class="form-control" id="tempatLahir" name="tempatLahir" value="{{ old('tempatLahir') }}">
                                    @error('tempatLahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tglLahirUpdate">Tanggal lahir :</label>
                                    <input type="text" class="form-control" id="tglLahirUpdate" name="tglLahirUpdate">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="1" {{ old('jenis_kelamin') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="0" {{ old('jenis_kelamin') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telp">Nomor Telepon:</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}" placeholder="+62872619819">
                                    @error('telp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nomor_cg">Nomor CG:</label>
                                    <input type="text" class="form-control" id="nomor_cg" name="nomor_cg" value="{{ old('nomor_cg') }}">
                                    @error('nomor_cg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="posisi_cg">Posisi CG:</label>
                                    <select class="form-control" id="posisi_cg" name="posisi_cg">
                                        <option value="Simpatisan" {{ old('posisi_cg') == 'Simpatisan' ? 'selected' : '' }}>Simpatisan</option>
                                        <option value="Member" {{ old('posisi_cg') == 'Member' ? 'selected' : '' }}>Member</option>
                                        <option value="Sponsor" {{ old('posisi_cg') == 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
                                        <option value="CG Leader" {{ old('posisi_cg') == 'CG Leader' ? 'selected' : '' }}>CG Leader</option>
                                        <option value="Coach" {{ old('posisi_cg') == 'Coach' ? 'selected' : '' }}>Coach</option>
                                        <option value="T.L" {{ old('posisi_cg') == 'T.L' ? 'selected' : '' }}>T.L</option>
                                    </select>
                                    @error('posisi_cg')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="nama_pemimpin">Nama Pemimpin:</label>
                                        <input type="text" class="form-control" id="nama_pemimpin" name="nama_pemimpin" value="{{ old('nama_pemimpin') }}">
                                        @error('nama_pemimpin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telp_pemimpin">Nomor Telepon Pemimpin:</label>
                                        <input type="text" class="form-control" id="telp_pemimpin" name="telp_pemimpin" value="{{ old('telp_pemimpin') }}">
                                        @error('telp_pemimpin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
        // format: 'yyyy-mm-dd', // You can change the date format
        format: 'dd-mm-yyyy', // You can change the date format
        autoclose: true
    });
    $("#tglLahir").val(today);
    $('#tglLahirUpdate').datepicker({
        // format: 'yyyy-mm-dd', // You can change the date format
        format: 'dd-mm-yyyy', // You can change the date format
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
            var row = $(this).closest('tr');
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

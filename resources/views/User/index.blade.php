@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                    <div class="col-md-6">
                        <h2>Daftar User</h2>
                    </div>

                    <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('user.excel.index') }}" class="btn btn-success">
                            Upload/Download Excel
                        </a>
                        <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                            Tambah User 
                        </button>
                    </div>
                </div>
            </div>

            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIJ</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Tim</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <input type="hidden" name="id_user" value="{{$item["id"] }}">

                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{$item["nij"] }}</td>
                            <td> {{$item["nama_lengkap"] }}</td>
                            <td> {{$item["email"] }}</td>
                            <td> {{$item["telp"] }}</td>
                            <td> {{$item->team_name }}</td>
                            <td> {{$item["status_user"] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <button class="btn btn-primary w-100 mb-2 btnDetail" data-toggle="modal">
                                    Detail
                                </button>
                                
                                <button class="btn btn-warning w-100 mb-2 btnEdit" data-toggle="modal">
                                    Update
                                </button>

                                @if ($item->status_user == 1)
                                    <form action="{{ route('user.deactivate', ['id' => $item['id']]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                    </form>
                                @else
                                    <form action="{{ route('user.activate', ['id' => $item['id']]) }}" method="post">
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

    <!-- User Modal -->
    <div class="modal fade" id="userModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="userModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <form id="userForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label for="nij">NIJ*</label>
                                    <input type="text" class="form-control" name="nij" id="nij" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="nama_lengkap">Nama Lengkap*</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="alamat">Alamat*</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="jenis_kelamin">Jenis Kelamin*</label>
                                    <select class="form-control form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option value="0">Laki-laki</option>
                                        <option value="1">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="tempat_lahir">Tempat Lahir*</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="tanggal_lahir">Tanggal Lahir* [bug]</label>
                                    <input type="text" class="form-control datepicker" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label for="telp">No. Telp*</label>
                                    <input type="text" class="form-control" name="telp" id="telp" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="kesibukan">Kesibukan*</label>
                                    <select class="form-control form-select" name="kesibukan" id="kesibukan" required>
                                        <option value="Bekerja">Bekerja</option>
                                        <option value="Kuliah">Kuliah</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="nomor_cg">Nomor CG*</label>
                                    <input type="text" class="form-control" name="nomor_cg" id="nomor_cg" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="posisi_cg">Posisi CG*</label>
                                    <select class="form-control form-select" name="posisi_cg" id="posisi_cg" required>
                                        <option value="Anggota">Anggota</option>
                                        <option value="Pemimpin">Pemimpin</option>
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="nama_pemimpin">Nama Pemimpin*</label>
                                    <input type="text" class="form-control" name="nama_pemimpin" id="nama_pemimpin" required>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="telp_pemimpin">No. Telp Pemimpin*</label>
                                    <input type="text" class="form-control" name="telp_pemimpin" id="telp_pemimpin" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 

@section('script')
<script>
    $('#table-list').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
        // Handle Create User button click
        $('#btnCreate').on('click', function() {
            $('#userModalLabel').text('Tambah User');
            $('#userForm').attr('action', '{{ route('user.store') }}');
            $('#userForm').find('input[name="_method"]').val('POST');
            $('#userForm')[0].reset(); // Clear form fields
            $('#userForm :input').prop('disabled', false); // Enable all inputs
            $('#userModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#userModal').modal('show');
        });

        function getUserFromArray(userId) {
            const users = <?php echo json_encode($user); ?>;
            const user = users.find(u => u.id == userId);
            console.log(user);
            return user;
        }
        
        function fillFields(userObject) {
            let modal = $('#userModal');
            modal.find('#id_user').val(userObject.id);
            modal.find('#nij').val(userObject.nij);
            modal.find('#nama_lengkap').val(userObject.nama_lengkap);
            modal.find('#email').val(userObject.email);
            modal.find('#alamat').val(userObject.alamat);
            modal.find('#jenis_kelamin').val(userObject.jenis_kelamin);
            modal.find('#tempat_lahir').val(userObject.tempat_lahir);
            
            // Format tanggal_lahir from YYYY-MM-DD to DD-MM-YYYY for datepicker
            if (userObject.tanggal_lahir) {
                let dateParts = userObject.tanggal_lahir.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                modal.find('#tanggal_lahir').val(formattedDate);
            } else {
                modal.find('#tanggal_lahir').val('');
            }
            
            modal.find('#telp').val(userObject.telp);
            modal.find('#kesibukan').val(userObject.kesibukan);
            modal.find('#nomor_cg').val(userObject.nomor_cg);
            modal.find('#posisi_cg').val(userObject.posisi_cg);
            modal.find('#nama_pemimpin').val(userObject.nama_pemimpin);
            modal.find('#telp_pemimpin').val(userObject.telp_pemimpin);
        }

        // Handle Detail User button click
        $('.btnDetail').on('click', function() {
            $('#userModalLabel').text('Detail User');
            $('#userForm').attr('action', '#'); // Set form action to a non-submittable value or clear it
            $('#userForm :input').prop('disabled', true); // Disable all inputs
            $('#userModal .modal-footer button[type="button"]').hide(); // Hide close button
            $('#userModal .modal-footer button[type="submit"]').hide(); // Hide submit button

            const userId = $(this).closest('tr').find('input[name="id_user"]').val();
            const userObject = getUserFromArray(userId);
            fillFields(userObject);

            $('#userModal').modal('show');
        });

        // Handle Update User button click
        $('.btnEdit').on('click', function() {
            $('#userModalLabel').text('Ubah User');
            $('#userForm').attr('action', '{{ route('user.update') }}');
            $('#userForm').find('input[name="_method"]').val('PUT');
            $('#userForm :input').prop('disabled', false); // Enable all inputs
            $('#userModal .modal-footer button[type="submit"]').show(); // Show submit button

            const userId = $(this).closest('tr').find('input[name="id_user"]').val();
            const userObject = getUserFromArray(userId);
            fillFields(userObject);

            $('#userModal').modal('show');
        });
    });
</script>
@endsection


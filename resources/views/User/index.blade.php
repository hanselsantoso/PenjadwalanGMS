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
                        <button type="button" id="btnFilter" class="btn btn-outline-secondary">
                            Filter
                        </button>
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
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <input type="hidden" name="id_user" value="{{$item->id }}">

                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{$item->nij }}</td>
                            <td> {{$item->nama_lengkap }}</td>
                            <td> {{$item->email }}</td>
                            <td> {{$item->telp }}</td>
                            <td> {{$item->team_name }}</td>
                            <td> 
                                @if ($item->status_user == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @elseif ($item->status_user == 2)
                                    <span class="badge rounded-pill badge-status-cuti">Cuti</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btnDetail" data-toggle="modal" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btnEdit" data-toggle="modal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if ($item->status_user == 1)
                                        <button type="button" class="btn btn-danger btnDeactivateModal" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deactivateModal" title="Non-Aktifkan">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    @else
                                        <form action="{{ route('user.activate', ['id' => $item->id]) }}" method="post" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success" title="Aktifkan">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-filter-overlay title="Filter User">
        <div class="mb-3">
            <label for="filter_nij" class="form-label">NIJ</label>
            <input type="text" class="form-control" id="filter_nij" name="filter_nij" placeholder="Cari NIJ">
        </div>
        <div class="mb-3">
            <label for="filter_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="filter_nama" name="filter_nama" placeholder="Cari Nama">
        </div>
        <div class="mb-3">
            <label for="filter_email" class="form-label">Email</label>
            <input type="text" class="form-control" id="filter_email" name="filter_email" placeholder="Cari Email">
        </div>
        <div class="mb-3">
            <label for="filter_telp" class="form-label">No. Telp</label>
            <input type="text" class="form-control" id="filter_telp" name="filter_telp" placeholder="Cari No. Telp">
        </div>
        <div class="mb-3">
            <label for="filter_team" class="form-label">Tim</label>
            <input type="text" class="form-control" id="filter_team" name="filter_team" placeholder="Cari Tim">
        </div>
        <div class="mb-3">
            <label for="filter_status" class="form-label">Status</label>
            <select class="form-select" id="filter_status" name="filter_status">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="2">Cuti</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
    </x-filter-overlay>

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

    <!-- Deactivate/Cuti Modal -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivateModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 5rem;"></i>
                    <h4>Pilih Aksi Non-Aktifkan</h4>
                    <p>Mohon pilih tindakan yang sesuai untuk user ini.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <form id="deactivateForm" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Non-Aktifkan</button>
                    </form>
                    <form id="cutiForm" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning">Cuti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 

@section('script')
<script>
    $(document).ready(function () {
        const table = $('#table-list').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        // Page-specific filter functions
        window.applyFilters = function() {
            const nij = $('#filter_nij').val();
            const nama = $('#filter_nama').val();
            const email = $('#filter_email').val();
            const telp = $('#filter_telp').val();
            const team = $('#filter_team').val();
            const status = $('#filter_status').val();

            // Status filter mapping
            const STATUS_FILTER = {
                "": "",           // No filter
                "1": "Aktif",
                "2": "Cuti",
                "0": "Tidak Aktif"
            };

            // Apply filters
            table.column(1).search(nij).draw();      // NIJ column
            table.column(2).search(nama).draw();     // Nama column
            table.column(3).search(email).draw();    // Email column
            table.column(4).search(telp).draw();     // No. Telp column
            table.column(5).search(team).draw();     // Tim column
            if (status == "") {
                table.column(6).search('').draw();
            } else {
                table.column(6).search(`^${STATUS_FILTER[status]}$`, true, false).draw(); // Status column (EQUAL and not LIKE)
            }
        };

        window.resetFilters = function() {
            // Clear filters
            table.column(1).search('').draw(); // NIJ
            table.column(2).search('').draw(); // Nama
            table.column(3).search('').draw(); // Email
            table.column(4).search('').draw(); // No. Telp
            table.column(5).search('').draw(); // Tim
            table.column(6).search('').draw(); // Status
        };

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

        // Handle Deactivate/Cuti Modal button click
        $('.btnDeactivateModal').on('click', function() {
            const userId = $(this).data('id');
            $('#deactivateModalLabel').text('Konfirmasi Aksi');
            $('#deactivateForm').attr('action', '{{ route('user.deactivate', ['id' => '__ID__']) }}'.replace('__ID__', userId));
            $('#cutiForm').attr('action', '{{ route('user.cuti', ['id' => '__ID__']) }}'.replace('__ID__', userId));
            $('#deactivateModal').modal('show');
        });
    });
</script>
@endsection


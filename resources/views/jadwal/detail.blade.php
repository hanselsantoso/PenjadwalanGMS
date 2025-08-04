@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="mb-3">
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-md mb-2">
                    <h2 class="text-primary fw-bold mb-3">
                        Detail Jadwal
                    </h2>
                    <h5 class="text-primary fw-bold mb-3">
                        {{$jadwal->cabang->nama_cabang}}: {{$jadwal->jadwalIbadah->nama_ibadah}}
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-calendar-fill"></i>
                        <p class="mb-0 ms-2">Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal_jadwal)->format('d-m-Y') }}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-clock-fill"></i> 
                        <p class="mb-0 ms-2">Jam: {{$jadwal->jadwalIbadah->jam_mulai}} - {{$jadwal->jadwalIbadah->jam_akhir}}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-bell-fill"></i> 
                        <p class="mb-0 ms-2">Stand By: {{$jadwal->jadwalIbadah->jam_stand_by}}</p>
                    </h5>
                    <h5 class="text-secondary d-flex align-items-center">
                        <i class="bi bi-check-circle-fill"></i>
                        <p class="mb-0 ms-2">
                            Status: 
                            @if($jadwal->status_jadwal_h == 1)
                                <span class="badge rounded-pill badge-status-active">Aktif</span>
                            @else
                                <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                            @endif
                        </p>
                    </h5>
                </div>

                <div class="d-flex gap-2 text-start mb-2">
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalDetailModal"
                        {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }}
                    >
                        Tambah Jadwal
                    </button>

                    <form action="{{ route('jadwal_detail.automation') }}" method="POST">
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
                            <input type="hidden" name="id_jadwal_d" value="{{$item->id_jadwal_d }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->user->nama_lengkap }}</td>
                            <td> {{$item->bagian->nama_bagian }}</td>
                            <td>
                                @if ($item->status_jadwal_d == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#jadwalDetailModal"
                                        {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }} title="Update"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('jadwal_detail.remove', $item->id_jadwal_d) }}" method="post" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            {{ $jadwal->status_jadwal_h == 0 ? 'disabled' : '' }} title="Remove"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Jadwal Detail Modal -->
    <div class="modal fade" id="jadwalDetailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="jadwalDetailModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                
                <form id="jadwalDetailForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_jadwal_h" value="{{$jadwal["id_jadwal_h"]}}">
                    <input type="hidden" name="id_jadwal_d" id="id_jadwal_d">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="user">Anggota</label>
                            <select class="form-control form-select" name="user" id="user" required>
                                <option value="" disabled selected>Pilih Anggota</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="bagian">Bagian</label>
                            <select class="form-control form-select" name="bagian" id="bagian" required>
                                <option value="" disabled selected>Pilih Bagian</option>
                                @foreach ($bagian as $item)
                                    <option value="{{ $item->id_bagian }}">{{ $item->nama_bagian }}</option>
                                @endforeach
                            </select>
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
    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
        function fillFields(jadwalDetailObject) {
            let modal = $('#jadwalDetailModal');
            modal.find('#id_jadwal_d').val(jadwalDetailObject.id_jadwal_d);
            modal.find('#user').val(jadwalDetailObject.id_user);
            modal.find('#bagian').val(jadwalDetailObject.id_bagian);
        }

        function getJadwalDetailFromArray(jadwalDetailId) {
            const jadwalDetails = <?php echo json_encode($jadwal->detail); ?>;
            return jadwalDetails.find(item => item.id_jadwal_d == jadwalDetailId);
        }

        // Handle Create Jadwal button click
        $('#btnCreate').on('click', function() {
            $('#jadwalDetailModalLabel').text('Tambah Jadwal');
            $('#jadwalDetailForm').attr('action', '{{ route("jadwal_detail.store") }}');
            $('#jadwalDetailForm').find('input[name="_method"]').val('POST');
            $('#jadwalDetailForm')[0].reset(); // Clear form fields
            $('#jadwalDetailForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalDetailModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#jadwalDetailModal').modal('show');
        });

        // Handle Update Jadwal button click
        $('.btnEdit').on('click', function() {
            $('#jadwalDetailModalLabel').text('Ubah Jadwal');
            $('#jadwalDetailForm').attr('action', '{{ route("jadwal_detail.update") }}');
            $('#jadwalDetailForm').find('input[name="_method"]').val('PUT');
            $('#jadwalDetailForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalDetailModal .modal-footer button[type="submit"]').show(); // Show submit button

            const jadwalDetailId = $(this).closest('tr').find('input[name="id_jadwal_d"]').val();
            const jadwalDetailObject = getJadwalDetailFromArray(jadwalDetailId);
            fillFields(jadwalDetailObject);

            $('#jadwalDetailModal').modal('show');
        });
    });

</script>
@endsection


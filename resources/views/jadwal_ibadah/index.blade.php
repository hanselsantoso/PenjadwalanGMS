@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Jadwal Ibadah</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-secondary me-2">
                        Filter
                    </button>
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalIbadahModal">
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
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalActive as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_ibadah" value="{{$item->id_jadwal_ibadah }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->nama_ibadah }}</td>
                            <td> {{$item->alias_ibadah }}</td>
                            <td> {{$item->jam_stand_by }}</td>
                            <td> {{$item->jam_mulai }}</td>
                            <td> {{$item->jam_akhir }}</td>
                            <td>
                                @if ($item->status_jadwal_ibadah == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#jadwalIbadahModal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if ($item->status_jadwal_ibadah == 1)
                                        <form action="{{ route('jadwal_ibadah.deactivate', $item->id_jadwal_ibadah) }}" method="post" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" title="Non-Aktifkan">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('jadwal_ibadah.activate', $item->id_jadwal_ibadah) }}" method="post" style="display:inline;">
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
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalInactive as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_ibadah" value="{{$item->id_jadwal_ibadah }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->nama_ibadah }}</td>
                            <td> {{$item->alias_ibadah }}</td>
                            <td> {{$item->jam_stand_by }}</td>
                            <td> {{$item->jam_mulai }}</td>
                            <td> {{$item->jam_akhir }}</td>
                            <td>
                                @if ($item->status_jadwal_ibadah == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#jadwalIbadahModal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if ($item->status_jadwal_ibadah == 1)
                                        <form action="{{ route('jadwal_ibadah.deactivate', $item->id_jadwal_ibadah) }}" method="post" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" title="Non-Aktifkan">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('jadwal_ibadah.activate', $item->id_jadwal_ibadah) }}" method="post" style="display:inline;">
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

    <x-filter-overlay title="Filter Jadwal Ibadah">
        <div class="mb-3">
            <label for="filter_nama_ibadah" class="form-label">Nama Ibadah</label>
            <input type="text" class="form-control" id="filter_nama_ibadah" name="filter_nama_ibadah" placeholder="Cari Nama Ibadah">
        </div>
        <div class="mb-3">
            <label for="filter_alias_ibadah" class="form-label">Alias</label>
            <input type="text" class="form-control" id="filter_alias_ibadah" name="filter_alias_ibadah" placeholder="Cari Alias">
        </div>
        <div class="mb-3">
            <label for="filter_jam_stand_by" class="form-label">Jam Stand By</label>
            <input type="text" class="form-control" id="filter_jam_stand_by" name="filter_jam_stand_by" placeholder="Cari Jam Stand By">
        </div>
        <div class="mb-3">
            <label for="filter_jam_mulai" class="form-label">Jam Mulai</label>
            <input type="text" class="form-control" id="filter_jam_mulai" name="filter_jam_mulai" placeholder="Cari Jam Mulai">
        </div>
        <div class="mb-3">
            <label for="filter_jam_akhir" class="form-label">Jam Akhir</label>
            <input type="text" class="form-control" id="filter_jam_akhir" name="filter_jam_akhir" placeholder="Cari Jam Akhir">
        </div>
    </x-filter-overlay>

    <!-- Jadwal Ibadah Modal -->
    <div class="modal fade" id="jadwalIbadahModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="jadwalIbadahModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form id="jadwalIbadahForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_jadwal_ibadah" id="id_jadwal_ibadah">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="nama_ibadah">Nama Ibadah</label>
                                    <input type="text" class="form-control" name="nama_ibadah" id="nama_ibadah" required>
                                </div>
                        </div>
                            <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="alias_ibadah">Alias Ibadah</label>
                                    <input type="text" class="form-control" name="alias_ibadah" id="alias_ibadah" required>
                                </div>
                        </div>
                            <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="jam_stand_by">Jam Stand By</label>
                            <input class="form-control" type="time" id="jam_stand_by" name="jam_stand_by" value="00:00" required>
                        </div>
                            </div>
                            <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="jam_mulai">Jam Ibadah Mulai</label>
                            <input class="form-control" type="time" id="jam_mulai" name="jam_mulai" value="00:00" required>
                        </div>
                            </div>
                            <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="jam_akhir">Jam Ibadah Selesai</label>
                            <input class="form-control" type="time" id="jam_akhir" name="jam_akhir" value="00:00" required>
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
    $(document).ready(function () {
        const tableActive = $('#tabelIbadahActive').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        const tableInactive = $('#tabelIbadahInactive').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        // Page-specific filter functions
        window.applyFilters = function() {
            const namaIbadah = $('#filter_nama_ibadah').val();
            const aliasIbadah = $('#filter_alias_ibadah').val();
            const jamStandBy = $('#filter_jam_stand_by').val();
            const jamMulai = $('#filter_jam_mulai').val();
            const jamAkhir = $('#filter_jam_akhir').val();
            const statusIbadah = $('#filter_status_ibadah').val();

            // Apply filters to both tables
            tableActive.column(1).search(namaIbadah).draw();      // Nama Ibadah column
            tableActive.column(2).search(aliasIbadah).draw();     // Alias column
            tableActive.column(3).search(jamStandBy).draw();      // Jam Stand By column
            tableActive.column(4).search(jamMulai).draw();        // Jam Mulai column
            tableActive.column(5).search(jamAkhir).draw();        // Jam Akhir column

            tableInactive.column(1).search(namaIbadah).draw();    // Nama Ibadah column
            tableInactive.column(2).search(aliasIbadah).draw();   // Alias column
            tableInactive.column(3).search(jamStandBy).draw();    // Jam Stand By column
            tableInactive.column(4).search(jamMulai).draw();      // Jam Mulai column
            tableInactive.column(5).search(jamAkhir).draw();      // Jam Akhir column
        };

        window.resetFilters = function() {
            // Clear filters from both tables
            tableActive.column(1).search('').draw(); // Nama Ibadah
            tableActive.column(2).search('').draw(); // Alias
            tableActive.column(3).search('').draw(); // Jam Stand By
            tableActive.column(4).search('').draw(); // Jam Mulai
            tableActive.column(5).search('').draw(); // Jam Akhir

            tableInactive.column(1).search('').draw(); // Nama Ibadah
            tableInactive.column(2).search('').draw(); // Alias
            tableInactive.column(3).search('').draw(); // Jam Stand By
            tableInactive.column(4).search('').draw(); // Jam Mulai
            tableInactive.column(5).search('').draw(); // Jam Akhir
        };

        // Function to fill modal fields
        function fillFields(jadwalIbadahObject) {
            let modal = $('#jadwalIbadahModal');
            modal.find('#id_jadwal_ibadah').val(jadwalIbadahObject.id_jadwal_ibadah);
            modal.find('#nama_ibadah').val(jadwalIbadahObject.nama_ibadah);
            modal.find('#alias_ibadah').val(jadwalIbadahObject.alias_ibadah);
            modal.find('#jam_stand_by').val(jadwalIbadahObject.jam_stand_by);
            modal.find('#jam_mulai').val(jadwalIbadahObject.jam_mulai);
            modal.find('#jam_akhir').val(jadwalIbadahObject.jam_akhir);
        }

        // Function to get jadwal ibadah object from array
        function getJadwalIbadahFromArray(jadwalIbadahId) {
            const jadwalActive = <?php echo json_encode($jadwalActive); ?>;
            const jadwalInactive = <?php echo json_encode($jadwalInactive); ?>;
            
            let jadwal = jadwalActive.find(j => j.id_jadwal_ibadah == jadwalIbadahId);
            if (!jadwal) {
                jadwal = jadwalInactive.find(j => j.id_jadwal_ibadah == jadwalIbadahId);
            }
            console.log(jadwal);
            return jadwal;
        }

        // Handle Create button click
        $('#btnCreate').on('click', function() {
            $('#jadwalIbadahModalLabel').text('Tambah Jadwal Ibadah');
            $('#jadwalIbadahForm').attr('action', '{{ route('jadwal_ibadah.store') }}');
            $('#jadwalIbadahForm').find('input[name="_method"]').val('POST');
            $('#jadwalIbadahForm')[0].reset(); // Clear form fields
            $('#jadwalIbadahForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalIbadahModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#jadwalIbadahModal').modal('show');
        });

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#jadwalIbadahModalLabel').text('Ubah Jadwal Ibadah');
            $('#jadwalIbadahForm').attr('action', '{{ route('jadwal_ibadah.update') }}');
            $('#jadwalIbadahForm').find('input[name="_method"]').val('PUT');
            $('#jadwalIbadahForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalIbadahModal .modal-footer button[type="submit"]').show(); // Show submit button

            const jadwalIbadahId = $(this).closest('tr').find('input[name="id_jadwal_ibadah"]').val();
            const jadwalIbadahObject = getJadwalIbadahFromArray(jadwalIbadahId);
            fillFields(jadwalIbadahObject);

            $('#jadwalIbadahModal').modal('show');
        });
    });

</script>
@endsection


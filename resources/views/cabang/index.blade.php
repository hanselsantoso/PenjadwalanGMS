@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Cabang</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-secondary me-2">
                        Filter
                    </button>
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cabangModal">
                        Tambah Cabang 
                    </button>
                </div>
            </div>

            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="60%">Nama</th>
                        <th width="10%">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $item)
                        <tr>
                            <input type="hidden" name="id_cabang" value="{{$item->id_cabang }}">

                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->nama_cabang }}</td>
                            <td>
                                @if ($item->status_cabang == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#cabangModal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if ($item->status_cabang == 1)
                                        <form action="{{ route('cabang.deactivate', $item->id_cabang) }}" method="post" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" title="Non-Aktifkan">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('cabang.activate', $item->id_cabang) }}" method="post" style="display:inline;">
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

    <x-filter-overlay title="Filter Cabang">
        <div class="mb-3">
            <label for="filter_nama_cabang" class="form-label">Nama Cabang</label>
            <input type="text" class="form-control" id="filter_nama_cabang" name="filter_nama_cabang" placeholder="Cari Nama Cabang">
        </div>
        <div class="mb-3">
            <label for="filter_status_cabang" class="form-label">Status</label>
            <select class="form-select" id="filter_status_cabang" name="filter_status_cabang">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
    </x-filter-overlay>

    <!-- Cabang Modal -->
    <div class="modal fade" id="cabangModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="cabangModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                
                <form id="cabangForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_cabang" id="id_cabang">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_cabang">Nama Cabang</label>
                            <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" required>
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
        const table = $('#table-list').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        // Page-specific filter functions
        window.applyFilters = function() {
            const namaCabang = $('#filter_nama_cabang').val();
            const statusCabang = $('#filter_status_cabang').val();

            // Apply filters
            const STATUS_FILTER = {
                "": "",           // No filter
                "1": "Aktif",
                "0": "Tidak Aktif"
            };
            table.column(1).search(namaCabang).draw();
            if (statusCabang == "") {
                table.column(2).search('').draw();
            } else {
                table.column(2).search(`^${STATUS_FILTER[statusCabang]}$`, true, false).draw(); // Status column (EQUAL and not LIKE)
            }
        };

        window.resetFilters = function() {
            // Clear filters
            table.column(1).search('').draw();
            table.column(2).search('').draw();
        };

        function fillFields(cabangObject) {
            let modal = $('#cabangModal');
            modal.find('#id_cabang').val(cabangObject.id_cabang);
            modal.find('#nama_cabang').val(cabangObject.nama_cabang);
        }

        function getCabangFromArray(cabangId) {
            const cabangs = <?php echo json_encode($cabang); ?>;
            const cabang = cabangs.find(c => c.id_cabang == cabangId);
            console.log(cabang);
            return cabang;
        }

        // Handle Create button click
        $('#btnCreate').on('click', function() {
            $('#cabangModalLabel').text('Tambah Cabang');
            $('#cabangForm').attr('action', '{{ route('cabang.store') }}');
            $('#cabangForm').find('input[name="_method"]').val('POST');
            $('#cabangForm')[0].reset(); // Clear form fields
            $('#cabangForm :input').prop('disabled', false); // Enable all inputs
            $('#cabangModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#cabangModal').modal('show');
        });

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#cabangModalLabel').text('Ubah Cabang');
            $('#cabangForm').attr('action', '{{ route('cabang.update') }}');
            $('#cabangForm').find('input[name="_method"]').val('PUT');
            $('#cabangForm :input').prop('disabled', false); // Enable all inputs
            $('#cabangModal .modal-footer button[type="submit"]').show(); // Show submit button

            const cabangId = $(this).closest('tr').find('input[name="id_cabang"]').val();
            const cabangObject = getCabangFromArray(cabangId);
            fillFields(cabangObject);

            $('#cabangModal').modal('show');
        });
    });
</script>
@endsection


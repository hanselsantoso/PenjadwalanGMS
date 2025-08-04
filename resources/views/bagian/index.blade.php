@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Bagian</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-secondary me-2">
                        Filter
                    </button>
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bagianModal">
                        Tambah Bagian 
                    </button>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="60%">Nama</th>
                        <th width="15%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bagian as $item)
                        <tr>
                            <input type="hidden" name="id_bagian" value="{{$item->id_bagian }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->nama_bagian }}</td>
                            <td> 
                                @if ($item->status_bagian == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#bagianModal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    @if ($item->status_bagian == 1)
                                        <form action="{{ route('bagian.deactivate', ['id' => $item->id_bagian]) }}" method="post" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" title="Non-Aktifkan">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('bagian.activate', ['id' => $item->id_bagian]) }}" method="post" style="display:inline;">
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

    <x-filter-overlay title="Filter Bagian">
        <div class="mb-3">
            <label for="filter_nama_bagian" class="form-label">Nama Bagian</label>
            <input type="text" class="form-control" id="filter_nama_bagian" name="filter_nama_bagian" placeholder="Cari Nama Bagian">
        </div>
        <div class="mb-3">
            <label for="filter_status_bagian" class="form-label">Status</label>
            <select class="form-select" id="filter_status_bagian" name="filter_status_bagian">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
    </x-filter-overlay>

    <!-- Bagian Modal -->
    <div class="modal fade" id="bagianModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="bagianModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <form id="bagianForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_bagian" id="id_bagian">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bagian">Nama Bagian</label>
                            <input type="text" class="form-control" name="nama_bagian" id="nama_bagian" required>
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
        const table = $('#tabelUser').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        // Page-specific filter functions
        window.applyFilters = function() {
            const namaBagian = $('#filter_nama_bagian').val();
            const statusBagian = $('#filter_status_bagian').val();

            // Status filter mapping
            const STATUS_FILTER = {
                "": "",           // No filter
                "1": "Aktif",
                "0": "Tidak Aktif"
            };

            // Apply filters
            table.column(1).search(namaBagian).draw();     // Nama column
            if (statusBagian == "") {
                table.column(2).search('').draw();
            } else {
                table.column(2).search(`^${STATUS_FILTER[statusBagian]}$`, true, false).draw(); // Status column (EQUAL and not LIKE)
            }
        };

        window.resetFilters = function() {
            // Clear filters
            table.column(1).search('').draw(); // Nama
            table.column(2).search('').draw(); // Status
        };

        // Function to fill modal fields
        function fillFields(bagianObject) {
            let modal = $('#bagianModal');
            modal.find('#id_bagian').val(bagianObject.id_bagian);
            modal.find('#nama_bagian').val(bagianObject.nama_bagian);
        }

        // Function to get bagian object from array
        function getBagianFromArray(bagianId) {
            const bagians = <?php echo json_encode($bagian); ?>;
            const bagian = bagians.find(b => b.id_bagian == bagianId);
            console.log(bagian);
            return bagian;
        }

        // Handle Create button click
        $('#btnCreate').on('click', function() {
            $('#bagianModalLabel').text('Tambah Bagian');
            $('#bagianForm').attr('action', '{{ route('bagian.store') }}');
            $('#bagianForm').find('input[name="_method"]').val('POST');
            $('#bagianForm')[0].reset(); // Clear form fields
            $('#bagianForm :input').prop('disabled', false); // Enable all inputs
            $('#bagianModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#bagianModal').modal('show');
        });

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#bagianModalLabel').text('Ubah Bagian');
            $('#bagianForm').attr('action', '{{ route('bagian.update') }}');
            $('#bagianForm').find('input[name="_method"]').val('PUT');
            $('#bagianForm :input').prop('disabled', false); // Enable all inputs
            $('#bagianModal .modal-footer button[type="submit"]').show(); // Show submit button

            const bagianId = $(this).closest('tr').find('input[name="id_bagian"]').val();
            const bagianObject = getBagianFromArray(bagianId);
            fillFields(bagianObject);

            $('#bagianModal').modal('show');
        });
    });

</script>
@endsection


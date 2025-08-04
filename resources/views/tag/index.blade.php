@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Tag</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-secondary me-2">
                        Filter
                    </button>
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagModal">
                        Tambah Tag
                    </button>
                </div>
            </div>

            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tag</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag as $item)
                        <tr>
                            <input type="hidden" name="id" value="{{$item->id_tag }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->nama_tag }}</td>
                            <td>
                                @if ($item->status_tag == 1)
                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                @else
                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning w-100 mb-2 btnEdit" data-bs-toggle="modal" data-bs-target="#tagModal">
                                    Update
                                </button>

                                @if ($item->status_tag == 1)
                                    <form action="{{ route('tag.deactivate', ['id' => $item->id_tag]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Non-Aktifkan</button>
                                    </form>
                                @else
                                    <form action="{{ route('tag.activate', ['id' => $item->id_tag]) }}" method="post">
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

    <x-filter-overlay title="Filter Tag">
        <div class="mb-3">
            <label for="filter_nama_tag" class="form-label">Nama Tag</label>
            <input type="text" class="form-control" id="filter_nama_tag" name="filter_nama_tag" placeholder="Cari Nama Tag">
        </div>
        <div class="mb-3">
            <label for="filter_status_tag" class="form-label">Status</label>
            <select class="form-select" id="filter_status_tag" name="filter_status_tag">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
    </x-filter-overlay>

    <!-- Tag Modal -->
    <div class="modal fade" id="tagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="tagModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form id="tagForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_tag" id="id_tag">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nama_tag">Nama Tag*</label>
                            <input type="text" class="form-control" name="nama_tag" id="nama_tag" required>
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
            const namaTag = $('#filter_nama_tag').val();
            const statusTag = $('#filter_status_tag').val();

            // Status filter mapping
            const STATUS_FILTER = {
                "": "",           // No filter
                "1": "Aktif",
                "0": "Tidak Aktif"
            };

            // Apply filters
            table.column(1).search(namaTag).draw();     // Nama Tag column
            if (statusTag == "") {
                table.column(2).search('').draw();
            } else {
                table.column(2).search(`^${STATUS_FILTER[statusTag]}$`, true, false).draw(); // Status column (EQUAL and not LIKE)
            }
        };

        window.resetFilters = function() {
            // Clear filters
            table.column(1).search('').draw(); // Nama Tag
            table.column(2).search('').draw(); // Status
        };

        function getTagFromArray(tagId) {
            const tags = <?php echo json_encode($tag); ?>;
            return tags.find(item => item.id_tag == tagId);
        }

        function fillFields(tagObject) {
            let modal = $('#tagModal');
            modal.find('#id_tag').val(tagObject.id_tag);
            modal.find('#nama_tag').val(tagObject.nama_tag);
        }

        // Handle Create Tag button click
        $('#btnCreate').on('click', function() {
            $('#tagModalLabel').text('Tambah Tag');
            $('#tagForm').attr('action', '{{ route("tag.store") }}');
            $('#tagForm').find('input[name="_method"]').val('POST');
            $('#tagForm')[0].reset(); // Clear form fields
            $('#tagForm :input').prop('disabled', false); // Enable all inputs
            $('#tagModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#tagModal').modal('show');
        });

        // Handle Update Tag button click
        $('.btnEdit').on('click', function() {
            $('#tagModalLabel').text('Ubah Tag');
            $('#tagForm').attr('action', '{{ route("tag.update") }}');
            $('#tagForm').find('input[name="_method"]').val('PUT');
            $('#tagForm :input').prop('disabled', false); // Enable all inputs
            $('#tagModal .modal-footer button[type="submit"]').show(); // Show submit button

            const tagId = $(this).closest('tr').find('input[name="id"]').val();
            const tagObject = getTagFromArray(tagId);
            fillFields(tagObject);

            $('#tagModal').modal('show');
        });
    });
</script>
@endsection


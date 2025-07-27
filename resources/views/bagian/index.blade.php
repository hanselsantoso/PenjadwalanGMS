@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Bagian</h2>
                </div>
                <div class="col-md-6 text-end">
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
                        <input type="hidden" name="id_bagian" value="{{$item["id_bagian"] }}">
                        <td> {{ $loop->index + 1 }}</td>
                        <td> {{ $item["nama_bagian"] }}</td>
                        <td> {{$item["status_bagian"] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>

                        <td>
                            <button class="btn btn-warning w-100 mb-2 btnEdit" data-bs-toggle="modal" data-bs-target="#bagianModal">
                                Update
                            </button>

                            @if ($item->status_bagian == 1)
                                <form action="{{ route('bagian.deactivate', ['id' => $item["id_bagian"]]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                </form>
                            @else
                                <form action="{{ route('bagian.activate', ['id' => $item["id_bagian"]]) }}" method="post">
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
    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
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


@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Bagian</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBagian">
                        Tambah Bagian 
                    </button>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="70%">Nama Bagian</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bagian as $item)
                    <tr>
                        <input type="hidden" name="id_bagian" value="{{$item["id_bagian"] }}">
                        <input type="hidden" name="nama_bagian" value="{{$item["nama_bagian"] }}">
                        <td> {{ $loop->index + 1 }}</td>
                        <td> {{ $item["nama_bagian"] }}</td>

                        <td>
                            <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateBagian">
                                Update
                            </a>

                            @if ($item->status_bagian == 1)
                                <form action="/admin/bagian/deactivate/{{ $item["id_bagian"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                </form>
                            @else
                                <form action="/admin/bagian/activate/{{ $item["id_bagian"] }}" method="post">
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
    <div class="modal fade" id="createBagian">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Bagian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('bagian_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bagian">Nama Bagian</label>
                            <input type="text" class="form-control" name="nama_bagian" required>
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
    <div class="modal fade" id="updateBagian">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Bagian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('bagian_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_bagian">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bagian">Nama Bagian</label>
                            <input type="text" class="form-control" name="nama_bagian" required>
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
            let nama = data[1];

            $('#updateBagian').find('input[name="id_bagian"]').val(id);
            $('#updateBagian').find('input[name="nama_bagian"]').val(nama);
        });
    });

</script>
@endsection


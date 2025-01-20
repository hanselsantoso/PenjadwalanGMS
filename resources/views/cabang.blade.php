@extends('layouts.app')
@section('content')
    <div class="main">
    <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Lokasi</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCabang">
                        Tambah Lokasi 
                    </button>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="60%">Nama Lokasi</th>
                        <th width="10%">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $item)
                        <tr>
                            <input type="hidden" name="id_cabang" value="{{$item["id_cabang"] }}">
                            <input type="hidden" name="nama_cabang" value="{{$item["nama_cabang"] }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{$item["nama_cabang"] }}</td>
                            <td> {{$item["status_cabang"] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>

                            <td>
                                {{-- <a href="" class="btn btn-primary">View</a> --}}
                                <a href="#" class="btn btn-warning buttonEdit w-100 mb-2" data-toggle="modal" data-target="#updateCabang">
                                    Update
                                </a>

                                @if ($item->status_cabang == 1)
                                    <form action="/admin/cabang/deactivate/{{ $item["id_cabang"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                    </form>
                                @else
                                    <form action="/admin/cabang/activate/{{ $item["id_cabang"] }}" method="post">
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
    <div class="modal fade" id="createCabang">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Lokasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('cabang_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_cabang">Nama Lokasi</label>
                            <input type="text" class="form-control" name="nama_cabang" required>
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
    <div class="modal fade" id="updateCabang">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('cabang_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_cabang">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_cabang">Nama Cabang</label>
                            <input type="text" class="form-control" name="nama_cabang" required>
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

            $('#updateCabang').find('input[name="id_cabang"]').val(id);
            $('#updateCabang').find('input[name="nama_cabang"]').val(nama);
        });
    });

</script>
@endsection


@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar Tag</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTag">
                        Tambah Tag
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID Tag</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($tag as $item)
                    <tr>
                        <input type="hidden" name="id_tag" value="{{$item["id_tag"] }}">
                        <input type="hidden" name="nama_tag" value="{{$item["nama_tag"] }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{$item["nama_tag"] }}</td>

                        <td>
                            <a href="" class="btn btn-primary">View</a>
                            <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateTag">Update</a>
                            @if ($item->status_tag == 1)
                                <form action="/admin/tag/deactivate/{{ $item["id_tag"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Suspend</button>
                                </form>
                            @else
                                <form action="/admin/tag/activate/{{ $item["id_tag"] }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Aktifkan</button>
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
    <div class="modal fade" id="createTag">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tag</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tag_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_tag">Nama Tag</label>
                            <input type="text" class="form-control" name="nama_tag" required>
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
    <div class="modal fade" id="updateTag">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Tag</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tag_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_tag">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_tag">Nama Tag</label>
                            <input type="text" class="form-control" name="nama_tag" required>
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

            $('#updateTag').find('input[name="id_tag"]').val(id);
            $('#updateTag').find('input[name="nama_tag"]').val(nama);
        });
    });

</script>
@endsection


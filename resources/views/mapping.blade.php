@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar Mapping User</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMapping">
                        Tambah
                    </button>
                </div>
            </div>
            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama User </th>
                    <th>Tags </th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($mapping as $item)
                        <tr>
                            <input type="hidden" name="id_user_tag" value="{{$item["id_user_tag"] }}">
                            <input type="hidden" name="id_user" value="{{$item["id_user"] }}">
                            <input type="hidden" name="id_tag" value="{{$item["id_tag"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->user->nama_lengkap }}</td>
                            <td> {{$item->tag->nama_tag }}</td>

                            <td>
                                <a href="" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-warning buttonEdit" data-toggle="modal" data-target="#updateMapping">Update</a>
                                @if ($item->status_user_tag == 1)
                                    <form action="/admin/mapping/deactivate/{{ $item["id_user_tag"] }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </form>
                                @else
                                    <form action="/admin/mapping/activate/{{ $item["id_user_tag"] }}" method="post">
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
    <div class="modal fade" id="createMapping">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('mapping_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" name="user" required>
                                <option value="0">Pilih User</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="form-control" name="tags">
                                <option value="0">Pilih Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id_tag }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="updateMapping">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('mapping_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_user_tag">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" name="user" required>
                                <option value="0">Pilih User</option>

                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="form-control" name="tags">
                                <option value="0">Pilih Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id_tag }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
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
            let nama_user = data[1];
            let nama_tag = data[2];

            $('#updateMapping').find('input[name="id_user_tag"]').val(id);
            $('#updateMapping').find('select[name="user"]').val(nama_user);
            $('#updateMapping').find('select[name="tags"]').val(nama_tag);
        });
    });

</script>
@endsection


@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Grade Volunteer</h2>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NIJ</th>
                        <th width="30%">Nama</th>
                        <th width="10%">Team</th>
                        <th width="10%">Grade</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <input type="hidden" name="idUser" value="{{$item["id"] }}">
                            <input type="hidden" name="grade" value="{{$item["grade"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item["nij"] }}</td>
                            <td> {{$item["nama_lengkap"] }}</td>
                            <td> {{$item->team_name }}</td>
                            <td> {{$item["grade"] }}</td>
                            <td>
                                {{-- <a href="" class="btn btn-primary">View</a> --}}
                                <a href="#" class="btn btn-warning buttonEdit w-100" data-toggle="modal" data-target="#updateUser">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update User Modal -->
    <div class="modal fade" id="updateUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('grading_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="idUser">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="number" min="1" max="10"  class="form-control" name="grade" required>
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
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;

    // Set the default value property to today's date
    $('#tglLahir').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $("#tglLahir").val(today);
    $('#tglLahirUpdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
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
            let grade = data[1];

            $('#updateUser').find('input[name="idUser"]').val(id);
            $('#updateUser').find('input[name="grade"]').val(grade);
        });
    });

</script>
@endsection


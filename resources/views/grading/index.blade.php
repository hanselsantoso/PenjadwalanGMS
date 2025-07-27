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
                            <input type="hidden" name="id_user" value="{{$item["id"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item["nij"] }}</td>
                            <td> {{$item["nama_lengkap"] }}</td>
                            <td> {{$item->team_name }}</td>
                            <td> {{$item["grade"] }}</td>
                            <td>
                                <button class="btn btn-warning w-100 btnEdit" data-bs-toggle="modal" data-bs-target="#gradingModal">Update</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grading Modal -->
    <div class="modal fade" id="gradingModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="gradingModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                {{-- TODO: Bug 419 Page Expired when Updating --}}
                <form id="gradingForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nij">NIJ</label>
                            <input type="text" class="form-control" name="nij" id="nij">
                        </div>
                        <div class="form-group mb-1">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                        </div>
                        <div class="form-group mb-1">
                            <label for="team_name">Team</label>
                            <input type="text" class="form-control" name="team_name" id="team_name">
                        </div>
                        <div class="form-group mb-1">
                            <label for="grade">Grade</label>
                            <input type="number" min="1" max="10"  class="form-control" name="grade" id="grade" required>
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
        // Function to fill modal fields
        function fillFields(userObject) {
            let modal = $('#gradingModal');
            modal.find('#id_user').val(userObject.id);
            modal.find('#nij').val(userObject.nij);
            modal.find('#nama_lengkap').val(userObject.nama_lengkap);
            modal.find('#team_name').val(userObject.team_name);
            modal.find('#grade').val(userObject.grade);
        }

        // Function to get user object from array
        function getUserFromArray(userId) {
            const users = <?php echo json_encode($user); ?>;
            const user = users.find(u => u.id == userId);
            console.log(user);
            return user;
        }

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#gradingModalLabel').text('Ubah Grade');
            $('#gradingForm').attr('action', '{{ route('grading.update') }}');
            $('#gradingForm').find('input[name="_method"]').val('PUT');
            
            // Enable only the grade input
            $('#gradingForm :input').prop('disabled', true);
            $('#gradingForm #grade').prop('disabled', false);
            $('#gradingModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#gradingModal .modal-footer button[type="submit"]').prop('disabled', false);
            $('#gradingModal .modal-footer button[type="button"]').prop('disabled', false);

            const userId = $(this).closest('tr').find('input[name="id_user"]').val();
            const userObject = getUserFromArray(userId);
            fillFields(userObject);

            $('#gradingModal').modal('show');
        });
    });

</script>
@endsection


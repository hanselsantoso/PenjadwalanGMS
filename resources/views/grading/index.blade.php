@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Grade Volunteer</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnFilter" class="btn btn-outline-secondary">
                        Filter
                    </button>
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
                            <input type="hidden" name="id_user" value="{{$item->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{$item->nij }}</td>
                            <td>{{$item->nama_lengkap }}</td>
                            <td>{{$item->team_name }}</td>
                            <td>{{$item->grade }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#gradingModal" title="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-filter-overlay title="Filter Grade Volunteer">
        <div class="mb-3">
            <label for="filter_nij" class="form-label">NIJ</label>
            <input type="text" class="form-control" id="filter_nij" name="filter_nij" placeholder="Cari NIJ">
        </div>
        <div class="mb-3">
            <label for="filter_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="filter_nama" name="filter_nama" placeholder="Cari Nama">
        </div>
        <div class="mb-3">
            <label for="filter_team" class="form-label">Team</label>
            <input type="text" class="form-control" id="filter_team" name="filter_team" placeholder="Cari Team">
        </div>
        <div class="mb-3">
            <label for="filter_grade" class="form-label">Grade</label>
            <select class="form-select" id="filter_grade" name="filter_grade">
                <option value="">Semua Grade</option>
                <option value="1">Grade 1</option>
                <option value="2">Grade 2</option>
                <option value="3">Grade 3</option>
                <option value="4">Grade 4</option>
                <option value="5">Grade 5</option>
                <option value="6">Grade 6</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
            </select>
        </div>
    </x-filter-overlay>

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
    $(document).ready(function () {
        const table = $('#tabelUser').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        // Page-specific filter functions
        window.applyFilters = function() {
            const nij = $('#filter_nij').val();
            const nama = $('#filter_nama').val();
            const team = $('#filter_team').val();
            const grade = $('#filter_grade').val();

            // Apply filters
            table.column(1).search(nij).draw();      // NIJ column
            table.column(2).search(nama).draw();     // Nama column
            table.column(3).search(team).draw();     // Team column
            table.column(4).search(grade).draw();    // Grade column
            if (grade == "") {
                table.column(4).search('').draw();
            } else {
                table.column(4).search(`^${grade}$`, true, false).draw(); // Status column (EQUAL and not LIKE)
            }
        };

        window.resetFilters = function() {
            // Clear filters
            table.column(1).search('').draw(); // NIJ
            table.column(2).search('').draw(); // Nama
            table.column(3).search('').draw(); // Team
            table.column(4).search('').draw(); // Grade
        };

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


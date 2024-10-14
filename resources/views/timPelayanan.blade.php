@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Daftar Tim Pelayanan</h2>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTimPelayanan">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="accordion" id="accordionCabang">
                @foreach ($cabangs as $cabang)
                    <div class="card">
                        <div class="card-header" id="headingCabang{{ $cabang->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCabang{{ $cabang->id }}" aria-expanded="true" aria-controls="collapseCabang{{ $cabang->id }}">
                                    {{ $cabang->nama_cabang }}  <!-- Display cabang name -->
                                </button>
                            </h2>
                        </div>

                        <div id="collapseCabang{{ $cabang->id }}" class="collapse" aria-labelledby="headingCabang{{ $cabang->id }}" data-parent="#accordionCabang">
                            <div class="card-body">
                                <!-- Nested Accordion for Teams -->
                                <div class="accordion" id="accordionTeams{{ $cabang->id }}">
                                    @foreach ($cabang->tim as $team)  <!-- Assuming each cabang has multiple teams -->
                                        <div class="card">
                                            <div class="card-header" id="headingTeam{{ $team->id }}">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <h3 class="mb-0">
                                                            {{ $team->nama_tim_pelayanan_h }} - {{ $team->user["nama_lengkap"] }} <!-- Team name and leader -->
                                                        </h3>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="hidden" id="id_pelayanan_h" name="id_pelayanan_h" value="{{$team["id_pelayanan_h"]}}">
                                                        <input type="hidden" id="nama_tim_pelayanan_h" name="nama_tim_pelayanan_h" value="{{$team["nama_tim_pelayanan_h"]}}">
                                                        <input type="hidden" id="id_user" name="id_user" value="{{$team["id_user"]}}">
                                                        <input type="hidden" id="id_cabang" name="id_cabang" value="{{$team["id_cabang"]}}">
                                                        <button class="btn btn-success buttonAddMember" data-id="{{ $team->id_pelayanan_h }}" data-toggle="modal" data-target="#addMember">Add</button>
                                                        <button class="btn btn-info buttonView" data-id="{{ $team->id }}" data-toggle="collapse" data-target="#collapseTeam{{ $team->id }}" aria-expanded="true" aria-controls="collapseTeam{{ $team->id }}">View</button>
                                                        <button class="btn btn-warning buttonEditPic" data-id="{{ $team->id }}" data-toggle="modal" data-target="#updatePIC">Edit</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        {{-- <form action="{{ route('tim_deactivate', $team->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="collapseTeam{{ $team->id }}" class="collapse" aria-labelledby="headingTeam{{ $team->id }}" data-parent="#accordionTeams{{ $cabang->id }}">
                                                <div class="card-body">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Anggota</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($team->tim_pelayanan_d as $member)
                                                                <tr>
                                                                    <input type="hidden" name="id_pelayanan_d" value="{{$member["id_pelayanan_d"]}}">
                                                                    <input type="hidden" name="id_user" value="{{$member["id_user"]}}">

                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $member->user["nama_lengkap"] }}</td>
                                                                    <td>
                                                                        <button class="btn btn-warning buttonEdit" data-id="{{ $member->id_pelayanan_d }}" data-toggle="modal" data-target="#updateMember">Edit</button>
                                                                        <form action="{{ route('tim_deactivate', ['id' => $member->id_pelayanan_d, 'id_user' => $member->id_user]) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End of Nested Accordion for Teams -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
    <!-- Create User Modal -->
    <div class="modal fade" id="createTimPelayanan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tim Pelayanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tim_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_tag">Nama Tim Pelayanan</label>
                            <input type="text" class="form-control" name="nama_tim_pelayanan_h" required>
                        </div>
                        <div class="form-group">
                            <label for="user">Cabang</label>
                            <select class="form-control" name="cabang" required>
                                <option value="0">Pilih Cabang</option>
                                @foreach ($cabangs as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Team Leader</label>
                            <select class="form-control" name="pic" required>
                                <option value="0">Pilih Team Leader</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" id="addVolunteer">Tambah Anggota</button>
                        </div>
                        <div id="additionalVolunteers"></div>

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

    <!-- Create User Modal -->
    <div class="modal fade" id="addMember">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tim Pelayanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tim_store_member') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user">Anggota</label>
                            <input type="hidden" name="id_header" id="id_header">
                            <select class="form-control" id="update_volunteer" name="volunteer" required>
                                <option value="0">Pilih Anggota</option>
                                @foreach ($users as $item)
                                    @if ($item->role == 1 || $item->role == 3)
                                        <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                    @endif
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
    <div class="modal fade" id="updatePIC">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Cabang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tim_update_pic') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_pelayanan_h" id="id_pelayanan_h_pic">
                    <input type="hidden" name="id_user" id="id_user_pic">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_tag">Nama Tim Pelayanan</label>
                            <input type="text" class="form-control" id="update_nama_tim_pelayanan_h" name="nama_tim_pelayanan_h" required>
                        </div>
                        <div class="form-group">
                            <label for="user">Cabang</label>
                            <select class="form-control" id="update_cabang" name="cabang" required>
                                <option value="0">Pilih Cabang</option>
                                @foreach ($cabangs as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Team Leader</label>
                            <select class="form-control" id="update_pic" name="pic" required>
                                <option value="0">Pilih Team Leader</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
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
    <div class="modal fade" id="updateMember">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('tim_update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id_pelayanan_d" id="id_pelayanan_d_member">
                    <input type="hidden" name="id_user" id="id_user_member">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user">Anggota</label>
                            <select class="form-control" id="update_volunteer" name="volunteer" required>
                                <option value="0">Pilih Anggota</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
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
    document.addEventListener('DOMContentLoaded', function() {
    // Persistent accordion state using localStorage
        let activeAccordion = localStorage.getItem('activeAccordion');

        if (activeAccordion) {
            let collapseElement = document.getElementById(activeAccordion);
            let buttonElement = collapseElement.previousElementSibling.querySelector('button');
            buttonElement.setAttribute('aria-expanded', 'true');
            collapseElement.classList.add('show');
        }

        document.querySelectorAll('.accordion .card .collapse').forEach(function(element) {
            element.addEventListener('shown.bs.collapse', function() {
                localStorage.setItem('activeAccordion', this.id);
            });

            element.addEventListener('hidden.bs.collapse', function() {
                localStorage.removeItem('activeAccordion');
            });
        });

        // Edit button functionality placeholder
        // document.querySelectorAll('.buttonEdit').forEach(button => {
        //     button.addEventListener('click', function() {
        //         let id = this.getAttribute('data-id');
        //         // Trigger the modal or do the necessary action, here using alert as a placeholder
        //         alert(`Edit volunteer with ID: ${id}`);
        //     });
        // });
    });

    document.getElementById('addVolunteer').addEventListener('click', function() {
        var container = document.getElementById('additionalVolunteers');
        var volunteerForm = `
            <div class="form-group">
                <label for="user">Anggota</label>
                <select class="form-control" name="user[]" required>
                    <option value="0">Pilih Anggota</option>
                    @foreach ($users as $item)
                        @if ($item->role == 1 || $item->role == 3)
                            <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', volunteerForm);
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
            // console.log(data);
            let id = data[0];
            let id_user = data[1];

            $('#updateMember').find('input[name="id_pelayanan_d"]').val(id);
            $('#updateMember').find('input[name="id_user"]').val(id_user);
            $('#updateMember').find('select[name="volunteer"]').val(id_user);
        });

        $('.buttonEditPic').on('click', function() {
            var id_pelayanan_h = $(this).closest('div').find('input[name="id_pelayanan_h"]').val();
            var id_user = $(this).closest('div').find('input[name="id_user"]').val();
            var nama_tim_pelayanan_h =$(this).closest('div').find('input[name="nama_tim_pelayanan_h"]').val();
            var id_cabang = $(this).closest('div').find('input[name="id_cabang"]').val();
            console.log(id_pelayanan_h);
            console.log(id_user);
            console.log(nama_tim_pelayanan_h);
            console.log(id_cabang);
            $('#updatePIC').find('#id_pelayanan_h_pic').val(id_pelayanan_h);
            $('#updatePIC').find('#id_user_pic').val(id_user);
            $('#updatePIC').find('#update_nama_tim_pelayanan_h').val(nama_tim_pelayanan_h);
            $('#updatePIC').find('#update_cabang').val(id_cabang);
            $('#updatePIC').find('#update_pic').val(id_user);

        });

        $('.buttonAddMember').on('click', function() {
            var id = $(this).attr('data-id');
            $('#addMember').find('#id_header').val(id);
        });
    });

</script>
@endsection


@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Tim Pelayanan</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnCreateTim" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#timPelayananModal">
                        Tambah Tim Baru
                    </button>
                </div>
            </div>

            <div id="accordionCabang" class="accordion">
                @foreach ($cabangs as $cabang)
                    <div class="card mb-2">
                        <div class="card-header" id="headingCabang{{ $cabang->id_cabang }}">
                            <h2 class="mb-0">
                                <button type="button"
                                    class="btn fs-4 fw-bold w-100 text-start"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseCabang-{{ $cabang->id_cabang }}"
                                    aria-expanded="true"
                                    aria-controls="collapseCabang-{{ $cabang->id_cabang }}"
                                >
                                    <i class="fas fa-caret-down mr-2"></i> {{ $cabang->nama_cabang }}
                                </button>
                            </h2>
                        </div>

                        <div id="collapseCabang-{{ $cabang->id_cabang }}"
                            class="card-body collapse"
                            aria-labelledby="headingCabang{{ $cabang->id_cabang }}"
                            data-bs-parent="#accordionCabang"
                        >
                            <div id="accordionTim" class="accordion">
                                <!-- Nested Accordion for Teams -->
                                @foreach ($cabang->tim as $team)  <!-- Assuming each cabang has multiple teams -->
                                    <div class="card mb-2">
                                        <div class="card-header"
                                            id="headingTim{{ $team->id_pelayanan_h }}"
                                        >
                                            <h3 class="mb-0">
                                                <button type="button"
                                                    class="btn fs-4 fw-bold w-100 text-start"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTim-{{ $team->id_pelayanan_h }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapseTim-{{ $team->id_pelayanan_h }}"
                                                >
                                                    <i class="fas fa-caret-down mr-2"></i>
                                                    {{ $team->nama_tim_pelayanan_h }}
                                                </button>
                                            </h3>
                                        </div>

                                        <div id="collapseTim-{{ $team->id_pelayanan_h }}"
                                            class="card-body collapse"
                                            aria-labelledby="headingTim{{ $team->id_pelayanan_h }}"
                                            data-bs-parent="#accordionTim"
                                        >
                                            <div class="mb-2">
                                                <p class="mb-1"><b>Nama Tim:</b> {{ $team->nama_tim_pelayanan_h }}</p>
                                                <p class="mb-1"><b>Cabang:</b> {{ $team->cabang->nama_cabang ?? '-' }}</p>
                                                <p class="mb-2"><b>Team Leader:</b> {{ $team->user->nama_lengkap }}</p>
                                                <input type="hidden" name="id_pelayanan_h" value="{{$team->id_pelayanan_h}}">

                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-danger btnDeleteTeam" data-id="{{ $team->id_pelayanan_h }}" data-nama="{{ $team->nama_tim_pelayanan_h }}" data-bs-toggle="modal" data-bs-target="#deleteTeamModal">Hapus Tim</button>
                                                    
                                                    <button class="btn btn-warning btnEditTeam" data-id="{{ $team->id_pelayanan_h }}" data-bs-toggle="modal" data-bs-target="#timPelayananModal">Update Tim</button>
                                                    <button class="btn btn-success btnAddMember" data-id="{{ $team->id_pelayanan_h }}" data-bs-toggle="modal" data-bs-target="#memberModal">Tambah Anggota</button>
                                                </div>
                                            </div>

                                            <table id="tabelUser{{ $team->id_pelayanan_h }}" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="30%">Nama Anggota</th>
                                                        <th width="20%">Role</th>
                                                        <th width="20%">Status</th>
                                                        <th width="25%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($team->tim_pelayanan_d as $member)
                                                        <tr>
                                                            <input type="hidden" name="id_pelayanan_d" value="{{$member->id_pelayanan_d}}">

                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $member->user->nama_lengkap }}</td>
                                                            <td>
                                                                {{ ($member->user->role == 2) ? 'Team Leader' : (($member->user->role == 3) ? 'Anggota' : '-') }}
                                                            </td>
                                                            <td>
                                                                @if ($member->user->status_user == 1)
                                                                    <span class="badge rounded-pill badge-status-active">Aktif</span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-status-inactive">Tidak Aktif</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <button class="btn btn-warning btnEditMember" data-id="{{ $member->id_pelayanan_d }}" data-bs-toggle="modal" data-bs-target="#memberModal" title="Edit">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </button>
                                                                    <form action="{{ route('tim_pelayanan.member.remove', ['id' => $member->id_pelayanan_d, 'id_user' => $member->id_user]) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger" title="Remove">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End of Nested Accordion for Teams -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tim Pelayanan Modal (Create/Update Team) -->
    <div class="modal fade" id="timPelayananModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="timPelayananModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <form id="timPelayananForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_pelayanan_h" id="id_pelayanan_h_modal">
                    <input type="hidden" name="team_leader_old" id="team_leader_old_modal">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="nama_tim_pelayanan_h">Nama Tim Pelayanan*</label>
                            <input type="text" class="form-control" name="nama_tim_pelayanan_h" id="nama_tim_pelayanan_h_modal" required>
                        </div>

                        <div class="form-group mb-1">
                            <label for="cabang">Cabang*</label>
                            <select class="form-control form-select" name="cabang" id="cabang_modal" required>
                                <option value="" disabled selected>Pilih Cabang</option>
                                @foreach ($cabangs as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="team_leader">Team Leader*</label>
                            <select class="form-control form-select" name="team_leader" id="team_leader_modal" required>
                                <option value="" disabled selected>Pilih Team Leader</option>
                                @foreach ($usersAll as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="createOnlySection">
                            <div class="form-group mb-1">
                                <button type="button" class="btn btn-secondary" id="addVolunteer">Tambah Anggota</button>
                            </div>
                            <div id="additionalVolunteers"></div>
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

    <!-- Member Modal (Add/Update Member) -->
    <div class="modal fade" id="memberModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="memberModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form id="memberForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_header" id="id_header_member_modal"> {{-- For adding new member, this holds id_pelayanan_h --}}
                    <input type="hidden" name="id_pelayanan_d" id="id_pelayanan_d_member_modal"> {{-- For updating existing member --}}
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="volunteer">Anggota*</label>
                            <select class="form-control form-select" id="volunteer_member_selection" name="volunteer" required>
                                <option value="" disabled selected>Pilih Anggota</option>
                                @foreach ($usersWithoutTL as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
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

    <!-- Delete Team Confirmation Modal -->
    <div class="modal fade" id="deleteTeamModal" tabindex="-1" aria-labelledby="deleteTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTeamModalLabel">Konfirmasi Hapus Tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus tim <strong id="teamNameToDelete"></strong>?</p>
                    <p class="text-danger"><small>Peringatan: Tindakan ini tidak dapat dibatalkan. Semua data tim dan anggota akan dihapus secara permanen.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteTeamForm" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Tim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('table[id^="tabelUser"]').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
        // Function to fill team modal fields
        function fillTeamFields(teamObject) {
            console.log(teamObject)
            let modal = $('#timPelayananModal');
            modal.find('#id_pelayanan_h_modal').val(teamObject.id_pelayanan_h);
            modal.find('#nama_tim_pelayanan_h_modal').val(teamObject.nama_tim_pelayanan_h);
            modal.find('#cabang_modal').val(teamObject.id_cabang);
            modal.find('#team_leader_modal').val(teamObject.id_user);
            modal.find('#team_leader_old_modal').val(teamObject.id_user);
        }
        // Function to get team object from nested array
        function getTimPelayananFromArray(teamId) {
            const cabangs = <?php echo json_encode($cabangs); ?>;
            for (let i = 0; i < cabangs.length; i++) {
                const cabang = cabangs[i];
                const team = cabang.tim.find(t => t.id_pelayanan_h == teamId);
                if (team) {
                    return team;
                }
            }
            return null;
        }
        // Handle Create Team button click
        $('#btnCreateTim').on('click', function() {
            $('#timPelayananModalLabel').text('Tambah Tim Pelayanan');
            $('#timPelayananForm').attr('action', '{{ route("tim_pelayanan.store") }}');
            $('#timPelayananForm').find('input[name="_method"]').val('POST');
            $('#timPelayananForm')[0].reset(); // Clear form fields
            $('#timPelayananForm :input').prop('disabled', false); // Enable all inputs
            $('#timPelayananModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#createOnlySection').show(); // Show additional volunteers section for create
            $('#timPelayananModal').modal('show');
        });
        // Existing add volunteer button for create team modal
        document.getElementById('addVolunteer').addEventListener('click', function() {
            var container = document.getElementById('additionalVolunteers');
            // Count current volunteer fields to determine the next number
            var currentCount = container.querySelectorAll('.form-group').length + 1;
            var volunteerForm = `
                <div class="form-group mb-1">
                    <label for="user">Anggota ` + currentCount + `*</label>
                    <select class="form-control form-select" name="user[]" required>
                        <option value="" disabled selected>Pilih Anggota</option>
                        @foreach ($usersWithoutTL as $item)
                            @if ($item->role == 1 || $item->role == 3)
                                <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', volunteerForm);
        });
        // Handle Tim Pelayanan Form submission (for both create and update)
        $('#timPelayananForm').on('submit', function(event) {
            // Only apply this validation for 'create' mode
            if ($('#timPelayananForm').find('input[name="_method"]').val() === 'POST') {
                const additionalVolunteersCount = $('#additionalVolunteers select[name="user[]"]').length;
                if (additionalVolunteersCount === 0) {
                    alert('Please add at least one volunteer to the team.');
                    event.preventDefault(); // Prevent form submission
                }
            }
        });

        // Handle Edit Team button click
        $('.btnEditTeam').on('click', function() {
            $('#timPelayananModalLabel').text('Ubah Tim Pelayanan');
            $('#timPelayananForm').attr('action', '{{ route("tim_pelayanan.tim.update") }}');
            $('#timPelayananForm').find('input[name="_method"]').val('PUT');
            $('#timPelayananForm :input').prop('disabled', false); // Enable all inputs
            $('#timPelayananModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#createOnlySection').hide(); // Hide additional volunteers section for update

            const teamId = $(this).closest('.mb-2').find('input[name="id_pelayanan_h"]').val();
            const teamObject = getTimPelayananFromArray(teamId);
            fillTeamFields(teamObject);

            $('#timPelayananModal').modal('show');
        });


        // Function to fill member modal fields
        function fillMemberFields(memberObject) {
            let modal = $('#memberModal');
            modal.find('#id_header_member_modal').val(memberObject.id_pelayanan_h); // Assuming id_pelayanan_h is the header ID
            modal.find('#id_pelayanan_d_member_modal').val(memberObject.id_pelayanan_d);
            modal.find('#volunteer_member_selection').val(memberObject.id_user);
        }
        // Function to get member object from nested array
        function getMemberFromArray(memberId) {
            const cabangs = <?php echo json_encode($cabangs); ?>;
            for (let i = 0; i < cabangs.length; i++) {
                const cabang = cabangs[i];
                for (let j = 0; j < cabang.tim.length; j++) {
                    const team = cabang.tim[j];
                    const member = team.tim_pelayanan_d.find(m => m.id_pelayanan_d == memberId);
                    if (member) {
                        return member;
                    }
                }
            }
            return null;
        }
        // Handle Add Member button click (within team accordion)
        $('.btnAddMember').on('click', function() {
            var id_header = $(this).data('id');
            $('#memberModal').find('#id_header_member_modal').val(id_header);
            $('#memberModal').find('#id_pelayanan_d_member_modal').val(''); // Clear for new member
            $('#memberModal').find('#volunteer_member_selection').val('').trigger('change'); // Reset and trigger change

            $('#memberModalLabel').text('Tambah Anggota Tim');
            $('#memberForm').attr('action', '{{ route("tim_pelayanan.member.store") }}');
            $('#memberForm').find('input[name="_method"]').val('POST');
            $('#memberForm')[0].reset(); // Clear form fields
            $('#memberForm :input').prop('disabled', false); // Enable all inputs
            $('#memberModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#memberModal').modal('show');
        });

        // Handle Edit Member button click
        $('.btnEditMember').on('click', function() {
            $('#memberModalLabel').text('Ubah Anggota Tim'); // Assuming you want a label for update member modal too
            $('#memberForm').attr('action', '{{ route("tim_pelayanan.member.update") }}');
            $('#memberForm').find('input[name="_method"]').val('PUT');
            $('#memberForm :input').prop('disabled', false); // Enable all inputs
            $('#memberModal .modal-footer button[type="submit"]').show(); // Show submit button

            const memberId = $(this).closest('tr').find('input[name="id_pelayanan_d"]').val();
            const memberObject = getMemberFromArray(memberId);
            fillMemberFields(memberObject);

            $('#memberModal').modal('show');
        });

        // Handle Delete Team button click
        $('.btnDeleteTeam').on('click', function() {
            const teamId = $(this).data('id');
            const teamName = $(this).data('nama');
            
            // Set the team name in the modal
            $('#teamNameToDelete').text(teamName);
            
            // Set the form action
            $('#deleteTeamForm').attr('action', '{{ route("tim_pelayanan.deactivate", "") }}/' + teamId);
        });
    });
</script>
@endsection



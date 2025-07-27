@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Jadwal Pelayanan</h2>
                </div>

                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jadwal.excel.index') }}" class="btn btn-success">
                            Download Excel
                        </a>
                        <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalModal">
                            Tambah Jadwal
                        </button>
                    </div>
                </div>
            </div>

            <h4>Jadwal Aktif</h4>
            <table id="tabelJadwalActive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Cabang</th>
                        <th width="20%">Nama Ibadah</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Stand By</th>
                        <th width="10%">Jam</th>
                        <th width="10%">PIC</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($jadwalActive as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_h" value="{{$item["id_jadwal_h"] }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->cabang->nama_cabang ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->nama_ibadah ?? "-" }}</td>
                            <td> {{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}</td>
                            <td> {{ $item->jadwalIbadah->jam_stand_by ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->jam_mulai ?? "-" }} - {{$item->jadwalIbadah->jam_akhir ?? "-" }}</td>
                            <td> {{ $item->user->nama_lengkap ?? "-" }}</td>

                            <td>
                                <a href="{{ route('jadwal_detail.index', $item['id_jadwal_h']) }}" class="btn btn-primary w-100 mb-2">
                                    Detail
                                </a>

                                <button class="btn btn-warning w-100 mb-2 btnEdit" data-bs-toggle="modal" data-bs-target="#jadwalModal">
                                    Update
                                </button>

                                <form action="{{ route('jadwal.deactivate', $item['id_jadwal_h']) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">Deactivate</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <hr/>
            <h4>Jadwal Tidak Aktif</h4>
            <table id="tabelJadwalInactive" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Cabang</th>
                        <th width="20%">Nama Ibadah</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Stand By</th>
                        <th width="10%">Jam</th>
                        <th width="10%">PIC</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($jadwalInactive as $item)
                        <tr>
                            <input type="hidden" name="id_jadwal_h" value="{{$item["id_jadwal_h"] }}">
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $item->cabang->nama_cabang ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->nama_ibadah ?? "-" }}</td>
                            <td> {{ date('d-m-Y', strtotime($item["tanggal_jadwal"])) }}</td>
                            <td> {{ $item->jadwalIbadah->jam_stand_by ?? "-" }}</td>
                            <td> {{ $item->jadwalIbadah->jam_mulai ?? "-" }} - {{$item->jadwalIbadah->jam_akhir ?? "-" }}</td>
                            <td> {{ $item->user->nama_lengkap ?? "-" }}</td>

                            <td>
                                <a href="{{ route('jadwal_detail.index', $item['id_jadwal_h']) }}" class="btn btn-primary w-100 mb-2">
                                    Detail
                                </a>

                                <form action="{{ route('jadwal.activate', $item['id_jadwal_h']) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Activate</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Jadwal Modal -->
    <div class="modal fade" id="jadwalModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="jadwalModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <form id="jadwalForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_jadwal_h" id="id_jadwal_h">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="tanggal_jadwal">Tanggal Jadwal</label>
                            <input type="text" class="form-control datepicker" id="tanggal_jadwal"  name="tanggal_jadwal" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="id_cabang">Cabang</label>
                            <select class="form-select" name="id_cabang" id="id_cabang" required>
                                <option value="" disabled selected>Pilih Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="id_jadwal_ibadah">Ibadah</label>
                            <select class="form-select" name="id_jadwal_ibadah" id="id_jadwal_ibadah" required>
                                <option value="" disabled selected>Pilih Ibadah</option>
                                @foreach ($jadwalIbadah as $item)
                                    <option value="{{ $item->id_jadwal_ibadah }}">{{ $item->nama_ibadah }}: {{ $item->jam_mulai }} - {{ $item->jam_akhir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="pic_user">PIC</label>
                            <select class="form-select" name="pic_user" id="pic_user" required disabled>
                                <option value="" disabled selected>Pilih PIC</option>
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


@endsection

@section('script')
<script>
    $('#tabelJadwalActive').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $('#tabelJadwalInactive').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    var USERS = @json($user);
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + mm + '-' + yyyy;

    // Set the default value property to today's date
    $('#tanggal_jadwal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    $("#tanggal_jadwal").val(today);
    // $('#tanggal_jadwal').datepicker({
    //     format: 'dd-mm-yyyy',
    //     autoclose: true
    // });

    $(document).ready(function () {
        // Function to fill modal fields
        function fillFields(jadwalObject) {
            let modal = $('#jadwalModal');
            modal.find('#id_jadwal_h').val(jadwalObject.id_jadwal_h);
            
            // Format tanggal_jadwal from YYYY-MM-DD to DD-MM-YYYY for datepicker
            if (jadwalObject.tanggal_jadwal) {
                let dateParts = jadwalObject.tanggal_jadwal.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                modal.find('#tanggal_jadwal').val(formattedDate);
            } else {
                modal.find('#tanggal_jadwal').val('');
            }

            modal.find('#id_cabang').val(jadwalObject.id_cabang);
            modal.find('#id_jadwal_ibadah').val(jadwalObject.id_jadwal_ibadah);
            
            // Manually trigger change to load PICs for the selected Cabang
            modal.find('#id_cabang').trigger('change');
            // Set PIC after options are loaded
            setTimeout(() => {
                modal.find('#pic_user').val(jadwalObject.pic);
            }, 100); // Small delay to ensure options are rendered
        }

        // Function to get jadwal object from array
        function getJadwalFromArray(jadwalId) {
            const jadwalActive = <?php echo json_encode($jadwalActive); ?>;
            const jadwalInactive = <?php echo json_encode($jadwalInactive); ?>;
            
            let jadwal = jadwalActive.find(j => j.id_jadwal_h == jadwalId);
            if (!jadwal) {
                jadwal = jadwalInactive.find(j => j.id_jadwal_h == jadwalId);
            }
            console.log(jadwal);
            return jadwal;
        }

        // Add this new event handler
        $('select[name="id_cabang"]').on('change', function() {
            var cabangId = $(this).val();
            var picUser = $('select[name="pic_user"]');
            
            picUser.prop('disabled', !cabangId);
            picUser.empty();
            picUser.append('<option value="" disabled selected>Pilih PIC</option>');
            
            if (cabangId) {
                $.each(USERS, function(index, item) {
                    if (item.id_cabang == cabangId) {
                        picUser.append(new Option(
                            item.nama_lengkap,
                            item.id
                        ));
                    }
                });
            }
        });
        
        // Handle Create button click
        $('#btnCreate').on('click', function() {
            $('#jadwalModalLabel').text('Tambah Jadwal');
            $('#jadwalForm').attr('action', '{{ route('jadwal.store') }}');
            $('#jadwalForm').find('input[name="_method"]').val('POST');
            $('#jadwalForm')[0].reset(); // Clear form fields
            $('#jadwalForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#jadwalModal').modal('show');

            // Re-enable and clear pic_user dropdown when creating new schedule
            $('#pic_user').prop('disabled', true).empty().append('<option value="" disabled selected>Pilih PIC</option>');
        });

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#jadwalModalLabel').text('Ubah Jadwal');
            $('#jadwalForm').attr('action', '{{ route('jadwal.update') }}');
            $('#jadwalForm').find('input[name="_method"]').val('PUT');
            $('#jadwalForm :input').prop('disabled', false); // Enable all inputs
            $('#jadwalModal .modal-footer button[type="submit"]').show(); // Show submit button

            const jadwalId = $(this).closest('tr').find('input[name="id_jadwal_h"]').val();
            const jadwalObject = getJadwalFromArray(jadwalId);
            fillFields(jadwalObject);

            $('#jadwalModal').modal('show');
        });
    });

</script>
@endsection


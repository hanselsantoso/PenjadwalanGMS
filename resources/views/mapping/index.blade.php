@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <div class="row align-items-center mb-2">
                <div class="col-md-6">
                    <h2>Daftar Mapping User</h2>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mappingModal">
                        Tambah Mapping 
                    </button>
                </div>
            </div>

            <table id="tabelUser" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="10%">No</th>
                    <th width="35%">Nama User</th>
                    <th width="35%">Tags</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($mapping as $item)
                        <tr>
                            <input type="hidden" name="id_user_tag" value="{{$item["id_user_tag"] }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td> {{$item->user->nama_lengkap }}</td>
                            <td> {{$item->tag->nama_tag }}</td>

                            <td>
                                <button class="btn btn-warning w-100 mb-2 btnEdit" data-bs-toggle="modal" data-bs-target="#mappingModal">Update</button>
                                
                                @if ($item->status_user_tag == 1)
                                    <form action="{{ route('mapping.deactivate', $item['id_user_tag']) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Suspend</button>
                                    </form>
                                @else
                                    <form action="{{ route('mapping.activate', $item['id_user_tag']) }}" method="post">
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
    <!-- Mapping Modal -->
    <div class="modal fade" id="mappingModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="mappingModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>

                <form id="mappingForm" method="POST">
                    @csrf
                    @method('POST') {{-- This will be dynamically changed to PUT for updates --}}
                    <input type="hidden" name="id_user_tag" id="id_user_tag">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="id_user">User</label>
                            <select class="form-control form-select" name="id_user" id="id_user" required>
                                <option value="">Pilih User</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="id_tag">Tags</label>
                            <select class="form-control form-select" name="id_tag" id="id_tag" required>
                                <option value="">Pilih Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id_tag }}">{{ $tag->nama_tag }}</option>
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
@endsection

@section('script')
<script>
    $('#tabelUser').DataTable({
        "paging": true,
        "pageLength": 10,
    });

    $(document).ready(function () {
        // Function to fill modal fields
        function fillFields(mappingObject) {
            let modal = $('#mappingModal');
            modal.find('#id_user_tag').val(mappingObject.id_user_tag);
            modal.find('#id_user').val(mappingObject.id_user);
            modal.find('#id_tag').val(mappingObject.id_tag);
        }

        // Function to get mapping object from array
        function getMappingFromArray(mappingId) {
            const mappings = <?php echo json_encode($mapping); ?>;
            const mapping = mappings.find(m => m.id_user_tag == mappingId);
            console.log(mapping);
            return mapping;
        }

        // Handle Create button click
        $('#btnCreate').on('click', function() {
            $('#mappingModalLabel').text('Tambah Mapping');
            $('#mappingForm').attr('action', '{{ route('mapping.store') }}');
            $('#mappingForm').find('input[name="_method"]').val('POST');
            $('#mappingForm')[0].reset(); // Clear form fields
            $('#mappingForm :input').prop('disabled', false); // Enable all inputs
            $('#mappingModal .modal-footer button[type="submit"]').show(); // Show submit button
            $('#mappingModal').modal('show');
        });

        // Handle Edit button click
        $('.btnEdit').on('click', function() {
            $('#mappingModalLabel').text('Ubah Mapping');
            $('#mappingForm').attr('action', '{{ route('mapping.update') }}');
            $('#mappingForm').find('input[name="_method"]').val('PUT');
            $('#mappingForm :input').prop('disabled', false); // Enable all inputs
            $('#mappingModal .modal-footer button[type="submit"]').show(); // Show submit button

            const mappingId = $(this).closest('tr').find('input[name="id_user_tag"]').val();
            const mappingObject = getMappingFromArray(mappingId);
            fillFields(mappingObject);

            $('#mappingModal').modal('show');
        });
    });

</script>
@endsection


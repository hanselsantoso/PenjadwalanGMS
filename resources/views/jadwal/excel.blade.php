@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Download Jadwal Excel') }}</div>

                <div class="card-body">
                    <h4 class="mb-3">{{ __('Download Jadwal Excel File') }}</h4>
                    <form action="{{ route('jadwal.excel.download') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="start_date" class="form-label me-3">From Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label me-3">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_cabang" class="form-label me-3">Cabang:</label>
                            <select class="form-select" name="id_cabang" required>
                                <option value="" disabled selected>Pilih Cabang</option>
                                <option value="0">All Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id_cabang }}">{{ $item->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-download me-1"></i>
                            Download Jadwal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
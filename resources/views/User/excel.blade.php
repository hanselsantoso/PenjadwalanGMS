@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload & Download Users') }}</div>

                <div class="card-body">
                    <h4 class="mb-3">{{ __('Upload User Excel File') }}</h4>
                    <form action="{{ route('user.excel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('Choose Excel File') }}</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('Upload Users') }}</button>
                    </form>

                    <hr class="my-4">

                    <h4 class="mb-3">{{ __('Download User Excel File') }}</h4>
                    <form action="{{ route('user.excel.download') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Download Users') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
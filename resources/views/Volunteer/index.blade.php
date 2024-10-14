@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container row m-auto" >
            Welcome Volunteer <h2>{{ Auth::user()->nama_lengkap }}</h2>
        </div>
    </div>

@endsection
@section('script')
<script>

    $(document).ready(function () {
        $('#jadwalTable').DataTable({
            "pageLength": 5
        });
    });

</script>
@endsection

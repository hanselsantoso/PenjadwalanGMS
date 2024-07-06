@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container row m-auto" >
            @if ($user["status"] == 0)
                <h2>{{$user["name"]}} - <span style="color: red;">SUSPEND</span></h2>

            @else
                <h2>{{$user["name"]}}</h2>
            @endif
            
            <div class="container col-6">
            <div class="header">
                <div class="row">
                <div class="col-8">
                    <h2>Total Simpanan - {{format_idr($user->simpanan["total_simpanan"] ?? 0)}}</h2>
                    <h5>Bunga Simpanan / bulan - {{$info['interestRate']}}%</h5>
                </div>
                </div>
                <br>
            </div>
            <div class="content">
                <table id="tabelSimpan" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($user->simpanan->simpanans ?? [] as $item)
                        <tr>
                            <input type="hidden" id="idSimpanan" value="{{$item["id"]}}">
                            <input type="hidden" id="tanggalSimpanan" value="{{$item->getTanggal($item["tanggal"])}}">
                            <input type="hidden" id="nominalSimpanan" value="{{$item["nominal"]}}">
                            <input type="hidden" id="statusSimpanan" value="{{$item["status"]}}">
                            <td>{{$item->getTanggal($item["tanggal"])}}</td>
                            <td>{{ format_idr($item["nominal"])}}</td>
                            <td>{{$item->getStatusSimpanan($item["status"])}}</td>
                        </tr>
                    @endforeach
                </tbody>
                  </table>
            </div>
            </div>

            <div class="container col-6">
            <div class="header">
                <div class="row">
                <div class="col-8">
                    <h2>Total Pinjaman - {{format_idr($user->countTotalPinjaman())}}</h2>
                    <h5>Maximal Pinjaman - {{$info['aturanPinjam']}}% - {{format_idr($info['jumlahPinjaman'])}}</h5>
                </div>
                </div>
                <br>
            </div>
            <div class="content">
                @foreach ($user->pinjaman ?? [] as $item)
                    <table class="tabelPinjaman table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai Pinjaman</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Total Pinjaman</th>
                                <th>+ {{$info["bungaPinjaman"]}}%</th>
                                <th>Total Terbayar</th>
                                <th>Total Cicilan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>{{ $item->getTanggal($item->tanggal_pinjaman) }}</td>
                                    <td>{{ $item->getTanggal($item->jatuh_tempo) }}</td>
                                    <td>{{ format_idr($item->total_pinjaman) }}</td>
                                    <td>{{ format_idr($item->getTotalPinjamanD()) }}</td>
                                    <td>{{ format_idr($item->getTotalTerbayar()) }}</td>
                                    <td>{{ $item->total_cicilan }}</td>
                                    @if ($item->status_pinjaman_h == 1)
                                        <td>Belum Lunas</td>
                                    @else
                                        <td>Lunas</td>
                                    @endif
                                    <td>
                                        <button data-toggle="modal" class="buttonBayar btn btn-success" onclick="window.location.href='/user/pinjaman/{{$item->id_pinjaman_h}}'">
                                            <span>Detail</span>
                                        </button>
                                    </td>
                                    </td>
                                </tr>



                        </tbody>
                    </table>
                @endforeach

            </div>

            </div>
        </div>


    </div>

@endsection
@section('script')
<script>
    function confirmDelete() {
        if (confirm("Apakah Anda yakin ingin menghapus pinjaman ini?")) {
            document.getElementById('formHapusPinjaman').submit();
        }
    }
    $(document).ready(function () {
        $('#tglSimpanan').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $('#tglPinjaman').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $('#tglBayarPinjaman').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });
        // $( row.child() ).DataTable();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = dd + '-' + mm + '-' + yyyy;

        // Set the default value property to today's date
        $("#tglSimpanan").val(today);
        $('#tglSimpananUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $("#tglPinjaman").val(today);
        $('#tglPinjamanUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        $("#tglBayarPinjaman").val(today);
        $('#tglBayarPinjamanUpdate').datepicker({
            // format: 'yyyy-mm-dd', // You can change the date format
            format: 'dd-mm-yyyy', // You can change the date format
            autoclose: true
        });

        var table = $('#tabelSimpan').DataTable({
            "paging": true,
            "pageLength": 10,
        });

        $('.tabelPinjaman').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
        $('.buttonEdit').on('click', function() {
            var row = $(this).closest('tr');
            var data = row.find('input[type="hidden"]').map(function() {
                return $(this).val();
            }).get();
            console.log(data);

            let id = data[0];
            let tgl = data[1];
            let nominal = data[2];
            let status = data[3];
            $('#idSimpananUpdate').val(id)
            $("#tglSimpananUpdate").datepicker("setDate", tgl);
            // console.log(id)
            $('#nominalSimpananUpdate').val(nominal)

            $('#statusSimpananUpdate').val(status).change();
        });

        $('#btnCreatePinjaman').on('click', function() {
            var nominalPinjaman = parseInt($('#txtNominalPinjaman').val());
            var maximalPinjam = parseInt("{{$info['jumlahPinjaman']}}");
            var totalTerbayar = parseInt("{{$user->countAllPinjamanTerbayar()}}");
            var totalPinjaman = parseInt("{{$user->countTotalPinjaman()}}");
            console.log(nominalPinjaman);
            console.log(maximalPinjam);
            console.log(totalTerbayar);
            console.log(totalPinjaman);
            var maxTerbayar = 0.8 * totalPinjaman; // 80% of total_pinjaman

            if (nominalPinjaman + totalPinjaman > maximalPinjam) {
                alert("Nominal pinjaman melebihi batas maksimal pinjaman");
                return false;
            }

            if (totalTerbayar > maxTerbayar) {
                alert("Total terbayar melebihi 80% dari total pinjaman");
                return false;
            }
        });
    });

</script>
@endsection

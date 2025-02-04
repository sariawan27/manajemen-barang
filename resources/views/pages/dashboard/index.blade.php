@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- page section -->

        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5" style="cursor: pointer;" onclick="return location.href=`{{route('pengajuan.index')}}`">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon mb-2" style="background-color: #435ebe;">
                                    <i class="bi-book-half"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Riwayat Pengajuan</h6>
                                <h6 class="font-extrabold mb-0">Info lebih lanjut <i class="bi-arrow-right-circle-fill"></i></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5" style="cursor: pointer;" onclick="return location.href=`{{route('barang.index')}}`">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon mb-2" style="background-color: #435ebe;">
                                    <i class="bi-box-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Informasi Barang</h6>
                                <h6 class="font-extrabold mb-0">Info lebih lanjut <i class="bi-arrow-right-circle-fill"></i></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5" style="cursor: pointer;" onclick="return location.href=`{{route('kamar.index')}}`">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon mb-2" style="background-color: #435ebe;">
                                    <i class="bi-door-closed-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Informasi Kamar</h6>
                                <h6 class="font-extrabold mb-0">Info lebih lanjut <i class="bi-arrow-right-circle-fill"></i></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Pengajuan Barang</h4>
                    </div>
                    <div class="card-body">
                        <div id="wkwk"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page section -->
    </section>
</div>

<!-- Need: Apexcharts -->
<script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script>
    var optionsPengajuan = {
        annotations: {
            position: "back",
        },
        dataLabels: {
            enabled: false,
        },
        chart: {
            type: "bar",
            height: 300,
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {},
        series: [
            {
            name: "sales",
            data: JSON.parse("{{$pengajuanGraf}}"),
            },
        ],
        colors: "#435ebe",
        xaxis: {
            categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
            ],
        },
    }

    var chartPengajuan = new ApexCharts(
        document.querySelector("#wkwk"),
        optionsPengajuan
    )

    chartPengajuan.render()
</script>
@endsection

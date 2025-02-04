@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Pengajuan</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- page section -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Daftar Pengajuan
                        </h5>
                    </div>
                    <div class="card-body">
                        @if (session()->get('users')['level']=='taruni')
                            <div class="row">
                                <div class="col-2">
                                    <a class="btn btn-primary" href="{{route('pengajuan.create')}}" >Tambah Pengajuan</a>
                                </div>
                            </div>
                        @endif
                            <table id="exampleServerSide"
                                class="table table-striped table-bordered table-hover text-center barang-table"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Kode Pengajuan</th>
                                        <th>status</th>
                                        {{-- <th>Note</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end page section -->
    </section>
</div>

<script src="{{asset('assets/compiled/js/jquery-3.7.1.js')}}"></script>
<script src="{{asset('assets/compiled/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/compiled/js/dataTables.js')}}"></script>
<script>

        $(function() {

            var table = $('.barang-table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                columnDefs: [{
                        "className": "dt-center",
                        "targets": "_all"
                    },

                ],
                ajax: "{{ route('pengajuan.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        render: function(data, type, row, meta) {
                            return moment(row.created_at).format('DD-MM-YYYY  HH:mm:ss');
                        }
                    },
                    {
                        data: 'kd_pengajuan',
                        name: 'kd_pengajuan'
                    },
                    {
                        render: function(data, type, row, meta) {
                            if (row.status=='waiting') {
                                return '<i class="bi bi-clock bi-middle"></i>';
                            } else if (row.status=='approved') {
                                return '<i class="bi bi-check bi-middle"></i>';
                            } else {
                                return '<i class="bi bi-check-all bi-middle"></i>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection

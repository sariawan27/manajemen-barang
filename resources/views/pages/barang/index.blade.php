@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Barang</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- page section -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Daftar Barang
                        </h5>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <a class="btn btn-primary" href="{{route('barang.create')}}" >Tambah Barang</a>
                                </div>
                            </div>
                            <table id="exampleServerSide"
                                class="table table-striped table-bordered table-hover text-center barang-table"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
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
                ajax: "{{ route('barang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        render: function(data, type, row, meta) {
                            return row.stok+" "+row.satuan;
                        }
                    },
                    {
                        data: 'description',
                        name: 'description'
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

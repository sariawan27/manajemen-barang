@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Users</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- page section -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Form Edit Barang
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="form" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nama-barang-column">Nama Barang</label>
                                        <input type="text" id="nama-barang-column" class="form-control"
                                            placeholder="Nama Barang" name="nama_barang" value="{{$data->nama_barang}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="deskripsi-column">Deskripsi</label>
                                        <input type="text" id="deskripsi-column" class="form-control"
                                            placeholder="Deskripsi" name="description" value="{{$data->description}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="stok-column">Stok</label>
                                        <input type="number" id="stok-column" class="form-control"
                                            placeholder="Stok" name="stok" value="{{$data->stok}}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="satuan-column">Satuan</label>
                                        <input type="text" id="satuan-column" class="form-control"
                                            placeholder="Satuan" name="satuan" value="{{$data->satuan}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="max-quantity-column">Max. Quantity</label>
                                        <input type="number" id="max-quantity-column" class="form-control"
                                            placeholder="Max. Quantity" name="max_quantity" value="{{$data->max_quantity}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{route('barang.index')}}"
                                                class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end page section -->
    </section>
</div>

<div id="alertnya" style="position: absolute; right: 0; top: 30px;">
</div>

<script src="{{asset('assets/compiled/js/jquery-3.7.1.js')}}"></script>
<script>
    $(document).ready(function(){

        if ('{{$data->level=="taruni"}}') {
            $('#data_taruni').show()
        } else {
            $('#data_taruni').hide()
        }

        $('#rolenya').change(function(){
            if ($('#rolenya').val() == 'taruni') {
                $('#data_taruni').show()
            } else {
                $('#data_taruni').hide()
            }
        })

        $('form').submit(function(e){
            e.preventDefault()

            $.ajax({
                    type: "PUT",
                    url: "{{ route('barang.update', explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[3]) }}",
                    data: $("form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        console.log("sukses cuk")
                        //peringatan ketika data yg diinputkan tidak sesuai
                        $('#alertnya').css({
                            display: 'block',
                            opacity: '100%'
                        });
                        $('#alertnya').html(`
                            <div class="alert alert-success alert-dismissible show fade">
                                <i class="bi bi-check-circle"></i> Data berhasil disimpan.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `)
                        window.setTimeout(function() {
                            $("#alertnya").fadeTo(1000, 0).slideUp(1000, function(){
                                $(this).html(``);
                            });

                            // location.reload();
                        }, 2300);

                    },
                    error: function(jqXHR, exception) {
                        if (jqXHR.status === 422) {
                            //peringatan ketika data yg diinputkan tidak sesuai
                            errorMessage = jqXHR.responseJSON;
                            html = ''
                            html += `
                                <div class="alert alert-warning alert-dismissible show fade">
                                    Warning
                                    <ul>`
                            for (const property in errorMessage) {
                                errMessage = errorMessage[property];

                                for (const element of errMessage) {
                                    html += '<li>' + element + '</li>'
                                }
                            }
                            html += `</ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`

                                $('#alertnya').css({
                                    display: 'block',
                                    opacity: '100%'
                                });
                            $('#alertnya').html(html)

                            window.setTimeout(function() {
                                $("#alertnya").fadeTo(1000, 0).slideUp(1000, function(){
                                    $(this).html(``);
                                });
                            }, 2300);
                        } else {
                            //peringatan ketika data yg diinputkan tidak sesuai
                            $('#alertnya').html(`
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <i class="bi bi-exclamation-circle"></i> Gagal mengupdate data.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `)
                            window.setTimeout(function() {
                                $("#alertnya").fadeTo(1000, 0).slideUp(1000, function(){
                                    $(this).html(``);
                                });
                            }, 2300);
                        }
                    }

                })
        })
    })
</script>
@endsection

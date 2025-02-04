@extends('layouts.master')

@section('content')
<div class="page-heading">
    <h3>Kamar</h3>
</div>
<div class="page-content">
    <section class="row">
        <!-- page section -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Form Tambah Kamar
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="form" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nama-kamar-column">Nama Kamar</label>
                                        <input type="text" id="nama-kamar-column" class="form-control"
                                            placeholder="Nama Kamar" name="nama_kamar">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="deskripsi-column">Deskripsi</label>
                                        <input type="text" id="deskripsi-column" class="form-control"
                                            placeholder="Deskripsi" name="deskripsi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{route('kamar.index')}}"
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
                    type: "POST",
                    url: "{{ route('kamar.store') }}",
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
                                    <i class="bi bi-exclamation-circle"></i> Gagal menyimpan data.
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

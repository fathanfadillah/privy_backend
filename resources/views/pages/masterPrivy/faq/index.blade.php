@extends('layouts.app')
@section('style')
<script src="https://cdn.tiny.cloud/1/potgiirlij5syajyscd16e0mtn5iqa6r0gbtybul6t0zhgok/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-dollar mr-2"></i>
                        List {{ $title }}
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card no-b">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <th width="30">No</th>
                                    <!-- <th>Kode</th> -->
                                    <!-- <th>Retribusi</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jenis Bayar</th>
                                    <th>Status</th>
                                    <th>Pedagang</th> -->
                                    <th>Kategori</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <!-- <th>Foto</th> -->
                                    <!-- <th>Jenis Bayar</th>
                                    <th>Status</th>
                                    <th>Pedagang</th> -->
                                    <th width="60"></th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="alert"></div>
                <div class="card no-b">
                    <div class="card-body">
                        <form class="needs-validation" id="form" method="POST" enctype="multipart/form-data" novalidate>
                            {{ method_field('POST') }}
                            <input type="hidden" id="id" name="id" />
                            <h4 id="formTitle">Tambah Data</h4>
                            <hr>
                            <div class="form-row form-inline">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="kategori" class="col-form-label s-12 col-md-4">Kategori</label>
                                        {{-- <input type="text" name="kategori" id="kategori" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" required /> --}}
                                            <select id="kategori" name="kategori" class="form-control form-control-sm">
                                                <option value="Top Asked Question">Top Asked Question</option>
                                                <option value="Enterprise">Enterprise</option>
                                                <option value="General">General</option>
                                              </select>
                                        </div>
                                    <div class="form-group m-0">
                                        <label for="question" class="col-form-label s-12 col-md-4">Question</label>
                                        <input type="text" name="question" id="question" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="answer" class="col-form-label s-12 col-md-4">Answer</label>
                                        <textarea name="answer" id="answer" cols="30" rows="10" required></textarea>
                                        {{-- <input type="text" name="answer" id="answer" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" required /> --}}
                                    </div>

                                    <!-- <div class="form-group m-0">
                                        <label for="alamat_pedagang" class="col-form-label s-12 col-md-4">Alamat</label>
                                        <textarea name="alamat_pedagang" id="alamat_pedagang" placeholder="" class="form-control r-0 light s-12 col-md-8" autocomplete="off" required></textarea>
                                    </div> -->
                                    <div class="mt-2" style="margin-left: 34%">
                                        <button type="submit" class="btn btn-primary btn-sm" id="action"><i
                                                class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></button>
                                        <a class="btn btn-sm" onclick="add()" id="reset">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

tinymce.init({
height: 450,
width: '66%',
selector: 'textarea',
plugins: [
'advlist autolink link image lists charmap preview hr anchor pagebreak',
'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
'emoticons template paste'
],
toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | fullscreen',

menubar: 'file edit view format tools',
content_css: 'css/content.css',
language: 'id'
});

var table = $('#dataTable').dataTable({
   "language": { 
        "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
        "sProcessing":   "Sedang memproses...",
        "sLengthMenu":   "Tampilkan _MENU_ entri",
        "sZeroRecords":  "Tidak ditemukan data yang sesuai",
        "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix":  "",
        "sSearch":       "Cari:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext":     "Selanjutnya",
            "sLast":     "Terakhir",
        }
    },
    processing: true,
    serverSide: true,
    pageLength: 15,
    order: [1, 'asc'],
    ajax: {
        url: "{{ route($route.'api') }}",
        method: 'POST'
    },
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: true,
            searchable: true,
            align: 'center',
            className: 'text-center'
        },
        {
            data: 'kategori',
            name: 'kategori'
        },
        {
            data: 'question',
            name: 'question'
        },
        // {data: 'no_telp', name: 'no_telp'},
        {
            data: 'answer',
            name: 'answer'
        },
        {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true,
            className: 'text-center'
        }
    ]
});

(function() {
    'use strict';
    $('.input-file').each(function() {
        var $input = $(this),
            $label = $input.next('.js-labelFile'),
            labelVal = $label.html();

        $input.on('change', function(element) {
            var fileName = '';
            if (element.target.value) fileName = element.target.value.split('\\').pop();
            fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label
                .removeClass('has-file').html(labelVal);
        });
    });
})();


function add() {
    save_method = "add";
    $('#form').trigger('reset');
    $('#formTitle').html('Tambah Data');
    $('input[name=_method]').val('POST');
    $('#txtAction').html('');
    $('#preview').attr({
        'src': '-',
        'alt': ''
    });
    $('#result').attr({
        'src': '-',
        'alt': ''
    });
    $('#changeText').html('Browse Image');
    $('#reset').show();
    // $('#reset').focus();
}
add();
$('#form').on('submit', function(e) {
    if ($(this)[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        $('#alert').html('');
        url = (save_method == 'add') ? "{{ route($route.'store') }}" : "{{ route($route.'update', ':id') }}"
            .replace(':id', $('#id').val());
        $.ajax({
            url: url,
            type: (save_method == 'add') ? 'POST' : 'POST',
            data: new FormData(($(this)[0])),
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#alert').html(
                    "<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " +
                    data.message + "</div>");
                table.api().ajax.reload();
                add();
            },
            error: function(data) {
                err = '';
                respon = data.responseJSON;
                if (respon.errors) {
                    $.each(respon.errors, function(index, value) {
                        err = err + "<li>" + value + "</li>";
                    });
                }
                $('#alert').html(
                    "<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " +
                    respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }
        });
        return false;
    }
    $(this).addClass('was-validated');
});

function edit(id) {
    save_method = 'edit';
    var id = id;
    $('#alert').html('');
    $('#form').trigger('reset');
    $('#formTitle').html(
        "Edit Data <a href='#' onclick='add()' class='btn btn-outline-danger btn-xs pull-right ml-2'>Batal</a>");
    $('#txtAction').html(" Perubahan");
    $('#reset').hide();
    $('#result').attr({
        'src': '-',
        'alt': ''
    });
    $('input[name=_method]').val('PATCH');
    $.get("{{ route($route.'edit', ':id') }}".replace(':id', id), function(data) {
        $('#id').val(data.id);
        $('#kategori').val(data.kategori);
        $('#question').val(data.question);
        // $('#answer').val(data.answer);
        tinymce.activeEditor.setContent(data.answer);
        tinymce.activeEditor.getContent(data.answer);
        
    }, "JSON").fail(function() {
        reload();
    });

}

function remove(id) {
    $.confirm({
        title: '',
        content: 'Apakah Anda yakin akan menghapus data ini ?',
        icon: 'icon icon-question amber-text',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        buttons: {
            ok: {
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function() {
                    $.post("{{ route($route.'destroy', ':id') }}".replace(':id', id), {
                        '_method': 'DELETE'
                    }, function(data) {
                        table.api().ajax.reload();
                        if (id == $('#id').val()) add();
                    }, "JSON").fail(function() {
                        reload();
                    });
                }
            },
            cancel: function() {}
        }
    });
}
</script>
@endsection
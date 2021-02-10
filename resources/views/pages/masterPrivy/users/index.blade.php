@extends('layouts.app')
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
        <div class="row justify-content-center">
            <div class="col-md-7">
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
                                    <th>Nama</th>
                                    <th width="30">Status Login</th>
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
            <div id="tambah_data" class="col-md-4">
                <div id="alert"></div><!-- error massage -->
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
                                        <label for="nama" class="col-form-label s-12 col-md-4">Nama</label>
                                        <input type="text" name="name" id="name" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off"/>
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="status_login" class="col-form-label s-12 col-md-4">Status Login</label>
                                        <!-- <input type="text" name="status_login" id="status_login" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" required /> -->
                                            <label for="" class="col-form-label"><i class='h5 text-danger icon-remove'></i></label>
                                            <input class="w-25 text-success" type="range" id="status_login" name="status_login" min="0" max="1">
                                            <label for="" class="col-form-label"><i class='h5 text-success icon-check'></i></label>
                                            
                                    </div>
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
$('#tambah_data').hide();


var table = $('#dataTable').dataTable({
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
            orderable: false,
            searchable: false,
            align: 'center',
            className: 'text-center'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'kolom_status',
            name: 'kolom_status'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
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

// ketika klik batal
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
    $('#tambah_data').hide();
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
                    add();
            }
        });
        return false;
    }
    $(this).addClass('was-validated');
});

function edit(id) {
    save_method = 'edit';
    var id = id;
    $('#tambah_data').show();
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
        $('#name').val(data.name);
        $('#name').attr('readonly', true);
        $('#status_login').val(data.status_login);
        $('#action').show();
    }, "JSON").fail(function() {
        reload();
    });

}
</script>
@endsection
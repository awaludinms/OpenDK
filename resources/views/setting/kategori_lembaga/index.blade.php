@extends('layouts.dashboard_template')

@section('content')
<section class="content-header">
    <h1>
        {{ $page_title ?? 'Page Title' }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="{{ route('setting.lembaga.index') }}">Daftar Lembaga</a></li>
        <li class="active">{{ $page_title }}</li>
    </ol>
</section>

<section class="content container-fluid">
    <style>
        th.padat,
        td.padat {
            width: 1%;
            white-space: nowrap;
            text-align: center;
        }
    </style>
    @include('partials.flash_message')

    <div class="box box-info">
        <div class="box-header with-border">
            <div class="control-group">
                <a href="{{ route('setting.kategori_lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-plus"></i> Tambah</button>
                </a>
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="hapus btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data" disabled><i class="fa fa-trash"></i> Hapus</button>
                </a>
                <a href="{{ route('setting.lembaga.index') }}">
                    <button type="button"
                        class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-arrow-circle-o-left"></i> Kembali ke Daftar Lembaga</button>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-lembaga">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall"></th>
                            <th>No</th>
                            <th style="max-width: 100px;">Aksi</th>
                            <th>Kategori Lembaga</th>
                            <th>Deskripsi Lembaga</th>
                            <th>Jumlah Lembaga</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@include('partials.asset_datatables')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var data = $('#data-lembaga').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('setting.kategori_lembaga.index') !!}",
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                pageLength: 10,
                columns: [
                    {
                        data: 'checklist',
                        class: 'padat',
                        orderable: false,
                        render: function (data, type, row, meta) {
                            return '<input type="checkbox" class="chlist" name="check[]" value="' + row.id + '">'
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false

                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        class: 'text-center',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'kategori_lembaga',
                        name: 'kategori_Lembaga'
                    },
                    {
                        data: 'deskripsi_kategori_lembaga',
                        name: 'deskripsi_kategori_lembaga'
                    },
                    {
                        data: 'jumlah_lembaga',
                        render: function (data, type, row, meta) {

                            $.ajax({
                                url: "{{ url('setting/kategori_lembaga') }}/" + row.id,
                                success: function (response) {
                                    $('#jumlah_lembaga-' + row.id).html(response.jumlah_lembaga)
                                }
                            })


                            return '<span id="jumlah_lembaga-' + row.id + '">Loading...</span>'
                        }

                    },

                ],
                order: [
                    [2, 'asc']
                ]
            });

            $(document).on('click', '#checkall', function(){
                chlist = $('.chlist')

                $.each(chlist, function(k,v){
                    $(v).prop('checked', $('#checkall').prop('checked'))
                })
            })

            $(document).on('click', '.chlist', function(){
                chlist = $('.chlist')

                $('.hapus').prop('disabled', true)

                $.each(chlist, function(k,v){
                    if($(v).prop('checked')) {
                        $('.hapus').prop('disabled', false)
                    }
                })
            })
        });
    </script>
    @include('forms.datatable-vertical')
    @include('forms.delete-modal')
@endpush
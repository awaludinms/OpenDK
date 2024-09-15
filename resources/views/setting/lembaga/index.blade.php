@extends('layouts.dashboard_template')

@section('content')
<section class="content-header">
    <h1>
        {{ $page_title ?? 'Page Title' }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{ $page_title }}</li>
    </ol>
</section>

<section class="content container-fluid">
    <style>
        hr.batas {
            border-top: 1px solid #f4f4f4;
            margin: 10px -10px;
        }
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
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-plus"></i> Tambah</button>
                </a>
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-trash"></i> Hapus</button>
                </a>
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-print"></i> Cetak</button>
                </a>
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-download"></i> Unduh</button>
                </a>
                <a href="{{ route('setting.kategori_lembaga.index') }}">
                    <button type="button"
                        class="btn btn-social bg-orange btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-list"></i> Kategori</button>
                </a>
                <a href="{{ route('setting.lembaga.create') }}">
                    <button type="button"
                        class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                        title="Tambah Data"><i class="fa fa-recycle"></i> Bersihkan</button>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control" name="is_active">
                        <option value="1">Aktif</option>
                        <option value="0">Tifak Aktif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="das_kategori_lembaga_id" id="das_kategori_lembaga_id"
                        class="form-control das_kategori_lembaga_id"></select>
                </div>
            </div>
            <hr class="batas">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-lembaga">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall"></th>
                            <th>No</th>
                            <th style="max-width: 100px;">Aksi</th>
                            <th>Kode Lembaga</th>
                            <th>Nama Lembaga</th>
                            <th>Ketua Lembaga</th>
                            <th>Kategori Lembaga</th>
                            <th>Jumlah Anggota Lembaga</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@include('partials.asset_datatables')
@include('partials.asset_select2')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var data = $('#data-lembaga').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('setting.lembaga.index') !!}",
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
                        data: 'kode_lembaga',
                        name: 'kode_Lembaga'
                    },
                    {
                        data: 'nama_lembaga',
                        name: 'nama_Lembaga'
                    },
                    {
                        data: 'penduduk.nama',
                        name: 'penduduk.nama'
                    },
                    {
                        data: 'kategori_lembaga.kategori_lembaga',
                        name: 'kategori_lembaga.kategori_lembaga',
                    },
                    {
                        data: 'jumlah_anggota_lembaga',
                        name: 'jumlah_anggota_Lembaga'
                    },

                ],
                order: [
                    [1, 'asc']
                ]
            });

            function formatKategori(kategori) {
                if (!kategori.id) {
                    return kategori.text;
                }
                var baseUrl = "/user/pages/images/flags";
                var spl = kategori.text.split('--')
                var nama_kategori = spl[0]
                var deskripsi = spl[1]
                var $kategori = $(
                    '<div><strong>' + nama_kategori + '</strong></div>' +
                    '<div><i>' + deskripsi + '</i></div>'
                );
                return $kategori;
            };

            $('.das_kategori_lembaga_id').select2({
                templateResult: formatKategori,
                ajax: {
                    url: "{{ route('setting.lembaga.select_kategori_lembaga') }}",
                    dataType: 'json'
                },
                placeholder: " -- Silakan Masukkan Kategori Lembaga --",
                // minimumInputLength: 3,
            })

        });
    </script>
    @include('forms.datatable-vertical')
    @include('forms.delete-modal')
@endpush
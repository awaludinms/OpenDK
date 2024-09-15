@extends('layouts.dashboard_template')

@section('content')
<section class="content-header">
    <h1>
        {{ $page_title ?? 'Page Title' }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="{{ route('setting.lembaga.index') }}">Pengelolaan Lembaga</a></li>
        <li class="active">{{ $page_title }}</li>
    </ol>
</section>

<section class="content container-fluid">
    <style>
        .form-horizontal .control-label {
            text-align: left !important;
        }

        img.lembaga {
            width: auto;
            max-height: 250px;
            max-width: 200px;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
            padding: 2px;
            border: 2px solid #d2d6de;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            @include('partials.flash_message')

            {!! Form::model($lembaga, ['route' => ['setting.lembaga.update', $lembaga->id ], 'method' => 'post', 'id' => 'form-lembaga', 'class' => 'form-horizontal form-label-left']) !!}
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada yang salah dengan inputan Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-body">
                            <img src="{{ asset('img/logo.png') }}" class="lembaga" id="file-preview">
                            <!-- <input type="file" class="form-control" style="margin-top:20px;" id="file-lembaga"> -->
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="file_path" name="foto">
                                <input type="file" class="hidden" id="file" name="foto" accept=".gif,.jpg,.jpeg,.png">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" id="file_browser"><i
                                            class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <a href="{{ route('setting.lembaga.index') }}"
                                class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i
                                    class="fa fa-arrow-circle-o-left"></i> Kembali ke Daftar
                                Lembaga</a>
                        </div>
                        <div class="box-body">


                            @include('setting.lembaga.form')



                        </div>
                        <div class="box-footer">
                            @include('partials.button_reset_submit_v2')

                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    </div>
</section>
@endsection
@include('partials.asset_select2')
@push('scripts')
    <script>
        $(function () {
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

            function formatKetuaLembaga(ketua) {
                if (!ketua.id) {
                    return ketua.text;
                }
                var baseUrl = "/user/pages/images/flags";
                var spl = ketua.text.split('--')
                var nama = spl[0]
                var nik = spl[1]
                var $ketua = $(
                    '<div>' + nama + '</div>' +
                    '<div>NIK: <strong>' + nik + '</strong></div>'
                );
                return $ketua;
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
            $('.penduduk_id').select2({
                templateResult: formatKetuaLembaga,
                ajax: {
                    url: "{{ route('setting.lembaga.select_ketua_lembaga') }}",
                    dataType: 'json'
                },
                placeholder: " -- Silakan Masukkan NIK / Nama --",
                // minimumInputLength: 3,
            })


            const input = document.getElementById('file');
            const previewPhoto = () => {
                const file = input.files;
                if (file) {
                    const fileReader = new FileReader();
                    const preview = document.getElementById('file-preview');
                    fileReader.onload = function (event) {
                        preview.setAttribute('src', event.target.result);
                    }
                    fileReader.readAsDataURL(file[0]);
                }
            }
            input.addEventListener("change", previewPhoto);

            $('#file_browser').on('click', function () {
                $('#file').click()

                $('#file_path').val($('#file').val())
            })
        })

    </script>
@endpush
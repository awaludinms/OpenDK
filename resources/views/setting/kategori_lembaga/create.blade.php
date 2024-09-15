@extends('layouts.dashboard_template')

@section('content')
<section class="content-header">
    <h1>
        {{ $page_title ?? 'Page Title' }}
        <small>{{ $page_description ?? '' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="{{ route('setting.lembaga.index') }}">Lembaga</a></li>
        <li><a href="{{ route('setting.kategori_lembaga.index') }}">Kategori Lembaga</a></li>
        <li class="active">{{ $page_description }}</li>
    </ol>
</section>

<section class="content container-fluid">
    <style>
        .form-horizontal .control-label {
            text-align: left !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            @include('partials.flash_message')

            {!! Form::open(['route' => 'setting.kategori_lembaga.store', 'method' => 'post', 'id' => 'form-lembaga', 'class' => 'form-horizontal form-label-left']) !!}
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

                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <a href="{{ route('setting.kategori_lembaga.index') }}"
                                class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i
                                    class="fa fa-arrow-circle-o-left"></i> Kembali ke Daftar
                                Kategori Lembaga</a>
                        </div>
                        <div class="box-body">


                            @include('setting.kategori_lembaga.form')



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
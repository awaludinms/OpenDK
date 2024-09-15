<div class="form-group">
    <label for="inputNamaLembaga3" class="col-sm-3 control-label">Nama Lembaga</label>
    <div class="col-sm-8">
        <!-- <input type="text" class="form-control" id="inputNamaLembaga3" placeholder="Nama Lembaga"> -->
        {!! Form::text('nama_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'nama_lembaga']) !!}
    </div>
</div>
<div class="form-group">
    <label for="inputKodeLembaga3" class="col-sm-3 control-label">Kode Lembaga</label>
    <div class="col-sm-8">
        <!-- <input type="text" class="form-control" id="inputKodeLembaga3" placeholder="Kode Lembaga"> -->
        {!! Form::text('kode_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'kode_lembaga']) !!}
    </div>
</div>
<div class="form-group">
    <label for="inputNoSKPendirianLembaga3" class="col-sm-3 control-label">Nomor SK Pendirian Lembaga</label>
    <div class="col-sm-8">
        <!-- <input type="text" class="form-control" id="inputNoSKPendirianLembaga3" placeholder="Nomor SK Pendirian Lembaga"> -->
        {!! Form::text('nomor_sk_pendirian_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'nomor_sk_pendirian_lembaga']) !!}
    </div>
</div>
<div class="form-group">
    <label for="das_kategori_lembaga_id" class="col-sm-3 control-label">Kategori Lembaga</label>
    <div class="col-sm-8">
        <select name="das_kategori_lembaga_id" id="das_kategori_lembaga_id" class="form-control das_kategori_lembaga_id">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="penduduk_id" class="col-sm-3 control-label">Ketua Lembaga</label>
    <div class="col-sm-8">
        <select name="penduduk_id" id="penduduk_id" class="form-control penduduk_id">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="inputDeskripsi" class="col-sm-3 control-label">Deskripsi Lembaga</label>
    <div class="col-sm-8">
        <!-- <textarea class="form-control" id="inputDeskripsi" placeholder="Deskripsi Lembaga"></textarea> -->
        {!! Form::textarea('deskripsi_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'deskripsi_lembaga']) !!}

    </div>
</div>
    
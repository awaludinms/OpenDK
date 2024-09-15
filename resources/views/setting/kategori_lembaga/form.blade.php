<div class="form-group">
    <label for="inputKategoriLembaga3" class="col-sm-3 control-label">Klasifikasi/Kategori Lembaga</label>
    <div class="col-md-8 col-sm-6 col-xs-12">
        <!-- <input name="kategori_lembaga" type="text" class="form-control" id="inputKategoriLembaga3" placeholder="Klasifikasi/Kategori Lembaga"> -->
        {!! Form::text('kategori_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'kategori_lembaga']) !!}
    </div>
</div>
<div class="form-group">
    <label for="inputDeskrpsiKategoriLembaga3" class="col-sm-3 control-label">Deskripsi Lembaga</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
        <!-- <textarea name="deskripsi_lembaga" class="form-control" id="inputDeskrpsiKategoriLembaga3" placeholder="Deskripsi Lembaga"></textarea> -->
        {!! Form::textarea('deskripsi_kategori_lembaga', null, ['class' => 'form-control', 'required' => true, 'id' => 'deskripsi_kategori_lembaga']) !!}
    </div>
</div>
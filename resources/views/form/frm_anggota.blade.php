@extends('template')

@section('judul')
Form Anggota
@stop

@section('content')
<form id="frmAnggota" class="form-horizontal" action="{{ url('anggota/save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="fFoto col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Foto</h3>
                </div>
                <div class="box-body">
                    @if($anggota['foto'])
                        <img id="avatar" src="{{ asset('img/'.$anggota['foto']) }}" style="width:100%;border: 2px solid #ccc;">
                    @else
                        <img id="avatar" src="{{ asset('img/no-image.png') }}" style="width:100%;border: 2px solid #ccc;">
                    @endif
                    <input id="file" type="file" name="foto" style="display: none">
                    <input type="hidden" name="old_foto" value="{{ $anggota['foto'] }}">
                </div>
            </div>
        </div>
        <div class="fForm col-md-8">
            <div class="box">
                <!-- Bidodata Anggota -->
                <div class="box-header with-border">
                    <h3 class="box-title">Data Anggota</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="nama" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="kd_anggota" value="{{ $anggota['kd_anggota'] }}">
                            <input type="text" class="form-control" id="nama" placeholder="Nama Anggota" name="nama" value="{{ $anggota['nama'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lahir" class="col-sm-2 control-label">Tempat Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="tempat" placeholder="Tempat Lahir" name="tempat" value="{{ $anggota['tempat'] }}">
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>          
                                <input id="datepicker" type="text" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" value="{{ $anggota['tgl_lahir'] }}">
                            </div>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jk" value="{{ $anggota['jk'] }}">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option {{ $anggota['jk']==1 ? 'selected' : '' }} value="1">Laki-Laki</option>
                                <option {{ $anggota['jk']==2 ? 'selected' : '' }} value="2">Perempuan</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Alamat" name="alamat">{{ $anggota['alamat'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kota" class="col-sm-2 control-label">Kota</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kota" placeholder="Kota" name="kota" value="{{ $anggota['kota'] }}">
                        </div>
                    </div>                        
                    <div class="form-group">
                        <label for="telp" class="col-sm-2 control-label">Telepon</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" placeholder="Telepon" name="telp" value="{{ $anggota['telp'] }}"">
                            </div> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $anggota['user_email'] }}">
                            </div> 
                        </div>
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">SAVE</button>
                </div>                   
            </div>
        </div>       
    </div>
</form>
@stop
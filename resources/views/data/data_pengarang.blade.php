@extends('template')

@section('judul')
Data Pengarang
@stop

@section('content')

<div class="box">
    <div class="box-header">
    <a href="{{ url('pengarang/add') }}"><button type="button" class="btn bg-green btn-flat margin">Add New</button></a>
    </div>
    <div class="box-body">
        <table id="data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Pengarang</th>
                    <th>Lahir</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Menampilkan Data Anggota -->
                @foreach($pengarang as $rsPenga)
                <tr>
                    <td>{{ $rsPenga['kd_pengarang'] }}</td>
                    <td>{{ $rsPenga['nama_pengarang'] }}</td>                    
                    <td>{{ $rsPenga['tempat']." , ".$rsPenga['tgl_lahir'] }}</td>
                    <td>{{ $rsPenga['alamat']." ".$rsPenga['kota'] }}</td>
                    <td>{{ $rsPenga['email'] }}</td>
                    <td>
                        <a href="{{ url('pengarang/edit',$rsPenga['kd_pengarang']) }}"><button type="button" class="btn bg-yellow btn-flat"><i class="fa fa-pencil"></i></button></a>
                        <a href="{{ url('pengarang/delete',$rsPenga['kd_pengarang']) }}"><button type="button" class="btn bg-red btn-flat"><i class="fa fa-trash"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
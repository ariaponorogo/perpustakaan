@extends('template')

@section('judul')
Daftar Anggota
@stop
@section('ac-ang')
active
@stop
@section('content')

<div class="box">
    <div class="box-header">
    <a href="{{url('anggota/add')}}"><button type="button" class="btn bg-green btn-flat margin">Add New</button></a>
    </div>
    <div class="box-body">
        <table id="DT" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No anggota</th>
                    <th>Nama Anggota</th>
                    <th>Lahir</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <!--tampil data-->
            @foreach($anggota as $row)
                <tr>
                    <td>{{ $row ['kd_anggota'] }}</td>
                    <td>{{ $row['no_anggota'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row ['tempat'].", ".$row['tgl_lahir'] }}</td>
                    <td>{{ $row['alamat'].", ".$row['kota'] }}</td>
                    <td>{{ $row['user_email'] }}</td>
                    <td>
                        <a href="{{ url('anggota/edit',$row['kd_anggota']) }}"><button type="button" class="btn bg-yellow btn-flat"><i class="fa fa-pencil"></i></button></a>
                        <a  href="anggota/delete/{{$row->kd_anggota}}"><button type="button" class="btn bg-red btn-flat"><i class="fa fa-trash"></i></button></a>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
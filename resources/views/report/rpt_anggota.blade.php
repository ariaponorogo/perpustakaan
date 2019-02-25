<style>
table { position: relative; border-collapse:collapse; width: 100%; }
table td { border:1px solid #000; padding: 5px; }
h1,h2,p { margin: 0; text-align: center;}
p { padding-bottom: 15px; margin-bottom: 15px; border-bottom: 8px double #000; }
.title { background: #ccc; }
</style>

<h1>PEPRUSTAKAAN UMUM</h1>
<h2>PERPUS KOTA MADIUN</h2>
<p>Jl Jenderal Soederman 40 Madiun, Telp : (0351) 456789 , www.perpuskota.com, perpus@perpuskota.com</p>

<table>
    <tr class="title">
        <td width="3%">#</td>
        <td width="10%">No Anggota</td>
        <td width="30%">Nama</td>
        <td width="30%">Alamat</td>
        <td width="27%">Email</td>
    </tr>
    @foreach($anggota as $rsAngg)
    <tr>
        <td>{{ $rsAngg->kd_anggota }}</td>
        <td>{{ $rsAngg->no_anggota }}</td>
        <td>{{ $rsAngg->nama }}</td>
        <td>{{ $rsAngg->alamat." ".$rsAngg->kota }}</td>
        <td>{{ $rsAngg->user_email }}</td>
    </tr>    
    @endforeach
</table>

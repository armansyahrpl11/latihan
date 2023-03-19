<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan</title>
  <style>
    img{
      height: 100px;;
    }

    hr.solid {
    border-top: 2px solid #3B82F6;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="title text-center mb-5">
      <h2>Laporan Masyarakat Desa Ciherang Pondok</h2>
    </div>
    <hr class="solid">

    <div>
      <h6>Laporan Masyarakat Desa Ciherang Pondok</h6>
      {{-- <h6>{{ $pengaduan->created_at->format('l, d F Y') }}</h6> --}}
    </div>
    <hr class="solid">
{{--
    <div class="mt-3 mb-3">
      <h6>Nama : {{ $pengaduan->name }}</h6>
      <h6>NIK : {{ $pengaduan->user_nik }}</h6>
      <h6>No. Telepon : {{ $pengaduan->user->phone }}</h6>
    </div> --}}

</div>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Kejadian</th>
            <th>Nama Pelapor</th>
            <th>Isi Laporan</th>
            <th>Tanggapan</th>
            <th>Tanggal Tanggapan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penga as $k => $v)
        <tr>
            <td>{{ $k += 1 }}</td>
            <td>{{ $v->pengaduan->tgl_pengaduan}}</td>
            <td>{{ $v->pengaduan->user->name}}</td>
            <td>{{ $v->pengaduan->description }}</td>
            <td>{{ $v->tanggapan }} oleh {{ $v->user->name }} </td>
            <td>{{ $v->created_at }}</td>
            {{-- <td>{{ $v->created_at->format('d/m/Y')}}</td> --}}
            <td>{{ $v->pengaduan->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>

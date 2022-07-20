<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ 'laporan_' . $title }}</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 2px solid #000;
      padding: 5px;
    }

    table thead th {
      text-transform: uppercase;
    }

    h1 {
      font-size: 1.2rem;
      text-align: center;
      text-transform: capitalize;
    }

    h2 {
      font-size: 0.8rem;
      text-transform: capitalize;
    }
  </style>
</head>

<body>
  <h1>data calon mahasiswa</h1>
  <table>
    <thead>
      <th>prodi</th>
      <th>total</th>
      <th>unggah berkas</th>
      <th>verifikasi berkas</th>
      <th>membayar regist</th>
      <th>registrasi ulang</th>
      <th>memiliki nim</th>
    </thead>
    <tbody>
      @foreach ($data_calon_mahasiswa as $loopItem)
      <tr>
        <td>{{ $loopItem['prodi'] }}</td>
        <td>{{ $loopItem['total_daftar'] }}</td>
        <td>{{ $loopItem['unggah_berkas'] }}</td>
        <td>{{ $loopItem['verifikasi_berkas'] }}</td>
        <td>{{ $loopItem['membayar_regist'] }}</td>
        <td>{{ $loopItem['registrasi_ulang'] }}</td>
        <td>{{ $loopItem['memiliki_nim'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h2>tanggal: {{ now() }}</h2>
</body>

</html>
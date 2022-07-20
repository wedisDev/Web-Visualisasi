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
  <h1>data sebaran calon mahasiswa</h1>
  <table>
    <thead>
      <tr>
        <th>prodi</th>
        <th>total daftar</th>
        <th>laki-laki</th>
        <th>perempuan</th>
        <th>total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data_sebaran_calon_mahasiswa as $loopItem)
      <tr>
        <td>{{ $loopItem['prodi'] }}</td>
        <td>{{ $loopItem['total_daftar'] }}</td>
        <td>{{ $loopItem['laki_laki'] }}</td>
        <td>{{ $loopItem['perempuan'] }}</td>
        <td>{{ $loopItem['total'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h2>tanggal: {{ now() }}</h2>
</body>

</html>
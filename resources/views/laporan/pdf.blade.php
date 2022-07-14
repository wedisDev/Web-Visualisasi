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

    h1,
    h2 {
      text-align: center;
      text-transform: capitalize;
    }

    h1 {
      font-size: 1.2rem;
    }
  </style>
</head>

<body>
  <h1>data calon mahasiswa</h1>
  {{-- unggah berkas (sudah) --}}
  <h2>unggah berkas (sudah)</h2>
  <table>
    <thead>
      <tr>
        <th>No Online</th>
        <th>No Test</th>
        <th>Nama</th>
        <th>Path Bayar</th>
        <th>Path Kartu</th>
        <th>Path Hasil</th>
        <th>Path Rapor</th>
        <th>Path Foto</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($unggah_berkas['sudah'] as $loopItem)
      <tr>
        <td>{{ $loopItem->no_online }}</td>
        <td>{{ $loopItem->no_test ?? '-' }}</td>
        <td>{{ $loopItem->nama_mhs }}</td>
        <td>
          <img src="{{ $loopItem->path_bayar }}" alt="{{ $loopItem->nama_mhs }}" width="100" height="100">
        </td>
        <td>
          <img src="{{ $loopItem->path_kartu }}" alt="{{ $loopItem->nama_mhs }}" width="100" height="100">
        </td>
        <td>
          <img src="{{ $loopItem->path_hasil }}" alt="{{ $loopItem->nama_mhs }}" width="100" height="100">
        </td>
        <td>
          <img src="{{ $loopItem->path_rapor }}" alt="{{ $loopItem->nama_mhs }}" width="100" height="100">
        </td>
        <td>
          <img src="{{ $loopItem->path_foto }}" alt="{{ $loopItem->nama_mhs }}" width="100" height="100">
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- unggah berkas (sudah) --}}

  {{-- unggah berkas (belum) --}}
  <h2>unggah berkas (belum)</h2>
  <table>
    <thead>
      <tr>
        <th>No Online</th>
        <th>No Test</th>
        <th>Nama</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($unggah_berkas['belum'] as $loopItem)
      <tr>
        <td>{{ $loopItem->no_online }}</td>
        <td>{{ $loopItem->no_test ?? '-' }}</td>
        <td>{{ $loopItem->nama_mhs }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- unggah berkas (belum) --}}
</body>

</html>
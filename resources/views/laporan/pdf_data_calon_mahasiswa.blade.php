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
  <div><img src='assets/images/kopz.png' style='width:100%'></div>
  <h1>data calon mahasiswa</h1>
  <table>
    <thead style='font-size: 0.75em'>
      <th>prodi</th>
      <th>total</th>
      <th>unggah berkas</th>
      <th>verifikasi berkas</th>
      <th>membayar regist</th>
      <th>registrasi ulang</th>
      <th>memiliki nim</th>
    </thead>
    <tbody>
      @php
        $fakultas = '';
      @endphp

      @foreach ($data_calon_mahasiswa as $loopItem)

      @foreach ($data_prodi as $prodi)
        @if($prodi['nama_prodi'] == $loopItem['prodi'])
          @if($fakultas != $prodi['fakultas'])
            @php
              $fakultas = $prodi['fakultas']
            @endphp
            <tr>
              <td colspan='7'><b>{{ $fakultas }}</b></td>
            </tr>
          @endif
        @endif
      @endforeach

      <tr>
        <td>{{ $loopItem['prodi'] }}</td>
        <td style='text-align: center'>{{ $loopItem['total_daftar'] }}</td>
        <td style='text-align: center'>{{ $loopItem['unggah_berkas'] }}</td>
        <td style='text-align: center'>{{ $loopItem['verifikasi_berkas'] }}</td>
        <td style='text-align: center'>{{ $loopItem['membayar_regist'] }}</td>
        <td style='text-align: center'>{{ $loopItem['registrasi_ulang'] }}</td>
        <td style='text-align: center'>{{ $loopItem['memiliki_nim'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h2>tanggal: {{ now() }}</h2>

  <div style='width: 25%; margin-left: 30.95em;'>
      <table style='text-align: center; border: hidden'>
        <tr style='border: hidden'>
            <td style='border: hidden'>Kepala Bagian Penmaru</td>
        </tr>
        <tr style='border: hidden'>
            <td style='border: hidden'>
              <div style='margin-top: 4em'></div>
            </td>
        </tr>
        <tr style='border: hidden'>
            <td style='border: hidden'>_______________________</td>
        </tr>
      </table>
  <div>

</body>

</html>
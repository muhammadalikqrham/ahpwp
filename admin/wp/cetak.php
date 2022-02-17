<?php include_once '../conf/function.php' ?>
<?php
$ph_tanah = [];
$teksturTanah = [];
$usia = [];
$batang = [];
$daun = [];
$vaktor = [];
$sumVaktor = 0;
$V = [];

$bobot = query("SELECT * FROM tb_alternatif");
$bobotAlt = query("SELECT * FROM tb_bobotkriteria");
$jml = count($bobot);
// var_dump($bobot);
// echo $jml;
foreach ($bobot as $row) {
  // var_dump($row);
  // tinggi
  if ($row['ph_tanah'] >= 5 && $row['ph_tanah'] <= 6) {
    array_push($ph_tanah, 2);
  } elseif ($row['ph_tanah'] >= 6 && $row['ph_tanah'] < 7) {
    array_push($ph_tanah, 3);
  } elseif ($row['ph_tanah'] >= 7 && $row['ph_tanah'] <= 7.8) {
    array_push($ph_tanah, 4);
  }
  // usia
  if ($row['usia'] >= 4 && $row['usia'] <= 7) {
    array_push($usia, 1);
  } elseif ($row['usia'] > 7 && $row['usia'] <= 11) {
    array_push($usia, 2);
  } elseif ($row['usia'] > 11 && $row['usia'] <= 14) {
    array_push($usia, 3);
  } elseif ($row['usia'] > 14) {
    array_push($usia, 4);
  }
  // Daun

  // echo $row['Tekstur_tanah'] . ' ';
  // exit;
  if ($row['Tekstur_tanah'] == 'lempung') {
    array_push($teksturTanah, 3);
  } elseif ($row['Tekstur_tanah'] == 'gembur') {
    array_push($teksturTanah, 4);
  }
  // cabang
  if ($row['daun'] == 'Pangkal Daun Bulat') {
    array_push($daun, 2);
  } elseif ($row['daun'] == 'Oval') {
    array_push($daun, 3);
  } elseif ($row['daun'] == 'Hijau Segar') {
    array_push($daun, 4);
  }
  // batang
  if ($row['batang'] == 'Ujung membengkok kebawah') {
    array_push($batang, 2);
  } elseif ($row['batang'] == 'Bulat') {
    array_push($batang, 3);
  } elseif ($row['batang'] == 'Lurus') {
    array_push($batang, 4);
  }
}
// var_dump($batang);
// exit;
for ($i = 0; $i < $jml; $i++) {
  $vaktor[$i] = pow($ph_tanah[$i], (float)$bobotAlt[0]['nilai_bobot']) * pow($teksturTanah[$i], (float)$bobotAlt[1]['nilai_bobot']) * pow($usia[$i], (float)$bobotAlt[2]['nilai_bobot']) * pow($batang[$i], (float)$bobotAlt[3]['nilai_bobot']) * pow($daun[$i], (float)$bobotAlt[4]['nilai_bobot']);
  $sumVaktor = $sumVaktor + $vaktor[$i];
}


// Nilai Vaktor
$i = 0;
for ($i = 0; $i < $jml; $i++) {
  $countPref = $vaktor[$i] / $sumVaktor;
  array_push($V, $countPref);
}
// var_dump($V);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style type="text/css" media="print">
    @page {
      size: landscape;
    }
  </style>
</head>

<body>
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Alternatif</th>
        <th>Ph Tanah</th>
        <th>Tekstur Tanah</th>
        <th>Usia</th>
        <th>Batang</th>
        <th>Daun</th>
        <th>Nilai Preferensi(V)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 0;
      foreach ($bobot as $row) :
      ?>
        <tr>
          <td><?= $no + 1 ?></td>
          <td><?= $row['nama_alternatif'] ?></td>
          <td><?= $row['ph_tanah'] ?></td>
          <td><?= $row['Tekstur_tanah'] ?></td>
          <td><?= $row['usia'], ' Bulan' ?></td>
          <td><?= $row['batang'] ?></td>
          <td><?= $row['daun'] ?></td>
          <td><?= number_format($V[$no++], 4)  ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    window.print();
  </script>
</body>

</html>
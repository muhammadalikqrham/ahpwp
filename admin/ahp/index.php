<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php

// $bobot = query("SELECT * FROM tb_alternatif");
if (isset($_POST['simpan'])) {
  if (tambahPerbandingan($_POST) > 0) {
    echo "
    <script>
      alert('Berhasil');
    </script>";
  } else {
    echo "
    <script>
      alert('gagal');
    </script>";
  }
}
if (isset($_POST["uploadBobot"])) {
  if (ubahBobot($_POST['bobot'])) {
    echo "
    <script>
      alert('Berhasil');
    </script>";
  } else {
    echo "
    <script>
      alert('gagal');
    </script>";
  }
}
if (isset($_POST["ulang"])) {
  if (ulang()) {
    echo "
    <script>
      alert('Berhasil');
    </script>";
  } else {
    echo "
    <script>
      alert('gagal');
    </script>";
  }
}
$query = query("SELECT * FROM tb_perbandingan");
// var_dump($query);
// exit;
$jumlahNormalisasiKriteria = 0;
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Proses AHP</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Proses</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <!-- /.card -->
        <!-- <a href="http://localhost/sawahp/admin/alternatif/add_alternatif.php" class="btn btn-secondary"><i class="fas fa-plus mr-3"></i>Tambah Alternatif</a> -->
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Table Perbandingan Kriteria</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post">
              <?php if (empty($query)) : ?>
                <button class="btn btn-primary" name="simpan">Kirim Ke Database</button>
              <?php else : ?>
                <button class="btn btn-danger mb-3" name="ulang" onclick="return confirm('Anda yakin ? Karna Data Sebelumnya akan dihapus seluruhnya ?')">Lakukan Perbandingan Ulang</button>
              <?php endif; ?>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Ph Tanah</th>
                    <th>Tekstur Tanah</th>
                    <th>Usia</th>
                    <th>Batang</th>
                    <th>Daun</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($query)) : ?>
                    <?php $x = 1;
                    $total = [0, 0, 0, 0, 0] ?>
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                      <tr>
                        <th>
                          <?php if ($i == 0) : ?>
                            Ph Tanah
                            <?php $total[$i] = (float)$total[$i] + (float)$query[$i]['nilai'] + (float)$query[$i + 5]['nilai'] + (float)$query[$i + 10]['nilai'] + (float)$query[$i + 15]['nilai'] + (float)$query[$i + 20]['nilai'] ?>
                          <?php elseif ($i == 1) : ?>
                            Tekstur Tanah
                            <?php $total[$i] = (float)$total[$i] + (float)$query[$i]['nilai'] + (float)$query[$i + 5]['nilai'] + (float)$query[$i + 10]['nilai'] + (float)$query[$i + 15]['nilai'] + (float)$query[$i + 20]['nilai'] ?>
                          <?php elseif ($i == 2) : ?>
                            Usia
                            <?php $total[$i] = (float)$total[$i] + (float)$query[$i]['nilai'] + (float)$query[$i + 5]['nilai'] + (float)$query[$i + 10]['nilai'] + (float)$query[$i + 15]['nilai'] + (float)$query[$i + 20]['nilai'] ?>
                          <?php elseif ($i == 3) : ?>
                            Batang
                            <?php $total[$i] = (float)$total[$i] + (float)$query[$i]['nilai'] + (float)$query[$i + 5]['nilai'] + (float)$query[$i + 10]['nilai'] + (float)$query[$i + 15]['nilai'] + (float)$query[$i + 20]['nilai'] ?>
                          <?php elseif ($i == 4) : ?>
                            hama
                            <?php $total[$i] = (float)$total[$i] + (float)$query[$i]['nilai'] + (float)$query[$i + 5]['nilai'] + (float)$query[$i + 10]['nilai'] + (float)$query[$i + 15]['nilai'] + (float)$query[$i + 20]['nilai'] ?>
                          <?php endif; ?>
                          <?php for ($j = 0; $j < 5; $j++) : ?>
                        </th>
                        <td><input name="score[]" type="text" id="text<?= $x ?>" class="form-control" value="<?= $query[$x - 1]['nilai'] ?>" readonly></td>
                      <?php $x++;
                          endfor; ?>
                      </tr>
                    <?php endfor; ?>
                    <tr>
                      <th>Total</th>
                      <td><input type="text" id="text26" class="form-control" value="<?= $total[0] ?>" readonly></td>
                      <td><input type="text" id="text27" class="form-control" value="<?= $total[1] ?>" readonly></td>
                      <td><input type="text" id="text28" class="form-control" value="<?= $total[2] ?>" readonly></td>
                      <td><input type="text" id="text29" class="form-control" value="<?= $total[3] ?>" readonly></td>
                      <td><input type="text" id="text30" class="form-control" value="<?= $total[4] ?>" readonly></td>
                    </tr>
                </tbody>
              </table>
              <div class="card-header">
                <div class="card-title text-bold">Melakukan Normalisasi</div>
              </div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Ph Tanah</th>
                    <th>Tekstur Tanah</th>
                    <th>Usia</th>
                    <th>Batang</th>
                    <th>Daun</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $x = 1; ?>
                  <?php $z = 0; ?>
                  <?php $y = 0; ?>
                  <?php for ($i = 0; $i < 5; $i++) :
                      $jumlah = 0;
                  ?>
                    <tr>
                      <th>
                        <?php if ($i == 0) : ?>
                          Ph Tanah
                        <?php elseif ($i == 1) : ?>
                          Tekstur Tanah
                        <?php elseif ($i == 2) : ?>
                          Usia
                        <?php elseif ($i == 3) : ?>
                          Batang
                        <?php elseif ($i == 4) : ?>
                          Daun
                        <?php endif; ?>
                        <!-- normalisasi -->
                        <?php for ($j = 0; $j < 5; $j++) : ?>
                      </th>
                      <td><input name="score[]" type="text" id="norm<?= $z++ ?>" class="form-control" value="<?= (float)$query[$x - 1]['nilai'] / (float)$total[$j] ?>" readonly></td>
                    <?php
                          // total kanan
                          $jumlah = (float)$jumlah + ((float)$query[$x - 1]['nilai'] / (float)$total[$j]);
                          $x++;
                        endfor;
                        // sampai sini
                        $y++;
                        //habis itu disimpan disni
                        $total2[$i] = $jumlah;
                    ?>
                    <td><input type="text" class="form-control" id="total<?= $i ?>" value="<?= $total2[$i] ?>" readonly></td>
                    </tr>
                  <?php
                    endfor; ?>
                  <tr>
                    <th>Total</th>
                    <td><input type="text" class="form-control" id="total20" readonly></td>
                    <td><input type="text" class="form-control" id="total21" readonly></td>
                    <td><input type="text" class="form-control" id="total22" readonly></td>
                    <td><input type="text" class="form-control" id="total23" readonly></td>
                    <td><input type="text" class="form-control" id="total24" readonly></td>
                    <td><input type="text" class="form-control" id="sum" value="<?= $total2[0] + $total2[1] + $total2[2] + $total2[3] + $total2[4] ?>" readonly></td>
                  </tr>
                </tbody>
              </table>
              <div class="card-header">
                <div class="card-title text-bold">Table Bobot</div>
              </div>
              <table id="bobot" width="40%" class="table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i = 0; $i < 5; $i++) :
                  ?>
                    <tr>
                      <th>
                        <?php if ($i == 0) : ?>
                          Ph Tanah
                        <?php elseif ($i == 1) : ?>
                          Tekstur Tanah
                        <?php elseif ($i == 2) : ?>
                          Usia
                        <?php elseif ($i == 3) : ?>
                          Batang
                        <?php elseif ($i == 4) : ?>
                          Daun
                        <?php endif; ?>
                      </th>
                      <td><input name="bobot[]" type="text" id="bobot<?= $i ?>" class="form-control" readonly></td>
                    </tr>
                  <?php endfor; ?>
                </tbody>
              </table>
              <div class="card-header">
                <div class="card-title text-bold text-center">Menghitung Eign Maksimum</div>
              </div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Ph Tanah</th>
                    <th>Tekstur Tanah</th>
                    <th>Usia</th>
                    <th>Batang</th>
                    <th>Daun</th>
                    <th>Jumlah</th>
                    <th>lambda</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $x = 1; ?>
                  <!-- Dari sini -->
                  <?php for ($i = 0; $i < 5; $i++) :
                      $jumlah = 0;
                  ?>
                    <tr>
                      <th>
                        <?php if ($i == 0) : ?>
                          Ph Tanah
                        <?php elseif ($i == 1) : ?>
                          Tekstur Tanah
                        <?php elseif ($i == 2) : ?>
                          Usia
                        <?php elseif ($i == 3) : ?>
                          Batang
                        <?php elseif ($i == 4) : ?>
                          hama
                        <?php endif; ?>
                        <?php for ($j = 0; $j < 5; $j++) : ?>
                      </th>
                      <td><input name="score[]" type="text" id="eign<?= $x - 1 ?>" class="form-control" value="<?= $query[$x - 1]['nilai'] ?>" readonly></td>

                    <?php
                          $x++;
                        endfor;
                    ?>
                    <td><input type="text" name="jumlahEign[]" id="jumlahEign<?= $i ?>" class="form-control" readonly></td>
                    <td><input type="text" name="lambda[]" id="lambda<?= $i ?>" class="form-control" readonly></td>
                    </tr>
                  <?php
                    endfor; ?>
                  <!-- sampai sini -->
                  <tr>
                    <td colspan="7"></td>
                    <td><input type="text" name="sumLambda[]" id="sumLambda" class="form-control" readonly></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                    <td class="text-bold text-white" style="background-color: purple;">Lambda Max</td>
                    <td class="text-bold text-white" style="background-color: purple;" id="lambdaMax">asd</td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                    <td class="text-bold bg-warning">Consistency Index (CI)</td>
                    <td class="text-bold bg-warning" id="ci"></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                    <td class="text-bold bg-success">CR</td>
                    <td class="text-bold bg-success" id="cr"></td>
                  </tr>
                </tbody>
              </table>
              <div class="card-footer">
                <!-- <form action="" method="post"> -->
                <!-- <input type="hidden" name="bobotUpload[]" id="upload0">
                  <input type="hidden" name="bobotUpload[]" id="upload1">
                  <input type="hidden" name="bobotUpload[]" id="upload2">
                  <input type="hidden" name="bobotUpload[]" id="upload3">
                  <input type="hidden" name="bobotUpload[]" id="upload4"> -->
                <button class="btn btn-success" type="submit" name="uploadBobot">SIMPAN BOBOT KE DATABASE</button>
                <!-- </form> -->
              </div>
            <?php else : ?>
              <tr>
                <th>Ph Tanah</th>
                <td><input name="score[]" type="text" id="text1" class="form-control" value="1" readonly></td>
                <td><input name="score[]" type="text" id="text2" class="form-control"></td>
                <td><input name="score[]" type="text" id="text3" class="form-control"></td>
                <td><input name="score[]" type="text" id="text4" class="form-control"></td>
                <td><input name="score[]" type="text" id="text5" class="form-control"></td>
              </tr>
              <tr>
                <th>Tekstur Tanah</th>
                <td><input name="score[]" type="text" id="text6" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text7" class="form-control" value="1" readonly></td>
                <td><input name="score[]" type="text" id="text8" class="form-control"></td>
                <td><input name="score[]" type="text" id="text9" class="form-control"></td>
                <td><input name="score[]" type="text" id="text10" class="form-control"></td>
              </tr>
              <tr>
                <th>Usia</th>
                <td><input name="score[]" type="text" id="text11" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text12" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text13" class="form-control" value="1" readonly></td>
                <td><input name="score[]" type="text" id="text14" class="form-control"></td>
                <td><input name="score[]" type="text" id="text15" class="form-control"></td>
              </tr>
              <tr>
                <th>Batang</th>
                <td><input name="score[]" type="text" id="text16" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text17" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text18" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text19" class="form-control" value="1" readonly></td>
                <td><input name="score[]" type="text" id="text20" class="form-control"></td>
              </tr>
              <tr>
                <th>Hama</th>
                <td><input name="score[]" type="text" id="text21" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text22" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text23" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text24" class="form-control" readonly></td>
                <td><input name="score[]" type="text" id="text25" class="form-control" value="1" readonly></td>
              </tr>
            <?php endif; ?>
            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card -->
      <?php include_once '../template/footer.php' ?>
<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php

$id = $_GET['id'];

$data = query('SELECT * FROM tb_alternatif WHERE id_alternatif = ' . $id);


if (isset($_POST['submit'])) {

  if (ubahAlternatif($_POST) > 0) {

    echo  "
          <script>
            alert('Data Berhasil Diubah!');
            document.location.href = 'http://localhost/ahpwp/admin/alternatif'
          </script>";
  } else {
    echo 'Data gagal diubah';
  }
}

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Alternatif</h1>
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
        <h3 class="card-title">Title</h3>

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
        <div class="card">
          <div class="card-header" style="background-color: #c9a677;">
            <h3 class="card-title">Input Alternatif</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="bibit">Bibit</label>
                <input type="text" class="form-control" id="bibit" autocomplete="off" name="nama_bibit" value="<?= $data[0]['nama_alternatif'] ?>">
                <input type="hidden" class="form-control" id="bibit" autocomplete="off" name="id" value="<?= $data[0]['id_alternatif'] ?>">
              </div>
              <div class="form-group">
                <label for="ph_tanah">Ph Tanah</label>
                <input type="text" name="ph_tanah" class="form-control" id="ph_tanah" value="<?= $data[0]['ph_tanah'] ?>">
                <span class="text-monospace text-danger"> Input Ph Tanah hanya bisa dari 5.00 sampai 7.00 </span>
              </div>
              <div class="form-group">
                <label for="tekstur_tanah">Tekstur Tanah</label>
                <select name="tekstur_tanah" id="cabang" class="form-control">
                  <option value="lempung" <?= $data[0]['Tekstur_tanah'] == 'Lempung' ? 'selected' : ''; ?>>Lempung</option>
                  <option value="gembur" <?= $data[0]['Tekstur_tanah'] == 'Gembur' ? 'selected' : ''; ?>>Gembur</option>
                </select>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="usia">Usia (Bulan)</label>
                  <input type="text" name="usia" class="form-control" id="usia" value="<?= $data[0]['usia'] ?>">
                  <span class="text-monospace text-danger"> jika bilangan decimal gunakan titik (.) </span>
                </div>
                <label for="batang">Batang</label>
                <select name="batang" id="batang" class="form-control">
                  <option value="Ujung membengkok kebawah" <?= $data[0]['batang'] == '  Ujung membengkok kebawah' ? 'selected' : ''; ?>>Ujung Membengkok Ke bawah</option>
                  <option value="Bulat" <?= $data[0]['batang'] == 'Bulat' ? 'selected' : ''; ?>>Bulat</option>
                  <option value="Lurus  " <?= $data[0]['batang'] == 'Lurus  ' ? 'selected' : ''; ?>>Lurus </option>
                </select>
              </div>
              <div class="form-group">
                <label for="daun">daun</label>
                <select name="daun" id="daun" class="form-control">
                  <option value="Pangkal Daun Bulat" <?= $data[0]['daun'] == 'Pangkal Daun Bulat' ? 'selected' : ''; ?>>Pangkal Daun Bulat</option>
                  <option value="Oval" <?= $data[0]['daun'] == 'Oval' ? 'selected' : ''; ?>>Oval</option>
                  <option value="Hijau Segar" <?= $data[0]['daun'] == 'Hijau Segar' ? 'selected' : ''; ?>>Hijau Segar</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn" name="submit" style="background-color: #c9a677;">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card-body -->
      <!-- <div class="card-footer">
    Footer
  </div> -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <script>
      function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
          textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
              this.oldValue = this.value;
              this.oldSelectionStart = this.selectionStart;
              this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
              this.value = this.oldValue;
              this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
              this.value = "";
            }
          });
        });
      }

      setInputFilter(document.getElementById("ph_tanah"), function(value) {
        return /^-?\d*[.,]?\d*$/.test(value) && (value === "" || parseFloat(value) <= 7.00) && (value === "" || parseFloat(value) >= 5);
      });
    </script>
    <?php include_once '../template/footer.php' ?>
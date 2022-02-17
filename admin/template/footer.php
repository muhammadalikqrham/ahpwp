</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "bSort": true,
      "buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  $(function() {
    $("#ahp").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "bSort": false,
      "buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  $('document').ready(function() {
    let total1 = 0;
    let total2 = 0;
    let total3 = 0;
    let total4 = 0;
    let total5 = 0;
    //penentuan perbandingan
    $('#text2').on('change', function() {
      console.log('oke');
      let x = $('#text2').val();
      x = (1 / x);
      $('#text6').val(x);
      total1 = parseFloat(x);
      $('#text26').val(total1);
    })
    $('#text3').on('change', function() {
      console.log('oke');
      let x = $('#text3').val();
      x = (1 / x);
      $('#text11').val(x);
      total1 = parseFloat(total1) + parseFloat(x);
      $('#text26').val(total1);
    })
    $('#text4').on('change', function() {
      console.log('oke');
      let x = $('#text4').val();
      x = (1 / x);
      $('#text16').val(x);
      total1 = parseFloat(total1) + parseFloat(x);
      $('#text26').val(total1);
    })
    $('#text5').on('change', function() {
      console.log('oke');
      let x = $('#text5').val();
      x = (1 / x);
      $('#text21').val(x);
      total1 = parseFloat(total1) + parseFloat(x);
      $('#text26').val(total1);
    })
    $('#text8').on('change', function() {
      console.log('oke');
      let x = $('#text8').val();
      x = (1 / x);
      $('#text12').val(x);
      total2 = parseFloat($('#text2').val()) + parseFloat($('#text7').val()) + parseFloat(x);
      $('#text27').val(total2);
    })
    $('#text9').on('change', function() {
      console.log('oke');
      let x = $('#text9').val();
      x = (1 / x);
      $('#text17').val(x);
      total2 = parseFloat(total2) + parseFloat(x);
      $('#text27').val(total2);
    })
    $('#text10').on('change', function() {
      console.log('oke');
      let x = $('#text10').val();
      x = (1 / x);
      $('#text22').val(x);
      total2 = parseFloat(total2) + parseFloat(x);
      $('#text27').val(total2);
    })
    $('#text14').on('change', function() {
      console.log('oke');
      let x = $('#text14').val();
      x = (1 / x);
      $('#text18').val(x);
      total3 = parseFloat($('#text3').val()) + parseFloat($('#text8').val()) + parseFloat($('#text13').val()) + parseFloat(x);
      $('#text28').val(total3);
    })
    $('#text15').on('change', function() {
      console.log('oke');
      let x = $('#text15').val();
      x = (1 / x);
      $('#text23').val(x);
      total3 = parseFloat(total3) + parseFloat(x);
      console.log(total3);
      $('#text28').val(total3);
    })
    $('#text20').on('change', function() {
      console.log('oke');
      let x = $('#text20').val();
      x = (1 / x);
      $('#text24').val(x);
      total5 = parseFloat($('#text5').val()) + parseFloat($('#text10').val()) + parseFloat($('#text15').val()) + parseFloat($('#text20').val()) + parseFloat($('#text25').val());
      total4 = parseFloat($('#text4').val()) + parseFloat($('#text9').val()) + parseFloat($('#text14').val()) + parseFloat($('#text19').val()) + parseFloat(x);
      $('#text29').val(total4);
      $('#text30').val(total5);

    })
    // sampai sini
    let tot = 0;
    var x = 0;
    for (let i = 0; i < 5; i++) {
      x = 0;
      for (let j = 0; j < 5; j++) {
        x = parseFloat(x) + parseFloat($('#norm' + ((5 * j) + (i))).val());
      }
      $('#total2' + i).val(x);
    }
    // menghitung bobot
    for (let i = 0; i < 5; i++) {
      let a = parseFloat($('#total' + i).val()) / parseFloat($('#sum').val());
      // console.log(a)
      $('#bobot' + i).val(parseFloat(a));
      // $('#upload' + i).val(parseFloat(a));
    }
    tot = 0;
    for (let i = 0; i < 5; i++) {
      for (let j = 0; j < 5; j++) {
        x = parseFloat($('#bobot' + j).val()) * parseFloat($('#eign' + tot).val());
        $('#eign' + tot).val(x);
        tot++;
      }
    }
    tot = 0;
    // jumlah eign
    for (let i = 0; i < 5; i++) {
      x = 0;
      for (let j = 0; j < 5; j++) {
        x = parseFloat(x) + parseFloat($('#eign' + tot).val());
        $('#jumlahEign' + i).val(x);
        tot++;
      }
    }
    // sampai sini
    // hitung lambda
    let totalLambda = 0;
    let totalLambdaMax = 0;
    for (let i = 0; i < 5; i++) {
      x = parseFloat($('#jumlahEign' + i).val()) / parseFloat($('#bobot' + i).val());
      $('#lambda' + i).val(x);
      // total lambda
      totalLambda = parseFloat(totalLambda) + parseFloat(x);
      x = parseFloat($('#text' + (i + 26)).val()) * parseFloat($('#bobot' + i).val());
      totalLambdaMax = (parseFloat(totalLambda) / parseFloat(5));
      // $('#lambdaMax' + i).val(x);
    }
    // sampai sini

    // total lambda
    $('#sumLambda').val(totalLambda);

    // lambdamax
    $('#lambdaMax').html(totalLambdaMax);

    // Ci
    let ci = (parseFloat(totalLambdaMax) - parseFloat(5)) / parseFloat(4);


    // let ci2 = ci / 4;

    // CR
    let cr = ci / 1.12;


    $('#ci').html(ci);
    // $('#ci2').html(ci2);
    $('#cr').html(cr);
    // console.log()
  })
</script>
</body>

</html>
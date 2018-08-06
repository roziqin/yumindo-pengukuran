  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>
  </footer>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- price format -->
  <script src="dist/js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
  <script src="dist/js/jquery.price_format.2.0.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="dist/js/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

<!-- date-range-picker -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
        //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    //Money Euro
    $("[data-mask]").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});


    $("#example1").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $("#example11").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $("#example12").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $("#example13").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $("#example14").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $("#example7").DataTable({
      "order": [[ 0, "desc" ]],
      "searching": false
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $("#example3").DataTable({
      "order": [[ 0, "asc" ]],
      "searching": false
    });
    $("#example4").DataTable({
      "order": [[ 0, "asc" ]],
      "searching": false
    });
    $("#laporanfraktur").DataTable({
      "order": [[ 0, "asc" ],[4, "asc"]],
      "searching": false
    });
    $('#laporan').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "order": [[ 0, "desc" ]]
    });

    for (var i = 1; i < 20; i++) {
      $("#table"+i).DataTable({
        
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]]
      });
    }
    for (var i = 1; i < 20; i++) {
      $("#dashtable"+i).DataTable({
        
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      });
    }
    //Date range picker
    $('#reservation').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });
    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ':' + picker.endDate.format('YYYY-MM-DD'));
    });
    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });
  function jenisbarang() {
    var ket = $('#jenis :selected').val();
    if (ket == 'obat') {
      document.getElementById("price2").disabled = true;
      $('#price2').val('0');
      document.getElementById("price3").disabled = true;
      $('#price3').val('0');
    } else {
      document.getElementById("price2").disabled = false;
      document.getElementById("price3").disabled = false;
    }
  }
</script>
<script type="text/javascript"> 
  $('#price').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price1').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price2').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price3').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
</script>
</body>
</html>

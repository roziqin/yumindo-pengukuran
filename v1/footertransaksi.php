  
</div>
<!-- ./wrapper -->
<?php

if ($_SESSION['print']=='ya') {
?>

      <script type="text/javascript">
        window.open("pdf/save-pdf.php");
        </script>
    <?php
}


?>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- price format -->
  <script src="dist/js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
  <script src="dist/js/jquery.price_format.2.0.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="dist/js/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- bootstrap datepicker -->
<script src="dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- page script -->
<script>
  $(function () {

      
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    //Money Euro
    $("[data-mask]").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $("#example3").DataTable();
    $("#example4").DataTable({
        "lengthMenu": [[5, 15, 20, -1], [5, 15, 20, "All"]]
    });
    $("#example5").DataTable({
        "lengthMenu": [[5, 15, 20, -1], [5, 15, 20, "All"]]
    });
    $("#example6").DataTable({
        "lengthMenu": [[5, 15, 20, -1], [5, 15, 20, "All"]]
    });
    $('#listbarang').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
  function back() {
    window.history.back();
  }
</script>
<script type="text/javascript"> 
  $('#price').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price1').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price2').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price3').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
</script>
</div>
</body>
</html>

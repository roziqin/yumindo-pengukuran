<div class="">
	<div class="box box-primary">
        <div class="box-body">
          <form action="aksi/transaksi.aksi.php" method="post">
          	<input type="hidden" id="idukur" name="idukur" value="<?php echo $_GET['idukur']; ?>">
            <div class="col-md-4 col-md-offset-0 col-custom-left form-group">
              <div class="form-group">
                <label>Jenis</label>
                  <select name="jenis" class="form-control" id="jenis" onchange='javascript:rubahmodel(this)'>
                        <option value="">-- Pilih Jenis --</option>
                        <?php
                          $query = "SELECT * FROM jenis";
                          $rs = mysql_query($query) or die(mysql_error());
                          
                          while ($r = mysql_fetch_array($rs))
                          {
                            echo "<option value='$r[jenis_id]'>$r[jenis_nama]</option>";
                          } 

                        ?>
                  </select>
              </div>
            </div>
            <div class="col-md-4 col-md-offset-0 col-custom-left form-group">
              <div class="form-group" id="col-2">

              </div>
            </div>
            <div class="col-md-4 col-md-offset-0 col-custom-left form-group">
              <div class="form-group" id="col-3">

              </div>
            </div>
            <div id="col-4">
              
            </div>
          </form>
        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Detail Pengukuran</h3>
        </div>
        <div class="box-body" style="overflow-x: auto;">
          <table id="listbarang" class="table table-bordered table-striped custom1">
            <thead>
                <tr>
                  <th rowspan="2" width="200px">Ruang</th>
                  <th colspan="2">Ukuran</th>
                  <th rowspan="2">Jenis<br>G/V/BL</th>
                  <th rowspan="2">Bahan</th>
                  <th rowspan="2">Kode<br>Bahan</th>
                  <th rowspan="2">model</th>
                  <th rowspan="2">Jumlah</th>
                  <th rowspan="2">KT/E</th>
                  <th colspan="3">Rel/Alat</th>
                  <th rowspan="2" >Harga</th>
                </tr>
                <tr>
                  <th>T</th>
                  <th>L</th>
                  <th>Alat</th>
                  <th>Warna</th>
                  <th>Ukuran</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $id = $_GET['idukur'];
                  $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$id' ORDER BY pengukuran_detail_id ASC";
                  $queryte1=mysql_query($sqlte1);
                  while ($datatea=mysql_fetch_array($queryte1)) {
                $kode1="";
                if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
                  # code...
                  $kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
                }

                $relalat="";
                if ($datatea["pengukuran_detail_alat_2"]!="") {
                  # code...
                  $relalat = "/".$datatea["pengukuran_detail_alat_2"];
                }
                ?>
                  <tr>
                    <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
                    <td><?php echo $datatea["jenis_nama"]; ?></td>
                    <td><?php echo $datatea["kain_nama"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_kode_bahan"].''.$kode1; ?></td>
                    <td><?php echo $datatea["model_nama"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_alat_1"].''.$relalat; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_alat_warna"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_alat_ukuran"]; ?></td>
                    <td><?php echo $datatea["pengukuran_detail_harga"]; ?></td>
                  </tr>
                <?php
                }
                echo mysql_error();
                ?>

              </tbody>
            </table>
            <hr>
        </div>
    </div>
	
</div>

<script src="dist/js/jquery.min.js"></script>
<script type='text/javascript'>

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}
 
var xmlhttp = createRequestObject();
 
function rubahmodel(combobox)
{
    var kode = combobox.value;
    var textjenis = $("#jenis option:selected").text();
      
     if (textjenis == "Lain-lain") {
      
      var bahan = 0;
      var jenis = document.getElementById("jenis").value;
      var model = 0;
      if (!kode) return;
      xmlhttp.open('get', 'getdata.php?ket=tampilform&jenis='+jenis+'&model='+model+'&bahan='+bahan, true);
      xmlhttp.onreadystatechange = function() {
          if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
          {
               document.getElementById("col-4").innerHTML = xmlhttp.responseText;
          }
          return false;
      }
      xmlhttp.send(null);
      
    } else {
      if (!kode) return;
      xmlhttp.open('get', 'getdata.php?ket=model&id='+kode, true);
      xmlhttp.onreadystatechange = function() {
          if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
          {
               document.getElementById("col-2").innerHTML = xmlhttp.responseText;
          }
          return false;
      }
      xmlhttp.send(null);
      $("#col-3").children().remove();
    }
}

function rubahbahan()
{
    var kode = document.getElementById("jenis").value;
    var textjenis = $("#jenis option:selected").text();
    if(textjenis == "Poni Motif") {
      console.log("poni");
      var bahan = 0;
      var jenis = document.getElementById("jenis").value;
      var model = document.getElementById("model").value;
      if (!kode) return;
      xmlhttp.open('get', 'getdata.php?ket=tampilform&jenis='+jenis+'&model='+model+'&bahan='+bahan, true);
      xmlhttp.onreadystatechange = function() {
          if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
          {
               document.getElementById("col-4").innerHTML = xmlhttp.responseText;
          }
          return false;
      }
      xmlhttp.send(null);
    } else if (textjenis == "Poni Polos") {
      var bahan = combobox.value;
      var jenis = document.getElementById("jenis").value;
      var model = document.getElementById("model").value;
      if (!kode) return;
      xmlhttp.open('get', 'getdata.php?ket=tampilform&jenis='+jenis+'&model='+model+'&bahan='+bahan, true);
      xmlhttp.onreadystatechange = function() {
          if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
          {
               document.getElementById("col-4").innerHTML = xmlhttp.responseText;
          }
          return false;
      }
      xmlhttp.send(null);

    } else {
      if (!kode) return;
      xmlhttp.open('get', 'getdata.php?ket=bahan&id='+kode, true);
      xmlhttp.onreadystatechange = function() {
          if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
          {
               document.getElementById("col-3").innerHTML = xmlhttp.responseText;
          }
          return false;
      }
      xmlhttp.send(null);
    }

}

function tampilform(combobox)
{
    var bahan = combobox.value;
    var idukur = document.getElementById("idukur").value;
    var jenis = document.getElementById("jenis").value;
    var model = document.getElementById("model").value;
    if (!bahan) return;
    xmlhttp.open('get', 'getdata.php?idukur='+idukur+'&ket=tampilform&jenis='+jenis+'&model='+model+'&bahan='+bahan, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById("col-4").innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}
</script>
<?php include "headertransaksi.php"; ?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper transaksi">
<!-- Content Header (Page header) -->
<section class="content-header">
  
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12 col-md-offset-0">
    <?php
    if ($_GET["menu"]=="hitungharga") {
        include "hitungharga.php";
    } elseif ($_GET["menu"]=="edit") {
      ?>
      <div class="box box-primary">
        <div class="box-body">
          <a href="?menu=home" class="btn btn-danger pull-right" style="margin-top: 20px;">Kembali</a>
          <?php
          $id = $_GET["id"];
          $sqledit="SELECT * from pengukuran_detail_temp where pengukuran_detail_temp_id='$id'";
          $queryedit=mysql_query($sqledit);
          $dataedit=mysql_fetch_array($queryedit);

          $idjenis = $dataedit["pengukuran_detail_temp_jenis"];
          $idbahan = $dataedit["pengukuran_detail_temp_bahan"];
          $idmodel = $dataedit["pengukuran_detail_temp_model"];

          $sql="SELECT * from jenis where jenis_id='$idjenis'";
          $query=mysql_query($sql);
          $data=mysql_fetch_array($query);
          $jenisnama=$data['jenis_nama'];

          $sql2="SELECT * FROM model WHERE model_id='$idmodel'";
          $query2=mysql_query($sql2);
          $data2=mysql_fetch_array($query2);
          echo mysql_error();

          $sql3="SELECT * FROM kain where kain_id='$idbahan'";
          $query3=mysql_query($sql3);
          $data3=mysql_fetch_array($query3);
                ?>
                  <form action="aksi/transaksi.aksi.php" method="post">
                <input type="hidden" name="idtemp" class="form-control" id="" value="<?php echo $id;?>">
                <input type="hidden" name="jenis" class="form-control" id="" value="<?php echo $idjenis;?>">
            <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
            <?php
            /*
            if ($jenisnama=="Gorden"||$jenisnama=="Vitras"||$jenisnama=="Gorden & Vitras") {
              # code...
            ?>
              <label>Jenis</label>
              <select class="form-control" name="jenis">
                <option value="" >Pilih Jenis</option>
                <?php
                $selected = "";

                $sqljenis = "SELECT * FROM jenis";
                $queryjenis = mysql_query($sqljenis);
                while ($datajenis = mysql_fetch_array($queryjenis)) {
                  # code...
                  if ($datajenis["jenis_nama"]=="Gorden"||$datajenis["jenis_nama"]=="Vitras"||$datajenis["jenis_nama"]=="Gorden & Vitras") {
                    if ($dataedit["pengukuran_detail_temp_jenis"]==$datajenis['jenis_id']) {
                     # code...
                      $selected = "selected";
                    } else {
                      $selected = "";
                    } 
                    echo "<option value='".$datajenis['jenis_id']."' ".$selected.">".$datajenis['jenis_nama']."</option>";      
                  }
                }
                ?>
              </select>/
              <?php
            } else {
            ?>
              <label>Jenis: <?php echo $data['jenis_nama'];?></label>
            <?php
            }
            */
            ?>
            <label>Jenis: <?php echo $data['jenis_nama'];?></label>
            </div>
            <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
              <label>Model</label>
              <?php if ($idmodel!=0) { ?>
              <select class="form-control" name="model">
              <?php
              $sqlte1="SELECT * from model";
              $queryte1=mysql_query($sqlte1);
              while ($datatea=mysql_fetch_array($queryte1)) {
                
                # code...
                if ($datatea["model_id"]==0) {
                  # code...
                } else {
                  # code...
                  $sql="SELECT * from jenis where jenis_id='$idjenis'";
                  $query=mysql_query($sql);
                  $data=mysql_fetch_array($query);
                  
                  if ($data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {
                    # code...
                    if ($datatea['model_nama']=='Triplet') {
                    
                    } else {
                      $selected="";
                      if($idmodel==$datatea["model_id"]){
                        $selected="selected";
                      }
                      ?>
                      <option value="<?php echo $datatea["model_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["model_nama"]; ?></option>
                      <?php
                    } 
                  } else {
                    if ($datatea['model_nama']=='Papan'||$datatea['model_nama']=='Drappery') {
                    } else {
                      $selected="";
                      if($idmodel==$datatea["model_id"]){
                        $selected="selected";
                      }
                      ?>
                      <option value="<?php echo $datatea["model_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["model_nama"]; ?></option>
                      <?php
                    }
                  } 
                } 
              }
              ?>
              </select>
              <?php 
              } else {
              ?>
                <input type="hidden" name="model" class="form-control" id="model" value="0">
              <?php
              } ?>
            </div>
            <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
              <label>Bahan</label>
              <select class="form-control" name="bahan">
              <?php
              $sqlte1="SELECT * from kain WHERE kain_jenis='$idjenis'";
              $queryte1=mysql_query($sqlte1);
              while ($datatea=mysql_fetch_array($queryte1)) {
               
              $selected="";
              if($idbahan==$datatea["kain_id"]){
                $selected="selected";
              }
                # code...
              ?>
                  <option value="<?php echo $datatea["kain_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["kain_nama"]; ?></option>
              <?php              
              }
              ?>
              </select>
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Ruang</label>
                <input type="text" name="ruang" class="form-control" id="ruang" value="<?php echo $dataedit["pengukuran_detail_temp_ruang"];?>">
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Kode Bahan</label>
                <input type="text" name="kodebahan" class="form-control" id="kodebahan" value="<?php echo $dataedit["pengukuran_detail_temp_kode_bahan"];?>">
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
            <?php         
            if ($data['jenis_nama']=="Gorden & Vitras") {
              # code...
            ?>
              <label>Kode Bahan Vitras</label>
                <input type="text" name="kodebahan1" class="form-control" id="kodebahan1" value="<?php echo $dataedit["pengukuran_detail_temp_kode_bahan_1"];?>">
            <?php
            } else {
            ?>
              <label>Kode Bahan Vitras</label>
            <input type="text" name="kodebahan1" class="form-control" id="kodebahan1" value="<?php echo $dataedit["pengukuran_detail_temp_kode_bahan_1"];?>" disabled>
            <?php
            }

            ?>
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group" style="min-height: 55.8px;">
            <?php
            if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif'||$data['jenis_nama']=='Kaca Film') {
            ?>
              <label>Harga Bahan</label>
              <input type="text" name="hargabahan" class="form-control" id="hargabahan" value="" disabled>
            <?php
            } else {
            ?>
              <label>Harga Bahan</label>
                <input type="text" name="hargabahan" class="form-control" id="hargabahan" value="<?php echo $dataedit["pengukuran_detail_temp_harga_bahan"];?>">
            <?php           
            }
            ?>
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Jumlah</label>
                <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?php echo $dataedit["pengukuran_detail_temp_jumlah"];?>">
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Tinggi</label>
                <input type="number" name="panjang" class="form-control" id="tinggi" placeholder="Tinggi" maxlength="5" value="<?php echo $dataedit["pengukuran_detail_temp_tinggi"];?>">
            </div>
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Lebar</label>
                <input type="number" name="lebar" class="form-control" id="lebar" placeholder="Lebar" maxlength="5" value="<?php echo $dataedit["pengukuran_detail_temp_lebar"];?>">
            </div>
            <?php
              
              if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {

                if ($data['jenis_nama']=='Gorden & Vitras'){
                ?>
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
                    <label>KT/E</label>
                    <select class="form-control" name="kt">
                    <?php
                    $selected = "";
                    $ktarray=array("G:KT/V:E","G:KT/V:KT","G:E/V:E","G:E/V:KT");
                    for ($i=0; $i < count($ktarray) ; $i++) { 
                      if ($dataedit["pengukuran_detail_temp_kt"]==$ktarray[$i]) {
                           # code...
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                      echo "<option value='".$ktarray[$i]."' ".$selected.">".$ktarray[$i]."</option>";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
                    <label>Rel Alat Gorden</label>
                    <select class="form-control" name="relalat1">
                      <option value="" >Pilih Alat Rel 1</option>
                      <?php
                      $selected = "";
                      $rel1array=array("Rolet","Delux","Lengkung");
                      for ($i=0; $i < count($rel1array) ; $i++) {
                        if ($dataedit["pengukuran_detail_temp_alat_1"]==$rel1array[$i]) {
                           # code...
                          $selected = "selected";
                        } else {
                          $selected = "";
                        } 
                        echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
                    <label>Rel Alat Vitras</label>
                    <select class="form-control" name="relalat2">
                      <option value="" >Pilih Alat Rel 2</option>
                      <?php
                      $selected = "";
                      $rel1array=array("Rolet","Delux","Lengkung");
                      for ($i=0; $i < count($rel1array) ; $i++) {
                        if ($dataedit["pengukuran_detail_temp_alat_2"]==$rel1array[$i]) {
                           # code...
                          $selected = "selected";
                        } else {
                          $selected = "";
                        } 
                        echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
                      }
                      ?>
                    </select>
                  </div>

                <?php
                } else {
                ?>
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
                    <label>KT/E</label>
                    <select class="form-control" name="kt">
                    <?php
                    $selectedkt = "";
                    $selectede = "";
                    if ($dataedit["pengukuran_detail_temp_kt"]=="KT") {
                     # code...
                      $selectedkt = "selected";
                    } elseif ($dataedit["pengukuran_detail_temp_kt"]=="E") {
                      $selectede = "selected";
                    }

                    ?>
                      <option value="KT" <?php echo $selectedkt; ?>>KT</option>
                      <option value="E" <?php echo $selectede; ?>>E</option>
                    </select>
                  </div>
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
                    <label>Rel Alat</label>
                    <select class="form-control" name="relalat1">
                      <option value="" >Pilih Alat Rel 1</option>
                      <?php
                      $selected = "";
                      $rel1array=array("Rolet","Delux","Lengkung");
                      for ($i=0; $i < count($rel1array) ; $i++) {
                        if ($dataedit["pengukuran_detail_temp_alat_1"]==$rel1array[$i]) {
                           # code...
                          $selected = "selected";
                        } else {
                          $selected = "";
                        } 
                        echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <input type="hidden" name="relalat2" class="form-control" value="">
                <?php
                }
                ?>
            
            <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
              <label>Rel/Alat Warna</label>
              <select class="form-control" name="relwarna">
                <option value="">Pilih Warna</option>
                <?php
                $selected = "";
                $warnaarray=array("Putih","Coklat Kayu","Gold","Silver","Black","Lengkuy");
                for ($i=0; $i < count($warnaarray) ; $i++) {
                  if ($dataedit["pengukuran_detail_temp_alat_warna"]==$warnaarray[$i]) {
                   # code...
                    $selected = "selected";
                  } else {
                    $selected = "";
                  }   
                  echo "<option value='".$warnaarray[$i]."' ".$selected.">".$warnaarray[$i]."</option>";
                }
                ?>
              </select>
            </div>
            <?php
            }
            ?>
              <input type="hidden" name="kualitas" class="form-control" value="<?php echo $dataedit["pengukuran_detail_temp_kualitas"];?>">
            <div class="form-group">
                <input type="submit" class="btn btn-success pull-right btn-lg" value="Edit" name="editpengukuran" style="font-size: 14px;">
            </div>
          </form>
        </div>
      </div>
      <?php
    } else {
      # code...
      include "mobile.php";
      include "desktop.php";
    ?>
      
    <?php
    }
    
    ?>
  	</div>
    <?php /*
    <div class="col-md-8 col-md-offset-0 data-pelanggan" style="display: none;">
        <div class="box box-success">
        <?php
          $user = $_SESSION['login_user'];
          $sql="SELECT * from pelanggan_temp where pelanggan_temp_user='$user'";
          $result=mysql_query($sql);
          $data1=mysql_fetch_array($result);
          $id = $data1['pelanggan_temp_id'];
          $count=mysql_num_rows($result);

          if ($count==1) {
            # code...

            $sql="SELECT * from pelanggan_temp where pelanggan_temp_id = '$id' ";
            $result=mysql_query($sql);
            $data=mysql_fetch_array($result);
        ?>
        
            <div class="box-header with-border">
                <h3 class="box-title">Data Pelanggan</h3>
            </div>
            <div class="box-body">
                <div class="col-md-3 col-md-offset-0">
                    <h4>Nama : <?php echo $data['pelanggan_temp_nama'];?></h4>
                </div>
                <div class="col-md-3 col-md-offset-0">
                    <h4>Email : <?php echo $data['pelanggan_temp_email'];?></h4>
                </div>
                <div class="col-md-3 col-md-offset-0">
                    <h4>Alamat : <?php echo $data['pelanggan_temp_alamat'];?></h4>
                </div>
                <div class="col-md-3 col-md-offset-0">
                    <h4>Telp : <?php echo $data['pelanggan_temp_telepon'];?></h4>
                </div>
            </div>
            <hr>
        <?php
          }
        ?>
            <div class="box-header with-border">
                <h3 class="box-title">List Pengukuran</h3>
            </div>
            <div class="box-body">
                <table id="listbarang" class="table table-bordered table-striped custom1">
                    <thead>
                    <tr>
                      <th rowspan="2" width="200px">Ruang</th>
                      <th rowspan="2">Jenis<br>G/V/BL</th>
                      <th rowspan="2">Kode<br>Bahan</th>
                      <th rowspan="2">model</th>
                      <th colspan="2">Ukuran</th>
                      <th rowspan="2">Jumlah</th>
                      <th rowspan="2">KT/E</th>
                      <th colspan="2">Rel/Alat</th>
                      <th rowspan="2" ></th>
                    </tr>
                    <tr>
                      <th>P</th>
                      <th>L</th>
                      <th>Warna</th>
                      <th>Ukuran</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      
                      $sqlte1="SELECT * from pengukuran_detail_temp, jenis, kain, model where pengukuran_detail_temp_jenis=jenis_id and pengukuran_detail_temp_bahan=kain_id and pengukuran_detail_temp_model=model_id and pengukuran_detail_temp_user='$user' ORDER BY pengukuran_detail_temp_id ASC";
                      $queryte1=mysql_query($sqlte1);
                      while ($datatea=mysql_fetch_array($queryte1)) {
                      ?>
                        <tr>
                          <td><?php echo $datatea["pengukuran_detail_temp_ruang"]; ?></td>
                          <td><?php echo $datatea["jenis_nama"]; ?></td>
                          <td><?php echo $datatea["kain_nama"]; ?></td>
                          <td><?php echo $datatea["model_nama"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_tinggi"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_lebar"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_jumlah"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_kt"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_alat_warna"]; ?></td>
                          <td><?php echo $datatea["pengukuran_detail_temp_alat_ukuran"]; ?></td>
                          <td>
                            <a href="aksi/hapus.php?menu=transaksi&id=<?php echo $datatea["pengukuran_detail_temp_id"]; ?>" class="btn btn-danger"><i class='fa fa-trash'></i></a>
                          </td>
                        </tr>
                      <?php
                      }
                      echo mysql_error();

                    $sql="SELECT SUM(pengukuran_detail_temp_harga) AS subtotal FROM pengukuran_detail_temp where pengukuran_detail_temp_user='$user' ";
                    $result=mysql_query($sql);
                    $data=mysql_fetch_array($result); 
                    $total1 = $data['subtotal'];
                      ?>

                    </tbody>
                </table>

                <form action="aksi/transaksi.aksi.php" method="post">
                <input type="hidden" name="subtotal" class="form-control" value="<?php echo $total1; ?>">
                  <div class="form-group">
                      <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="prosessekarang">
                  </div>
                </form>
            </div>
        </div>
    </div>
    */ ?>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>  
<?php include "footertransaksi.php" ?>


    <script src="dist/js/jquery.min.js" ></script>
    <script type="text/javascript">
       function numberWithCommas(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
          $('#contmodel').show();

      function hitung() {
          var kebutuhan = $("#kebutuhan :selected").val();
          var model = $("#model :selected").val();
          var kualitas = $("#kualitas :selected").val();
          var kain = $("#kain_1 :selected").val();
          var tinggi = $("input[name='tinggi']").val();
          var lebar = $("input[name='lebar']").val();
          if (tinggi < 100) tinggi = 100;
          if (lebar < 100) lebar = 100;
          var luas = tinggi * lebar;
          var kualitas_vitras = $("#kualitas :selected").val(); 
          tinggi = parseInt(tinggi);
          lebar = parseInt(lebar);

          var bahan_kain = (lebar * kualitas)/100;

          if (kualitas == 3) kualitas_vitras = 2.6
          var bahan_kain_vitras = (lebar * kualitas_vitras)/100; //edt

          if (model == "triplet" && kain == "blackout") {
          // if (kebutuhan == "gorden" && model == "triplet" && kain == "blackout") {
            var bahan_kain = (lebar * 2.6)/100; //edt
          } else if (kebutuhan == "gordenvitras") {

            
            var bahan_kain = (lebar * 2.6)/100; //edt

            if (kain == "blackout" && model == "minimalis") {
              var bahan_kain = (lebar * 3)/100;
            }

            if (kain == "local") {
              var bahan_lembar  = Math.ceil(lebar/50); // dibulatkan keatas
              var bahan_kain    = bahan_lembar * ((tinggi+50)/100);
            }
            
          } else if ( kain == "local") {
          // } else if (kebutuhan == "gorden" && kain == "local") {
            var bahan_lembar  = Math.ceil(lebar/50); // dibulatkan keatas
            var bahan_kain    = bahan_lembar * ((tinggi+50)/100); //edt
          } else if (kebutuhan == "vitras") {
            var bahan_kain = (lebar * 2.6)/100; //edt
          }

          var bahan_rel  = (lebar)/100; //edt

          if (kain == "local" && model == "minimalis") {
            var bahan_ring = bahan_lembar*8;
          } else {
            var bahan_ring = bahan_kain*8;
          }
          var bahan_hook = 1;
          var bahan_tali = 1;

          var harga = {
              'minimalis' : {
                      'blackout' : {
                              'gorden' : 170000, //kain BO
                              'rel' : 60000, //rolet
                              'ring' : 3500,
                              'hook' : 20000,
                              'tali': 30000, //acc
                              'vitras' : 85000,
                              'vitras_rel' : 40000 //edt
                      },
                      'local' : {
                              'gorden' : 65000,
                              'rel' : 60000,
                              'ring' : 3500,
                              'hook' : 20000,
                              'tali': 30000, //acc
                              'vitras' : 85000,
                              'vitras_rel' : 40000 //edt
                      },
                      '' : {
                              'gorden' : 0,
                              'rel' : 0,
                              'ring' : 0,
                              'hook' : 0,
                              'tali': 0,
                              'vitras' : 0,
                              'vitras_rel' : 0

                      }
              },
              'triplet' : {
                      'blackout' : {
                              'gorden' : 170000, //kain BO 160.000
                              'rel' : 60000, //35000
                              'ring' : 3500, //smokring
                              'hook' : 20000,
                              'tali': 30000, //acc
                              'vitras' : 85000, //vitras
                              'vitras_rel' : 40000 //edt
                      },
                      'local' : {
                              'gorden' : 65000, //kain local
                              'rel' : 40000, // rolet kotak
                              'ring' : 3500,
                              'hook' : 20000,
                              'tali': 30000, //acc
                              'vitras' : 85000,
                              'vitras_rel' : 40000 //edt
                      },
                      '' : {
                              'gorden' : 0,
                              'rel' : 0,
                              'ring' : 0,
                              'hook' : 0,
                              'tali': 0,
                              'vitras' : 0,
                              'vitras_rel' : 0

                      }
              }
          };

          harga_blind = {
              'rollerblind' : {
                          'blackoutsuperior' : 473000, //edt
                          'superiordimout' : 385000 //edt
              },
              'vertikalblind' : {
                          'blackout' : 292000, // edt
                          'dimout' : 192000 //edt
              },
              'horizontalblind' : {
                          'deluxeslatting' : 275000, //edt
                          'perforatedslatting' : 325000, //edt
                          'woodmotiveslatting' : 357000 //edt
              },
              'woddenblind' : {
                          '27mm' : 687500, //edt
                          '35mm' : 770000, //edt
                          '50mm' : 891000 //edt
              },
          };


          $('.kain').hide();
          $('.rollerblind').hide();
          $('.vertikalblind').hide();
          $('.horizontalblind').hide();
          $('.woddenblind').hide();

          

          var hasilhitung = 0;
          if (kebutuhan == 'rollerblind') {
              hasilhitung = (luas / 10000) * harga_blind['rollerblind'][kain];
              if (isNaN(harga_blind['rollerblind'][kain])) hasilhitung = 0; //edt
          }else if (kebutuhan == 'vertikalblind') {
              hasilhitung = (luas / 10000) * harga_blind['vertikalblind'][kain];
              if (isNaN(harga_blind['vertikalblind'][kain])) hasilhitung = 0;  //eddt
          }else if (kebutuhan == 'horizontalblind') {
              hasilhitung = (luas / 10000) * harga_blind['horizontalblind'][kain];
              if (isNaN(harga_blind['horizontalblind'][kain])) hasilhitung = 0;  //edt
          }else if (kebutuhan == 'woddenblind') {
              hasilhitung = (luas / 10000) * harga_blind['woddenblind'][kain];
              if (isNaN(harga_blind['woddenblind'][kain])) hasilhitung = 0;  //edt
          }else if (kebutuhan == 'vitras') {
              if (tinggi <= 260) { //edt
                hasilhitung += bahan_kain_vitras * harga[model][kain]['vitras'];
                hasilhitung += bahan_tali * harga[model][kain]['tali'];
                hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];
                hasilhitung = 'Rp. ' + hasilhitung;
              } else { //edt
                hasilhitung = "Silahkan hubungi CS kami"; //edt
              } //edt
          }else if (kebutuhan == 'gorden') {

              if (tinggi <= 260) { //edt
                // hasilhitung += bahan_hook * harga[model][kain]['hook'];  // edt hapus
                hasilhitung += Math.round(bahan_kain * harga[model][kain]['gorden']);
                hasilhitung += bahan_rel * harga[model][kain]['rel'];
                hasilhitung += bahan_tali * harga[model][kain]['tali'];
                  if (model=='minimalis'){
                    hasilhitung += bahan_ring * harga[model][kain]['ring'];
                  }
                  hasilhitung = 'Rp. ' + hasilhitung;
              } else { //edt
                hasilhitung = "Silahkan hubungi CS kami"; //edt
              } //edt

          }else if (kebutuhan == 'gordenvitras') {
              if (parseInt(tinggi) <= 260) { //edt
                hasilhitung += bahan_kain * harga[model][kain]['gorden'];
                hasilhitung += bahan_rel * harga[model][kain]['rel'];
                hasilhitung += bahan_tali * harga[model][kain]['tali'];
                

                  if (model=='minimalis'){
                    console.log("bahan_tali", bahan_ring * harga[model][kain]['ring']);
                    hasilhitung += bahan_ring * harga[model][kain]['ring'];
                  }

              console.log('hasil: '+  hasilhitung);
                
                
                hasilhitung += bahan_kain_vitras * harga[model][kain]['vitras'];
                console.log('hasil -: '+  hasilhitung);
              
                hasilhitung += bahan_tali * harga[model][kain]['tali']; //ini pakai atau tidak ?
                console.log('hasil -: '+  hasilhitung);
                hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];

              console.log('hasil akhir: '+  hasilhitung);
                hasilhitung = 'Rp. ' + hasilhitung;
              } else { //edt
                hasilhitung = "Silahkan hubungi CS kami"; //edt
              } //edt
          }
          // cek tinggi gorden < 260
          if (kebutuhan == 'gorden' || kebutuhan == 'vitras' || kebutuhan == 'gordenvitras') {
            $('#hasilhitung').val(numberWithCommas(hasilhitung));
          } else {
            $('#hasilhitung').val('Rp. ' + numberWithCommas(hasilhitung));
          }

      }

      function jeniskain () {
          var kebutuhan = $("#kebutuhan :selected").val();
          if (kebutuhan == 'rollerblind' ){
              //$('.rollerblind').show();

              $('#contmodel').hide();
              $('#kain_1').empty();
              $('#kain_1').append('<option value="">Pilih Bahan</option>');
              $('#kain_1').append('<option value="blackoutsuperior">Black Out Superior</option>');
              $('#kain_1').append('<option value="superiordimout">Superior Dim Out</option>');

          }else if(kebutuhan == 'vertikalblind' ){
              //$('.vertikalblind').show();
              $('#contmodel').hide();
              $('#kain_1').empty();
              $('#kain_1').append('<option value="">Pilih Bahan</option>');
              $('#kain_1').append('<option value="blackout">Black Out</option>');
              $('#kain_1').append('<option value="dimout">Dim Out</option>');

          }else if(kebutuhan == 'horizontalblind' ){
              //$('.horizontalblind').show();
              $('#contmodel').hide();
              $('#kain_1').empty();
              $('#kain_1').append('<option value="">Pilih Bahan</option>');
              $('#kain_1').append('<option value="deluxeslatting">Deluxes Slatting</option>');
              $('#kain_1').append('<option value="perforatedslatting">Perforated Slatting</option>');
              $('#kain_1').append('<option value="woodmotiveslatting">Wood Motive Slatting</option>');

          }else if(kebutuhan == 'woddenblind' ){
              //$('.woddenblind').show();
              $('#contmodel').hide();
              $('#kain_1').empty();
              $('#kain_1').append('<option value="">Pilih Bahan</option>');
              $('#kain_1').append('<option value="27mm">Wodden Blind 27mm</option>');
              $('#kain_1').append('<option value="35mm">Wodden Blind 35mm</option>');
              $('#kain_1').append('<option value="50mm">Wodden Blind 50mm</option>');

          } else {
              //$('.kain').show();
              $('#kain_1').empty();
              $('#kain_1').append('<option value="">Pilih Bahan</option>');
              $('#kain_1').append('<option value="blackout">Kain Blackout</option>');
              $('#kain_1').append('<option value="local">Kain Lokal</option>');
          }
      }


      hitung();
      $("#kebutuhan").change(function() {
           hitung();
           jeniskain();
      })
      $("#model").change(function() {
          hitung();
      })
      $("#kain_1").change(function() {
          hitung();
      })
      $("#kualitas").change(function() {
          hitung();
      })
      $("input[name='tinggi']").keyup(function() {
          hitung();
      })
      $("input[name='lebar']").keyup(function() {
          hitung();
      })
    </script>

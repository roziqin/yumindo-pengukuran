<!-- Custom Tabs -->
      <div class="nav-tabs-custom mobile">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Transaksi</a></li>
          <li><a href="#tab_2" data-toggle="tab">Cart</a></li>
          <li><a href="#tab_3" data-toggle="tab">Detail</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <?php include "konten.php" ; ?>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Pengukuran</h3>
            </div>
            <div class="box-body">
              <table id="listbarang" class="table table-bordered table-striped custom1">
                    <thead>
                    <tr>
                      <th>Ruang</th>
                      <th>Jenis</th>
                      <th>Harga</th>
                      <th ></th>
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
                          <td>Rp <?php echo format_rupiah($datatea["pengukuran_detail_temp_harga"]); ?></td>
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

                    $sql11="SELECT * FROM pelanggan_temp where pelanggan_temp_user='$user' ";
                    $result11=mysql_query($sql11);
                    $data11=mysql_fetch_array($result11); 
                    $diskon = $total1*($data11['pelanggan_temp_diskon']/100);
                    
                    $tot = $total1 - $diskon;
                      ?>

                    </tbody>
                </table>
                <hr>
                <form action="aksi/transaksi.aksi.php" method="post" class="custom-form">
                  <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
            <label>Total</label>
                    <input type="hidden" name="subtotal" class="form-control" value="<?php echo $tot; ?>">
                    <input type="text" name="" class="form-control" style="text-align: right; margin-bottom: 20px; font-size: 24px; height: auto;" value="Rp <?php echo format_rupiah($tot); ?>" disabled>
          
                    <input type="hidden" name="dp" class="form-control" style="text-align: right; margin-bottom: 20px; font-size: 24px; height: auto;" value="0" id="price">
                    <label>Catatan Ukur</label>
                    <textarea class="form-control" rows="3" name="catatan"></textarea>
                    <label>Catatan Jahit</label>
                    <textarea class="form-control" rows="3" name="catatan-jahit"></textarea>
                </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="prosessekarang">
                      <!--<a href="?menu=nego" class="btn btn-info pull-right btn-lg" >Nego Harga</a> -->
                  </div>
                </form>
            </div>
        </div>
          </div>
          <div class="tab-pane" id="tab_3">
            <div class="box box-success">
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
                      <th rowspan="2">Kode<br>Bahan</th>
                      <th rowspan="2">model</th>
                      <th rowspan="2">Jumlah</th>
                      <th rowspan="2">KT/E</th>
                      <th colspan="2">Rel/Alat</th>
                      <th rowspan="2" >Harga</th>
                      <th rowspan="2" ></th>
                    </tr>
                    <tr>
                      <th>T</th>
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
                    $kode1="";
                    if ($datatea["pengukuran_detail_temp_kode_bahan_1"]!="") {
                      # code...
                      $kode1 = "/".$datatea["pengukuran_detail_temp_kode_bahan_1"];
                    }
                    ?>
                      <tr>
                        <td><?php echo $datatea["pengukuran_detail_temp_ruang"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_tinggi"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_lebar"]; ?></td>
                        <td><?php echo $datatea["jenis_nama"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_kode_bahan"].''.$kode1; ?></td>
                        <td><?php echo $datatea["model_nama"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_jumlah"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_kt"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_alat_warna"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_alat_ukuran"]; ?></td>
                        <td><?php echo $datatea["pengukuran_detail_temp_harga"]; ?></td>
                        <td><a href="?menu=edit&id=<?php echo $datatea['pengukuran_detail_temp_id'] ?>" class="btn btn-success pull-right btn-lg" style="font-size: 12px;">Edit</a></td>
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
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
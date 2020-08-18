<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left info" style="position: initial;">
          <p>
          <?php echo $_SESSION['name'];;?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="?menu=home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php
        if ($_SESSION['role']=="admin") {
          # code...
        ?>
          <li>
              <a href="admin.php?menu=inputbooking"><i class='fa fa-user'></i> <span>Input Booking</span></a>
          </li>
          <li>
              <a href="admin.php?menu=inputpelanggan"><i class='fa fa-user'></i> <span>Input Pelanggan</span></a>
          </li>
          <li>
              <a href="admin.php?menu=user&id=0"><i class='fa fa-user'></i> <span>Input User</span></a>
          </li>
          <li>
              <a href="admin.php?menu=laporan&tanggal="><i class='fa fa-table'></i> <span>Laporan</span></a>
          </li>
        <?php
        
        } elseif ($_SESSION['role']=="pengukur") {
          # code...
        ?>
          <li>
              <a href="admin.php?menu=pemasangan"><i class='fa fa-money'></i> <span>Pemasangan</span></a>
          </li>
        <?php
        }


        if ($_SESSION['role']=='owner') {
        
        ?>
          <li>
              <a href="admin.php?menu=inputbooking"><i class='fa fa-user'></i> <span>Input Booking</span></a>
          </li>
          <li>
              <a href="admin.php?menu=inputpelanggan"><i class='fa fa-user'></i> <span>Input Pelanggan</span></a>
          </li>
          <li>
              <a href="admin.php?menu=user&id=0"><i class='fa fa-user'></i> <span>Input User</span></a>
          </li>
          <li>
              <a href="admin.php?menu=laporan&tanggal="><i class='fa fa-table'></i> <span>Laporan</span></a>
          </li>
        <?php
        } 
        ?>
          <li>
              <a href="admin.php?menu=hitungharga"><i class='fa fa-money'></i> <span>Hitung Harga</span></a>
          </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
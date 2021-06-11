<?php
@session_start();
if (isset($_GET['sejak'])) {
  ?>
  <button class="btn btn-info d-print-none mb-4" onclick="printDiv('print')"><i class="fa fa-print"></i> Print</button>
  <div class="col-12 card" id="print">

    <div class="row">
      <div class="col-3">
        <img src="assets/img/logo-bisma.jpg" width="200px">
      </div>
      <div class="col-6">
        <div class="mt-3 pt-3">
          <h3>CV. BISMA OPTIMA</h3>
          <h6>Perum Duta Mekar Asri Ruko Blok C.1 No.01 Cileungsi-Bogor 16820</h6>
          <p>Telp. 021-82499584 Hp. 08128092227</p>
        </div>
      </div>
      <div class="col-3">
        <div class="mt-3 pt-3">
          <p><small>Cileungsi, <?php echo dateIndonesian(date('Y-m-d')) ?></small></p>
        </div>
      </div>
    </div>
    <div class="table-responsive" style="padding: 10px;">
      <h3 class="text-center">Pelaporan Barang Masuk periode <?php echo dateIndonesian($_GET['sejak']) ?> hingga <?php echo dateIndonesian($_GET['hingga']) ?></h3>
      <h6 class="text-center">Laporan Pemasukan stok barang </h6>
      <table id="Laporan" class="table table-bordered table-striped ">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>                          
            <th>Penerima</th>                          
            <th>Stok Keluar</th>                                                    
          </tr>

        </thead>
        <tfoot>

          <tr>
           <th>No</th>
           <th>Tanggal</th>                          
           <th>Penerima</th>                          
           <th>Stok Keluar</th>   
         </tr>
       </tfoot>
       <tbody>
        <?php
        $no=1;
        $sql="SELECT * FROM barang_keluar
        WHERE tanggal >= '".$_GET['sejak']."' and tanggal <= '".$_GET['hingga']."'";
        $query = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($query))
        {
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <b>
              <td>
                <?php echo dateIndonesian(date($row['tanggal'])) ?>
              </td>
              <td>
                <?php echo $row['penerima'];?>
              </td>
              <td>
                <?php echo $row['pengeluaran'];?>
              </td>
            </b>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="col-lg-12 p-5">
    <span class="pull-right">
      <p>Menyetujui</p>
      <p><?php echo dateIndonesian(date('Y-m-d')) ?></p>
      <p>Owner</p>
      <br><br><br>
      <strong style="text-decoration: underline;">Imam Ma'ruf</strong>
      <!-- <p>NIP: 1966 0922 1986 032 006</p> -->
    </span>
  </div>
</div>
<?php
}else{
  ?>
  <div class="col-12 card">
    <div class="card-header">
      <h4>Filter tanggal</h4>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-4 col-xs-12"></div>
        <div class="col-md-4 col-xs-12">
          <form method="GET">
            <input type="hidden" name="halaman" value="<?php echo $_GET['halaman'] ?>">
            <div class="form-group">
              <label>Sejak</label>
              <input type="date" name="sejak" class="form-control" value="<?php echo date('Y-m-01') ?>">
            </div>
            <div class="form-group">
              <label>Hingga</label>
              <input type="date" name="hingga" class="form-control" value="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
          </form>
        </div>
        <div class="col-md-4 col-xs-12"></div>
      </div>
    </div>
  </div>
  <?php
}
?>
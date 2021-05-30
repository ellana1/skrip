<?php
@session_start();
  // error_reporting(0);
include '../config/koneksi.php';
$sql="SELECT * from stok where id='".$_GET['stok']."'";
// echo $sql;
$p=mysqli_fetch_array(mysqli_query($koneksi,$sql));
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  <meta name="description" content="This is an example dashboard created using build-in elements and components.">
  <title>Laporan Pemasukan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
   <!--charts js-->
   <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
   <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
   <link href="../main.css" rel="stylesheet">
   <style type="text/css">
     h3{
      font-family: sans-serif;
    }
  </style>
</head>
<body>
  <div class="col-lg-12" style="padding: 10px;border-bottom: 1px solid #333;">
   <div class="kop row" >
    <div class="col-xs-2">
      <img src="../assets/img/logo-bisma.jpg" style="width: 200px;">
   </div>
   <div class="col-xs-8 text-center" style="margin-left: 0; margin-top: 10px;">
     <h3 style="color: #111;"><b>CV. BISMA OPTIMA PRINT</b></h3>
     <h4 style="margin-top: -10px;margin-left: 3px;"> Ruko Duta Mekar Asri, Cileungsi-Bogor 16820<br>
      Telp. (021) <br>
    </h4>
  </div>
  <div class="col-xs-2">
   <!-- <img src="../assets/img/logodki.png" style="width: 200px;">-->
  </div>
</div>
</div>
<div class="table-responsive" style="padding: 10px;">
  <h3 class="text-center">Pelaporan Barang Masuk periode <?php echo $p['label'] ?></h3>
  <h6 class="text-center">Laporan Pemasukan stok barang </h6>
  <table id="Laporan" class="table table-bordered table-striped ">
    <thead>
      <tr>
          <th rowspan="2">No</th>
          <th rowspan="2">Nomor barang</th>                          
          <th rowspan="2">Tanggal</th>                          
          <th rowspan="2">Nama Barang</th>                          
          <th rowspan="2">Keterangan</th>                                                    
                                    
      </tr>
      <tr>
        <th>No</th>
        <th>Nomor Barang</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $no=1;
          $barang_id = @$_POST['id'];
          $sql = query("SELECT *FROM stok
          INNER JOIN stok ON nama_barang.barang_id = nama_barang.barang_id
          WHERE nama_barang.barang_id=$_GET[id]")or die(mysqli_error());
          while ($data=mysqli_fetch_array($sql))
{
?>
       <tr>
        <td><?php echo $no++; ?></td>
        
        <b>
          <td>
            <?php echo $row['barang_id'];?>
          </td>
          <td>
            <?php echo $row['tanggal'];?>
          </td>
          <td>
            <?php echo $row['nama_barang'];?>
          </td>
          <td>
            <?php echo $row['keterangan'];?>
          </td>
        </b>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
<div class="col-lg-12">
  <span class="pull-right text-center">
    <p>Menyetujui</p>
    <p><?php echo date('l, d F Y');?></p>
    <p>Owner</p>
    <br><br><br>
    <strong style="text-decoration: underline;">Imam Ma'ruf</strong>
    <!-- <p>NIP: 1966 0922 1986 032 006</p> -->
  </span>
</div>
</div>
<script type="text/javascript">
  window.print();
</script>
</body>
<!-- <?php
function notif($Alfa,$Izin,$Sakit){
  $num=0;
  if ($Alfa>3) {
    $textalfa="Alfa";
    $num++;
  }else{
    $textalfa="";
  }
  if ($Izin>3) {
    $textizin="Izin";
    $num++;
  }else{
    $textizin="";
  }
  if ($Sakit>3) {
    $textsakit="Sakit";
    $num++;
  }else{
    $textsakit="";
  }
  echo $result = "Melebihi batas kuota ".$textalfa." ".$textizin." ".$textsakit;
  return $result;
}
?> -->
<?php
function bulan($bln){
  if($bln == 1){
    $bulan1="Januari";
  }elseif($bln == 2){
    $bulan1="Februari";
  }elseif($bln == 3){
    $bulan1="Maret";
  }elseif($bln == 4){
    $bulan1="April";
  }elseif($bln == 5){
    $bulan1="Mei";
  }elseif($bln == 6){
    $bulan1="Juni";
  }elseif($bln == 7){
    $bulan1="Juli";
  }elseif($bln == 8){
    $bulan1="Agustus";
  }elseif($bln == 9){
    $bulan1="September";
  }elseif($bln == 10){
    $bulan1="Oktober";
  }elseif($bln == 11){
    $bulan1="November";
  }elseif($bln == 12){
    $bulan1="Desember";
  }
  return $bulan1;
}
?>
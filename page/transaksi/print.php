<?php
include '../../config/connection.php';
$query  =   mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '".$_GET['id']."'");
$row    =   mysqli_fetch_array($query);
$kode   =   date_format(date_create($row['tanggal']),'ymd')*10000;
$kode   =   $row['id']+$kode;
$kode   =   "TR".$kode;
?>
<title>Invoice #<?php echo $kode ?></title>
<link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
<div class="container  pull-up">
    <div class="row">
        <div class="col-3">
            <img src="../../assets/img/logo-bisma.jpg" width="200px">
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
                <p><small>Nama Customer<br><b><?php echo ucwords($row['nama_customer']) ?></b></small></p>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Invoice</label>
                                <p><b>#<?php echo $kode; ?></b></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group float-right">
                              <label>Tanggal</label>
                              <p><b><?php echo $row['tanggal']; ?></b></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                <div class="table-responsive p-t-10">
                    <table id="example" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $list_detail = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE transaksi_id = '".$row['id']."' ORDER BY id DESC");
                            foreach($list_detail as $rowld){
                                switch ($rowld['tipe']) {
                                    case 'barang':
                                    $query = mysqli_query($conn, "SELECT * FROM barang WHERE barang_id = '".$rowld['item_id']."'");
                                    $rowbar    = mysqli_fetch_array($query);
                                    $title=$rowbar['nama_barang'];
                                    break;
                                    case 'bahan':
                                    $query = mysqli_query($conn, "SELECT * FROM bahan WHERE id = '".$rowld['item_id']."'");
                                    $rowbar    = mysqli_fetch_array($query);
                                    $title=$rowbar['nama_bahan'];
                                    break;
                                    // case 'stok':
                                    // $query = mysqli_query($conn, "SELECT * FROM stok WHERE id = '".$rowld['item_id']."'");
                                    // $rowbar    = mysqli_fetch_array($query);
                                    // $title=$rowbar['nama_barang'];
                                    // break;
                                }
                                $subtotal = $rowbar['harga'] * $rowld['qty'];
                                $total += $subtotal;
                                ?>
                                <tr>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $rowld['qty']; ?></td>
                                    <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" align="right">Total : </td>
                                <td><b>Rp <?php echo number_format($total,0,',','.'); ?></b></td>
                                <?php 
                                $update = mysqli_query($conn, "UPDATE transaksi SET total = '".$total."' WHERE id = '".$_GET['id']."'");
                                ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">window.print()</script>

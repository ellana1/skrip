<?php
if (isset($_POST['simpan'])) {
    // print_r($_POST);exit;
    $split = explode("-", $_POST['item_id']);
    $tipe = $split[0];
    $_POST['item_id'] = $split[1];
    switch ($tipe) {
        case 'barang':
        $query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '".$_POST['item_id']."'");
        $row    = mysqli_fetch_array($query);
        break;
        case 'bahan':
        $query = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '".$_POST['item_id']."'");
        $row    = mysqli_fetch_array($query);
        break;
        // case 'barang':
        // $query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '".$_POST['item_id']."'");
        // $row    = mysqli_fetch_array($query);
        // break;
    }
    $total  = $row['harga'] * $_POST['qty'];
    $sql="INSERT INTO detail_transaksi (id_transaksi, tipe, item_id, qty, subtotal)
    VALUES ('".$_POST['transaksi_id']."','$tipe', '".$_POST['item_id']."', '".$_POST['qty']."', '".$total."')";
    $query = mysqli_query($conn, $sql);
    $sql = "UPDATE transaksi set 
    total =  '$total'
    WHERE id_transaksi = '".$_GET['id']."'
    ";
    $query = mysqli_query($conn, $sql);
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=transaksi&aksi=detail&id=".$_POST['transaksi_id']."'</script>";
}
if (isset($_GET['delete'])) {
    $sql = "DELETE from detail_transaksi 
    WHERE id_detail = '".$_GET['delete']."'
    ";
    $query = mysqli_query($conn, $sql);
    echo "<script>alert('Data terhapus!'); window.location.href='?halaman=transaksi&aksi=detail&id=".$_GET['id']."'</script>";
}
$query  =   mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '".$_GET['id']."'");
$row    =   mysqli_fetch_array($query);
$kode   =   date_format(date_create($row['tanggal']),'ymd')*10000;
$kode   =   $row['id_transaksi']+$kode;
$kode   =   "TR".$kode;
?>
<div class="container  pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Transaksi</label>
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
                  <span class="float-right">
                    <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail"><i class="fa fa-plus"></i></a>
                    <a href="page/transaksi/print.php?id=<?php echo $row['id']; ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive p-t-10">
                    <table id="example" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $list_detail = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id_transaksi = '".$row['id_transaksi']."' ORDER BY id_detail DESC");
                            foreach($list_detail as $rowld){
                                switch ($rowld['tipe']) {
                                    case 'barang':
                                    $query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '".$rowld['item_id']."'");
                                    $rowbar    = mysqli_fetch_array($query);
                                    $title=$rowbar['nama_barang'];
                                    break;
                                    case 'bahan':
                                    $query = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '".$rowld['item_id']."'");
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
                                    <td>
                                        <a href="?halaman=transaksi&aksi=detail&delete=<?= $rowld['id_transaksi'] ?>&id=<?= $_GET['id'] ?>" class="btn btn-danger pull-right" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" align="right">Total : </td>
                                <td><b>Rp <?php echo number_format($total,0,',','.'); ?></b></td>
                                <td></td>
                                <?php 
                                $update = mysqli_query($conn, "UPDATE transaksi SET total = '".$total."' WHERE id_transaksi = '".$_GET['id']."'");
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
<div id="modal_detail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?halaman=transaksi&aksi=detail&id=<?php echo $row['id_detail']; ?>" method="POST">
                <input type="hidden" name="transaksi_id" value="<?php echo $row['id_transaksi']; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item</label>
                                <select name="item_id" class="form-control" required>
                                    <option selected disabled>--Pilih Item--</option>
                                    <?php
                                    // echo '<optgroup label="Barang">';
                                    // $list_barang = mysqli_query($conn, "SELECT * FROM barang where id_barang not in (SELECT item_id from detail_transaksi WHERE tipe = 'barang' and id_transaksi = '".$row['id_transaksi']."')");
                                    // foreach($list_barang as $lb){
                                    //     echo $lb['barang'] > 0 ? '<option value="barang-'.$lb['id_barang'].'">'.$lb['nama_barang'].'  (Rp. '.number_format($lb['harga']).')</option>' : '';
                                    // }
                                    // echo '</optgroup>';
                                    echo '<optgroup label="Barang">';
                                    $list_barang = mysqli_query($conn, "SELECT * FROM barang where id_barang not in (SELECT item_id from detail_transaksi WHERE tipe = 'barang' and id_transaksi = '".$row['id_transaksi']."')");
                                    foreach($list_barang as $lb){
                                        echo '<option value="barang-'.$lb['id_barang'].'">'.$lb['nama_barang'].'  (Rp. '.number_format($lb['harga']).')</option>';
                                    }
                                    echo '</optgroup>';
                                    echo '<optgroup label="Bahan">';
                                    $list_bahan = mysqli_query($conn, "SELECT * FROM bahan where id_bahan not in (SELECT item_id from detail_transaksi WHERE tipe = 'bahan' and id_transaksi = '".$row['id']."')");
                                    foreach($list_bahan as $lb){
                                        echo '<option value="bahan-'.$lb['id_bahan'].'">'.$lb['nama_bahan'].'  (Rp. '.number_format($lb['harga']).')</option>';
                                    }
                                    echo '</optgroup>';
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="number" class="form-control" min="1" name="qty" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
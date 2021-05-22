<?php 

$query  =   mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '".$_GET['id']."'");
$row    =   mysqli_fetch_array($query);
$kode   =   date_format(date_create($row['tanggal']),'ymd')*10000;
$kode   =   $row['id']+$kode;
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

                        <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modal_detail"><i class="mdi mdi-plus"></i></a>
                        <a href="page/transaksi/print.php?id=<?php echo $row['id']; ?>" class="btn btn-info" target="_blank"><i class="mdi mdi-printer"></i></a>
                    </span>
                </div>
                <!-- <?php if (isset($_SESSION['flash'])): ?>
                    <div class="<?php echo $_SESSION['flash']['class'] ?>">
                        <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i>
                        <?php echo "  ".$_SESSION['flash']['label'];
                        ?>
                    </div> -->
                <?php endif ?> -->
                <div class="card-body">
                    <div class="table-responsive p-t-10">
                        <table id="example" class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>QTY</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $list_detail = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE transaksi_id = '".$row['id']."' ORDER BY id DESC");
                                foreach($list_detail as $rowld){
                                    $barang = mysqli_query($conn, "SELECT * FROM barang WHERE id = '".$rowld['barang_id']."'");
                                    $rowbar = mysqli_fetch_array($barang);
                                    $subtotal = $rowbar['harga'] * $rowld['qty'];
                                    $total += $subtotal;
                                    ?>
                                    <tr>
                                        <td><?php echo $rowbar['kode_barang']; ?></td>
                                        <td><?php echo $rowbar['nama_barang']; ?></td>
                                        <td><?php echo $rowld['qty']; ?></td>
                                        <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>
                                        <td>
                                             <a href="?halaman=transaksi&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="?halaman=transaksi&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right">Total : </td>
                                    <td><b>Rp <?php echo number_format($total,0,',','.'); ?></b></td>
                                    <td></td>

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

<div id="modal_detail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo $aksi; ?>?page=<?php echo $_GET['page'] ?>&aksi=tambah_detail" method="POST">
                <input type="hidden" name="transaksi_id" value="<?php echo $row['id']; ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barang</label>
                                <select name="barang_id" class="form-control" required>
                                    <option selected disabled>--Pilih Barang--</option>
                                    <?php
                                    $kat = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id asc");
                                    foreach($kat as $k){ ?>
                                        <optgroup label="<?php echo $k['nama_kategori'] ?>">
                                            <?php
                                            $list_barang = mysqli_query($conn, "SELECT * FROM barang where kategori_id='".$k['id']."' ORDER BY nama_barang asc ");
                                            foreach($list_barang as $lb){
                                                echo '<option value="'.$lb['id'].'">'.$lb['nama_barang'].'  (Rp. '.number_format($lb['harga']).')</option>';
                                            }
                                            ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="number" class="form-control" min="1" name="qty">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
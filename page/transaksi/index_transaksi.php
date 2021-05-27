<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Transaksi </h1>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="pull-right"><a href="?halaman=transaksi&aksi=tambah" class="btn btn-success"> + Transaksi</a></span></h3>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Bisma</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th></th>
                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
                                foreach($query as $row){
                                $nama_customer=mysqli_fetch_array(mysqli_query($conn,"SELECT * from transaksi where id = '$row[nama_customer]'"));
                                    $kode=date_format(date_create($row['tanggal']),'ymd')*10000;
                                    $tanggal=date_format(date_create($row['tanggal']),'ymd')*10000;
                                    $no++;
                                    $kode=$row['id']+$kode;
                                    $kode="TR".$kode;
                                    $sum=0;
                                    $sql="SELECT * from detail_transaksi join barang on detail_transaksi.barang_id=barang.barang_id where detail_transaksi.transaksi_id='$row[id]'";
                                    $jml=mysqli_query($conn,$sql);
                                    foreach ($jml as $j) {
                                        $item=$j['qty']*$j['harga'];
                                        $sum += $item;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <a class="text-primary" href="?halaman=transaksi&aksi=detail&id=<?php echo $row['id']; ?>">
                                                #<?php echo $kode; ?>
                                            </a>
                                            <br>
                                            <span class="text-primary"><?php echo @$nama_customer['nama_customer'] ?></span>
                                            
                                            <!-- <span class="text-muted"> - <?php echo @$nama_customer[''] ?></span> --> 
                                        </td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td>Rp <?php echo number_format($sum,0,',','.'); ?></td>
                                       
                                        <td>
                                            <a href="?halaman=transaksi&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="?halaman=transaksi&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                            }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
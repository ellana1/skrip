<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Transaksi </h1>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="pull-right"><a href="?halaman=transaksi&aksi=tambah" class="btn btn-success"> + Pelanggan</a></span></h3>
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
                                $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
                                foreach($query as $row){
                                    $kode=date_format(date_create($row['tanggal']),'ymd')*10000;
                                    $tanggal=date_format(date_create($row['tanggal']),'ymd')*10000;
                                    $no++;
                                    $kode=$row['id_transaksi']+$kode;
                                    $kode="TR".$kode;
                                    $sum=0;
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td>
                                            <a class="text-primary" href="?halaman=transaksi&aksi=detail&id=<?php echo $row['id_transaksi']; ?>">
                                                #<?php echo $kode; ?>
                                            </a>
                                            <br>
                                            <span class="text-primary"><?php echo @$row['nama_customer'] ?></span>
                                        </td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td>Rp <?php echo number_format($row['total'],0,',','.'); ?></td>
                                        <td>
                                            <a href="?halaman=transaksi&aksi=edit&id=<?= $row['id_transaksi'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="?halaman=transaksi&aksi=delete&id=<?= $row['id_transaksi'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
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
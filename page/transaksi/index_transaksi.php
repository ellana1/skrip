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
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                //while ($row = mysqli_fetch_assoc($query)):
                                $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
                                $customer_id=mysqli_fetch_array(mysqli_query($conn,"SELECT * from customer where id = '$row[customer]'"));
                                foreach($query as $row){
                                    $customer_id=date_format(date_create($row['tanggal']),'ymd')*10000;
                                    $no++;
                                    $kode_barang=$row['id']+$kode_barang;
                                    $kode_barang="TR".$kode_barang;
                                    $sum=0;
                                    $jml=mysqli_query($conn,"SELECT * from detail_transaksi join barang on detail_transaksi.barang_id=barang.id where detail_transaksi.transaksi_id='$row[id]'");
                                    foreach ($jml as $j) {
                                        $item=$j['qty']*$j['harga'];
                                        $sum += $item;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['customer_id'] ?></td>
                                        <td><?= $row['nama_customer'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['harga'] ?></td>
                                        <td><?= $row['total'] ?></td>
                                       
                                        <td>
                                            <a href="?halaman=transaksi&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="?halaman=transaksi&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
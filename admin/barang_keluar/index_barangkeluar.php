<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Data Barang Keluar </h1>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="pull-right"><a href="?halaman=barang_keluar&aksi=tambah" class="btn btn-success">+ Barang Keluar</a></span></h3>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Barang Keluar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor barang</th>
                                    <th>Tanggal</th>
                                    <th>Penerima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "select * from barang_keluar";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($query)) :

                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['barang_id'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['penerima'] ?></td>
                                       
                                        <td>
                                            <a href="?halaman=barang_keluar&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="?halaman=barang_keluar&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endwhile; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
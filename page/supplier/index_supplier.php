<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Data Supplier </h1>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="pull-right"><a href="?halaman=supplier&aksi=tambah" class="btn btn-success"><i class="fa fa-user"></i> + Supplier</a></span></h3>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Supplier</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Produksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "select * from suppliers";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) :

                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['nama_perusahaan'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['produk'] ?></td>
                                    <td>
                                        <a href="?halaman=supplier&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="?halaman=supplier&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
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
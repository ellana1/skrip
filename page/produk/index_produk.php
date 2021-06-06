<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Produk Bisma Optima </h1>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="pull-right"><a href="?halaman=produk&aksi=tambah" class="btn btn-success"><i class="fa fa-cubes"></i> Tambah Data Produk</a></span></h3>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $no = 1;
                                $sql = "select * from barang";
                                $query = mysqli_query($conn, $sql);
                                foreach ($query as $row ):
                                    $kategori_id=mysqli_fetch_array(mysqli_query($conn,"SELECT * from kategori where id = '$row[kategori_id]'")); 
                                ?>
                                
                                    
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $kategori_id['nama_kategori']; ?></td>
                                            <td><?= $row['nama_barang'] ?>
                                                <br>
                                                <small class="text-muted">
                                                    <?php echo $row['kode_barang']; ?>
                                                </small>
                                            </td>
                                            <td><?= $row['stok_id'] ?></td>
                                            <td><?php echo "Rp. " . number_format($row['harga']); ?></td>
                                            


                                            <td>
                                                <a href="?halaman=produk&aksi=edit&id=<?= $row['barang_id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="?halaman=produk&aksi=delete&id=<?= $row['barang_id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                        // $no++;
                                    endforeach;?>
                           <!--  endwhile;  -->
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
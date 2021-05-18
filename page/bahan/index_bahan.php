<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"> Bahan Produk</h1>
    <div class="box-header">
        <h3 class="box-title"><span class="pull-right"><a href="?halaman=bahan&aksi=tambah" class="btn btn-success"><i class="fa fa-cube"></i> Tambah Bahan</a></span></h3>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bahan</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <!--  <div class="container  pull-up"> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Bahan</th>
                                                            <th>Satuan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $query = mysqli_query($conn, "SELECT * from bahan order by id desc");
                                                        $no = 1; ?>
                                                        <?php
                                                        foreach ($query as $row) :
                                                        ?>

                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row['nama_bahan']; ?></td>
                                                                <td><?php echo $row['satuan']; ?></td>
                                                                <td>
                                                                    <span class="float-right">

                                                                        <a href="?halaman=bahan&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                                        <a href="?halaman=bahan&aksi=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="fa fa-trash"></i></a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </section>
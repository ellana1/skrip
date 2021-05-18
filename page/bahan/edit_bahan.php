<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Bahan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Bahan</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php
                        $id = @$_GET['id'];
                        $sql = mysqli_query($conn, "SELECT *FROM Bahan where id = '$_GET[id]'") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql);
                        ?>
                    </div>
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bahan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Bahan" name="nama_bahan" required value="<?= $data['nama_bahan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Satuan" name="satuan" required value="<?= $data['satuan'] ?>">
                            </div>


                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $id = $_POST['id'];
                        $nama_bahan = $_POST['nama_bahan'];
                        $satuan = $_POST['satuan'];

                        $sql = "UPDATE bahan set nama_bahan='$nama_bahan', satuan='$satuan' where id='$id'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=bahan'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
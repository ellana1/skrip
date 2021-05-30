<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Data Supplier </h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Merubah Data Supplier</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <?php
                        $id = @$_GET['id'];
                        $sql = mysqli_query($conn, "SELECT *FROM suppliers where id = '$_GET[id]'") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql);
                        ?>
                    </div>
                    <form role="form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama_perusahaan" required value="<?= $data['nama_perusahaan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan alamat" name="alamat" required value="<?= $data['alamat'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Produk</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan produk" name="produk" required value="<?= $data['produk'] ?>">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $id_user = $_GET['id'];
                        $nama_perusahaan = $_POST['nama_perusahaan'];
                        $alamat = $_POST['alamat'];
                        $produk = $_POST['produk'];

                        $sql = "update suppliers set nama_perusahaan='$nama_perusahaan', alamat='$alamat', produk='$produk' where id='$id'";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=supplier'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Update Data Pegawai</h3>
                    <?php
                    $id = @$_GET['id'];
                    $sql = mysqli_query($conn, "SELECT * FROM pegawai where id_pegawai = '$_GET[id]'") or die(mysqli_error());
                    $data = mysqli_fetch_array($sql);
                    ?>
                </div>
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class=" box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required value="<?= $data['nama'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan alamat" name="alamat" required value="<?= $data['alamat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No.Telepon</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan nomor" name="telp" required value="<?= $data['telp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" required value="<?= $data['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="identity">Upload Foto Identitas Pegawai</label>
                            <input type="file" required name="foto" class="form-control input-lgn" accept="images/*">
                            <small style="color: red">Foto dengan format jpeg, jpg, atau png, serta tidak melebihi 1MB.</small>
                            <div style="height:15px;"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['simpan'])) {
                    $id = $_GET['id_pegawai'];
                    $nama = $_POST['nama'];
                    $foto = $_FILES['foto'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $foto_pegawai = $_FILES["foto"]["name"];
                    $gmbr_pegawai = $_FILES["foto"]["tmp_name"];
                    move_uploaded_file($gmbr_pegawai, "assets/img/pegawai/$foto_pegawai");
                    $sql = "INSERT INTO pegawai(nama,alamat,telp,username,password,foto) values('$nama','$alamat','$telp','$username','$password','$foto_pegawai')";
                    $conn->query($sql) or die(mysqli_error($conn));

                    $sql = "UPDATE pegawai set nama='$nama', foto='$foto',  alamat='$alamat', telp='$telp', username='$username', password='$password' where id_pegawai='$id'";
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "<script>alert('Data berhasil diubah!');window.location.href='?halaman=pegawai'</script>";
                    } else {
                        echo "Error : " . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
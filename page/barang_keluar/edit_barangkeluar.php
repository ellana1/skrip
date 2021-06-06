
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update Data Barang</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Data Barang</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                     <div class="box-header with-border">
                        <?php
                        $id = @$_GET['id'];
                        $sql = mysqli_query($conn, "SELECT *FROM barang_keluar where id = '$_GET[id]'") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql);
                        ?>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post">
                        <div class="box-body">
                             <div class="row">
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Jumlah keluar barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan jumlah barang" name="pengeluaran" required value="<?= $data['pengeluaran'] ?>">
                                        
                                </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Tanggal Input</label>
                                <input type="date" class="form-control input-lg" id="exampleInputEmail1" placeholder="date" name="tanggal" required value="<?= $data['tanggal'] ?>">
                            </div>
                            
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label>Nama Penerima</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama barang" name="penerima" required value="<?= $data['penerima'] ?>">
                            </div>
                            <div class="col-md-12 col-xs-12 form-group">
                                    <label>Keterangan</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Keterangan" name="keterangan" required value="<?= $data['keterangan'] ?>">
                            </div>
                            
                            
                                
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </form>
                    
                     <?php

                    if (isset($_POST['simpan'])) {
                        // $id = $_POST['id'];
                        $pengeluaran = $_POST['pengeluaran'];
                        $tanggal  = $_POST['tanggal'];
                        $penerima  = $_POST['penerima'];
                        $keterangan =$_POST['keterangan'];

                        
                        $sql = "UPDATE barang_keluar set pengeluaran='$pengeluaran', tanggal='$tanggal', penerima='$penerima', keterangan='$keterangan'where id='$id'"; 
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=barang_keluar'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
                <!-- /.box -->


            </div>


        </div>
    </div>
</div>
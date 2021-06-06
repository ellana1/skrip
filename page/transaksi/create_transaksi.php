     <?php
                    if (isset($_POST['simpan'])) { 
        
                        $nama_customer  = $_POST['nama_customer']; 
                        $tanggal  = $_POST['tanggal'];
                        // $harga = $_POST['harga'];
                        $total = $_POST['total'];

                        $sql = "INSERT into transaksi values(NULL, '$nama_customer', '$tanggal', '$total')";
                        $query = mysqli_query($conn, $sql);
                        if ($query) {
                            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='?halaman=transaksi'</script>";
                        } else {
                            echo "Error : " . mysqli_error($conn);
                        }
                    }
                    ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Transaksi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukan Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post">
                        <div class="box-body">
                             <div class="row">
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required="required">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pelanggan/Supplier</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Pelanggan" name="nama_customer" required>
                                        <!-- <select name="customer" class="custom-select">
                                            <option>--Pilih customer--</option>
                                            <?php $nama_customer=mysqli_query($conn,"SELECT * from customer"); ?>
                                            <?php foreach ($nama_customer as $row): ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_customer'] ?></option> 
                                            <?php endforeach ?> -->
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 col-xs-12 form-group">
                                    <button type="button" class="btn btn-warning" name="Kembali" onclick="window.history.back();">Kembali<i class="mdi mdi-keyboard-backspace"></i></button> -->
                                    <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            
                                </div>
                            
                                
                        </div>
                        <!-- /.box-body -->
                        <!-- <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div> -->
                    </form>
               
                </div>
                <!-- /.box -->


            </div>


        </div>
    </div>
</div>
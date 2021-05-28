<?php
@session_start();
include 'config/connection.php' ?>



<!DOCTYPE html>
<html lang="en">

<?php
(!empty($_SESSION)) ? header('Location: index.php') : false;

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-secondary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6" style="background-image: url('assets/images/bg-01.jpg');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to CV. Bisma Optima </h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" placeholder="Username" class="form-control form-control-user">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" placeholder="Password" class="form-control form-control-user">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                                            Login
                                        </button>
                                        <hr>

                                    </form>

                                    <?php
//                                     if (isset($_POST['login'])) {
//                                         $username = $_POST['username'];
//                                         $password = $_POST['pass'];
                                        
                                        if (isset($_POST['submit'])) {
                                        $user = $_POST['username'];
                                        $pass = $_POST['password'];

//                                         $sql = "SELECT * from user where username='$user' and password='$password'";
//                                         $query = mysqli_query($con, $sql);
//                                         $data = mysqli_fetch_assoc($query);
//                                         $row = mysqli_num_rows($query);

                                        $queryuser = mysqli_query($conn, "SELECT *FROM user WHERE username='$username' AND password='$password' AND level='admin'");
                                        $result1 = mysqli_fetch_assoc($queryuser);

                                        // var_dump($result1);

                                        
                                     if (!empty($result1)) {
                                        $_SESSION["admin"] = $result1;
                                        $_SESSION['user_id'] = $result1['id_user'];
                                        $_SESSION['username'] = $result1['username'];
                                        $_SESSION['password'] = $result1['password'];
                                        $_SESSION['nama'] = $result1['nama'];
                                        $_SESSION['level'] = 'admin';
                                        $_SESSION['is_login'] = true;
                                        header('location: index.php');
                                     if ($_SESSION['level']=='admin') {
                        echo "<script>alert('Login berhasil!');window.location.href='admin/index.php'</script>";  
                       }elseif ($_SESSION['level']=='pegawai') {
                         $pelatih=mysqli_fetch_array(mysqli_query($con,"SELECT * from pelatih where id_pegawai='$user'"));

                        $_SESSION['id_user']= $pegawai['id_pegawai'];
                        $_SESSION['nama_pegawai']   = $pegawai['nama_pelatih'];
                        $_SESSION['img']    = $pegawai['foto'];
                        $_SESSION['alamat']    = $pegawai['alamat']; 
                        $_SESSION['telp']    = $pegawai['telp'];
                        echo "<script>alert('Login berhasil!');window.location.href='admin/index.php'</script>";  
                        }else{
                         $murid=mysqli_fetch_array(mysqli_query($con,"SELECT * from supplier where id='$user'"));

                        $_SESSION['id_user']= $supplier['id'];
                        $_SESSION['name']   = $supplier['nama_perusahaan'];
                        $_SESSION['alamat']    = $supplier['alamat'];
                        $_SESSION["num"]    = 0;
      	                echo "<script>alert('Login berhasil!');window.location.href='index.php'</script>";  
      }

    }else{
      	echo "<script>alert('Username atau Password salah!')</script>";  
    }
}
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>

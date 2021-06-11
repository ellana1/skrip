<?php
@session_start();
// error_reporting(0);
include 'config/connection.php';
(!empty($_SESSION)) ?  false : header('Location: login.php');
// var_dump($_SESSION["level"]);
if (isset($_GET['logout'])) {
    // mysqli_query($conn,"UPDATE user set last_activity = null where id_user='".$_SESSION["id_user"]."'");
    session_destroy();
    $_SESSION['admin'] = '';
    header('Location:logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <title><?php echo $_GET['page']; ?> | Admin Page</title> -->
    <title>CV BISMOP | Admin Page</title>

    <!-- Custom fonts for this template-->
    <link href="assets/img/logo-bisma.png" rel="icon">

    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/plugins/dataTables/jquery.dataTables.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/plugins/dataTables/dataTables.bootstrap.css"> -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="admin-brand-content font-secondary">SISTEM INFORMASI PREDIKSI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if($_SESSION['admin']) : ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data User </span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User dan Pegawai :</h6>
                        <a class="collapse-item" href="?halaman=user">Data User</a>
                        <a class="collapse-item" href="?halaman=pegawai">Data Pegawai</a>
                        <!-- <a class="collapse-item" href="?halaman=user&aksi=tambah">Tambah Data User</a> -->

                    </div>
                </div>
            </li>
            <?php endif;?>
            <!-- ini page untuk supplier dan admin -->
            <?php if (($_SESSION['level']== 'supplier') || ($_SESSION['level'] =='admin')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="?halaman=supplier">
                    <i class="fas fa-fw fa-user" aria-hidden="true"></i>
                    <span>Supplier</span></a>
            </li>
            <?php endif;?>
            <!-- //ini page untuk pegawai dan admin -->
            <?php if ( ($_SESSION['level'] == 'pegawai') || ($_SESSION['level'] =='admin') || ($_SESSION['level'] == 'supplier')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="?halaman=stok">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    <span>Stok Barang</span></a>
            </li>
            

    <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-cube"></i>
                    <span>Kategori</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kategori:</h6>
                        <a class="collapse-item" href="?halaman=kategori">Kategori Barang</a>
                        <a class="collapse-item" href="?halaman=bahan">Bahan baku</a>
                    </div>
                </div>
            </li>
         <?php endif;?>
            <!-- Nav Item - Tables barang masuk dan keluar -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="?halaman=barang_masuk">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    <span>Barang Masuk</span></a>
            </li> -->
            
            <!-- Nav Item - Tables-->
            <?php if ( ($_SESSION['level'] == 'pegawai') || ($_SESSION['level'] =='admin')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="?halaman=barang_keluar">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span>Barang Keluar</span></a>
            </li>
            <?php endif;?>
            
            <!-- Nav Item ---->
            <?php if ($_SESSION['level']== 'admin'):  ?>
            <li class="nav-item">
                <a class="nav-link" href="?halaman=transaksi">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span>Transaksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="404.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Metode</span></a>
            </li> 
            <?php endif; ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if ( ($_SESSION['level'] == 'pegawai') || ($_SESSION['level'] =='admin')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    <span>Pelaporan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan:</h6>
                    
                        <a class="collapse-item" href="?halaman=pelaporan_barangkeluar">Lap. Barang Keluar</a>
                        <a class="collapse-item" href="?halaman=pelaporan_transaksi">Lap. Transaksi Penjualan</a>

                    </div>
                </div>
            </li>
        <?php endif;?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>-->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Pencarian disini..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Elin Marliana</span>
                                <img class="img-profile rounded-circle" src="assets/img/unsada.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Forgot Password?
                                </a> 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    // case adalah alamat url
                    $page = @$_GET['halaman'];
                    $aksi = @$_GET['aksi'];
                    $page = strtolower($page);
                    switch ($page) {
                        case 'user':
                            if ($aksi == "tambah") {
                                include 'page/user/create_user.php';
                            } elseif ($aksi == "edit") {
                                include 'page/user/edit_user.php';
                            } elseif ($aksi == "delete") {
                                include 'page/user/delete_user.php';
                            } else {
                                include 'page/user/index_user.php';
                            }
                            break;
                        // ini halaman pegawai
                        case 'pegawai':
                            if ($aksi == "tambah") {
                                include 'page/pegawai/create_pegawai.php';
                            } elseif ($aksi == "edit") {
                                include 'page/pegawai/edit_pegawai.php';
                            } elseif ($aksi == "delete") {
                                include 'page/pegawai/delete_pegawai.php';
                            } else {
                                include 'page/pegawai/index_pegawai.php';
                            }
                            break;

                        case 'stok':
                            if ($aksi == "tambah") {
                                include 'page/stok/create_barang.php';
                            } elseif ($aksi == "edit") {
                                include 'page/stok/edit_barang.php';
                            } elseif ($aksi == "delete") {
                                include 'page/stok/delete_barang.php';
                            } else {
                                include 'page/stok/index_barang.php';
                            }
                            break;

                       

                        case 'kategori':
                            if ($aksi == "tambah") {
                                include 'page/kategori/create_kategori.php';
                            } elseif ($aksi == "edit") {
                                include 'page/kategori/edit_kategori.php';
                            } elseif ($aksi == "delete") {
                                include 'page/kategori/delete_kategori.php';
                            } else {
                                include 'page/kategori/index_kategori.php';
                            }
                            break;

                        case 'bahan':
                            if ($aksi == "tambah") {
                                include 'page/bahan/create_bahan.php';
                            } elseif ($aksi == "edit") {
                                include 'page/bahan/edit_bahan.php';
                            } elseif ($aksi == "delete") {
                                include 'page/bahan/delete_bahan.php';
                            } else {
                                include 'page/bahan/index_bahan.php';
                            }
                            break;

                       
                            case 'barang_keluar':
                            if ($aksi == "tambah") {
                                include 'page/barang_keluar/create_barangkeluar.php';
                            } elseif ($aksi == "edit") {
                                include 'page/barang_keluar/edit_barangkeluar.php';
                            } elseif ($aksi == "delete") {
                                include 'page/barang_keluar/delete_barangkeluar.php';
                            } else {
                                include 'page/barang_keluar/index_barangkeluar.php';
                            }
                            break;

                            case 'transaksi':
                        if ($aksi == "tambah") {
                            include 'page/transaksi/create_transaksi.php';
                        } elseif ($aksi == "edit") {
                            include 'page/transaksi/edit_transaksi.php';
                        } elseif ($aksi == "delete") {
                            include 'page/transaksi/delete_transaksi.php';
                        } elseif ($aksi == "detail") {
                            include 'page/transaksi/detail_transaksi.php';
                        } else {
                            include 'page/transaksi/index_transaksi.php';
                        }
                        break;

                        case 'supplier':
                        if ($aksi == "tambah") {
                            include 'page/supplier/create_supplier.php';
                        } elseif ($aksi == "edit") {
                            include 'page/supplier/edit_supplier.php';
                        } elseif ($aksi == "delete") {
                            include 'page/supplier/delete_supplier.php';

                        } else {
                            include 'page/supplier/index_supplier.php';
                        }
                        break;

                        // case 'pelaporan_barangmasuk':
                        // include 'page/pelaporan/pelaporan_barangmasuk.php';
                        // break;
                        case 'pelaporan_barangkeluar':
                        include 'page/pelaporan/pelaporan_barangkeluar.php';
                        break;
                        case 'pelaporan_transaksi':
                        include 'page/pelaporan/pelaporan_transaksi.php';
                        break;

                        default:
                        include 'page/home/index_home.php';
                    }
                    ?>
                </div>


                <!-- Begin Page Content -->
                <div class="container-fluid">


                </div>
                <!-- Content Row -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; elana with SB <?= date("Y") ?></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin meninggalkan halaman ini?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" untuk mengakhiri sesi atau tidak pilih "cancel"</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->

        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
        <!-- <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script> -->

        <!-- Page level plugins -->
        <script src="assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/chart-area-demo.js"></script>
        <script src="assets/js/demo/chart-pie-demo.js"></script>
        <script>
            $(function() {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>

</body>

</html>
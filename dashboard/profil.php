<?php
include '../config/config.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="../asets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asets/css/sb-admin-2.min.css" rel="stylesheet">
   
</head>
 <!-- Buat Sort Datatables-->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">  

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $pages = "kegiatan"; include "../menu/sidebar.php" ;?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "../menu/navbar.php" ;?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h2 mb-2 text-gray-800"> Hello <?=$_SESSION['user'];?> !</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h4 class="m-0 text-gray-900y">Sampel Petugas</h4>
                        </div>
                        <div class="card-body">
                        <div class="card text-gray-900">
                            <div class="table-responsive">
                                <table class="display table table-hover" id="dataTable" width="100%" cellspacing="0" >
                                    <thead class="table-light">
                                        <tr>
                                            <td>Nama Survei</td>
                                            <td>Responden</td>
                                            <td>Jenis Lapangan Usaha/Responden</td>
                                            <td>KBLI/Jenis Lembaga</td>
                                            <td>Desa</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
                                $id_user = $_SESSION['id_user'];
                                $sql4 = mysqli_query($conn, "SELECT*FROM user JOIN daftarsampelnwas ON user.id_user = daftarsampelnwas.id_pencacah WHERE id_user = '$id_user'");
                                while ($row4 = mysqli_fetch_array($sql4)) {
                                    $survei = $row4['survei'];
                                    $responden = $row4['responden'];
                                    $jenis_lapus = $row4['jenis_lapus'];
                                    $kbli = $row4['kbli'];
                                    $desa = $row4['desa'];
                                    ?>
                                    <tr>
                                        <td><?=$survei;?></td>
                                         <td><?=$responden;?></td>
                                         <td><?=$jenis_lapus;?></td>
                                         <td><?=$kbli;?></td>
                                         <td><?=$desa;?></td>
                                     </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <script src= "https://code.jquery.com/jquery-3.5.1.js"></script> -->
                        <script src= "https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src= "https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                        <script src= "https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                        <script>
                            $(document).ready(function () {
                            $('#example').DataTable();
                            });
                        </script>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php include "../menu/footer.php" ;?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


 <!-- Bootstrap core JavaScript-->
 <script src="../asets/vendor/jquery/jquery.min.js"></script>
    <script src="../asets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src= "https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src= "https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script> $(document).ready(function () {$('#dataTable').DataTable();});</script>

    <!-- Core plugin JavaScript-->
    <script src="../asets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asets/js/sb-admin-2.min.js"></script>

</body>

</html>
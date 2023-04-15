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

    <title>Si Caca - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../asets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../asets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $pages = "dashboard"; include "../menu/sidebar.php" ;?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "../menu/navbar.php" ;?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card text-gray-800">
                                <div class="card-body">
                                    <h5 class="card-title">Kegiatan Survei</h5>
                                    <div class="table-responsive">
                                        <table id="example2" class="display table">
                                            <thead>
                                                <td>Kegiatan Pencacahan</td>
                                                <td>Batas Waktu</td>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                        $sql = mysqli_query($conn,"SELECT desc_survey.id_survei as survei,desc_survey.berakhir as batas,desc_survey.target as jml_responden,COUNT(CASE WHEN survei_tahunan_nwas.status = 'tercacah' then 1 ELSE NULL END) as tercacah FROM `desc_survey` LEFT OUTER JOIN `survei_tahunan_nwas` ON `desc_survey`.`id_survei` = `survei_tahunan_nwas`.`survei` GROUP BY desc_survey.id_survei;");
                                                        if ($sql!= false && $sql->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                $survei = $row['survei'];
                                                                $batas = $row['batas'];
                                                                $jml_responden = $row['jml_responden'];
                                                                $tercacah = $row['tercacah'];
                                                                $persen = round($tercacah*100/$jml_responden);
                                                                ?>
                                                                <tr>
                                                                    <td><?=$survei;?><br><br>
                                                                    <?php
                                                                    if ($tercacah == 0) {
                                                                        
                                                                    } else if ($persen >= 1 && $persen <= 33){
                                                                        ?>
                                                                            <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: <?=$persen;?>%;" aria-valuenow="<?=$persen;?>" aria-valuemin="0" aria-valuemax="100"><?=$persen;?>%</div>
                                                                            </div>
                                                                        <?php
                                                                    } else if ($persen >= 34 && $persen <= 66){
                                                                        ?>
                                                                            <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: <?=$persen;?>%;" aria-valuenow="<?=$persen;?>" aria-valuemin="0" aria-valuemax="100"><?=$persen;?>%</div></div>
                                                                        <?php
                                                                    } else if ($persen >= 67 && $persen <= 100){
                                                                        ?>
                                                                            <div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?=$persen;?>%;" aria-valuenow="<?=$persen;?>" aria-valuemin="0" aria-valuemax="100"><?=$persen;?>%</div></div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                    <td><?=$batas;?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-gray-800">
                                <div class="card-body">
                                    <h5 class="card-title">Record Pencacahan</h5>
                                    <div class="table-responsive">
                                        <table id="example" class="display table">
                                            <thead>
                                                <td>Tanggal</td>
                                                <td>Nama</td>
                                                <td>Survei</td>
                                                <td>Responden</td>
                                                <td>Jenis Lapus</td>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql2 = mysqli_query($conn,"SELECT user.user as nama_user,survei_tahunan_nwas.survei as nama_survei,survei_tahunan_nwas.responden as nama_responden,survei_tahunan_nwas.jenis_lapus as jenis_lapus,survei_tahunan_nwas.update_tanggal as update_tanggal FROM `user` LEFT JOIN survei_tahunan_nwas ON survei_tahunan_nwas.id_pencacah = user.id_user WHERE survei_tahunan_nwas.status <> ''");
                                                    if ($sql2!= false && $sql2->num_rows > 0) {
                                                        while ($row2 = mysqli_fetch_array($sql2)) {
                                                        $nama_user = $row2['nama_user'];
                                                        $nama_survei = $row2['nama_survei'];
                                                        $nama_responden = $row2['nama_responden'];
                                                        $jenis_lapus = $row2['jenis_lapus'];
                                                        $update_tanggal = $row2['update_tanggal'];
                                                        ?>
                                                            <tr>
                                                                <td><?=$update_tanggal;?></td>
                                                                <td><?=$nama_user;?></td>
                                                                <td><?=$nama_survei;?></td>
                                                                <td><?=$nama_responden;?></td>
                                                                <td><?=$jenis_lapus;?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <!-- Core plugin JavaScript-->
    <script src="../asets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asets/js/sb-admin-2.min.js"></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollY: '900px',
                scrollCollapse: true,
                paging: false,
                searching: false,
                info: false,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                scrollY: '900px',
                scrollCollapse: true,
                paging: false,
                searching: false,
                info: false,
            });
        });
    </script>


</body>

</html>
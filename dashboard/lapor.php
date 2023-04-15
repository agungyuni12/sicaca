<?php
include '../config/config.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}


$link2 = isset($_GET['link']) ? $_GET['link'] : '';
$dec_link2=base64_decode($link2);
$ambil_variabel = explode("&",$dec_link2);

$responden2 = isset($ambil_variabel[0]) ? $ambil_variabel[0] : '';
$survei2 = isset($ambil_variabel[1]) ? $ambil_variabel[1] : '';
$alamat2 = isset($ambil_variabel[2]) ? $ambil_variabel[2] : '';
$p_informasi2 = isset($ambil_variabel[3]) ? $ambil_variabel[3] : '';
$pilih2 = isset($ambil_variabel[4]) ? $ambil_variabel[4] : '';

?>
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Si Caca - Lapor Kegiatan</title>

    <!-- Custom fonts for this template-->
    <link href="../asets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $pages = "lapor"; include "../menu/sidebar.php" ;?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "../menu/navbar.php" ;?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Lapor Cacah</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="kirim.php" id="form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_pcl" id="id_pcl" value = "<?=$_SESSION['id_user']?>"/>
                                <div class="form-group form-floating">
                                <?php
                                $id_user = $_SESSION['id_user'];
                                $sql = mysqli_query($conn,"SELECT user FROM user WHERE id_user = '$id_user'");
                                $row = $sql->fetch_assoc();
                                $user = $row['user'];
                                ?>                                   
                                    <input type="text" class="form-control" id="user" placeholder="name@example.com" value = "<?= $user;?>" name= "user" readonly>
                                    <label for="user">Nama Petugas</label>
                                </div>
                                <div class="form-group form-floating text-center">
                                    <h5>Apakah sampel survei sudah ditetapkan sebelumnya</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pilih1" id="pilih1" value="ya" <?=$pilih2 == "ya" ? ' checked="checked"' : '';?>>
                                        <label class="form-check-label" for="pilih1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pilih1" id="pilih2" value="tidak">
                                        <label class="form-check-label" for="pilih2">Tidak</label>
                                    </div>
                                </div>
                                    <div class="tetap1" name=tetap1 id="tetap1">
                                        <div class="form-group form-floating">
                                            <select onchange = "kirim_survei(this.options[this.selectedIndex].value)" class = "form-control" name="survei" id="survei">
                                                            <option value="">Pilih Survei</option>
                                                <?php
                                                    $sql2 = mysqli_query($conn,"SELECT DISTINCT (survei) as survei FROM `survei_tahunan_nwas` WHERE id_pencacah = '$id_user'");
                                                    if ($sql2!= false && $sql2->num_rows > 0) {
                                                        while ($row2 = mysqli_fetch_array($sql2)) {
                                                        $survei = $row2['survei'];
                                                        ?>
                                                            <option value="<?=$survei;?>" <?=$survei == $survei2 ? ' selected="selected"' : '';?>><?=$survei;?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>  
                                            <label for="floatingInput">Survei</label>                                 
                                        </div>
                                        <div class="form-group form-floating">
                                            <select onchange = "ganti_jlus(this.options[this.selectedIndex].value)" class = "form-control" name="responden" id="responden">
                                                            <option value="">Pilih Responden</option>
                                                <?php
                                                    $sql2 = mysqli_query($conn,"SELECT DISTINCT (responden) as responden FROM `survei_tahunan_nwas` WHERE id_pencacah = '$id_user' AND survei = '$survei2'");
                                                    if ($sql2!= false && $sql2->num_rows > 0) {
                                                        while ($row2 = mysqli_fetch_array($sql2)) {
                                                        $responden = $row2['responden'];
                                                        ?>
                                                            <option value="<?=$responden;?>" <?=$responden == $responden2 ? ' selected="selected"' : '';?>><?=$responden;?></option>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>  
                                            <label for="floatingInput">Responden</label>  
                                        </div>
                                        <?php
                                        $sql = mysqli_query($conn,"SELECT jenis_lapus FROM `survei_tahunan_nwas` WHERE responden = '$responden2'");
                                        if ($sql!= false && $sql->num_rows > 0) {
                                        $row = $sql->fetch_assoc();
                                        $jenis_lapus = $row['jenis_lapus'];
                                        } else{
                                            $jenis_lapus = "";
                                        }
                                        ?>     
                                        <div class="form-group form-floating">                                   
                                            <input type="text" class="form-control" id="jlus" name="jlus" placeholder="name@example.com" value = "<?=$jenis_lapus;?>" readonly>
                                            <label for="jlus">Jenis Lapangan Usaha/Sampel</label>
                                        </div>
                                    </div>
                                    <div class="tetap2 d-none" name="tetap2" id="tetap2">
                                        <div class="form-group form-floating">                             
                                            <input type="text" class="form-control" id="survei7" placeholder="name@example.com" name= "survei7">
                                            <label for="user">Nama Survei</label>
                                        </div>
                                        <div class="form-group form-floating">                             
                                            <input type="text" class="form-control" id="responden7" placeholder="name@example.com" name= "responden7">
                                            <label for="user">Nama Responden</label>
                                        </div>
                                        <div class="form-group form-floating">                             
                                            <input type="text" class="form-control" id="jlus7" placeholder="name@example.com" name= "jlus7">
                                            <label for="user">Jenis Lapangan Usaha/Sampel</label>
                                        </div>
                                    </div>
                                <div class="form-group form-floating">                                   
                                    <input type="text" id="alamat" name="alamat" class="form-control" id="floatingInput" placeholder="name@example.com" value = "<?=$alamat2;?>">
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="form-group form-floating">                                   
                                    <input type="text" id="p_informasi" name="p_informasi" class="form-control" id="floatingInput" placeholder="name@example.com" value = "<?=$p_informasi2;?>">
                                    <label for="floatingInput">Pemberi Informasi</label>
                                </div>
                                        
                                        <button type="submit" name="kirim" id="kirim" class="btn btn-info btn-user btn-block">Kirim</button>
                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>
    <script>
        $('input:radio[name="pilih1"]').change(function(){

            if ($(this).val() == 'ya') {
                $(".tetap1").removeClass("d-none");
                $(".tetap2").addClass("d-none");
            }
            else if($(this).val() == 'tidak') {
                $(".tetap2").removeClass("d-none");
                $(".tetap1").addClass("d-none");
            }
            });
    </script>
    <script>
        function ganti_jlus(value) {
            var survei_e = document.getElementById("survei");
            var survei_e_value = survei_e.options[survei_e.selectedIndex].value;
            var alamat = document.getElementById("alamat").value;
            var p_informasi = document.getElementById("p_informasi").value;
            var pilih1 = document.getElementById('pilih1').value;

            var link = btoa(value+"&"+survei_e_value+"&"+alamat+"&"+p_informasi+"&"+pilih1)
            window.location.href = "?link="+link;

        }
    </script>
    <script>
        function kirim_survei(value) {
            var survei_e = document.getElementById("survei");
            var survei_e_value = survei_e.options[survei_e.selectedIndex].value;
            var alamat = document.getElementById("alamat").value;
            var p_informasi = document.getElementById("p_informasi").value;
            var pilih1 = document.getElementById('pilih1').value;

            var link = btoa(value+"&"+survei_e_value+"&"+alamat+"&"+p_informasi+"&"+pilih1)
            window.location.href = "?link="+link;

        }
    </script>

    <script>
      $(document).ready(function(){
        $('#form').on('submit',function(e){
            e.preventDefault();
            var pilih1 = $("input[name='pilih1']:checked").val();

            if (pilih1 == "tidak") {
                var pilih7 = "tidak";
                var id_pcl = $("#id_pcl").val();
                var survei7 = $("#survei7").val();
                var responden7 = $("#responden7").val();
                var jlus7 = $("#jlus7").val();
                var alamat = $("#alamat").val();
                var p_informasi = $("#p_informasi").val();
                if (survei7 == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama survei tidak boleh kosong",
                    })
                } else if (responden7 == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama Responden tidak boleh kosong",
                    })
                } else if (jlus7 == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Jenis Lapangan Usaha/Sampel tidak boleh kosong",
                    })
                } else if (alamat == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Alamat tidak boleh kosong",
                    })
                } else if (p_informasi == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama Pemberi Informasi tidak boleh kosong",
                    })
                } else{

                    $.ajax({
                    url:"kirim.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    }).done(function(resp) {
                    Swal.fire({
                        icon:"success",
                        title:"Berhasil ",
                        text:"Data berhasil disimpan",
                    }).then(function() {
                    window.location = "index.php";
                    });
                    })
                }

            } else{
                var pilih7 = "ya";
                var id_pcl = $("#id_pcl").val();
                var survei = $("#survei").val();
                var responden = $("#responden").val();
                var jlus = $("#jlus").val();
                var alamat = $("#alamat").val();
                var p_informasi = $("#p_informasi").val();
                if (survei == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama survei tidak boleh kosong",
                    })
                } else if (responden == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama Responden tidak boleh kosong",
                    })
                } else if (alamat == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Alamat tidak boleh kosong",
                    })
                } else if (p_informasi == "") {
                    Swal.fire({
                        icon:"error",
                        title:"Gagal",
                        text:"Nama Pemberi Informasi tidak boleh kosong",
                    })
                } else{

                    $.ajax({
                    url:"kirim.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    }).done(function(resp) {
                    Swal.fire({
                        icon:"success",
                        title:"Berhasil ",
                        text:"Data berhasil disimpan",
                    }).then(function() {
                    window.location = "index.php";
                    });
                    })
                }
            }
        });
      });
    </script>
</body>

</html>
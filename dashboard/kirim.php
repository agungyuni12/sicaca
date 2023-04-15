<?php
include '../config/config.php';

$pilih1 = $_POST ['pilih1'];
$id_pcl = $_POST ['id_pcl'];
$survei = $_POST ['survei'];
$responden = $_POST ['responden'];
$jlus = $_POST ['jlus'];
$survei7 = $_POST ['survei7'];
$responden7 = $_POST ['responden7'];
$jlus7 = $_POST ['jlus7'];
$alamat = $_POST ['alamat'];
$p_informasi = $_POST ['p_informasi'];

if ($pilih1 == "tidak") {
    $sql = mysqli_query($conn,"INSERT INTO `survei_tahunan_nwas`(`id_pencacah`,`responden`, `survei`,`jenis_lapus`, `alamat`, `p_informasi`, `status`,`update_tanggal`) VALUES ('$id_pcl','$responden7','$survei7','$jlus7','$alamat','$p_informasi','tercacah',now())");
} else{
    $sql = mysqli_query($conn,"UPDATE `survei_tahunan_nwas` SET `alamat` = '$alamat',`p_informasi` = '$p_informasi',`status` = 'tercacah',`update_tanggal` = now() WHERE `survei` = '$survei' AND `responden` = '$responden'");
}
?>
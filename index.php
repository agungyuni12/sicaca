<?php
include 'config/config.php';

session_start();

if (isset($_SESSION['user'])) {
	header('location: dashboard/index.php');
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

    <title>Si Caca - Login</title>

    <!-- Custom fonts for this template-->
    <link href="asets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="asets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">

</head>

<body style="background-image:url('asets/img/bgawal.jpg'); background-position: center; background-size: cover">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background-image:url('asets/img/Page1.jpg'); background-position: center; background-size: cover;">
                                <h2 class="text-center mt-5 text-gray-900 mb-2">Welcome to Si Caca!</h2>
                                <h6 class="text-center text-black-900 mb-4">Sistem Monitoring Pencacahan Survei Tahunan Neraca</h6>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="text-center mt-5 text-gray-900 mb-2">Welcome to Si Caca!</h3>
                                        <h7 class="text-center text-black-900 mb-4">Sistem Monitoring Pencacahan Survei Tahunan Neraca</h7>
                                    </div>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Masukkan ID User" autofocus>
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control form-control-user" name ="password"
                                                id="password" placeholder="Password">
                                        </div>
                                        
                                        <button type="submit" name="login" id="login" class="btn btn-info btn-user btn-block">Login</button>
                                
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                         <a class="big" href="https://wa.me/6287765618923"><i class="fab fa-whatsapp"></i> Butuh Bantuan? </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asets/vendor/jquery/jquery.min.js"></script>
    <script src="asets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>

    <?php

if (isset($_POST['login'])) {
	$username = $_POST['username'];;
	$password = md5($_POST['password']);

	$sql = mysqli_query($conn,"SELECT * FROM user WHERE id_user = '$username' AND password = '$password'");
	if ($sql!= false && $sql->num_rows > 0) {
		$row = $sql->fetch_assoc();
		$_SESSION ['id_user'] = $row['id_user'];
		$_SESSION ['user'] = $row['user'];
		?>
			<script>
			Swal.fire({
				icon:"success",
				title:"Succes",
				text:"Congrats, youre in!"
			}).then(function() {
				window.location = "dashboard/index.php";

			})
			</script>
		<?php

	} else{
	    	?>
			<script>
			Swal.fire({
				icon:"error",
				title:"Error",
				text:"Wrong username or password"
			}).then(function() {
				window.location = "index.php";

			})
			</script>
		<?php
	}
}

?>

</body>

</html>
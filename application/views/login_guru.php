<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login Raport| </title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url() . "templates/"; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo base_url() . "templates/"; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="<?php echo base_url() . "templates/"; ?>vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Animate.css -->
	<link href="<?php echo base_url() . "templates/"; ?>vendors/animate.css/animate.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="<?php echo base_url() . "templates/"; ?>build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>

		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form>
						<h1>Login Guru Form</h1>
						<div>
							<input type="text" class="form-control" placeholder="Username" id="username" required="" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Password" id="password" required="" />
						</div>
						<div>
							<a class="btn btn-default submit" type="submit" id="loginBtn">Log in</a>
							<a class=" reset_pass" href="#">Lost your password?</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<!-- <p class="change_link">New to site?
								<a href="#signup" class="to_register"> Create Account </a>
							</p> -->

							<div class="clearfix"></div>
							<br />

							<div>
								<h1><img src=" <?php echo base_url() . "assets/images/CIF.png"; ?>" alt=""> Raport Online</h1>
								<p>2020</p>
							</div>
						</div>
					</form>
				</section>
			</div>

			<div id="register" class="animate form registration_form">
				<section class="login_content">
					<form>
						<h1>Create Account</h1>
						<div>
							<input type="text" class="form-control" placeholder="Username" required="" />
						</div>
						<div>
							<input type="email" class="form-control" placeholder="Email" required="" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="Password" required="" />
						</div>
						<div>
							<a class="btn btn-default submit" href="index.html">Submit</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">Already a member ?
								<a href="#signin" class="to_register"> Log in </a>
							</p>

							<div class="clearfix"></div>
							<br />


						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>

</html>
<!-- jQuery -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url() . "templates/"; ?>vendors/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url() . "templates/"; ?>build/js/custom.min.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url() . "templates/"; ?>/vendors/pdfmake/build/vfs_fonts.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
	$(document).ready(function() {
		<?php $bu = base_url() ?>
		$('#loginBtn').on('click', function() {
			var username = $('#username').val();
			var password = $('#password').val();

			// console.log(re);

			if (username.length < 1 || password.length < 1) {
				var message = 'Silahkan ketikkan username dan password Anda.';
				$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

			} else {
				$('#loginBtn').html('<i class="fas fa-spinner fa-spin"></i> Tunggu..');
				$('#loginBtn').prop('disabled', true);
				// alert("gagal-")
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: "<?php echo $bu; ?>Guru/login_proses",
					data: {
						username: username,
						password: password,
					},
				}).done(function(e) {
					// console.log(e);
					if (e.status) {
						$('#username').val('');
						$('#password').val('');

						Swal.fire(
							'Login Berhasil!',
							e.message,
							'success'
						)

						$('#alertNotif').html('<div class="alert alert-success alert-dismissible show" role="alert"><span>' + e.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						setTimeout(() => {
							window.location = '<?= $bu ?>dashboard';
						}, 1000);
					} else {
						Swal.fire(
							'Gagal!',
							e.message,
							'error'
						);

						$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + e.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
				}).fail(function(e) {
					var message = 'Terjadi Kesalahan.';
					$('#alertNotif').html('<div class="alert alert-danger alert-dismissible show" role="alert"><span>' + message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}).always(function() {
					// toAlert();
					// resetButton()
				});
			}
			// return false;;
		});
	});
</script>

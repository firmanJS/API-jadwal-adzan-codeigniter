<!DOCTYPE html>
<html lang="en">
<base href="<?php echo site_url();?>">
<head>
	<title>API Jadwal Adzan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h3>Jadwal Shalat</h3>
		<ul class="nav nav-tabs">
			<li class="active" ><a href="#ajax" data-toggle="tab">Example Ajax & PHP</a></li>
			<li><a href="#angular" data-toggle="tab">Example Angularjs</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="ajax">
				<div class="container">
					<form id="submitForm" method="post">
						<div class="form-group">
							<label for="email">Kota</label>
							<input type="text" class="form-control" name="kota">
						</div>
						<div class="form-group">
							<label for="pwd">Bulan</label>
							<input type="number" class="form-control" name="bulan">
						</div>
						<div class="form-group">
							<label for="pwd">Tahun</label>
							<input type="number" class="form-control" name="tahun">
						</div>
						<button type="button" id="cek" class="btn btn-default">Submit</button>
					</form>
					<center id="loader">
						<img src="public/loader.gif" alt="" style="max-width: 100px;">
					</center>
					<div id="showData">
						
					</div>
				</div>
			</div>
			<div class="tab-pane" id="angular">
				<h3>Coming Soon !</h3>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		"use strict";
		$("#showData").html("");
		$("#loader").hide();
		$("#cek").click(function(event) {
			$("#showData").html("");
			$("#loader").show();
			$.ajax({
				type: 'POST',
				url: 'adzan/getjadwal',
				data: $("#submitForm").serializeArray(),
				success: function (res) {
					$("#loader").hide();
					$("#showData").html(res.html);
				},
				error: function (res) {
					$("#showData").html("");
					$("#loader").hide();
				}
			});
		});
	</script>
</body>
</html>

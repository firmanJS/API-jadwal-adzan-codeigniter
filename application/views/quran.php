<!DOCTYPE html>
<html lang="en" ng-app="AdzanApp">
<base href="<?php echo site_url();?>">
<head>
	<title>API List Al-Qur'an</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h3>List Al-Qur'an</h3>
		<ul class="nav nav-tabs">
			<li class="active" ><a href="#ajax" data-toggle="tab">Example Ajax & PHP</a></li>
		</ul>
		<div class="tab-content" >
			<div class="tab-pane active" id="ajax">
				<div class="container">
					<button type="button" id="cek" class="btn btn-default">Get Data</button>
					<center id="loader">
						<img src="public/loader.gif" alt="" style="max-width: 100px;">
					</center>
					<div id="showData">
						
					</div>
				</div>
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
		$.getJSON('https://al-quran-8d642.firebaseio.com/data.json?print=pretty', function(res){
			$("#loader").hide();
			var html = "<h3>List Surat Al-Qur'an</h3><ul class='list-group'>";
			$.each(res, function(i, r){
				html +="<li class='list-group-item'>"+r.nomor+ " . "+ r.nama +" "+ r.asma + " ("+r.arti+")"+"<br><br> ";
				html +="<p style='text-align:justify;'>"+r.keterangan+"</p> <br>";
				html +=" <audio controls> <source src="+r.audio+"> </audio></li>";
			});
			html += "</ul>"; 
			$("#showData").append(html);
			
		});
	});
	</script>
</body>
</html>

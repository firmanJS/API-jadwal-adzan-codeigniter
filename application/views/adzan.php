<!DOCTYPE html>
<html lang="en" ng-app="AdzanApp">
<base href="<?php echo site_url();?>">
<head>
	<title>API Jadwal Adzan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>
</head>
<body>

	<div class="container" ng-controller="adzanctrl">
		<h3>Jadwal Shalat</h3>
		<ul class="nav nav-tabs">
			<li class="active" ><a href="#ajax" data-toggle="tab">Example Ajax & PHP</a></li>
			<li><a href="#angular" ng-click="angularTab()" data-toggle="tab">Example Angularjs</a></li>
		</ul>
		<div class="tab-content" >
			<div class="tab-pane active" id="ajax">
				<div class="container">
					<form id="submitForm" method="post">
						<div class="form-group">
							<label for="email">Kota</label>
							<input type="text" class="form-control" name="kota">
						</div>
						<div class="form-group">
							<label for="pwd">Bulan</label>
							<select class="form-control" name="bulan">
							<?php $noBulan = 1; for($index=0; $index<12; $index++){ ?>
								<option value="<?php echo $noBulan;?>"><?php echo $namaBulan[$index];?></option>
								<?php $noBulan++; } ?>		
							</select>
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
			<div class="tab-pane active" id="angular" >
				<div class="container">
					<form ng-show="FormAngular" method="post">
						<div class="form-group">
							<label for="email">Kota</label>
							<input type="text" class="form-control" ng-model="kota">
						</div>
						<div class="form-group">
							<label for="pwd">Bulan</label>
							<select class="form-control" ng-model="bulan">
							<?php $noBulan = 1; for($index=0; $index<12; $index++){ ?>
								<option value="<?php echo $noBulan;?>"><?php echo $namaBulan[$index];?></option>
								<?php $noBulan++; } ?>		
							</select>
						</div>
						<div class="form-group">
							<label for="pwd">Tahun</label>
							<input type="number" class="form-control" ng-model="tahun">
						</div>
						<button type="button" ng-click="cekAngular()" class="btn btn-default">Submit</button>
					</form>
					<center id="loader" ng-show="angularLoader">
						<img src="public/loader.gif" alt="" style="max-width: 100px;">
					</center>
					<div id="showData">
						
					</div>
					<div ng-show="showDataAngular" ng-bind-html="GetData | safeHtml">
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
	const app = angular.module('AdzanApp',[]);
	app.controller('adzanctrl', function($http,$scope){
		$scope.FormAngular = false;
		$scope.showDataAngular = false;
		$scope.angularLoader = false;
		$scope.angularTab = function(){
			$scope.FormAngular = true;
		}
		$scope.cekAngular = function(){
			var formData = { 'kota': $scope.kota, 'bulan' : $scope.bulan ,'tahun' : $scope.tahun };
			var postData = 'myData='+JSON.stringify(formData);
			$scope.GetData = "";
			$http(
				{
					method : 'POST',
					url : 'adzan/getjadwalAngular',
					data: formData,
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					
				}).then(function successCallback(response) {
					$scope.showDataAngular = true;
					$scope.GetData = response.data.html;
				}, function errorCallback(response) {
				});
			}
		});
		app.filter('safeHtml', function ($sce) {
			return function (val) {
				return $sce.trustAsHtml(val);
			};
		});
		</script>
</body>
</html>

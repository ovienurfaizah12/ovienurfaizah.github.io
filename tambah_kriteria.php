<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

?>

<?php

 ?>

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ovie Nur Faizah | Sistem Pendukung Keputusan</title>
  	<link rel="icon" href="https://cdn.dribbble.com/users/43342/screenshots/2963701/logo2.jpg" type="image/png">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script>
		function validateForm() {
			let nama = document.forms["form-kriteria"]["nama"].value;
			let sub1 = document.forms["form-kriteria"]["sub1"].value;
			let sub2 = document.forms["form-kriteria"]["sub2"].value;
			let sub3 = document.forms["form-kriteria"]["sub3"].value;
			if(nama.indexOf(' ') >= 0 || sub1.indexOf(' ') >= 0 || sub2.indexOf(' ') >= 0 || sub3.indexOf(' ') >= 0){
				alert("Nama kriteria dan sub-kriteria tidak boleh mengandung spasi, gunakan underscore ' _ ' sebagai pengganti.");
				return false;
			}
		}
	</script>
</head>

<style type="text/css">
	#home{
		text-align: center;
		background-image: url("https://www.thenology.com/wp-content/uploads/2014/07/1500x500-New-York-Skyline-Twitter-Header0027.jpg");  
		background-size: cover;
	}
	p{
		font-size: 20px;
	}
	
	input[type="reset"]{
	margin-bottom: 28px;
	width: 120px;
	height: 32px;
	background: #F44336;
	border: none;
	border-radius: 2px;
	color: #fff;
	font-family: sans-serif;
	text-transform: uppercase;
	transition: 0.2s ease;
	cursor: pointer;
	}
	input[type="submit"]{
	margin-bottom: 28px;
	width: 120px;
	height: 32px;
	background: #39f436;
	border: none;
	border-radius: 2px;
	color: #fff;
	font-family: sans-serif;
	text-transform: uppercase;
	transition: 0.2s ease;
	cursor: pointer;
	}
	font2{
		font-size: 17px;
		padding-left: 50px;
	}

	body{
    background-color: #FFDAB9;
	}
	h1{
		text-shadow: 1px 1px #000000;
	}
	a { color: inherit; }
	a:hover { color: inherit; } 

</style>

<body>
	<div class='container mt-5'>
		<div class="jumbotron" id='home'>
			<h1 class="text-light shadow-lg"><a href="index.php">Sistem Pendukung Keputusan Metode Fuzzy Logic</a></h1>
      		<p class="h3 text-light shadow-lg" style="text-shadow: 1px 1px #000000;">Pemilihan Objek Pariwisata Sumatera</p>
		</div>
		<p align="center"><b>Pengaturan Kriteria Wisata</b></p>
        <a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block mt-4 mb-4">Logout</button></a>
		<a href="admin.php"><button type="button" class="btn btn-info btn-lg btn-block mt-4 mb-4">Kembali ke Menu Utama</button></a>  

		<div class="tambah-lokasi mt-4">
			<form method='POST' action="tambah_kriteria_process.php" name="form-kriteria" onsubmit="return validateForm()">
				<div class="form-row align-items-center">
				<div class="mt-3"> Pilih jenis kriteria: <div>
					<div class="col-auto my-1 input-group">
						<select name="kategori" class="custom-select mr-sm-1" id="inlineFormCustomSelect" onChange="myFunction()" required>
							<option value="">Choose...</option>
							<option value="fuzzy">Kriteria Fuzzy</option>
							<option value="non_fuzzy">Kriteria Non-Fuzzy</option>
						</select>
                    </div>
                    <div class="mt-3"> Isikan nama kriteria dan sub-kriteria: <div>
					<div class="col-auto my-1 input-group">
                        <input type="text" name="nama"  placeholder="Nama Kriteria" class="mr-2" onchange="updateSubText()" required>
                        <input type="text" name="sub1"  placeholder="Sub Kriteria 1" class="mr-2" onchange="updateSubText()" required>
                        <input type="text" name="sub2"  placeholder="Sub Kriteria 2" class="mr-2" onchange="updateSubText()" required>
                        <input type="text" name="sub3"  placeholder="Sub Kriteria 3" class="mr-2" onchange="updateSubText()" required>
                    </div>
					<div id="coba" style="display: none;">
						<div class="mt-3"> Isikan nilai batas:</div>
						<div class="col-auto my-1 input-group">            
							<input name="nbawah" type="number" id="v1" placeholder="Nilai Bawah" class="mr-2" required>
							<input name="ntengah" type="number" id="v2" placeholder="Nilai Tengah" class="mr-2" required>
							<input name="natas" type="number" id="v3" placeholder="Nilai Atas" class="mr-2" required>  
						</div>
					</div>

                    <div class="mt-3"> Isikan data kriteria untuk masing-masing lokasi wisata: </div>
                    <div class="col-auto my-1 input-group"> 
                    <table class='table table-bordered mt-2' id="tabel_fuzzy" style="display: none;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th class="label-kriteria">Data Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $result = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
                            $num = 1;
                            while($data = mysqli_fetch_array($result)):
                        ?>
                            <tr>
                                <th><?=$num;?></th>
                                <th><?=$data['obyek_wisata'];?></th>
                                <th><input name="datakriteria<?=$data['id'];?>" type="number" placeholder="Nilai Kriteria" class="datakriteria" required></th>
                            </tr>

                        <?php $num++; endwhile;?>

                        </tbody>
                    </table>
					<table class='table table-bordered mt-2' id="tabel_non" style="display: none;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th class="label-kriteria">Data Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $result = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
                            $num = 1;
                            while($data = mysqli_fetch_array($result)):
                        ?>
                            <tr>
                                <th><?=$num;?></th>
                                <th><?=$data['obyek_wisata'];?></th>
								<th>
								<select name="datakritnon<?=$data['id'];?>" class="custom-select mr-sm-1 datakritnon" required>
									<option value="">Choose...</option>
									<option value="bawah" class="s1">Sub Kriteria 1</option>
									<option value="tengah" class="s2">Sub Kriteria 2</option>
									<option value="atas" class="s3">Sub Kriteria 3</option>
								</select>
								</th>
							</tr>

                        <?php $num++; endwhile;?>

                        </tbody>
                    </table>
                    </div>

                    <div class="col-12 my-1">
                        <button type="submit" class="btn btn-success btn-lg btn-block mt-4 mb-4" name="submit">Tambah Kriteria</button>
                    </div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>

<script>
	function updateSubText(){
		var s1 = document.querySelectorAll(".s1");
		var s2 = document.querySelectorAll(".s2");
		var s3 = document.querySelectorAll(".s3");
		var label = document.querySelector(".label-kriteria");

		let nama = document.forms["form-kriteria"]["nama"].value;
		let sub1 = document.forms["form-kriteria"]["sub1"].value;
		let sub2 = document.forms["form-kriteria"]["sub2"].value;
		let sub3 = document.forms["form-kriteria"]["sub3"].value;

		for (let i = 0; i < s1.length; i++){
			s1[i].innerHTML = sub1;
			s2[i].innerHTML = sub2;
			s3[i].innerHTML = sub3;
			
		}
		label.innerHTML = "Data " + nama;
	}

	function myFunction() {
		var x = document.getElementById("coba");
		var y = document.getElementById("inlineFormCustomSelect");
		var t1 = document.getElementById("tabel_fuzzy");
		var t2 = document.getElementById("tabel_non");
		var v1 = document.getElementById("v1");
		var v2 = document.getElementById("v2");
		var v3 = document.getElementById("v3");

		var input_fuzzy = document.querySelectorAll(".datakriteria");
		var input_nonfuzzy = document.querySelectorAll(".datakritnon");

		if(y.value == "fuzzy"){
			if (x.style.display === "none") {
				x.style.display = "block";
				v1.value = ""; v2.value = ""; v3.value = "";
				for (let i = 0; i < input_fuzzy.length; i++) {
					input_fuzzy[i].required = true;
					input_nonfuzzy[i].required = false;
				}
			} else {
				x.style.display = "block";
				v1.value = ""; v2.value = ""; v3.value = "";
				for (let i = 0; i < input_fuzzy.length; i++) {
					input_fuzzy[i].required = true;
					input_nonfuzzy[i].required = false;
				}
			}
		}else{
			if (x.style.display === "none") {
				x.style.display = "none";
				v1.value = 0; v2.value = 0; v3.value = 0;
				for (let i = 0; i < input_nonfuzzy.length; i++) {
					input_fuzzy[i].required = false;
					input_nonfuzzy[i].required = true;
				}
			} else {
				x.style.display = "none";
				v1.value = 0; v2.value = 0; v3.value = 0;
				for (let i = 0; i < input_nonfuzzy.length; i++) {
					input_fuzzy[i].required = false;
					input_nonfuzzy[i].required = true;
				}
			}
		}
		if(y.value == "fuzzy"){
			if (t1.style.display === "none") {
				t1.style.display = "table";
				t2.style.display = "none";
				v1.value = ""; v2.value = ""; v3.value = "";
			} else {
				t1.style.display = "table";
				t2.style.display = "none";
				v1.value = ""; v2.value = ""; v3.value = "";
			}
		}else{
			if (t2.style.display === "none") {
				t2.style.display = "table";
				t1.style.display = "none";
				v1.value = 0; v2.value = 0; v3.value = 0;
			} else {
				t2.style.display = "table";
				t1.style.display = "none";
				v1.value = 0; v2.value = 0; v3.value = 0;
			}
		}
		
	}
</script>
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
		<p align="center"><b>Pengaturan Data Lokasi Wisata</b></p>
        <a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block mt-4 mb-4">Logout</button></a>
		<a href="admin.php"><button type="button" class="btn btn-info btn-lg btn-block mt-4 mb-4">Kembali ke Menu Utama</button></a>
        <message>
            Isi form berikut untuk menambah data lokasi wisata.
        <message>

		<div class="tambah-lokasi mt-4">
			<form method='POST' action="tambah_lokasi.php">
				<div class="form-row align-items-center">
					<div class="col-auto my-1 input-group">
                        <input type="text" name="nama"  placeholder="Nama Lokasi" class="mr-1 mt-3" required>
						<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria_static WHERE (kategori = 'non_fuzzy')");
							while($data = mysqli_fetch_array($daftar_kriteria)):
						?>
						<select name="<?= strtolower($data['kriteria']) ?>" class=" mr-1 mt-3" id="inlineFormCustomSelect" required>
							<option value=""><?=$data['kriteria']?></option>
                            <option value="bawah"><?=$data['bawah']?></option>
                            <option value="tengah"><?=$data['tengah']?></option>
                            <option value="atas"><?=$data['atas']?></option>
						</select>
						<?php endwhile;?>
						<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria_static WHERE (kategori = 'fuzzy')");
							while($data = mysqli_fetch_array($daftar_kriteria)):
						?>
							<input name="<?= strtolower($data['kriteria']) ?>" type="number" placeholder="<?=$data['kriteria'];?>" class="mr-1 mt-3" required>
						<?php endwhile;?>
					</div>
                    <div class="col-12 my-1">
                        <button type="submit" class="btn btn-success btn-block float mt-3" name="submit">Tambah Data</button>
                    </div>
				</div>
			</form>
		</div>

        <div class="mt-4">
			Berikut adalah daftar lokasi wisata yang terdaftar pada sistem:
                        </div>

		<div class="data-lokasi mt-4">
            <table class='table table-bordered mt-4'>
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
						<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria_static");
							while($data = mysqli_fetch_array($daftar_kriteria)):
						?>
						<th><?=$data['kriteria'];?></th>
						<?php endwhile;?>
                        <th>Action</th>
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
						<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria_static");
							while($dakrit = mysqli_fetch_array($daftar_kriteria)):
						?>
						<th><?=$data[strtolower($dakrit['kriteria'])];?></th>
						<?php endwhile;?>
                        <th><a href="delete.php?id=<?php echo $data['id']; ?>&item=lokasi"><button class="btn btn-danger">Delete</button></a></th>
                    </tr>

                <?php $num++; endwhile;?>

                </tbody>
            </table>
		</div>

	</div>
</body>
</html>
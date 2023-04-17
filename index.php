<?php 
session_start();
include"functions.php";
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
    <?php
      if(isset($_SESSION['legitUser'])){
        echo '<a href="logout.php"><button type="button" class="btn btn-primary btn-lg btn-block mt-4 mb-4">Logout</button></a>';
        echo '<a href="admin.php"><button type="button" class="btn btn-info btn-lg btn-block mt-4 mb-4">Kembali ke Menu Admin</button></a>';
      }else{
        echo '<a href="login_form.html"><button type="button" class="btn btn-primary btn-lg btn-block mt-4 mb-4">Login Admin</button></a>';
      }
    
      $krit_aktif = mysqli_query($conn,"SELECT * from daftar_kriteria");
      $baris=mysqli_num_rows($krit_aktif);
      if($baris == 0){
        echo "<p align='center'><b>Mohon maaf, tidak ada kriteria wisata yang aktif, silahkan hubungi admin.</b></p>";
      }else{
        echo "<p align='center'><b>Silahkan Masukkan Kriteria Objek Wisata</b></p>";
    ?>
		<form method='GET' action="">
			<div class="form-row align-items-center">
			<?php
					$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
					$num = 1;
					while($data = mysqli_fetch_array($daftar_kriteria)):
				?>
				<div class="col-auto my-1">
					<label class="mr-sm-2" for="inlineFormCustomSelect"><?=$data['kriteria'];?></label>
					<select name='<?=strtolower($data['kriteria']);?>' class="custom-select mr-sm-1" id="inlineFormCustomSelect" required>
						<option value="">Choose...</option>
						<option value="<?=strtolower($data['bawah']);?>"><?=$data['bawah'];?></option>
						<option value="<?=strtolower($data['tengah']);?>"><?=$data['tengah'];?></option>
						<option value="<?=strtolower($data['atas']);?>"><?=$data['atas'];?></option>
					</select>
				</div>
			<?php $num++; endwhile;?>
			</div>
			<button type="submit" name='submit' class="btn btn-primary btn-lg btn-block mt-4 mb-4" value='and'>Submit - Logika AND</button>
			<button type="submit" name='submit' class="btn btn-success btn-lg btn-block mt-4 mb-4" value='or'>Submit - Logika OR</button>
		</form>

		<?php
      }
			if(isset($_GET['submit'])){
			  $submit = $_GET['submit'];

        $daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
				$list_kriteria = array();
				while($data = mysqli_fetch_array($daftar_kriteria)):
            array_push($list_kriteria, strtolower($data['kriteria']));
        endwhile;
        
        $inputUser = array();
        foreach ($list_kriteria as &$value) {
          array_push($inputUser, $_GET[$value]); 
        }

        echo "<br>Pilihan anda:";
        $it=0;
        $daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
        while($data = mysqli_fetch_array($daftar_kriteria)):
          $str=" -> ";
          $str.=$data['kriteria'];
          $str.=": " ;
          echo $str; echo $inputUser[$it];
          $it++;
        endwhile;
        echo "<br>";
		?>
		
		<h4>Berikut adalah saran objek wisata berdasarkan kriteria yang anda inputkan:</h4>
		<table class='table table-bordered'>
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama Wisata</th>
					<?php
						$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
						while($data = mysqli_fetch_array($daftar_kriteria)):
					?>
						<th><?=$data['kriteria'];?></th>
					<?php endwhile;?>
					<th>Fire Strength</th>
				</tr>
			</thead>
			<tbody>

				<?php
           $daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
           $thekrit5 = array();
           $array_bobot = array();
           $it=0;
           while($data = mysqli_fetch_array($daftar_kriteria)):
             $krit = strtolower($data['kriteria']);
             array_push($thekrit5, $krit);
             $tname = "fuzzy_";
             $tname .= $krit;
             $sub1 = strtolower($data['bawah']); $sub2 = strtolower($data['tengah']); $sub3 = strtolower($data['atas']);
           
             if($inputUser[$it] == $sub1){
               $bobot = mysqli_query($conn,"SELECT {$sub1} from {$tname}");
               array_push($array_bobot, $bobot);
             }else if($inputUser[$it] == $sub2){
               $bobot = mysqli_query($conn,"SELECT {$sub2} from {$tname}");
               array_push($array_bobot, $bobot);
             }else if($inputUser[$it] == $sub3){
               $bobot = mysqli_query($conn,"SELECT {$sub3} from {$tname}");
               array_push($array_bobot, $bobot);
             }else{
               echo "<h1>Terjadi Masalah Pada Baris Program 153, test.php</h1>";
             }
             $it++;
           endwhile;
          

          $result = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
          $rowcount=mysqli_num_rows($result);
          $result2 = mysqli_query($conn,"SELECT * from daftar_kriteria");
          $rowcount2=mysqli_num_rows($result2);
					
          function get_arrbot($list_arrbot, $rowcount){
            $temp_array = array();
            if($list_arrbot != "null"){
              $arbot = mysqli_fetch_all($list_arrbot);
              foreach ($arbot as &$value){
                array_push($temp_array, $value[0]);
              }
            }else{
              for ($x = 0; $x < $rowcount; $x++){
                array_push($temp_array, 1);
              }
            }
            return $temp_array;
          }
          
          $temp_array = array();

          $it=0;
          $arrofarrbot = array();
          $daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
          while($data = mysqli_fetch_array($daftar_kriteria)):        
            $arbot = get_arrbot($array_bobot[$it], $rowcount);
            array_push($arrofarrbot, $arbot);
            $it++;
          endwhile;
					
					$fire_strength = array();
					$it2 = 0;
          for ($x = 0; $x < $rowcount; $x++){
            $it1 = 0;
            if($submit == 'and'){$value = 1;} else{$value = 0;}
            for ($y = 0; $y < $rowcount2; $y++){
              if($submit == 'and'){
                $value = $value * $arrofarrbot[$it1][$it2];
              }else{
                $value = $value + $arrofarrbot[$it1][$it2];
              }
              $it1++;
            }
						$it2++;
            array_push($fire_strength, $value);
          }
					
					
					if(array_sum($fire_strength) == 0){
						echo "<br><h1>TIDAK ADA REKOMENDASI</h1>";
					}else{
          
            
          $newliskrit = array(); $new_arrofarrbot = array();
          $it=0;
          foreach ($thekrit5 as &$valkrit){
            array_push($newliskrit, $valkrit);
            array_push($new_arrofarrbot,$arrofarrbot[$it]);
            $it++; 
          }
          if($it<5){
            $temp = array();
            for ($x = $it; $x < 5; $x++) {
              array_push($newliskrit, "kosong");
              for ($x = 0; $x < $rowcount; $x++){
                array_push($temp, "kosong");
              }
              array_push($new_arrofarrbot, $temp);
            }
          }

          if($rowcount2 == 1){
            //create rekomendasi_tb untuk menampung yg direkomendasikan
          $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
         )");
          //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
          $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
          )");
          }elseif($rowcount2 == 2){
                        //create rekomendasi_tb untuk menampung yg direkomendasikan
          $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            {$newliskrit[1]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
         )");
          //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
          $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            {$newliskrit[1]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
          )");
          }elseif($rowcount2 == 3){
            //create rekomendasi_tb untuk menampung yg direkomendasikan
            $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            {$newliskrit[1]} varchar(20) NOT NULL,
            {$newliskrit[2]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");

            //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
            $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            {$newliskrit[1]} float(20) NOT NULL,
            {$newliskrit[2]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");

          }elseif($rowcount2 == 4){
            //create rekomendasi_tb untuk menampung yg direkomendasikan
            $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            {$newliskrit[1]} varchar(20) NOT NULL,
            {$newliskrit[2]} varchar(20) NOT NULL,
            {$newliskrit[3]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
            //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
            $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            {$newliskrit[1]} float(20) NOT NULL,
            {$newliskrit[2]} float(20) NOT NULL,
            {$newliskrit[3]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
          }
          elseif($rowcount2 == 5){
            //create rekomendasi_tb untuk menampung yg direkomendasikan
            $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            {$newliskrit[1]} varchar(20) NOT NULL,
            {$newliskrit[2]} varchar(20) NOT NULL,
            {$newliskrit[3]} varchar(20) NOT NULL,
            {$newliskrit[4]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
            //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
            $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            {$newliskrit[1]} float(20) NOT NULL,
            {$newliskrit[2]} float(20) NOT NULL,
            {$newliskrit[3]} float(20) NOT NULL,
            {$newliskrit[4]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
          }elseif($rowcount2 == 6){
            //create rekomendasi_tb untuk menampung yg direkomendasikan
            $result = mysqli_query($conn, "CREATE TABLE rekomendasi_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} varchar(20) NOT NULL,
            {$newliskrit[1]} varchar(20) NOT NULL,
            {$newliskrit[2]} varchar(20) NOT NULL,
            {$newliskrit[3]} varchar(20) NOT NULL,
            {$newliskrit[4]} varchar(20) NOT NULL,
            {$newliskrit[5]} varchar(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
            //create penghitungan_bobot_tb untuk menampung bobot2 rekomendasi
            $result = mysqli_query($conn, "CREATE TABLE penghitungan_bobot_tb(
            id INT NOT NULL AUTO_INCREMENT,
            obyek_wisata VARCHAR(30) NOT NULL,
            {$newliskrit[0]} float(20) NOT NULL,
            {$newliskrit[1]} float(20) NOT NULL,
            {$newliskrit[2]} float(20) NOT NULL,
            {$newliskrit[3]} float(20) NOT NULL,
            {$newliskrit[4]} float(20) NOT NULL,
            {$newliskrit[5]} float(20) NOT NULL,
            fire_strength float(20) NOT NULL,
            PRIMARY KEY ( id )
            )");
          }
          else{
            echo "<h1>Terdapat masalah pada data kriteria</h1>";
          }

					$temp = array();
					$idx = 1;
          $arrofid = array();
          $daftar_id = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
           while($data = mysqli_fetch_array($daftar_id)):
              array_push($arrofid, $data['id']);
           endwhile;

					foreach ($fire_strength as &$value) {
						if($value > 0){
              $inwis = $idx -1;
							$index_wisata = $idx;
							$get_wisata_query = mysqli_query($conn,"SELECT * from tempat_wisata_tb WHERE (id = '$arrofid[$inwis]')");
							while($data = mysqli_fetch_array($get_wisata_query)):

                if($rowcount2==1){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];

                  mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, fire_strength) 
													VALUES('$ob_wis', '$krit1', '$fs')");
								  mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, fire_strength) 
													VALUES('$ob_wis', '$bk1', '$fs')");
                }elseif($rowcount2==2){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $krit2 = $data[$newliskrit[1]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];
                  $bk2 = $new_arrofarrbot[1][$it];

                  mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]}, fire_strength) 
                  VALUES('$ob_wis', '$krit1', '$krit2', '$fs')");
                  mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]}, fire_strength) 
                  VALUES('$ob_wis', '$bk1', '$bk2','$fs')");
                }elseif($rowcount2==3){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $krit2 = $data[$newliskrit[1]];
                  $krit3 = $data[$newliskrit[2]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];
                  $bk2 = $new_arrofarrbot[1][$it];
                  $bk3 = $new_arrofarrbot[2][$it];
                  
                  $result1 = mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]}, {$newliskrit[2]}, fire_strength) 
                  VALUES('$ob_wis', '$krit1', '$krit2','$krit3', '$fs')");
                  $result2 = mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]}, {$newliskrit[2]}, fire_strength) 
                  VALUES('$ob_wis', '$bk1', '$bk2','$bk3','$fs')");

                  

                }elseif($rowcount2==4){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $krit2 = $data[$newliskrit[1]];
                  $krit3 = $data[$newliskrit[2]];
                  $krit4 = $data[$newliskrit[3]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];
                  $bk2 = $new_arrofarrbot[1][$it];
                  $bk3 = $new_arrofarrbot[2][$it];
                  $bk4 = $new_arrofarrbot[3][$it];

                  mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]}, fire_strength) 
                  VALUES('$ob_wis', '$krit1', '$krit2', '$krit3', '$krit4', '$fs')");
                  mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]}, fire_strength) 
                  VALUES('$ob_wis', '$bk1', '$bk2','$bk3','$bk4','$fs')");
                }elseif($rowcount2==5){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $krit2 = $data[$newliskrit[1]];
                  $krit3 = $data[$newliskrit[2]];
                  $krit4 = $data[$newliskrit[3]];
                  $krit5 = $data[$newliskrit[4]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];
                  $bk2 = $new_arrofarrbot[1][$it];
                  $bk3 = $new_arrofarrbot[2][$it];
                  $bk4 = $new_arrofarrbot[3][$it];
                  $bk5 = $new_arrofarrbot[4][$it];

                  mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]},{$newliskrit[4]}, fire_strength) 
                  VALUES('$ob_wis', '$krit1', '$krit2', '$krit3', '$krit4','$krit5', '$fs')");
                  mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]},{$newliskrit[4]}, fire_strength) 
                  VALUES('$ob_wis', '$bk1', '$bk2','$bk3','$bk4','$bk5','$fs')");
                }elseif($rowcount2==6){
                  $ob_wis = $data['obyek_wisata'];
                  $krit1 = $data[$newliskrit[0]];
                  $krit2 = $data[$newliskrit[1]];
                  $krit3 = $data[$newliskrit[2]];
                  $krit4 = $data[$newliskrit[3]];
                  $krit5 = $data[$newliskrit[4]];
                  $krit6 = $data[$newliskrit[5]];
                  $it = $idx-1;
								  $fs  = $fire_strength[$it];
                  $bk1 = $new_arrofarrbot[0][$it];
                  $bk2 = $new_arrofarrbot[1][$it];
                  $bk3 = $new_arrofarrbot[2][$it];
                  $bk4 = $new_arrofarrbot[3][$it];
                  $bk5 = $new_arrofarrbot[4][$it];
                  $bk6 = $new_arrofarrbot[5][$it];

                  mysqli_query($conn, "INSERT INTO rekomendasi_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]},{$newliskrit[4]}, {$newliskrit[5]}, fire_strength) 
                  VALUES('$ob_wis', '$krit1', '$krit2', '$krit3', '$krit4','$krit5','$krit6', '$fs')");
                  mysqli_query($conn, "INSERT INTO penghitungan_bobot_tb(obyek_wisata, {$newliskrit[0]}, {$newliskrit[1]},{$newliskrit[2]}, {$newliskrit[3]},{$newliskrit[4]}, {$newliskrit[5]}, fire_strength) 
                  VALUES('$ob_wis', '$bk1', '$bk2','$bk3','$bk4','$bk5','$bk6','$fs')");
                }
                else{
                  echo "<h1>Terdapat masalah pada data kriteria</h1>";
                }
	
							endwhile;
						} $idx++;
					}
					$get_rekomendasi_query = mysqli_query($conn,"SELECT * from rekomendasi_tb ORDER BY fire_strength DESC");
					$num = 1;
					while($data = mysqli_fetch_array($get_rekomendasi_query)):
					?>
						<tr>
							<th><?=$num;?></th>
							<th><?=$data['obyek_wisata'];?></th>
							<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
								while($dakrit = mysqli_fetch_array($daftar_kriteria)):
							?>
							<th><?=$data[strtolower($dakrit['kriteria'])];?></th>
							<?php endwhile;?>
							<th><?=$data['fire_strength'];?></th>
						</tr>
	
				<?php $num++; endwhile; 
          $del = mysqli_query($conn,"DROP TABLE rekomendasi_tb");
        }
				?>

			</tbody>
		</table>

		<div class="mt-5 mb-5">
			<button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				Klik di sini untuk melihat hasil penghitungan fuzzy
			</button>

			<div class="collapse" id="collapseExample">
				<table class='table table-bordered mt-4'>
					<thead class="thead-dark">
						<tr>
							<th>No</th>
							<th>Nama Wisata</th>
							<?php
								$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
								while($data = mysqli_fetch_array($daftar_kriteria)):
							?>
							<th>Bobot <?=$data['kriteria'];?></th>
							<?php endwhile;?>
							<th>Fire Strength</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$get_fuzzy_query = mysqli_query($conn,"SELECT * from penghitungan_bobot_tb ORDER BY fire_strength DESC");
						$num = 1;
            if($get_fuzzy_query){
              while($data = mysqli_fetch_array($get_fuzzy_query)):
          ?>
           
           <tr>
							<th><?=$num;?></th>
							<th><?=$data['obyek_wisata'];?></th>
							
							<?php
							$daftar_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria");
							while($dakrit = mysqli_fetch_array($daftar_kriteria)):
								//$str="bobot_";
								//$str.=strtolower($dakrit['kriteria']);
                $str=strtolower($dakrit['kriteria']);
							?>
							
							<th><?=$data[$str];?></th>
							<?php endwhile;?>
							
							<th><?=$data['fire_strength'];?></th>
						</tr>

					<?php $num++; endwhile; 
          $del = mysqli_query($conn,"DROP TABLE penghitungan_bobot_tb");
          if($del) {mysqli_close($conn);}
        }
          ?>
           
           
           <?php } ?> 
						
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
 <!DOCTYPE html>
<?php  //include file koneksi ke database
		include ('../koneksi.php');

			//query ke database dengan SELECT table Pegawai diurutkan berdasarkan ID_Pegawai Paling Kecil
			$query = mysqli_query($connect, "SELECT * FROM diklat ORDER BY ID_PEGAWAI ASC") or die (mysqli_error());

			$query_banding1 = mysqli_query($connect, "SELECT * FROM diklat WHERE ID_PELATIHAN = '0' ") or die (mysqli_error());
			$hitung_banding1 = mysqli_num_rows($query_banding1);
			
			$query_banding2 = mysqli_query($connect, "SELECT * FROM pegawai ") or die (mysqli_error());
			$hitung_banding2 = mysqli_num_rows($query_banding2);
			$hitung_banding2 = $hitung_banding2 - $hitung_banding1;
?>
<html>
<head>
		<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
 
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
 
	function drawChart() {
 
		// membuat data chart dari json yang sudah ada di atas	
 		var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Belum Pernah Ikut Pelatihan', <?php echo $hitung_banding1; ?>],
  ['Sudah Mengikuti Pelatihan',<?php echo $hitung_banding2; ?> ]
])
		// Set options, bisa anda rubah
		var options = {'title':'Data Diklat',
					   'width':500,
					   'height':400};
 
		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
    </script>
	<title> 
	</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Diklatku</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tambah.php">Add New Data</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>	
		<h2>Data Diklat</h2>
		
		<div id="chart_div"></div>

		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> <br></br>


		<table cellpadding="11" cellspacing="0" border="1" id="myTable">
		<tr bgcolor="#CCCCCC">

			<th>ID Pegawai</th>
			<th>ID Pelatihan</th>
			<th>Bidang</th>
			<th>NIPP</th>
			<th>Nama Pegawai</tdh>
			<th>Lokasi Pegawai</th>
			<th>Substansi</th>
			<th>Kelas Jabatan</th>
			<th>Jenis Kelamin</th>
			<th>Durasi</th>
			<th></th>
			
		</tr>
		<?php
		

			//cek, apakah hasil query di atas mendapatkan hasil atau tidak (data kosong)
			if(mysqli_num_rows($query) == 0){ //ini artinya jika data hasil query di atas kosong

			//jika data kosong, maka akan menampilkan row kosong
			echo '<tr><td colspan="6"> Tidak ada data!</td></tr>';
			} else {	//else ini artinya jika data hasi query ada (data di database tidak kosong)

			//jika data tidak kosong, maka akan melakukan perulangan while
			$no = 1;	//membuat variabel $no untuk membuat no urut
			while($data = mysqli_fetch_assoc($query)) {	//perulangan while dengan membuat variabel $data yang akan mengambil data di database

				//menampilkan row dengan data di database
				echo '<tr>';
					echo '<td>'.$data['ID_PEGAWAI'].'</td>';
					echo '<td>'.$data['ID_PELATIHAN'].'</td>';
					echo '<td>'.$data['BIDANG'].'</td>';
					echo '<td>'.$data['NIPP'].'</td>';
					echo '<td>'.$data['NAMA_PEGAWAI'].'</td>';
					echo '<td>'.$data['LOKASI_PEGAWAI'].'</td>';
					echo '<td>'.$data['SUBSTANSI'].'</td>';
					echo '<td>'.$data['KELAS_JABATAN'].'</td>';
					echo '<td>'.$data['JENIS_KELAMIN'].'</td>';
					echo '<td>'.$data['DURASI'].'</td>';
					echo '<td><a href="edit.php?id='.$data['ID_PEGAWAI'].'">Edit</a> / <a href="hapus.php?id='.$data['ID_PEGAWAI'].'"onclick="return confirm(\'Yakin?\')">Hapus</a></td>';
				echo '</tr>';

				}	
			}
		?> 
	</table>
	<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
  	for (j = 0 ; j < 9; j++) {
    td = tr[i].getElementsByTagName("td")[j];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        break;
      } else {
        tr[i].style.display = "none";
      	}
		} 
  	}
  }
}
</script>
</body>
</html>
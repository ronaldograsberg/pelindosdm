<?php  
//mulai proses tambah data
include('../koneksi.php');

//cek dahulu, jika tombol tambah di klik
if (isset($_POST['tambah'])) {
	
	//include atau memasukkan file koneksi ke database

	//jika tombol tambah benar di klik maka lanjut prosesnya
	$id_pelatihan	= $_POST['id_pelatihan'];
	$bidang			= $_POST['bidang'];
	$nipp			= $_POST['nipp'];
	$nama_pegawai	= $_POST['nama_pegawai'];
	$lokasi_pegawai	= $_POST['lokasi_pegawai'];
	$seksi			= $_POST['seksi'];
	$kelas_jabatan	= $_POST['kelas_jabatan'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$durasi			= $_POST['durasi'];

	//melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
	$input	= mysqli_query($connect,"INSERT INTO diklat (ID_PEGAWAI,ID_PELATIHAN,BIDANG,NIPP,NAMA_PEGAWAI,LOKASI_PEGAWAI,SEKSI,KELAS_JABATAN,JENIS_KELAMIN,DURASI) VALUES(NULL,'$id_pelatihan','$bidang','$nipp','$nama_pegawai','$lokasi_pegawai','$seksi','$kelas_jabatan','$jenis_kelamin','$durasi')") or die (mysqli_error($connect));
	// var_dump($input);
	//jika query input sukses
	if ($input) {
		
		echo "Data berhasil ditambahkan! ";
		echo '<a href=tambah.php>Kembali</a></a>';
	
	}else{	
		
		echo "Gagal menambahkan data! ";
		echo '<a href=tambah.php> Kembali</a>';
	
	}
}
?>
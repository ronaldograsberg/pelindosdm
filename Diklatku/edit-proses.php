<?php
include('../koneksi.php');
//mulai proses tambah data

//cek dahulu, jika tombol simpan di klik
if (isset($_POST['Ubah'])) {
    
    //include atau memasukkan file koneksi ke database

    //jika tombol tambah benar di klik maka lanjut prosesnya
    $id_pegawai		= $_POST['id_pegawai'];
    $id_pelatihan	= $_POST['id_pelatihan'];
    $nipp			= $_POST['nipp'];
    $nama_pegawai	= $_POST['nama_pegawai'];
    $lokasi_pegawai	= $_POST['lokasi_pegawai'];
    $substansi		= $_POST['substansi'];
    $kelas_jabatan	= $_POST['kelas_jabatan'];
    $jenis_kelamin	= $_POST['jenis_kelamin'];
    $durasi			= $_POST['durasi'];
    
    //melakukan query dengan perintah UPDATE untuk memasukkan data ke database
    $input	= mysqli_query($connect, "UPDATE diklat SET id_pelatihan= '$id_pelatihan', nipp = '$nipp', nama_pegawai = '$nama_pegawai', lokasi_pegawai = '$lokasi_pegawai', substansi = '$substansi', kelas_jabatan = '$kelas_jabatan', jenis_kelamin = '$jenis_kelamin', durasi = '$durasi' WHERE  id_pegawai = '$id_pegawai'") or die(mysqli_error()) or die(mysqli_error($connect));
    var_dump($input);

    //jika query input sukses
    if ($input) {
        echo 'Data berhasil disimpan!';
        echo '<a href="../index.php">Kembali</a>';
    } else {
        echo "Gagal menyimpan data! ";
        echo '<a href="../index.php">Kembali</a>';
    }
} else { //jika tidak terdeteksi tombol tambah di klik

    //redirect atau dikembalikan ke halaman tambah
    echo '<script>window.history.back()</script>';
}

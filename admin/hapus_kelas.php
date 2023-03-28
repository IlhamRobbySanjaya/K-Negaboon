<?php 

require 'functions.php';

$id = $_GET["id"];

if (hapuskelas($id) > 0){
	echo "
		<script>
			alert ('data berhasil dihapus');
			document.location.href = 'data_kelas.php';
		</script>
		";
} else {
	echo "
		<script>
			alert ('data gagal dihapus karena masih melakukan peminjaman buku mapel');
			document.location.href = 'data_kelas.php';
		</script>

		";
}
	
 ?>

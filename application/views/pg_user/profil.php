<?=$siswa->nama_siswa?>
<br>
<?=$siswa->id_premium?>
<br>
	<a href="<?=current_url()?>/premium/" id="toogle-prem">
<?php
if($siswa->id_premium == 0){ ?>
	Daftarkan Akun Premium
<?php
}else if($siswa->id_premium > 0){ ?>
	Kembali ke akun Reguler
<?php
}
?>

</a>
<br>


<a href="<?=base_url()?>" id="">
	Home
</a>
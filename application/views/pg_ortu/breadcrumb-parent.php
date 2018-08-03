<?php
//dashboard
$bread_parent_dash_class="";
$bread_parent_dash_href="";

//aktivitas_siswa
$bread_parent_as_class="";
$bread_parent_as_href="";

//agcu_siswa
$bread_parent_ags_class="";
$bread_parent_ags_href="";

//tryout_siswa
$bread_parent_tos_class="";
$bread_parent_tos_href="";


if($this->uri->segment(2)=="dashboard"){
	$bread_parent_dash_class="active";
	$bread_parent_dash_href="#";

	$bread_parent_as_class="";
	$bread_parent_as_href=base_url('parents/aktivitas_siswa');


	$bread_parent_ags_class="";
	$bread_parent_ags_href=base_url('ortu/agcu/siswa');

	$bread_parent_tos_class="";
	$bread_parent_tos_href=base_url('ortu/analisis/tryout/1');

}
else
if($this->uri->segment(2)=="aktivitas_siswa"){
	$bread_parent_dash_class="";
	$bread_parent_dash_href=base_url('parents/dashboard');

	$bread_parent_as_class="active";
	$bread_parent_as_href="#";


	$bread_parent_ags_class="";
	$bread_parent_ags_href=base_url('ortu/agcu/siswa');

	$bread_parent_tos_class="";
	$bread_parent_tos_href=base_url('ortu/analisis/tryout/1');
}
else
if($this->uri->segment(2)=="agcu" && $this->uri->segment(3)=="siswa"){
	$bread_parent_dash_class="";
	$bread_parent_dash_href=base_url('parents/dashboard');

	$bread_parent_as_class="";
	$bread_parent_as_href=base_url('parents/aktivitas_siswa');


	$bread_parent_ags_class="active";
	$bread_parent_ags_href="#";

	$bread_parent_tos_class="";
	$bread_parent_tos_href=base_url('ortu/analisis/tryout/1');
}
else
if($this->uri->segment(2)=="analisis" && $this->uri->segment(3)=="tryout"){
	$bread_parent_dash_class="";
	$bread_parent_dash_href=base_url('parents/dashboard');

	$bread_parent_as_class="";
	$bread_parent_as_href=base_url('parents/aktivitas_siswa');


	$bread_parent_ags_class="";
	$bread_parent_ags_href=base_url('ortu/agcu/siswa');

	$bread_parent_tos_class="active";
	$bread_parent_tos_href="#";
}
?>



<div class="breadcrumb-container">
	<ol class="breadcrumb text-center">
		<li class="<?php echo $bread_parent_dash_class; ?>">
			<a href="<?php echo $bread_parent_dash_href; ?>">
				Dashboard
			</a>
		</li>
		<li class="<?php echo $bread_parent_as_class; ?>">
			<a href="<?php echo $bread_parent_as_href; ?>">
				Aktivitas Siswa
			</a>
		</li>
		<li class="<?php echo $bread_parent_ags_class; ?>">
			<a href="<?php echo $bread_parent_ags_href; ?>">
				Report AGCU Siswa
			</a>
		</li>
		<li class="<?php echo $bread_parent_tos_class; ?>">
			<a href="<?php echo $bread_parent_tos_href; ?>">
				Report Try Out Siswa
			</a>
		</li>
	</ol>
</div>
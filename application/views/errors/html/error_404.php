<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Halaman Tidak Ditemukan - Karisma Academy</title>
<link rel="shortcut icon" href="<?=config_item('base_url'); ?>assets/pg_user/images/merk/favicon.ico">
<link rel="icon" sizes="130x128" href="<?=config_item('base_url'); ?>assets/pg_user/images/merk/favicon.ico">
<link rel="apple-touch-icon" sizes="130x128" href="<?=config_item('base_url'); ?>assets/pg_user/images/merk/favicon.ico')">

<style type="text/css">

::selection { background-color: rgba(255, 255, 255, 0.2); color: white; }
::-moz-selection { background-color: rgba(255, 255, 255, 0.2); color: white; }

body {
	background:url("assets/img/bg-pattern.png") #10171D center fixed;
	margin: 40px;
	font: 13px/25px normal Helvetica, Arial, sans-serif;
	color: white;
}

a {
	color: #F3771B;
	font-weight: normal;
	text-decoration:none;
}

h1 {
	color: rgba(255,255,255,0.3);
	font-weight: normal;
	margin-top: 2%;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin:20px auto;
	text-align:center;
}

p {
	margin: 12px 15px 12px 15px;
}

h1{
	font-size:9em;
}

h3{
	font-size:3em;
}

.error-404{	
  display: flex;
  justify-content: center;
  align-items: center;
}

@media screen and (max-width:640px){
	span{
		display:block;
	}
}

</style>
</head>
<body>

<!-- include APPPATH.'/views/pg_user/header.php'; -->
	<div class="error-404">
		<div id="container">
			<img src="<?=config_item('base_url'); ?>assets/img/404_robot.png" alt="robot.png" width="25%">
			<h1>404</h1>
			<h3>Halaman Tidak Ditemukan</h3>
			<a href="javascript:history.back()">Kembali ke halaman sebelumnya</a> <span>atau</span>
			<a href="<?=config_item('base_url'); ?>">Halaman utama</a>
		</div>
	</div>
	
</body>
</html>
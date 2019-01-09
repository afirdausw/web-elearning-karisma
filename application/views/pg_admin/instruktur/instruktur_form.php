<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include APPPATH."views/pg_admin/inc/html_header.php"; ?>

<div class="wrapper">
	<?php include APPPATH."views/pg_admin/inc/sidebar.php"; ?>

	<div class="main-panel">
		<?php include APPPATH."views/pg_admin/inc/navbar.php"; ?>

		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah {$basic_info['title']}" ?></h4>
							</div>
							<?php
							//SETUP FORM
							$i = 1;
							$table_label = array();
							foreach($table_fields as $k=>$v){
								$table_label[] = ucwords(implode(" ", explode("_", $v)));
							}
							?>
							<div class="content">
								<form method="post" action="<?php echo $form_action ?>" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input type="text" name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
													   placeholder="<?=$table_label[$i]?>"
													   value="<?php echo set_value('nama', (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : 'Rendy Yofana')); ?>"
													   required="required">
												<?php echo form_error('<?=$table_fields[$i]?>', '<div class="text-danger">', '</div>'); ?>
											</div>
											<?php $i++; ?>
											 <div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="radio" name="<?=$table_fields[$i]?>" value="1" <?=(isset($data_instruktur)) ? (($data_instruktur->$table_fields[$i] == 1) ? "checked" : "") : "checked" ?> required> Laki-laki
													<input type="radio" name="<?=$table_fields[$i]?>" value="2" <?=(isset($data_instruktur)) ? (($data_instruktur->$table_fields[$i] == 2) ? "checked" : "") : "" ?>> Perempuan
												</div>
											</div>
											<?php $i++; ?>
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input type="text" name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
													   placeholder="<?=$table_label[$i]?>" required="required"
													   value="<?php echo set_value('nama', (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : 'Malang')); ?>">
												<?php echo form_error('<?=$table_fields[$i]?>', '<div class="text-danger">', '</div>'); ?>
											</div>
											<?php $i++; ?>
											<div class="form-group">
												<label for="tanggallahir"><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input class="form-control" type="text" id="<?=$table_fields[$i]?>" name="<?=$table_fields[$i]?>" placeholder="TTTT-BB-HH" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="Masukkan tanggal dengan format TTTT-BB-HH"
											   	value="<?php echo set_value('nama', (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : '1998-07-15')); ?>"/>
											</div>
											<?php $i++; ?>
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<textarea name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
														  placeholder="<?=$table_label[$i]?>"
														  required="required"><?php echo set_value($table_fields[$i], (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : 'Jl. Bantaran')); ?></textarea>
												<?php echo form_error("$table_fields[$i]", '<div class="text-danger">', '</div>'); ?>
											</div>
										</div>

										<div class="col-md-offset-1 col-md-5">
											<?php $i++; ?>
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input type="number" name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
													   placeholder="<?=$table_label[$i]?>"
													   value="<?php echo set_value($table_fields[$i], (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : '081233233233')); ?>"
													   required="required">
												<?php echo form_error("$table_fields[$i]", '<div class="text-danger">', '</div>'); ?>
											</div>
											<?php $i++; ?>
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input type="email" name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
													   placeholder="<?=$table_label[$i]?>"
													   value="<?php echo set_value($table_fields[$i], (isset($data_instruktur->$table_fields[$i]) ? $data_instruktur->$table_fields[$i] : 'rendy@email.com')); ?>"
													   required="required">
												<?php echo form_error("$table_fields[$i]", '<div class="text-danger">', '</div>'); ?>
											</div>
											<?php $i++; ?>
											<div class="form-group">
												<label><?=$table_label[$i]?><span class="text-danger">*</span></label>
												<input type="file" name="<?=$table_fields[$i]?>" id="<?=$table_fields[$i]?>" class="form-control"
													   placeholder="Pilih <?=$table_label[$i]?>"
													   required="required" accept="image/*">
												<?php echo form_error("$table_fields[$i]", '<div class="text-danger">', '</div>'); ?>
											</div>
											<?php if (isset($data_instruktur)) { ?>
                          <div class="form-group">
                              <label for="gambar_mapel">Gambar Thumbnail Sekarang</label>
                              <img src="<?= (isset($data_instruktur->$table_fields[$i]) ? (!empty($data_instruktur->$table_fields[$i]) ? base_url() . 'image/instruktur/' . $data_instruktur->$table_fields[$i] : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>" alt="Foto Instruktur <?=str_replace(' ','',$data_instruktur->nama_instruktur)?>" style="display:block;max-width: 10vw;">
                          </div>
                      <?php } ?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit
											</button>
											<a class="btn btn-danger pull-right" href="<?php echo site_url("pg_admin/{$basic_info['slug']}/daftar") ?>"><i
														class="fa fa-times"></i> Cancel</></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end .content -->

		<?php include APPPATH."views/pg_admin/inc/footer.php"; ?>

</html>

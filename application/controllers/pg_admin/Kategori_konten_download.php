<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_konten_download extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->load->model('model_kontendownload');
		$this->load->model('model_pg');
		$this->Model_security->is_logged_in();

	}

	public function tambah()
	{

		$data = array(
			'navbar_title' => "Tambah Kategori Konten Download",
			'activelink'       => "kategori_konten_download/tambah"
		);

		$this->load->view('pg_admin/form_kategori_konten_download', $data);

	}

	public function proses_tambah()
	{

		$params = $this->input->post(null, true);


		$judul = $params['judul_kategori'];

		$tipe = $this->cek_tipe($_FILES['gambar']['type']);

		if ($tipe !== false) {
			$img_path = "assets/uploads/kategori_konten_download/";
			$namafile = md5($judul) . md5(time()) . $tipe;


			$config['upload_path'] = $img_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');
			$data = [
				"kategori_konten_download"      => $judul,
				"gambar"						=> $namafile
			];
			$result = $this->Model_kontendownload->simpan_kategori_konten_download($data);
			// print_r($result);
			echo "<script>document.location='" . base_url("pg_admin/kategori_konten_download") . "';</script>";
		} else {
			redirect("kategori_konten_download/tambah");
			alert_error("Gagal Register", "Format file identitas tidak dikenal (gunakan file berformat .jpg/.jpeg/.png)");
		}


	}

	private function cek_tipe($tipe)
	{

		if ($tipe == 'image/jpeg') {
			return ".jpg";
		} else if ($tipe == 'image/png') {
			return ".png";
		} else {
			return false;
		}

	}

	public function index()
	{
		$data = array(
			'navbar_title' => "Kategori Konten Download",
			'active'       => "kategori_konten_download",

			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			
			'table_data' => $this->Model_kontendownload->get_kategori_konten_download(),
		);
		$this->load->view('pg_admin/kategori_konten_download', $data);
	}

	public function ajax_mapel($kelas)
	{
		$carimapel = $this->Model_adm->fetch_mapel_by_id_kelas($kelas);
		$no = 1; ?>
		<option value="">--Pilih Mata Pelajaran --</option>
		<?php
		foreach ($carimapel as $mapel) {
			?>
			<option value="<?php echo $mapel->id_mapel ?>"><?php echo $mapel->nama_mapel ?></option>
			<?php
			$no++;
		}
	}

	public function ajax_konten_by_mapel($mapel)
	{
		$carimapel = $this->Model_kontendownload->get_all_konten_by_mapel($mapel);
		$no = 1;

		if (count($carimapel) > 0) {
			?>

			<?php
			foreach ($carimapel as $mapel) {
				?>

				<tr>
					<td><?php echo $no ?></td>
					<td>
						<?php
						if ($mapel->gambar !== "") {
							?>
							<img src="<?php echo base_url('assets/uploads/konten_download/' . $mapel->gambar); ?>"
								 style="width: 75px;">
							<?php
						} else {
							?>
							<img src="<?php echo base_url('assets/uploads/konten_download/default.png'); ?>"
								 style="width: 75px;">
							<?php
						}
						?>

					</td>
					<td><?php echo $mapel->judul ?></td>
					<td><?php echo $mapel->point ?></td>
					<td class="text-center">

						<div class="button-group">
							<a href="<?php echo 'kategori_konten_download/ubah?id=' . $mapel->id ?>"
							   class="btn btn-warning btn-xs" title="Ubah"><i
										class="glyphicon glyphicon-pencil"></i></a>

							<a href="<?php echo 'konten_download/proses_delete?id=' . $mapel->id ?>"
							   class="btn btn-danger btn-xs" title="Hapus"><i
										class="glyphicon glyphicon-remove"></i></a>


						</div>

					</td>
				</tr>
				<?php
				$no++;
			}
		} else {
			?>
			<tr>
				<td colspan="5" class="text-center">Data Kosong</td>
			</tr>
			<?php
		}
	}

	function ajax_select_mapel()
	{
		$kelas = $this->input->post('kelas', true) ? $this->input->post('kelas', true) : null;

		if ($kelas) {
			$carimapel = $this->Model_adm->fetch_mapel_by_id_kelas($kelas);


			if ($carimapel) {
				echo "<option value='' disabled selected>Pilih Kelas...</option>";
				foreach ($carimapel as $mapel) {
					echo " <option value=\"<?php echo $mapel->id_mapel ?>\"><?php echo $mapel->nama_mapel ?></option>";
				}
			} else {
				echo "<option value='' disabled='disabled'>Tidak ada data</option>";
			}
		} else {
			return false;
		}
	}

	function ubah()
	{
		$id = $this->input->get('id') ? $this->input->get('id') : null;

		$data = array(
			'carikonten'   => $this->Model_kontendownload->get_kategori_konten_by_id($id),
			'navbar_title' => "Edit Kategori Konten Download",
			'active'       => "pg_admin/kategori_konten_download/ubah",
		);

		//var_dump($data);


		$this->load->view('pg_admin/kategori_konten_download_form_edit', $data);
	}

	function proses_update()
	{

		$params     = $this->input->post(null, true);

		$id         = $params['id'];
		$judul      = $params['judul_kategori'];

		$tipe = $this->cek_tipe($_FILES['gambar']['type']);

		if ($tipe !== false) {
			$img_path = "assets/uploads/kategori_konten_download/";
			$namafile = md5($judul) . md5(time()) . $tipe;


			$config['upload_path'] = $img_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $namafile;

			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');
			$data = [
				"kategori_konten_download"      => $judul,
				"gambar"						=> $namafile
			];
			$result = $this->Model_kontendownload->update_kategori($id, $judul, $namafile);
			//print_r($result);
			// echo "<script>document.location='" . base_url("pg_admin/kategori_konten_download") . "';</script>";
		} else {
			redirect("kategori_konten_download/ubah?id=".$id);
			alert_error("Gagal Update", "Format file identitas tidak dikenal (gunakan file berformat .jpg/.jpeg/.png)");
		}

	}
    public function konten($id_konten = 0)
    {
        $data = array(
            'navbar_title' => "Konten Download",
            'active'       => "konten_download",
            'select_kategori' => $this->Model_kontendownload->get_kategori_konten_download(),
            'konten' => $this->Model_kontendownload->get_all_konten_by_kategori_konten_download($id_konten),

            'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
        );
        $this->load->view('pg_admin/konten_download', $data);
       
    }
	function proses_hapus()
	{
		echo $id = $this->input->get('hidden_row_id') ? $this->input->get('hidden_row_id') : null;



		$this->Model_kontendownload->delete_kategori($id);
		echo "<script>document.location='" . base_url("pg_admin/kategori_konten_download") . "';</script>";

	}

	//    public
}
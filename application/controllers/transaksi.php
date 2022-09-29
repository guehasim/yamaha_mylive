<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 

class Transaksi extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->model('m_transaksi');
		$this->load->model('m_karyawan');
		$this->load->model('m_kategori');
	}

	public function index()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
			$status = $this->session->userdata('ses_StatusUser');

			if ($status == 0) {
				$data['transaksi'] = $this->m_transaksi->lihat_admin();
				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}else{
				$id = $this->session->userdata('ses_IdUser');
				$data['transaksi'] = $this->m_transaksi->lihat_karyawan($id);
				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}
		}		
	}

	public function get_autocomplete(){
        if (isset($_GET['term'])) {
			$result = $this->m_transaksi->get_karyawan($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = $row->NikUser;
					echo json_encode($arr_result);
				}
			}
		}
    }

    function search(){
        $title=$this->input->post('nik_pilih');
        $data['data']=$this->m_transaksi->get_karyawan($title);
 
        $this->load->view('transaksi/form',$data);
    }

	public function newTransaksi()
	{
		$id = $this->session->userdata('ses_IdUser');
		$data['karyawan'] = $this->m_karyawan->get_data($id);
		$data['kategori'] = $this->m_kategori->lihat_data();
		$data['baru'] = '1';
		$this->load->view('template/header');
		$this->load->view('transaksi/form',$data);
		$this->load->view('template/footer');

	}

	public function simpan()
	{
		$config['upload_path'] = 'assets/upload/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $form = $this->input->post('jenis_form');

        $nik = $this->input->post('nik');
        $this->db->where('NikUser',$nik);
        $query_cek = $this->db->get('m_user');

        if ($query_cek->num_rows() > 0) {
        	$row = $query_cek->row();

        	$this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	                $gbr = $this->upload->data();
	                //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= FALSE;
	                $config['quality']= '50%';
	                $config['width']= 600;
	                $config['height']= 600;
	                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {
	                	$this->m_transaksi->simpan_data($gambar);
	                	$this->session->set_flashdata('msg',
							'<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Berhasil Menyimpan
							</div>');

	                	if ($form == 1) {
	                		redirect('home');
	                	}else{
	                		redirect('transaksi');
	                	}
						
	                }

	            }
	                      
	        }else{
	            $this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Gambar belum di upload !!
							</div>');
	            redirect('transaksi');
	        }
        }else{
        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                Nik tidak ada di database !!
							</div>');
        		redirect('transaksi');
        }
        
	}

	public function get_action()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $id = $_GET['us'];
	            $data['tiket'] = $this->m_transaksi->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('transaksi/form_action',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function simpan_action()
	{
		$id 	= $this->input->post('id_transaksi');
		$aksi 	= $this->input->post('aksi');

		$config['upload_path'] = 'assets/upload/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['image']['name'])){
 
            if ($this->upload->do_upload('image')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 600;
                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar=$gbr['file_name'];
                // echo "Image berhasil diupload";

                if (isset($_POST)) {
                	
                	$data = array(
                		'Trans_TglJam' 			=> date('Y-m-d',strtotime($this->input->post('tanggal'))),
						'Trans_Status' 			=> 1,
						'Trans_Action'			=> $aksi,
						'Trans_img_after'		=> $gambar,
						'Trans_TglJam_Action' 	=> date('Y-m-d h:i:s')
						);

					$where = array(
						'ID_Transaksi' 			=> $id
						);

					$this->m_karyawan->update_data($where,$data,'tbl_transaksi');

                	$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan Action
						</div>');
					redirect('transaksi');
                }

            }
                      
        }else{
            echo "Image yang diupload kosong";
        }
	}

	public function get_update()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $ids = $_GET['us'];
	            $id = $this->session->userdata('ses_IdUser');
				$data['karyawan'] = $this->m_karyawan->get_data($id);
				$data['kategori'] = $this->m_kategori->lihat_data();
	            $data['transaksi'] = $this->m_transaksi->get_data($ids);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('transaksi/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 			= $this->input->post('id_transaksi');
		$id_tiket 		= $this->input->post('kategori');
		$deskripsi 		= $this->input->post('deskripsi');
		$tanggal 		= date('Y-m-d',strtotime($this->input->post('tanggal')));
		$nik 			= $this->input->post('nik');

		$config['upload_path'] = 'assets/upload/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $this->db->where('NikUser',$nik);
        $query_cek = $this->db->get('m_user');

        if ($query_cek->num_rows() > 0) {
        	$row = $query_cek->row();
        	$id_karyawan = $row->ID_User;
        	$this->upload->initialize($config);
	        if(!empty($_FILES['image']['name'])){
	 
	            if ($this->upload->do_upload('image')){
	                $gbr = $this->upload->data();
	                //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='assets/upload/images/'.$gbr['file_name'];
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= FALSE;
	                $config['quality']= '50%';
	                $config['width']= 600;
	                $config['height']= 600;
	                $config['new_image']= 'assets/upload/images/'.$gbr['file_name'];
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();

	                $gambar=$gbr['file_name'];
	                // echo "Image berhasil diupload";

	                if (isset($_POST)) {

	                	$data = array(
							'Trans_TglJam' 			=> $tanggal,
							'Trans_IDKaryawan'		=> $id_karyawan,
							'Trans_Ticket'			=> $id_tiket,
							'Trans_Deskripsi' 		=> $deskripsi,
							'Trans_img_before' 		=> $gambar
							);

						$where = array(
							'ID_Transaksi' 			=> $id
							);

						$this->m_transaksi->update_data($where,$data,'tbl_transaksi');

						$this->session->set_flashdata('msg',
								'<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                                Berhasil Mengubah
								</div>');
						redirect('transaksi');
	                }

	            }
	                      
	        }else{
	            $data = array(
							'Trans_TglJam' 			=> $tanggal,
							'Trans_IDKaryawan'		=> $id_karyawan,
							'Trans_Ticket'			=> $id_tiket,
							'Trans_Deskripsi' 		=> $deskripsi
							);

						$where = array(
							'ID_Transaksi' 			=> $id
							);

						$this->m_transaksi->update_data($where,$data,'tbl_transaksi');

						$this->session->set_flashdata('msg',
								'<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                                Berhasil Mengubah
								</div>');
						redirect('transaksi');
	        }

        }else{
        	$this->session->set_flashdata('msg',
							'<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                                NIK Salah
							</div>');
			redirect('transaksi');
        }
		
	}

	public function update_password()
	{
		$id 	= $this->input->post('id');
		$pwd 	= sha1(md5($this->input->post('pass')));

		$data = array(
			'PassUser'  		=> $pwd,
			);

		$where = array(
			'ID_User' 		=> $id
			);

		$this->m_admin->update_data($where,$data,'m_user');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('admin');
	}

	public function delete()
	{
		$id = $this->input->post('id');
        $this->m_transaksi->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('transaksi');
	}

	public function laporan()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			
			$period_awal  		= date('Y-m-d',strtotime($this->input->post('period_awal')));
			$period_akhir 		= date('Y-m-d',strtotime($this->input->post('period_akhir')));
			$status_laporan 	= $this->input->post('status_transaksi');

			$submit = $this->input->post('submitdata');			

			if ($submit == 'Reset') {

				redirect('transaksi');

			}else if($submit == 'Print'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				$data['cetak'] = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);
				$this->load->view('transaksi/cetak_my_live',$data);

			}else if($submit == 'Excel'){

				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));

				$semua_pengguna = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);

				$spreadsheet = new Spreadsheet;

		          $spreadsheet->setActiveSheetIndex(0)
		                      ->setCellValue('A1', 'NO')
		                      ->setCellValue('B1', 'KATEGORI')
		                      ->setCellValue('C1', 'PERIODE')
		                      ->setCellValue('D1', 'NAMA')
		                      ->setCellValue('E1', 'DEPARTEMENT')
		                      ->setCellValue('F1', 'STATUS')
		                      ->setCellValue('G1', 'DESKRIPSI')
		                      ->setCellValue('H1', 'ACTION');

		          $kolom = 2;
		          $nomor = 1;
		          foreach($semua_pengguna->result() as $pengguna) {

		               $spreadsheet->setActiveSheetIndex(0)
		                           ->setCellValue('A' . $kolom, $nomor)
		                           ->setCellValue('B' . $kolom, $pengguna->Kategori)
		                           ->setCellValue('C' . $kolom, date('d M y',strtotime($pengguna->Trans_TglJam)))
		                           ->setCellValue('D' . $kolom, $pengguna->NamaUser)
		                           ->setCellValue('E' . $kolom, $pengguna->DeptUser)
		                           ->setCellValue('F' . $kolom, $pengguna->Trans_Status)
		                           ->setCellValue('G' . $kolom, $pengguna->Trans_Deskripsi)
		                           ->setCellValue('H' . $kolom, $pengguna->Trans_Action);

		               $kolom++;
		               $nomor++;

		          }

		          $writer = new Xlsx($spreadsheet);

		          header('Content-Type: application/vnd.ms-excel');
			  header('Content-Disposition: attachment;filename="Laporan My Live.xls"');
			  header('Cache-Control: max-age=0');

			  $writer->save('php://output');
			}else if($submit == 'Search'){
				$data['period_awal'] = date('d-m-Y',strtotime($this->input->post('period_awal')));
				$data['period_akhir'] = date('d-m-Y',strtotime($this->input->post('period_akhir')));
				

				$data['transaksi'] = $this->m_transaksi->lihat_pdf($period_awal,$period_akhir,$status_laporan);

				$this->load->view('template/header');
				$this->load->view('transaksi/index',$data);
				$this->load->view('template/footer');
			}
			else{
				redirect('transaksi');
			}

		}
	}
}
 ?>
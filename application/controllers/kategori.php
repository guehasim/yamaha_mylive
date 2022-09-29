<?php 

/**
 * 
 */
class kategori extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('m_kategori');
	}

	public function index()
	{$user = $this->session->userdata('ses_IdUser');
		if ($user=="") {
			redirect('login');
		}else{
		$data['kategori'] = $this->m_kategori->lihat_data();
		$this->load->view('template/header');
		$this->load->view('kategori/index',$data);
		$this->load->view('template/footer');
		}
	}

	public function pilih_kategori()
	{
		$tiketID = $_GET['id'];

		$this->db->where('ID_Kategori', $tiketID);
		$query = $this->db->get('m_kategori');

		if ($query->num_rows() > 0) {
			$kategori   = $this->db->get_where('m_kategori',array('ID_Kategori'=>$tiketID));
	        foreach ($kategori->result() as $k)
	        {
	        	echo "<input type='text' value='$k->Kategori' class='form-control' disabled>";
	        }
		}else{
			echo "<input type='text' class='form-control' disabled>";
		}        
	}

	public function newKategori()
	{
		$data['baru'] 	= '1';
		$data['max'] 	= $this->m_kategori->lihat_max();
		$this->load->view('template/header');
		$this->load->view('kategori/form',$data);
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		if (isset($_POST)) {
			$this->m_kategori->simpan_data();
			$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                                Berhasil Menyimpan
						</div>');
			redirect('kategori');
		}
	}

	public function get()
	{
		$user = $this->session->userdata('ses_IdUser');
		if ($user == "") {
			redirect('login');
		}else{
			if (isset($_GET['us']) ) {
	            $id = $_GET['us'];
	            $data['kategori'] = $this->m_kategori->get_data($id);
	            $data['baru'] = '';         
				$this->load->view('template/header');
				$this->load->view('kategori/form',$data);
				$this->load->view('template/footer');
	        }else{
	        	echo "no";
	        }
		}
	}

	public function update()
	{
		$id 		= $this->input->post('id');
		$kategori 	= $this->input->post('kategori');

		$data = array(
			'Kategori'		=> $kategori
			);

		$where = array(
			'ID_Kategori' 	=> $id
			);

		$this->m_kategori->update_data($where,$data,'m_kategori');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('kategori');
	}

	public function hapus()
	{
		$id = $this->input->post('id');
        $this->m_kategori->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('kategori');
	}
}
 ?>
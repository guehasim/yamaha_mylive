<?php 


class m_kategori extends CI_Model
{
	
	public function lihat_data()
	{
		$query = $this->db->query("SELECT * FROM m_kategori ORDER BY ID_Kategori DESC");
		return $query;
	}

	public function lihat_max()
	{
		$query = $this->db->query("SELECT ID_Kategori FROM m_kategori ORDER BY ID_Kategori DESC LIMIT 1");
		return $query;
	}

	public function simpan_data()
	{
		$data = array(
			'ID_Kategori'	=> null,
			'Ticket'		=> $this->input->post('tiket'),
			'Kategori'		=> $this->input->post('kategori')
			);

		$this->db->insert('m_kategori',$data);
	}

	public function get_data($id)
	{
		$query = $this->db->query("SELECT * FROM m_kategori WHERE ID_Kategori = $id ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Kategori',$id);
        $this->db->delete('m_kategori');
    }
}
 ?>
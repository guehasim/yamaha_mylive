<?php 


class m_transaksi extends CI_Model
{
	
	public function lihat_admin()
	{
		$query = $this->db->query("SELECT
								tbl_transaksi.ID_Transaksi, 
								tbl_transaksi.Trans_TglJam, 
								tbl_transaksi.Trans_IDKaryawan, 
								tbl_transaksi.Trans_Ticket, 
								tbl_transaksi.Trans_Deskripsi, 
								tbl_transaksi.Trans_Status, 
								tbl_transaksi.Trans_Action, 
								tbl_transaksi.Trans_img_before, 
								tbl_transaksi.Trans_img_after, 
								m_kategori.Kategori, 
								m_user.NamaUser, 
								m_user.DeptUser
							FROM
								tbl_transaksi
								INNER JOIN
								m_kategori
								ON 
									tbl_transaksi.Trans_Ticket = m_kategori.ID_Kategori
								INNER JOIN
								m_user
								ON 
									tbl_transaksi.Trans_IDKaryawan = m_user.ID_User
							ORDER BY
								tbl_transaksi.ID_Transaksi DESC");
		return $query;
	}

	public function lihat_karyawan($id)
	{
		$query = $this->db->query("SELECT
								tbl_transaksi.ID_Transaksi, 
								tbl_transaksi.Trans_TglJam, 
								tbl_transaksi.Trans_IDKaryawan, 
								tbl_transaksi.Trans_Ticket, 
								tbl_transaksi.Trans_Deskripsi, 
								tbl_transaksi.Trans_Status, 
								tbl_transaksi.Trans_Action, 
								tbl_transaksi.Trans_img_before, 
								tbl_transaksi.Trans_img_after, 
								m_kategori.Kategori, 
								m_user.NamaUser, 
								m_user.DeptUser
							FROM
								tbl_transaksi
								INNER JOIN
								m_kategori
								ON 
									tbl_transaksi.Trans_Ticket = m_kategori.ID_Kategori
								INNER JOIN
								m_user
								ON 
									tbl_transaksi.Trans_IDKaryawan = m_user.ID_User
							WHERE tbl_transaksi.Trans_IDKaryawan = '$id'
							ORDER BY
								tbl_transaksi.ID_Transaksi DESC");
		return $query;
	}

	public function get_karyawan($nik)
	{
		$this->db->like('NikUser',$nik,'both');
		$this->db->order_by('ID_User','DESC');
		$this->db->limit(10);
		return $this->db->get('m_user')->result();
	}

	public function lihat_pdf($period_awal,$period_akhir,$status_laporan)
	{
		if ($status_laporan == '') {
			$tampil = "WHERE tbl_transaksi.Trans_TglJam BETWEEN '$period_awal' AND '$period_akhir' ";
		} else {
			$tampil = "WHERE tbl_transaksi.Trans_TglJam BETWEEN '$period_awal' AND '$period_akhir' AND tbl_transaksi.Trans_Status = '$status_laporan' ";
		}

		$query = $this->db->query("SELECT
								tbl_transaksi.ID_Transaksi, 
								tbl_transaksi.Trans_TglJam, 
								tbl_transaksi.Trans_IDKaryawan, 
								tbl_transaksi.Trans_Ticket, 
								tbl_transaksi.Trans_Deskripsi, 
								tbl_transaksi.Trans_Status, 
								tbl_transaksi.Trans_Action, 
								tbl_transaksi.Trans_img_before, 
								tbl_transaksi.Trans_img_after, 
								m_kategori.Kategori, 
								m_user.NamaUser, 
								m_user.DeptUser
							FROM
								tbl_transaksi
								INNER JOIN
								m_kategori
								ON 
									tbl_transaksi.Trans_Ticket = m_kategori.ID_Kategori
								INNER JOIN
								m_user
								ON 
									tbl_transaksi.Trans_IDKaryawan = m_user.ID_User
							$tampil
							ORDER BY
								tbl_transaksi.ID_Transaksi DESC");
		return $query;
		
	}

	public function simpan_data($gambar)
	{
		$data = array(
			'ID_Transaksi'			=> null,
			'Trans_TglJam'			=> date('Y-m-d',strtotime($this->input->post('tanggal'))),
			'Trans_IDKaryawan'		=> $this->input->post('karyawan'),
			'Trans_Ticket' 			=> $this->input->post('kategori'),
			'Trans_Deskripsi' 		=> $this->input->post('deskripsi'),
			'Trans_Status'			=> 0,
			'Trans_Action'			=> null,
			'Trans_img_before'		=> $gambar,
			'Trans_img_after' 		=> null,
			'Trans_TglJam_Action' 	=> null
			);

		$this->db->insert('tbl_transaksi',$data);
	}

	public function get_data($ids)
	{
		$query = $this->db->query("SELECT
						tbl_transaksi.ID_Transaksi, 
						tbl_transaksi.Trans_TglJam, 
						tbl_transaksi.Trans_IDKaryawan, 
						tbl_transaksi.Trans_Ticket, 
						tbl_transaksi.Trans_Deskripsi, 
						tbl_transaksi.Trans_Status, 
						tbl_transaksi.Trans_Action, 
						tbl_transaksi.Trans_img_before, 
						tbl_transaksi.Trans_img_after, 
						m_user.NikUser, 
						m_user.NamaUser, 
						m_user.DeptUser, 
						m_user.StatusUser, 
						m_kategori.Ticket, 
						m_kategori.Kategori
					FROM
						tbl_transaksi
						LEFT JOIN
						m_user
						ON 
							tbl_transaksi.Trans_IDKaryawan = m_user.ID_User
						LEFT JOIN
						m_kategori
						ON 
							tbl_transaksi.Trans_Ticket = m_kategori.ID_Kategori
					WHERE
						tbl_transaksi.ID_Transaksi = '$ids' ");
		return $query;
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('ID_Transaksi',$id);
        $this->db->delete('tbl_transaksi');
    }
}
 ?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    function get_periode_laporan($tgl_awal, $waktu_tanggapan)
    {
        $this->db->select('*');
        $this->db->from('detail_tiket');
        $this->db->join('tiket', 'detail_tiket.tiket_id = tiket.id_tiket', 'left');
        $this->db->where('tgl_dftr >=', $tgl_awal);
        $this->db->where('waktu_tanggapan <=', $waktu_tanggapan);

        return $this->db->get();
    }
}

/* End of file Controllername.php */

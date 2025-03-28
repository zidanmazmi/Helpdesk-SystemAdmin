<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tiket extends CI_Model
{
    function get_tiket()
    {
        return $this->db->get('tiket')->result();
    }

    function get_no_tiket($no_tiket)
    {
        $this->db->join('user', 'tiket.user_id = user.id_user', 'left');
        $this->db->join('divisi', 'user.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('jabatan', 'user.jabatan_id = jabatan.id_jabatan', 'left');
        $this->db->join('detail_tiket', 'tiket.id_tiket = detail_tiket.tiket_id', 'left');
        $this->db->where('no_tiket', $no_tiket);

        return $this->db->get('tiket')->row();
    }

    // Fungsi untuk mendapatkan nomor tiket baru
    function no_tiket()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_tiket, 4)) AS no_tiket FROM tiket WHERE DATE(tgl_dftr) = CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) { // Perbaikan
                $tmp = ((int) $k->no_tiket) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmY') . '-' . $kd;
    }

    // Fungsi untuk menyimpan tiket baru ke dalam database
    function insert($data)
    {
        $this->db->insert('tiket', $data);
    }

    function get_id_tiket($id)
    {
        $this->db->where('id_tiket', $id);
        return $this->db->get('tiket');
    }
    function delete($id)
    {
        $this->db->where('id_tiket', $id);
        $this->db->delete('tiket');
    }

    function update($id, $data)
    {
        $this->db->where('id_tiket', $id);
        $this->db->update('tiket', $data);
    }

    function insert_tanggapan($data)
    {
        $this->db->insert('detail_tiket', $data);
    }

    function tiket_wait()
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->where('sts_tiket', 0);

        return $this->db->get()->num_rows();
    }

    function tiket_proses()
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->where('sts_tiket', 1);

        return $this->db->get()->num_rows();
    }

    function tiket_selesai()
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->where('sts_tiket', 3);

        return $this->db->get()->num_rows();
    }
}

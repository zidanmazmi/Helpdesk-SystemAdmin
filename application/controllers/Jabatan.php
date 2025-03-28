<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        back();
    }
    public function index()
    {
        // Mendapatkan data jabatan dari model
        $data['jabatan'] = $this->M_jabatan->get_jabatan();

        // Memuat view jabatan.php dan meneruskan data jabatan
        $this->template->load('back/template', 'back/jabatan/jabatan', $data);
    }

    function save_jabatan()
    {
        $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
        $this->form_validation->set_message('required', '{field} Harus Di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->M_jabatan->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data berhasil disimpan</div>');
            redirect('jabatan', 'refresh');
        } else {
            // Jika validasi form gagal, meneruskan pesan kesalahan ke view
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $data['validation_errors'] = validation_errors();
            $this->template->load('back/template', 'back/jabatan/jabatan', $data);
        }
    }

    function edit_jabatan($id)
    {
        $data['jbt'] = $this->M_jabatan->get_id_jabatan($id);

        if ($data['jbt']) {
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $this->template->load('back/template', 'back/jabatan/edit_jabatan', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak ada</div>');
            redirect('jabatan', 'refresh');
        }
    }

    function update_jabatan()
    {
        $data = [
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->M_jabatan->update($this->input->post('id_jabatan'), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil di Update</div>');
        redirect('jabatan', 'refresh');
    }

    function delete_jabatan($id) {
        // Mendapatkan data jabatan berdasarkan ID
        $jabatan = $this->M_jabatan->get_id_jabatan($id);
    
        if($jabatan) {
            // Jika data jabatan ditemukan, hapus data tersebut
            $this->M_jabatan->delete($id);
            $this->session->set_flashdata('hapus', '<div class="alert alert-success">Data Berhasil diHapus</div>');
        }
        else {
            // Jika data jabatan tidak ditemukan, tampilkan pesan kesalahan
            $this->session->set_flashdata('hapus', '<div class="alert alert-danger">Data Tidak Ditemukan</div>');
        }
        
        // Redirect ke halaman jabatan setelah menghapus
        redirect('jabatan', 'refresh');
    }
    
}

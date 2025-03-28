<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        back();
    }
    public function index()
    {
        // Mendapatkan data jabatan dari model
        $data['divisi'] = $this->M_divisi->get_divisi();

        // Memuat view jabatan.php dan meneruskan data divisi
        $this->template->load('back/template', 'back/divisi/divisi', $data);
    }

    function save_divisi()
    {
        $this->form_validation->set_rules('divisi', 'divisi', 'trim|required');
        $this->form_validation->set_message('required', '{field} Harus Di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = [
                'divisi' => $this->input->post('divisi')
            ];

            $this->M_divisi->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data berhasil disimpan</div>');
            redirect('divisi', 'refresh');
        } else {
            // Jika validasi form gagal, meneruskan pesan kesalahan ke view
            $data['divisi'] = $this->M_divisi->get_divisi();
            $data['validation_errors'] = validation_errors();
            $this->template->load('back/template', 'back/divisi/divisi', $data);
        }
    }

    function edit_divisi($id)
    {
        $data['div'] = $this->M_divisi->get_id_divisi($id);

        if ($data['div']) {
            $data['divisi'] = $this->M_divisi->get_divisi();
            $this->template->load('back/template', 'back/divisi/edit_divisi', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak ada</div>');
            redirect('divisi', 'refresh');
        }
    }

    function update_divisi()
    {
        $data = [
            'divisi' => $this->input->post('divisi')
        ];

        $this->M_divisi->update($this->input->post('id_divisi'), $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil di Update</div>');
        redirect('divisi', 'refresh');
    }

    function delete_divisi($id)
    {
        $divisi = $this->M_divisi->get_id_divisi($id);

        if ($divisi) {
            // Jika data jabatan ditemukan, hapus data tersebut
            $this->M_divisi->delete($id);
            $this->session->set_flashdata('hapus', '<div class="alert alert-success">Data Berhasil diHapus</div>');
        } else {
            // Jika data jabatan tidak ditemukan, tampilkan pesan kesalahan
            $this->session->set_flashdata('hapus', '<div class="alert alert-danger">Data Tidak Ditemukan</div>');
        }

        // Redirect ke halaman divisi setelah menghapus
        redirect('divisi', 'refresh');
    }
}

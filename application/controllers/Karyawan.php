<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    
    public function index()
    {
        $data['karyawan'] = $this->M_karyawan->get_karyawan();
        back();
        $this->template->load('back/template', 'back/karyawan/data_karyawan', $data);
    }

    function add_karyawan()
    {

        $data['jabatan'] = $this->M_jabatan->get_jabatan();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('back/template', 'back/karyawan/form_karyawan', $data);
    }

    function save_karyawan()
    {
        // Aturan validasi
        $this->form_validation->set_rules('nik', 'nik', 'trim|is_unique[user.nik]', 'required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[user.email]', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|matches[password]required');

        // Pesan error
        $this->form_validation->set_message('valid_nik', '{field} Harus Di isi');
        $this->form_validation->set_message('valid_email', '{field} Anda Harus Valid');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            // Data untuk disimpan
            $data = array(
                'nik' => $this->input->post('nik'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'divisi_id' => $this->input->post('divisi_id'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'sts_user' => 1,
                'lvl_user' => 1,
            );

            $this->M_karyawan->insert($data);

            // Set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Disimpan
          </div>');

            redirect('karyawan', 'refresh');
        } else {
            $this->add_karyawan();
        }
    }


    function edit_karyawan($id)
    {
        $data['user'] = $this->M_karyawan->get_id_user($id);

        if ($data['user']) {
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $data['divisi'] = $this->M_divisi->get_divisi();
            $this->template->load('back/template', 'back/karyawan/edit_karyawan', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak ada</div>');
            redirect('karyawan', 'refresh');
        }
    }

    function update_karyawan()
    {
        // Aturan validasi
        $this->form_validation->set_rules('username', 'Username', 'trim|required');


        // Pesan error
        $this->form_validation->set_message('valid_nik', '{field} Harus Di isi');
        $this->form_validation->set_message('valid_email', '{field} Anda Harus Valid');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            // Data untuk disimpan
            $data = array(
                'nik' => $this->input->post('nik'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'divisi_id' => $this->input->post('divisi_id'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'sts_user' => $this->input->post('sts_user'),
                'lvl_user' => $this->input->post('lvl_user'),
            );

            $this->M_karyawan->update($this->input->post('id_user'), $data);

            // Set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Di Update
          </div>');

            redirect('karyawan', 'refresh');
        } else {
            $this->add_karyawan();
        }
    }

    function delete_karyawan($id)
    {
        $delete = $this->M_karyawan->get_id_user($id);

        if ($delete) {

            $this->M_karyawan->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil diHapus</div>');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak Ditemukan</div>');
        }

        redirect('karyawan', 'refresh');
    }

    function profile($id)
    {
        
        $data['karyawan'] = $this->M_karyawan->get_id_karyawan($id);

        if ($data['karyawan']) {
            $data['title'] = 'Profile User';
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $data['divisi'] = $this->M_divisi->get_divisi();

            $this->template->load('back/template', 'back/profile', $data);
        } else {
            redirect('dashboard', 'refresh');
        }
    }

    function update_profile()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');


        // Pesan error
        $this->form_validation->set_message('valid_nik', '{field} Harus Di isi');
        $this->form_validation->set_message('valid_email', '{field} Anda Harus Valid');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'nik' => $this->input->post('nik'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'divisi_id' => $this->input->post('divisi_id'),

            );
            // $test = 
            $this->M_karyawan->update($this->input->post('id_user'), $data);
            // var_dump($test);
            // die;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Di Update
          </div>');

            redirect('karyawan/profile/' . $this->session->id_user);
        } else {
            $this->add_karyawan();
        }
    }
}

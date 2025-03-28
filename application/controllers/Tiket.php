<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Tiket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        back();
    }
    public function index()
    {
        $data['tiket'] = $this->M_tiket->get_tiket();
        $data['no_tiket'] = $this->M_tiket->no_tiket();
        $this->template->load('back/template', 'back/tiket/tiket', $data);
    }

    function save_tiket()
    {
        $this->form_validation->set_rules('judul_tiket', 'Judul Tiket', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == true) {
            $this->index();
            if ($_FILES['gambar_tiket']['error'] <> 4) {

                $config['upload_path'] = './assets/images/tiket/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']  = '2038';
                $nama_file = $this->input->post('judul_tiket') . '-' . date('d_m_Y-His');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_tiket')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    $gambar_tiket = $this->upload->data();
                    $data = array(
                        'no_tiket' => $this->input->post('no_tiket'),
                        'judul_tiket' => $this->input->post('judul_tiket'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'sts_tiket' => 0,
                        'user_id' => $this->session->userdata('id_user'),
                        'gambar_tiket' => $this->upload->data('file_name'),
                        'tgl_dftr' => date('YmdHis')
                    );

                    $this->M_tiket->insert($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Data berhasil disimpan!</h5>
                  </div>');
                    redirect('tiket');
                }
            } else {
                $data = array(
                    'no_tiket' => $this->input->post('no_tiket'),
                    'judul_tiket' => $this->input->post('judul_tiket'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'sts_tiket' => 0,
                    'user_id' => $this->session->userdata('id_user'),
                    'tgl_dftr' => date('YmdHis')
                );

                $this->M_tiket->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Data berhasil disimpan!</h5>
              </div>');
                redirect('tiket', 'refresh');
            }
        } else {
            $this->index();
        }
    }

    function save_tanggapan()
    {
        $this->form_validation->set_rules('tanggapan', 'Tanggapan Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            if ($_FILES['gambar_tanggapan']['error'] <> 4) {

                $config['upload_path'] = './assets/images/tanggapan/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']  = '2038';
                $nama_file = $this->input->post('tiket_id') . date('Y_m_d-His');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_tanggapan')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    if ($this->input->post('tiket_id')) {
                        $data = array(
                            'sts_tiket' => 2,
                        );
                        $this->M_tiket->update($this->input->post('id_tiket'), $data);
                    }

                    $gambar_tanggapan = $this->upload->data();
                    $data = array(
                        'tiket_id' => $this->input->post('id_tiket'),
                        'tanggapan' => $this->input->post('tanggapan'),
                        'gambar_tanggapan' => $this->upload->data('file_name'),
                        'waktu_tanggapan' => date('YmdHis')
                    );

                    $this->M_tiket->insert_tanggapan($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Data berhasil disimpan!</h5>
                    
                  </div>');
                    redirect('tiket', 'refresh');
                }
            } else {
                if ($this->input->post('tiket_id')) {
                    $data = array(
                        'sts_tiket' => 2,
                    );
                    $this->M_tiket->update($this->input->post('id_tiket'), $data);
                }
                $data = array(

                    'tiket_id' => $this->input->post('tiket_id'),
                    'tanggapan' => $this->input->post('tanggapan'),
                    'waktu_tanggapan' => date('YmdHis')
                );

                $this->M_tiket->insert_tanggapan($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Data berhasil disimpan!</h5>
              </div>');
                redirect('tiket', 'refresh');
            }
        }
    }

    function save_tiket_waiting()
    {
        $this->form_validation->set_rules('sts_tiket', 'Status Tiket', 'trim|required');
        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'sts_tiket' => $this->input->post('sts_tiket'),
            );

            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Status Tiket Berhasil Di Update</div>');
            redirect('tiket', 'refresh');
        }
    }

    function save_close_tiket()
    {
        $this->form_validation->set_rules('sts_tiket', 'Status Tiket', 'trim|required');
        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'sts_tiket' => $this->input->post('sts_tiket'),
            );

            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info">Status Tiket Selesai</div>');
            redirect('tiket', 'refresh');
        }
    }

    function detail_tiket($no_tiket)
    {
        $data['tiket'] = $this->M_tiket->get_no_tiket($no_tiket);
        if ($data['tiket']) {
            $data['title'] = 'Detail Tiket' . $data['tiket']->no_tiket;
            $this->template->load('back/template', 'back/tiket/detail_tiket', $data);
        }
    }

    function delete_tiket($id)
    {
        $delete = $this->M_tiket->get_id_tiket($id);

        if ($delete) {
            $this->M_tiket->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data berhasil dihapus</div>');
            redirect('tiket', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Data Tidak ada</div>');
            redirect('tiket', 'refresh');
        }
    }
}

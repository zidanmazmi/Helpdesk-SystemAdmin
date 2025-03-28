<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        back();
    }
    public function index()
    {
        $data['tiket_wait'] = $this->M_tiket->tiket_wait();
        $data['tiket_proses'] = $this->M_tiket->tiket_proses();
        $data['tiket_selesai'] = $this->M_tiket->tiket_selesai();
        $data['user'] = $this->M_karyawan->jumlah_user();
        $this->template->load('back/template', 'back/dashboard', $data);
    }


    function login()
    {
        $this->load->view('back/login');
    }

    function register()
    {
        $this->load->view('back/register');
    }

    function proses_register()
    {
        // Load library form_validation
        $this->load->library('form_validation');

        // Load model M_auth
        $this->load->model('M_auth');

        // Aturan validasi
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[user.email]', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|matches[password]required');

        // Pesan error
        $this->form_validation->set_message('required', '{field} Harus Di isi');
        $this->form_validation->set_message('valid_email', '{field} Anda Harus Valid');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            // Data untuk disimpan
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'sts_user' => 1,
                'lvl_user' => 1,
            );

            // Insert data ke database menggunakan model M_auth
            $this->M_auth->insert($data);

            // Set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-info"> data berhasil disimpan', '</div>');

            // Redirect ke halaman login
            redirect('Dashboard/login', 'refresh');
        } else {
            // Tampilkan kembali halaman registrasi jika validasi gagal
            $this->load->view('back/register');
        }
    }

    function proses_login()
    {
        // Memuat library form_validation
        $this->load->library('form_validation');

        // Memuat model M_auth
        $this->load->model('M_auth');

        // Menentukan aturan validasi
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // Mengambil data pengguna berdasarkan email
            $user = $this->M_auth->get_email_user($this->input->post('email'));

            if (!$user) {
                $this->session->set_flashdata('message', '<div class="alert alert-info"> Email tidak ditemukan</div>');
                redirect('Dashboard/login', 'refresh');
            } elseif ($user->status_user == '0') {
                $this->session->set_flashdata('message', '<div class="alert alert-info"> User tidak aktif</div>');
                redirect('Dashboard/login', 'refresh');
            } elseif (!password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_flashdata('message', '<div class="alert alert-info"> Password Salah</div>');
                redirect('Dashboard/login', 'refresh');
            } else {
                // Menyiapkan data session
                $session = array(
                    'id_user'    => $user->id_user,
                    'username'   => $user->username,
                    'email'      => $user->email,
                    'lvl_user'   => $user->lvl_user,
                );

                // Menyimpan data session
                $this->session->set_userdata($session);

                // Redirect ke halaman dashboard
                redirect('Dashboard');
            }
        } else {
            $data['title'] = 'Login Pages';
            $this->load->view('back/login', $data); // Perhatikan bahwa ini seharusnya memuat view login, bukan register
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-info"> Anda Berhasil Logout</div>');
        redirect('Dashboard/login');
    }
}

/* End of file Controllername.php */

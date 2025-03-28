<?php
defined('BASEPATH') or exit('No direct script access allowed');

function back()
{
    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == null) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">Login dlu lah</div>');
        redirect('login');
    }
}

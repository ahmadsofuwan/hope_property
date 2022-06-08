<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

    public function index()
    {
        $data['titleLogin'] = $this->getDataRow('profile_company', 'titlelogin', '', '1')[0]['titlelogin'];
        $this->load->view('auth/login', $data);
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $arrWhere = array('username' => $username, 'password' => $password);
        $cek = $this->getDataRow('account', '*', $arrWhere, 1);
        if (count($cek) == 0) {
            $msg = 'Username atau password salah';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('Auth'));
        } else {
            foreach ($cek as $row) {
                $newdata = array(
                    'id'  => $row['id'],
                    'name'  => $row['name'],
                    'role'     => $row['role'],
                    'img' => $row['img'],
                    'login' => true
                );
                $this->session->set_userdata($newdata);
                redirect(base_url('admin'));
            }
        }
    }

    public function registersuperadmin()
    {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        if ($password !== $password2) {
            $msg = "password confirm tidak sama ";
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('Admin/regis_superadmin'));
        } else {
            $this->load->model('admin_model');
            $cek = $this->admin_model->cek_regis_superadmin($nama)->num_rows();
            if ($cek == 0) {
                $this->admin_model->insert_superadmin($nama, $password);
                $this->session->set_flashdata('msg', 'success');
                redirect(base_url('Admin/regis_superadmin'));
            } else {
                $this->session->set_flashdata('msg', 'username akun sudah ada');
                redirect(base_url('Admin/regis_superadmin'));
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('role');
        redirect(base_url('Auth'));
    }
}

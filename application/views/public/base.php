<?php
$this->load->view('public/header', $html);
$this->load->view('public/menu');
if (!empty($url)) {
    $this->load->view($url);
} else {
    $this->load->view('public/dashboard');
    $this->load->view('public/promo');
    $this->load->view('public/new_unit');
    $this->load->view('public/brands');
    $this->load->view('public/galery');
}
$this->load->view('public/footer');

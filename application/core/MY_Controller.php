<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{


    public function template($data)
    {
        $data['companyName'] = $this->getDataRow('profile_company', 'name', '', 1)[0]['name'];
        $this->load->view('template/base.php', $data);
    }
    public function templatePublic($data)
    {
        $data['companyName'] = $this->getDataRow('profile_company', 'name', '', 1)[0]['name'];
        $this->load->view('public/base.php', $data);
    }
    public function getDataRow($tbl, $row, $arrWhere = '', $limit = '', $arrJoin = array()/*array in array*/, $orderBy = '')
    {
        $this->load->model('Base_model');
        return $this->Base_model->getDataRow($tbl, $row, $arrWhere, $limit, $arrJoin, $orderBy);
    }
    public function insert($tbl, $arrData)
    {
        $this->load->model('Base_model');
        return $this->Base_model->insert($tbl, $arrData);
    }
    public function delete($tbl, $where)
    {
        $this->load->model('Base_model');
        return $this->Base_model->delete($tbl, $where);
    }
    public function update($table, $arrData, $where)
    {
        $this->load->model('Base_model');
        return $this->Base_model->update($table, $arrData, $where);
    }
    public function addErrMsg($arrErrMsg)
    {
        $this->arrErrMsg = $arrErrMsg;
        $_SESSION['arrErrMsg'] = $arrErrMsg;
    }

    public function uploadImg($param /*arr id tablename colomname  postname*/)
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($param['postname'])) {
            return $this->upload->display_errors();
        } else {
            $data = array('dataFile' => $this->upload->data())['dataFile'];
            $filename = strtotime("now") . $data['file_ext'];
            $target = './uploads/' . $filename;
            rename('./uploads/' . $data['file_name'], $target);
            $arrData = array(
                $param['colomname'] => $filename,
            );
            if (isset($param['replace']) && !empty($param['replace']) && $param['replace']) {
                $oldName = $this->getDataRow($param['tablename'], $param['colomname'], 'id=' . $param['id'])[0][$param['colomname']];
                $this->load->helper("file");
                delete_files('./uploads/' . $oldName);
                unlink('./uploads/' . $oldName);
            }
            $this->update($param['tablename'], $arrData, 'id=' . $param['id']);
            return true;
        }
    }

    public function uploadImgDetail($param)
    {

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        $images = array();

        $_FILES['images[]']['name'] = $param['postname']['name'][$param['arrnumber']];
        $_FILES['images[]']['type'] = $param['postname']['type'][$param['arrnumber']];
        $_FILES['images[]']['tmp_name'] = $param['postname']['tmp_name'][$param['arrnumber']];
        $_FILES['images[]']['error'] = $param['postname']['error'][$param['arrnumber']];
        $_FILES['images[]']['size'] = $param['postname']['size'][$param['arrnumber']];


        $fileName = strtotime("now") . '_Detail' . $param['arrnumber'];
        $images[] = $fileName;
        $config['file_name'] = $fileName;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('images[]')) {
            return $this->upload->display_errors();
        } else {
            $data = array('dataFile' => $this->upload->data())['dataFile'];
            if (isset($param['replace']) && !empty($param['replace']) && $param['replace']) {
                $oldName = $this->getDataRow($param['tablename'], $param['colomname'], 'id=' . $param['id'])[0][$param['colomname']];
                $this->load->helper("file");
                unlink('./uploads/' . $oldName);
            }
            $arrData = array(
                $param['colomname'] => $fileName . $data['file_ext'],
            );
            $this->update($param['tablename'], $arrData, 'id=' . $param['id']);
        }
    }

    public function genrateErr()
    {
        $arrMsgErr = $this->session->flashdata('arrMsgErr');

        $number = 1;
        if (isset($arrMsgErr)) {
            $err = '';
            foreach ($arrMsgErr as $value) {
                $err .= '<div class="alert alert-danger" role="alert">' . $number++ . '. ' . $value . '</div>';
            }
            return $err;
        }
    }

    public function setLog($logs = '', $status = false)
    {
        $this->load->helper('file');
        $path = './application/logs/' . date("Y-m-d") . '.text';
        if ($status) {
            write_file($path, $logs);
        }
    }
}

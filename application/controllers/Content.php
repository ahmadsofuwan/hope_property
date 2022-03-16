<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends MY_Controller
{

	public function base($name)
	{
		$name = str_replace("%20", " ", $name);
		$query = $this->getDataRow('city', '*', array('name' => $name));
		if (empty(count($query))) {
			redirect(base_url());
		}
		$dataBody = $this->getDataRow('articel', '*', array('citykey' => $query[0]['id']));

		$data['html']['title'] = $query[0]['title'];
		$data['html']['data'] = $dataBody;
		$data['url'] = 'public/body';
		$this->templatePublic($data);
	}
	public function detail($id)
	{
		$dataMaster = $this->getDataRow('articel', '*', 'id=' . $id);
		$dataDetail = $this->getDataRow('articel_detail', '*', 'articelkey=' . $id);
		$dataCity = $this->getDataRow('city', 'title', 'id=' . $dataMaster[0]['citykey'], '', '', 'city.id ASC');
		$data['html']['title'] = $dataCity[0]['title'];
		$data['html']['dataMaster'] = $dataMaster;
		$data['html']['dataDetail'] = $dataDetail;
		$data['url'] = 'public/detail';
		$this->templatePublic($data);
	}
}

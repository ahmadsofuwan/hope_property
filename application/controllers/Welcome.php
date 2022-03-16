<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function index()
	{
		$join = array(
			array('city', 'city.id = articel.citykey', 'left'),
		);
		$newUnit = $this->getDataRow('articel', 'articel.img,articel.titleads,articel.title, city.name as cityname', '1=1', 4, $join, 'articel.id DESC');
		$dashboard = $this->getDataRow('articel', 'img', 'articel.dashboard=1', 4);
		$list = $this->getDataRow('articel', 'img,title,name', 'articel.list=1', 4);
		$galery = $this->getDataRow('galery', '*', '', 5, array(), 'galery.id ASC');
		$data['html']['title'] = '';
		$data['html']['newUnit'] = $newUnit;
		$data['html']['galery'] = $galery;
		$data['html']['dashboard'] = $dashboard;
		$data['html']['list'] = $list;
		$data['url'] = '';
		$this->templatePublic($data);
	}
}

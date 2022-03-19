<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$role = $this->session->userdata('role');
		$login = $this->session->userdata('login');
		if (!$login && $role !== '1') {
			redirect(base_url('Auth'));
		}
	}

	public function index()
	{
		$data['html']['title'] = 'Dasboard';
		$this->template($data);
	}

	public function articelList()
	{
		$join = array(
			array('city', 'city.id = articel.citykey', 'left'),
		);
		$dataArticel = $this->getDataRow('articel', 'articel.*,city.name as cityname', '', '', $join, 'articel.title ASC');
		$data['html']['title'] = 'Input Data';
		$data['html']['dataArticel'] = $dataArticel;
		$data['url'] = 'admin/articelList';
		$this->template($data);
	}

	public function articel($id = '')
	{
		$tableName = 'articel';
		$tableDetail = 'articel_detail';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;


		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['title'])) {
				array_push($arrMsgErr, "Title wajib Di isi");
			}
			if (empty($_POST['articel'])) {
				array_push($arrMsgErr, "Articel wajib Di isi");
			}
			if (empty($_POST['cityKey'])) {
				array_push($arrMsgErr, "Kota wajib Di isi");
			}
			if ($_POST['action'] == 'add')
				if (empty($_FILES['file']['name']))
					array_push($arrMsgErr, "Gambar wajib Di isi");


			foreach ($_POST['detailKey'] as $key => $value) {
				if (empty($_POST['detailKey'][$key]) && empty($_POST['detailName'][$key]) && empty($_POST['detailArticel'][$key])) {
					unset($_POST['detailKey'][$key]);
				}
			}

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						//insert
						if (!empty(count($arrMsgErr)))
							break;
						$data =  array(
							'name' => $_POST['name'],
							'titleads' => $_POST['ads'],
							'title' => $_POST['title'],
							'articel' => $_POST['articel'],
							'citykey' => $_POST['cityKey'],
						);
						$idIsert = $this->insert($tableName, $data);
						$uploadParam = array(
							'id' => $idIsert,
							'tablename' => $tableName,
							'colomname' => 'img',
							'postname' => 'file',
						);
						$statusUpload = $this->uploadImg($uploadParam);
						if ($statusUpload) {
							foreach ($_POST['detailKey'] as $i => $value) {
								$data =  array(
									'articelkey' => $idIsert,
									'name' => $_POST['detailName'][$i],
									'title' => $_POST['detailTitle'][$i],
									'articel' => $_POST['detailArticel'][$i],
								);
								$idDetail = $this->insert($tableDetail, $data);
								$uploadParam = array(
									'id' => $idDetail,
									'tablename' => $tableDetail,
									'colomname' => 'img',
									'postname' => $_FILES['detailFile'],
									'arrnumber' => $i,
								);
								$this->uploadImgDetail($uploadParam);
							}
							redirect(base_url($baseUrl . 'List')); //wajib terakhir
						}
						$this->session->set_flashdata('arrMsgErr', $statusUpload);
						//insert

						break;
					case 'update':
						$arrData = array(
							'citykey' => $_POST['cityKey'],
							'name' => $_POST['name'],
							'title' => $_POST['title'],
							'titleads' => $_POST['ads'],
							'articel' => $_POST['articel'],
						);
						$this->update($tableName, $arrData, 'id=' . $_POST['id']);

						//update detail
						$oldDataDetail = $this->getDataRow($tableDetail, 'id', 'articelkey=' . $_POST['id']);
						foreach ($_POST['detailKey'] as $i => $value) {

							if (!empty($_POST['detailKey'][$i])) {
								$status = false;
								$arrNumber = 0;
								foreach ($oldDataDetail as $key => $item) {

									if ($item['id'] == $_POST['detailKey'][$i]) {
										$status = true;
										$arrNumber = $key;
									}
								}
								if ($status)
									unset($oldDataDetail[$arrNumber]);
							}

							$data =  array(
								'name' => $_POST['detailName'][$i],
								'title' => $_POST['detailTitle'][$i],
								'articel' => $_POST['detailArticel'][$i],
								'articelkey' => $_POST['id'],
							);
							$idDetail = '';
							if (!empty($_POST['detailKey'][$i])) {
								$idDetail = $_POST['detailKey'][$i];
								$this->update($tableDetail, $data, $_POST['detailKey'][$i]);
							} else {
								$idDetail = $this->insert($tableDetail, $data);
							}
							
							if (!empty($_FILES['detailFile'][$i]['name'])) {
								$uploadParam = array(
									'id' => $idDetail,
									'tablename' => $tableDetail,
									'colomname' => 'img',
									'postname' => $_FILES['detailFile'],
									'arrnumber' => $i,
									'replace' => true,
								);
								$this->uploadImgDetail($uploadParam);
							}
						}

						$deleteId = '';
						foreach ($oldDataDetail as $item) {
							if (empty($deleteId)) {
								$deleteId = $item['id'];
							} else {
								$deleteId .= ', ' . $item['id'];
							}
						}
						if (!empty($deleteId))
							$this->delete($tableDetail, 'id in(' . $deleteId . ')');
						//update detail

						//Upload img jika ada di post
						if (!empty($_FILES['file']['name'])) {
							$uploadParam = array(
								'id' => $_POST['id'],
								'tablename' => $tableName,
								'colomname' => 'img',
								'postname' => 'file',
								'replace' => true, //delete file lama
							);
							$statusUpload = $this->uploadImg($uploadParam);

							if (!$statusUpload) {
								redirect(base_url($baseUrl . 'List'));
							}
							$this->session->set_flashdata('arrMsgErr', array($statusUpload));
						} else {
							redirect(base_url($baseUrl . 'List'));
						}
						break;
				}
		}


		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('id' => $id), 1)[0];
			$_POST['cityKey'] = $dataRow['citykey'];
			$_POST['title'] = $dataRow['title'];
			$_POST['articel'] = $dataRow['articel'];
			$_POST['name'] = $dataRow['name'];
			$_POST['ads'] = $dataRow['titleads'];
			$_POST['action'] = 'update';
			$_POST['id'] = $id;
		}

		$selVal = $this->getDataRow('city', 'id,name', '', '', array(), 'city.name ASC');
		$dataDetail = $this->getDataRow($tableDetail, '*', 'articelkey=' . $id, '', array(),);
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['selVal'] = $selVal;
		$data['html']['dataDetail'] = $dataDetail;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/articelForm';
		$this->template($data);

		function validateForm($arrMsgErr)
		{
			# code...
		}
	}

	public function galeryList()
	{
		$dataGalery = $this->getDataRow('galery', 'galery.*', '', '', array(), 'galery.title ASC');
		$data['html']['title'] = 'List Galery';
		$data['html']['data'] = $dataGalery;
		$data['html']['ajaxUrl'] = 'admin/ajax';
		$data['url'] = 'admin/galeryList';
		$this->template($data);
	}

	public function galery($id = '')
	{
		$tableName = 'galery';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			switch ($_POST['action']) {
				case 'add':
					// validateForm
					$arrMsgErr = array();
					if (empty($_POST['title'])) {
						array_push($arrMsgErr, "Title wajib Di isi");
					}
					if (empty($_FILES['file']['name']))
						array_push($arrMsgErr, "Gambar wajib Di isi");
					$this->session->set_flashdata('arrMsgErr', $arrMsgErr);

					// validateForm

					//insert
					if (empty(count($arrMsgErr))) {
						$data =  array(
							'title' => $_POST['title'],
						);
						$idIsert = $this->insert($tableName, $data);
						$uploadParam = array(
							'id' => $idIsert,
							'tablename' => $tableName,
							'colomname' => 'img',
							'postname' => 'file',
						);
						$statusUpload = $this->uploadImg($uploadParam);
						if ($statusUpload) {
							redirect(base_url($baseUrl . 'List')); //wajib terakhir
						}
						$this->session->set_flashdata('arrMsgErr', $statusUpload);
					}
					//insert

					break;
				case 'update':
					$arrData = array(
						'title' => $_POST['title'],
					);
					$this->update($tableName, $arrData, 'id=' . $_POST['id']);
					//Upload img jika ada di post
					if (!empty($_FILES['file']['name'])) {
						$uploadParam = array(
							'id' => $_POST['id'],
							'tablename' => $tableName,
							'colomname' => 'img',
							'postname' => 'file',
							'replace' => true, //delete file lama
						);
						$statusUpload = $this->uploadImg($uploadParam);

						if (!$statusUpload) {
							redirect(base_url($baseUrl . 'List'));
						}
						$this->session->set_flashdata('arrMsgErr', array($statusUpload));
					} else {
						redirect(base_url($baseUrl . 'List'));
					}
					break;
			}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('id' => $id), 1)[0];
			$_POST['id'] = $id;
			$_POST['action'] = 'update';

			$_POST['title'] = $dataRow['title'];
		}
		$data['html']['err'] = $this->genrateErr();
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['baseUrl'] = $baseUrl;
		$data['url'] = $baseUrl . 'Form';
		$this->template($data);
	}

	public function ajax()
	{
		if (empty($_POST['action'])) {
			echo 'no action';
			die;
		}
		switch ($_POST['action']) {
			case 'updatelist':
				if ($this->getDataRow('articel', 'list', array('id' => $_POST['id']))[0]['list'] == 0) {
					if (count($this->getDataRow('articel', 'id', array('list' => 1))) < 4) {
						$this->update('articel', array('list' => '1'), array('id' => $_POST['id']));
						echo json_encode(array('status' => 'success'));
					} else {
						echo json_encode(array('status' => 'full'));
					}
				} else {
					$this->update('articel', array('list' => 0), array('id' => $_POST['id']));
					echo json_encode(array('status' => 'success'));
				}
				break;
			case 'updatedashboard':

				if ($this->getDataRow('articel', 'dashboard', array('id' => $_POST['id']))[0]['dashboard'] == 0) {
					if (count($this->getDataRow('articel', 'id', array('dashboard' => 1))) < 4) {
						$this->update('articel', array('dashboard' => '1'), array('id' => $_POST['id']));
						echo json_encode(array('status' => 'success'));
					} else {
						echo json_encode(array('status' => 'full'));
					}
				} else {
					$this->update('articel', array('dashboard' => 0), array('id' => $_POST['id']));
					echo json_encode(array('status' => 'success'));
				}
				break;
			case 'deleteGalery':
				$oldName = $this->getDataRow('galery', 'img', 'id=' . $_POST['id'])[0]['img'];
				$this->delete('galery', 'id=' . $_POST['id']);
				$this->load->helper("file");
				unlink('./uploads/' . $oldName);
				break;
			case 'deleteArticel':
				$this->load->helper("file");

				$oldNameImgArticel = $this->getDataRow('articel', 'img', 'id=' . $_POST['id'])[0]['img'];
				$this->delete('articel', 'id=' . $_POST['id']);
				unlink('./uploads/' . $oldNameImgArticel);

				$oldNameImgArticelDetail = $this->getDataRow('articel_detail', 'img', 'articelkey=' . $_POST['id']);
				$this->delete('articel_detail', 'articel_detail.articelkey=' . $_POST['id']);

				foreach ($oldNameImgArticelDetail as $key => $value) {
					unlink('./uploads/' . $oldNameImgArticelDetail[$key]['img']);
				}



				break;
			default:
				echo 'action is not in the list';
				break;
		}
	}
}

<?php
$action = 'add';
$display = '';
if (isset($_POST['action']))
	$action = $_POST['action'];
if ($action == 'update')
	$display = 'style="display: none;"'
?>
<div class="row justify-content-center">
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg">
				<div class="p-5">
					<?php echo $err ?>
					<h3 class="text-center"><b><?php echo strtoupper($title) ?></b></h3>
					<form action="<?php echo  base_url('Admin/articel') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="">
						<input type="hidden" name="action" value="<?php echo $action ?>">
						<div class="form-group row">
							<label for="city" class="col-sm-3 col-form-label">Kota</label>
							<div class="col-sm">
								<select class="form-control" id="city" name="cityKey">
									<option disabled selected value>----------</option>
									<?php foreach ($selVal as $val) { ?>
										<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="ads" class="col-sm-3 col-form-label">Title Unit Terbaru</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="ads" name="ads" placeholder="Title Unit Terbaru">
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Nama Artikel</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nama Artikel">
							</div>
						</div>
						<div class="form-group row">
							<label for="title" class="col-sm-3 col-form-label">Judul Artikel</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="title" name="title" placeholder="Judul Artikel">
							</div>
						</div>
						<div class="form-group row">
							<label for="articel" class="col-sm-3 col-form-label">Artikel</label>
							<div class="col-sm">
								<textarea class="form-control" name="articel" id="articel" cols="30" rows="10" placeholder="Berikan Sesuatu Articel"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="file" class="col-sm-3 col-form-label">Gambar</label>
							<div class="col-sm-3">
								<input type="file" class="form-control-file" id="file" name="file">
							</div>
						</div>

						<!-- detaile -->
						<div class="form-group row">
							<div class="col-sm">
								<table class="table">
									<thead>
										<tr>
											<th scope="col">Nama</th>
											<th scope="col">Title</th>
											<th scope="col" style="width: 250px;">Articel</th>
											<th scope="col">Gambar</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<tr <?php echo $display ?>>
											<input type="hidden" name="detailKey[]">
											<td><input type="text" class="form-control" name="detailName[]" placeholder="Nama Artikel"></td>
											<td><input type="text" class="form-control" name="detailTitle[]" placeholder="Judul Artikel"></td>
											<td><textarea class="form-control" name="detailArticel[]" placeholder=" Berikan Sesuatu Articel"></textarea></td>
											<td><input type="file" class="form-control-file" id="file" name="detailFile[]"></td>
											<td><b class="text-danger btn closeDetail">X</b></td>
										</tr>

										<?php
										//jika update/edit
										if ($action == 'update') {
										?>
											<?php foreach ($dataDetail as $key => $value) { ?>
												<tr>
													<input type="hidden" name="detailKey[]" value="<?php echo $value['id'] ?>">
													<td><input type="text" class="form-control" name="detailName[]" placeholder="Nama Artikel" value="<?php echo $value['name'] ?>"></td>
													<td><input type="text" class="form-control" name="detailTitle[]" placeholder="Judul Artikel" value="<?php echo $value['title'] ?>"></td>
													<td><textarea class="form-control" name="detailArticel[]" placeholder=" Berikan Sesuatu Articel"><?php echo $value['articel'] ?></textarea></td>
													<td><input type="file" class="form-control-file" id="file" name="detailFile[]"></td>
													<td><b class="text-danger btn closeDetail">X</b></td>
												</tr>
											<?php } ?>
										<?php } //jika update/edit
										?>
										<?php
										//jika ada filed validateform

										?>

									</tbody>
									<tfoot>
										<tr>
											<td><button type="button" class="btn btn-primary" name="addDetail">Tambah</button></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<!-- detaile -->


						<div class="form-group row mt-5">
							<div class="col-sm">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
							<div class="col-sm">
								<a href="<?php echo base_url($baseUrl . 'List') ?>" class="btn btn-warning btn-block">Cancel</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg">
				<div class="p-5">
					<?php echo $err ?>

					<h3 class="text-center"><b><?php echo strtoupper($title) ?></b></h3>
					<form action="<?php echo  base_url('Admin/galery') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="">
						<input type="hidden" name="action" value="add">
						<div class="form-group row">
							<label for="ads" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="ads" name="title" placeholder="Title">
							</div>
						</div>
						<div class="form-group row">
							<label for="file" class="col-sm-2 col-form-label">Gambar</label>
							<div class="col-sm">
								<input type="file" class="form-control-file" id="file" name="file">
							</div>
						</div>
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
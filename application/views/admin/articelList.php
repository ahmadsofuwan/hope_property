<div class="row">
    <div class="col-sm-2">
        <a href="<?php echo base_url('admin/articel') ?>"><i class="fa fa-plus fa-2x"></i></a>
    </div>
</div>
<table class="table table-responsive-sm" id="dataTable">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col">City</th>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
            <th scope="col">Img</th>
            <th scope="col">Articel</th>
            <th scope="col" style="width: 150px;">List And dashbord</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($dataArticel as $value) { ?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $value['cityname'] ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['title'] ?></td>
                <td>
                    <img style="width: 200px;" src="<?php echo base_url('uploads/' . $value['img']) ?>" class="img-thumbnail" alt="img_<?php echo $value['title'] ?>">
                </td>
                <td><?php echo substr($value['articel'], -25) ?>
                    <?php if (strlen($value['articel']) > 25) echo '....' ?>
                </td>
                <td>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="list" name="list" value="<?php echo $value['id'] ?>" <?php if ($value['list'] == '1')  echo 'checked'; ?>>
                        <label class="form-check-label" for="list">List</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Dashboard" name="dashboard" value="<?php echo $value['id'] ?>" <?php if ($value['dashboard'] == '1') echo 'checked'; ?>>
                        <label class="form-check-label" for="Dashboard">Dashboard</label>
                    </div>

                </td>
                <td style="width: 140px;">
                    <a href="<?php echo base_url('Admin/articel/' . $value['id']) ?>" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger" name="delete" value="<?php echo $value['id'] ?>">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('tbody').find('[name=delete]').click(function() {
        var id = $(this).val();
        var obj = $(this);
        Swal.fire({
            title: 'yakin?',
            text: "Data Akan Di Hapus Secara Permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        url: '<?= base_url('Admin/ajax') ?>',
                        type: 'POST',
                        data: {
                            action: 'deleteArticel',
                            id: id,
                        },
                    })
                    .done(function(a) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil Di Deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        obj.closest('tr').remove();
                        $.each($('tbody').find('tr > th'), function(index, elemt) {
                            $(elemt).html(index + 1)
                        });
                    })
                    .fail(function(a) {
                        console.log("error");
                        console.log(a);
                    })



            }
        })
    })
    $('tbody').find('[name=list]').click(function() {
        var obj = $(this);
        $.ajax({
                url: '<?php echo base_url('Admin/ajax') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'updatelist',
                    id: obj.val(),
                },
            })
            .done(function(a) {
                if (a.status != 'success') {
                    Swal.fire('List Maximum 4 silahkan unchek yang lain Dahulu')
                    obj.prop('checked', false);
                }
            })
            .fail(function(a) {
                console.log('error');
            })


    })
    $('tbody').find('[name=dashboard]').click(function() {
        var obj = $(this);
        $.ajax({
                url: '<?php echo base_url('Admin/ajax') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'updatedashboard',
                    id: obj.val(),
                },
            })
            .done(function(a) {
                if (a.status != 'success') {
                    Swal.fire('Dashboard Maximum 4 silahkan unchek yang lain Dahulu')
                    obj.prop('checked', false);
                }
            })
            .fail(function(a) {
                console.log('error');
            })


    })
</script>
<div class="row">
    <div class="col-sm-2">
        <a href="<?php echo base_url('admin/galery') ?>"><i class="fa fa-plus fa-2x"></i></a>
    </div>
</div>
<table class="table table-responsive-sm" id="dataTable">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Img</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($data as $value) { ?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $value['title'] ?></td>
                <td>
                    <img style="width: 200px;" src="<?php echo base_url('uploads/' . $value['img']) ?>" class="img-thumbnail" alt="img_<?php echo $value['title'] ?>">
                </td>
                <td style="width: 140px;">
                    <a href="<?php echo base_url('Admin/galery/' . $value['id']) ?>" class="btn btn-primary">Edit</a>
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
                        url: '<?php echo base_url($ajaxUrl) ?>',
                        type: 'POST',
                        data: {
                            action: 'deleteGalery',
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
</script>
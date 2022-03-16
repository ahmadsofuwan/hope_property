<div class="container-fluid" style="padding-top: 25px;">
    <div class="row">
        <div class="col-sm-12 d-flex text-center">
            <h1 style="font-size: 3.5em;font-family: sans-serif;"><b><?php echo $dataMaster[0]['title'] ?></b></h1>
            <img src="<?php echo base_url('uploads/' . $dataMaster[0]['img']) ?>" alt="..." class="img-fluid">
            <h2 style="margin-top: 10px;"><u style="font-family: sans-serif;"><?php echo $dataMaster[0]['name'] ?></u></h2>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="container-fluid" style="font-family: serif; font-size: 1.5em;">
                <?php echo $dataMaster[0]['articel'] ?>
            </div>
        </div>
    </div>

    <?php foreach ($dataDetail as $item => $value) { ?>
        <div class="row" style="margin-top: 25px;">
            <div class="col-sm-12 d-flex text-center">
                <h1 style="font-size: 3.5em;font-family: sans-serif;"><b><?php echo $value['title'] ?></b></h1>
                <img src="<?php echo base_url('uploads/' . $value['img']) ?>" alt="..." class="img-fluid">
                <h2 style="margin-top: 10px;"><u style="font-family: sans-serif;"><?php echo $value['name'] ?></u></h2>
            </div>
            <div class="col-sm-12">
                <div class="container-fluid" style="font-family: serif; font-size: 1.5em;">
                    <?php echo $value['articel'] ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<div style="height: 100px;"></div>
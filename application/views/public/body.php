<div style="height: 25px;"></div>
<?php
for ($i = 0; $i < count($data); $i++) {
?>
    <section class="mt-5">
        <div class="container">
            <div class="col-md-6">
                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="<?php echo base_url('uploads/' . $data[$i]['img']); ?>" alt="..." /><a class="stretched-link" href="#!"></a></div>
            </div>

            <div class="row h-100 g-0">
                <div class="col-md-6">
                    <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                        <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6"><?php echo $data[$i]['title']; ?></h1>
                        <p class="mb-3" style="font-family: serif; font-size: 1.9em;"><a href="<?php echo base_url('Content/detail/' . $data[$i]['id']); ?>"><u><?php echo $data[$i]['name']; ?></a></u></p>
                        <p class="mb-5" style="font-family: serif; font-size: 1.5em;"><?php echo $data[$i]['articel']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="height: 50px;"></div>
<?php } ?>
<!-- <br><br> -->
<div style="height: 100px;"></div>